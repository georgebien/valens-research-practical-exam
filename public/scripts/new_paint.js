const NEW_PAINT = (() => {
    let this_new_paint = {};

    this_new_paint.selectCurrentColor = (color) => {
       
        $('#img_car_left').attr('src',`${base_url_image}/${color}_car.png`);
    };
    
    this_new_paint.selectTargetColor = (color) => {
        $('#img_car_right').attr('src',`${base_url_image}/${color}_car.png`);
    };

    this_new_paint.addPaintJob = () => {

       let plate_no         = $('#plate_no').val();
       let current_color    = $('#current_color').val();
       let target_color     = $('#target_color').val();

       if (plate_no == '' || current_color == '' ||target_color == '')
       {
            $('#span_error').text('Please complete the details');
       }
       else if (current_color == target_color)
       {
            $('#span_error').text('Current color and target color cannot be the same');
       }
       else
       {
            $('#span_error').text('');

            $.ajax({
                url: 'paint-controller',
                type: 'post',
                data: {
                    _token          : _TOKEN,
                    plate_no        : plate_no,
                    current_color   : current_color,
                    target_color    : target_color,
                },
                success: result => 
                {
                    if (result.status == 'true')
                    {
                        alert(result.message)
                        $('#img_car_left').attr('src',`${base_url_image}/default_car.png`);
                        $('#img_car_right').attr('src',`${base_url_image}/default_car.png`);
                        $('#plate_no').val('');
                        $('#current_color').val('');
                        $('#target_color').val('');
                        window.location = `${base_url}/paint-jobs`;
                    }
                    else
                    {
                        alert(result.message)
                    }
                }
            });
       }
    };

    return this_new_paint;
})();
