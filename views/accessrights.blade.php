<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
    <script src="/assets/js/cid.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    @include('./layout/navigation.html')
    <div class="container-fluid py-5">
        <p class="bg-success p-4 text-light" style="border-radius: 3px;">
            This is <strong>{{$title}}</strong> management page. You can search, create a new one, edit or delete customer access rights here.
        </p>
        <hr />
        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                @include('./layout/messages.html')
                <!-- Search -->
                <div class="row py-3">
                    <div class="col-6">
                        <form method="POST" action="/cid?request=search">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="search" name="key" class="form-control" placeholder="Search cid ...">
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <button class="btn btn-info" style="border-radius: 20px;" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i>
                                Add CID
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End of search -->
            </div>
        </div>
    </div>
</body>