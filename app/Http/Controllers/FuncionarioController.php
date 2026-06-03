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
}