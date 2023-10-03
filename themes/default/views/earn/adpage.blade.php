@extends('layouts.main')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 grid-margin">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxxx"
     crossorigin="anonymous"></script>
<!-- earnadsense -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-xxxxxxxxx" <!-- Add your own id here -->
     data-ad-slot="xxxxxxxx"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                <div class="card">
                    <div class="card-body">

                        <h1>Time remaining: {{ $remainingTime }} seconds</h1>

<div class="row">

    <div class="col d-flex justify-content-end">
@if($button === true)
<form action="{{ route('earn.return') }}" method="get">
    @csrf
    <button type="submit" class="btn btn-inverse-success">{{ __('Get Coins') }}</button>
</form>
@endif
@if($remainingTime !== 0)
        <button class="btn btn-inverse-success"
onclick="refreshPage()">{{ __('Refresh Timer') }}</button>
    </div>
@endif
</div>


                    </div>
                </div>


<script>
    function refreshPage() {
        location.reload();
    }
</script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-xxxxxxx"
     crossorigin="anonymous"></script>
<!-- earnadsense -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-xxxxxxx"
     data-ad-slot="xxxxx"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

            </div>
        </div>
    </div>
    

@endsection

