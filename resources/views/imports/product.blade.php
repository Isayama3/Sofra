<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initail-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Product</title>
    </head>
    <body>
    <form action="{{route('import-product-excel')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="productsList">
        <button type="submit">submit</button>
    </form>

    </body>
</html>
