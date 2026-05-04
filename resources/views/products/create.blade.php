<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

    <div class="max-w-3xl mx-auto px-4 py-10">

        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">Add Product</h1>
            <a href="{{ route('products.index') }}"
               class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                Back to Products
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 px-4 py-3 bg-red-100 border border-red-300 text-red-800 rounded-md text-sm">
                <p class="font-semibold mb-2">Please fix the following errors:</p>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 sm:p-8">
            <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                        placeholder="Product name"
                    >
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        step="0.01"
                        min="0"
                        required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                        placeholder="0.00"
                    >
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900"
                        placeholder="Short description of the product"
                    >{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-md hover:bg-gray-700 transition"
                    >
                        Save Product
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>

</body>
</html>
