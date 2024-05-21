@extends('dashboard.layouts.app')

@section('title', transWord('مواضيع الكورس'))

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
                                            href="{{ route('admin.topics.index') }}">{{ transWord('المواضيع') }}</a>
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
                                    href="{{ route('admin.topics.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('إضافة موضوع كورس جديد') }}
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
                                            <th>{{ transWord('الاسم') }}</th>
                                            <th>{{ transWord('الوصف') }}</th>
                                            <th>{{ transWord('اسم الكورس') }}</th>
                                            <th>{{ transWord('نوع الموضوع') }}</th>
                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topics as $topic)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $topic->name }}</td>
                                                <td>{{ $topic->description }}</td>
                                                <td>{{ $topic->course?->title }}</td>
                                                <td>
                                                    @if ($topic->type == 'quiz')
                                                        <span class="badge badge-light-primary">{{ transWord('امتحان') }}</span>
                                                        @elseif($topic->type == 'lesson')
                                                        <span class="badge badge-light-warning">{{ transWord('درس') }}</span>
                                                        @else
                                                        <span class="badge badge-light-info">{{ transWord('تكاليف') }}</span>


                                                    @endif
                                                </td>



                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.topics.edit', $topic->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.topics.destroy', $topic->id) }}"
                                                            data-id="{{ $topic->id }}"
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
