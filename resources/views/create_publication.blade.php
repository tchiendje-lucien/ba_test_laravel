<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Market Place</title>

    @include('include.header_admin')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        @include('include.menu_bar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('include.nav_bar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="container-fluid">
                        <div class="mb-4 shadow card">
                            <div class="py-3 card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Creer une publication</h6>
                            </div>
                            <div class="card-body" style="margin-bottom: 20rem">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @error('desc_prod')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                <form class="form-horizontal form-material"
                                    action="{{ URL::to('/store_publication') }}" method="POST" role="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-4 form-group">
                                                <label class="p-0 col-md-12">Nom du produit</label>
                                                <div class="p-0 col-md-12 border-bottom">
                                                    <input type="texte" class="p-0 border-0 form-control"
                                                        name="nom_prod" value="{{ @old('nom_prod') }}" required>
                                                    @error('nom_prod')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-4 form-group">
                                                <label class="p-0 col-md-12">Prix du produit</label>
                                                <div class="p-0 col-md-12 border-bottom">
                                                    <input type="number" class="p-0 border-0 form-control"
                                                        name="prix_prod" value="{{ @old('prix_prod') }}" required>
                                                    @error('prix_prod')
                                                    <span class="" role="alert" style="color: red">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="p-0 col-md-12 border-bottom">
                                                <label for="exampleFormControlTextarea1">Description
                                                    du produit</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    rows="3" id="desc_prod" name="desc_prod"
                                                    value="{{ @old('desc_prod') }}" required>{{ @old('desc_prod') }}</textarea>
                                                @error('desc_prod')
                                                <span class="" role="alert" style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="upload-imgs">
                                                <div class="img-uploade-row">
                                                    <div class="upload-column">
                                                        <input type="hidden" name="old_image_user" value="" />
                                                        <input onchange="doAfterSelectImage(this)" type="file"
                                                            name="image_prod" class="screenshot" id="screenshot"
                                                            style="display:none">
                                                        <input type="hidden" name="csrf-token"
                                                            value="{{ csrf_token() }}" />
                                                        <label for="screenshot" class="img-uploaders">
                                                            <img src="{{ URL::asset('img/alan-walker-460x460.jpg') }}"
                                                                width="50%" id="post_user_image_" />
                                                        </label>
                                                        @error('image_prod')
                                                        <span class="" role="alert" style="color: red">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2 form-group">
                                                <div class="col-sm-12">
                                                    <input type="submit" class="btn btn-primary" value="Poster"
                                                        style="margin-bottom: -10rem">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- Row -->
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right sidebar -->
                    <!-- ============================================================== -->
                    <!-- .right-sidebar -->
                    <!-- ============================================================== -->
                    <!-- End Right sidebar -->
                    <!-- ============================================================== -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="my-auto text-center copyright">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="rounded scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    @include('include.javasript_admin_link')
</body>

</html>
