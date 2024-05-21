
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);

    $("#TopicFormCreate").validate({
        // initialize the plugin

        rules: {
            name_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,



            },
            name_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            description_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            description_en: {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            course_id: {
                required: true,
            },
            type : {
                required: true,
            
            }

        },

        messages: {
            image: {
                accept: window.avatarMessage,
            },
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#TopicFormUpdate").validate({
        // initialize the plugin

        rules: {
            name_ar: {
                required: true,
                minlength: 3,


            },
            name_en: {
                required: true,
                minlength: 3,

            },
            description_ar: {
                required: true,
                minlength: 3,

            },
            description_en: {
                required: true,
                minlength: 3,

            },

        },

        messages: {
            image: {
                accept: window.avatarMessage,
            },
        },


        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
