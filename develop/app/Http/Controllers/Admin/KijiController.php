<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

class KijiController extends Controller
{
    public function add()
    {
        return view('admin.kiji.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Content::$rules);
        $contents = new Content;
        $form = $request->all();
        
        unset($form['_token']);
        
        $contents->fill($form);
        $contents->save();
        
        return redirect('admin.kiji.create');
    }
}


