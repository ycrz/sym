<?php 
    // how to use include_once 'lib/notification.php';
    if (isset($_SESSION['alertsk'])) {
        if ($_SESSION['alertsk'][0] == '1a') {
            echo "<script type='text/javascript'>
                Swal.fire({ icon: 'error', title: 'perhatian', text: 'Cek kembali username dan password anda.' });
            </script>";
        }else if ($_SESSION['alertsk'][0] == '1b') {
            echo "<script type='text/javascript'>
                Swal.fire({ icon: 'error', title: 'perhatian', text: 'Akun Anda Belum Aktif atau Akun Tidak Terdaftar! Hubungi Admin Anda.' });
            </script>";
        }else if ($_SESSION['alertsk'][0] == '1c') {
            echo "<script type='text/javascript'>
                Swal.fire({ icon: 'error', title: 'perhatian', text: 'Silahkan cek kembali password anda.' });
            </script>";
        }else if ($_SESSION['alertsk'][0] == '1d') {
            echo "<script type='text/javascript'>
                Swal.fire({ icon: 'success', title: 'Hi!', text: 'Selamat Datang :)' });
            </script>";
        }else if ($_SESSION['alertsk'][0] == '1e') {
            echo "<script type='text/javascript'>
                Swal.fire({ icon: 'success', title: 'Sukses!', text: 'Pesan berhasil dikirim' });
            </script>";
        }
        $_SESSION['alertsk'][0] = 'netral';
    }
?>