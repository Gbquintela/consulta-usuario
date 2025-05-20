@extends('master')

@section('content')
    <div class="container">
        <div class="card search-card mb-4">
            <div class="card-header search-header py-3">
                <h5 class="m-0 search-title"><i class="fas fa-users me-2"></i>Consulta de Usuários</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control form-control-lg"
                               placeholder="Digite um nome, CPF ou e-mail para buscar..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="fas fa-search me-1"></i> Buscar
                        </button>
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg btn-action ms-2">
                            <i class="fas fa-user-plus me-1"></i> Cadastrar
                        </a>
                        <a href="{{ route('users.index') }}?show_all=true" class="btn btn-info btn-lg btn-action ms-2">
                            <i class="fas fa-list me-1"></i> Ver Todos
                        </a>
                    </div>
                </form>

                @if(request()->has('search') || request()->get('show_all') === 'true')
                    <!-- Botão Voltar - Só aparece quando a tabela está visível -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Voltar
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Senha</th>
                                <th class="text-end">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->cpf }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->telephone }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td class="text-end action-buttons">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline ms-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Nenhum usuário encontrado
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($users->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                @else
                    <div class="alert alert-info text-center py-4">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h4>Realize uma busca ou clique em "Ver Todos" para exibir os usuários</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
