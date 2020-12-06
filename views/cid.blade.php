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
            This is <strong>{{$title}}</strong> management page. You can search, create a new one, edit or delete customer here.
        </p>
        <hr />
        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                <!-- form messages here -->
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
                        @if($admin)
                        <div class="float-right">
                            <button class="btn btn-info" style="border-radius: 20px;" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i>
                                Add CID
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- End of search -->

                <div class="table-responsive">
                    @if($cid)
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">CID / Nojar Data</th>
                        <th class="text-center">Service Name</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Rack Location</th>
                        <th class="text-center">Unit Location</th>
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
                            <td class="text-center">{{$c['u_location']}}</td>
                            <td class="text-center">{{$c['created_at']}}</td>
                            <td class="text-center"><button class="btn btn-info" data-toggle="modal" data-target="#viewModal" data-id="{!! $c['id'] !!}" data-cid="{!! $c['cid'] !!}" data-service-name="{!! $c['service_name'] !!}" data-customer-name="{!! $c['customer_name'] !!}" data-location="{!! $c['location'] !!}" data-rack-location="{!! $c['rack_location'] !!}" data-u-location="{!! $c['u_location'] !!}"><span class="small"><i class="fas fa-eye"></i> View</span></button></td>
                            @if($admin)
                            <td class="text-center"><button class="btn btn-warning text-light" data-toggle="modal" data-target="#editModal" data-id="{!! $c['id'] !!}" data-cid="{!! $c['cid'] !!}" data-service-name="{!! $c['service_name'] !!}" data-customer-name="{!! $c['customer_name'] !!}" data-location="{!! $c['location'] !!}" data-rack-location="{!! $c['rack_location'] !!}" data-u-location="{!! $c['u_location'] !!}"><span class="small"><i class="fas fa-edit"></i> Edit</span></button></td>
                            <td class="text-center"><button class="btn btn-danger" data-toggle="modal" data-target="#removeModal" data-id="{!! $c['id'] !!}" data-cid="{!! $c['cid'] !!}" data-service-name="{!! $c['service_name'] !!}" data-customer-name="{!! $c['customer_name'] !!}" data-location="{!! $c['location'] !!}" data-rack-location="{!! $c['rack_location'] !!}" data-u-location="{!! $c['u_location'] !!}"><span class="small"><i class="fas fa-trash"></i> Remove</span></button></td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">CID / Nojar Data</th>
                        <th class="text-center">Service Name</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Rack Location</th>
                        <th class="text-center">Unit Location</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Action</th>
                        <tr>
                            <td class="text-center" colspan="9">
                                <h4 class="text-secondary">Data not found :(</h4>
                            </td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('./modals/cid/cid.add.html')
    @include('./modals/cid/cid.edit.html')
    @include('./modals/cid/cid.remove.html')
    @include('./modals/cid/cid.view.html')
    @include('./layout/footer.html')
</body>

</html>