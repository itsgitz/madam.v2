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
                    <div class="col-sm-6 py-3">
                        <div class="card bg-warning text-light">
                            <div class="card-body" data-toggle="tooltip" title="Customers">
                                <h3><i class="fas fa-money-check"></i> Total Customers: {{$total_customers}}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Total cids -->
                    <div class="col-sm-6 py-3">
                        <div class="card bg-danger text-light">
                            <div class="card-body" data-toggle="tooltip" title="CID">
                            <h3><i class="fas fa-money-check"></i> Total CID: {{$total_cid}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-5"></div>
                <div class="row">
                    <div class="col-sm-4">
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
                    <div class="col-sm-6">
                        <!-- <div class="chart-container" style="position: relative; margin: auto; height: 80vh; width: 80vw;">
                            <canvas id="customerSegmentationChart"></canvas>
                        </div> -->
                        <!-- <div class="chart-container" style="width: 600; height: 250;">
                            <canvas id="customerSegmentationChart"></canvas>
                        </div> -->
                        <canvas id="customerSegmentationChart" class="my-4 chartjs-render-monitor" width="500" height="500" style="display: block; width: 500px; height: 500px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>