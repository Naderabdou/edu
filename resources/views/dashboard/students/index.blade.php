@extends('dashboard.layouts.app')

@section('title', transWord('الطلاب'))

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
                                            href="{{ route('admin.students.index') }}">{{ transWord('الطلاب') }}</a>
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
                                    href="{{ route('admin.students.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('إضافة طالب جديد') }}
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
                                        {{-- <th>{{ transWord('الصوره') }}</th> --}}
                                        <th>{{ transWord('الاسم الاول') }}</th>
                                        <th>{{ transWord('الاسم الثانى') }}</th>
                                        <th>{{ transWord('اسم المستخدم') }}</th>
                                        <th>{{ transWord('اسم العام') }}</th>
                                        <th>{{ transWord('البريد الإلكترونى') }}</th>
                                        <th>{{ transWord('رقم الجوال') }}</th>
                                        {{-- <th>{{ transWord('العنوان') }}</th> --}}
                                        <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                {{-- <td>
                                                    <img height="44" src="{{ $student->avatar_path }}" alt="">
                                                </td> --}}
                                                <td>{{ $student->first_name }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->username }}</td>
                                                <td>{{ $student->public_name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $student->email }}">
                                                        {{ $student->email }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="tel:+{{ $student->phone }}">
                                                        {{ $student->phone }}
                                                    </a>
                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.students.destroy', $student->id) }}"
                                                            data-id="{{ $student->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                        <a href="#" class="btn btn-info btn-circle btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#exampleModalLong{{ $student->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        {{-- <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#exampleModalLong{{$student->id}}">
                                                        <i class="fas fa-eye"></i>
                                         </a> --}}
                                                    </div>
                                                </td>
                                            </tr>


                                            <div class="modal fade" id="exampleModalLong{{ $student->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                {{ transWord('تفاصيل الطالب') }}</h5>
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
                                                                            <b>{{ transWord('الاسم الاول') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $student->first_name }}

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('الاسم الثانى') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $student->last_name }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('اسم المستخدم') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $student->username }}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('اسم العام') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $student->public_name }}
                                                                        </div>

                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('البريد الإلكترونى') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $student->email }}
                                                                        </div>

                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('رقم الجوال') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $student->phone }}
                                                                        </div>

                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('البايو') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{ $student->bio }}
                                                                        </div>

                                                                    </div>



                                                                    {{-- <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ transWord('المهارات') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">

                                                                            @if ($student->skills)
                                                                                @foreach ($student->skills as $skill)
                                                                                    <span
                                                                                        class="badge badge-primary">{{ $skill }}</span>
                                                                                @endforeach
                                                                            @else
                                                                                <span>{{ transWord('No skills found.') }}</span>
                                                                            @endif

                                                                        </div>

                                                                    </div> --}}








                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ __('الصوره') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <img height="44"
                                                                                src="{{ $student->avatar_path }}"
                                                                                alt="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ __('الخلفيه') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <img height="44"
                                                                                src="{{ $student->background_image_path }}"
                                                                                alt="">
                                                                        </div>
                                                                    </div>


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
