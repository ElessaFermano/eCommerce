<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
               @foreach($category as $categories)
                <h5 class="text-center mt-3 mb-3">{{$categories->products}}</h5>
              @endforeach
            </div>
            
        </div>
</body>
</html>

