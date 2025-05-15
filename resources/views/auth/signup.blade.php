
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-lg mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-semibold text-center mb-6">Sign Up</h2>
    <form action="{{ '/signup' }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required>
            @error('name')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" required>
            @error('email')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium">Password:</label>
            <input type="password" id="password" name="password"  class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" required>
            @error('password')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation"  class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password_confirmation') border-red-500 @enderror" required>
            @error('password_confirmation')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-medium">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror" required>
            @error('address')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <label for="phone" class="block text-gray-700 font-medium">Phone:</label>
            <input type="tel" id="phone" name="phone"value="{{ old('phone') }}" class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror" required>
            @error('phone')
                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Sign Up</button>
    </form>
</div>
