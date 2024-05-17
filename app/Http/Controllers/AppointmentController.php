<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutRequest;
use App\Http\Requests\AppointmentRequest;
use App\Mail\AppointmentCreated;
use App\Models\About;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\File;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Textarea;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class AppointmentController extends Controller
{
public function index(){
    $appointment=SpladeTable::for(Appointment::class)
        ->column('id')
        ->column('service')
        ->column('doctor')
        ->column('name')
        ->column('email')
        ->column('number')
        ->column('date')
        ->column('time')
        ->column('action');
    return view('appointment.index',compact('appointment'));
}



    public function store(AppointmentRequest $request){
//        dd($request);
        $appointment = Appointment::create($request->all());
       if($appointment){
           Mail::to($request->email)->send(new AppointmentCreated($appointment));
       }
        Toast::success('New appointment create');
        return redirect()->route('dashboard.appointment.index');

    }

//    public function edit($about){
//        $about=About::find($about);
////        dd($about);
//        $about= SpladeForm::make()->fill($about)->action(route('dashboard.about.update',['about'=>$about]))->method('put')
//            ->fields(
//                [
//                    Input::make('title')->label('about title')->placeholder('enter about title')->required(),
//                    Input::make('heading')->label('about heading')->placeholder('enter about heading')->required(),
//                    Textarea::make('description')->label('about description')->placeholder('enter about description')->required(),
//
//                    File::make('images')->label('upload about images')->filepond(),
//                    Submit::make('about')->label('about update'),
//
//                ]
//            );
//        return view('about.create',compact('about'));
//    }

//    public function update(About $about,AboutRequest $request){
//        $about->update($request->all());
//        $request->hasFile('images') ? $about->update(['images' => str_replace('public/', '', $request->file('images')->store('public/aboutPhoto'))]) : '';
//        $about->save();
//        Toast::success('about updated');
//        return redirect()->route('dashboard.about.index');
//    }

    public function delete(Appointment $appointment){
        $appointment->delete();
        Toast::success('Appointment deleted');
        return redirect()->back();
    }

    public function duplicate(Appointment $appointment){
        $appointmentNew = $appointment->replicate();
        $appointmentNew->save();
        Toast::success('Appointment duplicate');
        return redirect()->back();
    }
}
