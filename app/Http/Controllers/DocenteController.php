<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\DocenteRequest;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DocenteController extends Controller
{
    /**
     * Muestra el listado de docentes.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $docentes = Docente::with('curso')
            ->where('estado', 'activo')
            ->when($search, fn($query) => $query
                ->where('nombre_docente', 'like', "%{$search}%")
                ->orWhere('apellido_docente', 'like', "%{$search}%")
                ->orWhere('CI_docente', 'like', "%{$search}%"))
            ->paginate(1000);

        return view('docente.index', compact('docentes'))
            ->with('i', ($request->input('page', 1) - 1) * $docentes->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo docente.
     */
    public function create(): View
    {
        $cursos = Curso::all();
        return view('docente.create', ['docente' => new Docente(), 'cursos' => $cursos]);
    }

    /**
     * Guarda un nuevo docente.
     */
    public function store(DocenteRequest $request)
{
    // Crear usuario vinculado al docente
    $user = User::create([
        'name' => $request->nombre_docente . ' ' . $request->apellido_docente,
        'email' => $request->correo_electronico_docente,
        'password' => Hash::make($request->password),
    ]);

    // Crear registro en la tabla docentes
    Docente::create([
        'nombre_docente' => $request->nombre_docente,
        'apellido_docente' => $request->apellido_docente,
        'CI_docente' => $request->CI_docente,
        'telefono_docente' => $request->telefono_docente,
        'correo_electronico_docente' => $request->correo_electronico_docente,
        'fecha_contratacion' => $request->fecha_contratacion,
        'curso_id' => $request->curso_id,
        'user_id' => $user->id,
        'estado' => 'activo',
    ]);

    // Asignar rol (si usas Spatie)
    if (method_exists($user, 'assignRole')) {
        $user->assignRole('docente');
    }

    return redirect()->route('docentes.index')->with('success', 'Docente registrado correctamente.');
}


    /**
     * Muestra la información de un docente específico.
     */
    public function show(Docente $docente): View
    {
        $docente->load('curso');
        return view('docente.show', compact('docente'));
    }

    /**
     * Muestra el formulario para editar un docente existente.
     */
    public function edit(Docente $docente): View
    {
        $cursos = Curso::all();
        return view('docente.edit', compact('docente', 'cursos'));
    }

    /**
     * Actualiza los datos de un docente existente.
     */
    public function update(DocenteRequest $request, Docente $docente): RedirectResponse
    {
        $data = $request->validated();
        $data['telefono_docente'] = $data['telefono_docente'] ?? '';

        $docente->update($data);

        return Redirect::route('docentes.index')->with('success', 'Docente modificado exitosamente.');
    }

    /**
     * Marca un docente como inactivo (eliminación lógica).
     */
    public function destroy(Docente $docente): RedirectResponse
    {
        $docente->update(['estado' => 'inactivo']);
        return Redirect::route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
