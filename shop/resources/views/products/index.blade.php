<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 8 DataTables CRUD Tutorial From Scratch - Tutsmake.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

</head>
<body>

    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Products</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Add Product </a>
                </div>
            </div>
        </div>
    
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card-body">

            <table class="table table-bordered" id="datatable-crud">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            </table>

        </div>
    
    </div>
</body>
    <script type="text/javascript">
        
    $(document).ready( function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#datatable-crud').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('products') }}",
            columns: [
                        { data: 'id', name: 'id' },
                        { data: 'product_name', name: 'product name' },
                        { data: 'price', name: 'price' },
                        { data: 'created_at', name: 'created_at' },
                        {data: 'action', name: 'action', orderable: false},
                    ],
                    order: [[0, 'asc']]
        });

        $('body').on('click', '.delete', function () {

        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            
            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('delete-product') }}",
                data: { id: id},
                dataType: 'json',
                success: function(res){

                var oTable = $('#datatable-crud').dataTable();
                oTable.fnDraw(false);
            }
            });
        }

        });
    });

    </script>
</html>