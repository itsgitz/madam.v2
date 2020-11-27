<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
    <script src="/assets/js/settings.js"></script>
</head>

</html>

<body class="d-flex flex-column min-vh-100">
    @include('./layout/navigation.html')

    <div class="container-fluid py-5">
        <p class="bg-success p-4 text-light" style="border-radius: 3px;">
            This is <strong>{{$title}}</strong> page. You can edit your name, username, e-mail address, or password.
        </p>
        <hr />

        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                @include('./layout/messages.html')

                <h3 class="py-4">User Settings</h3>

                @if($user)
                <div class="">
                    <form method="POST" action="/settings?request=edit">
                        <div class="form-group">
                            <label for="username"><b>Username</b></label>
                            <input id="username" class="form-control" type="text" name="username" value="{!! $user['username'] !!}" placeholder="Your current username: {!! $user['username'] !!}">
                        </div>
                        <div class="form-group">
                            <label for="name"><b>Name</b></label>
                            <input id="name" class="form-control" type="text" name="name" value="{!! $user['name'] !!}" placeholder="Your current name: {!! $c['name'] !!}">
                        </div>
                        <div class="form-group">
                            <label for="password"><b>Password</b></label>
                            <input id="password" class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="email"><b>E-mail address</b></label>
                            <input id="email" class="form-control" type="email" name="email" value="{!! $user['email'] !!}" placeholder="Your current e-mail address: {!! $user['email'] !!}">
                        </div>
                        <div class="form-group">
                            <label for="status"><b>Activated (status)</b></label>
                            <input id="status" class="form-control" type="text" name="status" value="{!! $user['activated'] !!}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="userRole"><b>User Role</b></label>
                            <select id="userRole" class="custom-select" name="user_role" data-user-role="{!! $user['user_role'] !!}">
                                <option value="Technician">Technician</option>
                                <option value="Administrator">Administrator</option>
                            </select>
                        </div>

                        <input id="user_id" type="hidden" name="id" value="{!! $user['id'] !!}">
                        <input class="btn btn-primary form-control" type="submit" value="Save">
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>