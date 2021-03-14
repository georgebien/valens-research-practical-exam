$(document).ready(function () {
    PAINT.loadInProgressPaintJobs()
    PAINT.loadOnQueuePaintJobs()
    PAINT.loadShopPerformance()
    setInterval(function(){ 
        PAINT.loadInProgressPaintJobs() 
        PAINT.loadOnQueuePaintJobs() 
    }, 5000);
});

const PAINT = (() => {
    let this_paint = {};

    this_paint.selectCurrentColor = (color) => {
       
        $('#img_car_left').attr('src',`${base_url_image}/${color}_car.png`);
    };
    
    this_paint.selectTargetColor = (color) => {
        $('#img_car_right').attr('src',`${base_url_image}/${color}_car.png`);
    };

    this_paint.addPaintJob = () => {

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
                    status          : 'IN PROGRESS',
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
                        // window.location = `${base_url}/paint-jobs`;
                    }
                    else
                    {
                        alert(result.message)
                    }
                }
            });
       }
    };

    this_paint.loadInProgressPaintJobs = () => {

        $.ajax({
            url: 'paint-controller',
            type: 'get',
            success: data => 
            {
                $('#tbody_paint_progress').empty();

                if (data.status == 'true')
                {
                    let tr = '';
                    data.data.forEach((value) => {
                       tr += `
                        <tr>
                            <td>${value.plate_no}</td>
                            <td>${value.current_color}</td>
                            <td>${value.target_color}</td>
                            <td><span id="span_mark_completed" onclick="PAINT.markComplete(${value.id})">Mark as Completed</span></td>
                        </tr>`; 
                   });
    
                    $('#tbody_paint_progress').html(tr);
                }
                else
                {
                    alert(data.message)
                }
            }
        });
    }

    this_paint.loadOnQueuePaintJobs = () => {

        $.ajax({
            url: 'on-queue-paint-jobs',
            type: 'get',
            success: data => 
            {
                $('#tbody_paint_queue').empty();

                if (data.status == 'true')
                {
                    let tr = '';
                    data.data.forEach((value) => {
                       tr += `
                        <tr>
                            <td>${value.plate_no}</td>
                            <td>${value.current_color}</td>
                            <td>${value.target_color}</td>
                        </tr>`; 
                   });
    
                    $('#tbody_paint_queue').html(tr);
                }
                else
                {
                    alert(data.message)
                }
            }
        });
    }
    
    this_paint.loadShopPerformance = () => {

        $.ajax({
            url: 'shop-performance',
            type: 'get',
            success: data => 
            {
                $('#tbody_shop_performance').empty();

                if (data.status == 'true')
                {
                    tr = `
                    <tr>
                        <td>Total Cars Painted:<span id="span_all_count">${data.data['all_count']}</span>
                            <ul>
                                <p>Breakdown:</p>
                                <li>Blue<span id="span_blue_count">${data.data['blue_count']}</span></li>
                                <li>Red<span id="span_red_count">${data.data['red_count']}</span></li>
                                <li>Green<span id="span_green_count">${data.data['green_count']}</span></li>
                            </ul> 
                        </td>
                    </tr>`; 
    
                    $('#tbody_shop_performance').html(tr);
                }
                else
                {
                    alert(data.message)
                }
            }
        });
    }
    
    this_paint.markComplete = (id) => {

        $.ajax({
            url: `paint-controller/${id}`,
            type: 'patch',
            data : {
                _token: _TOKEN,
                status: 'COMPLETED'
            },
            success: result => 
            {
                alert(result.message)
                PAINT.loadInProgressPaintJobs()
                PAINT.loadOnQueuePaintJobs()
            }
        });
    }
    

    return this_paint;
})();
