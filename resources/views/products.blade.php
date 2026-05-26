@isset($produtos)
    {{ $produtos->total() }} {{ __('messages.results') }}
@else
    {{ __('messages.showing_products') }}
@endisset