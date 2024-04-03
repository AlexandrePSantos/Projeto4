<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Title</th>
            <th>Address</th>
            <th>Postal Code</th>
            <th>City</th>
            <th>Country</th>
            <th>NIF</th>
            <th>Photo</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($utilizadores as $user)
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
            </tr>
        @endforeach
    </tbody>
</table>
