<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <h1>Product</h1>
        <ul id="product-list"></ul>
        
        <h2>Create Product</h2>
        <form id="product-form">
            <input type="text" id="product-name" placeholder="Name">
            <input type="date" id="product-release-date" placeholder="Release Date">
            <input type="text" id="product-description" placeholder="Description">
            <input type="number" id="product-price" placeholder="Price">
            <button type="button" onclick="createProduct()">Create</button>
        </form>

        <h2>Update Product</h2>
        <form id="update-form">
            <input type="hidden" id="update-product-id">
            <input type="text" id="update-product-name" placeholder="Name">
            <input type="date" id="update-product-release-date" placeholder="Release Date">
            <input type="text" id="update-product-description" placeholder="Description">
            <input type="number" id="update-product-price" placeholder="Price">
            <button type="button" onclick="updateProduct()">Update</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchProducts();
        });

        function fetchProducts() {
            axios.get('/api/products')
                .then(response => {
                    const products = response.data;
                    const productList = document.getElementById('product-list');
                    productList.innerHTML = '';
                    products.forEach(product => {
                        const li = document.createElement('li');
                        li.textContent = `${product.name} - ${product.release_date}`;
                        li.onclick = () => editProduct(product);
                        productList.appendChild(li);
                    });
                })
                .catch(error => console.error(error));
        }

        function createProduct() {
            const name = document.getElementById('product-name').value;
            const release_date = document.getElementById('product-release-date').value;
            const description = document.getElementById('product-description').value;
            const price = document.getElementById('product-price').value;

            axios.post('/api/products', {
                name,
                release_date,
                description,
                price
            }).then(response => {
                fetchProducts();
                document.getElementById('product-form').reset();
            }).catch(error => console.error(error));
        }

        function editProduct(product) {
            document.getElementById('update-product-id').value = product.id;
            document.getElementById('update-product-name').value = product.name;
            document.getElementById('update-product-release-date').value = product.release_date;
            document.getElementById('update-product-description').value = product.description;
            document.getElementById('update-product-price').value = product.price;
        }

        function updateProduct() {
            const id = document.getElementById('update-product-id').value;
            const name = document.getElementById('update-product-name').value;
            const release_date = document.getElementById('update-product-release-date').value;
            const description = document.getElementById('update-product-description').value;
            const price = document.getElementById('update-product-price').value;

            axios.put(`/api/products/${id}`, {
                name,
                release_date,
                description,
                price
            }).then(response => {
                fetchProducts();
                document.getElementById('update-form').reset();
            }).catch(error => console.error(error));
        }
        
        function deleteProduct(id) {
            axios.delete(`/api/products/${id}`)
                .then(response => {
                    fetchProducts();
                })
                .catch(error => console.error(error));
        }
    </script>
</body>
</html>
