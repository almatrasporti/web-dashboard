<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almatrasporti Dashboard</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link
        href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@next/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"
            integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>


</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
<div id="app">

    <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">


        <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

            <div class="w-1/2 pl-2 md:pl-0">
                <a class="text-gray-900 text-base xl:text-xl no-underline hover:no-underline font-bold" href="#">
                    <i class="fas fa-sun text-pink-600 pr-3"></i> Almatrasporti
                </a>
            </div>
            <div class="w-1/2 pr-0">
                <div class="flex relative inline-block float-right">

                    <div class="relative text-sm">

                    </div>



                </div>

            </div>


            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white z-20"
                 id="nav-content">
                <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                    <li class="mr-6 my-2 md:my-0">
                        <a href="/"
                           class="block py-1 md:py-3 pl-1 align-middle text-pink-600 no-underline hover:text-gray-900 border-b-2 border-orange-600 hover:border-orange-600">
                            <i class="fas fa-chart-area fa-fw mr-3 text-pink-600"></i><span
                                class="pb-1 md:pb-0 text-sm">Dashboard</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="/forecast"
                           class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-pink-500">
                            <i class="fas fa-eye fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Forecast</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <reset-redis/>
                    </li>
                </ul>

                <div class="relative pull-right pl-4 pr-4 md:pr-0">

                </div>

            </div>

        </div>
    </nav>

    <!--Container-->
    <div class="container w-full mx-auto pt-20">

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <!--Console Content-->

            <widgets></widgets>

            <!--Divider-->
            <hr class="border-b-2 border-gray-400 my-8 mx-4">

            <div class="flex flex-row flex-wrap flex-grow mt-2">

                <div class="w-full lg:w-1/2 p-3">
                    <!--Graph Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Map</h5>
                        </div>
                        <div class="p-5">
{{--                            <mb-map></mb-map>--}}
                            <select-vehicle></select-vehicle>
                            <g-map style="width: 100%; height: 400px"></g-map>
                        </div>
                    </div>
                    <!--/Graph Card-->
                </div>

                <div class="w-full lg:w-1/2 p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Vehicle data</h5>
                        </div>
                        <div class="p-5">
                            <vehicle-table></vehicle-table>
                        </div>
                    </div>
                    <!--/table Card-->
                </div>

{{--                <div class="w-full lg:w-1/2 p-3">--}}
{{--                    <!--Table Card-->--}}
{{--                    <div class="bg-white border rounded shadow">--}}
{{--                        <div class="border-b p-3">--}}
{{--                            <h5 class="font-bold uppercase text-gray-600">Services status</h5>--}}
{{--                        </div>--}}
{{--                        <div class="p-5">--}}
{{--                            <service-table></service-table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!--/table Card-->--}}
{{--                </div>--}}


            </div>

            <!--/ Console Content-->

        </div>


    </div>
    <!--/container-->

    <footer class="bg-white border-t border-gray-400 shadow">
        <div class="container max-w-md mx-auto flex py-8">

            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full md:w-1/2 ">
                    <div class="px-8">
                        <h3 class="font-bold font-bold text-gray-900"></h3>
                        <p class="py-4 text-gray-600 text-sm">
                        </p>
                    </div>
                </div>

                <div class="flex w-full md:w-1/2">
                    <div class="px-8">
                        <h3 class="font-bold font-bold text-gray-900"></h3>
                        <ul class="list-reset items-center text-sm pt-3">
                            <li>
                                <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1"
                                   href="#"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </footer>

    {{--    <script>--}}
    {{--        /*Toggle dropdown list*/--}}
    {{--        /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/--}}

    {{--        var userMenuDiv = document.getElementById("userMenu");--}}
    {{--        var userMenu = document.getElementById("userButton");--}}

    {{--        var navMenuDiv = document.getElementById("nav-content");--}}
    {{--        var navMenu = document.getElementById("nav-toggle");--}}

    {{--        document.onclick = check;--}}

    {{--        function check(e) {--}}
    {{--            var target = (e && e.target) || (event && event.srcElement);--}}

    {{--            //User Menu--}}
    {{--            if (!checkParent(target, userMenuDiv)) {--}}
    {{--                // click NOT on the menu--}}
    {{--                if (checkParent(target, userMenu)) {--}}
    {{--                    // click on the link--}}
    {{--                    if (userMenuDiv.classList.contains("invisible")) {--}}
    {{--                        userMenuDiv.classList.remove("invisible");--}}
    {{--                    } else {--}}
    {{--                        userMenuDiv.classList.add("invisible");--}}
    {{--                    }--}}
    {{--                } else {--}}
    {{--                    // click both outside link and outside menu, hide menu--}}
    {{--                    userMenuDiv.classList.add("invisible");--}}
    {{--                }--}}
    {{--            }--}}

    {{--            //Nav Menu--}}
    {{--            if (!checkParent(target, navMenuDiv)) {--}}
    {{--                // click NOT on the menu--}}
    {{--                if (checkParent(target, navMenu)) {--}}
    {{--                    // click on the link--}}
    {{--                    if (navMenuDiv.classList.contains("hidden")) {--}}
    {{--                        navMenuDiv.classList.remove("hidden");--}}
    {{--                    } else {--}}
    {{--                        navMenuDiv.classList.add("hidden");--}}
    {{--                    }--}}
    {{--                } else {--}}
    {{--                    // click both outside link and outside menu, hide menu--}}
    {{--                    navMenuDiv.classList.add("hidden");--}}
    {{--                }--}}
    {{--            }--}}

    {{--        }--}}

    {{--        function checkParent(t, elm) {--}}
    {{--            while (t.parentNode) {--}}
    {{--                if (t == elm) {--}}
    {{--                    return true;--}}
    {{--                }--}}
    {{--                t = t.parentNode;--}}
    {{--            }--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--    </script>--}}


</div>
<script src="js/app.js"></script>
</body>

</html>
