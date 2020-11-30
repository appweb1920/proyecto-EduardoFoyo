@extends('layout')


@section('content')
<div class="card m-5">
    <div class="card-header">
        <strong>Usuarios</strong>
    </div>
    <div class="card-body card-block">
        <div class="table-responsive table--no-card m-b-30">
            
            <table id="table_id" class="display"  style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Genero</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
    $(function() {
        table = $('#table_id').DataTable({
            lengthMenu: [[10, 50, 300], [10, 50, 300]],
            dom: 'Blfrtip',
            buttons: [
                 'csv', 'excel', 'pdf'
            ],
            processing: true,
            serverSide: true,
            responsive: false,  
            searching: true,
            ajax: {
               "url": '{!! route('list_user_api') !!}',
               "type": 'POST',
            },
            columns:[
                { 
                    data: 'id',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            var url = "{{route('modify_user', ':data')}}";
                            url = url.replace(':data', data);
                            return '<a href="' + url +'">' + data + '</a>';
                        }
                        return data;
                    }
                },
                {data: 'name'},
                {data: 'email'},
                {data: 'gender'},
                {data: 'description'},
                
            ],
            order: [[ 0, "desc" ]],
            
        });
        table.buttons().container()
        .insertBefore( '#example_filter' );
    });
</script>
@endpush