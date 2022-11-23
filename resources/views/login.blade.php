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
    <h2>Войти в аккаунт</h2>
    <form action="{{route('loginInAccount')}}" method="POST">
        @csrf
        <input type="text" name="email" placeholder="Электронная почта">
        <br>
        <input type="password" name="password" placeholder="Пароль">
        <br>
        <input type="checkbox" name="remember"> Запомнить меня
        <br>
        <input type="submit">
    </form>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <div>
        Нет аккаунта? <a href="{{route('register')}}">Зарегистрироваться</a>
    </div>
</body>
</html>
