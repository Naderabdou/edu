@extends('dashboard.layouts.app')

@section('title', transWord('إضافة موضوع كورس جديد'))

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
                                            href="{{ route('admin.topics.index') }}">{{ transWord('الرئيسية') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة موضوع كورس جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة موضوع جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="TopicFormCreate"
                                        action="{{ route('admin.topics.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="course_id">{{ transWord('الكورسات') }}</label>
                                                    <select  class="form-control course_select2 " id="course_id" name="course_id"
                                                        >
                                                        @foreach ($courses as $course)
                                                            <option  {{ old('course_id') == $course->id ? 'selected' : '' }}  value="{{ $course->id }}">{{ $course->title }}   </option>
                                                        @endforeach
                                                    </select>
                                                    @error('course_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="type">{{ transWord('نوع موضع الكورس') }}</label>
                                                    <select  class="form-control course_select2 " id="type" name="type" >

                                                            <option {{ old('type') === 'lesson' ? 'selected': '' }}  value="lesson">{{ transWord('lesson') }}</option>
                                                            <option {{ old('type') === 'quiz' ? 'selected': '' }} value="quiz">{{ transWord('quiz') }}</option>
                                                            <option {{ old('type') === 'assignment' ? 'selected': '' }} value="assignment">{{ transWord('assignment') }}</option>

                                                    </select>
                                                    @error('type')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_ar">{{ transWord('الاسم بالعربي') }}</label>
                                                    <input type="text" id="name_ar" class="form-control" name="name_ar"
                                                        value="{{ old('name_ar') }}"  />
                                                    @error('name_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_en">{{ transWord('الاسم بالانجليزي') }}</label>
                                                    <input type="text" id="name_en" class="form-control" name="name_en"
                                                        value="{{ old('name_en') }}"  />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="description_ar">{{ transWord('الوصف بالعربي') }}</label>
                                                    <textarea id="description_ar" class="form-control" name="description_ar" style="width: 100%; height: 200px;" >{{ old('description_ar') }}</textarea>
                                                                  @error('description_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="description_en">{{ transWord('الوصف بالانجليزي') }}</label>
                                                    <textarea id="description_en" class="form-control" name="description_en" style="width: 100%; height: 200px;" >{{ old('description_en') }}</textarea>
                                                       @error('description_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
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
    <script>
             $(".course_select2").select2();
    </script>
        <script src="{{ asset('dashboard/assets/js/custom/validation/TopicFormCreate.js') }}"></script>
        <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>
    @endpush
@endsection
