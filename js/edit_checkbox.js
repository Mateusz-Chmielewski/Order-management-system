function check() {
   if (!document.getElementById('editCustomer').checked) {
        
        document.getElementById('orderFirstName').readOnly = true;
        document.getElementById('orderLastName').readOnly = true;
        document.getElementById('orderPhone').readOnly = true;
        document.getElementById('orderMail').readOnly = true;
    } else {
        
        document.getElementById('orderFirstName').readOnly = false;
        document.getElementById('orderLastName').readOnly = false;
        document.getElementById('orderPhone').readOnly = false;
        document.getElementById('orderMail').readOnly = false;
    }
}