function showConfirmDelete(elementId) {
    let buttonElementId = 'b' + elementId;

    if (document.getElementById(elementId).style.display == '')
        setNoneDelete(elementId, buttonElementId);

    if (document.getElementById(elementId).style.display != 'none')
        setNoneDelete(elementId, buttonElementId);
    else {
        document.getElementById(elementId).style.display = 'flex';
        document.getElementById(buttonElementId).innerHTML = 'Anuluj';
    }
}

function setNoneDelete(elementId, buttonElementId) {
    document.getElementById(elementId).style.display = 'none';
    document.getElementById(buttonElementId).innerHTML = 'Usuń';
}