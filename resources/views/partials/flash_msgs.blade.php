@if (Session::has('msg_add'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">{{ Session::get('msg_add') }}</div>
        </div>
    </div>
@endif

@if (Session::has('msg_update'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success">{{ Session::get('msg_update') }}</div>
        </div>
    </div>
@endif