<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel pracownika</title>
</head>
<body>
<h1>Panel pracownika</h1>
<h2>Witaj {{$employee->email}}</h2>
<button>Zarządzanie karnetami</button>
<button>Zarządzanie kontami klientów</button>
<button>Zarządzanie zajęciami</button>
<button>Statystyki i raporty</button>
<form action="{{ route('employee.logout') }}" method="POST">
    @csrf
    <button type="submit">Wyloguj się</button>
</form>
</body>
</html>
