  <div class="form-group" id="headingOne">
    <h2 class="mb-0">

        <button class="btn btn-md  btn-block btn-primary text-center"
            type="button" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            {{ transWord('Course Info') }}
        </button>
    </h2>
</div>

<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
    data-parent="#accordionExample">
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label for="title_ar">{{ transWord('الاسم بالعربي') }}</label>
                <input type="text" id="title_ar" class="form-control"
                    name="title_ar" value="{{ old('title_ar') }}" />
                @error('title_ar')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label
                    for="title_en">{{ transWord('الاسم بالانجليزي') }}</label>
                <input type="text" id="title_en" class="form-control"
                    name="title_en" value="{{ old('title_en') }}" />
                @error('title_en')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>




        <div class="col-12">
            <div class="form-group">
                <label for="slug_en">Course Slug</label>
                <input type="text" id="slug_en" class="form-control"
                    name="slug_en" value="{{ old('slug_en') }}" />
                @error('slug_en')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label
                    for="about_ar">{{ transWord('About course Arabic') }}</label>
                <textarea id="about_ar" class="form-control" name="about_ar" style="width: 100%; height: 200px;">{{ old('about_ar') }}</textarea>
                @error('about_ar')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label
                    for="about_en">{{ transWord('About course English') }}</label>
                <textarea id="about_en" class="form-control" name="about_en" style="width: 100%; height: 200px;">{{ old('about_en') }}</textarea>
                @error('about_en')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-12">

            <h3 class="card-title">{{ transWord('Course Settings') }}</h3>

        </div>

        <div class="col-6">

            <div class="form-group" id="headingOne">
                <h2 class="mb-0">

                    <button
                        class="btn btn-md  btn-block btn-primary text-center"
                        type="button" data-toggle="collapse"
                        data-target="#general" aria-expanded="true"
                        aria-controls="general">
                        {{ transWord('General') }}
                    </button>
                </h2>
            </div>


        </div>
        <div class="col-6">
            <div class="form-group" id="headingOne">
                <h2 class="mb-0">

                    <button
                        class="btn btn-md  btn-block btn-primary text-center"
                        type="button" data-toggle="collapse"
                        data-target="#Content_Drip" aria-expanded="true"
                        aria-controls="Content_Drip">
                        {{ transWord('Content Drip') }}
                    </button>
                </h2>
            </div>


        </div>

        <div class="col-12">
            <div id="general" class="collapse show"
                aria-labelledby="general" data-parent="#general">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label
                                for="max_students">{{ transWord('الحد الأقصى للطلاب') }}</label>
                            <input type="number" id="max_students"
                                class="form-control" name="max_students"
                                value="{{ old('max_students') }}"
                                min="0" />
                            @error('max_students')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label
                                for="level">{{ transWord('Levels') }}</label>
                            <select class="form-control select2"
                                id="level" name="level">
                                <option value="">
                                    {{ transWord('اختر مستوي الكورس') }}
                                </option>
                                <option value="beginner"
                                    {{ old('level') == 'beginner' ? 'selected' : '' }}>
                                    {{ transWord('مبتدئ') }}</option>
                                <option value="intermediate"
                                    {{ old('level') == 'intermediate' ? 'selected' : '' }}>
                                    {{ transWord('متوسط') }}</option>
                                <option value="advanced"
                                    {{ old('level') == 'advanced' ? 'selected' : '' }}>
                                    {{ transWord('متقدم') }}</option>
                                <option value="expert"
                                    {{ old('level') == 'expert' ? 'selected' : '' }}>
                                    {{ transWord('خبير') }}</option>



                            </select>
                            @error('level')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label
                                for="is_public">{{ transWord('Public Course') }}</label>
                            <select class="form-control select2"
                                id="is_public" name="is_public">
                                <option value="">
                                    {{ transWord('اختر نوع الكورس') }}</option>
                                <option
                                    {{ old('is_public') === '1' ? 'selected' : '' }}
                                    value="1">{{ transWord('عام') }}
                                </option>
                                <option value="0"
                                    {{ old('is_public') === '0' ? 'selected' : '' }}>
                                    {{ transWord('خاص') }}</option>
                            </select>
                            @error('is_public')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label
                                for="is_qa_enabled">{{ transWord('Q&A section') }}</label>
                            <select class="form-control select2"
                                id="is_qa_enabled" name="is_qa_enabled">
                                <option selected disabled value="">
                                    {{ transWord('اختر') }}</option>
                                <option
                                    {{ old('is_qa_enabled') === '1' ? 'selected' : '' }}
                                    value="1">{{ transWord('تفعيل') }}
                                </option>
                                <option
                                    {{ old('is_qa_enabled') === '0' ? 'selected' : '' }}
                                    value="0">
                                    {{ transWord('عدم تفعيل') }}</option>
                            </select>

                            @error('is_qa_enabled')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror










                        </div>
                    </div>


                </div>
            </div>
        </div>




        <div class="col-12">
            <div id="Content_Drip" class="collapse show"
                aria-labelledby="Content_Drip" data-parent="#Content_Drip">
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label
                                for="is_content_drip_enabled">{{ transWord('content drip') }}</label>
                            <select class="form-control select2"
                                id="is_content_drip_enabled"
                                name="is_content_drip_enabled">
                                <option selected disabled value="">
                                    {{ transWord('Enable / Disable content drip') }}
                                </option>
                                <option
                                    {{ old('is_content_drip_enabled') == '1' ? 'selected' : '' }}
                                    value="1">{{ transWord('تفعيل') }}
                                </option>
                                <option
                                    {{ old('is_content_drip_enabled') == '0' ? 'selected' : '' }}
                                    value="0">
                                    {{ transWord('عدم تفعيل') }}</option>
                            </select>
                            @error('is_content_drip_enabled')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-group"
                            style="display: {{ old('is_content_drip_enabled') === 1 ? 'block' : 'none' }}">
                            <label
                                for="content_drip_type">{{ transWord('Content Drip Type') }}</label>
                            <select class="form-control select2"
                                id="content_drip_type"
                                name="content_drip_type">
                                <option value="">
                                    {{ transWord('Content Drip Type') }}
                                </option>

                                <option
                                    {{ old('content_drip_type') === 'Scheduled' ? 'selected' : '' }}
                                    value="Scheduled">
                                    {{ transWord('Schedule Course Contents By Date') }}
                                </option>
                                <option
                                    {{ old('content_drip_type') === 'Post_Enrollment' ? 'selected' : '' }}
                                    value="Post_Enrollment">
                                    {{ transWord('Content Available After X Days From Enrollment') }}
                                </option>
                                <option
                                    {{ old('content_drip_type') === 'Sequential' ? 'selected' : '' }}
                                    value="Sequential">
                                    {{ transWord('Course Content Available Sequentially') }}
                                </option>
                                <option
                                    {{ old('content_drip_type') === 'Prerequisite_Unlocked' ? 'selected' : '' }}
                                    value="Prerequisite_Unlocked">
                                    {{ transWord('Course Content Unlocked After Finishing Prerequisites') }}
                                </option>



                            </select>
                            @error('content_drip_type')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>



                </div>
            </div>
        </div>



        <div class="col-12">

            <h3 class="card-title">{{ transWord('Course Price') }}</h3>

        </div>

        <div class="col-6">

            <div class="form-group" id="headingOne">
                <h2 class="mb-0">

                    <button
                        class="btn btn-md  btn-block btn-primary text-center"
                        type="button" data-toggle="collapse"
                        data-target="#Paid" aria-expanded="true"
                        aria-controls="Paid">
                        {{ transWord('Paid') }}
                    </button>
                </h2>
            </div>


        </div>
        <div class="col-6">
            <div class="form-group" id="headingOne">
                <h2 class="mb-0">

                    <button
                        class="btn btn-md  btn-block btn-primary text-center"
                        type="button" data-toggle="collapse"
                        data-target="#Free" aria-expanded="true"
                        aria-controls="Free">
                        {{ transWord('مجانا') }}
                    </button>
                </h2>
            </div>


        </div>

        <div class="col-12">
            <div id="Paid" class="collapse show" aria-labelledby="Paid"
                data-parent="#Paid">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="hidden" id="is_paid"
                                class="form-control" name="type_course"
                                value="paid" />

                            <label
                                for="price">{{ transWord('Regular Price ($)') }}</label>
                            <input type="number" id="price"
                                class="form-control" name="price"
                                value="{{ old('price') }}" min="0" />
                            @error('price')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-group">
                            <label
                                for="discount">{{ transWord('Discounted Price ($)') }}</label>
                            <input type="number" id="discount"
                                class="form-control" name="discount"
                                value="{{ old('discount') }}"
                                min="0" />
                            @error('discount')
                                <span class="alert alert-danger">
                                    <small
                                        class="errorTxt">{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="col-12">
            <div id="Free" class="collapse show" aria-labelledby="Free"
                data-parent="#Free">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <h4 class="text-center">
                                <input type="hidden" id="is_free"
                                    class="form-control" name="type_course"
                                    value="free" />
                                {{ transWord('This Course is free for everyone.') }}
                            </h4>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="col-12">

            <h3 class="card-title form-group ">{{ transWord('اختر الاقسام') }}
            </h3>

        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="category_id">{{ transWord('الاقسام') }}</label>
                <select class="form-control select-multiple" id="category_id"
                    name="category_id[]" multiple="multiple">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ collect(old('category_id'))->contains($category->id) ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-12">

            <h3 class="card-title form-group ">{{ transWord('اختر المدرب') }}
            </h3>

        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="instructor_id">{{ transWord('المدربين') }}</label>
                <select class="form-control instructor_select2 "
                    id="instructor_id" name="instructor_id">
                    @foreach ($instructors as $instructor)
                        <option
                            {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}
                            value="{{ $instructor->id }}">
                            {{ $instructor->first_name }}
                            {{ $instructor->last_name }} </option>
                    @endforeach
                </select>
                @error('instructor_id')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>





        <div class="col-12">
            <div class="form-group">
                <label for="image"
                    class="form-label">{{ transWord('صور الكورس') }}</label>
                <input class=" image" type="file" id="image_course"
                    name="image">

            </div>

        </div>





    </div>
</div>
