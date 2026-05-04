<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function index()
    {
        $response = $this->apiClient()->get($this->apiUrl('/products'));

        if ($response->unauthorized() || $response->forbidden()) {
            return $this->redirectToLogin();
        }

        $payload = $response->json();

   
        $products = Arr::get($payload, 'data', $payload);

        if (! is_array($products)) {
            $products = [];
        }

        $products = array_values(array_filter($products, 'is_array'));

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $response = $this->apiClient()->post($this->apiUrl('/products'), $validated);

        if ($response->unauthorized() || $response->forbidden()) {
            return $this->redirectToLogin();
        }

        if ($response->successful()) {
            return redirect()
                ->route('products.index')
                ->with('success', 'Product created successfully.');
        }

        $errorMessage = Arr::get($response->json(), 'message', 'Unable to create product. Please try again.');

        return back()
            ->withInput()
            ->withErrors(['api' => $errorMessage]);
    }
    
    public function show(int $id)
    {
        $response = $this->apiClient()->get($this->apiUrl("/products/{$id}"));

        if ($response->unauthorized() || $response->forbidden()) {
            return $this->redirectToLogin();
        }

        if ($response->successful()) {
            $product = $response->json();

            return view('products.show', compact('product'));
        }

        return redirect()
            ->route('products.index')
            ->withErrors(['api' => 'Unable to fetch product details. Please try again.']);
    }

    public function destroy(int $id)
    {
        $response = $this->apiClient()->delete($this->apiUrl("/products/{$id}"));

        if ($response->unauthorized() || $response->forbidden()) {
            return $this->redirectToLogin();
        }

        if ($response->successful()) {
            return redirect()
                ->route('products.index')
                ->with('success', 'Product deleted successfully.');
        }

        return redirect()
            ->route('products.index')
            ->withErrors(['api' => 'Unable to delete product. Please try again.']);
    }

    public function edit(int $id)
    {
        $response = $this->apiClient()->get($this->apiUrl("/products/{$id}"));

        if ($response->unauthorized() || $response->forbidden()) {
            return $this->redirectToLogin();
        }

        if ($response->successful()) {
            $product = $response->json();

            return view('products.edit', compact('product'));
        }

        return redirect()
            ->route('products.index')
            ->withErrors(['api' => 'Unable to fetch product details. Please try again.']);
    }

    private function apiUrl(string $path): string
    {
        $baseUrl = rtrim((string) env('API_BASE_URL', env('APP_URL')), '/');

        return $baseUrl.'/'.ltrim($path, '/');
    }

    private function apiClient(): PendingRequest
    {
        $request = Http::acceptJson();
        $token = session('api_token');

        if (filled($token)) {
            $request = $request->withToken($token);
        }

        return $request;
    }

    private function redirectToLogin()
    {
        session()->forget(['api_token', 'api_user']);

        return redirect()
            ->route('login')
            ->withErrors(['api' => 'Sesi tamat. Sila login semula.']);
    }
    
}

