<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Prize</title>
</head>
<body>
    <p>You are get {{ $prize->getCount() }} {{ $prize->getName() ?? $prize->getType() }}</p>

    <form method="POST" action="{{ route('prize.refuse') }}">
        @csrf
        <input name="id" hidden value="{{ $prize->getId() }}">
        <p><input type="submit" value="Refuse" ></p>
    </form>
</body>
</html>
