<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profilePicture = null;

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $staff = Staff::create([
            'name' => $request->input('name'),
            'birthday' => $request->input('birthday'),
            'description' => $request->input('description'),
            'profile_picture' => $profilePicture,
        ]);

        return redirect()->route('staff.create')->with('success', 'Staff member created successfully!');
    }

    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    public function createConnection(Anime $anime)
    {
        $anime->load('Anime_Staff.staff');
        $staffMembers = Staff::all();
        return view('staff.create-connection', compact('anime', 'staffMembers'));
    }


    public function storeConnection(Request $request, Anime $anime)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'role' => 'sometimes|required|string',
        ]);

        if (!$anime->Anime_Staff->contains('staff_id', $request->staff_id)) {
            $anime->Anime_Staff()->create($request->all());
            return redirect()->route('anime.show', ['id' => $anime->id])
                ->with('success', 'Staff added to anime successfully.');
        }

        return redirect()->route('anime.show', ['id' => $anime->id])
            ->with('error', 'Staff is already associated with the anime.');
    }



    public function showAll(Anime $anime)
    {
        $anime->load('staff');

        return view('staff.show-all', compact('anime'));
    }
}
