<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Leave;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave = Leave::all();
        return view('admin.leave.index')->with('Leave', $leave);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Leave::create([
            'employee_id'   => $request->employee_id,
            'employee_name'   => $request->employee_name,
            'leave_type'    => $request->leave_type,
            'date_from'     => $request->date_from,
            'date_to'       => $request->date_to,
            'days'          => $request->days,
            'reason'        => $request->reason,
        ]);

        Toastr::success('Leave successfully requested to HR!','Success');

        return redirect()->route('user.leave.index');
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
        //
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
        //
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

    public function approved(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->is_approved = $request->approved;
        $leave->save();
        return redirect()->route('user.leave.index');
    }

    public function reject(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->is_approved = $request->reject;
        $leave->save();
        return redirect()->route('user.leave.index');
    }
}
