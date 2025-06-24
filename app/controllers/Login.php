<?php

class Login extends Controller
{
    public function index()
    {
        // Jika sudah login, redirect ke halaman sesuai role
        if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                header('Location: ' . BASEURL . '/admin');
                exit;
            } elseif ($_SESSION['role'] == 'dokter') {
                header('Location: ' . BASEURL . '/dokter');
                exit;
            } elseif ($_SESSION['role'] == 'pasien') {
                header('Location: ' . BASEURL . '/home'); // Pasien ke halaman home atau reservasi
                exit;
            }
        }

        $data['title'] = 'Login'; // Judul untuk halaman login
        $this->view('login/index', $data);
        $this->view('templates/footer');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Panggil model untuk memeriksa kredensial
            $user = $this->model('UserModel')->getUserByUsername($username); // Asumsikan ada User_model

            if ($user) {
                // Verifikasi password. Di sini kita menggunakan plain text '123' seperti di SQL dump
                // Untuk produksi, gunakan password_verify($password, $user['password_hash'])
                if ($password === $user['password_hash']) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    // Redirect berdasarkan role
                    if ($user['role'] == 'admin') {
                        header('Location: ' . BASEURL . '/admin');
                        exit;
                    } elseif ($user['role'] == 'dokter') {
                        header('Location: ' . BASEURL . '/dokter');
                        exit;
                    } elseif ($user['role'] == 'pasien') {
                        // Jika pasien, kita juga perlu mendapatkan pasien_id dari tabel pasien
                        // Karena tabel users.user_id adalah foreign key ke pasien.pasien_id
                        $pasienData = $this->model('Pasien')->getPasienByUserId($user['user_id']); // Asumsikan method ini ada di Pasien model
                        if ($pasienData) {
                            $_SESSION['pasien_id'] = $pasienData['pasien_id'];
                        }
                        header('Location: ' . BASEURL . '/home');
                        exit;
                    }
                }
            }
            // Jika login gagal, tampilkan pesan error atau redirect kembali ke login
            // Bisa tambahkan flash message di sini
            header('Location: ' . BASEURL . '/login?error=1');
            exit;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/login');
        exit;
    }
}