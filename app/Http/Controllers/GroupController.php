<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        //return $request->input["title"];

        $group = Group::create([
            'title' => $request->input['title'],
            'description' => $request->input['description'],
        ]);

        return response()->json($group, 201);
    }

    public function index(){
        $groups = Group::all();

        return response()->json($groups, 200);
    }
}
