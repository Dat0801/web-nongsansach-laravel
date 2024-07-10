@if (session()->has('cart'))
    {{ count(session()->get('cart')) }}
@else
    0
@endif
