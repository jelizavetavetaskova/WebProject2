<!doctype html>
<html lang="lv">
 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <meta name="description" content="Jeļizavetas Vetaškovas 2. praktiskais darbs - dziesmu lapa">
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        @viteReactRefresh
        @vite('resources/css/app.css')
        @vite('resources/js/index.jsx')
    </head>
 
    <body>
        
        <div id="root"></div>
 
    </body>
 
</html>