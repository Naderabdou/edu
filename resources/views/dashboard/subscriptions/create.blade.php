@extends('dashboard.layouts.app')

@section('title', transWord('إضافة اشتراك جديد'))

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
                                            href="{{ route('admin.subscriptions.index') }}">{{ transWord('الاشتراكات') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('إضافة اشتراك جديد') }}</a>
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
                                    <h2 class="card-title">{{ transWord('إضافة اشتراك جديد') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="createCategoryForm"
                                        action="{{ route('admin.subscriptions.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="user_id">{{ transWord('المستخدمين') }}</label>
                                                    <select class="form-control select2" id="user_id"
                                                        name="user_id" >
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}"
                                                                {{ old('user_id') === $user->id ? 'selected' : '' }}>
                                                                {{ $user->username }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="coures_id">{{ transWord('الكورسات') }}</label>
                                                    <select class="form-control select-multiple" id="coures_id"
                                                        name="coures_id[]" multiple="multiple">
                                                        @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}"
                                                                {{ collect(old('coures_id'))->contains($course->id) ? 'selected' : '' }}>
                                                                {{ $course->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="price">{{ transWord('السعر') }}</label>
                                                    <input type="number" id="price" class="form-control" name="price"
                                                        value="{{ old('price') }}"  min="0"/>
                                                    @error('price')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="discount">{{ transWord('الخصم') }}</label>
                                                    <input type="number" id="discount" class="form-control" name="discount"
                                                        value="{{ old('discount') }}" min="0"/>
                                                    @error('discount')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="price_after_discount">{{ transWord('سعر بعد الخصم') }}</label>
                                                    <input type="number" id="price_after_discount" class="form-control" name="price_after_discount"
                                                        value="{{ old('price_after_discount') }}" min="0"/>
                                                    @error('price_after_discount')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="payment_method">{{ transWord('نوع الدفع') }}</label>
                                                    <input type="text" id="payment_method" class="form-control" name="payment_method"
                                                        value="{{ old('payment_method') }}" min="0"/>
                                                    @error('payment_method')
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
        <script src="{{ asset('dashboard/assets/js/custom/validation/subscrptionForm.js') }}"></script>
    <script>
         $(".select-multiple").select2({
                tags: true
            });
         $(".select2").select2();
    </script>
    @endpush
@endsection
