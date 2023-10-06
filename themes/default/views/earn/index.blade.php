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
                                    <button id="saveButton" class="btn btn-inverse-success" type="submit">{{ __('Save Changes') }}</button>
                                </div>
                            </div>

                            <script>
                                // Function to disable the button and make it gray (Spam protection)
                                function disableButton() {
                                    var button = document.getElementById('saveButton');
                                    button.disabled = true;
                                    button.style.backgroundColor = 'gray';
                                }

                                // Function to enable the button and make it blue
                                function enableButton() {
                                    var button = document.getElementById('saveButton');
                                    button.disabled = false;
                                    button.style.backgroundColor = 'blue';
                                }

                                // Random time delay between 0.3 and 1.1 seconds
                                var randomDelay = Math.floor(Math.random() * (1100 - 300 + 1)) + 300;

                                // Disable the button initially
                                disableButton();

                                // Set a timeout to enable the button after the random delay
                                setTimeout(function () {
                                    enableButton();
                                }, randomDelay);
                            </script>

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

