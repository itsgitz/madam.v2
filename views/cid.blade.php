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
            This is <strong>{{$title}}</strong> management page. You can search, create a new one, edit or delete customer here.
        </p>
        <hr />
        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">

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

                <div class="table-responsive">
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">CID / Nojar Data</th>
                        <th class="text-center">Service Name</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Rack Location</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center" colspan="3">Action</th>
                        @foreach($cid as $c)
                        <tr>
                            <td class="text-center">{{$c['id']}}</td>
                            <td class="text-center">{{$c['cid']}}</td>
                            <td class="text-center">{{$c['service_name']}}</td>
                            <td class="text-center">{{$c['customer_name']}}</td>
                            <td class="text-center">{{$c['location']}}</td>
                            <td class="text-center">{{$c['rack_location']}}</td>
                            <td class="text-center">{{$c['created_at']}}</td>
                            <td class="text-center"><button class="btn btn-info"><span class="small"><i class="fas fa-eye"></i> View</span></button></td>
                            @if($admin)
                            <td class="text-center"><button class="btn btn-warning text-light"><span class="small"><i class="fas fa-edit"></i> Edit</span></button></td>
                            <td class="text-center"><button class="btn btn-danger"><span class="small"><i class="fas fa-trash"></i> Remove</span></button></td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('./layout/footer.html')
</body>

</html>