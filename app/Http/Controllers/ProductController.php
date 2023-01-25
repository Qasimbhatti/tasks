<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\Console\Input\Input;
use Intervention\Image\ImageManagerStatic as Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
    
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('products.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
         $input = $request->all();
        $image = $request->file('image');
        $input['image'] = time().'.'.$image->getClientOriginalExtension();
 
        $imgFile = Image::make($image->getRealPath());
 
        $imgFile->text(date('Y-m-d H:i:s'), 120, 100, function($font) { 
            $font->size(300000);  
            $font->color('#ffffff');  
            $font->align('center');  
            $font->valign('bottom');  
            $font->angle(90);  
        })->save(public_path('upload').'/'.$input['image']);  
         Product::create($input);
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

   

public function  meetingSchedulebk(){
                    
            $schedules = [
                [['09:00', '11:30'], ['13:30', '16:00'], ['16:00', '17:30'], ['17:45', '19:00']],
                [['09:15', '12:00'], ['14:00', '16:30'], ['17:00', '17:30']],
                [['11:30', '12:15'], ['15:00', '16:30'], ['17:45', '19:00']]
                ];


   
    
     
                $a1=  [['13:30', '16:00']];
                $a2 = [ ['14:00', '16:30']];
                $a3 = [ ['15:00', '16:30']];
                dd($schedules);

                $matching_times = array();

foreach($a1 as $index1 => $timeslot1) {
    foreach($a2 as $index2 => $timeslot2) {
        foreach($a3 as $index3 => $timeslot3) {
            if($timeslot1 == $timeslot2 && $timeslot2 == $timeslot3) {
                $matching_times[] = [
                    'index1' => $index1,
                    'index2' => $index2,
                    'index3' => $index3,
                    'timeslot' => $timeslot1,
                ];
            }
        }
    }
}

return response()->json($matching_times);


// return view('timeslots', ['matching_times' => $matching_times]);

                // $a2=$schedules[1];
    // $a3=$schedules[2];




    // $a1= $schedules[0];
    // $a2=$schedules[1];
    // $a3=$schedules[2];

    // foreach ($a1 as $k => $val) {
    //     foreach ($a2 as $k2 => $val2) {
    //         foreach ($a3 as $k3 => $val3) {
    //                 if($k == $k2 && $k == $k3 && $k2 == $k &&  $k2 ==$k3 && $k3 == $k && $k3 == $k){
    //                     $timeslots[$k]['a1'] = $val;
    //                     $timeslots[$k]['a2'] = $val2;
    //                     $timeslots[$k]['a3'] = $val3;
    //                 }
    //                 print_r($timeslots);                


    //         }
    //     }
    // }



    }
 
    
    
    public function  meetingSchedule(){
                    
        $schedules = [
            [['09:00', '11:30'], ['13:30', '16:00'], ['16:00', '17:30'], ['17:45', '19:00']],
            [['09:15', '12:00'], ['14:00', '16:30'], ['17:00', '17:30']],
            [['11:30', '12:15'], ['15:00', '16:30'], ['17:45', '19:00']]
            ];


           echo "<pre>"; print_r($schedules); echo "</pre>"; exit();

            $matching_times = array();


            return response()->json($matching_times);




    }      

}




