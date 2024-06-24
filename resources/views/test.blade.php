<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Program Akat Hospital</title>
</head>

<body>
    {{-- Navbar Start --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center" style="margin-left: 30px;">
                <img src="https://co-vaccine.moph.go.th/assets/images/moph-logo.gif" width="50" height="50"
                    alt="">
                <a class="navbar-brand font-bold ms-3" href="http://www.akathospital.com">Akathospital</a>
            </div>
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop"
                aria-controls="offcanvasWithBackdrop"><span class="navbar-toggler-icon"></span></button>
        </div>
    </nav>
    {{-- Navbar End --}}

    {{-- Sidebar & Content & footer Start --}}
    <div class="d-flex" id="sidebar_content_footer">
        <div class="content_footer">
            <div class="content">
                {{-- new user ita sub 1 start --}}
                <div class="modal fade" id="ItaSub1Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title">Add New Ita Sub 1</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    onclick="clearEditForm();"></button>
                            </div>
                            <form action="#" method="POST" class="form pt-3" id="itaSub1_form"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="itaSub1_id" class="itaSub1_id" id="itaSub1_id">
                                <input type="hidden" name="itaSub1_file" id="itaSub1_file">
                                <input type="hidden" name="mode" id="mode" value="">

                                <div class="row mb-3 container-sm">
                                    <label for="name"
                                        class="col-12 col-md-4 col-form-label text-md-end">{{ __('Ita Sub Name') }}</label>

                                    <div class="col-12 col-md-6">
                                        <input type="text"
                                            class="form-control @error('ita_sub_name') is-invalid @enderror"
                                            name="ita_sub_name" id="ita_sub_name" required autocomplete="ita_sub_name"
                                            autofocus>
                                    </div>
                                </div>

                                <div class="row mb-3 container-sm">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('เลือก File') }}</label>

                                    <div class="col-md-6">
                                        <input type="file" class="form-control" name="file">
                                        <div id="file"></div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="clearEditForm();">Close</button>
                                    <button type="submit" id="itaSub_btn" class="btn btn-primary">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--  new ita sub 1 modal end --}}

                <div class="h-100">
                    <div class="row pb-5" style="margin-top: 3rem;">
                        <div class="col-lg-12 mb-5">
                            <div class="card shadow">
                                <div class="card-header d-flex justify-content-between align-items-center" style="background: #866ec7">
                                    <h4 class="text-light">คำร้องขอ User เพื่อเข้าใช้งานระบบ HoSXP</h4>
                                    <button class="btn btn-light addIcon" data-bs-toggle="modal" data-bs-target="#ItaSub1Modal"><i
                                            class="bi-plus-circle me-2"></i>เพิ่มคำร้องขอ</button>
                                </div>
                                <div class="card-body" id="show_all_itaSub1">
                                    <h1 class="text-center text-secondary my-5">Loading...</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer p-3 d-flex justify-content-center align-items-center fixed-bottom">
                Akathospital Copy
            </div>
        </div>
    </div>
    {{-- Sidebar & Content & footer End --}}

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop"
        aria-labelledby="offcanvasWithBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Program Akathospital</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>.....</p>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.addIcon').on('click', function() {
                $('#title').text('Add new ita sub 1');
                $('#mode').attr('value', 'add');
                $('#file').empty();
                $("#itaSub1_form")[0].reset();
            });

            $(document).on('click', '.editIcon', function() {
                $('#title').text('Update ita sub 1');
                $('#mode').attr('value', 'edit');
            })

            function clearEditForm() {
                $('#file').empty();
                $("#itaSub1_form")[0].reset();
            }
        });
    </script>
</body>

</html>
