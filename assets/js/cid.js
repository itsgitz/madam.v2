$(function() {
    let viewModal = $('#viewModal'),
        editModal = $('#editModal'),
        removeModal = $('#removeModal');

    let viewCid = $('#viewCid'),
        viewServiceName = $('#viewServiceName'),
        viewCustomerName = $('#viewCustomerName'),
        viewLocation = $('#viewLocation'),
        viewRackLocation = $('#viewRackLocation'),
        viewUnitLocation = $('#viewUnitLocation');
    
    let editId = $('#editId'),
        editCid = $('#editCid'),
        editServiceName = $('#editServiceName'),
        editCustomerName = $('#editCustomerName'),
        editLocation = $('#editLocation'),
        editRackLocation = $('#editRackLocation'),
        editUnitLocation = $('#editUnitLocation');

    viewModal.on('show.bs.modal', function(e) {
        let cid = $(e.relatedTarget).data('cid'),
            serviceName = $(e.relatedTarget).data('service-name'),
            customerName = $(e.relatedTarget).data('customer-name'),
            location = $(e.relatedTarget).data('location'),
            rackLocation = $(e.relatedTarget).data('rack-location'),
            unitLocation = $(e.relatedTarget).data('u-location');

        viewCid.val(cid);
        viewServiceName.val(serviceName);
        viewCustomerName.val(customerName);
        viewLocation.val(location);
        viewRackLocation.val(rackLocation);
        viewUnitLocation.val(unitLocation);
    });

    editModal.on('show.bs.modal', function(e) {
        let id = $(e.relatedTarget).data('id'),
            cid = $(e.relatedTarget).data('cid'),
            serviceName = $(e.relatedTarget).data('service-name'),
            customerName = $(e.relatedTarget).data('customer-name'),
            location = $(e.relatedTarget).data('location'),
            rackLocation = $(e.relatedTarget).data('rack-location'),
            unitLocation = $(e.relatedTarget).data('u-location');

        editId.val(id);
        editCid.val(cid);
        editServiceName.val(serviceName);
        editCustomerName.val(customerName);
        editLocation.val(location);
        editRackLocation.val(rackLocation);
        editUnitLocation.val(unitLocation);
    });

    removeModal.on('show.bs.modal', function(e) {

    });
});