@extends('dashboard.layouts.app')

@section('title', transWord('إضافة كورس جديد'))

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
                                            href="{{ route('admin.courses.index') }}">{{ transWord('الرئيسية') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة كورس جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة كورس جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="coursesFormCreate"
                                        action="{{ route('admin.courses.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf


                                        <div class="accordion " id="accordionExample">
                                            {{-- cousre Info --}}
                                            @include('dashboard.components.courses.create.courseInfo')
                                            {{-- end course Info --}}


                                            {{-- course intro video --}}
                                            @include('dashboard.components.courses.create.courseIntro')
                                            {{-- end course intro video --}}




                                            {{-- Additional Information --}}
                                            @include('dashboard.components.courses.create.Additional')
                                            {{-- end Additional Information --}}








                                        </div>
                                        <input type="hidden" id='check-slug' value="{{ route('admin.check.slug') }}">
                                        <input type="hidden" id='type' value="" name="intro_video_type" disabled='true'>
                                        <div class="row">
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
        <script src="{{ asset('dashboard/assets/js/custom/course.js') }}"></script>

        <script src="{{ asset('dashboard/assets/js/custom/validation/coursesFormCreate.js') }}"></script>
        <script src="https://cdn.tiny.cloud/1/ncu4y607nayo1coo3vekski4tweqhf55lrvzpu0mnmnsstgw/tinymce/6/tinymce.min.js"
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
        </script>

        <script>
            var uploadedFileIdcourse = null;

            const course_image = document.getElementById('image_course');
            const pond1 = FilePond.create((course_image), {
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
                labelFileLoadError: "{{ transWord('حدث خطأ اثناء تحميل الملف') }}",
                onprocessfile: function(error, file) {
                    if (error) {
                        console.log('حدث خطأ أثناء معالجة الملف:', error);
                    } else {

                        uploadedFileIdcourse = file.serverId;
                        localStorage.setItem('course_image', uploadedFileIdcourse);
                    }
                }

            });
            pond1.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        const baseUrl = "http://127.0.0.1:8000/storage/";


                        let imageUrl = source;


                        while (imageUrl.startsWith(baseUrl + baseUrl)) {
                            imageUrl = imageUrl.replace(baseUrl, "");
                        }



                        fetch(imageUrl).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'courses']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'courses']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },



            });
            @if ($errors->isNotEmpty() && old('image'))
                pond1.addFiles([{
                    source: "{{ asset('storage/' . old('image')) }}",
                    options: {
                        type: 'local',
                    }
                }]);
            @endif

            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                const uploadedFileId = localStorage.getItem('course_image');
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
                        localStorage.removeItem('course_image');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>
        <script>
            var video_course = null;
            const upload_vidoe = document.getElementById('upload_vidoe');

            const pond2 = FilePond.create((upload_vidoe), {
                //  acceptedFileTypes: ['video/mp4'],

                labelFileTypeNotAllowed: window.videoMessage,
                minFileSize: '0.5MB',
                maxFileSize: '100MB',
                labelMaxFileSizeExceeded: "{{ transWord('الحد الاقصى لحجم الملف هو') }}",
                labelFileProcessing: "{{ transWord('جاري التحميل') }}",
                labelFileProcessingComplete: "{{ transWord('تم التحميل') }}",
                labelTapToCancel: "{{ transWord('انقر للغاء') }}",
                labelTapToRetry: "{{ transWord('انقر للاعاده') }}",
                imageResizeTargetWidth: 100,
                imageResizeTargetHeight: 100,
                labelIdle: "{{ transWord('قم بسحب الفيديو او') }} <span class='filepond--label-action' tabindex='0'>{{ transWord('انقر هنا') }} </span>",
                labelFileLoadError: "{{ transWord('حدث خطأ اثناء تحميل الملف') }}",
                onprocessfile: function(error, file) {
                    if (error) {
                        console.log('Oh no', error);
                    } else {
                        console.log('file', file.serverId);
                        $('#intro_video_type').prop('disabled', true);
                        $('#type').prop('disabled', false);
                        $('#type').val('upload');


                        video_course = file.serverId;
                        localStorage.setItem('course_video', video_course);




                    }
                },
                onremovefile: function(file) {
                    document.getElementById('intro_video_type').disabled = false;
                    $('#type').prop('disabled', true);
                }


            });

            pond2.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        const baseUrl = "http://127.0.0.1:8000/storage/";
                        let imageUrl = source;

                        // Check if the source starts with the base URL twice


                        // Check if the source starts with the base URL twice
                        while (imageUrl.startsWith(baseUrl + baseUrl)) {
                            imageUrl = imageUrl.replace(baseUrl, "");
                        }



                        // const imageUrl = "{{ asset('storage/' . old('upload_vidoe')) }}";

                        fetch(imageUrl).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'courses']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'courses']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },



            });
            @if ($errors->isNotEmpty() && old('upload_vidoe'))
                pond2.addFiles([{
                    source: "{{ asset('storage/' . old('upload_vidoe')) }}",
                    options: {
                        type: 'local',
                    }
                }]);
            @endif

            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                const uploadedFileId = localStorage.getItem('course_video');
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
                        localStorage.removeItem('course_video');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>

        {{-- <script>
            function createFilePondInstance(elementId, acceptedFileTypes, maxFileSize, labelIdle, oldFile) {

                if(oldFile == 'image'){
                    let key = 'image';
                    oldFile = "{{ asset('storage/' . old('image')) }}" ;
                }else{
                    let key = 'upload_vidoe';
                    oldFile = "{{ asset('storage/' . old('upload_vidoe')) }}" ;
                }

                const element = document.getElementById(elementId);
                const pond = FilePond.create(element, {
                    acceptedFileTypes: acceptedFileTypes,
                    labelFileTypeNotAllowed: window.avatarMessage,
                    minFileSize: '0.5MB',
                    maxFileSize: maxFileSize,
                    labelMaxFileSizeExceeded: "{{ transWord('الحد الاقصى لحجم الملف هو') }}",
                    labelFileProcessing: "{{ transWord('جاري التحميل') }}",
                    labelFileProcessingComplete: "{{ transWord('تم التحميل') }}",
                    labelTapToCancel: "{{ transWord('انقر للغاء') }}",
                    labelTapToRetry: "{{ transWord('انقر للاعاده') }}",
                    labelIdle: labelIdle,
                    labelFileLoadError: "{{ transWord('حدث خطأ اثناء تحميل الملف') }}",
                });

                pond.setOptions({
                    server: {
                        load: (source, load, error, progress, abort, headers) => {
                            const baseUrl = "http://127.0.0.1:8000/storage/";
                        let imageUrl = source;

                        // Check if the source starts with the base URL twice
                        if (source.startsWith(baseUrl + baseUrl)) {
                            imageUrl = source.replace(baseUrl, "");
                        }

                            fetch(imageUrl).then(res => res.blob()).then(load).catch(error)
                        },
                        process: "{{ route('admin.tmp.uploads', ['folder' => 'courses']) }}",
                        revert: "{{ route('admin.tmp.delete', ['folder' => 'courses']) }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        withCredentials: false,
                    },
                });
                var errors = @json($errors->any());
                if (errors && oldFile){
                    pond.addFiles([{
                        source: oldFile,
                        options: {
                            type: 'local',
                        }
                    }]);
                }


                return pond;
            }

            const pond1 = createFilePondInstance(
                'image_course',
                ['image/*'],
                '30MB',
                "{{ transWord('قم بسحب الصوره او') }} <span class='filepond--label-action' tabindex='0'> انقر هنا </span>",
                'image'
            );

            const pond2 = createFilePondInstance(
                'upload_vidoe',
                ['video/mp4'],
                '100MB',
                "{{ transWord('قم بسحب الفيديو او') }} <span class='filepond--label-action' tabindex='0'>{{ transWord('انقر هنا') }} </span>",
                'upload_vidoe'
            );

            pond2.on('processfile', function(error, file) {
                if (error) {
                    console.log('Oh no', error);
                } else {
                    $('#intro_video_type').prop('disabled', true);
                    $('#type').prop('disabled', false);
                    $('#type').val('upload');
                }
            });

            pond2.on('removefile', function(file) {
                document.getElementById('intro_video_type').disabled = false;
                $('#type').prop('disabled', true);
            });
        </script> --}}
    @endpush
@endsection
