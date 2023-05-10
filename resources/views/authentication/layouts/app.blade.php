<!DOCTYPE html>
<html lang="en">
@include('authentication.layouts.header')


@yield('content')

@include('sweetalert::alert')
<!-- jQuery -->
@include('authentication.layouts.script')
</html>
