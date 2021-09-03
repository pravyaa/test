<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Hi <b>{{ Auth::user()->name}}</b>
           <b style="float: right;"> Total Users
                <span class="badge badge-success">{{ count($users) }}</span>
           </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="container">
            <div class="row">
                <table class="table">
  <thead>
    <tr>
      <th scope="col">Sl no</th>
      <th scope="col">user</th>
      <th scope="col">email</th>
      <th scope="col">Datte</th>
    </tr>
  </thead>
  <tbody>
    @php($i=1)
    @foreach($users as $row)
    <tr>
      <th scope="row">{{ $i++ }}</th>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{ Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
    </tr>
    @endforeach
</tbody>
</table>
            </div>
               
           </div>
        </div>
    </div>
</x-app-layout>
