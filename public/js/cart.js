document.addEventListener('DOMContentLoaded', function () {

    calculateTotal();

    let home = localStorage.getItem('current_id');
    if (home) {
        document.getElementById('home').href = '/customer/' + home;
    }

    document.getElementById('user_id').value = home;
});

document.getElementById('province').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var shippingFee = parseFloat(selectedOption.getAttribute('data-fee')) || 0;
    
    document.getElementById('shipping').value = shippingFee.toFixed(2);
    
    calculateTotal();
});

function calculateTotal() {
    var subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
    var shippingFee = parseFloat(document.getElementById('shipping').value) || 0;
    
    var totalAmount = subtotal + shippingFee;
    
    document.getElementById('total_amount').value = totalAmount.toFixed(2);
}
