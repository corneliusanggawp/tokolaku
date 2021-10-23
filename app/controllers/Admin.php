<?php 

class Admin extends Controller {

    public function index()
    {
        $this->view('templates/BackEndHeader');
        $this->view('admin/index');
        $this->view('templates/BackEndFooter');
    }

    public function login()
    {
        $this->view('templates/BackEndSecondHeader');
        $this->view('admin/login');
        $this->view('templates/BackEndSecondFooter');
    }

    public function register()
    {
        $this->view('templates/BackEndSecondHeader');
        $this->view('admin/register');
        $this->view('templates/BackEndSecondFooter');
    }
    
    public function authLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $data['user'] = $this->model('MemberModel')->getMemberData($username);
        $PasswordVerify = password_verify($password, $data['user']['password']);

        if($data['user'] > 0){
            if($PasswordVerify){
                if($data['user']['isVerified'] == 0){
                    SweetAlert::setSweetAlert('Akun Belum Diaktivasi', 'Cek email dan lakukan aktivasi', 'info');
                    header('Location:' . BASEURL . '/admin/login');
                    exit;
                }else{
                    $_SESSION['AdminLogin'] = $data['user'];
                    SweetAlert::setSweetToast('top-end', '1000', 'success', 'Berhasil login');
                    header('Location:' . BASEURL . '/admin');
                }
            }else{
                Flasher::setFlash('danger','Password anda salah');
                header('Location:' . BASEURL . '/admin/login');
            }
        }else{
            SweetAlert::setSweetAlert('Akun Belum Terdaftar', 'Silahkan registrasi terlebih dahulu', 'warning');
            header('Location:' . BASEURL . '/admin/register');
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['AdminLogin']);
        SweetAlert::setSweetToast('top-end', '1500', 'success', 'Berhasil logout');
        header('Location:' . BASEURL . '/admin');
        exit;
    }

    public function authRegister()
    {
        $username       = strtolower(stripslashes($_POST['username']));
        $password       = $_POST['password'];
        $confirmPassword= $_POST['confirmPassword'];

        $UserAvailable = $this->model('MemberModel')->getMemberData($username);

        if($UserAvailable){
            SweetAlert::setSweetAlert('Registrasi Gagal', 'Silahkan registrasi ulang', 'error');
            Flasher::setFlash('danger','Username & email sudah terdaftar!');
            header('Location:' . BASEURL . '/admin/register');
            exit;
        }

        if($password !== $confirmPassword){
            SweetAlert::setSweetAlert('Registrasi Gagal', 'Silahkan registrasi ulang', 'error');
            Flasher::setFlash('danger','Password tidak sama!');
            header('Location:' . BASEURL . '/admin/register');
            exit;
        }

        if($this->model('MemberModel')->addMember($_POST) > 0){
            Mailer::sendMail('admin', $_POST['username'], $_POST['email'],  $this->model('MemberModel')->getVerifCode($username));
            SweetAlert::setSweetAlert('Registrasi Berhasil', 'Cek email dan lakukan vertifikasi akun', 'success');
            header('Location:' . BASEURL . '/admin/login');
            exit;
        }else{
            SweetAlert::setSweetAlert('Registrasi Gagal', 'Silahkan registrasi ulang', 'error');
            header('Location:' . BASEURL . '/admin/register');
            exit;
        }
    }

    public function authVerification($username, $code){
        $verifCode  = $this->model('MemberModel')->getVerifCode($username);

        if($verifCode == $code){
            $this->model('MemberModel')->userVerification($username);
            SweetAlert::setSweetAlert('Vertifikasi Berhasil', 'Silakan login', 'success');
            header('Location:' . BASEURL . '/admin/login');
        }else{
            SweetAlert::setSweetAlert('Vertifikasi Gagal', 'Link vertifikasi tidak valid', 'error');
            header('Location:' . BASEURL . '/admin/login');
        }
    }

}