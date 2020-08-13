@if(session()->has('success'))
 <div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            {{session()->get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    </div>
</div>
@endif
@if(session()->has('error'))
<div class="container">
    <div class="col-md-12">
        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
            {{session()->get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    </div>
@endif

