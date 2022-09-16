
@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h3>
        Product
    </h3>
@stop

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    {{-- <a href="{{ route('product.create') }}" class="btn btn-md btn-success mb-3">Tambah Product</a> --}}
                    <a href="{{route('product.create')}}" class="btn btn-md btn-success mb-3">Tambah Product</a>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td class="text-center">
                                    <img src="{{ Storage::url('public/products/').$product->image }}" class="rounded" style="width: 150px">
                                </td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Blog belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>  
                      {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>


@endsection
