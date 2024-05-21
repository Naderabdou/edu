@extends('dashboard.layouts.app')

@section('title', transWord('الاشتراكات'))

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
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        {{-- <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('admin.subscriptions.create') }}"><i class="mr-1"
                                        data-feather="circle"></i><span
                                        class="align-middle">{{ transWord('إضافة اشتراك جديد') }}
                                    </span></a>
                            </div>
                        </div> --}}
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
                                        <th>{{ transWord('اسم المشترك') }}</th>
                                            <th>{{ transWord('اسم الكورس') }}</th>
                                            <th>{{ transWord('طريق الدفع') }}</th>
                                            <th>{{ transWord('السعر') }}</th>
                                            <th>{{ transWord('الخصم') }}</th>
                                            <th>{{ transWord('السعر بعد الخصم') }}</th>
                                            <th>{{ transWord('الحاله') }}</th>
                                            {{-- <th>{{ transWord('الإجراءات') }}</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscriptions as $subscription)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subscription->user->first_name }}</td>
                                                <td>{{ $subscription->course->name }}</td>
                                                <td>{{ $subscription->payment_method }}</td>
                                                <td>{{ $subscription->price }}</td>
                                                <td>{{ $subscription->discount }}</td>
                                                <td>{{ $subscription->price_after_discount }}</td>
                                                <td>
                                                    @if ($subscription->status == 'active')
                                                        <span class="badge badgc-success">{{ transWord('مفعل') }}</span>
                                                    @else
                                                        <span class="badge badgc-danger">{{ transWord('غير مفعل') }}</span>
                                                    @endif




                                                {{-- <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin.subscriptions.destroy', $subscription->id) }}"
                                                            data-id="{{ $subscription->id }}"
                                                            class="btn btn-sm btn-danger item-delete"><i
                                                                class="fa-solid fa-trash-can"></i></a>

                                                    </div>
                                                </td> --}}
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
