<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Raffle Prize</title>
</head>
<body>
<form method="GET" action="{{ route('get.ruffle.prize') }}">
    @csrf
    <p><input type="submit" value="Get Prize"></p>
</form>
</body>
</html>
