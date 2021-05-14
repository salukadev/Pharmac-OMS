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
            Cheque::find($id)->update(['status'=>'Approved']);
        }
        return redirect()->route('cheques-pending')->with('successMessage','Cheque Approved');
    }
    public function rejectCheque($id){
        if(Cheque::find($id)){
            Cheque::find($id)->update(['status'=>'Rejected']);
        }
        return redirect()->route('cheques-pending')->with('successMessage','Cheque Rejected');
    }

    public function create()
    {
        return Inertia::render('Payment/Cheque/Cheque-Upload',[]);
    }


    public function store(Request $request)
    {

        //validation
       $request->validate([
           'frontImg'=>'required|mimes:jpeg,png,bmp,tiff |max:5120',
           'backImg'=>'required|mimes:jpeg,png,bmp,tiff |max:5120',
           'payment_id'=>'required|integer|min:0',
           'chequeNo'=>'required|unique:cheques|integer|min:0,',
           'remark'=>'nullable|max:255',
           'agent_Note'=>'nullable|max:255',
           'agent_id'=>'required',
           'chequeDate'=>'required|date',
       ]);


        //create Cheque object
        $cheque =new Cheque();

        //store values to object
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

                    $fileName = uniqid().'-'.$fronImg->getClientOriginalName();

                    $request->frontImg->move(public_path('uploads/cheques'), $fileName);
                    $cheque->frontImg = '/uploads/cheques/'.$fileName;
                    $fileName = uniqid().'-'.$backImg->getClientOriginalName();
                    $request->backImg->move(public_path('uploads/cheques'), $fileName);
                    $cheque->backImg ='/uploads/cheques/'. $fileName;

                }
            }

            //save object in database
        $cheque->save();
            return redirect()->route('cheques-pending')->with('successMessage','Successfully Uploaded!');

    }


    public function show($id)
    {
        $cheque = Cheque::where('id',$id)->first();
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
        $prev_details = Cheque::where('id',$request->input('id'))->first();
        $pren_front_img = $prev_details->frontImg;
        $pren_back_img = $prev_details->backImg;
        $request->validate([
            //check whether image has change or not
            'frontImg'=> $request->frontImg == null ?'':'required|mimes:jpeg,png,bmp,tiff |max:5120',
            'backImg'=> $request->backImg == null ?'':'required|mimes:jpeg,png,bmp,tiff |max:5120',

            'payment_id'=>'required|integer|min:0',
            'remark'=>'nullable|max:255',

            //check whether Cheque Number was changed or Not
            'chequeNo' =>strcmp($prev_details->chequeNo,$request->chequeNo)  == 0 ?'' : 'required|unique:cheques|integer|min:0',
            //'chequeNo' => $request->chequeNo == $prev_details->chequeNo ? '':'required|unique:cheques|integer|min:0',

            'agent_Note'=>'nullable|max:255',
            'admin_Note'=>'required|max:255',
            'agent_id'=>'required',
            'chequeDate'=>'required|date',
        ]);


        //updating front image
       if ($request->hasFile('frontImg') && !($request->frontImg->getClientOriginalName()==null)){
           $frontImg = $request->frontImg;
            File::delete(public_path($pren_front_img));
            $fileName = 'Updated-'.uniqid().$frontImg->getClientOriginalName();
           $frontImg->move(public_path('uploads/cheques'), $fileName);
           $frontImg_with_path = '/uploads/cheques/'.$fileName;
          $prev_details->update(['frontImg'=>$frontImg_with_path]);
        }

       //updating back image
        if ($request->hasFile('backImg') && !($request->backImg->getClientOriginalName()==null)){
            $backImg = $request->backImg;
            File::delete(public_path($pren_back_img));
            $fileName = 'Updated-'.uniqid().$backImg->getClientOriginalName();
            $backImg->move(public_path('uploads/cheques'), $fileName);
            $backImg_with_path = '/uploads/cheques/'.$fileName;
            $prev_details->update(['backImg'=>$backImg_with_path]);
        }
        //updating
        $prev_details->update([
            'chequeNo'=>$request->chequeNo,
            'payment_id'=>$request->payment_id,
            'admin_id'=>$request->admin_id,
            'admin_Note'=>$request->admin_Note,
            'chequeDate'=>$request->chequeDate,
        ]);

        return redirect()->back()->with('successMessage','Successfully Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'admin_Note'=>'required|max:255',
        ]);
        //store cheque data before deleting

        $cheque =Cheque::where('id',$request->input('id'))->first();
        $cheque->admin_Note = $request->admin_Note;
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
                'admin_Note'=>$cheque->admin_Note,
                'created_Date'=>$cheque->created_at,
            ));
        });
        //deleting the cheque data
        $cheque->delete();
        return $this->pending(); //redirect to the pending cheque Table
    }
}
