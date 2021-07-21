function showStateForm(elementId) {
    let buttonElementId = 'b' + elementId;

    if (document.getElementById(elementId).style.display == '')
        setNoneState(elementId, buttonElementId);

    if (document.getElementById(elementId).style.display != 'none')
        setNoneState(elementId, buttonElementId);
    else {
        document.getElementById(elementId).style.display = 'flex';
        document.getElementById(buttonElementId).innerHTML = 'Anuluj';
    }
}

function setNoneState(elementId, buttonElementId) {
    document.getElementById(elementId).style.display = 'none';
    document.getElementById(buttonElementId).innerHTML = 'Status';
}