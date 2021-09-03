
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b>All Products</b>
        </h2>
    </x-slot>

    <div class="py-12">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong> 
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                @endif
              <div class="card-header">Products</div>
              <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Image</th>
                  <th scope="col">Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($Products as $Product)
                <tr>
                  <th scope="row">{{ $Products->firstItem() + $loop->index}}</th>
                  <td>{{ $Product->product_name }}</td>
                  <td><img src=" {{ asset($Product->product_image) }}" style="width: 70px; height: 40px;"></td>
                  <td>{{ $Product->created_at->diffForHumans() }}</td>
                  <td><a href="{{ url('admin/product/edit/'.$Product->id) }}"><button class="btn btn-info">Edit</button></a><a href="{{ url('admin/product/delete/'.$Product->id)}}"><button class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete </button></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $Products->links() }}
            </div>
            
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">Add Product</div>
              <div class="card-body">
              <form method="post" enctype="multipart/form-data" action="{{ route('product.add')}}">
                @csrf
                <div class="form-group">
                <label for="ProductInput" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="ProductName" name="Product_name" placeholder="Product Name">
                @error('Product_name')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
                </div>

                <div class="form-group">
                <label for="ProductInput" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="ProductQty" name="Product_qty" placeholder="Product QTY">
                @error('Product_qty')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
                </div>

                <div class="form-group">
                <label for="ProductInput" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="ProductImage" name="Product_image" placeholder="Product Image">
                @error('Product_image')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
                </div>

                <button type="submit" class="btn btn-info">Save Product</button>

                
              </form>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</x-app-layout>