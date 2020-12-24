$(function() {
    let removeModal = $('#removeModal'),
        vlanGroupName = $('#vlanGroupName'),
        vlanGroupId = $('#vlanGroupId'),
        vlanGroupSite = $('#vlanGroupSite');

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
});