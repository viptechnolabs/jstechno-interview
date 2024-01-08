<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/ico"/>
    <title>VIP TechnoLabs</title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="login">
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('auth.login.submit') }}" method="POST">
                @csrf
                <h1>Login Form</h1>
                <br>
                <div>
                    <input type="text" name="email" class="form-control" placeholder="Username"/>
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                </div>
                <div>
                    <button type="submit" class="btn btn-secondary">Login</button>
                </div>
                <div class="separator">
                    <br>
                    <div>
                        <h1><i class="fa fa-hospital-o"></i> VIP TechnoLabs</h1>
                        <p>©2021 All Rights Reserved. VIP TechnoLabs. Privacy and Terms</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>

</body>
</html>
