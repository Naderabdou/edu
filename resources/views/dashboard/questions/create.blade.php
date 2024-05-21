@extends('dashboard.layouts.app')

@section('title', transWord('اسئله الامتحانات'))

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
                                            href="{{ route('admin.quizzes.index') }}">{{ transWord('الاسئله والاجوبه') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة سوال جديد') }}</a>
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

                                    <h2 class="card-title" id="questionHeader">  اضافة السؤال {{ $count + 1 }} في اختبار "{{ $quiz->name }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="questionsFormCreate"
                                        action="{{ route('admin.questions.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">






                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="question">{{ transWord('السوال') }}</label>
                                                    <input type="text" id="question" class="form-control"
                                                        name="question" value="{{ old('question') }}" />
                                                    @error('question')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                                <div class="form-group">
                                                    <label for="score">{{ transWord('درجه السوال') }}</label>
                                                    <input type="number" id="score" class="form-control" name="score"
                                                        value="{{ old('score') }}" min="1" />
                                                    @error('score')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            @for ($i = 0; $i < 4; $i++)
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="answer_{{ $i }}">{{ transWord('الاجابه ' . chr(65 + $i)) }}</label>
                                                        <input type="text" id="answer_{{ $i }}"
                                                            class="form-control" name="answer[{{ $i }}]"
                                                            value="{{ old('answer.' . $i) }}" />
                                                        <div style="color: red" id="answer.{{ $i }}_error"
                                                            class="error-message">

                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="is_correct"
                                                                id="is_correct" {{ old('is_correct') ? 'checked' : '' }}
                                                                value="{{ $i }}">
                                                            <label class="form-check-label" for="is_correct">
                                                                {{ transWord('Is this the correct answer?') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor




                                            {{--
                                            @for ($i = 0; $i < 4; $i++)
                                            <div class="col-1">
                                                <div class="form-group d-flex align-items-center justify-content-center">

                                                    <input type="radio" name="correct_answer" value="{{ $i }}" class="form-check-input ">

                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class=" form-group">
                                                    <input type="text" name="choices[]" placeholder="أدخل الإجابة رقم {{ $i+1 }}" class="form-control" required>
                                                    <small class="text-danger">{{ $errors->first('choices.'. $i ) }}</small>
                                                    <div style="color: red" id="choices.{{ $i }}_error" class="error-message"></div>
                                                </div>
                                            </div>
                                            @endfor --}}



                                            {{-- <div class="col-6">
                                                <div class="form-group">
                                                    <label for="bio">{{ transWord('اجابه A') }}</label>
                                                    <textarea id="bio" class="form-control " name="bio" style="width: 100%; height: 200px;">{{ old('bio') }}</textarea>
                                                    @error('bio')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer" value="1">
                                                    <label class="form-check-label" for="correct_answer">
                                                        {{ transWord('Is this the correct answer?') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="bio">{{ transWord('اجابه B') }}</label>
                                                    <textarea id="bio" class="form-control " name="bio" style="width: 100%; height: 200px;">{{ old('bio') }}</textarea>
                                                     @error('bio')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer" value="1">
                                                    <label class="form-check-label" for="correct_answer">
                                                        {{ transWord('Is this the correct answer?') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="bio">{{ transWord('اجابه C') }}</label>
                                                    <textarea id="bio" class="form-control " name="bio" style="width: 100%; height: 200px;">{{ old('bio') }}</textarea>
                                                    @error('bio')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer" value="1">
                                                    <label class="form-check-label" for="correct_answer">
                                                        {{ transWord('Is this the correct answer?') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="bio">{{ transWord('اجابة D') }}</label>
                                                    <textarea id="bio" class="form-control " name="bio" style="width: 100%; height: 200px;">{{ old('bio') }}</textarea>
                                                    @error('bio')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer" value="1">
                                                        <label class="form-check-label" for="correct_answer">
                                                            {{ transWord('Is this the correct answer?') }}
                                                        </label>
                                                    </div>
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
        <script src="{{ asset('dashboard/assets/js/custom/validation/questions.js') }}"></script>
        {{-- <script>
            $(document).ready(function() {
                $('#quizzesFormCreate').validate({
                    rules: {
                        // Define validation rules for your form fields here
                        'answer[0]': {
                            required: true
                        },
                        'answer[1]': {
                            required: true
                        },
                        'answer[2]': {
                            required: true
                        },
                        'answer[3]': {
                            required: true
                        },
                        // Add more fields as needed
                    },

                    submitHandler: function(form) {
                        var formData = new FormData(form);
                        $.ajax({
                            url: "{{ route('admin.questions.store') }}",
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                // Handle success
                                $('form').trigger('reset');
                                Swal.fire({
                                    icon: 'success',
                                    title: `<h5> ${data.message}</h5> `,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#questionHeader').text('اضافة السؤال ' + data
                                    .questionsCount +
                                    ' في اختبار "' + data.examName + '"');
                            },
                            error: function(data) {
                                $('.error-message').text('');
                                var errors = data.responseJSON.errors;
                                $.each(errors, function(field, messages) {
                                    var errorMessage = messages.join(', ');
                                    $('#' + field + '_error').text(
                                        errorMessage);
                                });
                            },
                        });
                    }
                });
            });
        </script> --}}
    @endpush
@endsection
