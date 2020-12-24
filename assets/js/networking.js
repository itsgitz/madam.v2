$(function() {
    let removeModal = $('#removeModal'),
        editModal = $('#editModal'),
        vlanGroupName = $('#vlanGroupName'),
        vlanGroupId = $('#vlanGroupId'),
        vlanGroupSite = $('#vlanGroupSite'),
        vlanGroupIdEdit = $('#vlanGroupIdEdit'),
        vlanGroupNameEdit = $('#vlanGroupNameEdit'),
        vlanGroupSiteEdit = $('#vlanGroupSiteEdit');

    removeModal.on('show.bs.modal', function (e) {
        let id = $(e.relatedTarget).data('id'),
            name = $(e.relatedTarget).data('name'),
            site = $(e.relatedTarget).data('site');

        console.warn('vlanGroupId:', id);
        console.warn('vlanGroupName:', name);
        console.warn('vlanGroupSite:', site);

        vlanGroupId.val(id)
        vlanGroupName.text(name)
        vlanGroupSite.text(site)
    });

    editModal.on('show.bs.modal', function (e) {
        let id = $(e.relatedTarget).data('id'),
            name = $(e.relatedTarget).data('name'),
            site = $(e.relatedTarget).data('site');

        console.warn('vlanGroupIdEdit:', id)
        console.warn('vlanGroupNameEdit:', name)
        console.warn('vlanGroupSiteEdit', site)

        vlanGroupIdEdit.val(id)
        vlanGroupNameEdit.val(name)
        vlanGroupSiteEdit.val(site)
    });
});