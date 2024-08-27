document.addEventListener('DOMContentLoaded', function () {
    // Initialize total calculation on page load
    calculateTotal();

    // Handle home link click if 'current_id' is present
    let home = localStorage.getItem('current_id');
    if (home) {
        document.getElementById('home').href = '/customer/' + home;
    }

    document.getElementById('user_id').value = home;
});

// Handle province change to update shipping fee and total amount
document.getElementById('province').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var shippingFee = parseFloat(selectedOption.getAttribute('data-fee')) || 0;
    
    // Update the shipping fee display
    document.getElementById('shipping').value = shippingFee.toFixed(2);
    
    // Calculate total amount
    calculateTotal();
});

function calculateTotal() {
    var subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
    var shippingFee = parseFloat(document.getElementById('shipping').value) || 0;
    
    var totalAmount = subtotal + shippingFee;
    
    // Update the total amount display
    document.getElementById('total_amount').value = totalAmount.toFixed(2);
}
