<?php 

class Home extends Controller {
    
    public function index()
    {
        $data['judul'] = '';

        $this->view('templates/FrondEndHeader', $data);
        $this->view('home/index');
        $this->view('templates/FrondEndFooter');
    }

    public function test()
    {
        $this->view('testing');
    }
    
    public function login()
    {
        $data['judul'] = '- Login';

        $this->view('templates/FrondEndHeader', $data);
        $this->view('home/login');
        $this->view('templates/FrondEndFooter');
    }

    public function register()
    {
        $data['judul'] = '- Register';

        $this->view('templates/FrondEndHeader', $data);
        $this->view('home/register');
        $this->view('templates/FrondEndFooter');
    }

    public function profile()
    {
        $data['judul'] = '- Profile';

        $this->view('templates/FrondEndHeader', $data);
        $this->view('home/profile');
        $this->view('templates/FrondEndFooter');
    }

    public function authLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data['user'] = $this->model('UserModel')->getUserData($username);
        $PasswordVerify = password_verify($password, $data['user']['password']);

        if($data['user'] > 0){
            if($PasswordVerify){
                if($data['user']['isVerified'] == 0){
                    SweetAlert::setSweetAlert('Akun Belum Diaktivasi', 'Cek email dan lakukan aktivasi', 'info');
                    header('Location:' . BASEURL . '/home/login');
                    exit;
                }else{
                    $_SESSION['HomeLogin'] = $data['user'];
                    SweetAlert::setSweetToast('top-end', '1000', 'success', 'Berhasil login');
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

    public function logout()
    {
        unset($_SESSION['HomeLogin']);
        SweetAlert::setSweetToast('top-end', '1000', 'success', 'Berhasil logout');
        header('Location:' . BASEURL . '/home');
        exit;
    }

    public function authRegister()
    {       
        $username       = strtolower(stripslashes($_POST['username']));
        $password       = $_POST['password'];
        $confirmPassword= $_POST['confirmPassword'];

        $UserAvailable = $this->model('UserModel')->getUserData($username);

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
            Mailer::sendMail('home', $_POST['username'], $_POST['email'],  $this->model('UserModel')->getVerifCode($username));
            SweetAlert::setSweetAlert('Registrasi Berhasil', 'Cek email dan lakukan vertifikasi akun', 'success');
            header('Location:' . BASEURL . '/home/login');
            exit;
        }else{
            SweetAlert::setSweetAlert('Registrasi Gagal', 'Silahkan registrasi ulang', 'error');
            header('Location:' . BASEURL . '/home/register');
            exit;
        }
    }

    public function authVerification($username, $code){
        $verifCode  = $this->model('UserModel')->getVerifCode($username);

        if($verifCode == $code){
            $this->model('UserModel')->userVerification($username);
            SweetAlert::setSweetAlert('Vertifikasi Berhasil', 'Silakan login', 'success');
            header('Location:' . BASEURL . '/home/login');
        }else{
            SweetAlert::setSweetAlert('Vertifikasi Gagal', 'Link vertifikasi tidak valid', 'error');
            header('Location:' . BASEURL . '/home');
        }
    }

}