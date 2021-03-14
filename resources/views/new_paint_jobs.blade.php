@extends('template')

@section('content-page')
    <h2 style="text-align: center">New Paint Job</h2>

    <div class="cars">
        <img class="car_left"  id="img_car_left" src="{{ asset('template/images/default_car.png') }}" alt="">
        <img class="arrow" src="{{ asset('template/images/arrow.png') }}" alt="">
        <img class="car_right" id="img_car_right"  src="{{ asset('template/images/default_car.png') }}" alt="">
    </div>
    <div class="form">
        <span class="car_details"><strong>Car Details</strong></span>
        <div class="inputs">
            <span class="span_error" id="span_error"></span>
            <label for="plate_no">Plate No.</label>
            <input type="text" id="plate_no">
        </div>
        <div class="inputs">
            <label for="current_color">Current Color</label>
            <select  id="current_color" onchange="PAINT.selectCurrentColor(this.value)">
                <option value="" selected disabled></option>
                <option value="red">red</option>
                <option value="green">green</option>
                <option value="blue">blue</option>
            </select>
        </div>
        <div class="inputs">
            <label for="target_color">Target Color</label>
            <select id="target_color" onchange="PAINT.selectTargetColor(this.value)">
                <option value="" selected disabled></option>
                <option value="red">red</option>
                <option value="green">green</option>
                <option value="blue">blue</option>
            </select>
        </div><div class="inputs">
            <button class="button_submit" type="button" onclick="NEW_PAINT.addPaintJob();">Submit</button>
        </div>
    </div>
@endsection
