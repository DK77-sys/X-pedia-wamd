@section('title', 'Scan Device')
<div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>#Device-{{ $data->number }}</h4>
                </div>
                <div class="card-body">
                    <img src="http://mpwa.test/images/other/waiting.jpg" class="rounded mx-auto d-block" height="300px"
                        alt="">
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" disabled="">
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Connecting to Node server...
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card gradient-bottom">
                <div class="card-header">
                    <h4>Information : </h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        {{-- <ul class="list-group list-group-flush"> --}}
                        <li class="media">Name : </li>
                        <li class="media">Number : </li>
                        <li class="media">Device : </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
