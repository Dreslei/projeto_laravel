@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Usuários') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($users))  {{-- Caso não encontre nenhum usuário --}}
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updateUserModal{{ $user->id }}">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">Excluir</button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="updateUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateUserModalLabel{{ $user->id }}">Atualizar Usuário</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ url('/colaboradores/'.$user->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="name">Nome:</label>
                                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">E-mail:</label>
                                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" id="atualizar_colaborador" class="btn btn-primary">Atualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@section('scripts')
<script src="{{ asset('js/colaboradores.js') }}"></script>
{{-- A função asset() é uma função do Laravel que gera uma URL completa para um arquivo localizado em sua pasta public --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- <script>
    function deleteUser(id, name) {
        Swal.fire({
            title: 'Tem certeza?',
            text: `Você está prestes a excluir o usuário ${name}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/users/${id}`)
                    .then(() => {
                        Swal.fire(
                            'Excluído!',
                            'O usuário foi excluído com sucesso.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    })
                    .catch(() => {
                        Swal.fire(
                            'Erro!',
                            'Não foi possível excluir o usuário.',
                            'error'
                        );
                    });
            }
        });
    }
</script> --}}
@endsection
