$(function() {
    let statusApprovedElement = $('#status'),
        statusApprovedData = statusApprovedElement.data('status'),
        backButton = $('#backButton');

    // set default value
    statusApprovedElement.val(statusApprovedData);
    backButton.click(function(e) {
        e.preventDefault();
        window.history.back();
    });
});