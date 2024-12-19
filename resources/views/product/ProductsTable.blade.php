<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-qFOQ9YFAeGj1gDOuUD61g3D+tLDv3u1ECYWqT82WQoaWrOhAY+5mRMTTVsQdWutbA5FORCnkEPEgU0OF8IzGvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
 <!-- Other meta tags and CSS styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
@extends('master')

@section('content')

<div class=" container mt-5 mb-5">
    <div class="text-right">
    <a href="/addproduct" class="btn btn-primary mt=5 mb-5 w-50">
        <i class="fas fa-plus"></i>
        اضافة المنتج
    </a>
</div>
    <table id="myTablee" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quntity</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td> <img src="{{ asset($item->imagepath) }}" width="100" height="100" /></a></td>
                    <td>
                        <p class="mt-5">
                            <a href="/removeproduct/{{ $item->id }}" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                حذف المنتج
                            </a>

                            <a href="/editproduct/{{ $item->id }}" class="btn btn-success">
                                <i class="fas fa-edit"></i>
                                تعديل المنتج
                            </a>

                            <a href="/AddImages/{{ $item->id }}" class="btn btn-dark">
                                <i class="fas fa-images"></i>
                                                                                           اضافة صور للمنتج
                            </a>


                            
                        </p>
                    </td>
                    
                </tr>
            @endforeach


        </tbody>
    </table>

</div>

    @endsection
    <script>
 $(document).ready( function () {
    let table = new DataTable('#myTablee');
} );
</script>
