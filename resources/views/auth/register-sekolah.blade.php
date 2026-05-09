<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
</head>
<body>
<h1>Form Registrasi</h1>

<form method="POST" action="#">
    @csrf

    <label>Nama Lengkap</label><br>
    <input type="text" name="nama"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Nomor HP</label><br>
    <input type="text" name="no_hp"><br><br>

    <label>Nama Siswa</label><br>
    <input type="text" name="nama_siswa"><br><br>

    <label>NIS</label><br>
    <input type="text" name="nis"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Daftar</button>
</form>
</body>
</html>
