<a href="{{ $link }}" class="card text-white  others-link">
            <div class="card-body bg-{{$color}}-500">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $title }}</h3>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi {{ $icon }} display-4"></span>
                        </div>
                        
                    </div>
                    <h6 class="col-9 text-muted font-weight-normal">Slider controll.</h6>
                    <div class="col-3 justify-end">

                            @if ($count !== null)
                            <div class="icon icon-box-success ">
                                <span class="icon "> {{ $count }}</span>
                            </div>
                                
                            @endif
                        </div>
                    </div>
                
            </div>
        </a>