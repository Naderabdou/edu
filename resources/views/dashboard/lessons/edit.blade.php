@extends('dashboard.layouts.app')

@section('title', transWord('تعديل الدرس'))
@push('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
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
                                            href="{{ route('admin.lessons.index') }}">{{ transWord('الدروس') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل الدرس') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل الدرس') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="LessonFormUpdate"
                                        action="{{ route('admin.lessons.update',$lesson->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_id">{{ transWord('الكورسات') }}</label>
                                                    <select class="form-control course_select2 " id="course_id"
                                                        name="course_id">
                                                        <option value="">{{ transWord('اختر الكورس') }}</option>

                                                        @foreach ($courses as $course)
                                                            <option
                                                                {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}
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
                                            @if (old('course_id', $lesson->course_id))
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="topic_id">{{ transWord('اختر موضوع الكورس') }}</label>
                                                        <select class="form-control course_select2 " id="topic_id"
                                                            name="topic_id">

                                                            @foreach ($TopicCourse as $topice)
                                                                <option
                                                                    {{ old('topic_id', $lesson->topic_id) == $topice->id ? 'selected' : '' }}
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
                                                        name="title_ar" value="{{ old('title_ar', $lesson->title_ar) }}" />
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
                                                        name="title_en" value="{{ old('title_en', $lesson->title_ar) }}" />
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
                                                    <textarea id="desc_ar" class="form-control " name="desc_ar" style="width: 100%; height: 200px;">{{ old('desc_ar', $lesson->desc_ar) }}</textarea>
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
                                                    <textarea id="desc_en" class="form-control " name="desc_en" style="width: 100%; height: 200px;">{{ old('desc_en', $lesson->desc_en) }}</textarea>
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
        {{-- <script src="{{ asset('dashboard/assets/js/custom/validation/LessonsFormCreate.js') }}"></script> --}}

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

@php
function createFileObject($path)
{
    return [
        'source' => $path,
        'options' => [
            'type' => 'local',
        ],
    ];
}
@endphp
        <script>
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


            });

            pond1.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        fetch(source).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'lessons']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'lessons']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },
                files: [
                        @json(createFileObject($lesson->video_lesson_path)),
                    ],



            });

        </script>

        <script>
            const upload_pdf = document.getElementById('pdf_lesson');

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

            });
            pond2.setOptions({
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        fetch(source).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'lessons']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'lessons']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },
                files: [
                        @json(createFileObject($lesson->pdf_lesson_path)),
                    ],



            });

        </script>
    @endpush
@endsection
