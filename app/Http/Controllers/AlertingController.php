<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alerting as Model;
use App\Http\Resources\AlertingResource as ModelResource;
use App\Http\Requests\AlertingRequest as ModelRequest;

class AlertingController extends Controller
{
    public $meta = [
        'title' => 'Master data places',
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
                'title' => 'Alerting',
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
        return view('user.alerting.index', [
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
        return view('user.alerting.create', [
            'meta' => $this->meta
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

            return redirect()->route('alerting.index');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot save data, please try again :' . $e->getMessage(),
            ]);

            return redirect()->route('alerting.index');
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
            return view('user.alerting.edit', [
                'meta' => $this->meta,
                'model' => Model::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => $e->getMessage(),
            ]);

            return redirect()->route('alerting.index');
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

            return redirect()->route('alerting.index');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot save data, please try again',
                'subtitle' => $e->getMessage()
            ]);

            return redirect()->route('alerting.index');
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

            return redirect()->route('alerting.index');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot delete, please try again',
                'subtitle' => $e->getMessage()
            ]);

            return redirect()->route('alerting.index');
        }
    }

    public function resolve($id)
    {
        try {
            $alert_type = 'danger';
            $alert_title = 'Cannot resolve alert, please try again';

            if (Model::findOrFail($id)->setModelResolved()) {
                $alert_type = 'success';
                $alert_title = 'Alert resolved successfully';
            }

            session()->flash('general.alert', [
                'type' => $alert_type,
                'title' => $alert_title,
            ]);

            return redirect()->route('alerting.index');
        } catch (\Exception $e) {
            session()->flash('general.alert', [
                'type' => 'danger',
                'title' => 'Cannot resolve alert, please try again',
                'subtitle' => $e->getMessage()
            ]);

            return redirect()->route('alerting.index');
        }
    }
}
