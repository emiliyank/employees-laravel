<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = \Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['sometimes', 'file', 'image', 'mimes:jpeg,png,gif,webp,ico', 'max:4000'],
        ]);

        $user = \Auth::user();

        if(request()->avatar){
            $oldAvatar = 'storage/' . $user->avatar;
            if (File::exists($oldAvatar)) {
                File::delete($oldAvatar);
            }

            $filename = request()->file('avatar')->store('avatars');

            $validated['avatar'] = $filename;
        }

        $user->update($validated);

        return redirect('/edit-profile')->with('msg_update', 'Profile successfully updated!');
    }
}
