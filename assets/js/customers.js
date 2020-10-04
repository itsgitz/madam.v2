$(function() {
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

    let viewCustomerName = $('#viewCustomerName');
    let viewSalesName = $('#viewSalesName');
    let viewSegmentation = $('#viewSegmentation');

    let editCustomerId = $('#editCustomerId');
    let editCustomerName = $('#editCustomerName');
    let editSalesName = $('#editSalesName');
    let editSegmentation = $('#editSegmentation');

    /**
     * View modal on click
     */
    viewModal.on('show.bs.modal', function(e) {
        let customerName = $(e.relatedTarget).data('customer-name');
        let salesName = $(e.relatedTarget).data('sales-name');
        let segmentation = $(e.relatedTarget).data('segmentation');

        viewCustomerName.val(customerName);
        viewSalesName.val(salesName);
        viewSegmentation.val(segmentation);
    });

    /**
     * Remove modal on click
     */
    removeModal.on('show.bs.modal', function(e) {
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
    editModal.on('show.bs.modal', function(e) {
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