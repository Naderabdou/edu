@extends('dashboard.layouts.app')

@section('title', transWord('تعديل الباقة '))

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
                                            href="{{ route('admin.packages.index') }}">{{ transWord('االباقات') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل الباقة ') }}</a>
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
                                    <h2 class="card-title">{{ transWord('تعديل الباقة ') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ route('admin.packages.update',$package->id) }}"
                                        method="POST" id="createPackageForm" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_ar">{{ transWord('الأسم بالعربية') }}</label>
                                                    <input type="text" id="name_ar" class="form-control" name="name_ar"
                                                        value="{{ old('name_ar',$package->name_ar) }}" />
                                                    @error('name_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_en">{{ transWord('الأسم بالإنجليزية') }}</label>
                                                    <input type="text" id="name_en" class="form-control" name="name_en"
                                                        value="{{ old('name_en',$package->name_en) }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="features_ar">{{ transWord('المميزات بالعربي') }}</label>
                                                    <textarea id="features_ar" class="form-control tinyEditor" name="features_ar" style="width: 100%; height: 200px;">{{ old('features_ar',$package->features_ar) }}</textarea>
                                                    @error('features_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="features_en">{{ transWord('المميزات بالانجليزي') }}</label>
                                                    <textarea id="features_en" class="form-control tinyEditor" name="features_en" style="width: 100%; height: 200px;">{{ old('features_en',$package->features_en) }}</textarea>
                                                    @error('features_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="flaw_ar">{{ transWord('العيوب بالعربي') }}</label>
                                                    <textarea id="flaw_ar" class="form-control tinyEditor" name="flaw_ar" style="width: 100%; height: 200px;">{{ old('flaw_ar',$package->flaw_ar) }}</textarea>
                                                    @error('flaw_ar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="flaw_en">{{ transWord('العيوب بالانجليزي') }}</label>
                                                    <textarea id="flaw_en" class="form-control tinyEditor" name="flaw_en" style="width: 100%; height: 200px;">{{ old('flaw_en',$package->flaw_en) }}</textarea>
                                                    @error('flaw_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="type">{{ transWord('النوع') }}</label>
                                                    <select class="form-control " id="type" name="type">
                                                        <option value="monthly"
                                                            {{ old('type',$package->type) == 'monthly' ? 'selected' : '' }}>
                                                            {{ transWord('monthly') }}</option>
                                                        <option value="yearly"
                                                            {{ old('type',$package->type) == 'yearly' ? 'selected' : '' }}>
                                                            {{ transWord('سنوي') }}</option>
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
                                                    <label for="price">{{ transWord('السعر') }}</label>
                                                    <input type="text" id="price" class="form-control"
                                                        name="price" value="{{ old('price',$package->price) }}" />
                                                    @error('price')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="course_id">{{ transWord('الدورات') }}</label>
                                                    <select class="form-control select-multiple" id="course_id"
                                                        name="course_id[]" multiple="multiple">
                                                        @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}"
                                                                {{ old('course_id') == $course->id || $package->courses->pluck('id')->contains($course->id) ? 'selected' : '' }}>
                                                                {{ $course->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('course_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>





                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ transWord('save') }}</button>
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
            $(document).ready(function() {
                $('.select-multiple').select2();
            });
        </script>
         <script src="{{ asset('dashboard/assets/js/custom/validation/Package.js') }}"></script>
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

    @endpush
@endsection
