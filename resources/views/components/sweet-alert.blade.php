@if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif


@if(session('error'))
    <script>
        Swal.fire({
            title: 'Oops...',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if($errors->has('error'))
    <script>
        Swal.fire({
            title: 'Oops...',
            text: "{{ $errors->first('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif


@if($errors->any())
    @foreach($errors->all() as $error)
    <script>
        Swal.fire({
            title: 'Oops...',
            text: "{{ $error }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
    @endforeach
@endif
