@extends('dashboard.layouts.app')

@section('title', transWord('إضافة درس جديد'))

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
                                            href="{{ route('admin.lessons.index') }}">{{ transWord('الدروس') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة درس جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة درس جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="LessonFormCreate"
                                        action="{{ route('admin.lessons.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_id">{{ transWord('الكورسات') }}</label>
                                                    <select class="form-control course_select2 " id="course_id"
                                                        name="course_id">
                                                        <option value="">{{ transWord('اختر الكورس') }}</option>

                                                        @foreach ($courses as $course)
                                                            <option {{ old('course_id') == $course->id ? 'selected' : '' }}
                                                                value="{{ $course->id }}">{{ $course->title }} </option>
                                                        @endforeach
                                                    </select>
                                                    @error('course_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if (old('course_id'))
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="topic_id">{{ transWord('اختر موضوع الكورس') }}</label>
                                                        <select class="form-control course_select2 " id="topic_id"
                                                            name="topic_id">

                                                            @foreach ($TopicCourse as $topice)
                                                                <option
                                                                    {{ old('topic_id') == $topice->id ? 'selected' : '' }}
                                                                    value="{{ $topice->id }}">{{ $topice->name_ar }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('topic_id')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="topic_id">{{ transWord('اختر موضوع الكورس') }}</label>
                                                        <select class="form-control course_select2 " id="topic_id"
                                                            name="topic_id">

                                                        </select>
                                                        @error('topic_id')
                                                            <span class="alert alert-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="title_ar">{{ transWord('اسم الدرس بالعربي') }}</label>
                                                    <input type="text" id="title_ar" class="form-control"
                                                        name="title_ar" value="{{ old('title_ar') }}" />
                                                    @error('title_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="title_en">{{ transWord('اسم الدرس بالانجليزي') }}</label>
                                                    <input type="text" id="title_en" class="form-control"
                                                        name="title_en" value="{{ old('title_en') }}" />
                                                    @error('title_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="desc_ar">{{ transWord('الوصف بالعربي') }}</label>
                                                    <textarea id="desc_ar" class="form-control " name="desc_ar" style="width: 100%; height: 200px;">{{ old('desc_ar') }}</textarea>
                                                    @error('desc_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="desc_en">{{ transWord('الوصف بالانجليزي') }}</label>
                                                    <textarea id="desc_en" class="form-control " name="desc_en" style="width: 100%; height: 200px;">{{ old('desc_en') }}</textarea>
                                                    @error('desc_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="video_lesson"
                                                        class="form-label">{{ transWord('فيديو الدرس') }}</label>
                                                    <input class="filepond" type="file" id="video_lesson"
                                                        name="video_lesson" required='true'>
                                                </div>

                                            </div>


                                            <div class="col-6">

                                                <div class="form-group">
                                                    <label for="pdf_lesson"
                                                        class="form-label">{{ transWord('ملف pdf ') }}</label>
                                                    <input type="file" class="filepond" name="pdf_lesson"
                                                        id="pdf_lesson">
                                                </div>
                                            </div>










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
        <script src="{{ asset('dashboard/assets/js/custom/validation/LessonsFormCreate.js') }}"></script>

        <script>
            $(".course_select2").select2();
        </script>
        <script>
            $(document).ready(function() {
                $('#course_id').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "{{ route('admin.lesson.topices') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id
                        },
                        success: function(data) {



                            var options = '';
                            if (data.length > 0) {

                                options += ' <option value="">اختر الموضوع</option>';
                                for (var i = 0; i < data.length; i++) {
                                    options += '<option name="topice_id" value="' + data[i].id +
                                        '">' + data[i]
                                        .name_ar + '</option>';
                                }
                            } else {
                                options += '<option value="">لا يوجد مواضيع في هذا الكورس</option>';
                            }



                            $('#topic_id').html(options);
                        }
                    });

                })
            });
        </script>


        <script>
            var lessonvideo = null;
            const upload_vidoe = document.getElementById('video_lesson');

            const pond1 = FilePond.create((upload_vidoe), {
                acceptedFileTypes: ['video/*'],

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
                        console.log('حدث خطأ أثناء معالجة الملف:', error);
                    } else {

                        lessonvideo = file.serverId;
                        localStorage.setItem('video_lesson', lessonvideo);
                    }
                }


            });

            pond1.setOptions({
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
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'lessons']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'lessons']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },



            });
            @if ($errors->isNotEmpty() && old('video_lesson'))
                pond1.addFiles([{
                    source: "{{ asset('storage/' . old('video_lesson')) }}",
                    options: {
                        type: 'local',
                    }
                }]);
            @endif
            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                const uploadedFileId = localStorage.getItem('video_lesson');
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
                        localStorage.removeItem('video_lesson');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>

        <script>
            const upload_pdf = document.getElementById('pdf_lesson');
            var lessonpdf = null;

            const pond2 = FilePond.create((upload_pdf), {
                acceptedFileTypes: ['application/pdf'],
                labelFileTypeNotAllowed: window.pdf,
                minFileSize: '0.5MB',
                maxFileSize: '100MB',
                labelMaxFileSizeExceeded: "{{ transWord('الحد الاقصى لحجم الملف هو') }}",
                labelFileProcessing: "{{ transWord('جاري التحميل') }}",
                labelFileProcessingComplete: "{{ transWord('تم التحميل') }}",
                labelTapToCancel: "{{ transWord('انقر للغاء') }}",
                labelTapToRetry: "{{ transWord('انقر للاعاده') }}",

                labelIdle: "{{ transWord('قم بسحب الملف او') }} <span class='filepond--label-action' tabindex='0'>{{ transWord('انقر هنا') }} </span>",
                labelFileLoadError: "{{ transWord('حدث خطأ اثناء تحميل الملف') }}",
                onprocessfile: function(error, file) {
                    if (error) {
                        console.log('حدث خطأ أثناء معالجة الملف:', error);
                    } else {

                        lessonpdf = file.serverId;
                        localStorage.setItem('pdf_lesson', lessonpdf);
                    }
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
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'lessons']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'lessons']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },



            });
            @if ($errors->isNotEmpty() && old('pdf_lesson'))
                pond2.addFiles([{
                    source: "{{ asset('storage/' . old('pdf_lesson')) }}",
                    options: {
                        type: 'local',
                    }
                }]);
            @endif
            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                const uploadedFileId = localStorage.getItem('pdf_lesson');
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
                        localStorage.removeItem('pdf_lesson');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>
    @endpush
@endsection
