
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);

    $("#createCategoryForm").validate({
        // initialize the plugin

        rules: {
            name_ar: {
                required: true,
                minlength: 3,
                noSpecialChars: true,
                remote: {
                    url: $('#check_name_category').val(),
                    type: "post",

                    data: {
                        name_ar: function() {
                            return $( "#name_ar" ).val();
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
            name_en: {
                required: true,
                noSpecialChars: true,
                minlength: 3,
                remote: {
                    url:  $('#check_name_category').val(),
                    type: "post",

                    data: {
                        name_en: function() {
                            return $( "#name_en" ).val();
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
            image: {
                required: true,
                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
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

    $("#updateCategoryForm").validate({
        // initialize the plugin

        rules: {
            name_ar: {
                required: true,
                minlength: 3,
                remote: {
                    url: "http://127.0.0.1:8000/admin/check-name",
                    type: "post",

                    data: {
                        name_ar: function() {
                            return $( "#name_ar" ).val();
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
            name_en: {
                required: true,
                minlength: 3,
                remote: {
                    url: "http://127.0.0.1:8000/admin/check-name",
                    type: "post",

                    data: {
                        name_en: function() {
                            return $( "#name_en" ).val();
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
            image: {
                accept: "image/jpg, image/jpeg, image/png , image/svg+xml"
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
});
