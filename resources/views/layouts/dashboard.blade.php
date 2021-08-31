<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.8
*
-->

<!DOCTYPE html>
<html>

@include('css.header')


<body >
<div id="wrapper">
    @include('partials.sidebar')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('partials.header')
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
        @yield('content')
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>

</div>

@include('scripts.footer')

</body>
</html>
