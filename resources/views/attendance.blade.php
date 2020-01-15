@extends ('layouts.app')

@section ('content')

<div class="container mx-auto">
    @foreach ($attendances as $day => $attendance)
        <div class="bg-white p-4 flex">
            <div class="w-3/4">
                {{ $day }}
            </div>
            <div class="w-1/4">
                IN
                {{ $attendance->get('in') ? $attendance->get('in')->log->toTimeString() : '' }}
            </div>
            <div class="w-1/4">
                OUT
                {{ $attendance->get('out') ? $attendance->get('out')->log->toTimeString() : '' }}
            </div>
        </div>
    @endforeach
</div>

@endsection