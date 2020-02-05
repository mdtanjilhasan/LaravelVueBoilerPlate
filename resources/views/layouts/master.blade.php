<!doctype html>
<html class="no-js" lang="en">
    <head>
        @include('layouts.partial.head')
        @yield('style')
        @if(Auth::check())
            <script>
                window.Laravel = <?php echo json_encode([
                    'permissions' => Auth::user()->roles[0]->permissions()->pluck('name')->toArray()
                ]); ?>
            </script>
        @endif
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrapper">
            @include('layouts.partial.header')

            <div class="page-wrap" id="app">
                <!-- sidebar -->
                <sidebar-component></sidebar-component>

                <div class="main-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>

                <!-- aside right-sidebar -->

                {{-- @include('layouts.partial.right-sidebar') --}}

                <!-- end aside right-sidebar -->

                <!-- chat-panel -->

                {{-- @include('layouts.partial.chat-panel') --}}

                <!-- end-chat-panel -->

                @include('layouts.partial.footer')
            </div>
        </div>
        @include('layouts.includes._menu_modal')
        @include('layouts.partial.footer-script')
        @yield('script')
        @yield('extra-script')
    </body>
</html>
