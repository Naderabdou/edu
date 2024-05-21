@extends('dashboard.layouts.app')

@section('title', transWord('الكورسات'))

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
                                            href="{{ route('admin.courses.index') }}">{{ transWord('الكورسات') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.courses.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('إضافة كورس جديد') }}
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>

                                        <th>#</th>
                                        <th>{{ transWord('الصوره') }}</th>
                                        <th>{{ transWord('الاسم') }}</th>
                                        <th>{{ transWord('اسم القسم') }}</th>
                                        <th>{{ transWord('اسم المدرب') }}</th>
                                        <th>{{ transWord('فيديو مقدم الكورس') }}</th>
                                        <th>{{ transWord('عدد المشتركين') }}</th>
                                        <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img height="44" src="{{ $course->image_path }}" alt="">
                                                </td>
                                                <td>{{ $course->title }}</td>

                                                <td>
                                                    @foreach ($course->categories as $category)
                                                        <span
                                                            class="badge badge-light-primary">{{ $category->name }}</span>
                                                    @endforeach



                                                </td>


                                                <td>{{ $course->instructor->username }}</td>
                                                <td>
                                                    <a href="{{ $course->intro_video_path }}" target="_blank">فتح
                                                        الفيديو</a>
                                                </td>

                                                <td>2</td>


                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.courses.edit', $course->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.courses.destroy', $course->id) }}"
                                                            data-id="{{ $course->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                        <a href="#" class="btn btn-info btn-circle btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#exampleModalLong{{ $course->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        {{-- <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#exampleModalLong{{$student->id}}">
                                                        <i class="fas fa-eye"></i>
                                         </a> --}}
                                                    </div>
                                                </td>
                                            </tr>


                                            <div class="modal fade" id="exampleModalLong{{ $course->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                {{ transWord('تفاصيل الكورس') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('الاسم') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $course->title }}

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('وصف الكورس') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $course->about }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('الحد الادني للطلاب') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $course->max_students }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('المستوي') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $course->level }}
                                                                        </div>

                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('دورة عامة') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            @if ($course->is_public == 1)
                                                                                <span class="badge badge-primary">عام</span>
                                                                            @else
                                                                                <span class="badge badge-danger">خاص</span>
                                                                            @endif


                                                                        </div>

                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('قسم الأسئلة والأجوبة') }} :
                                                                            </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            @if ($course->is_qa_enabled == 1)
                                                                                <span
                                                                                    class="badge badge-primary">مفعل</span>
                                                                            @else
                                                                                <span class="badge badge-danger">غير
                                                                                    مفعل</span>
                                                                            @endif
                                                                        </div>

                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('بالتنقيط المحتوى') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            @if ($course->is_content_score_enabled == 1)
                                                                                <span
                                                                                    class="badge badge-primary">مفعل</span>
                                                                            @else
                                                                                <span class="badge badge-danger">غير
                                                                                    مفعل</span>
                                                                            @endif
                                                                        </div>

                                                                    </div>


                                                                    @if ($course->is_content_score_enabled == 1)
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('نوع بالتنقيط المحتوى') }} :
                                                                            </b>
                                                                        </div>
                                                                        <div class="col-lg-7">


                                                                            {{ $course->content_drip_type }}

                                                                        </div>

                                                                    </div>

                                                                    @endif



                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ __('نوع الكورس') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            @if ($course->type_course == 'free')
                                                                                <span
                                                                                    class="badge badge-success">{{ __('مجاني') }}</span>
                                                                            @else
                                                                                <span
                                                                                    class="badge badge-primary">{{ __('مدفوع') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @if ($course->type_course == 'paid')
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ __('سعر الكورس') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $course->price }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ __('الخصم') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $course->discount }}
                                                                        </div>
                                                                    </div>
                                                                @endif



                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">{{ __('إغلاق') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @push('js')
        <script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script>
    @endpush
@endsection
