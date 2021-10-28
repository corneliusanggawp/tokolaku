<?php 

class Home extends Controller {
    
    public function index()
    {
        $data['pageTitle']  = '';
        $data['category']   = $this->model('CategoryModel')->getAllProductCategories();
        $data['product']    = $this->model('ProductModel')->getAllProduct(); 
    
        $this->view('templates/FrondEndHeader', $data);
        $this->view('home/index', $data);
        $this->view('templates/FrondEndFooter');
    }

    public function error(){
        $this->view('templates/Error');
    }

    public function login()
    {
        if(isset($_SESSION['HomeLogin'])){
            header('Location:' . BASEURL . '/home');
            exit;
        }else{
            $data['pageTitle'] = '- Login';

            $this->view('templates/FrondEndHeader', $data);
            $this->view('home/login');
            $this->view('templates/FrondEndFooter');
            exit;
        }
    }

    public function register()
    {
        if(isset($_SESSION['HomeLogin'])){
            header('Location:' . BASEURL . '/home');
            exit;
        }else{
            $data['pageTitle'] = '- Register';

            $this->view('templates/FrondEndHeader', $data);
            $this->view('home/register');
            $this->view('templates/FrondEndFooter');
            exit;
        }
    }

    public function profile()
    {
        if(!isset($_SESSION['HomeLogin'])){
            header('Location:' . BASEURL . '/home');
            exit;
        }else{
            $data['pageTitle']  = '- Profile';
            $data['user']       = $this->model('UserModel')->getUserDataByID($_SESSION['HomeLogin']['id']);

            $this->view('templates/FrondEndHeader', $data);
            $this->view('home/profile', $data);
            $this->view('templates/FrondEndFooter');
            exit;
        }
    }
    
    public function authLogin()
    {
        if(!isset($_POST['username']) && !isset($_POST['password'])){
            header('Location:' . BASEURL . '/home/error');
            exit;
        }else{
            $username = $_POST['username'];
            $password = $_POST['password'];

            $data['user'] = $this->model('UserModel')->getUserDataByUsername($username);
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
                        exit;
                    }
                }else{
                    Flasher::setFlash('danger','Password yang anda masukkan salah');
                    header('Location:' . BASEURL . '/home/login');
                    exit;
                }
            }else{
                SweetAlert::setSweetAlert('Akun Belum Terdaftar', 'Silahkan registrasi terlebih dahulu', 'warning');
                header('Location:' . BASEURL . '/home/register');
                exit;
            }            
        }
    }

    public function logout()
    {
        if(!isset($_SESSION['HomeLogin'])){
            header('Location:' . BASEURL . '/home');
            exit;
        }else{
            unset($_SESSION['HomeLogin']);
            SweetAlert::setSweetToast('top-end', '1000', 'success', 'Berhasil logout');
            header('Location:' . BASEURL . '/home');
            exit;
        }
    }

    public function authRegister()
    {
        if(!isset($_POST['username']) && !isset($_POST['password'])){
            header('Location:' . BASEURL . '/home/error');
            exit;
        }else{
            $username       = strtolower(stripslashes($_POST['username']));
            $password       = $_POST['password'];
            $confirmPassword= $_POST['confirmPassword'];

            $UserAvailable = $this->model('UserModel')->getUserDataByUsername($username);

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
    }

    public function authVerification($username = null, $code = null){
        if($username == null & $code == null){
            header('Location:' . BASEURL . '/home');
            exit;
        }else{
            $verified  = $this->model('UserModel')->userVerification($username, $code);

            if(!$verified){
                SweetAlert::setSweetAlert('Vertifikasi Gagal', 'Link vertifikasi tidak valid', 'error');
                header('Location:' . BASEURL . '/home');
                exit;
            }else{
                SweetAlert::setSweetAlert('Vertifikasi Berhasil', 'Silakan login', 'success');
                header('Location:' . BASEURL . '/home/login');
                exit;
            }
        }
    }
    
    public function update_User()
    {
        if(!isset($_SESSION['HomeLogin'])){
            header('Location:' . BASEURL . '/home');
            exit;
        }else{
                $id             = $_SESSION['HomeLogin']['id'];
                $name           = $_POST['name'];
                $username       = $_POST['username'];
                $email          = $_POST['email'];
                $oldImage       = $_POST['oldImage'];
                $gender         = $_POST['gender'];
                $birthDate      = $_POST['birthdate'];
                $phoneNumber    = $_POST['phone'];
                
                if($_FILES['upload']['error'] == 4){
                    $image = $oldImage;
                }else{
                    FileController::deleteImage($oldImage);
                    $image = FileController::uploadImage($_FILES['upload']);
                }

                if($this->model('UserModel')->updateUser($id, $name, $username, $email, $image, $gender, $birthDate, $phoneNumber) > 0){
                    SweetAlert::setSweetAlert('Berhasil Mengubah', 'Profile berhasil diperbarui', 'success');
                    header('Location:' . BASEURL . '/home/profile');
                    exit;
                }else{
                    header('Location:' . BASEURL . '/home/profile');
                    exit;
                }
            
        }
    }

    public function delete_User($id = null)
    {
        if(!isset($_SESSION['HomeLogin'])){
            header('Location:' . BASEURL . '/home');
            exit;
        }else{
            if($id == null){
                header('Location:' . BASEURL . '/home/error');
                exit;
            }else{
                $image = $this->model('UserModel')->getImageUser($id);
                if($this->model('UserModel')->deleteUser($id)){
                    FileController::deleteImage($image);
                    SweetAlert::setSweetAlert('Berhasil Menghapus', 'Profile berhasil dihapus', 'success');
                    header('Location:' . BASEURL . '/home/logout');
                    exit;
                }else{
                    SweetAlert::setSweetAlert('Gagal Menghapus', 'Profile gagal dihapus', 'error');
                    header('Location:' . BASEURL . '/home/profile');
                    exit;
                }  
                        
            }
        }
    }
}