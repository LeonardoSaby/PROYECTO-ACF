<?php

namespace App\Http\Controllers;

use App\Models\Tutore;
use App\Models\Infante;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TutoreRequest;
use Illuminate\Support\Facades\Redirect;

class TutoreController extends Controller
{
    /**
     * Listado de tutores con búsqueda.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $tutores = Tutore::where('estado', 'activo')
            ->when($search, function ($query, $search) {
                $query->where('nombre_tutor', 'like', "%{$search}%")
                      ->orWhere('apellido_tutor', 'like', "%{$search}%");
            })
            ->paginate(1000);

        return view('tutore.index', compact('tutores'))
            ->with('i', (request()->input('page', 1) - 1) * $tutores->perPage());
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create(): View
    {
        $tutore = new Tutore();
        return view('tutore.create', compact('tutore'));
    }

    /**
     * Guardar tutor y crear usuario asociado.
     */
    public function store(TutoreRequest $request)
    {
        // Crear usuario vinculado
        $user = User::create([
            'name' => $request->nombre_tutor . ' ' . $request->apellido_tutor,
            'email' => $request->correo_electronico_tutor,
            'password' => Hash::make($request->password),
        ]);

        // Crear tutor asociado al usuario
        Tutore::create([
            'nombre_tutor' => $request->nombre_tutor,
            'apellido_tutor' => $request->apellido_tutor,
            'CI_tutor' => $request->CI_tutor,
            'telefono_tutor' => $request->telefono_tutor,
            'correo_electronico_tutor' => $request->correo_electronico_tutor,
            'direccion_tutor' => $request->direccion_tutor,
            'user_id' => $user->id,
            'estado' => 'activo',
        ]);

        // (Opcional) Asignar rol
        if (method_exists($user, 'assignRole')) {
            $user->assignRole('tutor');
        }

        return redirect()->route('tutores.index')->with('success', 'Tutor registrado correctamente.');
    }



    /**
     * Mostrar un tutor con sus datos.
     */
    public function show($tutor_id): View
    {
        $tutore = Tutore::findOrFail($tutor_id);
        return view('tutore.show', compact('tutore'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit($tutor_id): View
    {
        $tutore = Tutore::with('infantes')->findOrFail($tutor_id);
        return view('tutore.edit', compact('tutore'));
    }

    /**
     * Actualizar tutor.
     */
    public function update(TutoreRequest $request, Tutore $tutore): RedirectResponse
    {
        $tutore->update($request->validated());
        return redirect()->route('tutores.index')->with('success', 'Tutor actualizado correctamente.');
    }

    /**
     * Desactivar tutor (soft delete).
     */
    public function destroy($tutor_id): RedirectResponse
    {
        $tutore = Tutore::findOrFail($tutor_id);
        $tutore->update(['estado' => 'inactivo']);

        return redirect()->route('tutores.index')->with('success', 'Tutor eliminado correctamente.');
    }
}
