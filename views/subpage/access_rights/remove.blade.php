<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
    <script src="/assets/js/accessRights.js"></script>
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
                <h3 class="py-4">Are you sure want to remove Access Rights for <strong>{{$access_rights['name']}}</strong>?</h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="name"><b>Name</b></label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Customer or person name ..." value="{!! $access_rights['name'] !!}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="companyName"><b>Company Name</b></label>
                        <input id="companyName" class="form-control" type="text" name="company_name" value="{!! $access_rights['company_name'] !!}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="identityNumber"><b>Identity Number (KTP/Passport/KITAS)</b></label>
                        <input id="identityNumber" class="form-control" type="text" name="identity_number" value="{!! $access_rights['identity_number'] !!}" placeholder="Identity number ..." disabled>
                    </div>
                    <div class="form-group">
                        <label for="email"><b>E-mail Address</b></label>
                        <input id="email" class="form-control" type="email" name="email" value="{!! $access_rights['email'] !!}" placeholder="E-mail address ..." disabled>
                    </div>
                    <div class="form-group">
                        <label for="status"><b>Status</b></label>
                        <select id="status" class="custom-select" name="status" data-status="{!! $access_rights['status'] !!}" disabled>
                            <option value="Approved">Approved</option>
                            <option value="Not Approved">Not Approved</option>
                        </select>
                    </div>
                    <input class="btn btn-danger" type="submit" value="Remove">
                    <button id="backButton" class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>