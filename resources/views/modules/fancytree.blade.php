@push('css')
    <link href="{{ asset('vendors/fancytree/skin-win8/ui.fancytree.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('vendors/ui/1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendors/fancytree/jquery.fancytree.ui-deps.js') }}"></script>
    <script src="{{ asset('vendors/fancytree/jquery.fancytree.js') }}"></script>
    {{-- <script src="{{ asset('vendors/fancytree/jquery.fancytree.glyph.js') }}"></script> --}}
    <script src="{{ asset('vendors/fancytree/jquery.fancytree.table.js') }}"></script>
    {{-- <script src="{{ asset('vendors/fancytree/jquery.fancytree.fixed.js') }}"></script> --}}
@endpush