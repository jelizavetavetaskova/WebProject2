<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MemberController extends Controller
{
    public function list(): View
    {
        $items = Member::orderBy('name', 'asc')->get();
 
        return view(
            'member.list',
            [
                'title' => 'Dalībnieki',
                'items' => $items,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'member.form',
            [
                'title' => 'Pievienot dalībnieku',
                'member' => new Member()
            ]
        );
    }

    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
 
        $member = new Member();
        $member->name = $validatedData['name'];
        $member->save();
 
        return redirect('/members');
    }

    public function update(Member $member): View
    {
        return view(
            'member.form',
            [
                'title' => 'Rediģēt dalībnieku',
                'member' => $member
            ]
        );
    }

        // update existing Author data
        public function patch(Member $member, Request $request): RedirectResponse
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);
    
            $member->name = $validatedData['name'];
            $member->save();
    
            return redirect('/members');
        }

        public function delete(Member $member): RedirectResponse
        {
            // šeit derētu pārbaude, kas neļauj dzēst autoru, ja tas piesaistīts eksistējošām grāmatām
            $member->delete();
            return redirect('/members');
        }
}
