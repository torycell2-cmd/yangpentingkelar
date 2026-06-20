<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduLearn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { margin: 0; display: flex; height: 100vh; overflow: hidden; font-family: 'Inter', sans-serif; }
        #sidebar { width: 260px; background: #1e293b; color: white; flex-shrink: 0; transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; }
        #sidebar.collapsed { width: 75px; }
        .nav-link { color: #cbd5e1; padding: 15px; display: flex; align-items: center; text-decoration: none; transition: 0.2s; }
        .nav-link:hover { background: #334155; color: white; }
        .menu-text { margin-left: 10px; white-space: nowrap; transition: opacity 0.2s; }
        #sidebar.collapsed .menu-text { opacity: 0; pointer-events: none; }
        #main-content { flex-grow: 1; display: flex; flex-direction: column; overflow-y: auto; background: #f8f9fa; }
    </style>
</head>
<body>

    <div id="sidebar">
        <div class="p-3 d-flex align-items-center">
            <h4 class="m-0">🎓 <span class="menu-text">EduLearn</span></h4>
            <button id="toggleBtn" class="btn btn-sm btn-outline-light ms-auto">☰</button>
        </div>
        <nav class="mt-2">
            <a class="nav-link" href="{{ route('dashboard') }}">📊 <span class="menu-text">Dashboard</span></a>
            <a class="nav-link" href="{{ route('articles.index') }}">📚 <span class="menu-text">Artikel</span></a>
            <a class="nav-link" href="{{ route('forum.index') }}">💬 <span class="menu-text">Forum</span></a>
            <a class="nav-link" href="{{ route('quiz.index') }}">📝 <span class="menu-text">Quiz</span></a>
            <a class="nav-link" href="{{ route('ai.index') }}">🤖 <span class="menu-text">AI Tutor</span></a>
        </nav>
    </div>

    <div id="main-content">
        <nav class="navbar bg-white shadow-sm px-4 justify-content-end">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-dark btn-sm">Register</a>
            @endguest
        </nav>

        <div class="p-4 flex-grow-1">
            @yield('content')
        </div>

        <div class="bg-white border-top p-4">
            @stack('input-box')
        </div>
    </div>

    <script>
        document.getElementById('toggleBtn').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>