<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
    <script src="/assets/js/networking.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    @include('./layout/navigation.html')
    <div class="container-fluid py-5">
        <p class="bg-success p-4 text-light" style="border-radius: 3px;">
            This is <strong>{{$title}}</strong> page. You can search, create a new one, edit or delete VLAN Site here.
        </p>
        <hr />

        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                @include('./layout/messages.html')
                <div class="row py-3">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="float-right">
                            <button class="btn btn-info" style="border-radius: 20px;" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i>
                                Add VLAN
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if($vlan)
                    @else
                    <table class="table table-hover">
                        <th class="text-center">VLAN ID</th>
                        <th class="text-center">Prefixes</th>
                        <th class="text-center">Tenant</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Action</th>
                        <tr class="text-center">
                            <td class="text-center" colspan="7">
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

</html>