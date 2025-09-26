<?php
// =================================================================
// PRAKTIKUM 1: APLIKASI PENDAFTARAN EVENT
// =================================================================

// KONSEP: CONSTANT
// Constant digunakan untuk nilai yang tidak akan pernah berubah.
define('NAMA_EVENT', 'Belajar PHP 2025');
define('FILE_PENDAFTARAN', 'pendaftar.txt');

// KONSEP: GLOBAL VARIABLE
// Variabel ini akan digunakan untuk menampilkan pesan status ke pengguna.
// $status_message = '';
// $error_empty = '';
$errors = [
    'empty' => '',
    'email' => '',
    'tanggalLahir' => ''    
];


// KONSEP: FUNGSI & REGEX
// Fungsi untuk memvalidasi format email menggunakan Regular Expression.
function validateEmail($email) {
    // Pola regex untuk email
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email);
}

// Fungsi untuk memvalidasi format tanggal DD-MM-YYYY menggunakan Regular Expression.
function validateDate($date) {
    // Pola regex untuk tanggal DD-MM-YYYY
    $pattern = '/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(19[0-9]{2}|20[0-9]{2})$/';
    return preg_match($pattern, $date);
}

function isDuplicateEmail($email) {
    if (!file_exists(FILE_PENDAFTARAN)) {
        return false;
    }

    $pendaftar = file(FILE_PENDAFTARAN, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($pendaftar as $data) {
        list($nama, $savedEmail, $tanggal) = explode(';', $data);
        if (trim(strtolower($savedEmail)) === strtolower($email)) {
            return true; 
        }
    }
    return false;
}

// KONSEP: FORM (POST) HANDLING
// Cek apakah request yang datang adalah POST (artinya form telah disubmit).
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // KONSEP: VARIABLE
    // Mengambil data dari form dan membersihkannya dari tag HTML berbahaya.
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);

    // Validasi input
    if (empty($nama) || empty($email) || empty($tanggal_lahir)) {
        $errors['empty'] = "Semua field wajib diisi.";
    }
    if (!validateEmail($email)) {
        $errors['email'] = "Format email tidak valid.";
    } elseif (isDuplicateEmail($email)) {
        $errors['email'] = "Email sudah terdaftar, silakan gunakan email lain.";
    }
    if (!validateDate($tanggal_lahir)) {
        $errors['tanggalLahir'] = "Format tanggal lahir harus DD-MM-YYYY.";
    }

    // Jika tidak ada error, simpan data
    if (empty($errors['empty']) && empty($errors['email']) && empty($errors['tanggalLahir'])) {
        // KONSEP: SIMPAN KE FILE TXT
        // Format data yang akan disimpan (dipisahkan oleh semicolon)
        $data_pendaftar = "{$nama};{$email};{$tanggal_lahir}\n";

        // Menyimpan data ke file pendaftar.txt.
        // FILE_APPEND memastikan data baru ditambahkan di akhir file, bukan menimpa.
        file_put_contents(FILE_PENDAFTARAN, $data_pendaftar, FILE_APPEND);

        // Mengatur pesan sukses
        $status_message = "Terima kasih, {$nama}! Pendaftaran Anda untuk event " . NAMA_EVENT . " berhasil.";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Event Digital</title>
    <style>
        body { 
            font-family: sans-serif; 
            /* max-width: 800px;  */
            /* margin-left: auto;  */
            padding: 20px; 
        }
        .container {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card {
            border: 1px solid;
            padding: 25px;
            margin-right: 50px;
            flex: 1;
            min-width: 300px;
            border-radius: 10px;
            background-color: white;
            box-shadow:  0 2px 6px rgba(0,0,0,0.1);
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        label { 
            display: block; margin-bottom: 5px; 
        }
        input[type="text"] { 
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box;
            border-radius: 5px;
        }
        button { 
            padding: 10px 15px; 
            background-color: #007bff; 
            color: white; 
            font-weight: 700;
            font-size: 15px;
            border: none; 
            cursor: pointer;
            border-radius: 10px; 
        }
        .error { 
            color: red; 
            font-size: 0.9em; 
            font-weight: 600;
        }
        .success { 
            color: green; 
            font-weight: bold; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Form Pendaftaran Event "Belajar PHP 2025"</h1>
            <p>Silakan isi data diri Anda untuk mendaftar pada event kami.</p>

            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Lengkap:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Alamat Email:</label>
                    <input type="text" id="email" name="email" required>
                     <?php if (!empty($errors['email'])): ?>
                        <p class="error"><?php echo $errors['email']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir (DD-MM-YYYY):</label>
                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" required>
                     <?php if (!empty($errors['tanggalLahir'])): ?>
                        <p class="error"><?php echo $errors['tanggalLahir']; ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit">Daftar Sekarang</button>
                <?php if (!empty($status_message)): ?>
                    <p class="success"><?php echo $status_message; ?></p>
                <?php endif; ?>
            </form>

            <hr>
        </div>
        <div class="card">
            <h2>Daftar Peserta yang Sudah Mendaftar</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Cek apakah file pendaftar.txt ada
                    if (file_exists(FILE_PENDAFTARAN)) {
                        // Membaca isi file baris per baris ke dalam array
                        $pendaftar = file(FILE_PENDAFTARAN, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                        // Melakukan loop untuk setiap baris data
                        foreach ($pendaftar as $data) {
                            // Memecah baris data berdasarkan pemisah semicolon
                            list($nama, $email, $tanggal_lahir) = explode(';', $data);
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($nama) . "</td>";
                            echo "<td>" . htmlspecialchars($email) . "</td>";
                            echo "<td>" . htmlspecialchars($tanggal_lahir) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Belum ada pendaftar.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
