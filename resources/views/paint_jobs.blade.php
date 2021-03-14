@extends('template')

@section('content-page')
    <h2 style="text-align: center">Paint Jobs</h2>
    <div class="table_container">
        <span class="car_details"><strong>Paint Jobs in Progress</strong></span>
        <table>
            <thead>
                <tr>
                    <th>Plate No.</th>
                    <th>Current Color</th>
                    <th>Target Color</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody_paint_progress"></tbody>
        </table>
    </div>
    <div class="table_container_2">
        <table>
            <thead>
                <tr>
                    <th style="text-align: center">SHOP PERFORMANCE</th>
                </tr>
            </thead>
            <tbody id="tbody_shop_performance">
                
            </tbody>
        </table>
    </div>
    <div class="table_container">
        <span class="car_details"><strong>Paint Queue</strong></span>
        <table>
            <thead>
                <tr>
                    <th>Plate No.</th>
                    <th>Current Color</th>
                    <th>Target Color</th>
                </tr>
            </thead>
            <tbody id="tbody_paint_queue"></tbody>
        </table>
    </div>
@endsection