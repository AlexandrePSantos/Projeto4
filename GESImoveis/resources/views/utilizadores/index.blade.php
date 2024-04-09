<style>
    table {
        border-collapse: collapse;
    }

    td, th {
        border: 1px solid black;
        padding: 5px;
    }
</style>

<a href="{{ route('utilizadores.create') }}" class="btn btn-primary">Criar Utilizador</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telemovél</th>
            <th>Titulo</th>
            <th>Localidade</th>
            <th>Código Postal</th>
            <th>Cidade</th>
            <th>Pais</th>
            <th>NIF</th>
            <th>Foto</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($utilizadores as $user)
            @if($user->id != Auth::id())
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telemovel }}</td>
                    <td>{{ $user->titulo }}</td>
                    <td>{{ $user->morada }}</td>
                    <td>{{ $user->codigo_postal }}</td>
                    <td>{{ $user->cidade }}</td>
                    <td>{{ $user->pais }}</td>
                    <td>{{ $user->nif }}</td>
                    <td><img src="{{ $user->foto }}" alt="User photo"></td>
                    <td>{{ $user->estado }}</td>
                    <td>
                        @if($user->estado == 'ativo')
                            <form action="{{ route('utilizadores.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Inativar" class="btn btn-danger">
                            </form>
                            <a href="{{ route('utilizadores.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
