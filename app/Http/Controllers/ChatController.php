<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;

class ChatController extends Controller
{
    /**
     * Submit penawaran dari halaman beranda (Pra-Panen).
     * Otomatis buat chat thread + pesan pertama.
     */
    public function submitOffer(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'farmer_name'  => 'required|string',
            'offer_qty'    => 'required|integer|min:1',
            'offer_price'  => 'required|integer|min:1',
            'notes'        => 'nullable|string|max:500',
        ]);

        $buyer = Auth::user();

        // Cari mitra target dari request, fallback ke mitra pertama jika tidak disediakan
        $mitra = null;
        if ($request->has('mitra_id') && $request->mitra_id) {
            $mitra = User::where('role', 'mitra')->find($request->mitra_id);
        }

        if (!$mitra) {
            $mitra = User::where('role', 'mitra')->first();
        }

        if (!$mitra) {
            return response()->json(['error' => 'Tidak ada mitra yang terdaftar.'], 422);
        }

        $qty   = (int) $request->offer_qty;
        $price = (int) $request->offer_price;
        $total = $qty * $price;
        $dp    = (int) ($total * 0.20);

        // Buat chat thread baru
        $chat = Chat::create([
            'buyer_id'    => $buyer->id,
            'mitra_id'    => $mitra->id,
            'product_name'=> $request->product_name,
            'farmer_name' => $request->farmer_name,
            'offer_qty'   => $qty,
            'offer_price' => $price,
            'offer_total' => $total,
            'offer_dp'    => $dp,
            'notes'       => $request->notes,
            'status'      => 'open',
        ]);

        // Pesan otomatis dari sistem (dikirim sebagai buyer)
        $autoMsg  = "🌾 *Penawaran Baru dari {$buyer->name}*\n\n";
        $autoMsg .= "Produk: {$request->product_name}\n";
        $autoMsg .= "Jumlah: " . number_format($qty, 0, ',', '.') . " kg\n";
        $autoMsg .= "Harga: Rp " . number_format($price, 0, ',', '.') . "/kg\n";
        $autoMsg .= "Total: Rp " . number_format($total, 0, ',', '.') . "\n";
        $autoMsg .= "DP (20%): Rp " . number_format($dp, 0, ',', '.') . "\n";
        if ($request->notes) {
            $autoMsg .= "\nCatatan: {$request->notes}";
        }
        $autoMsg .= "\n\nMohon konfirmasi ketersediaan dan kesepakatan harga. Terima kasih!";

        ChatMessage::create([
            'chat_id'   => $chat->id,
            'sender_id' => $buyer->id,
            'message'   => $autoMsg,
        ]);

        return response()->json([
            'success' => true,
            'chat_id' => $chat->id,
            'redirect_url' => route('chat.show', $chat->id),
        ]);
    }

    // ─────────────────────────────────────────────
    // BUYER SIDE
    // ─────────────────────────────────────────────

    /**
     * Daftar semua chat milik pembeli yang login.
     */
    public function index()
    {
        $chats = Chat::with(['mitra', 'lastMessage'])
            ->where('buyer_id', Auth::id())
            ->latest()
            ->get();

        return view('buyer.chat', compact('chats'));
    }

    /**
     * Detail thread chat (buyer view).
     */
    public function show($id)
    {
        $chat = Chat::with(['messages.sender', 'mitra', 'buyer'])
            ->where('buyer_id', Auth::id())
            ->findOrFail($id);

        return view('buyer.chat-show', compact('chat'));
    }

    /**
     * Kirim pesan baru ke sebuah thread (dari pembeli).
     */
    public function sendMessage(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:2000']);

        $chat = Chat::where('buyer_id', Auth::id())->findOrFail($id);

        ChatMessage::create([
            'chat_id'   => $chat->id,
            'sender_id' => Auth::id(),
            'message'   => $request->message,
        ]);

        return redirect()->route('chat.show', $id)->with('success', 'Pesan terkirim!');
    }

    // ─────────────────────────────────────────────
    // MITRA SIDE
    // ─────────────────────────────────────────────

    /**
     * Daftar semua chat penawaran yang masuk ke mitra.
     */
    public function mitraIndex()
    {
        $chats = Chat::with(['buyer', 'lastMessage'])
            ->where('mitra_id', Auth::id())
            ->latest()
            ->get();

        $unreadCount = $chats->count(); // Simplified: count all chats

        return view('mitra.chat', compact('chats', 'unreadCount'));
    }

    /**
     * Detail thread chat (mitra view).
     */
    public function mitraShow($id)
    {
        $chat = Chat::with(['messages.sender', 'buyer', 'mitra'])
            ->where('mitra_id', Auth::id())
            ->findOrFail($id);

        return view('mitra.chat-show', compact('chat'));
    }

    /**
     * Kirim pesan dari mitra.
     */
    public function mitraSendMessage(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:2000']);

        $chat = Chat::where('mitra_id', Auth::id())->findOrFail($id);

        ChatMessage::create([
            'chat_id'   => $chat->id,
            'sender_id' => Auth::id(),
            'message'   => $request->message,
        ]);

        return redirect()->route('mitra.chat.show', $id)->with('success', 'Pesan terkirim!');
    }
}
