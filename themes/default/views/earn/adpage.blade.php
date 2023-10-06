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
     data-ad-client="ca-pub-xxxxxxx"
     data-ad-slot="xxxxx"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

@if(!request()->is('adblocker-found'))
    @if(!request()->is('mobile'))
        <!-- Adblocker detection script for desktop browsers (Updated) -->
        <script>
            function detectAdblocker() {
                var adBlockEnabled = false;
                var testAd = document.createElement('ins');
                testAd.className = 'adsbygoogle';
                testAd.style.display = 'block';
                testAd.style.height = '280px';
                testAd.setAttribute('data-ad-format', 'auto');
                testAd.setAttribute('data-full-width-responsive', 'true');
                testAd.innerHTML = '&nbsp;'; // Add some content inside the ad element
                document.body.appendChild(testAd);
                window.setTimeout(function() {
                    var adStyles = window.getComputedStyle(testAd);
                    if (testAd.offsetHeight < 24 || adStyles.getPropertyValue('display') === 'none' || adStyles.getPropertyValue('visibility') === 'hidden') {
                        adBlockEnabled = true;
                    }
                    testAd.remove();
                    if (adBlockEnabled) {
                        window.location.href = "/adblocker-found";
                    }
                }, 1000);
                setTimeout(function() {
                    detectAdblocker();
                }, 4000); // repeat after 4 seconds
            }

            // Call the adblocker detection function
            detectAdblocker();
        </script>
        <!-- Adblocker detection script for mobile browsers -->
        <script>
            function detectAdblocker() {
                var adBlockEnabled = false;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log('Adblocker not detected on mobile browser');
                        } else {
                            adBlockEnabled = true;
                            window.location.href = "/adblocker-found";
                        }
                    }
                };
                xhr.send();
                setTimeout(function() {
                    detectAdblocker();
                }, 4000); // repeat after 4 seconds
            }
            detectAdblocker();
        </script>
    @endif
    @endif

                <div class="card">
                    <div class="card-body">

                        <h1>Time remaining: {{ $remainingTime }} seconds</h1>

<div class="row">

    <div class="col d-flex justify-content-end">
@if($button === true)
<form action="{{ route('earn.return') }}" method="get">
    @csrf
    <button type="submit" class="btn btn-primary btn-lg">{{ __('Get Coins') }}</button>
</form>
@endif
@if($remainingTime !== 0)
    <button id="refreshButton" class="btn btn-lg"
            onclick="refreshPage()">{{ __('Refresh Timer') }}</button>
</div>
@endif

<script>
    // Function to disable the button and make it gray (Spam protection)
    function disableButton() {
        var button = document.getElementById('refreshButton');
        button.disabled = true;
        button.style.backgroundColor = 'gray';
    }

    // Function to enable the button and make it blue
    function enableButton() {
        var button = document.getElementById('refreshButton');
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

