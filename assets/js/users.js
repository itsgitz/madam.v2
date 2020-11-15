$(function() {
    /**
     * Modals
     */
    let removeModal = $('#removeModal'),
        editModal = $('#editModal');

    /**
     * Input form-control
     */
    let userNameValue = $('#userNameValue'),
        nameValue = $('#nameValue'),
        userIdValue = $('#userIdValue');

    let editUserName = $('#editUserName'),
        editName = $('#editName'),
        editPassword = $('#editPassword'),
        editEmail = $('#editEmail'),
        editStatus = $('#editStatus'),
        editRole = $('#editRole'),
        editUserId = $('#editUserId');

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
        let userId = $(e.relatedTarget).data('id'),
            name = $(e.relatedTarget).data('name'),
            userName = $(e.relatedTarget).data('username'),
            email = $(e.relatedTarget).data('email'),
            status = $(e.relatedTarget).data('activated'),
            role = $(e.relatedTarget).data('user-role');

        console.warn(userId, name, userName, status, role);

        editUserId.val(userId);
        editUserName.val(userName);
        editName.val(name);
        editEmail.val(email);
        editStatus.val(status);
        editRole.val(role);
    });
});