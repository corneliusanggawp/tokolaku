<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Pages <span></span> Account
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-details-tab" data-bs-toggle="tab" href="#profile-details" role="tab" aria-controls="profile-details" aria-selected="true"><i class="fi-rs-user mr-10"></i>Profil Saya</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>Alamat Saya</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Pesanan Saya</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= BASEURL; ?>/home/logout"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Hello <?= $data['user']['name'] == null ?  $data['user']['username'] :  $data['user']['username'] ?>!</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Dari halaman dasbor. Anda dapat dengan mudah memeriksa & melihat pesanan terbaru Anda, mengelola alamat pengiriman dan penagihan, serta mengedit detail akun Anda.</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Your Orders</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>No Order</th>
                                                            <th>Tanggal</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>#1357</td>
                                                            <td>21 Oct 2021</td>
                                                            <td>Sedang Diproses</td>
                                                            <td>IDR 125.000,00</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Alamat Pembayaran</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>Jl. Babarsari No.43 Janti,  <br> Caturtunggal, Kec. Depok, <br>  Kabupaten Sleman, <br>Telp : 082171213</address>
                                                    <p>Daerah Istimewa Yogyakarta</p>
                                                    <a href="#" class="btn-small">Ubah</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Alamat Pengiriman</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>Jl. Babarsari No.43 Janti,  <br> Caturtunggal, Kec. Depok, <br>  Kabupaten Sleman, <br>Telp : 082171213</address>
                                                    <p>Daerah Istimewa Yogyakarta</p>
                                                    <a href="#" class="btn-small">Ubah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-details" role="tabpanel" aria-labelledby="profile-details-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Profil Saya</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" name="enq" action="<?= BASEURL; ?>/home/update_User" enctype="multipart/form-data">
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-4">
                                            
                                                        <img src="<?= IMGBASEURL; ?>/<?= $data['user']['image'] == null ? "upload.svg" : $data['user']['image'] ?>" alt="" id="image" name="imageOld">
                                                        <input type="hidden" class="form-control" id="oldImage" name="oldImage" value="<?= $data['user']['image']; ?>">
                                                        <input type="file" class="form-control" id="upload" name="upload" accept="image/png, image/jpg, image/jpeg">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mt-4">
                                                        <label>Nama <span class="required">*</span></label>
                                                        <input value="<?= $data['user']['name'] == null ? "N/A" : $data['user']['name'] ?>" class="form-control square" id="name" name="name" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6 mt-4">
                                                        <label>Username <span class="required">*</span></label>
                                                        <input value="<?= $data['user']['username'] ?>" class="form-control square" id="username" name="username">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Tanggal Lahir <span class="required">*</span></label>
                                                        <input value="<?= $data['user']['birthDate'] ?>" class="form-control square" id="birthdate" name="birthdate" type="date">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Email <span class="required">*</span></label>
                                                        <input value="<?= $data['user']['email']?>" class="form-control square" id="email" name="email" type="email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Gender <span class="required">*</span></label>
                                                        <select class="form-select" id="gender" name="gender" required>
                                                            <?php     
                                                                if(!isset($data['user']['gender'])) {
                                                                    echo "<option selected value=''>Pilih Kategori</option>";
                                                                    echo "<option value='Pria'>Pria</option>";
                                                                    echo "<option value='Wanita'>Wanita</option>";
                                                                } else {
                                                                    $pria = "Pria";
                                                                    $wanita = "Wanita";
                                                                    $gender = $data['user']['gender'];
                                                                    if (strcmp($gender, $pria) == 0) {
                                                                        echo "<option selected value='Pria'>Pria</option>";
                                                                        echo "<option value='Wanita'>Wanita</option>";
                                                                    } else {
                                                                        echo "<option selected value='Wanita'>Wanita</option>";
                                                                        echo "<option value='Pria'>Pria</option>";
                                                                    }   
                                                                }                                                         
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>No Telp <span class="required">*</span></label>
                                                        <input value="<?= $data['user']['phoneNumber'] == null ? "N/A" : $data['user']['phoneNumber'] ?>" class="form-control square" id="phone" name="phone" type="text" required>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row justify-content-md-center">
                                                            <div class="col-3">
                                                                <button type="submit" class="btn form-control" name="update_Profile">Edit</button>
                                                            </div>
                                                            <div class="col-3">
                                                                <a href="<?= BASEURL; ?>/home/delete_User/<?= $_SESSION['HomeLogin']['id']; ?>"><button type="button" class="btn btn-danger form-control bg-white text-danger"> Delete </button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-edit" role="tabpanel" aria-labelledby="profile-edit-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Profile Edit</h5>
                                        </div>
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>