@extends('layouts.admin')

@section('content')


<a href="{{ route('message.create') }}" title="create new message"
    class="my-2 btn btn-success float-right btn-sm">Compose</a>
<br>
<table border="1" class="table table-hover">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @forelse ($messages as $item)
    <tr>
        <td>{{ $item->first_name }}</td>
        <td>{{ $item->last_name }}</td>
        <td>{{ ($item->submitted == 0)?'draft':'submitted' }}</td>
        <td>
            @if ($item->submitted == 0)
                <a href="{{ route('message.edit', $item->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                @else
                <a href="{{ route('message.show', $item->id) }}" class="btn btn-primary btn-sm">View</a>                
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4">No messages found!</td>
    </tr>
    @endforelse
</table>
@endsection