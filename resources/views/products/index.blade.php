<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

    <div class="max-w-6xl mx-auto px-4 py-10">

        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">Products</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('products.create') }}"
                   class="bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-gray-700 transition">
                    + Add Product
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="bg-white border border-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded-md hover:bg-gray-100 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (empty($products))
            <div class="text-center py-24 text-gray-400">
                <p class="text-lg font-medium">No products found.</p>
                <p class="text-sm mt-1">Add your first product to get started.</p>
            </div>
        @else
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-400">{{ $product['id'] ?? '-' }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $product['name'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ isset($product['price']) ? '$' . number_format($product['price'], 2) : '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                                    {{ $product['description'] ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="{{ route('products.show', $product['id']) }}"
                                       class="text-blue-600 hover:underline text-xs font-medium">View</a>
                                    <a href="{{ route('products.edit', $product['id']) }}"
                                       class="text-yellow-600 hover:underline text-xs font-medium">Edit</a>
                                    <form action="{{ route('products.destroy', $product['id']) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:underline text-xs font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

</body>
</html>