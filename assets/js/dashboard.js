$(function () {

    fetchCustomerSegmentationsData();

});

function fetchCustomerSegmentationsData() {
    let url = "/dashboard?request_type=json";

    $.get(url, function (res) {
        console.log(res);

        setChart(res);
    });
}

function setChart(res) {
    let label = [],
        data = [];

    res.forEach(function (v, k) {
        label[k] = v.name
        data[k] = v.total
    });

    // get canvas for chart id
    let ctx = $('#customerSegmentationChart'),
        myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: label,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#1abc9c',
                        '#3498db',
                        '#9b59b6',
                        '#34495e',
                        '#e67e22',
                        '#95a5a6',
                        '#c0392b',
                        '#d35400',
                        '#f1c40f',
                        '#7f8c8d',
                    ],
                    borderWidth: 1
                }]
            },
            options: {

            }
        });
}

