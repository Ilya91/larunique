<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesEditController extends Controller
{
    public function execute(Page $page, Request $request ){
        if(view()->exists('admin.pages_edit')){
            if($request->isMethod('post')){
                $data = $request->except('_token');

                if($request->hasFile('images')){
                    $old_file = $page->images;
                    $file = $request->file('images');
                    $data['images'] = $file->getClientOriginalName();
                    $file->move(public_path().'/assets/img',$data['images']);

                    Storage::disk('my')->delete($old_file);

                }
                $page->fill($data);
                if($page->update()){
                    return redirect()->back()->with('status', 'Страница обновлена успешно!');
                }
            }

            if($request->isMethod('delete')){
                $page->delete();
                return redirect()->back()->with('status', 'Страница удалена успешно!');
            }

            $old = $page->toArray();
            $data = [
                'title' => 'Edit page',
                'page' => $old
            ];
            return view('admin.pages_edit', $data);
        }
        abort(404);
    }
}
