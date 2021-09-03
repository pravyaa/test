
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b>Edit product</b>
        </h2>
    </x-slot>

    <div class="py-12">
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="container">
        <div class="row">

          <div class="col-md-6">
            <div class="card">
             <div class="card-header">Edit product</div>
             <div class="card-body">
              <form method="POST" enctype="multipart/form-data" action="{{ url('admin/product/update/'.$products->id) }}">
                @csrf
                <input type="hidden" name="old_image" value="{{ $products->product_image }}">
                  <div class="form-group">
                    <label for="categoryname">product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" aria-describedby="productname" value="{{ $products->product_name }}">
                    @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="categoryname">product Image</label>
                    <input type="file" class="form-control" id="product_image" name="product_image" aria-describedby="productimage">
                    @error('product_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <img src="{{ asset($products->product_image)}}" style="width: 400px;height:300px">
                  </div>
                 <button type="submit" class="btn btn-primary">Update product</button>
            </form>
            </div>
            </div>
          </div>


            </div>
               
           </div>
        </div>
    </div>
</x-app-layout>
