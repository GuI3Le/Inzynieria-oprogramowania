<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h1>Logowanie</h1>
<form action="/signin" method="post">
    @csrf
    <input type="email" name="email" id="" placeholder="email">
    <input type="password" name="password" id="" placeholder="hasło">
    <input type="submit" value="Zaloguj">
</form>
</body>
</html>
