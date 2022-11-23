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
<a href="{{route('teams')}}">Назад</a>
    <h2>Создать команду</h2>
    <form action="{{route('createTeam')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Название команды">
        <br>
        <input type="text" name="description" placeholder="Описание команды">
        <br>
        <input type="file" name="image">
        <br>
        <input type="submit">
    </form>
</body>
</html>
