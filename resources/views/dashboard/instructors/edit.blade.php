@extends('dashboard.layouts.app')

@section('title', transWord('تعديل مدرب '))

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
                                            href="{{ route('admin.instructors.index') }}">{{ transWord('الرئيسية') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ transWord('تعديل مدرب')  }}</a>
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
                                    <h2 class="card-title">{{  transWord('تعديل مدرب')}} - {{  $instructor->first_name }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" id="studentsFormUpdate"
                                        action="{{ route('admin.instructors.update',$instructor->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="id" name="id" value="{{ $instructor->id }}" />
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first_name">{{ transWord('الاسم الاول') }}</label>
                                                    <input type="text" id="first_name" class="form-control" name="first_name"
                                                        value="{{ old('first_name',$instructor->first_name) }}"  />
                                                    @error('first_name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="last_name">{{ transWord('الاسم الثاني') }}</label>
                                                    <input type="text" id="last_name" class="form-control" name="last_name"
                                                        value="{{ old('last_name',$instructor->last_name) }}"  />
                                                    @error('last_name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="public_name">{{ transWord('الاسم العام') }}</label>
                                                    <input type="text" id="public_name" class="form-control" name="public_name"
                                                        value="{{ old('public_name',$instructor->public_name) }}"  />
                                                    @error('public_name')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="username">{{ transWord('اسم المستخدم') }}</label>
                                                    <input type="text" id="username" class="form-control" name="username"
                                                        value="{{ old('username',$instructor->username) }}"  />
                                                    @error('username')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email">{{ transWord('البريد الإلكترونى') }}</label>
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        value="{{ old('email',$instructor->email) }}"  />
                                                    @error('email')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="phone">{{ transWord('رقم الجوال') }}</label>
                                                    <input type="text" id="phone" class="form-control" name="phone"
                                                        value="{{ old('phone',$instructor->phone) }}"  />
                                                    @error('phone')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- <div class="col-6">
                                                <div class="form-group">
                                                    <label for="password">{{ transWord('كلمة المرور') }}</label>
                                                    <input type="password" id="password" class="form-control"
                                                        name="password" value="{{ old('password') }}"  />
                                                    @error('password')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation">{{ transWord('تأكيد كلمة المرور') }}</label>
                                                    <input type="password" id="password_confirmation" class="form-control"
                                                        name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                         />
                                                    @error('password_confirmation')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="skills">{{ transWord('المهارات الخاصه بك') }}</label>
                                                    <select class="form-control select-multiple" id="skills" name="skills[]"
                                                        multiple="multiple">
                                                        @if (old('skills',$instructor->skills))
                                                            @foreach (old('skills',$instructor->skills) as $item)
                                                                <option selected value="{{ $item }}">{{ $item }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('skills')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="bio">{{ transWord('bio') }}</label>
                                                    <textarea id="bio" class="form-control" name="bio" style="width: 100%; height: 200px;" >{{ old('bio',$instructor->bio) }}</textarea>

                                                  @error('bio')
                                                  <span class="alert alert-danger">
                                                    <small class="errorTxt">{{ $message }}</small>
                                                </span>
                                                  @enderror


                                                </div>
                                            </div>











                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="avatar"
                                                        class="form-label">{{ transWord('الصوره الشخصيه') }}</label>
                                                    <input class="filepond" type="file" id="avatar" name="avatar"
                                                        required='true'>
                                                    {{-- @error('avatar')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror --}}
                                                </div>

                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="background_image"
                                                        class="form-label">{{ transWord('الصوره الخلفيه') }}</label>
                                                    <input class="filepond" type="file" id="background_image"
                                                        name="background_image" required='true'>

                                                </div>

                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="facebook"
                                                        class="form-label">{{ transWord('رابط الفيس بوك') }}</label>
                                                        <input type="text" id="facebook" class="form-control" name="facebook"
                                                        value="{{ old('facebook',$instructor->facebook) }}"  />
                                                    @error('facebook')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="twitter"
                                                        class="form-label">{{ transWord('رابط تويتر') }}</label>
                                                        <input type="text" id="twitter" class="form-control" name="twitter"
                                                        value="{{ old('twitter',$instructor->twitter) }}"  />
                                                    @error('twitter')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="github"
                                                        class="form-label">{{ transWord('رابط جيت هب') }}</label>
                                                        <input type="text" id="github" class="form-control" name="github"
                                                        value="{{ old('github',$instructor->github) }}"  />
                                                    @error('github')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="linkedin"
                                                        class="form-label">{{ transWord('رابط لينكدان') }}</label>
                                                        <input type="text" id="linkedin" class="form-control" name="linkedin"
                                                        value="{{ old('linkedin',$instructor->linkedin) }}"  />
                                                    @error('linkedin')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="website"
                                                        class="form-label">{{ transWord('رابط موقعك') }}</label>
                                                        <input type="text" id="website" class="form-control" name="website"
                                                        value="{{ old('website',$instructor->website) }}"  />
                                                    @error('website')
                                                        <span class="alert alert-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>



                                            <input type="hidden" id='route_username' value="{{ route('admin.check.username') }}">
                                            <input type="hidden" id='route_email' value="{{ route('admin.check.email') }}">
                                            <input type="hidden" id='route_phone' value="{{ route('admin.check.phone') }}">


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
    <script>
             $(".select-multiple").select2({
                tags: true
            });
    </script>
        <script src="{{ asset('dashboard/assets/js/custom/validation/students.js') }}"></script>
        <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>
        @php
        function createFileObject($path)
        {
            return [
                'source' => $path,
                'options' => [
                    'type' => 'local',
                ],
            ];
        }
    @endphp
    <script>
        // get a collection of elements with class filepond


        const inputElements = document.querySelectorAll('input.filepond');

        // loop over input elements
        Array.from(inputElements).forEach(inputElement => {

            // create a FilePond instance at the input element location
            FilePond.create((inputElement), {

                    // acceptedFileTypes: ['image/png', 'image/jpeg', 'image/svg', 'image/jpg'],
                    acceptedFileTypes: ['image/*'],

                    labelFileTypeNotAllowed: window.avatarMessage,
                    minFileSize: '0.5MB',
                    maxFileSize: '30MB',
                    labelMaxFileSizeExceeded: "{{ transWord('الحد الاقصى لحجم الملف هو') }}",
                    labelFileProcessing: "{{ transWord('جاري التحميل') }}",
                    labelFileProcessingComplete: "{{ transWord('تم التحميل') }}",
                    labelTapToCancel: "{{ transWord('انقر للغاء') }}",
                    required: true,
                    labelIdle : "{{ transWord('قم بسحب الصوره او') }} <span class='filepond--label-action' tabindex='0'> انقر هنا </span>",



                }

            );
            FilePond.setOptions({
                server: {
                    load: (source , load , error , progress , abort , headers) => {
                        fetch(source).then(res => res.blob()).then(load).catch(error)
                    },
                    process: "{{ route('admin.tmp.uploads', ['folder' => 'instructors']) }}",
                    revert: "{{ route('admin.tmp.delete',['folder' => 'instructors']) }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },
                    withCredentials: false,
                    // onerror: (response) => response.data,
                },
                files: [
                    @json(createFileObject($instructor->avatar_path)),
                    @json(createFileObject($instructor->background_image_path)),
                ],

            })

        })
    </script>
    @endpush
@endsection
