<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container py-5">
        <div class="container py-5">
            <div class="row justify-content-center align-self-center">
                <div class="col-sm-6">
                    <div class="py-3">
                        <h1 class="text-secondary text-center">{{$title}}</h1>
                    </div>
                    @if($error_message)
                    <div class="mx-auto">
                        <p class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{$error_message}}
                        </p>
                    </div>
                    @endif
                    <form class="py-3" method="POST" action="/login">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input id="username" class="form-control" type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input id="password" class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <input class="btn btn-primary form-control" type="submit" name="login" value="Login">
                    </form>
                    <div class="py-4">
                        <p class="text-secondary">Forgot password? Please contact administrator.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('./layout/footer.html')
</body>

</html>