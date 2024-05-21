@extends('dashboard.layouts.app')

@section('title', transWord('إضافة طالب جديد'))

@push('css')
    {{-- <style>
        /* use a hand cursor intead of arrow for the action buttons */
        .filepond--file-action-button {
            cursor: pointer;
        }

        /* the text color of the drop label*/
        .filepond--drop-label {
            color: #555;
        }

        /* underline color for "Browse" button */
        .filepond--label-action {
            text-decoration-color: #aaa;
        }

        /* the background color of the filepond drop area */
        .filepond--panel-root {
            background-color: #eee;
        }

        /* the border radius of the drop area */
        .filepond--panel-root {
            border-radius: 0.5em;
        }

        /* the border radius of the file item */
        .filepond--item-panel {
            border-radius: 0.5em;
        }

        /* the background color of the file and file panel (used when dropping an image) */
        .filepond--item-panel {
            background-color: #555;
        }

        /* the background color of the drop circle */
        .filepond--drip-blob {
            background-color: #999;
        }

        /* the background color of the black action buttons */
        .filepond--file-action-button {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* the icon color of the black action buttons */
        .filepond--file-action-button {
            color: white;
        }

        /* the color of the focus ring */
        .filepond--file-action-button:hover,
        .filepond--file-action-button:focus {
            box-shadow: 0 0 0 0.125em rgba(255, 255, 255, 0.9);
        }

        /* the text color of the file status and info labels */
        .filepond--file {
            color: white;
        }

        /* error state color */
        [data-filepond-item-state*='error'] .filepond--item-panel,
        [data-filepond-item-state*='invalid'] .filepond--item-panel {
            background-color: red;
        }

        [data-filepond-item-state='processing-complete'] .filepond--item-panel {
            background-color: green;
        }

        /* bordered drop area */
        .filepond--panel-root {
            background-color: transparent;
            border: 2px solid #2c3340;
        }
    </style> --}}
@endpush
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
                                            href="{{ route('admin.students.index') }}">{{ transWord('الرئيسية') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة طالب جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة طالب جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="studentsFormCreate"
                                        action="{{ route('admin.students.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" id='route_username'
                                                value="{{ route('admin.check.username') }}">
                                            <input type="hidden" id='route_email' value="{{ route('admin.check.email') }}">
                                            <input type="hidden" id='route_phone' value="{{ route('admin.check.phone') }}">

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
                                                    <textarea id="bio" class="form-control tinyEditor" name="bio" style="width: 100%; height: 200px;">{{ old('bio') }}</textarea> @error('bio')
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






                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1"
                                                    id="btn_students">{{ transWord('حفظ') }}</button>
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
        {{-- <script src="https://cdn.tiny.cloud/1/ncu4y607nayo1coo3vekski4tweqhf55lrvzpu0mnmnsstgw/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                menubar: false,
                selector: 'textarea.tinyEditor',
                plugins: 'anchor autolink emoticons lists searchreplace wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                setup: function(editor) {
                    editor.on('init', function() {
                        // Check if the content direction should be RTL or LTR
                        const editorName = editor.id.split('_'); // Set to true for RTL, false for LTR

                        const ID = editorName[editorName.length - 1];

                        const content = editor.getBody();
                        if (ID === 'ar') {
                            content.style.direction = 'rtl';
                        } else {
                            content.style.direction = 'ltr';
                        }
                    });
                }
            });
        </script> --}}

        {{-- <script>
            // get a collection of elements with class filepond


            const inputElements = document.querySelectorAll('input.filepond');

            // loop over input elements
            Array.from(inputElements).forEach(inputElement => {

                // create a FilePond instance at the input element location
                FilePond.create((inputElement), {

                    // acceptedFileTypes: ['image/png', 'image/jpeg', 'image/svg', 'image/jpg'],
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

                });
                FilePond.setOptions({
                    required: true,

                    server: {
                        load: (source, load, error, progress, abort, headers) => {
                            const baseUrl = "http://127.0.0.1:8000/storage/";
                            let imageUrl = source;

                            // Check if the source starts with the base URL twice
                            if (source.startsWith(baseUrl + baseUrl)) {
                                imageUrl = source.replace(baseUrl, "");
                            }

                            console.log(imageUrl);
                            //const imageUrl = "{{ asset('storage') }}/" + source;
                            // const imageUrl = "{{ asset('storage/' . old('image')) }}";
                            fetch(imageUrl).then(res => res.blob()).then(load).catch(error)
                        },
                        process: "{{ route('admin.tmp.uploads', ['folder' => 'students']) }}",
                        revert: "{{ route('admin.tmp.delete', ['folder' => 'students']) }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },
                        withCredentials: false,
                        // onerror: (response) => response.data,
                    },


                })


            })
        </script> --}}

        <script>
            var uploadedFileIdAvatar = null;
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

                        uploadedFileIdAvatar = file.serverId;
                        localStorage.setItem('avatar', uploadedFileIdAvatar);
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
                const uploadedFileId = localStorage.getItem('avatar');
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
                        localStorage.removeItem('avatar');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>

        <script>
            var uploadedFileId = null;

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

                        uploadedFileId = file.serverId;
                        localStorage.setItem('background_image', uploadedFileId);
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
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'students']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'students']) }}",
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
                const uploadedFileId = localStorage.getItem('background_image');
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
                        localStorage.removeItem('background_image');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>
    @endpush
@endsection
