<?php
require_once 'functions.php';

/** LOGIN */
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$user' AND user='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:index.php?m=login");
}
else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
}

/** periode */
elseif ($mod == 'periode_tambah') {
    $kode_periode = $_POST['kode_periode'];
    $tanggal = $_POST['tanggal'];
    if ($kode_periode == '' || $tanggal == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_periode WHERE kode_periode='$kode_periode'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_periode (kode_periode, tanggal) VALUES ('$kode_periode', '$tanggal')");
        foreach ($_POST['nilai'] as $key => $val) {
            $db->query("INSERT INTO tb_relasi(kode_periode, kode_jenis, nilai) VALUES ('$kode_periode', '$key', '$val')");
        }
        redirect_js("index.php?m=periode");
    }
}
else if ($mod == 'periode_ubah') {
    $tanggal = $_POST['tanggal'];
    if ($tanggal == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_periode SET tanggal='$tanggal' WHERE kode_periode='$_GET[ID]'");
        foreach ($_POST['nilai'] as $key => $val) {
            $db->query("UPDATE tb_relasi SET nilai='$val' WHERE id='$key'");
        }
        redirect_js("index.php?m=periode");
    }
}
else if ($act == 'periode_hapus') {
    $kode_periode = $_GET['ID'];
    $db->query("DELETE FROM tb_periode WHERE kode_periode='$kode_periode'");
    $db->query("DELETE FROM tb_relasi WHERE kode_periode='$kode_periode'");
    header("location:index.php?m=periode");
}

/** KRITERIA */
if ($mod == 'jenis_tambah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];


    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_jenis WHERE kode_jenis='$kode'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_jenis (kode_jenis, nama_jenis) VALUES ('$kode', '$nama')");
        $db->query("INSERT INTO tb_relasi(kode_periode, kode_jenis, nilai) SELECT kode_periode, '$kode', -1  FROM tb_periode");
        redirect_js("index.php?m=jenis");
    }
} else if ($mod == 'jenis_ubah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];


    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_jenis SET nama_jenis='$nama' WHERE kode_jenis='$_GET[ID]'");
        redirect_js("index.php?m=jenis");
    }
}
else if ($act == 'jenis_hapus') {
    $db->query("DELETE FROM tb_jenis WHERE kode_jenis='$_GET[ID]'");
    $db->query("DELETE FROM tb_relasi WHERE kode_jenis='$_GET[ID]'");
    header("location:index.php?m=jenis");
}
