<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Http\Requests\StoreGuest;
use App\Services\Guests\GuestsService;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GuestsService $service)
    {
        $guests = $service->getRepository()->getGuestList();

        return view('backend.index')->with('guests', $guests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CommonHelper $helper)
    {
        $genders = $helper->genderList();

        return view('backend.create')->with('genders', $genders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuest $request, GuestsService $service)
    {
        $create = $service->getRepository()->createGuest($request->all());
        
        if($create) {
            if($request->ajax()) {
                return response('success', 200);
            }

            return redirect()->back()->with('success', 'Successfully created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, GuestsService $service, CommonHelper $helper)
    {
        $genders = $helper->genderList();

        $guest = $service->getRepository()->getGuest($id);

        if($request->ajax()) {
            return $guest;
        }

        return view('backend.edit')->with('genders', $genders)->with('guest', $guest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGuest $request, $id, GuestsService $service)
    {
        $update = $service->getRepository()->updateGuest($id, $request->all());

        if($update) {
            if($request->ajax()) {
                return response('success', 200);
            } 

            return redirect()->back()->with('success', 'Successfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, GuestsService $service)
    {
        $delete = $service->getRepository()->deleteGuest($id);

        if($delete) {
            if($request->ajax()) {
                return response('success', 200);
            }

            return redirect()->back()->with('success', 'Successfully deleted!');
        }
    }

    /**
     * Show frontend vue
     *
     * @return void
     */
    public function frontendIndex()
    {
        return View('frontend.index');
    }

    public function guestList(GuestsService $service)
    {
        return $service->getRepository()->getGuestList();
    }

    /**
     * Get gender list
     *
     * @param CommonHelper $helper
     *
     * @return void
     */
    public function genderList(CommonHelper $helper)
    {
        return json_encode($helper->genderList());
    }
}
