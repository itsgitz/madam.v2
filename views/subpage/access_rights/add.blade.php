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
                <h3 class="py-4">Add Access Rights for <strong>{{$customer_name}}</strong></h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="name"><b>Name</b></label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Customer or person name ..." required>
                    </div>
                    <div class="form-group">
                        <label for="companyName"><b>Company Name</b></label>
                        <input id="companyName" class="form-control" type="text" name="company_name" value="{!! $customer_name !!}" disabled>
                        <input type="hidden" name="company_name" value="{!! $customer_name !!}">
                    </div>
                    <div class="form-group">
                        <label for="identityNumber"><b>Identity Number (KTP/Passport/KITAS)</b></label>
                        <input id="identityNumber" class="form-control" type="text" name="identity_number" placeholder="Identity number ..." required>
                    </div>
                    <div class="form-group">
                        <label for="email"><b>E-mail Address</b></label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="E-mail address ..." required>
                    </div>
                    <div class="form-group">
                        <label for="status"><b>Status</b></label>
                        <select id="status" class="custom-select" name="status" required>
                            <option value="Approved">Approved</option>
                            <option value="Not Apptoved">Not Approved</option>
                        </select>
                    </div>
                    <input class="btn btn-primary form-control" type="submit" value="Add">
                </form>
            </div>
        </div>
    </div>
</body>