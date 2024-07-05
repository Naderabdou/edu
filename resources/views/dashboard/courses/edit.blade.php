@extends('dashboard.layouts.app')

@section('title', transWord('تعديل الكورس'))

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
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل الكورس') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل الكورس') }} - {{ $course->title }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="coursesFormUpdate"
                                        action="{{ route('admin.courses.update', $course->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id='check-slug' value="{{ route('admin.check.slug') }}">
                                        <input type="hidden" id='type' value="" name="intro_video_type"
                                            disabled="true">
                                        <input type="hidden" id='id' value="{{ $course->id }}" name="id">



                                        <div class="accordion " id="accordionExample">
                                            {{-- cousre Info --}}
                                            @include('dashboard.components.courses.edit.courseInfo')
                                            {{-- end course Info --}}


                                            {{-- course intro video --}}
                                            @include('dashboard.components.courses.edit.courseIntro')
                                            {{-- end course intro video --}}









                                            {{-- Additional Information --}}
                                            @include('dashboard.components.courses.edit.Additional')
                                            {{-- end Additional Information --}}






                                        </div>
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

        @php
            if (!function_exists('createFileObject')) {
                function createFileObject($path)
                {
                    return [
                        'source' => $path,
                        'options' => [
                            'type' => 'local',
                        ],
                    ];
                }
            }
        @endphp


        <script>
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


            });
            pond1.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        fetch(source).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'courses']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'courses']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },
                files: [
                    @json(createFileObject($course->image_path)),
                ],



            })
        </script>
        <script>
            const upload_vidoe = document.getElementById('upload_vidoe_edit');

            const pond2 = FilePond.create((upload_vidoe), {
                acceptedFileTypes: ['video/mp4'],

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
                        $('#intro_video_type').prop('disabled', true);
                        $('#type').prop('disabled', false);
                        $('#type').val('upload');




                    }
                },
                onremovefile: function(file) {
                    document.getElementById('intro_video_type').disabled = false;
                    $('#type').prop('disabled', true);
                },


            });

            pond2.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        fetch(source).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'courses']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'courses']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },
                @if ($course->intro_video_type === 'upload')

                    files: [
                        @json(createFileObject($course->intro_video_path)),
                    ],
                @endif

                // For the video FilePond instance


            });
        </script>
    @endpush
@endsection
