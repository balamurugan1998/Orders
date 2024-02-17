@include('order.layout.header')
@include('order.layout.horizontal_right_menu')
@include('order.layout.vertical_side_menu')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Dashboards</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Dashboards</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="grey-bg container-fluid">
                                <section id="minimal-statistics">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="card">
                                                <div class="card-content" style="background-color: #e7e7e7;box-shadow: 0 4px 6px rgba(52,58,64,.06);">
                                                    <div class="card-body">
                                                        <div class="media d-flex">
                                                            <div class="align-self-center">
                                                                <i
                                                                    class="icon-pencil primary font-large-2 float-left"></i>
                                                            </div>
                                                            <div class="media-body text-right">
                                                                <h3>{{$orders}}</h3>
                                                                <span>Total Orders</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <h4 class="card-title"> </h4>
                            <p class="card-title-desc"></p>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('order.layout.footer')

    @stack('adminside-js')
