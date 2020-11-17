<html>
<head>
    <title>Laravel Weather task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" >
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand" href="/">Weather</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
    
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger mt-5">
            @foreach ($errors as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
      <div class="card-deck mb-5 mt-5 text-center">
        <div class="card mb-6 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Forecast data</h4>
          </div>
          <div class="card-body">
              
              <h4 class="my-3 font-weight-normal">Search by date tool</h4>
              @include('search')
            
              @if (isset($temp) && !empty($temp))
              <div class="alert alert-success">
                <p>The weather forecast for {{ request()->date }} was <strong>{{ $temp }} °C</strong></p>
              </div>
              @endif
              
              <h4 class="my-3 font-weight-normal">Forecast data for the last 30 days</h4>

              @if (empty($lastDays))
                <p>No forecast data for last 30 days</p>
              @else
                  <table class="table table-bordered table-responsive clients-table">
                      <thead class="thead-light">
                          <tr>
                              <th>ID</th>
                              <th>Date</th>
                              <th>Temperature</th>
                          </tr>
                      </thead>
                      @foreach ($lastDays as $lastDay)
                          <tr>
                              <td>{{ $lastDay['id'] }}</td>
                              <td>{{ $lastDay['date_at'] }}</td>
                              <td>{{ $lastDay['temp'] }} °C</td>
                          </tr>
                      @endforeach
                  </table>
              @endif
          </div>
        </div>
      </div>
    </div>



        <footer class="footer mt-5">
            <div class="container">
                <p class="my-3">© Weather 2020</p>
            </div>
        </footer>
    
        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
        </script>
    
        <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
    
    </body>
    </html>
    