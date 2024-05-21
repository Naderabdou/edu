$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);









    $("#LessonFormCreate").validate({


        rules: {
            title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true


            },
            title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            course_id: {
                required: true
            },
            topic_id: {
                required: true
            },
            desc_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            desc_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            video_lesson: {
                required: true,
            },
            pdf_lesson: {

            }













        },

        messages: {
            upload_vidoe: {
                accept: window.videoMessage,
            },
            // requirements_ar: {
            //     ckrequired: "Please enter the requirements"
            // },
        },


        errorElement: "span",
        errorLabelContainer: ".errorTxt",


        submitHandler: function (form) {

            form.submit();
        },
    });

    $("#LessonFormUpdate").validate({
        rules: {
            title_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true


            },
            title_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            course_id: {
                required: true
            },
            topic_id: {
                required: true
            },
            desc_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            desc_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            video_lesson: {
               
            },
            pdf_lesson: {

            }













        },




        errorElement: "span",
        errorLabelContainer: ".errorTxt",


        submitHandler: function (form) {

            form.submit();
        },
    });



});
