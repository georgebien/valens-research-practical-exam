<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/table.css') }}">
    <title>Auto Paint</title>
</head>
<body>
    <div class="hero-image">
        <div class="hero-text">
          <h1>JUAN'S AUTO PAINT</h1>
        </div>
      </div>
    <div class="topnav">
        <a class="active" href="{{ url('new-paint-jobs') }}" id="new_paint_job">NEW PAINT JOB</a>
        <a href="{{ url('paint-jobs') }}" id="paint_jobs">PAINT JOBS</a>
    </div>
    
    @yield('content-page')
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>

  var base_url_image = '{{ asset('template/images/') }}';
  var base_url = '{{ url('') }}';

</script>
<script>
  const _TOKEN = $('#csrf-token').attr('content');
</script>
<script src="{{ asset('scripts/new_paint.js') }}"></script>
<script src="{{ asset('scripts/paint_jobs.js') }}"></script>
</html>