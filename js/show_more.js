
function showMore(elementId) {
    let buttonElementId = 'd' + elementId;

    if (document.getElementById(elementId).style.display == '')
        setNone(elementId, buttonElementId);

    if (document.getElementById(elementId).style.display != 'none')
        setNone(elementId, buttonElementId);
    else {
        document.getElementById(elementId).style.display = 'block';
        document.getElementById(buttonElementId).innerHTML = 'Mniej';
    }
}

function setNone(elementId, buttonElementId) {
    document.getElementById(elementId).style.display = 'none';
    document.getElementById(buttonElementId).innerHTML = 'Więcej';
}