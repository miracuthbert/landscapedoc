<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.blog.partials._head')

</head>

<body>

@include('layouts.blog.partials._navigation')

<!-- Main Content -->
@yield('content')

<hr>

@include('layouts.blog.partials._footer')

@include('layouts.blog.partials._scripts')

</body>

</html>
