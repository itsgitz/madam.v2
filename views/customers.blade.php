<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')

    <!-- customers script -->
    <script src="/assets/js/customers.js"></script>
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
                <!-- error message -->
                @if($error_message)
                <div class="alert alert-danger alert-dismissible fade show">
                    <button class="close" data-dismiss="alert" type="button">&times;</button>
                    {{$error_message}}
                </div>
                @endif

                <!-- success message -->
                @if($success_message)
                <div class="alert alert-success alert-dismissible fade show">
                    <button class="close" data-dismiss="alert" type="button">&times;</button>
                    {{$success_message}}
                </div>
                @endif

                <!-- Search -->
                <div class="row py-3">
                    <div class="col-6">
                        <form method="POST" action="/customers?request=search">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="search" name="key" class="form-control" placeholder="Search customers ...">
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <button class="btn btn-info" style="border-radius: 20px;" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i>
                                Add Customer
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End of search -->

                <div class="table-responsive">
                    @if($customers)
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Sales Name</th>
                        <th class="text-center">Segmentation</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center" colspan="3">Action</th>
                        @foreach($customers as $c)
                        <tr>
                            <td class="text-center">{{$c['id']}}</td>
                            <td class="text-center">{{$c['customer_name']}}</td>
                            <td class="text-center">{{$c['sales_name']}}</td>
                            <td class="text-center">{{$c['segmentation']}}</td>
                            <td class="text-center">{{$c['created_at']}}</td>
                            <td class="text-center"><button id="viewBtn" class="btn btn-info" data-toggle="modal" data-target="#viewModal" data-customer-id="{!! $c['id'] !!}" data-customer-name="{!! $c['customer_name'] !!}" data-sales-name="{!! $c['sales_name'] !!}" data-segmentation="{!! $c['segmentation'] !!}"><span class="small"><i class="fas fa-eye"></i> View</span></button></td>
                            @if($admin)
                            <td class="text-center">
                                <button id="editBtn" class="btn btn-warning text-light" data-toggle="modal" data-target="#editModal" data-customer-id="{!! $c['id'] !!}" data-customer-name="{!! $c['customer_name'] !!}" data-sales-name="{!! $c['sales_name'] !!}" data-segmentation="{!! $c['segmentation'] !!}"><span class="small"><i class="fas fa-edit"></i> Edit</span></button>
                            </td>
                            <td class="text-center">
                                <button id="removeBtn" class="btn btn-danger" data-toggle="modal" data-target="#removeModal" data-customer-id="{!! $c['id'] !!}" data-customer-name="{!! $c['customer_name'] !!}" data-sales-name="{!! $c['sales_name'] !!}">
                                    <span class="small"><i class="fas fa-trash"></i> Remove</span>
                                </button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Sales Name</th>
                        <th class="text-center">Segmentation</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Action</th>
                        <tr>
                            <td class="text-center" colspan="6"><h4 class="text-secondary">Data not found :(</h4></td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('./modals/customers/customers.add.html')
    @include('./modals/customers/customers.view.html')
    @include('./modals/customers/customers.edit.html')
    @include('./modals/customers/customers.remove.html')

    <!-- Footer -->
    @include('./layout/footer.html')
</body>

</html>