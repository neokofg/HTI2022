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
<p id="12">Имя: {{Auth::user()->name}} {{Auth::user()->surname}}</p>
<p id="22">Email: {{Auth::user()->email}}</p>
<p id="32">Контакты: {{Auth::user()->contacts}}</p>
<p id="52">Стэк: {{Auth::user()->stack}}</p>
<p id="42">О себе: {{Auth::user()->description}}</p>
<form action="{{route('editUser')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <button type="button" id="editBtn">Редактировать</button>
    <button type="button" style="display:none" id="0">Назад</button>
    <input type="file" name="image" style="display:none" id="1">
    <input type="text" name="name" value="{{Auth::user()->name}}" placeholder="Имя" style="display:none" id="2">
    <input type="text" name="surname" value="{{Auth::user()->surname}}" placeholder="Фамилия" style="display:none" id="3">
    <input type="text" name="email" value="{{Auth::user()->email}}" placeholder="Email" style="display:none" id="4">
    <input type="text" name="contacts" value="{{Auth::user()->contacts}}" placeholder="Контакты" style="display:none" id="5">
    <input type="text" name="stack" value="{{Auth::user()->stack}}" placeholder="Cтэк" style="display:none" id="6">
    <textarea type="text" name="description" placeholder="О себе" style="display:none" id="7">{{Auth::user()->description}}</textarea>
    <input type="submit" style="display:none" id="8">
</form>
<form action="{{route('logout')}}" method="POST">
    @csrf
    <button>Выйти</button>
</form>
</body>
</html>
<script type="text/javascript">
    let editBtn = document.getElementById('editBtn')
    let zero = document.getElementById('0')
    let one = document.getElementById('1')
    let two = document.getElementById('2')
    let three = document.getElementById('3')
    let four = document.getElementById('4')
    let five = document.getElementById('5')
    let six = document.getElementById('6')
    let seven = document.getElementById('7')
    let eight = document.getElementById('8')
    let onetwo = document.getElementById('12')
    let twotwo = document.getElementById('22')
    let threetwo = document.getElementById('32')
    let fourtwo = document.getElementById('42')
    let fivetwo = document.getElementById('52')
    editBtn.onclick = function(){
        editBtn.style.display = "none";
        zero.style.display = "block";
        one.style.display = "block";
        two.style.display = "block";
        three.style.display = "block";
        four.style.display = "block";
        five.style.display = "block";
        six.style.display = "block";
        seven.style.display = "block";
        eight.style.display = "block";
        onetwo.style.display = "none";
        twotwo.style.display = "none";
        threetwo.style.display = "none";
        fourtwo.style.display = "none";
        fivetwo.style.display = "none";
    }
    zero.onclick = function(){
        editBtn.style.display = "inline";
        zero.style.display = "none";
        one.style.display = "none";
        two.style.display = "none";
        three.style.display = "none";
        four.style.display = "none";
        five.style.display = "none";
        six.style.display = "none";
        seven.style.display = "none";
        eight.style.display = "none";
        onetwo.style.display = "block";
        twotwo.style.display = "block";
        threetwo.style.display = "block";
        fourtwo.style.display = "block";
        fivetwo.style.display = "block";
    }
</script>
