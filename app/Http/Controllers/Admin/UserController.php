<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Support\Services\SmsService;

class UserController extends Controller
{
    public function index(User $model)
    {
        return view('admin.user.index', ['users' => $model->withTrashed()->paginate(20)]);
    }

    public function show($user){
        try{
            $user = User::withTrashed()->findOrFail($user);
            return view('admin.user.show', ['user' => $user]);
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.user.index')->with('error', 'Tente Novamente Mais Tarde !');
        }
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    public function editStatus(User $user, Request $request)
    {
        try{
            $user->update($request->all());
            return redirect()->route('admin.user.edit', $user)->with('status', 'Status do Usuário Alterado Com Sucesso !');
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.user.index')->with('error', 'Tente Novamente Mais Tarde !');
        }
    }

    public function resetPassword(User $user)
    {
        try{
            return redirect()->route('admin.user.edit', $user)->with('status', 'Senha de Usuário Resetada Com Sucesso !');
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.user.index')->with('error', 'Tente Novamente Mais Tarde !');
        }
    }

    public function update(User $user, Request $request)
    {
        try{
            $user->update($request->except('_token'));
            return redirect()->route('admin.user.edit', $user)->with('status', 'Usuário Editado Com Sucesso !');
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.user.index')->with('error', 'Tente Novamente Mais Tarde !');
        }
    }

    public function delete(User $user)
    {
        try{
            $user->delete();
            return redirect()->route('admin.user.index', $user)->with('status', 'Usuário Deletado Com Sucesso !');
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.user.index')->with('error', 'Tente Novamente Mais Tarde !');
        }
    }
    public function restore($user)
    {
        try{
            $user = User::withTrashed()->findOrFail($user);
            $user->restore();
            return redirect()->route('admin.user.index', $user)->with('status', 'Usuário Restaurado Com Sucesso !');
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.user.index')->with('error', 'Tente Novamente Mais Tarde !');
        }
    }
}
