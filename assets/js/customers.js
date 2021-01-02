$(function () {
    /**
     * Modals
     */
    let removeModal = $('#removeModal');
    let viewModal = $('#viewModal');
    let editModal = $('#editModal');

    /**
     * Input form-control
     */
    let customerNameValue = $('#customerNameValue');
    let salesNameValue = $('#salesNameValue');
    let customerIdValue = $('#customerIdValue');

    let viewId = $('#viewId');
    let viewCustomerName = $('#viewCustomerName');
    let viewSalesName = $('#viewSalesName');
    let viewSegmentation = $('#viewSegmentation');

    let editCustomerId = $('#editCustomerId');
    let editCustomerName = $('#editCustomerName');
    let editSalesName = $('#editSalesName');
    let editSegmentation = $('#editSegmentation');

    let accessRightsTable = $('#accessRightsTable');
    let accessRightsAddLink = $('#accessRightsAddLink');
    let exportToExcel = $('#exportToExcel');
    let exportToPdf = $('#exportToPdf');

    /**
     * View modal on click
     */
    viewModal.on('show.bs.modal', function (e) {
        let customerId = $(e.relatedTarget).data('customer-id')
        let customerName = $(e.relatedTarget).data('customer-name');
        let salesName = $(e.relatedTarget).data('sales-name');
        let segmentation = $(e.relatedTarget).data('segmentation');
        let isAdmin = $(e.relatedTarget).data('is-admin');
        let dataTable = '';

        if (isAdmin) {
            console.warn('is admin?', isAdmin);
        }

        viewId.val(customerId);
        viewCustomerName.val(customerName);
        viewSalesName.val(salesName);
        viewSegmentation.val(segmentation);

        let accessRightsUrl = 'http://' + window.location.host + '/access_rights?customer_id=' + customerId + '&request_type=json&action=api';
        console.warn(accessRightsUrl);

        let accessRightsAddHref = 'http://' + window.location.host + '/access_rights?customer_id=' + customerId + '&action=add';
        let accessRightsExportToExcelHref = 'http://' + window.location.host + '/customers?customer_id=' + customerId + '&action=export_to_excel';
        let accessRightsExportToExcelPdf = 'http://' + window.location.host + '/customers?customer_id=' + customerId + '&action=export_to_pdf';

        console.warn('send request to:', accessRightsUrl);
        $.get(accessRightsUrl, function (data) {
            console.warn(data);
            console.warn(data.length);

            let dataLength = data.length;

            if (data.status != 404) {

                dataTable += '<table class="table">'
                dataTable += '  <th class="text-center">Name</th>'
                dataTable += '  <th class="text-center">Company Name</th>'
                dataTable += '  <th class="text-center">Identity Number</th>'
                dataTable += '  <th class="text-center">Email</th>'
                dataTable += '  <th class="text-center">Status</th>'
                if (isAdmin) {
                    dataTable += '  <th class="text-center" colspan="2">Action</th>'
                }

                for (let i = 0; i < dataLength; i++) {
                    let accessRightsEditHref = 'http://' + window.location.host + '/access_rights?id=' + data[i].id + '&action=edit',
                        accessRightsRemoveHref = 'http://' + window.location.host + '/access_rights?id=' + data[i].id + '&action=remove';

                    let statusClassName = '';

                    if (data[i].status == "Approved") {
                        statusClassName = 'text-success';
                    } else {
                        statusClassName = 'text-danger';
                    }

                    dataTable += '  <tr>'
                    dataTable += '      <td class="text-center">' + data[i].name + '</td>'
                    dataTable += '      <td class="text-center">' + data[i].company_name + '</td>'
                    dataTable += '      <td class="text-center">' + data[i].identity_number + '</td>'
                    dataTable += '      <td class="text-center">' + data[i].email + '</td>'
                    dataTable += '      <td class="text-center text-white ' + statusClassName + '">' + data[i].status + '</td>'

                    if (isAdmin) {
                        dataTable += '      <td class="text-center"><a class="btn btn-warning text-white" href="' + accessRightsEditHref + '"><i class="fas fa-edit"></i> Edit</a></td>'
                        dataTable += '      <td class="text-center"><a class="btn btn-danger" href="' + accessRightsRemoveHref + '"><i class="fas fa-trash"></i> Remove</a></td>'
                    }

                    dataTable += '  </tr>'
                }

                dataTable += '</table>'

                accessRightsTable.html(dataTable);
            } else {
                dataTable += '<table class="table">'
                dataTable += '  <th>Name</th>'
                dataTable += '  <th>Company Name</th>'
                dataTable += '  <th>Identity Number</th>'
                dataTable += '  <th>Email</th>'
                dataTable += '  <th>Status</th>'
                dataTable += '  <th>Action</th>'
                dataTable += '  <tr>'
                dataTable += '      <td class="text-center" colspan="6">Data not found :(</td>'
                dataTable += '  </tr>'
                dataTable += '</table>'

                accessRightsTable.html(dataTable);
            }
        });

        accessRightsAddLink.attr('href', accessRightsAddHref);
        exportToExcel.attr('href', accessRightsExportToExcelHref);
        exportToPdf.attr('href', accessRightsExportToExcelPdf)
    });

    /**
     * Remove modal on click
     */
    removeModal.on('show.bs.modal', function (e) {
        let customerId = $(e.relatedTarget).data('customer-id');
        let customerName = $(e.relatedTarget).data('customer-name');
        let salesName = $(e.relatedTarget).data('sales-name');

        customerNameValue.text(customerName);
        salesNameValue.text(salesName);
        customerIdValue.val(customerId);
    });

    /**
     * Edit modal on click
     */
    editModal.on('show.bs.modal', function (e) {
        let customerId = $(e.relatedTarget).data('customer-id');
        let customerName = $(e.relatedTarget).data('customer-name');
        let salesName = $(e.relatedTarget).data('sales-name');
        let segmentation = $(e.relatedTarget).data('segmentation');

        editCustomerId.val(customerId);
        editCustomerName.val(customerName);
        editSalesName.val(salesName);
        editSegmentation.val(segmentation);
    });
});