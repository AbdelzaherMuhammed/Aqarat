@if(count($records))
    @foreach($records as $key => $record)
        @if($key % 3 == 0 && $key != 0)
            <div class="clearfix"></div>
        @endif
        <div class="col-xs-12 col-sm-6 col-md-4 pull-right">
            <div class="thumbnail" style="width: auto">
                <div class="img-wrap"><img src="{{$record->image != null ? asset('images/'.$record->image) :
                    asset('images/'.$settings->alternate_image)}}" class="img-responsive">
                </div>

                <div class="caption">
                    <h1 style="margin-bottom: 0;font-weight: bold" class="lead">الاسم : {{$record->bu_name}}</h1>
                    <p style="margin-bottom: 0">التفاصيل : {{Str::limit($record->bu_small_disc, 70)}}</p>
                </div>

                <hr style="margin-top: 0;margin-bottom: 10px">

                <span class="pull-right width_auto">
                    المساحه :
                   {{$record->bu_square}}    متر
                </span>

                <span class="pull-left width_auto">
                    نوع العملية :
                    {{aqar_rent()[$record->bu_rent]}}
                </span>
                <span class="pull-right width_auto">
                    نوع العقار :
                    {{aqar_type()[$record->bu_type]}}
                </span>

                <span class="pull-left width_auto">
                    المنطقه :
                    {{aqarPlace()[$record->bu_place]}}
                </span>

                <hr style="margin-top: 60px;margin-bottom: 10px;">

                <div class="btn-ground text-center">
                    <span style="margin-top: 6px;font-size: 16px" class="pull-right">${{$record->bu_price}}</span>
                    @if($record->bu_status != 0)
                        <a href="{{url('/building-details', $record->id)}}"
                           style="margin-right: 15px;font-size: 90%;color: #FFF"
                           type="button" class="btn btn-primary">
                            عرض التفاصيل <i class="fa fa-arrow-circle-o-left" style="color: #FFF"></i>
                        </a>
                    @else
                        <span class="btn btn-danger" style="margin-right: 10px;font-size: 90%;color: #FFF">
                    في انتظار التفعيل <i class="fa fa-clock-o" style="color: #FFF"></i>
                    </span>
                        <a href="{{url('/user/edit/building', $record->id)}}" class="btn btn-success" style="margin-right: 10px;font-size: 90%;color: #FFF">
                            تعديل العقار
                        </a>
                    @endif
                </div>

            </div>
        </div>
    @endforeach

@else
    <div class="alert alert-danger" role="alert">
        لا يوجد بيانات
    </div>
@endif


