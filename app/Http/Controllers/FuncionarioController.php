<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('cargo')) {
            $query->where('cargo', $request->cargo);
        }

        $funcionarios = $query->latest()->get();

        $totalFuncionarios = User::count();
        $totalAdmins = User::where('cargo', 'admin')->count();
        $totalGerentes = User::where('cargo', 'gerente')->count();
        $totalOperadores = User::where('cargo', 'operador')->count();

        if ($request->wantsJson()) {
            $funcionarios->transform(function($funcionario) {
                $funcionario->data_formatada = $funcionario->created_at->format('d/m/Y');
                $funcionario->cargo_formatado = ucfirst($funcionario->cargo);
                $funcionario->status_texto = $funcionario->ativo ? 'Ativo' : 'Inativo';
                $funcionario->status_classe = $funcionario->ativo ? 'entregue' : 'cancelado';
                return $funcionario;
            });
            return response()->json($funcionarios);
        }

        return view('admin.funcionarios.index', compact(
            'funcionarios',
            'totalFuncionarios',
            'totalAdmins',
            'totalGerentes',
            'totalOperadores'
        ));
    }

    public function create()
    {
        return view('admin.funcionarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'cargo' => 'required|in:admin,gerente,operador',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('funcionarios', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'cargo' => $request->cargo,
            'ativo' => true,
            'foto' => $fotoPath,
        ]);

        return redirect('/admin/funcionarios')->with('success', 'Funcionário cadastrado com sucesso!');
    }
}