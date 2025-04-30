<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Products Management</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('products.export') }}" method="POST" class="mb-4">
            @csrf
            <label for="limit" class="block text-sm font-medium text-gray-700">Select Export Quantity:</label>
            <select name="limit" id="limit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @for ($i = 10000; $i <= 100000; $i += 10000)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <button type="submit" class="mt-3 w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                Export to Excel
            </button>
        </form>

        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file" class="block text-sm font-medium text-gray-700">Import Excel File:</label>
            <input type="file" name="file" id="file" accept=".xlsx, .xls" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <button type="submit" class="mt-3 w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">
                Import from Excel
            </button>
        </form>
    </div>
</body>
</html>