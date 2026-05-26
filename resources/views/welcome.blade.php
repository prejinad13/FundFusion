<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>

    <body>
        <header class="fixed w-full">
            <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    <a href="{{route('index')}}" class="flex items-center">
                        <img src="{{asset('new-dashboard/img/logos/fundfusion_black.png')}}" class="h-6 mr-3 sm:h-9"
                            alt="FundFusion Logo" />
                    </a>
                    <div class="flex items-center lg:order-2">
                        @auth
                        <a href="{{route('home')}}"
                            class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800 mr-4">Dashboard</a>
                        @else
                        <a href="{{route('login')}}"
                            class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800 mr-4">Log
                            in</a>
                        <a href="{{route('register')}}"
                            class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Register</a>
                        @endauth
                        <button data-collapse-toggle="mobile-menu-2" type="button"
                            class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="mobile-menu-2" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1"
                        id="mobile-menu-2">
                        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="{{route('index')}}"
                                    class="block py-2 pl-3 pr-4 text-white bg-purple-700 rounded lg:bg-transparent lg:text-purple-700 lg:p-0 dark:text-white"
                                    aria-current="page">Home</a>
                            </li>
                            <li>
                                <a href="#process"
                                    class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Process</a>
                            </li>
                            <li>
                                <a href="#faq"
                                    class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Start block -->
        <section class="bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12 lg:pt-28">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1
                        class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
                        FundFusion</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                        Investment Matchmaking Platform
                    </p>
                </div>
                <div class="lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="{{asset('frontend/investment.jpg')}}" alt="hero image">
                </div>
            </div>
        </section>
        <!-- End block -->
        @php
        $investee_steps=["Create Your Investee Account Today!","Share Your Business Pitch from Our Dynamic
        Dashboard!","Effortlessly Search and Explore Potential Investors"];
        @endphp
        @php
        $investor_steps=["Join as an Investor and Ignite Success!","Manage Your Portfolio with Our Intuitive
        Dashboard!","Effortlessly Discover and Connect with Potential Ventures"];
        @endphp
        <!-- Start block -->
        <section class="bg-gray-50 dark:bg-gray-800" id="process">
            <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-24 lg:px-6">
                <!-- Row -->
                <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
                    <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                        <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Embark on
                            Prosperity:<br> Utilize as an Investee</h2>
                        <!-- List -->
                        <ul role="list" class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
                            @foreach ($investee_steps as $step)
                            <li class="flex space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">
                                    {{$step}}
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <img class=" w-full mb-4 rounded-lg lg:mb-0 lg:flex" src="{{asset('frontend/investee.jpg')}}"
                        alt="dashboard feature image">
                </div>
                <!-- Row -->
                <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
                    <img class=" w-full mb-4 rounded-lg lg:mb-0 lg:flex" src="{{asset('frontend/investor.jpg')}}"
                        alt="feature image 2">
                    <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                        <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Explore
                            Opportunities:<br> Optimize Your Investor Experience</h2>
                        <!-- List -->
                        <ul role="list" class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
                            @foreach ($investor_steps as $step)
                            <li class="flex space-x-3">
                                <!-- Icon -->
                                <svg class="flex-shrink-0 w-5 h-5 text-purple-500 dark:text-purple-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span
                                    class="text-base font-medium leading-tight text-gray-900 dark:text-white">{{$step}}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End block -->

        {{--
        <!-- Start block -->
        <section class="bg-gray-50 dark:bg-gray-800">
            <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-24 lg:px-6">
                <figure class="max-w-screen-md mx-auto">
                    <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                            fill="currentColor" />
                    </svg>
                    <blockquote>
                        <p class="text-xl font-medium text-gray-900 md:text-2xl dark:text-white">"FundFusion is just
                            awesome. It contains tons of predesigned components and pages starting from login screen to
                            complex dashboard. Perfect choice for your next SaaS application."</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <img class="w-6 h-6 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png"
                            alt="profile picture">
                        <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                            <div class="pr-3 font-medium text-gray-900 dark:text-white">Micheal Gough</div>
                            <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">CEO at Google</div>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </section>
        <!-- End block --> --}}

        @php
        $faqs=[
        "How does FundFusion benefit businesses and startups?" => "FundFusion acts as a vital bridge, connecting
        businesses and startups with potential investors. By providing a user-friendly space to share innovative
        concepts, businesses can access financial support from eager investors, fostering growth, and creating
        opportunities for success.",
        "Can college students benefit from FundFusion?" => "Absolutely! FundFusion recognizes the potential of college
        students and their innovative projects. The platform offers a space for students to register, share their ideas,
        and connect with investors willing to provide the necessary financial support. It aims to empower students and
        turn their projects into reality.",
        "How secure is the FundFusion platform?" => "Security is a top priority for FundFusion. We employ robust
        measures to ensure data security, user privacy, and legal compliance. Our platform is designed to protect user
        ideas, data, and transactions. Continuous monitoring is in place to maintain the platform's integrity, providing
        a safe environment for interactions between investors and capital seekers.",
        ]
        @endphp
        <!-- Start block -->
        <section class="bg-white dark:bg-gray-900" id=faq>
            <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:px-6 mt-4">
                <h2
                    class="mb-6 text-3xl font-extrabold tracking-tight text-center text-gray-900 lg:mb-8 lg:text-3xl dark:text-white">
                    Frequently asked questions</h2>
                @foreach ($faqs as $question=>$answer)
                <div class="max-w-screen-md mx-auto">
                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">

                        <h3 id="accordion-flush-heading-{{$loop->iteration}}">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                data-accordion-target="#accordion-flush-body-{{$loop->iteration}}" aria-expanded="false"
                                aria-controls="accordion-flush-body-{{$loop->iteration}}">
                                <span>{{$question}}</span>
                                <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </h3>
                        <div id="accordion-flush-body-{{$loop->iteration}}" class="hidden"
                            aria-labelledby="accordion-flush-heading-3">
                            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">{{$answer}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>


        <!-- End block -->
        <footer class="bg-white dark:bg-gray-800">
            <div class="max-w-screen-xl p-4 py-6 mx-auto md:p-8 lg:p-10">
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
                <div class="text-center">
                    <a href="{{route('index')}}"
                        class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img src="{{asset('new-dashboard/img/logos/fundfusion_black.png')}}" class="h-6 mr-3 sm:h-9"
                            alt="" /></a>
                    <span class="block text-sm text-center text-gray-500 dark:text-gray-400">
                        <strong>FundFusion</strong> made with ❤️ by Dinesh Baral, Rojal Shakya & Rojina Upreti
                    </span>
                </div>
            </div>
        </footer>
        <script src="{{asset('frontend/main.js')}}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (Session::get('swal_success'))
        <script type="text/javascript">
            Swal.fire({
            title: "{{Session::get('swal_success')}}",
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

    </body>

</html>
