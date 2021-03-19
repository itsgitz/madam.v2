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
            This is <strong>{{$title}}</strong> page. You can search, create a new one, edit or delete VLAN Group here.
        </p>
        <hr />
        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                <!-- form messages -->
                @include('./layout/messages.html')
                <div class="row py-3">
                    <div class="col-6">

                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <button class="btn btn-info" style="border-radius: 20px;" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i>
                                Add VLAN Group
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if($vlanGroups)
                    <table class="table table-hover">
                        <!-- <th class="text-center">ID</th> -->
                        <th class="text-center">Name</th>
                        <th class="text-center">Site</th>
                        <th class="text-center">Slug</th>
                        <th class="text-center" colspan="3">Actions</th>
                        @foreach($vlanGroups as $v)
                        <tr>
                            <!-- <td class="text-center">{{$v['id']}}</td> -->
                            <td class="text-center">{{$v['name']}}</td>
                            <td class="text-center">{{$v['site']}}</td>
                            <td class="text-center">{{$v['slug']}}</td>
                            <td class="text-center"><a class="btn btn-success" href="/vlan_site?id={!! $v['id'] !!}&vlan_name={!! $v['slug'] !!}">View</a></td>

                            @if($admin)
                            <td class="text-center"><button id="editBtn" class="btn btn-warning text-light" data-toggle="modal" data-target="#editModal" data-id="{!! $v['id'] !!}" data-name="{!! $v['name'] !!}" data-site="{!! $v['site'] !!}"><span class="small"><i class="fas fa-edit"></i> Edit</span></button></td>
                            <td class="text-center"><button id="removeBtn" class="btn btn-danger" data-toggle="modal" data-target="#removeModal" data-id="{!! $v['id'] !!}" data-name="{!! $v['name'] !!}" data-site="{!! $v['site'] !!}"><span class="small"><i class="fas fa-trash"></i> Remove</span></button></td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <table class="table table-hover">
                        <!-- <th class="text-center">ID</th> -->
                        <th class="text-center">Name</th>
                        <th class="text-center">Site</th>
                        <th class="text-center">Slug</th>
                        <th class="text-center">Actions</th>
                        <tr class="text-center">
                            <td class="text-center" colspan="5">
                                <h4 class="text-secondary">Data not found :(</h4>
                            </td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('./modals/networking/vlangroup/vlangroup.add.html')
    @include('./modals/networking/vlangroup/vlangroup.edit.html')
    @include('./modals/networking/vlangroup/vlangroup.remove.html')
    @include('./layout/footer.html')
</body>

</html>