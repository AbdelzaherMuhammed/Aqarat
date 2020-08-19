
@csrf
<h3>
    @yield('title')
</h3>
<hr>
<div class="form-group">

    <div class="col-md-11">
        {!! Form::text('bu_name' , null , [
             'class' => 'form-control',
        ]) !!}

        @error('bu_name')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        اسم العقار
    </label>
</div>


<div class="clearfix"></div>
<br>


<div class="form-group">


    <div class="col-md-11">
        {!! Form::select('rooms' ,roomNumber() ,null , [
             'class' => 'form-control select2',

        ]) !!}

        @error('rooms')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        عدد الغرف
    </label>
</div>

<div class="clearfix"></div>
<br>

<div class="form-group">
    <div class="col-md-11">
        {!! Form::text('bu_price' , null , [
             'class' => 'form-control',

        ]) !!}


        @error('bu_price')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        سعر العقار
    </label>
</div>

<div class="clearfix"></div>
<br>


<div class="form-group">
    <div class="col-md-11">

        {!! Form::select('bu_place' , aqarPlace(), null , [
             'class' => 'form-control select2',
             'placeholder' => 'اختر المنطقه'
        ]) !!}

        @error('bu_place')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
         المنطقه
    </label>
</div>

<div class="clearfix"></div>
<br>



<div class="form-group">

    <div class="col-md-11">
        {!! Form::select('bu_rent' , aqar_rent() , null,[
             'class' => 'form-control',

        ]) !!}


        @error('bu_rent')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        نوع العمليه
    </label>
</div>

<div class="clearfix"></div>
<br>

<div class="form-group">

    <div class="col-md-11">
        {!! Form::text('bu_square' , null , [
             'class' => 'form-control',
        ]) !!}


        @error('bu_square')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        مساحة العقار
    </label>
</div>

<div class="clearfix"></div>
<br>


<div class="form-group">

    <div class="col-md-11">
        {!! Form::select('bu_type' , aqar_type() , null,[
             'class' => 'form-control',
        ]) !!}


        @error('bu_type')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        نوع العقار
    </label>
</div>

<div class="clearfix"></div>
<br>

@if(!isset($user))
<div class="form-group">

    <div class="col-md-11">
        {!! Form::select('bu_status' , aqar_status() , null,[
             'class' => 'form-control',
        ]) !!}


        @error('bu_status')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        حالة العقار
    </label>
</div>
@endif
<div class="clearfix"></div>
<br>


<div class="form-group">



    <div class="col-md-11">
        @if(isset($model))
            <img src="{{asset('images/'. $model->image)}}" alt="image" width="150">
        @endif

        {!! Form::file('image' , null, [
             'class' => 'form-control',
        ]) !!}


    </div>

    <label class="col-md-1">
        صورة العقار
    </label>

</div>

<div class="clearfix"></div>
<br>


<div class="form-group">

    <div class="col-md-11">
        {!! Form::text('bu_meta' , null , [
             'class' => 'form-control',
             'rows'  => '4'
        ]) !!}


        @error('bu_meta')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        الكلمات الدلاليه
    </label>
</div>

<div class="clearfix"></div>
<br>
@if(!isset($user))

<div class="form-group">

    <div class="col-md-11">
        {!! Form::textarea('bu_small_disc' , null , [
             'class' => 'form-control',
             'rows'  => '5'
        ]) !!}


        @error('bu_square')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <br>
        <div class="alert alert-warning">
            لا يمكن ادخال اكثر من 160 حرف طبقا لمعايير جوجل
        </div>
    </div>
    <label class="col-md-1">
        وصف العقار لمحركات البحث
    </label>
</div>
@endif

<div class="clearfix"></div>
<br>


<div class="form-group">

    <div class="col-md-11">
        {!! Form::text('bu_longitude' , null , [
             'class' => 'form-control',

        ]) !!}


        @error('bu_longitude')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        خطوط الطول
    </label>
</div>


<div class="clearfix"></div>
<br>


<div class="form-group">

    <div class="col-md-11">
        {!! Form::text('bu_latitude' , null , [
             'class' => 'form-control',

        ]) !!}


        @error('bu_latitude')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        دوائر العرض
    </label>
</div>


<div class="clearfix"></div>
<br>


<div class="form-group">

    <div class="col-md-11">
        {!! Form::textarea('bu_large_disc' , null , [
             'class' => 'form-control',
        ]) !!}


        @error('bu_large_disc')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <label class="col-md-1">
        وصف مطول للعقار
    </label>
</div>

<div class="clearfix"></div>
<br>


<div class="form-group">
    <div class="col-md-12">
        <button type="submit" class="btn btn-warning">
            <i class="fa fa-user" style="color:#FFFFFF"></i>
            تاكيد
        </button>
    </div>
</div>

