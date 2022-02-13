<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Login</title>
</head>
<body>
<form method="POST" action="{{ route('auth.login') }}">
    @csrf
    <p><b>Auth</b></p>
    <p><input name="email" placeholder="Email"><Br>
        <input name="password" placeholder="Password"><Br>
    <p><input type="submit" value="Login"></p>
</form>
</body>
</html>
