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
    <h2>Зарегестрироваться</h2>
    <form action="{{route('registerNewAccount')}}" method="POST">
        @csrf
        <input type="text" name="name" required placeholder="Имя">
        <br>
        <input type="text" name="surname" required placeholder="Фамилия">
        <br>
        <input type="text" name="email" required placeholder="Электронная почта">
        <br>
        <input type="password" name="password" required placeholder="Пароль">
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
        Есть аккаунт? <a href="{{route('login')}}">Войти</a>
    </div>
</body>
</html>
