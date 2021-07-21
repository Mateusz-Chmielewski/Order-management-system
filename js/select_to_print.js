function check(elementID) {
    if (document.getElementById(elementID).checked) {
        document.getElementById('d' + elementID).style.display = 'block';
    } else {
        document.getElementById('d' + elementID).style.display = 'none';
    }
}