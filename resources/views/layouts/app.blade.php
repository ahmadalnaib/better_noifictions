<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                     
                        <button class="btn btn-primary position-relative me-5 mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{auth()->user()->unreadNotifications->count() }}
                            </span>
                        </button>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('sentemail.index') }}">Send Email</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-end bg-light"  data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title fw-bold" id="offcanvasWithBothOptionsLabel">New Email</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <hr>
            @if(Auth::check())
          <div class="d-flex justify-content-around align-items-center rounded mt-4">
            @if(auth()->user()->unreadNotifications->count())
            <a class="text-center py-3 px-4 mb-2 nav-link btn btn-white text-secondary border border-white-50 shadow-sm border-opacity-25" href="{{route('markAsRead')}}">Mark all as read</a>
            @endif
            @if(auth()->user()->notifications->count())
            <a class="text-center py-3 px-4 mb-2 nav-link btn btn-white text-danger border border-white-50 shadow-sm border-opacity-25" href="{{route('deleteNot')}}">Delete all </a>
            @else
            <p>there is no new notifications</p>
            @endif
            
          </div>
            
            <div class="offcanvas-body">
              
                @foreach (auth()->user()->unreadNotifications  as $notification)
                @if($notification->type === 'App\Notifications\ServiceEmail')
                <a href="#" class="card mb-3 bg-white shadow-sm nav-link text-dark" style="max-width: 540px;" >
                    <div class="row g-0">
                   
                      <div class="col-md-12">
                        <div class="card-body">
                          <div>
                            <div class="row">
                                <div class="col-md-2 p-2">
                                 <div class="bg-primary opacity-50 rounded-2 text-center">
                                    <i class="bi bi-envelope fs-3  text-white "></i>
                                 </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 class="card-title text-dark fw-bold">Neues Email von {{$notification->data['name']}}</h6>
                                   
                                    <h6 class="card-title text-muted">{{$notification->data['email']}}</h6>
                                </div>
                               
                               
                                
                                 
                             
                            </div>
                          </div>
                          <h6 class="card-text text-dark">  {{Str::limit($notification->data['message'],20)}}</h6>
                          <hr>
                          <div class="card-text  bg-light  row   rounded ">
                            <span class="col-md-6  rounded text-primary  text-decoration-underline">
                                Services Email</span>
                            <p class="col-md-6">
                              
                                <small class="text-muted ">  
                                    <i class="bi bi-clock text-muted fs-6"> </i>{{$notification->created_at}}
                                </small>
                            </p>
                         
                        </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  @else
                  <a href="#" class="card mb-3 bg-white shadow-sm nav-link text-dark" style="max-width: 540px;" >
                    <div class="row g-0">
                   
                      <div class="col-md-12">
                        <div class="card-body">
                          <div>
                            <div class="row">
                                <div class="col-md-2 p-2">
                                 <div class="bg-success opacity-50 rounded-2 text-center">
                                    <i class="bi bi-envelope fs-3  text-white "></i>
                                 </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 class="card-title text-dark fw-bold">Neues Email von  {{$notification->data['name']}}</h6>
                                   
                                    <h6 class="card-title text-muted">{{$notification->data['email']}}</h6>
                                </div>
                               
                               
                                
                                 
                             
                            </div>
                          </div>
                          <h6 class="card-text text-muted ">  {{Str::limit($notification->data['message'],30)}}</h6>
                          <hr>
                          <div class="card-text  bg-light  row   rounded">
                            <span class="col-md-6  rounded text-success  text-decoration-underline">
                                Contact Email</span>
                            <p class="col-md-6">
                              
                                <small class="text-muted">  
                                    <i class="bi bi-clock text-muted fs-6"> </i>{{$notification->created_at}}
                                </small>
                            </p>
                         
                        </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
              
                  @endforeach
                @foreach (auth()->user()->readNotifications  as $notification)
                @if($notification->type === 'App\Notifications\ServiceEmail')
                <a href="#" class="card mb-3 bg-white shadow-sm nav-link text-dark" style="max-width: 540px;" >
                    <div class="row g-0">
                   
                      <div class="col-md-12">
                        <div class="card-body">
                          <div>
                            <div class="row">
                                <div class="col-md-2 p-2">
                                 <div class="bg-secondary opacity-50 rounded-2 text-center">
                                    <i class="bi bi-envelope fs-3  text-white "></i>
                                 </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 class="card-title text-dark fw-bold">Neues Email von {{$notification->data['name']}}</h6>
                                   
                                    <h6 class="card-title text-muted">{{$notification->data['email']}}</h6>
                                </div>
                               
                               
                                
                                 
                             
                            </div>
                          </div>
                          <h6 class="card-text text-dark">  {{Str::limit($notification->data['message'],20)}}</h6>
                          <hr>
                          <div class="card-text  bg-light  row   rounded ">
                            <span class="col-md-6  rounded text-secondary  text-decoration-underline">
                                Services Email</span>
                            <p class="col-md-6">
                              
                                <small class="text-muted ">  
                                    <i class="bi bi-clock text-muted fs-6"> </i>{{$notification->created_at}}
                                </small>
                            </p>
                         
                        </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  @else
                  <a href="#" class="card mb-3 bg-white shadow-sm nav-link text-dark" style="max-width: 540px;" >
                    <div class="row g-0">
                   
                      <div class="col-md-12">
                        <div class="card-body">
                          <div>
                            <div class="row">
                                <div class="col-md-2 p-2">
                                 <div class="bg-secondary opacity-50 rounded-2 text-center">
                                    <i class="bi bi-envelope fs-3  text-white "></i>
                                 </div>
                                </div>
                                <div class="col-md-10">
                                    <h6 class="card-title text-dark fw-bold">Neues Email von  {{$notification->data['name']}}</h6>
                                   
                                    <h6 class="card-title text-muted">{{$notification->data['email']}}</h6>
                                </div>
                               
                               
                                
                                 
                             
                            </div>
                          </div>
                          <h6 class="card-text text-muted ">  {{Str::limit($notification->data['message'],30)}}</h6>
                          <hr>
                          <div class="card-text  bg-light  row   rounded">
                            <span class="col-md-6  rounded text-secondary  text-decoration-underline">
                                Contact Email</span>
                            <p class="col-md-6">
                              
                                <small class="text-muted">  
                                    <i class="bi bi-clock text-muted fs-6"> </i>{{$notification->created_at}}
                                </small>
                            </p>
                         
                        </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endif
                  @endforeach
                  @endif
            </div>
          </div>

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>
</body>
</html>
