<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Plantilla;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class plantillaController extends Controller
{
    public function index()
    {
        if (! Gate::allows('plantilla_access')) {
            return abort(401);
        }
                $plantillas = Plantilla::all();

        return view('admin.plantillas.index', compact('plantillas'));
    }

    public function create()
    {
        if (! Gate::allows('plantilla_create')) {
            return abort(401);
        }
        return view('admin.plantillas.create');
    }

    public function store(Request $request)
    {
       // dd($request);
        if (! Gate::allows('plantilla_create')) {
            return abort(401);
        }
        $role = Plantilla::create($request->all());

        return redirect()->route('plantillasMenu');
    }

    public function edit($id)
    {
      //  dd($id);
        if (! Gate::allows('plantilla_edit')) {
            return abort(401);
        }
        $plantilla = Plantilla::findOrFail($id);
//dd($plantilla);
        return view('admin.plantillas.edit', compact('plantilla'));
    }

    public function update(Request $request, $id)
    {
      // dd($request);
        if (! Gate::allows('plantilla_edit')) {
            return abort(401);
        }
        $plantilla = Plantilla::findOrFail($id);
        $plantilla->update($request->all());



        return redirect()->route('plantillasMenu');
    }

}
