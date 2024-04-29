<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Events\GroupCreated;

class GroupController extends Controller
{
    //

    public function index(){
        return view('group.index');
    }

    // 

    public function store()
    {
        $group = Group::create(['name' => request('name')]);
    
        $users = collect(request('users'));
        $users->push(auth()->user()->id);
    
        $group->users()->attach($users);
    
        broadcast(new GroupCreated($group))->toOthers();
    
        return $group;
    }


}
