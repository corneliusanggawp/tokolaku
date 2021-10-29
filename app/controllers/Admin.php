<?php 

class Admin extends Controller {

    public function index()
    {
        if(!isset($_SESSION['AdminLogin'])) {
            header('Location:' . BASEURL . '/admin/login');
            exit;
        }else{
            $data['pageTitle']      = '- Dashboard';
            $data['menuDashboard']  = 'active';
            $data['menuProduct']    = '';
            $data['menuCategory']   = '';
            $data['menuOrder']      = '';
            $data['menuSeller']     = '';
            $data['menuAccount']    = '';
            $data['menuSettings']   = '';
            $data['totalProduct']   = $this->model('ProductModel')->countAllProducts();
            $data['totalCategory']   = $this->model('CategoryModel')->countAllProductCategories();

            $this->view('templates/BackEndHeader', $data);
            $this->view('admin/index', $data);
            $this->view('templates/BackEndFooter');
            exit;
        }
    }

    public function error(){
        $this->view('templates/Error');
    }

    public function login()
    {
        if(isset($_SESSION['AdminLogin'])) {
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            $data['pageTitle'] = '- Login';

            $this->view('templates/BackEndSecondHeader', $data);
            $this->view('admin/login');
            $this->view('templates/BackEndSecondFooter');
            exit;
        }
    }

    public function register()
    {
        if(isset($_SESSION['AdminLogin'])) {
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            $data['pageTitle'] = '- Daftar';

            $this->view('templates/BackEndSecondHeader', $data);
            $this->view('admin/register');
            $this->view('templates/BackEndSecondFooter');
            exit;
        }
    }

    public function categories()
    {
        if(!isset($_SESSION['AdminLogin'])) {
            header('Location:' . BASEURL . '/admin/login');
            exit;
        }else{
            $memberRole = $this->model('MemberModel')->getMemberRole($_SESSION['AdminLogin']['id']);
            $role_id    = $this->model('RoleModel')->getRoleID('Admin');

            if($memberRole != $role_id){
                header('Location:' . BASEURL . '/admin');
                exit;
            }else{
                $data['pageTitle']      = '- Kategori Produk';
                $data['menuDashboard']  = '';
                $data['menuProduct']    = '';
                $data['menuCategory']   = 'active';
                $data['menuOrder']      = '';
                $data['menuSeller']     = '';
                $data['menuAccount']    = '';
                $data['menuSettings']   = '';
                $data['category']   = $this->model('CategoryModel')->getAllProductCategories();
    
                $this->view('templates/BackEndHeader', $data);
                $this->view('admin/categories', $data);
                $this->view('templates/BackEndFooter');
                exit;
            }
        }
    }

    public function product()
    {
        if(!isset($_SESSION['AdminLogin'])) {
            header('Location:' . BASEURL . '/admin/login');
            exit;
        }else{
            $data['pageTitle']      = '- Produk';
            $data['menuDashboard']  = '';
            $data['menuProduct']    = 'active';
            $data['menuCategory']   = '';
            $data['menuOrder']      = '';
            $data['menuSeller']     = '';
            $data['menuAccount']    = '';
            $data['menuSettings']   = '';
            $data['category']       = $this->model('CategoryModel')->getAllProductCategoriesName();
            $data['product']        = $this->model('ProductModel')->getAllProductBySellerID($_SESSION['AdminLogin']['id']);
    
            $this->view('templates/BackEndHeader', $data);
            $this->view('admin/product', $data);
            $this->view('templates/BackEndFooter');
        }
    }
    
    public function authLogin()
    {
        if(!isset($_POST['username']) && !isset($_POST['password'])){
            header('Location:' . BASEURL . '/admin/error');
            exit;
        }else{
            $username = $_POST['username'];
            $password = $_POST['password'];

            $data['user'] = $this->model('MemberModel')->getMemberData($username);

            if($data['user'] > 0){
                $PasswordVerify = password_verify($password, $data['user']['password']);
                if($PasswordVerify){
                    if($data['user']['isVerified'] == 0){
                        SweetAlert::setSweetAlert('Akun Belum Diaktivasi', 'Cek email dan lakukan aktivasi', 'info');
                        header('Location:' . BASEURL . '/admin/login');
                        exit;
                    }else{
                        $_SESSION['AdminLogin'] = $data['user'];
                        SweetAlert::setSweetToast('top-end', '1000', 'success', 'Berhasil login');
                        header('Location:' . BASEURL . '/admin');
                        exit;
                    }
                }else{
                    Flasher::setFlash('danger','Password yang anda masukkan salah');
                    header('Location:' . BASEURL . '/admin/login');
                    exit;
                }
            }else{
                SweetAlert::setSweetAlert('Akun Belum Terdaftar', 'Silahkan registrasi terlebih dahulu', 'warning');
                header('Location:' . BASEURL . '/admin/register');
                exit;
            }
        }
    }

