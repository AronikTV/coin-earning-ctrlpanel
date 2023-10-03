@extends('layouts.main')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <form class="form" action="{{ route('earn.start', Auth::user()->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                                                <div class="row">
                                                    <div class="col d-flex justify-content-end">
                                                        <button class="btn btn-primary btn-inverse-success" type="submit">{{ __('Save Changes') }}</button>
                                                    </div>
                                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div


    </div>
    

    </div>
    </div>
@endsection

