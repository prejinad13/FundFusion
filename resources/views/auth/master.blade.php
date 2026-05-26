<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('new-dashboard/vendor/css/pages/page-auth.css')}}">
    <link rel="stylesheet" href="{{asset('new-dashboard/vendor/fonts/boxicons.css')}}">
    <link rel="stylesheet" href="{{asset('new-dashboard/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('new-dashboard/vendor/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('new-dashboard/vendor/css/theme-default.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{asset('new-dashboard/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('new-dashboard/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('new-dashboard/vendor/js/menu.js')}}"></script>
    <script src="{{asset('new-dashboard/js/main.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function updateCustomOptionCheck(e) {
            const radioButtons = document.querySelectorAll('input[name="role"]');

            radioButtons.forEach(function (radio) {
                const customOption = radio.closest(".custom-option");

                if (radio.checked) {
                    customOption.classList.add("checked");
                } else {
                    customOption.classList.remove("checked");
                }
            });
        }

        document.querySelectorAll('input[name="role"]').forEach(function (radio) {
            radio.addEventListener('change', function (event) {
                updateCustomOptionCheck(event.target);
            });
        });
    </script>
    @yield('js')
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

    @if (session('resent'))
    <script>
        Toastify({
            text: 'A fresh verification link has been sent to your email address.',
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

</body>

</html>
