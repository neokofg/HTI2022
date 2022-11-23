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
    <h2>Добавить хакатон:</h2>
    <form action="{{route('addHackathon')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <br>
        <input type="text" name="name" placeholder="Название">
        <br>
        <input type="date" name="date" placeholder="Дата">
        <br>
        <input type="number" name="prize" placeholder="Призовой фонд">
        <br>
        <textarea type="text" name="description" placeholder="Описание"></textarea>
        <br>
        <p>Выбрать треки:</p>
        <input type="submit">
    </form>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
