<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('cpf', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }

        $clientes = $query->latest()->get();

        $trintaDiasAtras = Carbon::now()->subDays(30);
        
        $totalClientes = Cliente::count();
        $novosClientes = Cliente::where('created_at', '>=', $trintaDiasAtras)->count();
        $clientesMasculino = Cliente::where('sexo', 'masculino')->count();
        $clientesFeminino = Cliente::where('sexo', 'feminino')->count();

        if ($request->wantsJson()) {
            $clientes->transform(function($cliente) {
                $cliente->data_formatada = $cliente->created_at->format('d/m/Y');
                $cliente->sexo_formatado = ucfirst(str_replace('_', ' ', $cliente->sexo));
                $cliente->cpf_formatado = $cliente->cpf ?? 'Não informado';
                $cliente->telefone_formatado = $cliente->telefone ?? 'Não informado';
                return $cliente;
            });
            return response()->json($clientes);
        }

        return view('admin.clientes.index', compact(
            'clientes',
            'totalClientes',
            'novosClientes',
            'clientesMasculino',
            'clientesFeminino'
        ));
    }
}