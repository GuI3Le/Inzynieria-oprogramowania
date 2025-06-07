<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rejestracja</title>
</head>
<body>
<h1>Rejestracja</h1>
<form action="{{route('customer.submitRegistration')}}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Nazwa użytkownika">
    <input type="text" name="first_name" placeholder="Imię">
    <input type="text" name="last_name" placeholder="Nazwisko">
    <input type="email" name="email" placeholder="email">
    <input type="number" name="phone" placeholder="telefon">
    <input type="date" name="birth_date">
    <input type="password" name="password" placeholder="hasło">
    <input type="password" name="password_confirmation" placeholder="powtórz hasło">
    <input type="submit" value="Zarejestruj się">
</form>
</body>
</html>
