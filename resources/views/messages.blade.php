{{-- Success messages --}}
<script>
@if(Session::has('success'))
    window.onload = function(){
        Swal.fire({
            title: '',
            text: '{{ Session::get('success') }}',
            type: 'success',
            confirmButtonText: 'Cool'
        });
    }
@endif

@if(Session::has('error'))
    window.onload = function(){
        Swal.fire({
            title: '',
            text: '{{ Session::get('error') }}',
            type: 'error',
            confirmButtonText: 'Let me fix'
        });
    }
@endif

@if(Session::has('info'))
    window.onload = function(){
        Swal.fire({
            title: '',
            text: '{{ Session::get('info') }}',
            type: 'info',
            confirmButtonText: 'Okay'
        });
    }
@endif

@if(Session::has('warning'))
    window.onload = function(){
        Swal.fire({
            title: '',
            text: '{{ Session::get('warning') }}',
            type: 'warning',
            confirmButtonText: 'Try again'
        });
    }
@endif
</script>