@extends('layouts.admin')

@section('content')
<form class="form" action="{{ route('message.update', $message->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <title for="first_name">First Name</title>
        <input id="first_name" type="text" name="first_name" placeholder="enter your first name." value="{{ $message->first_name }}">
        @if ($errors->has('first_name'))
        <span class="error">
            <strong>{{ $errors->first('first_name') }}</strong>
        </span>
        @endif
    </div>
    <br>
    <div class="form-group">
        <title for="last_name">Last Name</title>
        <input id="last_name" type="text" name="last_name" placeholder="enter your last name." value="{{ $message->last_name }}">
    </div>
    @if ($errors->has('last_name'))
        <span class="error">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
        @endif
    <br>
    <div class="form-group">
        <title for="vaccine_name">Vaccine Name</title>
        <input id="vaccine_name" type="text" name="vaccine_name" placeholder="enter your vaccine name." value="{{ $message->vaccine_name }}">
        @if ($errors->has('vaccine_name'))
        <span class="error">
            <strong>{{ $errors->first('vaccine_name') }}</strong>
        </span>
        @endif
    </div>
    <br>
    <div class="form-group">
        <title for="vaccinated_date">Vaccinated Date</title>
        <input id="vaccinated_date" type="date" name="vaccinated_date" placeholder="enter your vaccinated date." value="{{ $message->vaccinated_date }}">
        @if ($errors->has('vaccinated_date'))
        <span class="error">
            <strong>{{ $errors->first('vaccinated_date') }}</strong>
        </span>
        @endif
    </div>
    <br>
    <div class="form-group">
        <title for="age">Age</title>
        <input id="age" type="number" name="age" placeholder="enter your age" value="{{ $message->age }}">
        @if ($errors->has('age'))
        <span class="error">
            <strong>{{ $errors->first('age') }}</strong>
        </span>
        @endif
    </div>
    <br>
    <div class="form-group">
        <button type="submit">Submit</button>
    </div>
    <br>
</form>
@endsection