@extends('front.layouts.master')
@section('content')
<div class="row">
   <div class="col-md-12">
        <p class="demo-button pull-right">
            <a class="btn btn-primary btn-toastr" href="{{ route('products.create') }}"> Create New Product</a>
        </p>
    </div>

    @if ($message = Session::get('success'))
    <div class="col-md-12">
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Product List</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="products" class="table table-striped table-bordered">
                       <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">sku</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col">barcode</th>
                            <th scope="col">tax</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extrajs')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
           $('#products').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('products.show') }}',
                columns:[
                { data: 'sn', data: 'sn' },
                { data: 'name', name: 'name' },
                { data: 'category', name: 'category' },
                { data: 'sku', name: 'sku' },
                { data: 'stock', name: 'stock' },
                { data: 'price', name: 'price' },
                { data: 'barcode', name: 'barcode' },
                { data: 'tax', name: 'tax' },
                { data: 'action', name: 'action' },
                ]
            });
        });

      $(document).on('click','.delete',function(e){
               var id = $(this).data("id");
                event.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajaxSetup({
                                headers: {
                                'X-CSRF-TOKEN': $('#csrfToken').attr('content')
                                }
                            });
                            $.ajax({
                                url:"products/"+id,
                                method:'DELETE',
                                data:{
                                    id:id
                                }
                            });
                            swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                            });
                            $('#products').DataTable().ajax.reload();
                            // setTimeout(function(){
                            //     location.reload()
                            // },1000)
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            });

    </script>
@endsection
