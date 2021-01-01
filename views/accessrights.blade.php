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
                        <form method="POST" action="/access_rights?request=search">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="search" name="key" class="form-control" placeholder="Search access rights ...">
                            </div>
                        </form>

                        @if($search)
                        <div>
                            <a href="/access_rights">View All Data</a>
                        </div>
                        @endif
                    </div>

                    <div class="col-6">
                        <div class="float-right">
                            <a class="btn btn-success" href="?action=export_to_excel"><i class="fas fa-file-export"></i> Export to Excel</a>
                            <a class="btn btn-danger" href="?action=export_to_pdf"><i class="fas fa-file-export"></i> Export to PDF</a>
                        </div>

                    </div>
                </div>
                <!-- End of search -->

                <div class="py-2 text-secondary">
                    <p><i><b>*Note</b>: export functions on this page only used for exports all data. Please use export feature from <a href="/customers">Customers</a> menu for export the specific data.</i></p>
                </div>

                <div class="table-responsive">
                    @if($access_rights)
                    <table class="table table-hover">
                        <!-- <th class="text-center">ID</th>
                        <th class="text-center">Customer ID</th> -->
                        <th class="text-center">Name</th>
                        <th class="text-center">Company Name</th>
                        <th class="text-center">Identity Number</th>
                        <th class="text-center">E-mail Address</th>
                        @foreach($access_rights as $ac)
                        <tr>
                            <!-- <td class="text-center">{{$ac['id']}}</td>
                            <td class="text-center">{{$ac['customer_id']}}</td> -->
                            <td class="text-center">{{$ac['name']}}</td>
                            <td class="text-center">{{$ac['company_name']}}</td>
                            <td class="text-center">{{$ac['identity_number']}}</td>
                            <td class="text-center">{{$ac['email']}}</td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">Customer ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Company Name</th>
                        <th class="text-center">Identity Number</th>
                        <th class="text-center">E-mail Address</th>
                        <tr>
                            <td class="text-center" colspan="6">
                                <h4 class="text-secondary">Data not found :(</h4>
                            </td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>