<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;


class AdminController extends Controller
{
    public function addview(){
        return view('admin.add_doctor');
    }

    public function upload(Request $request){
        $doctor = new Doctor;
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;
        $doctor->save();

        if($request->hasFile('image')){
            $imageName = time().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,file_get_contents($request->file('image')->getRealPath()));
            $doctor->image = $imageName;
            $doctor->save();
        }

        return redirect()->back()->with('message','Doctor Added Succesfully');
    }

    public function showappointment(){
        $appoint = Appointment::all();
        return view('admin.showappointment',compact('appoint'));
    }

    public function approved($id){
        $data = Appointment::find($id);
        $data->status = 'Approved';
        $data->save();
        return redirect()->back();
    }

    public function canceled($id){
        $data = Appointment::find($id);
        $data->status = 'Canceled';
        $data->save();
        return redirect()->back();
    }

    public function showdoctor(){
        $doctors = doctor::all();
        return view('admin.showdoctor',compact('doctors'));
    }

    public function deletedoctor($id){
        Doctor::destroy($id);
        return redirect()->back();
    }

    public function editdoctor($id){
        $doctors = Doctor::find($id);
        return view('admin.editdoctor',compact('doctors'));
    }

    public function updatedoctor(Request $request,$id){
        $doctor = Doctor::find($id);

        if($request->hasFile('image')){
            $imageName = time().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,file_get_contents($request->file('image')->getRealPath()));
            $doctor->image = $imageName;
            $doctor->save();
        }

        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;

        $doctor->save();
        return redirect()->back()->with('message','Doctor Details updated successfully!');

    }

    public function emailview($id){
        $appoint = Appointment::find($id);
        return view('admin.email_view',compact('appoint'));
    }

    public function sendemail($id,Request $request){
        $data = Appointment::find($id);
        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionurl' => $request->actionurl,
            'endpart' => $request->endpart

        ];
        
        Notification::send($data,new SendEmailNotification($details));

        return redirect()->back();
    }
}
