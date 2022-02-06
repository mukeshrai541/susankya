@extends('layouts.admin')

@section('content')
<form class="form" action="{{ route('message.messageAuth', $message->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <title for="security_code">Security Code</title>
        <input id="security_code" type="text" name="security_code" placeholder="enter your security code.">
        @if ($errors->has('security_code'))
        <span class="error">
            <strong>{{ $errors->first('security_code') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <button type="submit">Confirm</button>
    </div>
    <br>
</form>
@endsection