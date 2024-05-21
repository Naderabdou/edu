@extends('dashboard.layouts.app')

@section('title', transWord('إضافة قسم جديد'))

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
                                            href="{{ route('admin.categories.index') }}">{{ transWord('الرئيسية') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة قسم جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة قسم جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="createCategoryForm"
                                        action="{{ route('admin.categories.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <input type="hidden" id="check_name_category"
                                                value="{{ route('admin.check.name') }}">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name_ar">{{ transWord('الاسم بالعربي') }}</label>
                                                    <input type="text" id="name_ar" class="form-control" name="name_ar"
                                                        value="{{ old('name_ar') }}" />
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
                                                        value="{{ old('name_en') }}" />
                                                    @error('name_en')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="image"
                                                        class="form-label">{{ transWord('الصوره') }}</label>
                                                    <input class=" image" type="file" id="image" name="image">



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
        <script src="{{ asset('dashboard/assets/js/custom/validation/categoryForm.js') }}"></script>
        <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>

        <script>
            var uploadedFileIdCategory = null;

            const category = document.getElementById('image');
            const pond = FilePond.create((category), {
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

                        uploadedFileIdCategory = file.serverId;
                        localStorage.setItem('category_image', uploadedFileIdCategory);
                    }
                }
            });
            pond.setOptions({

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

                    process: "{{ route('admin.tmp.uploads', ['folder' => 'categories']) }}",
                    revert: "{{ route('admin.tmp.delete', ['folder' => 'categories']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },

            })
            @if ($errors->isNotEmpty() && old('image'))
                pond.addFiles([{
                    source: "{{ asset('storage/' . old('image')) }}",
                    options: {
                        type: 'local',
                    }
                }]);
            @endif


            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                const uploadedFileId = localStorage.getItem('category_image');
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
                        localStorage.removeItem('category_image');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error deleting file:', textStatus, errorThrown);
                    }
                });
            }
        </script>
    @endpush
@endsection
