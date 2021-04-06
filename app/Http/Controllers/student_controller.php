<?php

namespace App\Http\Controllers;

use App\student;
use Illuminate\Http\Request;
use App\Imports\student_Import;
use Excel;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Auth\Events\Validated;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\ExcelServiceProvider;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class student_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flag = false;
        $students = DB::table('students')->get();

        
        $country_list = DB::table('countries')
        ->select('name','id')
        ->orderBy('name')
        // ->groupBy('name')
        ->get();

        // return view('index')->with('country_list',$country_list);

        return view('students/index', compact('students', 'country_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "aditya";
        

        $validateData=$request->validate([
            'name'=>'required|min:3|max:15',
            'age'=>'required|min:2|max:3',
            'street'=>'required|min:5|max:20',
            'email'=> 'required|email',
            'country'=> 'required',
            'state'=> 'required',
            'city'=> 'required',
            'hobby'=> 'required',
            'gender'=> 'required',
        ]);

        $hobby=$request->input('hobby');
        $hobby1 =implode(",",$hobby);
        
            $student = new student;

            $student->name = $request->input('name');
            $student->age = $request->input('age');
            $student->street = $request->input('street');
            $student->email = $request->input('email');
            $student->country = $request->input('country');
            $student->state = $request->input('state');
            $student->city = $request->input('city');
            $student->gender=$request->input('gender');
            $student->hobby=$hobby1;
            $student->save();

            return "success";
            // return redirect('students/index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $id;
        
        $id=$request->input('hidden');
        // return $id;
        $validateData=$request->validate([
            'name'=>'required|min:3|max:15',
            'age'=>'required|min:2|max:3',
            'street'=>'required|min:5|max:20',
            'email'=> 'required|email',
            'country'=> 'required',
            'state'=> 'required',
            'gender'=> 'required',
            'hobby'=> 'required',
        ]);
        $hobby=$request->input('hobby');
        $hobby1 =implode(",",$hobby);

        

        $students = student::find($id);

        $students->name = $request->input('name');
        $students->age = $request->input('age');
        $students->street = $request->input('street');
        $students->email = $request->input('email');
        $students->country = $request->input('country');
        $students->state = $request->input('state');
        $students->city = $request->input('city');
        $students->gender=$request->input('gender');
        $students->hobby=$hobby1;
       

        $students->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = student::find($id);
        $student->delete();
        return $student;
    }

    public function importForm()
    {

        return view('students/form');
    }


    public function import(Request $request)
    {

        Excel::import(new student_Import, $request->file);
        return redirect('/');
    }
    public function getData()
    {
        $students = DB::table('students AS A')
        ->select('A.id','B.name AS country_name','C.name AS state_name','d.name AS city_name','A.name AS name','A.age AS age','A.street AS street','A.email AS email','B.id AS country_id','C.id AS state_id','D.id AS city_id','A.gender as gender','A.hobby as hobby')
        ->leftjoin('countries AS B', 'A.country', '=', 'B.id')
        ->join('states AS C', 'A.state', '=', 'C.id')
        ->join('cities AS d', 'A.city', '=', 'd.id')
        
        ->get();
        // return "success";
        // $data = DB::table('students AS A')
        // ->select('A.id AS id','B.name AS country_name','C.name AS state_name','d.name AS city_name')
        // ->leftjoin('countries AS B', 'A.country', '=', 'B.id')
        // ->join('states AS C', 'A.state', '=', 'C.id')
        // ->join('cities AS d', 'A.city', '=', 'd.id')
        // ->get();

        // print_r($students); die();

        $output = array("data" => array());
        foreach ($students as $row) {
            $output['data'][] = $row;
        }

        echo json_encode($output);
    }



    function getState($countryID){

        // return "here";
        $state = DB::table('states')
            ->select('name','id')
            ->where('country_id','=',$countryID)
            ->orderBy('name')
            ->get();
            // $state = DB::table('states')
            // ->select('states.name')
            // ->rightJoin('countries', $countryID, '=', 'country_id')
            // ->where('id','=','countries.id')
            // ->get();
            return $state;
    }

    function getCity($stateID)
    {

        // return "here";
        $city = DB::table('cities')
            ->select('name','id')
            ->where('state_id','=',$stateID)
            ->orderBy('name')
            // ->groupBy('name')
            ->get();
            
            return $city;
    }





}
