<div class="form-group" id="headingOne">
    <h2 class="mb-0">

        <button class="btn btn-md  btn-block btn-primary text-center"
            type="button" data-toggle="collapse" data-target="#video"
            aria-expanded="true" aria-controls="video">
            {{ transWord('Course Intro Video') }}
        </button>
    </h2>
</div>

<div id="video" class="collapse show" aria-labelledby="video"
    data-parent="#video">
    <div class="row">

        <div class="col-12">
            <div class="form-group">
                <label
                    for="intro_video_type">{{ transWord('Intro Video Type') }}</label>
                <select class="form-control select2" id="intro_video_type"
                    name="intro_video_type">
                    <option disabled selected value="">
                        {{ transWord('Select Video Sources') }}</option>

                    <option
                        {{ old('intro_video_type', $course->intro_video_type) === 'youtube' ? 'selected' : '' }}
                        value="youtube">{{ transWord('youtube') }}</option>
                    <option
                        {{ old('intro_video_type', $course->intro_video_type) === 'vimeo' ? 'selected' : '' }}
                        value="vimeo">{{ transWord('vimeo') }}</option>
                    <option
                        {{ old('intro_video_type', $course->intro_video_type) === 'upload' ? 'selected' : '' }}
                        value="upload">{{ transWord('upload') }}</option>



                </select>
                @error('intro_video_type')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>


        <div class="col-12" id="youtube"
            style="display: {{ old('intro_video_type', $course->intro_video_type) === 'youtube' ? 'block' : 'none' }}">
            <div class="form-group">
                <label
                    for="youtube_url">{{ transWord('لينك الفيديو من اليوتيوب') }}</label>
                <input type="text" id="youtube_url" class="form-control"
                    name="youtube_url"
                    value="{{ $course->intro_video_type === 'youtube' ? old('youtube_url', $course->intro_video) : '' }}" />
                @error('youtube_url')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-12" id="vimeo"
            style="display: {{ old('intro_video_type', $course->intro_video_type) === 'vimeo' ? 'block' : 'none' }}">
            <div class="form-group">
                <label
                    for="vimeo_url">{{ transWord('لينك الفيديو من vimeo') }}</label>
                <input type="text" id="vimeo_url" class="form-control"
                    name="vimeo_url"
                    value="{{ $course->intro_video_type === 'vimeo' ? old('vimeo_url', $course->intro_video) : '' }}" />
                @error('vimeo_url')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-12" id="upload"
            style="display: {{ old('intro_video_type', $course->intro_video_type) === 'upload' ? 'block' : 'none' }}">
            <div class="form-group">
                <label for="upload_vidoe"
                    class="form-label">{{ transWord('فيديو المقدمه') }}</label>
                <input class=" image filepond" type="file"
                    id="upload_vidoe_edit"data-filetype="video"
                    name="upload_vidoe">
                {{-- @error('upload_vidoe')
                    <span class="alert alert-danger">
                        <small class="errorTxt">{{ $message }}</small>
                    </span>
                @enderror --}}
            </div>

            {{-- <div class="form-group prev">
            <img src="" style="width: 100px"
                class="img-thumbnail preview-upload_vidoe" alt="">
        </div> --}}
            {{-- <div class="form-group prev">
                <video width="320" height="240" controls>
                    <source src="{{ $course->intro_video_path }}"
                        type="video/mp4">

                </video>
            </div> --}}

        </div>


    </div>
</div>
