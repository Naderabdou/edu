
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);


    $("#createBlogForm").validate({
        // initialize the plugin

        rules: {
            title_ar : {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            title_en : {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            desc_ar : {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            desc_en : {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },

            image: {
                required : true,
                accept: "image/png, image/jpeg, image/svg+xml"

            }

        },
        messages : {
            image : {
                accept : window.avatarMessage
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#updateBlogForm").validate({
        // initialize the plugin

        rules: {
            title_ar : {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            title_en : {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },
            desc_ar : {
                required: true,
                minlength: 3,
                noSpecialChars: true,

            },
            desc_en : {
                required: true,
                minlength: 3,
                noSpecialChars: true,
            },

            image: {
                accept: "image/png, image/jpeg, image/svg+xml"

            }
        },

        messages : {
            image : {
                accept : window.avatarMessage
            }
        },
        

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
