
$(document).ready(function () {
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF\.\- ]*$/.test(value);
    }, window.noSpecialChars);
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, window.filesize);
console.log(window.avatarMessage);

    $("#createReviewForm").validate({
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
            desc_ar: {
                required: true,
                minlength: 3,

            },
            desc_en: {
                required: true,
                minlength: 3,

            },
            image : {
                required: true,
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
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

    $("#updateReviewForm").validate({
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
            desc_ar: {
                required: true,
                minlength: 3,

            },
            desc_en: {
                required: true,
                minlength: 3,

            },
            image : {
                accept: "image/png, image/jpeg, image/svg+xml",
                filesize: 1048576
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
