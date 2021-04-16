<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\DeletedCheque;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        return $this->pending();
    }
    public function rejectCheque($id){
        if(Cheque::find($id)){
            $cheque = Cheque::find($id)->update(['status'=>'Rejected']);
        }
        return $this->pending();
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


    public function show($id)
    {
        $cheque = Cheque::find($id)->first();
        return Inertia::render('Payment/Cheque/Cheque-Single',['cheque'=>$cheque]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if( $cheque = Cheque::find($request->input('id'))){
            $prev_FrontImg_Path = $cheque->frontImg;
            $prev_BacktImg_Path = $cheque->backImg;

            File::delete(public_path($prev_FrontImg_Path));
            File::delete(public_path($prev_BacktImg_Path));
        $cheque->update($request->all());
            if($request->hasFile('frontImg') && $request->hasFile('backImg')){
                $frontImg = $request->frontImg;
                $backImg = $request->backImg;
                if(!($frontImg->getClientOriginalName()==null ||$backImg->getClientOriginalName() == null)){

                    $fileName = time().'-Updated-'.$frontImg->getClientOriginalName();
                    $request->frontImg->move(public_path('uploads/cheques'), $fileName);
                    $frontImg = '/uploads/cheques/'.$fileName;
                    $cheque->update(['frontImg'=>$frontImg]);
                    $fileName = time().'-Updated-'.$backImg->getClientOriginalName();
                    $request->backImg->move(public_path('uploads/cheques'), $fileName);
                    $backImg ='/uploads/cheques/'. $fileName;
                    $cheque->update(['backImg'=>$backImg]);
                }
            }


        return redirect()->back()->with('successMsg','Update Success Full');

        }else return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cheque = Cheque::find($id)->first();
        //make triggar before deleting the data
        Cheque::deleting(function ($cheque){

            //add new path for deleted files
        $new_front_img_path = str_replace('/uploads/cheques/','/deleted/cheques/',$cheque->frontImg);
        $new_back_img_path = str_replace('/uploads/cheques/','/deleted/cheques/',$cheque->backImg);

        //move deleted files to deleted directory
        File::move(public_path($cheque->frontImg),public_path($new_front_img_path));
        File::move(public_path($cheque->backImg),public_path($new_back_img_path));

        //store data to deleted cheque table
            DeletedCheque::create( array(
                'chequeNo'=>$cheque->chequeNo,
                'payment_id'=>$cheque->payment_id,
                'agent_id'=>$cheque->agent_id,
                'admin_id'=>$cheque->admin_id,
                'frontImg'=>$new_front_img_path,
                'backImg'=>$new_back_img_path,
                'agent_Note'=>$cheque->agent_Note,
                'created_Date'=>$cheque->created_at,
            ));
        });
        $cheque->delete();
        return $this->pending();
    }
}
