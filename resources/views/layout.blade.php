<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <ul>
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('contact') }}">Contact</a></li>
      <li><a href="{{ route('blog-post', ['id' => 1]) }}">Blog Post 1</a></li>
    </ul>
    @yield('content')
  </body>
</html>
