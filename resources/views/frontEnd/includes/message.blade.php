<div class="row">
    <div class="col-md-8 col-md-offset-4">
        @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <strong>Well done!</strong> {!! Session::get('success') !!}
            </div>
        @endif

        @if(Session::get('unsuccess'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <strong >Oh snap!</strong> {!! Session::get('unsuccess') !!}
            </div>
        @endif

        @if(Session::get('warning'))
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> {!! Session::get('warning') !!}
            </div>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong> {!! $error !!}
                </div>
            @endforeach

        @endif
    </div>
</div>
