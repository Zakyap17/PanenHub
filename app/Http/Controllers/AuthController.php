<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->email;
        if (User::where('email', $email)->exists()) {
            return back()->withErrors(['msg' => 'Email sudah terdaftar!']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => $request->password,
            'role' => 'pembeli',
        ]);

        Auth::login($user);
        return redirect('/')->with('success', 'User berhasil dibuat!');
    }

    public function registerMitra(Request $request)
    {
        $phone = $request->phone;
        
        if (empty($phone)) {
            return back()->withErrors(['msg' => 'Nomor WhatsApp wajib diisi!']);
        }

        if (User::where('phone', $phone)->exists()) {
            return back()->withErrors(['msg' => 'Nomor WhatsApp sudah terdaftar!']);
        }

        $email = $phone . '@panenhub.com';
        if (User::where('email', $email)->exists()) {
            return back()->withErrors(['msg' => 'Email sudah terdaftar untuk nomor ini!']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => $request->password,
            'phone' => $phone,
            'address' => $request->address ?? $request->location,
            'role' => 'mitra',
        ]);

        Auth::login($user);
        return redirect('/dashboard-mitra')->with('success', 'Pendaftaran Mitra Tani berhasil!');
    }

    public function login(Request $request)
    {
        $loginInput = $request->input('phone') ?? $request->input('email');
        
        // Find if user exists by phone or email
        $user = User::where('phone', $loginInput)->orWhere('email', $loginInput)->first();
        
        if ($user) {
            $credentials = [
                'email' => $user->email,
                'password' => $request->password
            ];
            
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if (Auth::user()->role === 'mitra') {
                    return redirect('/dashboard-mitra');
                }
                return redirect('/');
            }
        }

        return back()->withErrors(['msg' => 'Nomor Handphone/Email atau Kata Sandi salah!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('logged_out', true);
    }

    private function isProviderConfigured($provider)
    {
        $clientId = config("services.{$provider}.client_id");
        $clientSecret = config("services.{$provider}.client_secret");

        if (empty($clientId) || empty($clientSecret)) {
            return false;
        }

        if (str_contains($clientId, 'YOUR_') || str_contains($clientSecret, 'YOUR_')) {
            return false;
        }

        return true;
    }

    private function handleMockLogin($provider)
    {
        $provider = strtolower($provider);
        $mockId = 'mock_id_' . $provider;
        $mockName = 'Demo ' . ucfirst($provider) . ' User';
        $mockEmail = 'demo_' . $provider . '@panenhub.test';
        
        $avatars = [
            'google' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=150',
            'facebook' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?q=80&w=150',
            'apple' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=150',
        ];
        $mockAvatar = $avatars[$provider] ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=150';

        $user = User::where('provider', $provider)
                     ->where('provider_id', $mockId)
                     ->first();

        if (!$user) {
            $user = User::where('email', $mockEmail)->first();

            if ($user) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $mockId,
                    'avatar' => $mockAvatar,
                ]);
            } else {
                $user = User::create([
                    'name' => $mockName,
                    'email' => $mockEmail,
                    'provider' => $provider,
                    'provider_id' => $mockId,
                    'avatar' => $mockAvatar,
                    'role' => 'pembeli',
                ]);
            }
        }

        Auth::login($user, true);
        return redirect('/')->with('success', 'Berhasil masuk otomatis dengan Akun Simulasi ' . ucfirst($provider) . '!');
    }

    public function redirectToProvider($provider)
    {
        $provider = strtolower($provider);

        if (!$this->isProviderConfigured($provider)) {
            return $this->handleMockLogin($provider);
        }

        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            if (config('app.env') === 'local') {
                return $this->handleMockLogin($provider);
            }
            return redirect('/')->withErrors(['msg' => 'Driver ' . ucfirst($provider) . ' belum didukung atau tidak terkonfigurasi.']);
        }
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $provider = strtolower($provider);

        if (!$this->isProviderConfigured($provider) || $request->query('mock') === 'true') {
            return $this->handleMockLogin($provider);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
            $socialUserId = $socialUser->getId();
            $socialName = $socialUser->getName() ?? 'User ' . ucfirst($provider);
            $socialEmail = $socialUser->getEmail() ?? 'user_' . $socialUserId . '@' . $provider . '.com';
            $socialAvatar = $socialUser->getAvatar();
        } catch (\Exception $e) {
            if (config('app.env') === 'local') {
                return $this->handleMockLogin($provider);
            }
            return redirect('/')->withErrors(['msg' => 'Gagal login dengan ' . ucfirst($provider) . '. Silakan coba lagi.']);
        }

        $user = User::where('provider', $provider)
                     ->where('provider_id', $socialUserId)
                     ->first();

        if (!$user) {
            $user = User::where('email', $socialEmail)->first();

            if ($user) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUserId,
                    'avatar' => $socialAvatar,
                ]);
            } else {
                $user = User::create([
                    'name' => $socialName,
                    'email' => $socialEmail,
                    'provider' => $provider,
                    'provider_id' => $socialUserId,
                    'avatar' => $socialAvatar,
                    'role' => 'pembeli',
                ]);
            }
        }

        Auth::login($user, true);
        return redirect('/')->with('success', 'Berhasil masuk dengan ' . ucfirst($provider) . '!');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}