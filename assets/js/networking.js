$(function () {
    vlanGroup();

    vlanSite();
});

function vlanGroup() {
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
}

function vlanSite() {
    let removeVlanModal = $('#removeVlanModal'),
        vlanId = $('#vlanId'),
        vlanVlanId = $('#vlanVlanId'),
        vlanPrefixes = $('#vlanPrefixes'),
        vlanTenant = $('#vlanTenant'),
        vlanStatus = $('#vlanStatus'),
        vlanRole = $('#vlanRole');

    let editVlanModal = $('#editVlanModal'),
        vlanIdEdit = $('#vlanIdEdit'),
        vlanVlanIdEdit = $('#vlanVlanIdEdit'),
        vlanPrefixesEdit = $('#vlanPrefixesEdit'),
        vlanTenantEdit = $('#vlanTenantEdit'),
        vlanStatusEdit = $('#vlanStatusEdit'),
        vlanRoleEdit = $('#vlanRoleEdit'),
        vlanDescriptionEdit = $('#vlanDescriptionEdit');

    removeVlanModal.on('show.bs.modal', function (e) {
        let idData = $(e.relatedTarget).data('id'),
            vlanIdData = $(e.relatedTarget).data('vlan-id'),
            prefixesData = $(e.relatedTarget).data('prefixes'),
            tenantData = $(e.relatedTarget).data('tenant'),
            statusData = $(e.relatedTarget).data('status'),
            roleData = $(e.relatedTarget).data('role');

        console.log('id:', idData, 'vlanId:', vlanIdData, 'prefixes:', prefixesData, 'tenant:', tenantData, 'status:', statusData, 'role:', roleData);

        vlanId.val(idData)
        vlanVlanId.text(vlanIdData)
        vlanPrefixes.text(prefixesData)
        vlanTenant.text(tenantData)
        vlanStatus.text(statusData)
        vlanRole.text(roleData)
    });

    editVlanModal.on('show.bs.modal', function (e) {
        let idData = $(e.relatedTarget).data('id'),
            vlanIdData = $(e.relatedTarget).data('vlan-id'),
            prefixesData = $(e.relatedTarget).data('prefixes'),
            tenantData = $(e.relatedTarget).data('tenant'),
            statusData = $(e.relatedTarget).data('status'),
            roleData = $(e.relatedTarget).data('role'),
            descriptionData = $(e.relatedTarget).data('description');

        console.log('id:', idData, 'vlanId:', vlanIdData, 'prefixes:', prefixesData, 'tenant:', tenantData, 'status:', statusData, 'role:', roleData, 'description:', descriptionData);
        
        vlanIdEdit.val(idData)
        vlanVlanIdEdit.val(vlanIdData)
        vlanPrefixesEdit.val(prefixesData)
        vlanTenantEdit.val(tenantData)
        vlanStatusEdit.val(statusData)
        vlanRoleEdit.val(roleData)
        vlanDescriptionEdit.val(descriptionData)
    });
}