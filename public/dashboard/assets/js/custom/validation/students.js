$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);


    $.validator.addMethod("domain", function(value, element) {
        // Allow emails from gmail.com, yahoo.com, hotmail.com, and outlook.com
        return this.optional(element) || /^[\w.-]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com)$/.test(value);
    }, window.emailmessage);


    $.validator.addMethod("phone_type", function(value, element) {
        return this.optional(element) || /^[0-9+]+$/.test(value);
    }, window.phoneMessage);

    $.validator.addMethod("facebook", function(value, element) {
        return this.optional(element) || /^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(value);
    }, window.facebookMessage);

    $.validator.addMethod("twitter", function(value, element) {
        return this.optional(element) || /^(https?:\/\/)?((w{3}\.)?)twitter.com\/.*/i.test(value);
    },window.twitterMessage);

    $.validator.addMethod("github", function(value, element) {
        return this.optional(element) || /^(https?:\/\/)?((w{3}\.)?)github.com\/.*/i.test(value);
    }, window.githubMessage);

    $.validator.addMethod("linkedin", function(value, element) {
        return this.optional(element) || /^(https?:\/\/)?((w{3}\.)?)linkedin.com\/.*/i.test(value);
    }, window.linkedinMessage);





    $("#studentsFormCreate").validate({
        // initialize the plugin

        rules: {
            first_name:{
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialChars: true,

            },

            last_name:{
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialChars: true,

            },

            public_name:{
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialChars: true,

            },

            username :{
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialChars: true,
                remote: {
                    url: $("#route_username").val(),
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        username: function() {
                            return $( "#username" ).val();
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },

            email:{
                required: true,
                email: true,
                domain: true,
                remote: {
                    url: $("#route_email").val(),
                    type: "post",

                    data: {
                        email: function() {
                            return $( "#email" ).val();
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }


                }

            },

            phone:{
                required: true,
                minlength: 10,
                maxlength: 15,
                phone_type: true,
                remote: {
                    url: $("#route_phone").val(),
                    type: "post",

                    data: {
                        phone: function() {
                            return $( "#phone" ).val();
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }


                }

            },


            password:{
                required: true,
                minlength: 8,
            },

            password_confirmation:{
                required: true,
                equalTo: "#password",

            },
            'skills[]':{
                required: true,
             //   noSpecialChars: true,


            },
            bio:{
                required: true,
                minlength: 10,
                maxlength: 500,
                noSpecialChars: true,

            },
            avatar: {
                required: true,
                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
            },
            background_image : {
                required: true,
                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
            },
            facebook:{
                url: true,
                facebook: true,


            },
            twitter:{
                url: true,
                twitter: true,

            },
            github:{
                url: true,
                github: true,

            },

            linkedin:{
                url: true,
                linkedin: true,

            },
            website:{
                url: true,

            },




        },


        messages: {
            avatar: {
                accept: window.avatarMessage,
            },
            background_image: {
                accept: window.backgroundMessage,
            },

            password_confirmation:{
                equalTo: window.passwordConfirmationMessage,
            },
            phone:{
                minlength: window.phoneMinLengthMessage,
                maxlength: window.phoneMaxLengthMessage,
            }



        },



        errorElement: "span",
        errorLabelContainer: ".errorTxt",


        submitHandler: function (form) {

            form.submit();
        },
    });

    $("#studentsFormUpdate").validate({
        // initialize the plugin

        rules: {

            first_name:{
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialChars: true,

            },

            last_name:{
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialChars: true,

            },

            public_name:{
                required: true,
                minlength: 2,
                noSpecialChars: true,

                maxlength: 50,
            },

            username :{
                required: true,
                minlength: 2,
                maxlength: 50,
                noSpecialChars: true,

                remote: {
                    url: $("#route_username").val(),
                    type: "post",

                    data: {
                        username: function() {
                            return $( "#username" ).val();
                        },
                        id: function() {
                            return $( "#id" ).val(); // assuming the ID of the record is stored in a field with the ID "id"
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }
                }
            },

            email:{
                required: true,
                email: true,
                domain: true,

                remote: {
                    url: $("#route_email").val(),
                    type: "post",

                    data: {
                        email: function() {
                            return $( "#email" ).val();
                        },
                        id: function() {
                            return $( "#id" ).val(); // assuming the ID of the record is stored in a field with the ID "id"
                        }
                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }


                }

            },

            phone:{
                required: true,
                minlength: 10,
                maxlength: 15,
                phone_type: true,

                remote: {
                    url: $("#route_phone").val(),
                    type: "post",

                    data: {
                        phone: function() {
                            return $( "#phone" ).val();
                        },
                        id: function() {
                            return $( "#id" ).val(); // assuming the ID of the record is stored in a field with the ID "id"
                        }


                    },
                    dataFilter: function(data) {

                        var json = JSON.parse(data);
                        if (json.message) {
                            return "\"" + json.message + "\"";
                        }
                        return true;
                    }


                }

            },


            password:{
                required: true,
                minlength: 8,
            },

            password_confirmation:{
                required: true,
                equalTo: "#password",

            },
            'skills[]':{
                required: true,
                //noSpecialChars: true,


            },
            bio:{
                required: true,
                minlength: 10,
                noSpecialChars: true,

                maxlength: 500,
            },
            avatar: {
                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
            },
            background_image : {
                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
            },
            facebook:{
                url: true,
                facebook: true,

            },
            twitter:{
                url: true,
                twitter: true,
            },
            github:{
                url: true,
                github: true,
            },

            linkedin:{
                url: true,
                linkedin: true,
            },
            website:{
                url: true,
            },






        },
        messages: {

        },

        errorElement: "span",
        errorLabelContainer: ".errorTxt",

        submitHandler: function (form) {
            form.submit();
        },
    });
});
