@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('extra-script')
<script>
    $(document).ready(function () {
        resetToastPosition();
        @if(session('success'))
        $.toast({
            heading: 'Success',
            text: "{{ session('success') }}",
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
        });
        @elseif(session('success'))
        $.toast({
            heading: 'Danger',
            text: "{{ session('success') }}",
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f2a654',
            position: 'top-right'
        });
        @endif
    });
</script>
@endsection
