
        
<x-app-layout>
    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Hi..{{ Auth::user()->name }}
        </h2>
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
                </tr>
              </thead>
              <tbody>
                @foreach($products as $Product)
                <tr>
                  <th scope="row">{{ $products->firstItem() + $loop->index}}</th>
                  <td>{{ $Product->product_name }}</td>
                  <td><img src=" {{ asset($Product->product_image) }}" style="width: 70px; height: 40px;"></td>
                  <td>{{ $Product->created_at->diffForHumans() }}</td>
                 
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $products->links() }}
            </div>
            
          </div>

       


        </div>
      </div>
    </div>
  </div>
</x-app-layout>

