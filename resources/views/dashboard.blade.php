<div>
    @auth
        Welcome back, {{ auth()->user()->name }}!
        {{-- {{ Auth::user()->name }} --}}
    @endauth

    @guest
        Please log in to see your profile.
    @endguest

    <h1>Welcome to the Dashboard</h1>
    <p>This is your dashboard where you can view and manage your data.</p>

    <a href={{ '/product/show' }}> show all products</a><br>
    <a href={{ '/product/add' }}> Add products</a><br>
    <a href={{ '/product/show/myproduct' }}> my products</a><br>
    <a href={{ '/cart/show' }}> cart </a><br><br>
    <form action={{ "/logout" }} method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>