<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $response = Http::acceptJson()->post($this->apiUrl('/login'), $credentials);

        $payload = $response->json();
        $token = Arr::get($payload, 'token')
            ?? Arr::get($payload, 'access_token')
            ?? Arr::get($payload, 'data.token');

        if (! $response->successful() || blank($token)) {
            $errorMessage = Arr::get($payload, 'message', 'Login failed. Please check your credentials.');

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => $errorMessage,
                ]);
        }

        $request->session()->regenerate();
        $request->session()->put('api_token', $token);
        $request->session()->put('api_user', Arr::get($payload, 'user', Arr::get($payload, 'data.user')));

        return redirect()->route('products.index');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $response = Http::acceptJson()->post($this->apiUrl('/register'), $validated);

        $payload = $response->json();
        $token = Arr::get($payload, 'token')
            ?? Arr::get($payload, 'access_token')
            ?? Arr::get($payload, 'data.token');

        if (! $response->successful()) {
            $errorMessage = Arr::get($payload, 'message', 'Registration failed. Please try again.');

            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['email' => $errorMessage]);
        }

        if (filled($token)) {
            $request->session()->regenerate();
            $request->session()->put('api_token', $token);
            $request->session()->put('api_user', Arr::get($payload, 'user', Arr::get($payload, 'data.user')));

            return redirect()->route('products.index');
        }

        return redirect()
            ->route('login')
            ->with('status', 'Registration successful. Please login with your new account.');
    }

    public function logout(Request $request)
    {
        $token = $request->session()->get('api_token');

        if (filled($token)) {
            Http::acceptJson()
                ->withToken($token)
                ->post($this->apiUrl('/logout'));
        }

        $request->session()->forget(['api_token', 'api_user']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function apiUrl(string $path): string
    {
        $baseUrl = rtrim((string) env('API_BASE_URL', env('APP_URL')), '/');

        return $baseUrl.'/'.ltrim($path, '/');
    }
}
