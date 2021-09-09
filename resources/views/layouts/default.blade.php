<html>
<head>
    <title>@yield('title','微博') - Laravel_微博教程</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Weibo</a>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="/help">帮助</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">登录</a>
            </li>
        </ul>
    </div>
</nav>
@yield('content')
</body>
</html>
