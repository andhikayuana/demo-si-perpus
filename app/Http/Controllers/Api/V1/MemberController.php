<?php

namespace App\Http\Controllers\Api\V1;

use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MemberStoreRequest;
use App\Http\Requests\MemberUpdateRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }
        return $query->orderByDesc('id')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MemberStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberStoreRequest $request)
    {
        return Member::create($request->only([
            'name', 'address', 'phone'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Member::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MemberUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberUpdateRequest $request, $id)
    {
        $member = Member::findOrFail($id);

        if ($request->has('name')) {
            $member->name = $request->name;
        }

        if ($request->has('address')) {
            $member->address = $request->address;
        }

        if ($request->has('phone')) {
            $member->phone = $request->phone;
        }

        $member->save();

        return $member;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return response()->json([
            'message' => 'success delete the data'
        ], 200);
    }
}
