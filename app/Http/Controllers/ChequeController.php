<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cheques = Cheque::all();
        return Inertia::render('Payment/Cheque/Cheque-All',['cheques'=>$cheques]);
    }

    public function pending(){
        $cheques = Cheque::where('status','Pending')->get();
        return Inertia::render('Payment/Cheque/Cheque-Pending',['cheques'=>$cheques]);
    }
    public function approveCheque($id){
        if(Cheque::find($id)){
            $cheque = Cheque::find($id)->update(['status'=>'Approved']);
        }
        return redirect()->route('cheque.pending');
    }
    public function rejectCheque($id){
        if(Cheque::find($id)){
            $cheque = Cheque::find($id)->update(['status'=>'Rejected']);
        }
        return redirect()->route('cheque.pending');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Payment/Cheque/Cheque-Upload',[]);
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
           'frontImg'=>'required|mimes:jpeg,png,bmp,tiff |max:5120',
           'backImg'=>'required|mimes:jpeg,png,bmp,tiff |max:5120',
           'payment_id'=>'required|integer|min:0',
           'chequeNo'=>'required|integer|min:0',
           'remark'=>'nullable|max:255',
           'agent_Note'=>'nullable|max:255',
           'agent_id'=>'required',
           'chequeDate'=>'required|date',
       ]);

        $cheque =new Cheque();

        $cheque->payment_id = $request->payment_id;
        $cheque->chequeNo = $request->chequeNo;
        $cheque->remark = $request->remark;
        $cheque->agent_Note = $request->agent_Note;
        $cheque->agent_id = $request->agent_id;
        $cheque->chequeDate = $request->chequeDate;

            //soring Image
            if($request->hasFile('frontImg') && $request->hasFile('backImg')){
                $fronImg = $request->frontImg;
                $backImg = $request->backImg;
                if(!($fronImg->getClientOriginalName()==null ||$backImg->getClientOriginalName() == null)){


                    $fileName = time().'-'.$fronImg->getClientOriginalName();

                    $request->frontImg->move(public_path('uploads/cheques'), $fileName);
                    $cheque->frontImg = '/uploads/cheques/'.$fileName;
                    $fileName = time().'-'.$backImg->getClientOriginalName();
                    $request->backImg->move(public_path('uploads/cheques'), $fileName);
                    $cheque->backImg ='/uploads/cheques/'. $fileName;

                }
            }
        $cheque->save();
            return redirect()->route('cheque.create')->with(['message'=>'Cheque Uploaded successfully!']);

    }


    public function show(Request $request)
    {
        //$cheque = Cheque::where('id',$id)->get();
        return Inertia::render('Payment/Cheque/Cheque-Single',['cheque'=>$request]);
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
}
