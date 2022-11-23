<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(Auth::check())
        Здравствуйте, {{Auth::user()->name,Auth::user()->surname}}
        <a href="#">Личный кабинет</a>
        <br>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button>Выйти</button>
        </form>
    @else
    <div>
        <a href="{{route('login')}}">Войти</a>
    </div>
    <div>
        <a href="{{route('register')}}">Регистрация</a>
    </div>
    @endif
</body>
</html>
