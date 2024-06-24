@extends('template.mainIndex')

@section('title')
    <title>Request User</title>
    <style>
        .invalid-feedback {
            color: red;
        }
    </style>
@endsection

@section('modal')
    {{-- new request user for hosxp modal start --}}
    <div class="modal fade" id="request_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="request_user_title">Add New Ita Sub 1</h5>
                    <button type="button" class="btn-close clearForm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" class="form pt-3" id="request_user_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_user_id" class="request_user_id" id="request_user_id">
                    <input type="hidden" name="mode" id="mode" value="">
                    <div class="row mb-3 container-sm">
                        <label for="birthdate"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('วันเดือนปีเกิด') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                name="birthdate" id="birthdate" required autocomplete="birthdate" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="joindate"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('วันที่เข้าทำงาน') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="date" class="form-control @error('joindate') is-invalid @enderror"
                                name="joindate" id="joindate" required autocomplete="joindate" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="คำนำหน้า"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('คำนำหน้า') }}</label>

                        <div class="col-12 col-md-6">
                            <select class="form-select @error('prefix_id') is-invalid @enderror"
                                aria-label="Default select example" id="prefix_id" name="prefix_id">
                                <option selected autofocus value="0">คำนำหน้า</option>
                                @if (isset($prefixes))
                                    @foreach ($prefixes as $prefix)
                                        <option value="{{ $prefix->id }}">{{ $prefix->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="thai_first_name"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('ชื่อภาษาไทย') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" name="thai_first_name" id="thai_first_name" required
                                autocomplete="thai_first_name" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="thai_last_name"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('นามสกุลภาษาไทย') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control @error('thai_last_name') is-invalid @enderror"
                                name="thai_last_name" id="thai_last_name" required autocomplete="thai_last_name" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="eng_first_name"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('ชื่อภาษาอังกฤษ') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" name="eng_first_name" id="eng_first_name" required
                                autocomplete="eng_first_name" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="eng_last_name"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('นามสกุลภาษาอังกฤษ') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control @error('eng_last_name') is-invalid @enderror"
                                name="eng_last_name" id="eng_last_name" required autocomplete="eng_last_name" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="cid" class="col-12 col-md-4 col-form-label text-md-end">{{ __('cid') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control @error('cid') is-invalid @enderror" name="cid"
                                id="cid" required autocomplete="cid" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="ตำแหน่ง"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('ตำแหน่ง') }}</label>

                        <div class="col-12 col-md-6">
                            <select class="form-select @error('role_id') is-invalid @enderror"
                                aria-label="Default select example" id="role_id" name="role_id">
                                <option selected autofocus value="0">ตำแหน่ง</option>
                                @if (isset($roles))
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="แผนก" class="col-12 col-md-4 col-form-label text-md-end">{{ __('แผนก') }}</label>

                        <div class="col-12 col-md-6">
                            <select class="form-select @error('department_id') is-invalid @enderror"
                                aria-label="Default select example" id="department_id" name="department_id">
                                <option selected autofocus value="0">แผนก</option>
                                @if (isset($departmentes))
                                    @foreach ($departmentes as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="เลขใบประกอบวิชาชีพ"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('เลขใบประกอบวิชาชีพ') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control @error('medical_license_no') is-invalid @enderror"
                                name="medical_license_no" id="medical_license_no" required
                                autocomplete="medical_license_no" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="วันที่ได้รับใบประกอบวิชาชีพ"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('วันที่ได้รับใบประกอบวิชาชีพ') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="date"
                                class="form-control @error('medical_license_start') is-invalid @enderror"
                                name="medical_license_start" id="medical_license_start"
                                autocomplete="medical_license_start" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="วันหมดอายุ"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('วันหมดอายุ') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="date"
                                class="form-control @error('medical_license_expire') is-invalid @enderror"
                                name="medical_license_expire" id="medical_license_expire"
                                autocomplete="medical_license_expire" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="Username"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control @error('emp_username') is-invalid @enderror"
                                name="emp_username" id="emp_username" required autocomplete="emp_username" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3 container-sm">
                        <label for="Password"
                            class="col-12 col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-12 col-md-6">
                            <div class="input-group">
                                <i class="bi bi-eye input-group-text toggleIcon" type="button" id="togglePassword"></i>
                                <input type="password" class="form-control @error('emp_password') is-invalid @enderror w-75"
                                name="emp_password" id="emp_password" required autocomplete="emp_password" autofocus>
                            </div>
                            {{-- <button class="btn btn-light" type="button" id="togglePassword" style="position: absolute; top: 0; left: 11.5rem; width: 40px;">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button> --}}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger clearForm" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" id="request_user_btn" class="btn btn-outline-success">ส่งคำร้อง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- new request user for hosxp modal end --}}

    {{-- request user for hosxp detail modal Start --}}
    <div class="modal fade" id="request_user_detail_modal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="request_user_detail_title"></h5>
                    <button type="button" class="btn-close clearForm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container">
                    <div class="mt-3">
                        <p>วันที่ร้องขอ : <span id="detail_created_at"></span></p>
                        <p>เลขบัตรประจำตัวประชาชน : <span id="detail_cid"></span></p>
                        <p>ชื่อ-นามสกุลภาษาไทย : <span id="detail_prefix_id"></span><span id="detail_thai_first_name"></span> <span id="detail_thai_last_name"></span></p>
                        <p>ชื่อ-นามสกุลภาษาอังกฤษ : <span id="detail_eng_first_name"></span> <span id="detail_eng_last_name"></span></p>
                        <p>ตำแหน่ง : <span id="detail_role_id"></span></p>
                        <p>แผนก : <span id="detail_department_id"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger clearForm" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </div>
        </div>
    </div>
    {{-- request user for hosxp detail modal End --}}

@endsection

@section('content')
    <div class="">
        <div class="row pb-5" style="margin-top: 3rem;">
            <div class="col-lg-12 mb-5">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background: #866ec7">
                        <h4 class="text-light">คำร้องขอ User เพื่อเข้าใช้งานระบบ HoSXP</h4>
                        <button class="btn btn-light addIcon" data-bs-toggle="modal"
                            data-bs-target="#request_user_modal"><i class="bi-plus-circle me-2"></i>เพิ่มคำร้องขอ</button>
                    </div>
                    <div class="card-body">
                        <div class="contaier">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="table-responsive" id="request_user_show_all">
                                        {{-- <h1 class="text-center text-secondary my-5">Loading...</h1> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            $('.addIcon').on('click', function() {
                $('#request_user_title').text('เพิ่มคำร้องขอ User');
                $('#mode').attr('value', 'add');
                $('#file').empty();
                $("#request_user_form")[0].reset();
            });

            $(document).on('click', '.editIcon', function() {
                $('#request_user_title').text('แก้ไขคำร้องขอ User');
                $('#mode').attr('value', 'edit');
            });

            $(document).on('click', '.detailIcon', function() {
                $('#request_user_detail_title').text('รายละเอียด');
            });

            $(document).on('click', '.clearForm', function() {
                $('#file').empty();
                $("#request_user_form")[0].reset();
                $(".error").empty();
            });

            $.validator.addMethod("regex", function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            });

            $('#request_user_form').validate({
                rules: {
                    "birthdate": {
                        required: true
                    },
                    "joindate": {
                        required: true
                    },
                    "thai_first_name": {
                        required: true,
                        minlength: 5,
                        regex: /^[ก-๏ๆๅ]+$/u
                    },
                    "thai_last_name": {
                        required: true,
                        minlength: 5,
                        regex: /^[ก-๏ๆๅ]+$/u
                    },
                    "eng_first_name": {
                        required: true,
                        minlength: 5,
                        regex: /^[A-Z][a-zA-Z]*$/
                    },
                    "eng_last_name": {
                        required: true,
                        minlength: 5,
                        regex: /^[A-Z][a-zA-Z]*$/
                    },
                    "cid": {
                        required: true,
                        minlength: 13,
                        regex: /^\d+$/
                    },
                    "medical_license_no": {
                        required: true,
                        regex: /^[^a-zA-Z]+$/
                    },
                    "emp_username": {
                        required: true
                    },
                    "emp_password": {
                        required: true,
                        minlength: 6,
                        regex: /^(?=.*[!@#$%^&*])/
                    }
                },
                messages: {
                    "birthdate": {
                        required: "กรุณากรอกวันเดือนปีเกิด"
                    },
                    "joindate": {
                        required: "กรุณากรอกวันเดือนปีที่เข้าทำงาน"
                    },
                    "thai_first_name": {
                        required: "กรุณากรอกชื่อ",
                        minlength: "ห้ามกรอกตัวอักษรต่ำกว่า 5 ตัว",
                        regex: "กรอกได้แค่ภาษาไทยเท่านั้นและห้ามมีช่องว่าง!"
                    },
                    "thai_last_name": {
                        required: "กรุณากรอกนามสกุล",
                        minlength: "ห้ามกรอกตัวอักษรต่ำกว่า 5 ตัว",
                        regex: "กรอกได้แค่ภาษาไทยเท่านั้นและห้ามมีช่องว่าง!"
                    },
                    "eng_first_name": {
                        required: "กรุณากรอกชื่อ",
                        minlength: "ห้ามกรอกตัวอักษรต่ำกว่า 5 ตัว",
                        regex: "กรอกได้แค่ภาษาอังกฤษและตัวอักษรแรกต้องเป็นตัวใหญ่เท่านั้น!"
                    },
                    "eng_last_name": {
                        required: "กรุณากรอกนามสกุล",
                        minlength: "ห้ามกรอกตัวอักษรต่ำกว่า 5 ตัว",
                        regex: "กรอกได้แค่ภาษาอังกฤษและตัวอักษรแรกต้องเป็นตัวใหญ่เท่านั้น!"
                    },
                    "cid": {
                        required: "กรุณากรอกเลขบัตรประจำตัวประชาชน",
                        minlength: "ห้ามกรอกตัวอักษรต่ำกว่า 13 ตัว",
                        regex: "กรอกได้แค่ตัวเลขเท่านั้น!"
                    },
                    "medical_license_no": {
                        required: "กรุณากรอกเลขใบประกอบวิชาชีพ",
                        regex: "ห้ามกรอกตัวภาษาอังกฤษ"
                    },
                    "emp_username": {
                        required: "กรุณากรอก Username"
                    },
                    "emp_password": {
                        required: "กรุณากรอก Password",
                        minlength: "ห้ามกรอกตัวอักษรต่ำกว่า 6 ตัว",
                        regex: "Password ควรมีอักขระพิเศษประกอบด้วย"
                    }
                },
                errorPlacement: function(error, element) {
                    // var br = $("<br>");
                    // br.insertAfter(element);
                    error.css({
                        'color': 'red',
                        // 'display': 'block',
                        // 'margin-top': '5px'
                    });
                    error.insertAfter(element);
                },
                success: function(label, element) {
                    $(element).next('label.error').remove();
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass(errorClass);
                    $(element).next('label.error').remove();
                }
            });

            function removeModal() {
                $('#request_user_modal').css('display', 'none');
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open').removeAttr('style');
            }

            $('#togglePassword').on('click', function () {
                const passwordField = $('#emp_password');
                const passwordFieldType = passwordField.attr('type');
                const toggleIcon = $('.toggleIcon');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    toggleIcon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    toggleIcon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });


            $(function() {

                // add new request user ajax request
                $("#request_user_form").submit(function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    const mode = $('#mode').val();
                    if (mode === 'add') {
                        $.ajax({
                            url: '{{ route('request_create') }}',
                            method: 'post',
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire(
                                        response.title,
                                        response.message,
                                        response.icon
                                    )
                                    fetchAllRequestUser();
                                    $("#request_user_form")[0].reset();
                                    removeModal();
                                } else {
                                    Swal.fire(
                                        response.title,
                                        response.message,
                                        response.icon
                                    )
                                }
                            }
                        });
                    } else if (mode === 'edit') {
                        $.ajax({
                            url: '{{ route('request_update') }}',
                            method: 'post',
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire(
                                        response.title,
                                        response.message,
                                        response.icon
                                    )
                                    fetchAllRequestUser();
                                    $("#request_user_form")[0].reset();
                                    removeModal();
                                } else {
                                    Swal.fire(
                                        response.title,
                                        response.message,
                                        response.icon
                                    )
                                }
                            }
                        });
                    }
                });

                // request user fetch one record ajax request
                $(document).on('click', '.editIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('request_fetch_one') }}',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $("#birthdate").val(response.birthdate);
                            $("#joindate").val(response.joindate);
                            $("#prefix_id").val(response.prefix_id);
                            $("#thai_first_name").val(response.thai_first_name);
                            $("#thai_last_name").val(response.thai_last_name);
                            $("#eng_first_name").val(response.eng_first_name);
                            $("#eng_last_name").val(response.eng_last_name);
                            $("#cid").val(response.cid);
                            $("#department_id").val(response.department_id);
                            $("#role_id").val(response.role_id);
                            $("#medical_license_no").val(response.medical_license_no);
                            $("#medical_license_start").val(response.medical_license_start);
                            $("#medical_license_expire").val(response.medical_license_expire);
                            $("#emp_username").val(response.emp_username);
                            $("#emp_password").val(response.emp_password);
                            $("#request_user_id").val(response.id);
                        }
                    });
                });

                // fetch all request user ajax request
                fetchAllRequestUser();

                function fetchAllRequestUser() {
                    $.ajax({
                        url: '{{ route('requestUserFetchAll') }}',
                        method: 'get',
                        success: function(response) {
                            $("#request_user_show_all").html(response);
                            $("table").DataTable({
                                responsive: true,
                                order: [0, 'desc']
                            });
                        }
                    });
                }

                $(document).on('click', '.detailIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('request_detail') }}',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $("#detail_cid").text(response.cid);
                            $('#detail_created_at').text(response.created_at);
                            $('#detail_prefix_id').text(response.prefix_name);
                            $('#detail_thai_first_name').text(response.thai_first_name);
                            $('#detail_thai_last_name').text(response.thai_last_name);
                            $('#detail_eng_first_name').text(response.eng_first_name);
                            $('#detail_eng_last_name').text(response.eng_last_name);
                            $('#detail_role_id').text(response.role_name);
                            $('#detail_department_id').text(response.department_name);
                        }
                    });
                });
            });
        });
    </script>
@endsection
