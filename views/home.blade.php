<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
</head>

<body class="d-flex flex-column min-vh-100">
    @include('./layout/navigation.html')
    <div class="py-3"></div>
    <div class="container-fluid py-3">
        <p class="bg-success p-4 text-light" style="border-radius: 3px;">Hello <strong>{{$name}}</strong>, welcome home! Choose one of the menu below, and enjoy the feature of <strong>Madam v.2.0</strong>.</p>
        <hr />
        <div class="py-4"></div>
        <div class="row row-eq-height justify-content-center align-items-center">
            <div class="col-xl-4 p-2">
                <a href="/customers">
                    <div class="card bg-danger">
                        <div class="card-header btn">
                            <h3 class="text-light">Customers</h3>
                        </div>
                        <div class="card-body btn">
                            <h1 class="display-1">
                                <i class="fas fa-file-contract text-light"></i>
                            </h1>
                        </div>
                        <div class="card-footer btn">
                            <p class="text-light">Show customers list, add a new one, edit or remove a customer.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="p-2"></div>

            <div class="col-xl-4 p-2">
                <a href="/cid">
                    <div class="card bg-info">
                        <div class="card-header btn">
                            <h3 class="text-light">CID</h3>
                        </div>
                        <div class="card-body btn">
                            <h1 class="display-1">
                                <i class="fas fa-laptop text-light"></i>
                            </h1>
                        </div>
                        <div class="card-footer btn">
                            <p class="text-light">Show CIDs list, add a new one, edit the CIDs data or remove a CID.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="p-2"></div>

            <div class="col-xl-4 p-2">
                <a href="/access_rights">
                    <div class="card bg-secondary">
                        <div class="card-header btn">
                            <h3 class="text-light">Access Rights</h3>
                        </div>

                        <div class="card-body btn">
                            <h1 class="display-1">
                                <i class="fas fa-key text-light"></i>
                            </h1>
                        </div>
                        <div class="card-footer btn">
                            <p class="text-light">Show Access Rights list.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="p-2"></div>

            <div class="col-xl-4 p-2">
                <a href="/vlan">
                    <div class="card bg-success">
                        <div class="card-header btn">
                            <h3 class="text-light">VLAN Management</h3>
                        </div>

                        <div class="card-body btn">
                            <h1 class="display-1">
                                <i class="fas fa-ethernet text-light"></i>
                            </h1>
                        </div>
                        <div class="card-footer btn">
                            <p class="text-light">Show VLAN list.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="p-2"></div>

            @if($admin)
            <div class="col-xl-4 p-2">
                <a href="/users">
                    <div class="card bg-warning">
                        <div class="card-header btn">
                            <h3 class="text-light">Users Management</h3>
                        </div>
                        <div class="card-body btn">
                            <h1 class="display-1">
                                <i class="fas fa-users text-light"></i>
                            </h1>
                        </div>
                        <div class="card-footer btn">
                            <p class="text-light">Show users list, add a new one, edit the users data or remove a users.</p>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            <div class="p-2"></div>
        </div>
    </div>
    @include('./layout/footer.html')
</body>

</html>