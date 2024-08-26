<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="header">
    @foreach($order as $or)

    <h1>Hello, {{$or->user->first_name}}.Thank You for Your Order!</h1>

    @endforeach
</div>
</body>
</html>
