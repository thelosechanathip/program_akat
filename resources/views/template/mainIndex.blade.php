<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.patials.header')

    @yield('title')
</head>

<body>
    @yield('modal')

    <div class="wrapper d-flex align-items-stretch">
        @include('template.patials.sidebar')

        <div id="content" class="px-2 p-md-5 pt-5" style="margin-top: 20px;">
            @yield('content')
        </div>
    </div>
    {{-- @include('template.patials.script') --}}
    @yield('script')

</body>

</html>
