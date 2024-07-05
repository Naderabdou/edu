<div class="form-group" id="headingOne">
    <h2 class="mb-0">

        <button class="btn btn-md  btn-block btn-primary text-center" type="button" data-toggle="collapse"
            data-target="#additional_information" aria-expanded="true" aria-controls="additional_information">
            {{ transWord('Additional Information') }}
        </button>
    </h2>
</div>

<div id="additional_information" class="collapse show" aria-labelledby="additional_information"
    data-parent="#additional_information">
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                <label for="language">{{ transWord('Languages') }}</label>
                <select class="form-control select-multiple" id="language" name="language[]" multiple="multiple">
                    <option value="english"
                        {{ collect(old('language', $course->language))->contains('english') ? 'selected' : '' }}>
                        {{ transWord('English') }}</option>
                    <option value="arabic"
                        {{ collect(old('language', $course->language))->contains('arabic') ? 'selected' : '' }}>
                        {{ transWord('Arabic') }}</option>
                    <option value="japan"
                        {{ collect(old('language', $course->language))->contains('japan') ? 'selected' : '' }}>
                        {{ transWord('Japan') }}</option>
                    <option value="hindi"
                        {{ collect(old('language', $course->language))->contains('hindi') ? 'selected' : '' }}>
                        {{ transWord('Hindi') }}</option>
                    <option value="frence"
                        {{ collect(old('language', $course->language))->contains('frence') ? 'selected' : '' }}>
                        {{ transWord('Frence') }}</option>
                    <option value="garmani"
                        {{ collect(old('language', $course->language))->contains('garmani') ? 'selected' : '' }}>
                        {{ transWord('Garmani') }}</option>
                </select>
                @error('language')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="start_date">{{ transWord('Start Date') }}</label>
                <input type="date" id="start_date" class="form-control" name="start_date"
                    value="{{ old('start_date', $course->start_date) }}" />
                @error('start_date')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>

        </div>
        <div class="col-12">

            <h3 class="card-title">{{ transWord('Total Course Duration') }}
            </h3>

        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="duration_hours">{{ transWord('Hours') }}</label>
                <input type="number" min="1" id="duration_hours" class="form-control" name="duration_hours"
                    value="{{ old('duration_hours', $course->duration_hours) }}" />
                @error('duration_hours')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="duration_minutes">{{ transWord('Minutes') }}</label>
                <input type="number" min="1" id="duration_minutes" class="form-control" name="duration_minutes"
                    value="{{ old('duration_minutes', $course->duration_minutes) }}" />
                @error('duration_minutes')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="tags">{{ transWord('Course Tags') }}</label>
                <select class="form-control select-multiple_tages" id="tags" name="tags[]" multiple="multiple">
                    @php
                        $tags = collect(
                            old('tags', is_string($course->tags) ? explode(',', $course->tags) : $course->tags),
                        );

                    @endphp
                    @if ($tags)
                        @foreach ($tags as $item)
                            <option selected value="{{ $item }}">
                                {{ $item }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="target_audience">{{ transWord('Targeted Audience') }}</label>
                <select class="form-control select-multiple_tages" id="target_audience" name="target_audience[]"
                    multiple="multiple">
                    @php
                        $target_audience = collect(
                            old('target_audience', is_string($course->target_audience) ? explode(',', $course->target_audience) : $course->target_audience),
                        );

                    @endphp
                    @if ($target_audience)
                        @foreach ($target_audience as $item)
                            <option selected value="{{ $item }}">
                                {{ $item }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>




        <div class="col-6">
            <div class="form-group">
                <label for="requirements_ar">{{ transWord('المتطلبات بالعربي') }}</label>
                <textarea required id="requirements_ar" class="form-control tinyEditor" name="requirements_ar"
                    style="width: 100%; height: 200px;">{{ old('requirements_ar', $course->requirements_ar) }}</textarea>
                @error('requirements_ar')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="requirements_en">{{ transWord('المتطلبات بالانجليزي') }}</label>
                <textarea required id="requirements_en" class="form-control tinyEditor" name="requirements_en"
                    style="width: 100%; height: 200px;">{{ old('requirements_en', $course->requirements_en) }}</textarea>
                @error('requirements_en')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="desc_ar">{{ transWord('الوصف بالعربي') }}</label>
                <textarea required id="desc_ar" class="form-control tinyEditor" name="desc_ar"
                    style="width: 100%; height: 200px;">{{ old('desc_ar', $course->desc_ar) }}</textarea>
                @error('desc_ar')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="desc_en">{{ transWord('الوصف بالانجليزي') }}</label>
                <textarea required id="desc_en" class="form-control tinyEditor" name="desc_en"
                    style="width: 100%; height: 200px;">{{ old('desc_en', $course->desc_en) }}</textarea>
                @error('desc_en')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>








    </div>
</div>
