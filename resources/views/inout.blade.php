@extends ('layouts.app')

@section ('content')

<div class="flex flex-col items-center h-screen">
    <div class="py-2 px-6 text-center mt-16 mb-32">
        <h1 class="font-bold text-4xl text-blue-800">Are you In || Out?</h1>
    </div>

    @if(Session::has('message'))
    <div class="alert py-4 px-6 text-center bg-blue-500 text-red-800 mb-8 rounded">
        {{ Session::get('message') }}
    </div>
    @endif
    
    @if(Auth::user()->checkedToday())
        <div class="py-4 px-6 text-center bg-blue-500 text-red-800 mb-8 rounded">
            Check In Again for Tomorrow
        </div>
    @endif

    <div class="flex">
        @can('checkIn', App\Attendance::class)
        <form action="/checkin" method="POST">
            @csrf()
            <button type="submit" rel="check-in" class="py-4 px-6 bg-blue-900 text-white rounded mr-2">Check In</button>
        </form>
        @endcan

        @can('checkOut', App\Attendance::class)
        <form action="/checkout" method="POST">
            @csrf()
            <button type="submit" rel="check-out" class="py-4 px-6 bg-red-900 text-white rounded">Check Out</button>
        </form>
        @endcan
    </div>
</div>

@endsection