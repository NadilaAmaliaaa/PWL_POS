<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data User</title>
</head>
<body>
    <h1>Form Tambah Data User</h1>
    <form action="/user/tambah_simpan" method="post">

        {{ csrf_field() }}
        
        <label for="">Username</label>
        <input type="text" name="username" placeholder="Masukkan Username"> <br>
        <label for="">Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama"> <br>
        <label for="">Password</label>
        <input type="password" name="password" placeholder="Masukkan Password"> <br>
        <label for="">Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan ID Level"> <br>
        <input type="submit" value="Simpan" class="btn btn-success">

    </form>
</body>
</html>