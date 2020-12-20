<!doctype html>
<html lang="{!! app()->getLocale() !!}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="format-detection" content="telephone=no">

      <title>{!! $title !!}</title>

      <!-- Styles -->
      <link href="{!! asset('css/app.css') !!}" rel="stylesheet">

      <!-- Scripts -->
      <script>
          window.Laravel = <?php echo json_encode([
              'csrfToken' => csrf_token(),
          ]); ?>
      </script>
  </head>
  <body>
    <div>
      <header>
        @include('includes.header')
      </header>
      <section>
        <div class="section">
          @yield('content')
        </div>
      </section>
      <footer>
        @include('includes.footer')
      </footer>
    </div>
  </body>
</html>
