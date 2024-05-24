<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>simple laravel crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">CRUD By Zaid Aly</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                {{-- <a href="http://localhost:8000/products/create" class="btn btn-dark">create</a> --}}
                <a href="{{route('products.create')}}" class="btn btn-dark">create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">{{Session::get('success')}};</div>
            </div>
            @endif
           
            <div class="col-md-8">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark color">
                        <h3 class="text-white">Index Product</h3> 
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>SKU</th>
                                <th>PRICE</th>
                                <th>DESCRIPTION</th>
                                <th>IMAGE</th>
                                <th>created at</th>
                                <th>Action Button</th>
                            </tr>
                           @if ($products->isNotEmpty())
                                @foreach ( $products as $product )
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name }}</td>
                                    <td>{{$product->sku }}</td>
                                    <td>{{$product->price }}</td>
                                    <td>{{$product->description }}</td>
                                    <td>
                                        @if ($product->image != "")
                                        {{-- <img width="50px" src="{{$product->image }}" alt="img"> --}}
                                        <img width="50px" src="{{asset('upload/products/'.$product->image)}}" alt="">
                                        @endif
                                    </td>
                                    {{-- <td>{{$product->created_at }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</td>
                                    <td><a href="{{ route('products.edit', $product->id)}}" class="btn btn-dark">Edit</a>
                                        {{-- <a href="{{ route('products.destroy', $product->id)}}" class="btn btn-danger">Deleted</a> --}}
                                        <a href="#" onclick="deleteProduct({{$product->id}})" class="btn btn-danger">Deleted</a>
                                        <form id="delete-product-form-{{$product->id}}" action="{{route('products.destroy', $product->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                           @endif
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  </body>
</html>

<script>
    function deleteProduct(id){
        if(confirm("are you sure you want to delete product?")){
            document.getElementById('delete-product-form-'+ id).submit()

        }
    }
</script>