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
                                            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
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
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
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
                                            <div class="row justify-content-md-center">
                                                <div class="col-md-4">
                                                    <img src="<?= IMGBASEURL ?>/<?= $data['user']['image'] == null ? "upload.svg" : $data['user']['image'] ?>" alt="" id="image" name="image">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label><b>Nama</b></label>
                                                    <p><?= $data['user']['name'] == null ? "-" : $data['user']['name'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label><b>Username</b></label>
                                                    <p><?= $data['user']['username'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label><b>Tanggal Lahir</b></label>                
                                                    <p><?= $data['user']['birthDate'] == null ? "-" : date("j F Y", strtotime($data['user']['birthDate'])) ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label><b>Email</b></label>
                                                    <p><?= $data['user']['email']?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label><b>Gender</b></label>
                                                    <p><?= $data['user']['gender'] == null ? "-" : $data['user']['gender'] ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label><b>No Telp</b></label>
                                                    <p><?= $data['user']['phoneNumber'] == null ? "-" : $data['user']['phone_number'] ?></p>
                                                </div>
                                                <div class="col-md-12">
                                                    <button class="btn btn-fill-out submit"><i class="fi-rs-edit mr-10"></i>Ubah Profil Diri</button>
                                                </div>
                                            </div>
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