@if (session()->has('msg_success'))
    <div class="alert alert-success alert-dismissible fade show m-t-10" role="alert">
        {{ session()->get('msg_success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session()->has('msg_error'))
    <div class="alert alert-danger alert-dismissible fade show m-t-10" role="alert">
        {{ session()->get('msg_error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif