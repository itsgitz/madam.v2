<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
</head>

<body class="d-flex flex-column min-vh-100">
    @include('./layout/navigation.html')
    <div class="container-fluid py-5">
        <p class="bg-success p-4 text-light" style="border-radius: 3px;">
            This is <strong>{{$title}}</strong> management page. You can search, create a new one, edit or delete user here.
        </p>
        <hr />
        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                <!-- Search -->
                <div class="row py-3">
                    <div class="col-6">
                        <form method="POST" action="/users?request=search">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="search" name="key" class="form-control" placeholder="Search users ...">
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <button class="btn btn-info" style="border-radius: 20px;" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i>
                                Add User
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End of search -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Activated</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center" colspan="2">Action</th>
                        @foreach($users as $u)
                        <tr>
                            <td class="text-center">{{$u['id']}}</td>
                            <td class="text-center">{{$u['name']}}</td>
                            <td class="text-center">{{$u['username']}}</td>
                            <td class="text-center">{{$u['email']}}</td>
                            <td class="text-center">{{$u['activated']}}</td>
                            <td class="text-center">{{$u['user_role']}}</td>
                            <td class="text-center">{{$u['created_at']}}</td>
                            <td class="text-center"><button class="btn btn-warning text-light"><span class="small"><i class="fas fa-edit"></i> Edit</span></button></td>
                            <td class="text-center"><button class="btn btn-danger"><span class="small"><i class="fas fa-trash"></i> Remove</span></button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @include('./modals/users/users.add.html')
    @include('./layout/footer.html')
</body>

</html>