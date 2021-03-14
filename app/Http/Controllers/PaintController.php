<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use DB;
use App\PaintJob;

class PaintController extends Controller
{
    public function index()
    {
        try
        {
            DB::beginTransaction();

            // $data = PaintJob::where('status', '=', 'IN PROGRESS')->get();
            $data = DB::table('paint_jobs')
            ->select('id', 'plate_no', 'current_color', 'target_color')
            ->where('status', 'IN PROGRESS')
            ->orderBy('id', 'ASC')
            ->skip(0)
            ->take(5)
            ->get();

            DB::commit();
            return response()
            ->json([
                'status' => 'true',
                'message' => 'Loaded Successfully',
                'data' => $data,
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()
            ->json([
                'status' => 'false',
                'message' => $ex->getMessage(),
                'data' => '',
            ]);
        }
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plate_no'      => 'required',
            'current_color' => 'required',
            'target_color'  => 'required',
        ]);

        if ($validator->fails()) 
        {
            return response()
                ->json([ 
                    'status' => 'false',
                    'message' => $validator->errors()->all(),
                    'data' => '',
                ]);
        } 
        else 
        {
            try
            {
                DB::beginTransaction();

                $data = DB::table('paint_jobs')
                ->where('status', 'IN PROGRESS')
                ->orderBy('id', 'ASC')
                ->skip(0)
                ->take(5)
                ->get()
                ->count();
                
                if ($data == 5)
                {
                    $status = 'ON QUEUE';
                }
                else
                {
                    $status = 'IN PROGRESS';
                }
                
                PaintJob::create([

                    'plate_no'      => $request->plate_no ,
                    'current_color' => $request->current_color ,
                    'target_color'  => $request->target_color ,
                    'status'        =>  $status,
                ]);

                DB::commit();
                return response()
                ->json([
                    'status' => 'true',
                    'message' => 'Added Successfully',
                    'data' => $data,
                ]);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()
                ->json([
                    'status' => 'false',
                    'message' => $ex->getMessage(),
                    'data' => '',
                ]);
            }
        }
    }

    public function update(Request $request, $id)
    {
         
        try
        {
            DB::beginTransaction();

            $paint_jobs = PaintJob::find($id);
            $paint_jobs->status = $request->status;
            $paint_jobs->save();

            $count = DB::table('paint_jobs')
            ->where('status', 'IN PROGRESS')
            ->orderBy('id', 'ASC')
            ->skip(0)
            ->take(5)
            ->get()
            ->count();

            if ($count != 5)
            {
                $take_count = 5 - $count;
                $data = DB::table('paint_jobs')
                ->where('status', 'ON QUEUE')
                ->orderBy('id', 'ASC')
                ->skip(0)
                ->take($take_count)
                ->get();

                foreach ($data as $value) 
                {
                    $paint_jobs = PaintJob::find($value->id);
                    $paint_jobs->status = 'IN PROGRESS';
                    $paint_jobs->save();
                }
            }

            DB::commit();
            return response()
            ->json([
                'status' => 'true',
                'message' => 'Completed Successfully',
                'data' => '',
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()
            ->json([
                'status' => 'false',
                'message' => $ex->getMessage(),
                'data' => '',
            ]);
        }
    }

    public function loadOnQueuePaintJobs() 
    {
        try
        {
            DB::beginTransaction();

            $data = PaintJob::where('status', '=', 'ON QUEUE')->get();

            DB::commit();
            return response()
            ->json([
                'status' => 'true',
                'message' => 'Loaded Successfully',
                'data' => $data,
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()
            ->json([
                'status' => 'false',
                'message' => $ex->getMessage(),
                'data' => '',
            ]);
        }
    }
    
    public function loadShopPerformance() 
    {
        try
        {
            DB::beginTransaction();

            $all_count      = PaintJob::all()->count();
            $blue_count     = PaintJob::where('target_color','=','blue')->count();
            $red_count      = PaintJob::where('target_color','=','red')->count();
            $green_count    = PaintJob::where('target_color','=','green')->count();

            DB::commit();
            return response()
            ->json([
                'status' => 'true',
                'message' => 'Loaded Successfully',
                'data' => [
                    'all_count'     => $all_count,
                    'blue_count'    => $blue_count,
                    'red_count'     => $red_count,
                    'green_count'   => $green_count,
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()
            ->json([
                'status' => 'false',
                'message' => $ex->getMessage(),
                'data' => '',
            ]);
        }
    }

}
