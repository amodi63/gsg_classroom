<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title',config('app.name')  ) </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"

        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-REPLACE_WITH_INTEGRITY_VALUE" crossorigin="anonymous" />
        <script src="https://kit.fontawesome.com/1e750d2ce4.js" crossorigin="anonymous"></script>
        <style>
            i {
                margin-block-end: 3px !important;
            }
        
            i.fa-floppy-disk, i.fa-xmark {
                margin-inline-end: 4px !important;
            }
        </style>
        
        @stack('styles')
</head>

<body>
    <div class="container">
        
        
        @include('layouts.header')
     

        <main>
            @yield('content')
        </main>
       @include('layouts.footer')
</body>

</html>
