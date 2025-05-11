<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class=" px-11">
    <nav class=" flex justify-between">
        <h1>E-commerce</h1>
        <div>
        <ul class="flex gap-28">
            <li>home</li>
            <a href="/product"><li>product</li></a>
        </ul>
        </div>
        @guest
            <a href="/login">login</a>
        @endguest
        @auth
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">logout</button>
            
        </form>
            
        @endauth
        
    </nav>
    </div>
</body>
</html>