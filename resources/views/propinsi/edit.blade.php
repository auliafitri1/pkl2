<!DOCTYPE html>
<html>
<head>
    <title>Edit Propinsi</title>
</head>
<body>
    <h1>Edit Propinsi</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/propinsi/{{ $propinsi->IdPropinsi }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>ID Propinsi:</label><br>
            <input type="number" name="IdPropinsi" value="{{ $propinsi->IdPropinsi }}" required>
        </p>

        <p>
            <label>Nama Propinsi:</label><br>
            <input type="text" name="Propinsi" value="{{ $propinsi->Propinsi }}" required>
        </p>

        <p>
            <label>ID Negara:</label><br>
            <input type="number" name="IdNegara" value="{{ $propinsi->IdNegara }}" required>
        </p>

        <p>
            <label>Sort Order:</label><br>
            <input type="number" name="SortOrder" value="{{ $propinsi->SortOrder }}" required>
        </p>

        <button type="submit">Update</button>
        <a href="/propinsi">Kembali</a>
    </form>
</body>
</html>