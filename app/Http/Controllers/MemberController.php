<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Booking; // Don't forget to import the Booking model
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        //
    }

    public function showAllMembers()
    {
        $members = Member::all();
        return response()->json($members);
    }

    public function showOneMember($id)
    {
        return response()->json(Member::find($id));
    }

    public function showMemberBookings($id)
    {
        $bookings = Booking::where('memberid', $id)->get();
        return response()->json($bookings);
    }

    public function create(Request $request)
    {
        $arr = $request->json()->all();
        $member = new Member();
        $member->forceFill($arr);
        $member->save();
        return response()->json($member, 201);
    }

    public function update($id, Request $request)
    {
        $member = Member::findOrFail($id);
        $member->update($request->all());
        return response()->json($member, 200);
    }

    public function delete($id)
    {
        Member::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
