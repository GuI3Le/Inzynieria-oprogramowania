<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rejestracja</title>
</head>
<body>
<h1>Rejestracja</h1>
<form action="/signup" method="post">
@csrf
    <input type="text" name="first_name" placeholder="Imię">
    <input type="text" name="last_name" placeholder="Nazwisko">
    <input type="email" name="email" id="" placeholder="email">
    <input type="password" name="password" id="" placeholder="password">
    <input type="submit" value="Zarejestruj się">
</form>
</body>
</html>
