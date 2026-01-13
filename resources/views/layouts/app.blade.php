<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS (CDN for quick preview) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Page loader -->
    <div id="page-loader" class="page-loader" role="status" aria-live="polite" aria-label="Loading"> 
        <div class="loader-content">
            <div class="loader-icon" aria-hidden="true">
                <div class="dot dot-1"></div>
                <div class="dot dot-2"></div>
                <div class="dot dot-3"></div>
            </div>
            <div class="loader-text"> loading opportunities<span class="dots">...</span></div>
        </div>
    </div>

    @yield('content')

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function(){
            const loader = document.getElementById('page-loader');
            const minDelay = 1000; // ensure loader is visible for at least this many ms
            const start = Date.now();
            function hideLoader(){
                const elapsed = Date.now() - start;
                const remaining = Math.max(0, minDelay - elapsed);
                setTimeout(()=>{
                    if(loader){
                        loader.classList.add('fade-out');
                        setTimeout(()=> loader.remove(), 350);
                    }
                }, remaining);
            }
            if(document.readyState === 'complete'){
                hideLoader();
            } else {
                window.addEventListener('load', hideLoader);
            }
        })();
    </script>
</body>
</html>