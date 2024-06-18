<!-- BEGIN: Vendor JS-->
<script src="{{ asset('dashboard/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('dashboard/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('dashboard/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

{{-- <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script> --}}

<script src="{{ asset('dashboard/app-assets/js/scripts/filepond/filepond-plugin-image-preview.js') }}"></script>

<script src="https://ernestbrandi.github.io/filepond-plugin-media-preview/dist/filepond-plugin-media-preview.js"></script>
{{-- <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script> --}}
<script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>



<script src="{{ asset('dashboard/app-assets/js/scripts/filepond/filepond.min.js') }}"></script>


<script>
    FilePond.registerPlugin(FilePondPluginImagePreview);
          FilePond.registerPlugin(FilePondPluginFileValidateType);
          FilePond.registerPlugin(FilePondPluginFileValidateSize);
        //   FilePond.registerPlugin(FilePondPluginImageEdit);
          FilePond.registerPlugin(FilePondPluginMediaPreview);





</script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>


<script>
CKEDITOR.replace('desc_ar', {
    language: 'ar'
});
CKEDITOR.replace('desc_en', {
    language: 'en'
});

CKEDITOR.replace('requirements_ar', {
    language: 'ar'
});
CKEDITOR.replace('requirements_en', {
    language: 'en'
});
</script> --}}


{{-- <script>
       @if (app()->getLocale() == 'ar')
       window.avatarMessage = "{{ __('يجب ان يكون الصورة بصيغة png, jpg, jpeg,svg') }}"
       window.backgroundMessage = "{{ __('يجب ان يكون الخلفية بصيغة png, jpg, jpeg,svg') }}"
       window.phoneMessage = "{{ __('يجب ان يكون الهاتف ارقام') }}"
       window.emailmessage = "{{ __('من فضلك ادخل بريد الكتروني من gmail.com, yahoo.com, hotmail.com, او outlook.com') }}";
        window.acceptMessage = "{{ __('يجب ان يكون النوع  png, jpg, jpeg') }}";
        window.acceptMessageVideo = "{{ __('يجب ان يكون النوع  mp4') }}";
        window.linkYoutube = "{{ __('يجب ان يكون رابط الفيديو مسموح به من يوتيوب') }}";
        window.facebookMessage = "{{ __('يحب ان يكون رابط فيس بوك ') }}";
        window.twitterMessage = "{{ __('يجب ان يكون رابط تويتر') }}";
        window.linkedinMessage = "{{ __('يجب ان يكون رابط لينكدان') }}";
        window.githubMessage = "{{ __('يجب ان يكون رابط جيت هاب') }}";


    @else

        window.avatarMessage = "{{ __('The image must be png, jpg, jpeg,svg') }}"
        window.avatarMessage = "{{ __('The background must be png, jpg, jpeg,svg') }}"
        window.phoneMessage = "{{ __('The phone must be numbers') }}"
        window.emailmessage = "{{ __('Please enter an email from gmail.com, yahoo.com, hotmail.com, or outlook.com.') }}";
        window.acceptMessage = "{{ __('The type must be png, jpg, jpeg') }}";
        window.acceptMessageVideo = "{{ __('The type must be mp4') }}";
        window.linkYoutube = "{{ __('The video link must be allowed from youtube') }}";
        window.facebookMessage = "{{ __('The link must be from facebook') }}";
        window.twitterMessage = "{{ __('The link must be from twitter') }}";
        window.linkedinMessage = "{{ __('The link must be from linkedin') }}";
        window.githubMessage = "{{ __('The link must be from github') }}";


    @endif

</script> --}}

<script>
    @php
        $messages = [
            'avatarMessage' => transWord('The image must be png, jpg, jpeg,svg'),
            'backgroundMessage' => transWord('The background must be png, jpg, jpeg,svg'),
            'phoneMessage' => transWord('The phone must be numbers'),
            'emailmessage' => transWord('Please enter an email from gmail.com, yahoo.com, hotmail.com, or outlook.com.'),
            'acceptMessage' => transWord('The type must be png, jpg, jpeg'),
            'acceptMessageVideo' => transWord('The type must be mp4'),
            'linkYoutube' => transWord('The video link must be allowed from youtube'),
            'facebookMessage' => transWord('The link must be from facebook'),
            'twitterMessage' => transWord('The link must be from twitter'),
            'linkedinMessage' => transWord('The link must be from linkedin'),
            'githubMessage' => transWord('The link must be from github'),
            'passwordConfirmationMessage' => transWord('The password and confirmation password do not match'),
            'phoneMinLengthMessage' => transWord('The phone must be at least 10 numbers'),
            'phoneMaxLengthMessage' => transWord('The phone must be at most 14 numbers'),
            'youtube' => transWord('Please enter a valid YouTube URL'),
            'vimeo' => transWord('Please enter a valid Vimeo URL'),
            'videoMessage' => transWord('The video must be mp4'),
            'noSpecialChars' => transWord('The field must not contain special characters'),
            'pdf' => transWord('The file must be pdf'),
            'price_after' => transWord('حقل السعر بعد الخصم مطلوب'),

        ];
    @endphp

    @foreach ($messages as $key => $message)
        window.{{ $key }} = "{{ $message }}";
    @endforeach
</script>
{{-- <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> --}}

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('dashboard/app-assets/js/scripts/pages/page-auth-login.js') }}"></script>
<!-- END: Page JS-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (app()->getLocale() == 'ar')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
@else
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_en.min.js"></script>
@endif



</script>

<script>
    var locale = '{!! config('app.locale') !!}';


    $('.table').DataTable({
        "language": {
            "url": locale == 'ar' ? "https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json" :
                "https://cdn.datatables.net/plug-ins/1.11.5/i18n/en-GB.json"
        },
    });
</script>


@stack('js')

@if (session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: "{{ session()->get('success') }}"
        })
    </script>
@endif

@if (session()->has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: "{{ session()->get('error') }}"
        })
    </script>
@endif

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.preview-formFile').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#formFile").change(function() {
            readURL(this);
        });
    });
</script>
