<section class="content-main">
<div class="content-header">
        <div>
            <h2 class="content-title card-title">Kategori Produk</h2>
        </div>
        <div>
            <button type="button" class="btn btn-primary btnAddCategories" data-bs-toggle="modal" data-bs-target="#modalFormCategory">Tambah</button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $data['category'] as $data ) : ?>
                                <tr>
                                    <td class="align-middle text-center"><img class="img-sm img-thumbnail" src="<?= IMGBASEURL; ?>/<?= $data['image']; ?>"></td>
                                    <td class="align-middle"><b><?= $data['name']; ?></b></td>
                                    <td class="align-middle"><?= $data['description']; ?></td>
                                    <td class="align-middle"><?= $data['jumlahProduk'] == null ? "0" : $data['jumlahProduk']; ?></td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                            <div class="dropdown-menu">
                                                <a href="<?= BASEURL; ?>/admin/updateProductCategory/<?= $data['id']; ?>" class="dropdown-item btnUpdateCategories" data-id="<?= $data['id']; ?>" data-bs-toggle="modal" data-bs-target="#modalFormCategory">Ubah</a>
                                                <a href="<?= BASEURL; ?>/admin/deleteProductCategory/<?= $data['id']; ?>" class="dropdown-item text-danger deleteBtn">Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFormCategory" tabindex="-1" aria-labelledby="modalFormCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormCategoryLabel">Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding-bottom:8%">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-lg-4" style="width:300px; height:300px;">
                                <div class="mb-4">
                                    <img src="" alt="" id="image" name="image">
                                    <input type="hidden" class="form-control" id="oldImage" name="oldImage" value="">
                                    <input type="file" class="form-control" id="upload" name="upload" accept="image/png, image/jpg, image/jpeg">
                                    <div class="text-center mt-5">
                                        <label class="form-label">Ukuran Gambar Maksimal 50 MB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="mb-4">
                                    <input type="hidden" class="form-control" id="id" name="id" value="">
                                    <label for="product_name" class="form-label">Nama</label>
                                    <input type="text" placeholder="Nama Kategori" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea placeholder="Deskrisi kategori..." class="form-control" id="description" name="description" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Button Label</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>