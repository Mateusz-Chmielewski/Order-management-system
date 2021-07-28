function showStateForm(elementId, nameElement) {
    let buttonElementId = 'b' + elementId;

    if (document.getElementById(elementId).style.display == '')
        setNoneState(elementId, buttonElementId, nameElement);

    if (document.getElementById(elementId).style.display != 'none')
        setNoneState(elementId, buttonElementId, nameElement);
    else {
        document.getElementById(elementId).style.display = 'flex';
        document.getElementById(buttonElementId).innerHTML = 'Anuluj';
    }
}

function setNoneState(elementId, buttonElementId, nameElement) {
    document.getElementById(elementId).style.display = 'none';
    document.getElementById(buttonElementId).innerHTML = nameElement;
}