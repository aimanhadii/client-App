<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class ApiController extends Controller
{
    protected function apiClient(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
        ])->withToken(session('api_token'));
    }

    protected function apiUrl(string $path): string
    {
        return config('services.api.base_url') . $path;
    }

    protected function redirectToLogin()
    {
        return redirect()
            ->route('login')
            ->with('error', 'Your session has expired. Please log in again.');
    }
}
