<div class="form-group">
    <div class="col-md-12">
        <label for="name">اسم المرسل</label>
        {!! Form::text("name", null, [
             'class' => 'form-control',
        ]) !!}

        <br>
        <label for="email">البريد الالكتروني</label>
        {!! Form::text("email", null, [
             'class' => 'form-control',

        ]) !!}

        <br>
        <label for="type">نوع الرساله</label>
        {!! Form::select("type" ,contactType() , null, [
             'class' => 'form-control',
        ]) !!}

        <br>
        <label for="message">الرساله</label>
        {!! Form::textarea("message" , null, [
             'class' => 'form-control',
             'rows'  => '5'

        ]) !!}
        <br>

        {!! Form::submit("تأكيد" , [
           'class' => 'form-control btn btn-warning',
      ]) !!}

    </div>


</div>
