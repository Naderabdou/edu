$(document).ready(function () {
    $("#createForm").validate({
        // initialize the plugin

        rules: {
            type: {
                required: true,
            },
            link: {
                // required: true,
                url: true
            },
            image: {
                required: true,
            },
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });

    $("#updateForm").validate({
        // initialize the plugin

        rules: {
            type: {
                required: true,
            },
            link: {
                // required: true,
                url: true
            },
            // image: {
            //     required: true,
            // },
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
