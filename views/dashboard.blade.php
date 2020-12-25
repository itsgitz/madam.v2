<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    @include('./layout/header.html')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
    <script src="/assets/js/dashboard.js"></script>
</head>

<body class="d-flex flex-column min-hv-100">
    @include('./layout/navigation.html')
    <div class="container-fluid py-5">
        <p class="bg-success p-4 text-light" style="border-radius: 3px;">
            This is <strong>{{$title}}</strong> page. You can view customers segmentation data in chart shape visualization.
        </p>
        <hr />
        <div class="row">
            @include('./layout/sidenav.html')
            <div class="col">
                <div class="card bg-secondary text-light p-3">
                    <h3><b>Customer Segmentation Chart</b></h3>
                </div>
                <div class="py-4"></div>
                <div class="row">
                    <!-- Total customers -->
                    <div class="col">
                        <div class="card bg-warning text-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-money-check display-3"></i>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="card-title"><strong>Total Customers:</strong></h4>
                                        <div class="card-text">
                                            <h4><strong>{{$total_customers}}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total cids -->
                    <div class="col">
                        <div class="card bg-danger text-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fas fa-money-check display-3"></i>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="card-title"><strong>Total CID</strong></h4>
                                        <div class="card-text">
                                            <h4><strong>{{$total_cid}}</strong></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-5"></div>
                <div class="row">
                    <div class="col-3">
                        @if($segmentations)
                        <table id="segmentation-table" class="table table-striped table-sm table-hover">
                            <th>Name</th>
                            <th>Total</th>
                            @foreach($segmentations_table as $s)
                            <tr>
                                <td>{{$s['name']}}</td>
                                <td>{{$s['total']}}</td>
                            </tr>
                            @endforeach
                        </table>
                        @endif
                    </div>
                    <div class="col">
                        <div class="chart-container" style="position: relative; height: 50vh; width: 50vw">
                            <canvas id="customerSegmentationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>