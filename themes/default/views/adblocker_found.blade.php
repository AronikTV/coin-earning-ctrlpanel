@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center" style="background-color: #3A4047; height: 100vh; margin: 0; padding: 0;">
    <div class="alert alert-warning" role="alert" style="color: #000; border-color: #ffc107; max-width: 500px; text-align: center; padding: 20px;">
        <h4 class="alert-heading" style="font-size: 24px; font-weight: bold;">Adblocker Detected</h4>
        <p style="font-size: 16px;">We've detected that you're using an adblocker. Our service is free to use, but we rely on advertising revenue to keep it that way. Please consider disabling your adblocker to support us.</p>
        <hr style="border-color: #ffc107;">
        <p class="mb-0" style="font-size: 16px;">Thank you for using our service!</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3" style="font-size: 16px; color: #fff;">I turned off my adblock</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #3A4047;
    }
</style>
@endsection
