@extends('dashboard.layouts.app')

@section('title', transWord('الدروس'))

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
                                    href="{{ route('admin.lessons.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('إضافة درس جديد') }}
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
                                            <th>{{ transWord('اسم الدرس') }}</th>
                                            <th>{{ transWord('وصف الدرس') }}</th>
                                            <th>{{ transWord('اسم الكورس') }}</th>
                                            <th>{{ transWord('اسم موضوع الكورس') }}</th>
                                            <th>{{ transWord('الفيديو') }}</th>
                                            <th>{{ transWord('pdf ملف') }}</th>
                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lessons as $lesson)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $lesson->tile }}</td>
                                                <td>{{ $lesson->desc }}</td>

                                                <td>{{ $lesson->course?->title }}</td>
                                                <td>{{ $lesson->topics?->name }}</td>
                                                <td>
                                                    <a href="{{ $lesson->video_lesson_path }}" target="_blank">فتح الفيديو</a>
                                                </td>

                                                <td>
                                                    <a href="{{ $lesson->pdf_lesson_path }}" target="_blank">فتح الملف</a>
                                                </td>




                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.lessons.edit', $lesson->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.lessons.destroy', $lesson->id) }}"
                                                            data-id="{{ $lesson->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>

                                                     {{-- <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#exampleModalLong{{$student->id}}">
                                                        <i class="fas fa-eye"></i>
                                         </a> --}}
                                                    </div>
                                                </td>
                                            </tr>

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
