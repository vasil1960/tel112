<!doctype html>
<html lang="en">

  <head>
    @section('head')
    
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      
      {{-- <link rel="icon" href="../../../../favicon.ico"> --}}
      <title>{{ $title }}</title>

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      

      <!-- Custom styles for this template -->
      <link href="{{ asset('assets/jumbotron.css') }}" rel="stylesheet">

    @show
  </head>



  <body>

    @section("nav")
      @include('signali.layouts.inc.nav') 
    @show

    <main role="main"   style="background-color: beige;" >

      @section('jumbotron')
        @include('signali.layouts.inc.jumbotron')
      @show 

        <div class="container" style="padding: 10px">

          @yield('content')

        </div> <!-- /container -->

     

    </main>

    @section('footer')
      <hr>
      <footer class="container" style="text-align: center">
        <p>&copy; Company 2010-{{ date('Y') }}</p>
      </footer>

    @show  

    @section('script')  

      {{--  <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
      {{--  <script>window.jQuery || document.write('<script src="{{ asset('assets/dist/js/vendor/jquery-slim.min.js') }}"><\/script>')</script> 
      <script src="{{ asset('assets/dist/js/vendor/popper.min.js') }}"></script>
      <script src="{{ asset('assets/dist/js/bootstrap.min.js') }}"></script>  --}}  

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  

    @show      

  </body>
</html>