$(document).ready(function () {
    $.validator.addMethod("youtube", function(value, element) {
        var regex = /^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/;
        return this.optional(element) || regex.test(value);
    }, window.linkYoutube);

    // $.validator.addMethod("time", function(value, element) {
    //     return this.optional(element) || /^((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))$/.test(value);
    // }, 'Please enter a valid time in 12-hour format');
console.log(window.linkYoutube);
    $("#createForm").validate({
        // initialize the plugin



        rules: {
            name:{
                required: true,
                minlength: 2,

            },
            role:{
                required: true,
            },
            name_ar: {
                required: true,
                minlength: 3,
            },
            name_en: {
                required: true,
                minlength: 3,
            },
            image: {
                required: true,
                accept: "image/*"


            },
            photo: {
                required: true,
                accept: "image/*"
            },
            icon : {
                required: true,
                accept: "image/*"
            },


            source_name_ar: {
                required: true,
                minlength: 3,
            },
            source_name_en: {
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
            category_ids: {
                required: true,
            },
            parent_id: {
                required: true,
            },
            ayah_name_ar: {
                required: true,
                minlength: 3,
            },
            ayah_name_en: {
                required: true,
                minlength: 3,
            },
            ayah_number: {
                required: true,
                digits: true,
                min: 1,
    max: 6348
            },
            surah_name_ar: {
                required: true,
                minlength: 3,
            },
            surah_name_en: {
                required: true,
                minlength: 3,
            },
            benefit_en : {
                required: true,
                minlength: 3,
            },

            benefit_ar : {
                required: true,
                minlength: 3,
            },
            title_en: {
                required: true,
                minlength: 3,
            },
            title_ar: {
                required: true,
                minlength: 3,
            },
            media : {
             //   required: true,
                accept: "mp4,3gp,avi,mov,flv,wmv,ts,mkv",
                url: true,
              //  youtube: true
            },
            type : {
                required: true,
            },
            category_id : {
                required: true,
            },

            link : {
                required: true,
                url: true,
                youtube: true
            },
            frame : {
                required: true,
                accept: "image/*"
            },
            benefits : {
                required: true,
                minlength: 3,

            },
            content : {
                required: true,
                minlength: 3,

            },
            type_id : {
                required: true,
            },
            time : {
                required: true,


            },
            title : {
                required: true,
                minlength: 3,

            }





        },

        messages: {
            image: {
                accept: window.acceptMessage
            },
            photo: {
                accept: window.acceptMessage
            },
            icon: {
                accept: window.acceptMessage
            },
            media: {
                accept: window.acceptMessageVideo
            },
            frame: {
                accept: window.acceptMessage
            },
            link : {

                youtube: window.linkYoutube
            },
            ayah_number : {
                digits:  window.numberC,
                max : window.ayahNumber
            }




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
            name:{
                required: true,

            },
            role:{
                required: true,
            },
            name_ar: {
                required: true,
                minlength: 3,
            },
            name_en: {
                required: true,
                minlength: 3,
            },
            source_name_ar : {
                required: true,
                minlength: 3,
            },
            source_name_en: {
                required: true,
                minlength: 3,
            },

            // image: {
            //     required: true,
            // },
            desc_ar: {
                required: true,
                minlength : 3,
            },
            desc_en: {
                required: true,
                minlength : 3,
            },
            category_ids: {
                required: true,
            },

            ayah_name_ar: {
                required: true,
                minlength: 3,
            },
            ayah_name_en: {
                required: true,
                minlength: 3,
            },
            ayah_number: {
                required: true,
                digits: true,
                min: 1,
    max: 6348
            },

            surah_name_ar: {
                required: true,
                minlength: 3,
            },
            surah_name_en: {
                required: true,
                minlength: 3,
            },
            benefit_en : {
                required: true,
                minlength: 3,
            },

            benefit_ar : {
                required: true,
                minlength: 3,
            },
            image: {
                accept: "image/*"


            },
            photo: {
                accept: "image/*"


            },
            about_image:{
                accept: "image/*"
            },

            icon : {
                accept: "image/*"
            },
            title_ar: {
                required: true,
                minlength: 3,
            },
            title_en: {
                required: true,
                minlength: 3,
            },
            logo: {
                accept: "image/*"
            },
            footer_logo: {
                accept: "image/*"
            },
            favicon: {

                accept: "image/*"
            },
            frame : {

                accept: "image/*"
            },
            link : {
                required: true,
                url: true,
                youtube: true
            },
            media : {
                required: true,
                accept: "mp4,3gp,avi,mov,flv,wmv,ts,mkv"
            },
            benefits : {
                required: true,
                minlength: 3,

            },
            content : {
                required: true,
                minlength: 3,

            },
            type_id : {
                required: true,

            },
            time : {
                required: true,



            },
            title : {
                required: true,
                minlength: 3,

            }






        },
        messages: {
            image: {
                accept: window.acceptMessage
            },
            photo: {
                accept: window.acceptMessage
            },
            icon: {
                accept: window.acceptMessage
            },
            about_image: {
                accept: window.acceptMessage
            },
            logo: {
                accept: window.acceptMessage
            },
            footer_logo: {
                accept: window.acceptMessage

            },
            favicon: {
                accept: window.acceptMessage
            },
            media: {
                accept: window.acceptMessageVideo
            },
            frame: {
                accept: window.acceptMessage
            },
            link : {

                youtube: window.linkYoutube
            },
            ayah_number : {
                digits:  window.numberC,
                max : window.ayahNumber
            }
        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
