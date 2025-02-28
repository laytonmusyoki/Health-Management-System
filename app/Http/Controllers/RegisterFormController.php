<?php

namespace App\Http\Controllers;

use App\Models\registration;
use App\Models\SubCounty;
use Illuminate\Http\Request;

class RegisterFormController extends Controller
{
    public function registration(){
        return view('staff.registration.index');
    }

    public function find(){
        return view('staff.registration.find');
    }

    public function registrationForm(){
        return view('staff.registration.registrationForm');
    }

    public function registrationFormPost(Request $request){
        $request->validate([
            'idNo'=>'unique:registrations',
            'surName'=>'required',
            'firstName'=>'required',
            'secondName'=>'required',
            'gender'=>'required',
            'dateOfBirth'=>'required',
            'age'=>'required',
            'phoneNumber'=>'required',
            'nextOfKin'=>'required',
            'country'=>'required',
            'county'=>'required',
            'subCounty'=>'required',
            'location'=>'required',
            'occupation'=>'required',
            'maritalStatus'=>'required',
            'education'=>'required',
        ]);

        $registerData = new registration();
        $registerData->idNo = $request->idNo;
        $registerData->surName = $request->surName;
        $registerData->firstName = $request->firstName;
        $registerData->secondName = $request->secondName;
        $registerData->gender = $request->gender;
        $registerData->dateOfBirth = $request->dateOfBirth;
        $registerData->age = $request->age;
        $registerData->phoneNumber = $request->phoneNumber;
        $registerData->nextOfKin = $request->nextOfKin;
        $registerData->country = $request->country;
        $registerData->county = $request->county;
        $registerData->subCounty = $request->subCounty;
        $registerData->location = $request->location;
        $registerData->occupation = $request->occupation;
        $registerData->maritalStatus = $request->maritalStatus;
        $registerData->education = $request->education;
        $registerData->save();
        return redirect(route('find'))->with('success','Patient added successfully');

    }


    public function data($id){
        $subcounties = SubCounty::where('countyId',$id)->get();
        return response(['subcounties'=>$subcounties]);
    }
}
