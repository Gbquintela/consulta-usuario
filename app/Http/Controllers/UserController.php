<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public readonly User $user;
    public function __construct()
    {
            $this->user = new  User();
    }




    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function($query, $search) {
            return $query->whereRaw('LOWER(name) = ?', [strtolower($search)])
                ->orWhereRaw('LOWER(cpf) = ?', [strtolower($search)])
                ->orWhereRaw('LOWER(email) = ?', [strtolower($search)]);
        })
            ->paginate(10);

        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_create');
    }

    /**
     * Cria o usuario de acordo com as entidades do banco de dados.
     */
    public function store(Request $request)
    {
        var_dump($request->except(['_token']));
        $created = $this->user->create([
            'name'=> $request->input('name'),
            'cpf'=> $request->input('cpf'),
            'email'=> $request->input('email'),
            'telephone'=> $request->input('telephone'),
            'password'=> $request->input('password')
            ]);

        if($created){
            return redirect()->route('users.index')->with('message','Successfuly registered');
        }
        return redirect()->back()->with('erroMessage','Error on created');

    }

    /**
     Mostra os usuarios cadastrados
     */
    public function show(user $user)
    {
        return view('user_show',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user_edit',['user' =>$user]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->except(['_token', '_method', 'password']);

        // Só atualiza a senha se foi fornecida no formulário
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $updated = $this->user->where('id', $id)->update($data);

        if($updated) {
            return redirect()->route('users.index')->with('message', 'Successfully updated');
        }

        return redirect()->back()->with('errorMessage', 'Error updating');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->user->where('id', $id)->delete();

        return redirect()->route('users.index');
    }
}
