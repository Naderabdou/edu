$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);



    $.validator.addMethod("youtube", function (value, element) {
        var regex = /^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/;
        return this.optional(element) || regex.test(value);
    }, window.youtube);


    $.validator.addMethod("vimeo", function (value, element) {
        var regex = /(http|https)?:\/\/(www\.)?vimeo.com\/.*/;
        return this.optional(element) || regex.test(value);
    }, window.vimeo);

    $.validator.addMethod("ckrequired", function (value, element) {
        var editorContent = CKEDITOR.instances[element.name].getData().replace(/<[^>]*>/gi, '');
        return editorContent.length !== 0;
    }, "Please enter the requirements");
    $.validator.addMethod("discountedPrice", function (value, element) {
        var discount = $("#discount").val();
        return discount ? value !== '' : true;
    }, window.price_after);




    $("#coursesFormCreate").validate({
        // initialize the plugin

        rules: {
            title_ar: {
                required: true,
                minlength: 3,

            },
            title_en: {
                required: true,
                minlength: 3,

            },
            slug_en: {
                required: true,
                minlength: 3,
                remote: {
                    url: $('#check-slug').val(),
                    type: "post",

                    data: {
                        phone: function () {
                            return $("#phone").val();
                        },
                        // id: function() {
                        //     return $( "#id" ).val(); // assuming the ID of the record is stored in a field with the ID "id"
                        // }


                    },
                    dataFilter: function (data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },
            about_ar: {
                required: true,
                minlength: 3,
            },
            about_en: {
                required: true,
                minlength: 3,
            },
            max_students: {
                required: true,
                number: true,
            },
            level: {
                required: true
            },
            is_public: {
                required: true
            },
            is_qa_enabled: {
                required: true

            },
            is_content_drip_enabled: {
                required: true


            },
            content_drip_type: {
                required: true
            },
            price: {
                required: true,
                number: true,

            },
            discount: {
                number: true,


            },
            price_after_discount: {
                discountedPrice : true,
              number: true,
            },
            'category_id[]': {
                required: true

            },
            instructor_id: {
                required: true


            },
            image: {
                required: true,
                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
            },
            intro_video_type: {
                required: true

            },
            youtube_url: {
                required: true,
                youtube: true
            },

            vimeo_url: {
                required: true,
                vimeo: true
            },

            upload_vidoe: {
                required: true,
                accept: "video/mp4,video/x-m4v,video/*"
            },
            language: {
                required: true
            },
            start_date: { required: true },

            duration_hours: {
                required: true,
                number: true,

            },
            duration_minutes: {
                required: true,
                number: true,

            },

            'tags[]': {
                required: true

            },
            'target_audience[]': {
                required: true


            },

            // requirements_ar: {
            //     ckrequired: true
            // },
            // requirements_en : {
            //     required : true,
            //     minlength: 3,
            // },

            // desc_ar : {
            //     required : true,
            //     minlength: 3,
            // },
            // desc_en : {
            //     required : true,
            //     minlength: 3,
            // },





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

    $("#coursesFormUpdate").validate({
        // initialize the plugin
        rules: {
            title_ar: {
                required: true,
                minlength: 3,

            },
            title_en: {
                required: true,
                minlength: 3,

            },
            slug_en: {
                required: true,
                minlength: 3,
                remote: {
                    url: $('#check-slug').val(),
                    type: "post",
                    data: {
                        phone: function () {
                            return $("#phone").val();
                        },
                        id: function () {
                            return $("#id").val(); // assuming the ID of the record is stored in a field with the ID "id"
                        }


                    },
                    dataFilter: function (data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },
            about_ar: {
                required: true,
                minlength: 3,
            },
            about_en: {
                required: true,
                minlength: 3,
            },
            max_students: {
                required: true,
                number: true,
            },
            level: {
                required: true
            },
            is_public: {
                required: true
            },
            is_qa_enabled: {
                required: true

            },
            is_content_drip_enabled: {
                required: true


            },
            content_drip_type: {
                required: true
            },
            price: {
                required: true,
                number: true,

            },
            discount: {
                number: true,


            },
            price_after_discount: {
                discountedPrice : true,
              number: true,
            },
            'category_id[]': {
                required: true

            },
            instructor_id: {
                required: true


            },
            image: {

                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
            },
            intro_video_type: {
                required: true

            },
            youtube_url: {
                required: true,
                youtube: true
            },

            vimeo_url: {
                required: true,
                vimeo: true
            },

            upload_vidoe: {
                required: true,
                accept: "video/mp4,video/x-m4v,video/*"
            },
            language: {
                required: true
            },
            start_date: { required: true },

            duration_hours: {
                required: true,
                number: true,

            },
            duration_minutes: {
                required: true,
                number: true,

            },

            'tags[]': {
                required: true

            },
            'target_audience[]': {
                required: true


            },

            // requirements_ar: {
            //     ckrequired: true
            // },
            // requirements_en : {
            //     required : true,
            //     minlength: 3,
            // },

            // desc_ar : {
            //     required : true,
            //     minlength: 3,
            // },
            // desc_en : {
            //     required : true,
            //     minlength: 3,
            // },





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


});
