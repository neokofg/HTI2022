<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    /* Dropdown Button */
    .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #ddd;}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {display: block;}

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
<body>
<a href="{{route('index')}}">Назад</a>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<h2>Создание чекпоинта:</h2>
<form action="{{route('createCheckpoint')}}" method="POST">
    @csrf
    <div class="dropdown">
        <button class="dropbtn">Выбрать хакатон:</button>
        <div class="dropdown-content">
            @foreach($hackathons as $hack)
                <input type="checkbox" name="hackid" value="{{$hack->id}}">{{$hack->name}}
            @endforeach
        </div>
    </div>
    <br>
    <input type="number" name="checkpointnumber" placeholder="Номер чекпоинта">
    <br>
    <input type="time" name="time" placeholder="Время">
    <br>
    <input type="submit">
</form>
</body>
</html>
