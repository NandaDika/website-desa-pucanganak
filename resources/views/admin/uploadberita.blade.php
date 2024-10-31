<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Desa Pucanganak - Berita</title>
    <link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/uploadberita.css')}}">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            @include('component.adminsidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('component.admintopbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <!-- Card for form styling -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Buat Berita</h6>
                      </div>
                      <div class="card-body">
                        <!-- Blog Form Start -->
                        <form action="/admin/berita/upload" method="POST" enctype="multipart/form-data" onsubmit="submitQuillContent()">
                        @csrf
                          <!-- Blog Title -->
                          <div class="mb-3">
                            <label for="blogTitle" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="blogTitle" name="title" placeholder="Enter blog title" required>
                          </div>

                          <!-- Blog Content -->
                          <div class="mb-3">
                            <label for="blogContent" class="form-label">Konten</label>
                            <!-- Quill editor container -->
                            <div id="editor-container"></div>
                            <!-- Hidden input to store Quill content for form submission -->
                            <input type="hidden" name="content" id="content" required>
                          </div>

                          <!-- Thumbnail Upload -->
                          <div class="mb-3">
                            <label for="thumbnailUpload" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnailUpload" name="thumbnail" accept="image/*" onchange="showThumbnailPreview(event)">
                            <div class="mt-3">
                              <div class="thumbnail-preview" id="thumbnailPreview">
                                <!-- Thumbnail will be shown here after upload -->
                              </div>
                            </div>
                          </div>

                          <!-- Multiple Image Upload -->
                          <div class="mb-3">
                            <label for="multiImageUpload" class="form-label">Dokumentasi</label>
                            <input type="file" class="form-control" id="multiImageUpload" name="images[]" multiple accept="image/*" onchange="showMultiImagePreview(event)">
                            <div class="mt-3 multi-image-preview" id="multiImagePreview">
                              <!-- Multiple image previews will be shown here after upload -->
                            </div>
                          </div>

                          <!-- Submit Button -->
                          <button type="submit" class="btn btn-primary">Buat Berita</button>
                        </form>
                        <!-- Blog Form End -->
                      </div>
                    </div>
                  </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Desa Pucanganak</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('component.logoutmodel')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        // Thumbnail image preview function
        function showThumbnailPreview(event) {
          const thumbnailPreview = document.getElementById('thumbnailPreview');
          thumbnailPreview.innerHTML = ''; // Clear any previous preview
          const file = event.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
              const img = document.createElement('img');
              img.src = e.target.result;
              thumbnailPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
          }
        }

        // Multiple image preview function
        function showMultiImagePreview(event) {
          const multiImagePreview = document.getElementById('multiImagePreview');
          multiImagePreview.innerHTML = ''; // Clear any previous previews
          const files = event.target.files;
          if (files) {
            Array.from(files).forEach(file => {
              const reader = new FileReader();
              reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                multiImagePreview.appendChild(img);
              };
              reader.readAsDataURL(file);
            });
          }
        }

        // Initialize Quill editor
        const quill = new Quill('#editor-container', {
          theme: 'snow'
        });

        // Submit Quill content to hidden input
        function submitQuillContent() {
          const content = document.querySelector('input[name=content]');
          content.value = quill.root.innerHTML;
        }
      </script>

</body>

</html>
