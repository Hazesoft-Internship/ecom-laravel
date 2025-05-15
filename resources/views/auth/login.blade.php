
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<form action="{{ route('login') }}" method="POST" class="max-w-sm mx-auto p-6 bg-white shadow-lg rounded-lg">
    @csrf

    @error('email')
        <div class="alert alert-danger mb-4 text-red-600" >{{ $message }}</div>
    @enderror

    @error('password')
        <div class="alert alert-danger mb-4 text-red-600">{{ $message }}</div>
    @enderror

    <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

    <div class="mb-4">
        <label for="email" class="block text-gray-700 font-medium">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div class="mb-6">
        <label for="password" class="block text-gray-700 font-medium">Password</label>
        <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <input type="checkbox" id="remember" name="remember" class="mr-2">
            <label for="remember" class="text-gray-600">Remember Me</label>
        </div>
        {{-- <a href="{{ route('password.request') }}" class="text-blue-500 text-sm">Forgot Password?</a> --}}
    </div>

    <div class="mb-4">
        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">Login</button>
    </div>

    <div class="text-center">
        <p class="text-gray-600 text-sm">Don't have an account? <a href="{{ route('signup') }}" class="text-blue-500">Sign Up</a></p>
    </div>
</form>
