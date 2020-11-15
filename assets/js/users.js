$(function() {
    /**
     * Modals
     */
    let removeModal = $('#removeModal'),
        viewModal = $('#viewModal'),
        editModal = $('#editModal');

    /**
     * Input form-control
     */
    let userNameValue = $('#userNameValue'),
        nameValue = $('#nameValue'),
        userIdValue = $('#userIdValue');

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
        let userId = $(e.relatedTarget).data('user-id'),
            userName = $(e.relatedTarget).data('username'),
            name = $(e.relatedTarget).data('user-name');

        console.warn(userId, userName, name);

        userNameValue.text(userName);
        nameValue.text(name);
        userIdValue.val(userId);
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