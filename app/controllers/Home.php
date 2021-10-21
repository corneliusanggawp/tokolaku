<?php 

class Home extends Controller {
    
    public function index()
    {
        $this->view('templates/FrondEndHeader');
        $this->view('home/index');
        $this->view('templates/FrondEndFooter');
    }
    
    public function login()
    {
        $this->view('templates/FrondEndHeader');
        $this->view('home/login');
        $this->view('templates/FrondEndFooter');
    }

    public function register()
    {
        $this->view('templates/FrondEndHeader');
        $this->view('home/register');
        $this->view('templates/FrondEndFooter');
    }

    public function authLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data['user'] = $this->model('UserModel')->findUser($username);
        $PasswordVerify = password_verify($password, $data['user']['password']);

        if($data['user'] > 0){
            if($PasswordVerify){
                if($data['user']['is_verified'] == 0){
                    SweetAlert::setSweetAlert('Akun Belum Diaktivasi', 'Cek email dan lakukan aktivasi', 'info');
                    header('Location:' . BASEURL . '/home/login');
                    exit;
                }else{
                    $_SESSION['Login'] = $data['user'];
                    SweetAlert::setSweetToast('top-end', '1500', 'success', 'Berhasil login');
                    header('Location:' . BASEURL . '/home');
                }
            }else{
                Flasher::setFlash('danger','Password anda salah');
                header('Location:' . BASEURL . '/home/login');
            }
        }else{
            SweetAlert::setSweetAlert('Akun Belum Terdaftar', 'Silahkan registrasi terlebih dahulu', 'warning');
            header('Location:' . BASEURL . '/home/register');
            exit;
        }
    }

    public function authRegister()
    {       
        $username       = strtolower(stripslashes($_POST['username']));
        $password       = $_POST['password'];
        $confirmPassword= $_POST['confirmPassword'];

        $UserAvailable = $this->model('UserModel')->findUser($username);

        if($UserAvailable){
            SweetAlert::setSweetAlert('Registrasi Gagal', 'Silahkan registrasi ulang', 'error');
            Flasher::setFlash('danger','Username & email sudah terdaftar!');
            header('Location:' . BASEURL . '/home/register');
            exit;
        }

        if($password !== $confirmPassword){
            SweetAlert::setSweetAlert('Registrasi Gagal', 'Silahkan registrasi ulang', 'error');
            Flasher::setFlash('danger','Password tidak sama!');
            header('Location:' . BASEURL . '/home/register');
            exit;
        }

        if($this->model('UserModel')->addUser($_POST) > 0){
            SweetAlert::setSweetAlert('Registrasi Berhasil', 'Cek email dan lakukan vertifikasi sebelum login', 'success');
            header('Location:' . BASEURL . '/home/login');
            exit;
        }else{
            SweetAlert::setSweetAlert('Registrasi Gagal', 'Silahkan registrasi ulang', 'error');
            header('Location:' . BASEURL . '/home/register');
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['Login']);
        SweetAlert::setSweetToast('top-end', '1500', 'success', 'Berhasil logout');
        header('Location:' . BASEURL . '/home');
        exit;
    }
}