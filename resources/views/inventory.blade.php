@extends('dashboard')
@section('content')

<div class="container">
    <div class="h">
        <h3>INVENTORY</h3>
 
        <div class="table-responsive">
            <table class="table custom-table">
               <thead>
                <tr>
                    <th>id</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Image</th>
                    <th>Stocks</th>
                    <th>Price</th>
                    <th>Supplier</th>
                </tr>
               </thead>
               <tbody id="tBody" >
                 
                   
               </tbody>
            </table>
        </div> 
    </div>

</div>
<script>
    fetch('https://inventorymanagement.online/api/products', {
        method: 'GET',
    }).then(response => response.json())
    .then(response => {
        console.log(response.data);
        let tbody = document.getElementById('tBody');
        tbody.innerHTML = '';

        for(let i = 0; i < response.data.length; i++){
            let row = '<tr>' +
                        '<td>' + response.data[i].id + '</td>' +
                        '<td>' + response.data[i].description + '</td>' +
                        '<td>' + response.data[i].unit + '</td>' +
                        '<td><img src="https://inventorymanagement.online/storage/' + response.data[i].image + '" alt="Product Image" style="width: 50px; height: 50px;"></td>' +
                        '<td>' + response.data[i].quantity + '</td>' +
                        '<td>' + response.data[i].price + '</td>' +
                        '<td>' + response.data[i].supplier_id + '</td>' +
                      '</tr>';

            tbody.innerHTML += row;
        }
    })
function confirmDelete(userId) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to recover this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + userId).submit();
        }
    })
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
