<html>

<head>
    <title>Complaint Management</title>
    <link rel="stylesheet" href="{{ asset('css/homeStyle.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="css/style.css"> --}}
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-style">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {{-- <a href=""><img class="logo" src="logo.jpg"></a> --}}
                </div>

                <div class="collapse navbar-collapse" id="micon">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/complain/create') }}">New Complaint</a></li>
                        <li><a href="{{ url('/complain/list') }}">Complaint List</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Log in</a></li>

                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}">Sign up</a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="my-heading">Wildlife & Foresty</h2>
                    <p class="big-text">Complaint Management System</p>
                    <p>This is a complaint management system that give you the opportunity to make complaint related to environmental or Wildlife crimes. </p>
                    <a class="btn btn-first" href="{{ url('/complain/create') }}">New Complaint</a>
                    <a class="btn btn-second" href="{{ url('/complain/list') }}">Complaints</a>
                </div>
                <div class="col-sm-4">
                    <img src="{{asset('images/Wildlife-foresty-Conservation.jpg')}}" class="img-responsive img-full-width banner-image">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>The Wildlife and Nature Protection Society of Sri Lanka's history is nearly same to that of wildlife protection in the country. With 128 years of existence, the WNPS is the third-oldest non-governmental organization globally. Its establishment led to the creation of the Department of Wildlife Conservation and the Wilpattu & Yala National Parks in Sri Lanka.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <img src="{{asset('images/Wildlife-header.jpg')}}" class="img-responsive img-full-width banner-image">
                </div>
                <div class="col-sm-7 banner-info">
                    <p>In order to solve the many environmental, social, economic, land use, and livelihood challenges that affect people as well as elephants and other species, we work in partnership with communities.</p>

                    <p>We work methodically to develop capacity, encourage leadership, and provide citizens the tools they need to promote long-term, sustainable conservation success by interacting with people at the grassroots level.</p>

                    <p>Our creative, honored, and constantly changing programs have benefited Sri Lanka's people and wildlife for almost 25 years.</p>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-7 banner-info">
                    <p>The establishment of the Forest Department in 1887, formerly known as the Office of the Conservator of Forests, marked the beginning of scientific forestry and forest conservation in Sri Lanka.</p>
                    
                    <p>1885 saw the passage of Sri Lanka's first forest ordinance. The first Conservator of Forests of Ceylon was a British official named R. Thompson, a technical officer from the British Indian Forest Service, who assumed control of forestry activities on June 25, 1887. Mr. Thompson was a veteran forester with extensive knowledge in tropical regions. Initially, he served as a consultant to government agents.</p>
                </div>
                <div class="col-sm-5">
                    <img src="{{asset('images/foresty-header.jpg')}}" class="img-responsive img-full-width banner-image">
                </div>
            </div>
        </div>
    </header>
</body>

</html>