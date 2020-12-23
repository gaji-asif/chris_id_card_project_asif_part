<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ErpExpense;
use App\ErpEmployee;

class ErpExpenseController extends Controller
{
    
    //can declare a member variable here. it do not access outside of this class.
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // like member functions
    public function index()
    {
        $user_id = Auth::user()->id;
        $expenses = ErpExpense::where('active_status', '=', 1)->get();
        $employees = ErpEmployee::where('active_status', '=', 1)->get();
        return view('backEnd.expenses.index', compact('expenses', 'employees'));
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
        $request->validate([
            'employee_id'=>'required',
            'amount'=> 'required',
            'expense_date'=> 'required'
        ]);

        $expenses = new ErpExpense();
        $expenses->employee_id = $request->employee_id;
        $expenses->expense_date = date('Y-m-d', strtotime($request->expense_date));
        $expenses->amount = $request->amount;
        $expenses->created_by = Auth::user()->id;
        $results = $expenses->save();

        if($results) {
            return redirect('/expenses')->with('message-success', 'New Expense has been added');
        } else {
            return redirect('/expenses')->with('message-danger', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = ErpExpense::find($id);
        $expenses = ErpExpense::where('active_status', '=', 1)->get();
        $employees = ErpEmployee::where('active_status', '=', 1)->get();
        return view('backEnd.expenses.index', compact('expenses', 'employees', 'editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'=>'required',
            'amount'=> 'required',
            'expense_date'=> 'required'
        ]);

        $expenses = ErpExpense::find($id);
        $expenses->employee_id = $request->employee_id;
        $expenses->expense_date = date('Y-m-d', strtotime($request->expense_date));
        $expenses->amount = $request->amount;
        $expenses->updated_by = Auth::user()->id;
        $results = $expenses->update();

        if($results) {
            return redirect('/expenses')->with('message-success', 'Expenses has been updated');
        } else {
            return redirect('/expenses')->with('message-danger', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
