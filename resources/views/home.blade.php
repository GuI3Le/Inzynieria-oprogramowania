<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProFit Strona główna</title>
</head>
<body>
<h1>Witaj na stronie głównej</h1>
<a href="{{route('customer.register')}}">Rejestracja</a><br>
<a href="{{route('customer.login')}}">Logowanie</a>
<a href="{{route('employee.showRegistrationForm')}}">Dodawanie pracownika</a>
<a href="{{route('employee.showLoginForm')}}">Pracownik</a>
</body>
</html>
