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
                                <input type="search" name="key" class="form-control" placeholder="Search access rights ...">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End of search -->

                <div class="table-responsive">
                    @if($access_rights)
                    <table class="table table-hover">
                        <th class="text-center">ID</th>
                        <th class="text-center">Customer ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Company Name</th>
                        <th class="text-center">Identity Number</th>
                        <th class="text-center">E-mail Address</th>
                        @foreach($access_rights as $ac)
                        <tr>
                            <td class="text-center">{{$ac['id']}}</td>
                            <td class="text-center">{{$ac['customer_id']}}</td>
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
                            <td class="text-center" colspan="6"><h4 class="text-secondary">Data not found :(</h4></td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>