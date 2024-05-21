@extends('dashboard.layouts.app')

@section('title', transWord('الامتحانات'))

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
                                            href="{{ route('admin.quizzes.index') }}">{{ transWord('الامتحانات') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل امتحان ') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل امتحان ') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="quizzesFormCreate"
                                        action="{{ route('admin.quizzes.update',$quiz->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_id">{{ transWord('الامتحانات') }}</label>
                                                    <select class="form-control course_select2 " id="course_id"
                                                        name="course_id">
                                                        <option value="">{{ transWord('اختر الكورس') }}</option>

                                                        @foreach ($courses as $course)
                                                            <option {{ old('course_id',$quiz->course_id) == $course->id ? 'selected' : '' }}
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
                                            @if (old('course_id',$quiz->course_id))
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="topic_id">{{ transWord('اختر موضوع الكورس') }}</label>
                                                        <select class="form-control course_select2 " id="topic_id"
                                                            name="topic_id">

                                                            @foreach ($TopicCourse as $topice)
                                                                <option
                                                                    {{ old('topic_id',$quiz->topic_id) == $topice->id ? 'selected' : '' }}
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
                                                            name="topic_id" >

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
                                                    <label for="name_ar">{{ transWord('عنوان الامتحان بالعربي') }}</label>
                                                    <input type="text" id="name_ar" class="form-control" name="name_ar"
                                                        value="{{ old('name_ar',$quiz->name_ar) }}" />
                                                    @error('name_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label
                                                        for="name_en">{{ transWord('عنوان الامتحان بالانجليزي') }}</label>
                                                    <input type="text" id="name_en" class="form-control" name="name_en"
                                                        value="{{ old('name_en',$quiz->name_en) }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="time">{{ transWord('وقت الامتحان') }}</label>
                                                    <input type="time" id="time" class="form-control" name="time"
                                                        value="{{ old('time',$quiz->time) }}" />
                                                    @error('time')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label
                                                        for="total_score">{{ transWord('الدرجه النهائية للامتحان') }}</label>
                                                    <input type="number" id="total_score" class="form-control" name="total_score"
                                                        value="{{ old('total_score',$quiz->total_score) }}" min="1" />
                                                    @error('total_score')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label
                                                        for="pass_score">{{ transWord('درجه النجاح') }}</label>
                                                    <input type="number" id="pass_score" class="form-control" name="pass_score"
                                                        value="{{ old('pass_score',$quiz->pass_score) }}" min="1" />
                                                    @error('pass_score')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- <div class="col-6">
                                                <div class="form-group">
                                                    <label
                                                        for="question_score">{{ transWord('درجه السوال') }}</label>
                                                    <input type="number" id="question_score" class="form-control" name="question_score"
                                                        value="{{ old('question_score') }}" min="1" />
                                                    @error('question_score')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}


















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
        <script src="{{ asset('dashboard/assets/js/custom/validation/quizzesForm.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(".course_select2").select2();

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

    @endpush
@endsection
