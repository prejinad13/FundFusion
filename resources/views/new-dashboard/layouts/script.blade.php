<script src="{{asset('new-dashboard/vendor/js/helpers.js')}}"></script>
{{-- <script src="{{asset('new-dashboard/vendor/js/config.js')}}"></script> --}}
<script src="{{asset('new-dashboard/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('new-dashboard/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('new-dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('new-dashboard/vendor/js/menu.js')}}"></script>
<script src="{{asset('new-dashboard/js/main.js')}}"></script>
<script src="{{asset('new-dashboard/vendor/libs/datatables/datatables-bs5.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('new-dashboard/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('new-dashboard/vendor/libs/easy-zoom/easyzoom.js')}}"></script>

<livewire:scripts>


<script>
   // Initialize EasyZoom
   var $easyzoom = $('.easyzoom').easyZoom();

// Get the EasyZoom instance
var api = $easyzoom.data('easyZoom');
    </script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>

@if (Session::get('swal_success'))
<script type="text/javascript">
     Swal.fire({
            title: '{{Session::get('swal_success')}}',
            icon: "success",
            showConfirmButton:false,
            timer:2000
        });
</script>

@endif

@if (Session::get('success'))
    <script>
        Toastify({
            text: '{{Session::get('success')}}',
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        }).showToast();
    </script>
@endif

@if (Session::get('error'))
    <script>
        Toastify({
            text: '{{Session::get('error')}}',
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
            background: "linear-gradient(to right, #b00006, #e42121)",
        },
        }).showToast();
    </script>
@endif

@yield('js')

