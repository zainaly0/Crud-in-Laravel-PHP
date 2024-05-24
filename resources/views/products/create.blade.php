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
                <a href="http://localhost:8000/products" class="btn btn-dark">back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark color">
                        <h3 class="text-white">Create Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h4">Name</label>
                                <input type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name" value="{{ old('name')}}">
                                @error('name')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h4">Sku</label>
                                <input type="text" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="Sku" name="sku" value="{{ old('sku')}}">
                                @error('sku')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h4">Price</label>
                                <input type="text" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price" name="price" value="{{ old('price')}}">
                                @error('price')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h4">Description</label>
                                <textarea class="@error('description') is-invalid @enderror form-control" name="description" id="" placeholder="description" cols="30" rows="5" value="{{ old('description')}}"></textarea>
                                @error('description')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h4">Image</label>
                                <input class="@error('image') is-invalid @enderror form-control" type="file" name="image" id="" placeholder="image" value="{{ old('image')}}"></input>
                                @error('image')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>