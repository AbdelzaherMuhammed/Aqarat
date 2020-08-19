@extends('admin.layouts.layout')


@section('title')
    التحكم في رسائل الموقع
@endsection

@section('header')

    {!! Html::style('admin/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@yield('title')</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">

                                <div class="box-body">
                                    @include('flash::message')
                                        <table id="data" class="table table-bordered table-hover">

                                            <thead>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>اضيف في</th>
                                            <th>الحاله</th>
                                            <th>نوع الرساله</th>
                                            <th>التحكم</th>
                                            </thead>

                                            <tbody>
                                            </tbody>

                                            <tfoot>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>اضيف في</th>
                                            <th>الحاله</th>
                                            <th>نوع الرساله</th>
                                            <th>التحكم</th>
                                            </tfoot>
                                        </table>
                                </div>





                            <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-footer-->

                    <!-- /.box -->
                </section>
                <!-- /.content -->
                <!-- /.content-wrapper -->
                @endsection


                @section('footer')

                    {!! Html::script('admin/plugins/datatables.net/js/jquery.dataTables.min.js') !!}
                    {!! Html::script('admin/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}


                    <script type="text/javascript">


                        var lastIdx = null;

                        $('#data thead th').each( function () {
                            if($(this).index()  < 4 ){
                                var classname = $(this).index() == 6  ?  'date' : 'dateslash';
                                var title = $(this).html();
                                $(this).html( '<input type="text" class="' + classname + '" data-value="'+ $(this).index() +'" placeholder=" البحث '+title+'" />' );
                            }else if($(this).index() == 4){
                                $(this).html( '<select><option value="0"> رساله جديده </option><option value="1">رساله قديمه</option></select>' );
                            }else if($(this).index() == 5){
                                $(this).html( '<select>' +
                                    @foreach(contactType() as $key => $contactUs)
                                    '<option value="{{$key}}">{{$contactUs}}</option>' +
                                    @endforeach
                                    '</select>' );
                            }

                        } );

                        var table = $('#data').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ url('/adminpanel/contact/data') }}",
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'name', name: 'name'},
                                {data: 'email', name: 'email'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'is_read', name: 'is_read'},
                                {data: 'type', name: 'type'},
                                {data: 'control', name: '   '}
                            ],
                            "language": {
                                "url" : "{{ request()->root() }}/resources/views/admin/customs/Arabic.json"
                            },
                            "stateSave": false,
                            "responsive": true,
                            "order": [[0, 'desc']],
                            "pagingType": "full_numbers",
                            aLengthMenu: [
                                [25, 50, 100, 200, -1],
                                [25, 50, 100, 200, "All"]
                            ],
                            iDisplayLength: 25,
                            fixedHeader: true,

                            "oTableTools": {
                                "aButtons": [

                                    {
                                        "sExtends": "csv",
                                        "sButtonText": "ملف اكسل",
                                        "sCharSet": "utf16le"
                                    },

                                    {
                                        "sExtends": "copy",
                                        "sButtonText": "نسخ المعلومات",
                                    },

                                    {
                                        "sExtends": "print",
                                        "sButtonText": "طباعة",
                                        "mColumns": "visible",
                                    }
                                ],

                                "sSwfPath": "{{ request()->root() }}/admin/customs/copy_csv_xls_pdf.swf"
                            },

                            "dom": '<"pull-left text-left" T><"pullright" i><"clearfix"><"pull-right text-right col-lg-6" f > <"pull-left text-left" l><"clearfix">rt<"pull-right text-right col-lg-6" pi > <"pull-left text-left" l><"clearfix"> '
                            ,initComplete: function ()
                            {
                                var r = $('#data tfoot tr');
                                r.find('th').each(function(){
                                    $(this).css('padding', 8);
                                });
                                $('#data thead').append(r);
                                $('#search_0').css('text-align', 'center');
                            }

                        });

                        table.columns().eq(0).each(function(colIdx) {
                            $('input', table.column(colIdx).header()).on('keyup change', function() {
                                table
                                    .column(colIdx)
                                    .search(this.value)
                                    .draw();
                            });

                        });

                        table.columns().eq(0).each(function(colIdx) {
                            $('select', table.column(colIdx).header()).on('change', function() {
                                table
                                    .column(colIdx)
                                    .search(this.value)
                                    .draw();
                            });

                            $('select', table.column(colIdx).header()).on('click', function(e) {
                                e.stopPropagation();
                            });
                        });


                        $('#data tbody')
                            .on( 'mouseover', 'td', function () {
                                var colIdx = table.cell(this).index().column;

                                if ( colIdx !== lastIdx ) {
                                    $( table.cells().nodes() ).removeClass( 'highlight' );
                                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                                }
                            } )
                            .on( 'mouseleave', function () {
                                $( table.cells().nodes() ).removeClass( 'highlight' );
                            } );

                    </script>


@endsection
