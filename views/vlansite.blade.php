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
            This is <strong>{{$title}}</strong> page. You can search, create a new one, edit or delete VLAN here.
        </p>
        <hr />

        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                @include('./layout/messages.html')
                <div class="row py-3">
                    <div class="col-6">
                        <form method="POST" action="/vlan_site?request=search&id={!! $vlan_group_id !!}&vlan_name={!! $vlan_group_name !!}">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="search" name="key" class="form-control" placeholder="Search VLAN ...">
                            </div>
                        </form>
                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <button class="btn btn-info" style="border-radius: 20px;" data-toggle="modal" data-target="#addVlanModal">
                                <i class="fas fa-plus"></i>
                                Add VLAN
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <h4 class="text-secondary py-4"><strong>{{$vlan_group_name_title}}</strong></h4>
                    @if($vlan)
                    <table class="table table-hover">
                        <th class="text-center">VLAN ID</th>
                        <th class="text-center">Prefixes</th>
                        <th class="text-center">Tenant</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Description</th>
                        <th class="text-center" colspan="2">Action</th>
                        @foreach($vlan as $v)
                        <tr>
                            <td class="text-center">{{$v['vlan_id']}}</td>
                            <td class="text-center">{{$v['prefixes']}}</td>
                            <td class="text-center">{{$v['tenant']}}</td>
                            <td class="text-center"><span class="bg-primary text-light p-2" style="border-radius: 1px;"><strong>{{$v['status']}}</strong></span></td>
                            <td class="text-center">{{$v['role']}}</td>
                            <td class="text-center">{{$v['description']}}</td>
                            <td class="text-center"><button class="btn btn-warning text-light" data-toggle="modal" data-target="#editVlanModal" data-id="{!! $v['id'] !!}" data-vlan-id="{!! $v['vlan_id'] !!}" data-prefixes="{!! $v['prefixes'] !!}" data-tenant="{!! $v['tenant'] !!}" data-status="{!! $v['status'] !!}" data-role="{!! $v['role'] !!}" data-description="{!! $v['description'] !!}"><i class="fas fa-edit"></i> Edit</button></td>
                            <td class="text-center">
                                <button class="btn btn-danger text-light" data-toggle="modal" data-target="#removeVlanModal" data-id="{!! $v['id'] !!}" data-vlan-id="{!! $v['vlan_id'] !!}" data-prefixes="{!! $v['prefixes'] !!}" data-tenant="{!! $v['tenant'] !!}" data-status="{!! $v['status'] !!}" data-role="{!! $v['role'] !!}" data-description="{!! $v['description'] !!}"><i class="fas fa-trash"></i> Remove</button></td>
                        </tr>
                        @endforeach
                    </table>
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

    @include('./modals/networking/vlansite/vlan.add.html')
    @include('./modals/networking/vlansite/vlan.remove.html')
    @include('./modals/networking/vlansite/vlan.edit.html')
    @include('./layout/footer.html')
</body>

</html>