@extends('dashboard.layouts.app')

@section('title', transWord('إضافة مدرب جديد'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.instructors.index') }}">{{ transWord('الرئيسية') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة مدرب جديد') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ transWord('إضافة مدرب جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="studentsFormCreate"
                                        action="{{ route('admin.instructors.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first_name">{{ transWord('الاسم الاول') }}</label>
                                                    <input type="text" id="first_name" class="form-control"
                                                        name="first_name" value="{{ old('first_name') }}" />
                                                    @error('first_name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="last_name">{{ transWord('الاسم الثاني') }}</label>
                                                    <input type="text" id="last_name" class="form-control"
                                                        name="last_name" value="{{ old('last_name') }}" />
                                                    @error('last_name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="public_name">{{ transWord('الاسم العام') }}</label>
                                                    <input type="text" id="public_name" class="form-control"
                                                        name="public_name" value="{{ old('public_name') }}" />
                                                    @error('public_name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="username">{{ transWord('اسم المستخدم') }}</label>
                                                    <input type="text" id="username" class="form-control"
                                                        name="username" value="{{ old('username') }}" />
                                                    @error('username')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">{{ transWord('البريد الإلكترونى') }}</label>
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        value="{{ old('email') }}" />
                                                    @error('email')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="phone">{{ transWord('رقم الجوال') }}</label>
                                                    <input type="text" id="phone" class="form-control" name="phone"
                                                        value="{{ old('phone') }}" />
                                                    @error('phone')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="password">{{ transWord('كلمة المرور') }}</label>
                                                    <input type="password" id="password" class="form-control"
                                                        name="password" value="{{ old('password') }}" />
                                                    @error('password')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label
                                                        for="password_confirmation">{{ transWord('تأكيد كلمة المرور') }}</label>
                                                    <input type="password" id="password_confirmation"
                                                        class="form-control" name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}" />
                                                    @error('password_confirmation')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="skills">{{ transWord('المهارات الخاصه بك') }}</label>
                                                    <select class="form-control select-multiple" id="skills"
                                                        name="skills[]" multiple="multiple">
                                                        @if (old('skills'))
                                                            @foreach (old('skills') as $item)
                                                                <option selected value="{{ $item }}">
                                                                    {{ $item }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="bio">{{ transWord('bio') }}</label>
                                                    <textarea id="bio" class="form-control" name="bio" style="width: 100%; height: 200px;">{{ old('bio') }}</textarea> @error('bio')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>








                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="avatar"
                                                        class="form-label">{{ transWord('الصوره الشخصيه') }}</label>
                                                    <input class="filepond" type="file" id="avatar" name="avatar"
                                                        required='true'>
                                                    {{-- @error('avatar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror --}}
                                                </div>

                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="background_image"
                                                        class="form-label">{{ transWord('الصوره الخلفيه') }}</label>
                                                    <input class="filepond" type="file" id="background_image"
                                                        name="background_image" required='true'>
                                                    {{-- @error('background_image')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror --}}
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="facebook"
                                                        class="form-label">{{ transWord('رابط الفيس بوك') }}</label>
                                                    <input type="text" id="facebook" class="form-control"
                                                        name="facebook" value="{{ old('facebook') }}" />
                                                    @error('facebook')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="twitter"
                                                        class="form-label">{{ transWord('رابط تويتر') }}</label>
                                                    <input type="text" id="twitter" class="form-control"
                                                        name="twitter" value="{{ old('twitter') }}" />
                                                    @error('twitter')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="github"
                                                        class="form-label">{{ transWord('رابط جيت هب') }}</label>
                                                    <input type="text" id="github" class="form-control"
                                                        name="github" value="{{ old('github') }}" />
                                                    @error('github')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="linkedin"
                                                        class="form-label">{{ transWord('رابط لينكدان') }}</label>
                                                    <input type="text" id="linkedin" class="form-control"
                                                        name="linkedin" value="{{ old('linkedin') }}" />
                                                    @error('linkedin')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="website"
                                                        class="form-label">{{ transWord('رابط موقعك') }}</label>
                                                    <input type="text" id="website" class="form-control"
                                                        name="website" value="{{ old('website') }}" />
                                                    @error('website')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <input type="hidden" id='route_username'
                                                value="{{ route('admin.check.username') }}">
                                            <input type="hidden" id='route_email'
                                                value="{{ route('admin.check.email') }}">
                                            <input type="hidden" id='route_phone'
                                                value="{{ route('admin.check.phone') }}">




                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ transWord('حفظ') }}</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
        <script>
            $(".select-multiple").select2({
                tags: true
            });
        </script>
        <script src="{{ asset('dashboard/assets/js/custom/validation/students.js') }}"></script>
        <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>


        <script>
            var avatarIntstructer = null;

            const avatar = document.querySelector('input#avatar');
            const pond1 = FilePond.create((avatar), {
                acceptedFileTypes: ['image/*'],
                labelFileTypeNotAllowed: window.avatarMessage,
                minFileSize: '0.5MB',
                maxFileSize: '30MB',
                labelMaxFileSizeExceeded: "{{ transWord('الحد الاقصى لحجم الملف هو') }}",
                labelFileProcessing: "{{ transWord('جاري التحميل') }}",
                labelFileProcessingComplete: "{{ transWord('تم التحميل') }}",
                labelTapToCancel: "{{ transWord('انقر للغاء') }}",
                labelTapToRetry: "{{ transWord('انقر للاعاده') }}",
                labelIdle: "{{ transWord('قم بسحب الصوره او') }} <span class='filepond--label-action' tabindex='0'> انقر هنا </span>",
                onprocessfile: function(error, file) {
                    if (error) {
                        console.log('حدث خطأ أثناء معالجة الملف:', error);
                    } else {

                        avatarIntstructer = file.serverId;
                        localStorage.setItem('avatarIntstructer', avatarIntstructer);
                    }
                }
            });
            pond1.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        const baseUrl = "http://127.0.0.1:8000/storage/";
                        let imageUrl = source;

                        // Check if the source starts with the base URL twice
                        while (imageUrl.startsWith(baseUrl + baseUrl)) {
                            imageUrl = imageUrl.replace(baseUrl, "");
                        }



                        // const imageUrl = "{{ asset('storage/' . old('upload_vidoe')) }}";

                        fetch(imageUrl).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'students']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'students']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                }
            });
            @if ($errors->isNotEmpty() && old('avatar'))
                pond1.addFiles([{
                    source: "{{ asset('storage/' . old('avatar')) }}",
                    options: {
                        type: 'local',
                    }
                }]);
            @endif
            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                const uploadedFileId = localStorage.getItem('avatarIntstructer');
                const url = "{{ route('admin.tmp.refrsh') }}";
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        file: uploadedFileId
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        localStorage.removeItem('avatarIntstructer');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>

        <script>
            var background_imageInstrutor = null;

            const background = document.querySelector('input#background_image');
            const pond2 = FilePond.create((background), {
                acceptedFileTypes: ['image/*'],
                labelFileTypeNotAllowed: window.avatarMessage,
                minFileSize: '0.5MB',
                maxFileSize: '30MB',
                labelMaxFileSizeExceeded: "{{ transWord('الحد الاقصى لحجم الملف هو') }}",
                labelFileProcessing: "{{ transWord('جاري التحميل') }}",
                labelFileProcessingComplete: "{{ transWord('تم التحميل') }}",
                labelTapToCancel: "{{ transWord('انقر للغاء') }}",
                labelTapToRetry: "{{ transWord('انقر للاعاده') }}",
                labelIdle: "{{ transWord('قم بسحب الصوره او') }} <span class='filepond--label-action' tabindex='0'> انقر هنا </span>",
                onprocessfile: function(error, file) {
                    if (error) {
                        console.log('حدث خطأ أثناء معالجة الملف:', error);
                    } else {

                        background_imageInstrutor = file.serverId;
                        localStorage.setItem('background_imageInstrutor', background_imageInstrutor);
                    }
                }

            });
            pond2.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        const baseUrl = "http://127.0.0.1:8000/storage/";
                        let imageUrl = source;

                        // Check if the source starts with the base URL twice
                        while (imageUrl.startsWith(baseUrl + baseUrl)) {
                            imageUrl = imageUrl.replace(baseUrl, "");
                        }



                        // const imageUrl = "{{ asset('storage/' . old('upload_vidoe')) }}";

                        fetch(imageUrl).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'instructors']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'instructors']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                }
            });
            @if ($errors->isNotEmpty() && old('background_image'))
                pond2.addFiles([{
                    source: "{{ asset('storage/' . old('background_image')) }}",
                    options: {
                        type: 'local',
                    }
                }]);
            @endif
            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                const uploadedFileId = localStorage.getItem('background_imageInstrutor');
                const url = "{{ route('admin.tmp.refrsh') }}";
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        file: uploadedFileId
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        localStorage.removeItem('background_imageInstrutor');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>
    @endpush
@endsection
