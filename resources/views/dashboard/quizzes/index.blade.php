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
                                    href="{{ route('admin.quizzes.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('اضافه امتحان جديد') }}
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
                                        <th>{{ transWord('عنوان الامتحان') }}</th>
                                        <th>{{ transWord('اسم الكورس') }}</th>
                                        <th>{{ transWord('اسم موضوع الكورس') }}</th>
                                        <th>{{ transWord('الوقت المحدد') }}</th>
                                        <th>{{ transWord('الدرجه النهائيه') }}</th>
                                        <th>{{ transWord('درجه النجاح') }}</th>
                                        <th>{{ transWord('عدد الاسئله') }}</th>
                                        <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quizzes as $quiz)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $quiz->name }}</td>
                                                <td>{{ $quiz->course?->title }}</td>
                                                <td>{{ $quiz->topic?->name }}</td>
                                                <td>{{ $quiz->time }}</td>
                                                <td>{{ $quiz->total_score }}</td>
                                                <td>{{ $quiz->pass_score }}</td>
                                                <td>{{ $quiz->questions?->count() }}</td>





                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.questions.create', $quiz->id) }}"
                                                            class="btn btn-sm btn-success"
                                                            title="{{ transWord('Create Questions') }}">


                                                            <i class="fa-solid fa fa-plus"></i>
                                                            {{-- <i class="fa-solid fa-pen-to-square"></i> --}}

                                                        </a>
                                                        <a href="{{ route('admin.questions.show', $quiz->id) }}"
                                                            class="btn btn-info btn-circle btn-sm"
                                                            title="{{ transWord('Show Questions') }}"
                                                            >
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quizzes.edit', $quiz->id) }}"
                                                            class="btn btn-sm btn-primary"
                                                            title="{{ transWord('Edit') }}"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>

                                                        <a href="{{ route('admin.quizzes.destroy', $quiz->id) }}"
                                                            data-id="{{ $quiz->id }}"
                                                            title="{{ transWord('Delete') }}"
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
