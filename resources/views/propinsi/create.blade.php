<!DOCTYPE html>
<html>
<head>
    <title>Tambah Propinsi</title>
</head>
<body>
    <h1>Tambah Propinsi</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/propinsi" method="POST">
        @csrf

        <p>
            <label>ID Propinsi:</label><br>
            <input type="number" name="IdPropinsi" required>
        </p>

        <p>
            <label>Nama Propinsi:</label><br>
            <input type="text" name="Propinsi" required>
        </p>

        <p>
            <label>ID Negara:</label><br>
            <input type="number" name="IdNegara" value="1" required>
        </p>

        <p>
            <label>Sort Order:</label><br>
            <input type="number" name="SortOrder" required>
        </p>

        <button type="submit">Simpan</button>
        <a href="/propinsi">Kembali</a>
    </form>
</body>
</html>