    public function logout()
    {
        if(!isset($_SESSION['AdminLogin'])){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            unset($_SESSION['AdminLogin']);
            SweetAlert::setSweetToast('top-end', '1500', 'success', 'Berhasil logout');
            header('Location:' . BASEURL . '/admin');
            exit;
        }
    }

    public function authRegister()
    {
        if(!isset($_POST['username']) && !isset($_POST['password'])){
            header('Location:' . BASEURL . '/admin/error');
            exit;
        }else{
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
    }

    public function authVerification($username = null, $code = null)
    {
        if($username == null & $code == null){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            $verified = $this->model('MemberModel')->userVerification($username, $code);

            if(!$verified){
                SweetAlert::setSweetAlert('Vertifikasi Gagal', 'Link vertifikasi tidak valid', 'error');
                header('Location:' . BASEURL . '/admin/login');
                exit;  
            }else{
                SweetAlert::setSweetAlert('Vertifikasi Berhasil', 'Silakan login', 'success');
                header('Location:' . BASEURL . '/admin/login');
                exit;
            }
        }
    }

    public function getProductCategory()
    {
        echo json_encode($this->model('CategoryModel')->getProductCategoriesByID($_POST['id']));
    }

    public function addProductCategory()
    {
        if(!isset($_SESSION['AdminLogin'])){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            if(empty($_FILES) && !isset($_POST['name']) && !isset($_POST['description'])){
                header('Location:' . BASEURL . '/admin/error');
                exit;
            }else{
                $memberRole = $this->model('MemberModel')->getMemberRole($_SESSION['AdminLogin']['id']);
                $role_id    = $this->model('RoleModel')->getRoleID('Admin');

                if($memberRole != $role_id){
                    header('Location:' . BASEURL . '/admin/error');
                    exit;
                }else{
                    $name           = $_POST['name'];
                    $description    = $_POST['description'];
                    $image          = FileController::uploadImage($_FILES['upload']);
    
                    if(!$image){
                        SweetAlert::setSweetAlert('Gagal Ditambahkan', 'Upload Gambar Bermasalah', 'error');
                        header('Location:' . BASEURL . '/admin/categories');
                        exit;
                    }else{
                        if($this->model('CategoryModel')->addProductCategory($name, $description, $image) > 0){
                            SweetAlert::setSweetAlert('Berhasil Ditambahkan', 'Kategori baru berhasil di buat', 'success');
                            header('Location:' . BASEURL . '/admin/categories');
                            exit;
                        }else{
                            SweetAlert::setSweetAlert('Gagal Ditambahkan', 'Silakan input ulang', 'error');
                            header('Location:' . BASEURL . '/admin/categories');
                            exit;
                        }
                    }
                }
            }
        }
    }

    public function updateProductCategory()
    {
        if(!isset($_SESSION['AdminLogin'])){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            $memberRole = $this->model('MemberModel')->getMemberRole($_SESSION['AdminLogin']['id']);
            $role_id    = $this->model('RoleModel')->getRoleID('Admin');

            if($memberRole != $role_id){
                header('Location:' . BASEURL . '/admin/error');
                exit;
            }else{
                $id             = $_POST['id'];
                $name           = $_POST['name'];
                $description    = $_POST['description'];
                $oldImage       = $_POST['oldImage'];
        
                if($_FILES['upload']['error'] == 4){
                    $image = $oldImage;
                }else{
                    FileController::deleteImage($oldImage);
                    $image = FileController::uploadImage($_FILES['upload']);
                }

                if($this->model('CategoryModel')->updateProductCategory($id, $name, $description, $image) > 0){
                    SweetAlert::setSweetAlert('Berhasil Mengubah', 'Kategori berhasil diperbarui', 'success');
                    header('Location:' . BASEURL . '/admin/categories');
                    exit;
                }else{
                    header('Location:' . BASEURL . '/admin/categories');
                    exit;
                }
            }
        }
    }

    public function deleteProductCategory($id = null)
    {
        if(!isset($_SESSION['AdminLogin'])){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            if($id == null){
                header('Location:' . BASEURL . '/admin/error');
                exit;
            }else{
                $memberRole = $this->model('MemberModel')->getMemberRole($_SESSION['AdminLogin']['id']);
                $role_id    = $this->model('RoleModel')->getRoleID('Admin');

                if($memberRole != $role_id){
                    header('Location:' . BASEURL . '/admin/error');
                    exit;
                }else{
                    if($this->model('ProductModel')->countProductCategoriesByCategoryID($id) > 0){
                        SweetAlert::setSweetAlert('Gagal Menghapus', 'Kategori masih digunakan di beberapa produk', 'warning');
                        header('Location:' . BASEURL . '/admin/categories');
                        exit;
                    }else{
                        $image = $this->model('CategoryModel')->getImageCategories($id);
                        if($this->model('CategoryModel')->deleteProductCategory($id)){
                            FileController::deleteImage($image);
                            SweetAlert::setSweetAlert('Berhasil Menghapus', 'Kategori berhasil dihapus', 'success');
                            header('Location:' . BASEURL . '/admin/categories');
                            exit;
                        }else{
                            SweetAlert::setSweetAlert('Gagal Menghapus', 'Kategori gagal dihapus', 'error');
                            header('Location:' . BASEURL . '/admin/categories');
                            exit;
                        }
                    }
                }        
            }
        }
    }

    public function getProduct()
    {
        echo json_encode($this->model('ProductModel')->getProductByID($_POST['id']));
    }

    public function addProduct()
    {
        if(!isset($_SESSION['AdminLogin'])){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            if(empty($_FILES) && !isset($_POST['name']) && !isset($_POST['description'])){
                header('Location:' . BASEURL . '/admin/error');
                exit;
            }else{
                $name           = $_POST['name'];
                $category_id    = $_POST['category_id'];
                $image          = FileController::uploadImage($_FILES['upload']);
                $stock          = $_POST['stock'];
                $description    = $_POST['description'];;
                $price          = $_POST['price'];
                $seller_id      = $_SESSION['AdminLogin']['id'];

                if(!$image){
                    SweetAlert::setSweetAlert('Gagal Ditambahkan', 'Upload Gambar Bermasalah', 'error');
                    header('Location:' . BASEURL . '/admin/product');
                    exit;
                }else{
                    if($this->model('ProductModel')->addProduct($name, $category_id, $image, $stock, $description, $price,$seller_id) > 0){
                        SweetAlert::setSweetAlert('Berhasil Ditambahkan', 'Kategori baru berhasil di buat', 'success');
                        header('Location:' . BASEURL . '/admin/product');
                        exit;
                    }else{
                        header('Location:' . BASEURL . '/admin/product');
                        exit;
                    }
                }
            }
        }
    }

    public function updateProduct()
    {
        if(!isset($_SESSION['AdminLogin'])){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            $id             = $_POST['id'];
            $seller_id      = $_SESSION['AdminLogin']['id'];
            $access         = $this->model('ProductModel')->getProductAccessibility($seller_id, $id);

            if(!$access){
                header('Location:' . BASEURL . '/admin/error');
                exit;
            }else{
                $name           = $_POST['name'];
                $category_id    = $_POST['category_id'];
                $stock          = $_POST['stock'];
                $description    = $_POST['description'];;
                $price          = $_POST['price'];
                $oldImage       = $_POST['oldImage'];
        
                if($_FILES['upload']['error'] == 4){
                    $image = $oldImage;
                }else{
                    FileController::deleteImage($oldImage);
                    $image = FileController::uploadImage($_FILES['upload']);
                }

                if($this->model('ProductModel')->updateProduct($id, $name, $category_id, $image, $stock, $description, $price) > 0){
                    SweetAlert::setSweetAlert('Berhasil Mengubah', 'Produk berhasil diperbarui', 'success');
                    header('Location:' . BASEURL . '/admin/product');
                    exit;
                }else{
                    header('Location:' . BASEURL . '/admin/product');
                    exit;
                }
                exit;
            }
        }
    }

    public function deleteProduct($id = null){
        if(!isset($_SESSION['AdminLogin'])){
            header('Location:' . BASEURL . '/admin');
            exit;
        }else{
            if($id == null){
                header('Location:' . BASEURL . '/admin/error');
                exit;
            }else{
                $seller_id      = $_SESSION['AdminLogin']['id'];
                $access         = $this->model('ProductModel')->getProductAccessibility($seller_id, $id);
    
                if(!$access){
                    header('Location:' . BASEURL . '/admin/error');
                    exit;
                }else{
                    $image = $this->model('ProductModel')->getImageProduct($id);
                    if($this->model('ProductModel')->deleteProduct($id)){
                        FileController::deleteImage($image);
                        SweetAlert::setSweetAlert('Berhasil Menghapus', 'Produk berhasil dihapus', 'success');
                        header('Location:' . BASEURL . '/admin/product');
                        exit;
                    }else{
                        SweetAlert::setSweetAlert('Gagal Menghapus', 'Produk gagal dihapus', 'error');
                        header('Location:' . BASEURL . '/admin/product');
                        exit;
                    }
                }        
            }
        }
    }
}