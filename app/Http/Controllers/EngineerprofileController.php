<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EngineerProfile;

class EngineerProfileController extends Controller
{
    public function index()
    {
        return EngineerProfile::all();
    
    }

    public function show($id)
    {
        return EngineerProfile::findOrFail($id);
    }

    public function store(Request $request)
    {
        //   انشاء ريكوست  كلاس ووضع  الفالديشن  بداخله 
        //    الفالديشن  يتم  في الريكوست  كلاس 
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:engineer_profiles,user_id',
            'specialization' => 'required',
        ]);

        return EngineerProfile::create($data);
    }

    public function update(Request $request, $id)
    {
        $engineer = EngineerProfile::findOrFail($id);

        $engineer->update($request->all());

        return $engineer;
    }

    public function destroy($id)
    {
        EngineerProfile::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
}