<!doctype html>
<html lang="doc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logowanie pracownika</title>
</head>
<body>
<form action="{{route('employee.submitLogin')}}" method="post">
    @csrf
    <input type="email" name="email" id="" placeholder="email" value="anowak@profit.com">
    <input type="password" name="password" id="" placeholder="hasło" value="anowak">
    <input type="submit" value="Zaloguj">
</form>
</body>
</html>
