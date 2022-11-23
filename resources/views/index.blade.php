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
        Здравствуйте, {{Auth::user()->name}} {{Auth::user()->surname}}
        <a href="#">Личный кабинет</a>
        @if(Auth::user()->role == 1)
            <a href="{{route('admin')}}">Админ панель</a>
        @endif
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
    <a href="{{route('hackathons')}}">Хакатоны</a>
    <div>
        <h1>Новости:</h1>
        @foreach($news as $onenews)
            <img src="/images/{{$onenews->image}}" style="width:150px;height:150px">
            <h3>{{$onenews->name}}</h3>
            <p>{{$onenews->content}}</p>
            <p>{{$onenews->created_at}}</p>
            <hr>
        @endforeach
    </div>
</body>
</html>
