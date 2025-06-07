<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel klienta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .buttons {
            margin-top: 20px;
        }

        .buttons button {
            margin-right: 10px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .buttons button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Panel klienta</h1>
<h2>Witaj {{auth()->user()->email}}</h2>
<div class="user-info">
    <p><strong>Data i godzina:</strong> <span id="datetime"></span></p>
</div>
<div class="buttons">
    <button onclick="window.location.href='/membership'">Karnet</button>
    <button onclick="window.location.href='/dashboard'">Panel sterowania</button>
    <button onclick="window.location.href='/settings'">Ustawienia konta</button>
    <button onclick="window.location.href='/schedule'">Plan zajęć</button>
</div>
<form action="{{ route('customer.logout') }}" method="POST">
    @csrf
    <button type="submit">Wyloguj się</button>
</form>
<script>
    function updateDateTime() {
        const now = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false,
            timeZone: 'Europe/Warsaw'
        };
        const formattedDateTime = now.toLocaleString('pl-PL', options);
        document.getElementById('datetime').textContent = formattedDateTime;
    }

    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>
</body>
</html>
