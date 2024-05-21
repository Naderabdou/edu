@extends('dashboard.layouts.app')

@section('title', transWord('الاقسام'))

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
                                            href="{{ route('admin.categories.index') }}">{{ transWord('الاقسام') }}</a>
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
                                    href="{{ route('admin.categories.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('إضافة قسم جديد') }}
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
                                            <th>{{ transWord('اسم القسم') }}</th>

                                            <th>{{ transWord('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img height="44" src="{{ $category->image_path }}" alt="">
                                                </td>
                                                <td>{{ $category->name }}</td>



                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.categories.destroy', $category->id) }}"
                                                            data-id="{{ $category->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>
                                                       {{-- <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#exampleModalLong{{$instructor->id}}">
                                                                    <i class="fas fa-eye"></i>
                                                     </a> --}}
                                                     {{-- <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#exampleModalLong{{$student->id}}">
                                                        <i class="fas fa-eye"></i>
                                         </a> --}}
                                                    </div>
                                                </td>
                                            </tr>


                                            {{-- <div class="modal fade" id="exampleModalLong{{$instructor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">{{ transWord('تفاصيل المدرب') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('الاسم الاول') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{$instructor->first_name}}

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('الاسم الثانى') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{$instructor->last_name}}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('اسم المستخدم') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{$instructor->username}}
                                                                        </div>

                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('اسم العام') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{$instructor->public_name}}
                                                                        </div>

                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('البريد الإلكترونى') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{$instructor->email}}
                                                                        </div>

                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('رقم الجوال') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{$instructor->phone}}
                                                                        </div>

                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('البايو') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            {{$instructor->bio}}
                                                                        </div>

                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{  transWord('المهارات') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            @foreach ($instructor->skills as $skill)
                                                                                <span class="badge badge-primary">{{ $skill }}</span>
                                                                            @endforeach

                                                                        </div>

                                                                    </div>








                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ __('الصوره') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <img height="44" src="{{ $instructor->avatar_path}}" alt="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <b>{{ __('الخلفيه') }} : </b>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <img height="44" src="{{ $instructor->background_image_path }}" alt="">
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('إغلاق') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
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
