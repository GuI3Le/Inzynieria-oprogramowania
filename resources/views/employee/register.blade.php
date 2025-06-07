<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dodawanie pracownika</title>
</head>
<body>
<h1>Dodawanie pracownika</h1>
<form action="{{route('employee.showRegistrationForm')}}" method="post">
    @csrf
    <input type="text" name="first_name" id="" placeholder="imie">
    <input type="text" name="last_name" id="" placeholder="nazwisko">
    <input type="email" name="email" id="" placeholder="email">
    <input type="tel" name="phone" id="" placeholder="numer telefonu">
    <label for="role">
        <select name="role_id" id="">
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->role_name}}</option>
            @endforeach
        </select>
    </label>
    <input type="password" name="password" id="" placeholder="hasło">
    <button type="submit">Dodaj pracownika</button>
</form>
</body>
</html>
