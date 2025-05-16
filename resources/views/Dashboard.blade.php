<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Navbar</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: sans-serif;
    }

    .navbar {
        background-color: #333;
        color: white;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 1.5em;
        font-weight: bold;
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .nav-links li a {
        color: white;
        text-decoration: none;
        transition: color 0.3s;
    }

    .nav-links li a:hover {
        color: #00bcd4;
    }

</style>
<body>
<nav class="navbar">
    <div class="logo">ECommerce</div>
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/login">LogIn</a></li>
        <li><a href="/signup">Sign Up</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>
</body>
</html>
