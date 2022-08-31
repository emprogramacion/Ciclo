<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    - {{ $error }} <br>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('users.store') }}" method="POST">
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                </div>
                                <div class="col-auto">
                                    @csrf <!-- @csrf: Helper de Laravel que indica que el formulario es propio de este proyecto -->
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>&nbsp;</th> <!-- &nbsp; Se usa para colocar un espacio en blanco en la cabecera de la tabla -->
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('users.destroy',$user) }}" method="POST">
                                    @method('DELETE')
                                    @csrf <!-- @csrf: Helper de Laravel que le indica que el formulario es propio de este proyecto -->
                                    <input type="submit" value="Eliminar" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar al usuario: {{$user->name}} ?')">
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay usuarios registrados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>