function printOrder() {
    document.getElementById('showPanel').style.display = 'none';
    window.print();
    document.getElementById('showPanel').style.display = 'flex';

}