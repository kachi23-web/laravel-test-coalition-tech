<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
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
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div> -->
            <!-- <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> -->



        
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="pname"  name="productname" value="{{ $product->productname }}">
            </div>
            <div class="form-group">
                <label for="name">Quantity:</label>
                <input type="text" class="form-control" id="qty"  name="qty" value="{{ $product->qty  }}">
            </div>
            <div class="form-group">
                <label for="name">Price:</label>
                <input type="text" class="form-control" id="price"  name="price" value="{{ $product->price  }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>          
           
        </form>


    </div>
</body>
</html>
