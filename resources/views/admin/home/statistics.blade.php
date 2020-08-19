@extends('admin.layouts.layout')


@section('title')
      احصائياء اضافة العقار عن السنه
    {{$year}}
@endsection

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

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

                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open([
                            'url'   => 'adminpanel/status',
                        ]) !!}
                        <select name="year" class="select2" style="width: 100px">
                            @for($i = 2020; $i<=2100;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>

                        {!! Form::submit('اظهار الاحصائيات', ['class' => 'btn btn-warning']) !!}

                        {!! Form::close() !!}

                        <p class="text-center">
                            <strong>
                                احصائياء اضافة العقار عن السنه
                                {{$year}}
                            </strong>
                        </p>

                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>



@endsection















@section('footer')


    <script>
        $(document).ready(function () {

            $('.select2').select2({
                dir: 'rtl'
            });
        });

        /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
   */

        // -----------------------
        // - MONTHLY SALES CHART -
        // -----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas);

        var salesChartData = {
            labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر'],
            datasets: [
                {
                    label: 'Digital Goods',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [

                        @foreach($new as $chart)
                        @if(is_array($chart))
                        {{$chart['counting']}},
                        @else
                        {{$chart}},
                        @endif
                        @endforeach

                    ]
                },
            ]
        };
    </script>

@endsection



