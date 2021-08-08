<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlaceRegistration as Model;
use App\Http\Resources\PlaceRegistrationResource as ModelResource;
use App\Http\Requests\PlaceRegistrationRequest as ModelRequest;

class PlaceRegistrationController extends Controller
{
    public $meta = [
        'title' => 'Place registration',
        'breadcrumbs' => [
            [
                'link' => '#',
                'icon' => 'fas fa-home'
            ],
            [
                'link' => '#',
                'title' => 'User',
            ],
            [
                'link' => '#',
                'title' => 'Place registration',
                'icon' => null
            ]
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.place_registration.index', [
            'models' => Model::getModel($request->all()),
            'meta' => $this->meta
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.place_registration.create', [
            'meta' => $this->meta,
            'form_options' => [
                'place_registration_types' => \App\Models\PlaceRegistrationType::all()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelRequest $request, Model $model)
    {
        try {
            $alert_type = 'danger';
            $alert_title = 'Cannot save data, please try again';

            if ($model->saveModel($request->all())) {
                $alert_type = 'success';
                $alert_title = 'Data saved successfully';
            }

            session()->flash('general.alert', [
                'type' => $alert_type,
                'title' => $alert_title,
            ]);

            return redirect()->route('place_registration.index');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot save data, please try again',
            ]);

            return redirect()->route('place_registration.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return view('user.place_registration.edit', [
                'meta' => $this->meta,
                'model' => Model::findOrFail($id),
                'form_options' => [
                    'place_registration_types' => \App\Models\PlaceRegistrationType::all()
                ]
            ]);
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => $e->getMessage(),
            ]);

            return redirect()->route('place-registration.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelRequest $request, $id)
    {
        try {
            $alert_type = 'danger';
            $alert_title = 'Cannot save data, please try again';

            $model = Model::findOrFail($id);

            if ($model->saveModel($request->all(), true)) {
                $alert_type = 'success';
                $alert_title = 'Data saved successfully';
            }

            session()->flash('general.alert', [
                'type' => $alert_type,
                'title' => $alert_title,
            ]);

            return redirect()->route('place-registration.index');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot save data, please try again',
                'subtitle' => $e->getMessage()
            ]);

            return redirect()->route('place-registration.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $alert_type = 'danger';
            $alert_title = 'Cannot delete, please try again';

            if (Model::findOrFail($id)->delete()) {
                $alert_type = 'success';
                $alert_title = 'Data deleted successfully';
            }

            session()->flash('general.alert', [
                'type' => $alert_type,
                'title' => $alert_title,
            ]);

            return redirect()->route('place-registration.index');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot delete, please try again',
                'subtitle' => $e->getMessage()
            ]);

            return redirect()->route('place-registration.index');
        }
    }
}