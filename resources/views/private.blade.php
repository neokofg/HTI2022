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
<a href="{{route('index')}}">Назад</a>
<h2>Личный кабинет</h2>
<p>Имя: {{Auth::user()->name}} {{Auth::user()->surname}}</p>
<p>Email: {{Auth::user()->email}}</p>
<p>Контакты: {{Auth::user()->contacts}}</p>
<p>О себе: {{Auth::user()->description}}</p>
<p>Стэк: {{Auth::user()->stack}}</p>
</body>
</html>
