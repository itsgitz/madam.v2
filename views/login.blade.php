<!DOCTYPE html>
<html>
    <head>
        <title>{{$title}}</title>
    </head>
    <body>
        <h1>{{$title}}</h1>
        <h3>{{$error_message}}</h3>
        <form method="POST" action="/login">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="submit" name="login" value="Login">
        </form>
    </body>
</html>