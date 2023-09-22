<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassworkRequest;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassworkController extends Controller
{

    protected function getType(Request $request){
        $type = $request->query('type');
        $allowed_types = [Classwork::TYPE_ASSIGNMENT,Classwork::TYPE_MATERIAL,Classwork::TYPE_QUESTION ];
        if(! in_array($type,$allowed_types)){
            $type = Classwork::TYPE_ASSIGNMENT;
        }
        return $type;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom , Classwork $classwork)
    {
        
        
    
        return view('classrooms.show', compact('classroom', 'classwork'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Classroom $classroom)
    {
        $type = $this->getType($request);
        $classwork = new Classwork();
        return view('classworks.create', compact('classroom', 'type', 'classwork'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassworkRequest $request, Classroom $classroom)
    {
       
        $type = $this->getType($request);
        $request->merge(['type' =>$type]);
        DB::begintransaction();
        try{

            $classwork = $classroom->classworks()->create($request->all());
            $classwork->users()->attach($request->input('students'));
            DB::commit();
            return redirect()->route('classrooms.show', $classroom->id)->with('success','Classwork Created Succssfully!');
        }catch(QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error','Failed To Add Classwork!');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classwork $classwork)
    {
        $classroom = $classwork->classroom;
        return view('classworks.show',compact('classroom','classwork'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request ,Classwork $classwork)
    {

        $classroom = $classwork->classroom;
        $type = $this->getType($request);
        $assigned = $classwork->users()->pluck('id')->toArray();
        
        return view('classworks.edit', compact('classroom', 'type', 'classwork', 'assigned'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassworkRequest $request, Classwork $classwork)
    {
        
        $classwork->update($request->all());
        $classwork->users()->sync($request->input('students'));
        return back()->with('success', 'Classwrok Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classwork $classwork)
    {
        //
    }
}
