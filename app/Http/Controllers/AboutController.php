<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\File;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Textarea;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class AboutController extends Controller
{
    public function index(){
        $about=SpladeTable::for(About::class)
            ->column('id')
            ->column('title')
            ->column('heading')
            ->column('description')
            ->column('images')
            ->column('action');
        return view('about.index',compact('about'));
    }

    public function create(){
        $about= SpladeForm::make()->action(route('dashboard.about.store'))->method('post')
            ->fields(
                [
                    Input::make('title')->label('about title')->placeholder('enter about title')->required(),
                    Input::make('heading')->label('about heading')->placeholder('enter about heading')->required(),
                    Textarea::make('description')->label('about description')->placeholder('enter about description')->required(),

                    File::make('images')->label('upload about images')->filepond(),
                    Submit::make('about')->label('about create'),

                ]
            );
        return view('about.create',compact('about'));
    }

    public function store(AboutRequest $request){
//        dd($request);
        $about=About::create($request->all());
        $image = $request->file('images')->store('public/aboutPhoto');
        $about->images = str_replace('public/', '', $image);
        $about->save();
        Toast::success('about create');
        return redirect()->route('dashboard.about.index');

    }

    public function edit($about){
        $about=About::find($about);
//        dd($about);
        $about= SpladeForm::make()->fill($about)->action(route('dashboard.about.update',['about'=>$about]))->method('put')
            ->fields(
                [
                    Input::make('title')->label('about title')->placeholder('enter about title')->required(),
                    Input::make('heading')->label('about heading')->placeholder('enter about heading')->required(),
                    Textarea::make('description')->label('about description')->placeholder('enter about description')->required(),

                    File::make('images')->label('upload about images')->filepond(),
                    Submit::make('about')->label('about update'),

                ]
            );
        return view('about.create',compact('about'));
    }

    public function update(About $about,AboutRequest $request){
        $about->update($request->all());
        $request->hasFile('images') ? $about->update(['images' => str_replace('public/', '', $request->file('images')->store('public/aboutPhoto'))]) : '';
        $about->save();
        Toast::success('about updated');
        return redirect()->route('dashboard.about.index');
    }

    public function delete(About $about){
        $about->delete();
        Toast::success('about deleted');
        return redirect()->back();
    }

    public function duplicate(About $about){
        $newAbout = $about->replicate();
        $newAbout->save();
        Toast::success('about duplicate');
        return redirect()->back();
    }
}
