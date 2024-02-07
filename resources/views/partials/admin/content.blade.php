<div class="dash-container">
    <div class="dash-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header" style="    padding-left: 20px;">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6 mt-3">
                        <div class="page-header-title">
                            <h4 class="m-b-10">@yield('title')</h4>
                        </div>
                        <ul class="breadcrumb">
                            @yield('breadcrumb')
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <div class="col-12">
                            @yield('filter')
                        </div>
                        <div class="col-12 text-end mt-3">
                            @yield('action-btn')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        @yield('content')
        <div id = "loader" style = "display:none">
            <img src = "{{asset('assets/loader/loader.webp')}}"  >
        </div>
    </div>
</div>

