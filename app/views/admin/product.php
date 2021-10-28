<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Produk</h2>
        </div>
        <div>
            <a href="#" class="btn btn-light rounded font-md">Export</a>
            <a href="#" class="btn btn-light rounded  font-md">Import</a>
            <a href="#" class="btn btn-primary btn-sm rounded btnAddProduct" data-bs-toggle="modal" data-bs-target="#modalFormProduct">Tambah</a>
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <div class="col-lg-4 col-md-6 me-auto">
                    <input type="text" placeholder="Search..." class="form-control">
                </div>
                <div class="col-lg-2 col-6 col-md-3">
                    <select class="form-select">
                        <option>Semua Kategori</option>
                        <?php foreach( $data['category'] as $category ) : ?>
                            <option><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </header>
        <div class="card-body">
            <div class="row gx-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5">
                <?php foreach( $data['product'] as $product ) : ?>
                    <div class="col">
                        <div class="card card-product-grid">
                            <a href="#" class="img-wrap"> <img src="<?= IMGBASEURL; ?>/<?= $product['image'] ?>" alt="<?= $product['name'] ?>"> </a>
                            <div class="info-wrap text-center">
                                <a href="#" class="title text-truncate"><?= $product['name'] ?></a>
                                <div class="price mb-2"><?= Formatter::rupiah($product['price']) ?></div>
                                <a class="btn btn-sm font-sm btn-brand rounded btnUpdateProduct" data-id="<?= $product['id']; ?>" data-bs-toggle="modal" data-bs-target="#modalFormProduct"> Ubah </a>
                                <a href="<?= BASEURL; ?>/admin/deleteProduct/<?= $product['id']; ?>" class="btn btn-sm font-sm btn-outline-danger rounded"> Hapus </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="pagination-area mt-30 mb-50">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                <li class="page-item"><a class="page-link" href="#">02</a></li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">16</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li>
            </ul>
        </nav>
    </div>
    <div class="modal fade" id="modalFormProduct" tabindex="-1" aria-labelledby="modalFormProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormProductLabel">Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="hidden" class="form-control" id="id" name="id" value="">
                                        <label class="form-label">Produk</label>
                                        <input type="text" placeholder="Nama Produk" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            <option selected disabled value="">Pilih Kategori</option>
                                            <?php foreach( $data['category'] as $category ) : ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Stok</label>
                                        <input type="number" placeholder="Stok Produk" class="form-control" id="stock" name="stock" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Harga</label>
                                    <input type="number" placeholder="Harga Produk" class="form-control" id="price" name="price" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea placeholder="Deskrisi kategori..." class="form-control" id="description" name="description" required></textarea>
                                    </div>
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