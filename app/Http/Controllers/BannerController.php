<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\File;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class BannerController extends Controller
{
    public function index(){
        $banner=SpladeTable::for(Banner::class)
            ->column('id')
            ->column('title')
            ->column('image')
            ->column('action');
        return view('banner.index',compact('banner'));
    }

    public function create(){
         $banner= SpladeForm::make()->action(route('dashboard.banner.store'))->method('post')
             ->fields(
               [
                   Input::make('title')->label('banner title')->placeholder('enter banner title')->required(),
                   File::make('image')->label('upload banner images')->filepond(),
                   Submit::make('banner')->label('banner create'),

               ]
             );
         return view('banner.create',compact('banner'));
    }

    public function store(BannerRequest $request){
//        dd($request);
        $banner=Banner::create($request->all());
        $image = $request->file('image')->store('public/bannerPhoto');
        $banner->image = str_replace('public/', '', $image);
        $banner->save();
        Toast::success('banner create');
        return redirect()->route('dashboard.banner.index');

    }

    public function edit($banner){
        $banner=Banner::find($banner);
//        dd($banner);
        $banner= SpladeForm::make()->fill($banner)->action(route('dashboard.banner.update',['banner'=>$banner]))->method('put')
            ->fields(
                [
                    Input::make('title')->label('banner title')->placeholder('enter banner title')->required(),
                    File::make('image')->label('upload banner images')->filepond(),
                    Submit::make('banner')->label('banner update'),

                ]
            );
        return view('banner.create',compact('banner'));
    }

    public function update(Banner $banner,BannerRequest $request){
        $banner->update($request->all());
        $request->hasFile('image') ? $banner->update(['image' => str_replace('public/', '', $request->file('image')->store('public/bannerPhoto'))]) : '';
        $banner->save();
        Toast::success('banner updated');
        return redirect()->route('dashboard.banner.index');
    }

    public function delete(Banner $banner){
        $banner->delete();
        Toast::success('banner deleted');
        return redirect()->back();
    }

    public function duplicate(Banner $banner){
        $newBanner = $banner->replicate();
        $newBanner->save();
        Toast::success('banner duplicate');
        return redirect()->back();
    }
}
