@extends('layouts.superadminlayout.app')

@section('title', 'Dashboard')

@section('content')


 <!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
        Swal.fire({
        title: "Launching Soon!",
        text: "We are working hard to launch this service. Stay tuned!",
        showClass: {
            popup: `animate__animated animate__fadeInUp animate__faster`
        },
        hideClass: {
            popup: `animate__animated animate__fadeOutDown animate__faster`
        }
    }).then((result) => {
        if (result.isConfirmed || result.isDismissed) {
            window.location.href = "{{ route('super.admin.dashboard') }}";
        }
    });
        @endif
    });
</script>



@endsection