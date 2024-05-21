$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.addMethod("noSpecialChars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
    }, window.noSpecialChars);








    $("#questionsFormCreate").validate({


        rules: {
            // Define validation rules for your form fields here
            'answer[0]': {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            'answer[1]': {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            'answer[2]': {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            'answer[3]': {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            correct_answer: {
                required: true
            },
            question: {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            score: {
                required: true,
                number: true

            },
            quiz_id: {
                required: true

            }
            // Add more fields as needed
        },



        errorElement: "span",
        errorLabelContainer: ".errorTxt",


        submitHandler: function (form) {
            var formData = new FormData(form);
            let url = form.action;
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // Handle success
                    $('form').trigger('reset');
                    Swal.fire({
                        icon: 'success',
                        title: `<h5> ${data.message}</h5> `,
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#questionHeader').text('اضافة السؤال ' + data
                        .count +
                        ' في اختبار "' + data.name + '"');
                },
                error: function (data) {
                    $('.error-message').text('');
                    var errors = data.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        var errorMessage = messages.join(', ');
                        $('#' + field + '_error').text(
                            errorMessage);
                    });
                },
            });

        },
    });

    $("#questionsFormUpdate").validate({
        rules: {
            // Define validation rules for your form fields here
            'answer[0]': {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            'answer[1]': {
                required: true,
                minlength: 3,
                noSpecialChars: true

            },
            'answer[2]': {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            'answer[3]': {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            correct_answer: {
                required: true
            },
            question: {
                required: true,
                minlength: 3,
                noSpecialChars: true
            },
            score: {
                required: true,
                number: true

            },
            quiz_id: {


            }
            // Add more fields as needed
        },



        errorElement: "span",
        errorLabelContainer: ".errorTxt",


        submitHandler: function (form) {

            form.submit();
        },
    });



});
