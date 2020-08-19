
<div class="form-group">
    <div class="col-md-12">
        {!! Form::text('name' , null , [
             'class' => 'form-control',
             'placeholder' => 'الاسم'
        ]) !!}

        @error('name')
        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
    </div>
</div>

<div class="clearfix"></div>
<br>

<div class="form-group">

    <div class="col-md-12">
        {!! Form::email('email' , null , [
             'class' => 'form-control',
            'placeholder' => 'البريد الالكتروني'
        ]) !!}

        @error('email')
        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
    </div>
</div>

<div class="clearfix"></div>
<br>

@if(isset($permission))
<div class="form-group">

    <div class="col-md-12">
        {!! Form::select('admin' , ['0' => 'user' , '1' => 'admin'] , null , [
             'class' => 'form-control'
        ]) !!}

        @error('admin')
        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
        @enderror
    </div>
</div>

<div class="clearfix"></div>
<br>
@endif

@if(!isset($user))
    <div class="form-group">

        <div class="col-md-6">
            <input id="password-confirm" type="password" placeholder="تاكيد كلمة المرور" class="form-control"
                   name="password_confirmation"
                   required autocomplete="new-password">
        </div>


        <div class="col-md-6">
            <input id="password" type="password" placeholder="كلمة المرور"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>
    </div>

<div class="clearfix"></div>
<br>
@endif
<div class="form-group">
    <div class="col-md-12">
        <button type="submit" class="btn btn-warning">
            <i class="fa fa-user" style="color:#FFFFFF"></i>
            تاكيد
        </button>
    </div>
</div>

