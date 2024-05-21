$(document).ready(function() {
    $('#is_content_drip_enabled').change(function() {
        if ($(this).val() == 1) {
            $('#content_drip_type').parent().show();
        } else {
            $('#content_drip_type').parent().hide();
        }
    })


    $('#intro_video_type').change(function() {
        // Hide all divs
        $('#upload, #vimeo , #youtube').hide().find('input').val('');
        $('#upload').find('.preview-video').attr('src', '');

        // Show the div with the ID that matches the selected value
        $('#' + $(this).val()).show();
    });

    // $('#collapseOne').on('show.bs.collapse', function(){
    //     $('#general').collapse('show');
    //     $('#Content_Drip').collapse('hide');
    // });
    //  $('#collapseOne').collapse('hide');
    //$('#video').collapse('hide');
    $('#course_builder').collapse('hide');
    //$('#additional_information').collapse('hide');
    $('#certificate').collapse('hide');

    //  $('#general').collapse('hide');
    $('#Content_Drip').collapse('hide');
    //$('#Paid').collapse('hide');
    $('#Free').collapse('hide');

    function toggleCollapses(collapse1, collapse2, remove) {
        $(collapse1).on('show.bs.collapse', function() {
            $(collapse2).collapse('hide');
        });
        if (remove == true) {
            $(collapse1).on('hidden.bs.collapse', function() {
                // Clear the data inside the collapse
                $(this).find('input').val(''); // Clear input fields
                $(this).find('textarea').val(''); // Clear textarea fields
                $(this).find('select').val(''); // Clear select fields
            });
        }

    }
    toggleCollapses('#Content_Drip', '#general');
    toggleCollapses('#general', '#Content_Drip');
    toggleCollapses('#Paid', '#Free', true);
    toggleCollapses('#Free', '#Paid', true);



    $(".select-multiple").select2({

    });
    $(".select-multiple_tages").select2({
        tags: true

    });
    $(".instructor_select2").select2()








    /// filePond


});
