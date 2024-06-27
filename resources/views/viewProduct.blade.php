<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Product List</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Product Table</h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data...">
            </div>
            
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Product Name <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Quantity in Stock <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Price per Item <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Date <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Total <span class="icon-arrow">&UpArrow;</span></th>
                        <th> <span class="icon-arrow"></span></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                    
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->productname }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product-> price * $product -> qty }}</td>
                        <td>
                        <button onclick="window.location='{{ route('product.edit', $product->id) }}'" class="btn btn-primary btn-view">Edit</button>
                            
                        </td>
                    </tr>
                @endforeach 
                   
                </tbody>
                
            </table>
            <button onclick="window.location='{{ route('product.create') }}'" class="btn btn-primary btn-view">Add Product</button>
        </section>
    </main>
    <script src="script.js"></script>

</body>

</html>
