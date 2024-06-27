<!DOCTYPE html>
<html>
<head>
    <title> Product List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container   bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
        <h2>Create Product</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="pname"  name="productname" value="{{ old('productname') }}">
            </div>
            <div class="form-group">
                <label for="name">Quantity:</label>
                <input type="text" class="form-control" id="qty"  name="qty" value="{{ old('qty') }}">
            </div>
            <div class="form-group">
                <label for="name">Price:</label>
                <input type="text" class="form-control" id="price"  name="price" value="{{ old('price') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>          
           
        </form>

        <button onclick="window.location='{{ route('viewProduct.create') }}'" class="btn btn-primary">View Product</button>

    </div>



   
</body>
</html>
