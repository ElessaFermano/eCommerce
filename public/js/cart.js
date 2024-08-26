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

// Handle form submission
// document.querySelector('.submit-button').addEventListener('click', function(e) {
//     e.preventDefault();

//     let formData = {
//         user_id: document.querySelector('input[name="user_id"]').value,
//         subtotal: document.querySelector('input[name="subtotal"]').value,
//         shipping_fee: document.querySelector('input[name="shipping_fee"]').value,
//         total_amount: document.querySelector('input[name="total_amount"]').value,
//         shipping_address: {
//             country: document.querySelector('input[name="country"]').value,
//             province: document.querySelector('select[name="province"]').value,
//             city: document.querySelector('input[name="city"]').value,
//             barangay: document.querySelector('input[name="barangay"]').value,
//             zipcode: document.querySelector('input[name="zipcode"]').value,
//         },
//         payment_method: document.querySelector('select[name="payment_method"]').value,
//     };

//     fetch("/api/orders", {
//         method: "POST",
//         headers: {
//             Accept : "application/json",
//             "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//         },
//         body: JSON.stringify(formData),
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);
//         if (data && data.message) {
//             alert(data.message);
//             window.location.href = "/"; // Redirect to welcome page
//         } else if (data && data.error) {
//             alert('Error: ' + data.error);
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('An unexpected error occurred. Please try again later.');
//     });
// });
