<section class="container mt-5">
    <h1 class="mb-4">Dashboard</h1>
    <div class="mb-4">
        <div class="row">
            <div class="col-sm-12 col-md-3 mb-4">
                <a href="<?= base_url('admin/books') ?>">
                    <div class="p-3 shadow-sm border text-center">
                        <i class="bi bi-book fs-1 text-danger"></i>
                        <div class="text-dark fw-bold">Data Buku</div>
                        <div class="small text-muted"><?= $book_count ?> buku</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-3 mb-4">
                <a href="<?= base_url('admin/transactions') ?>">
                    <div class="p-3 shadow-sm border text-center">
                        <i class="bi bi-cart-check fs-1 text-danger"></i>
                        <div class="text-dark fw-bold">Data Transaksi</div>
                        <div class="small text-muted"><?= $transaction_count ?> transaksi</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-3 mb-4">
                <a href="<?= base_url('admin/payments') ?>">
                    <div class="p-3 shadow-sm border text-center">
                        <i class="bi bi-wallet fs-1 text-danger"></i>
                        <div class="text-dark fw-bold">Metode Pembayaran</div>
                        <div class="small text-muted"><?= $payment_count ?> pembayaran</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-3 mb-4">
                <a href="<?= base_url('admin/cooriers') ?>">
                    <div class="p-3 shadow-sm border text-center">
                        <i class="bi bi-truck fs-1 text-danger"></i>
                        <div class="text-dark fw-bold">Data Kurir</div>
                        <div class="small text-muted"><?= $coorier_count ?> kurir</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div>
        <h4 class="mb-3">Transaksi Dalam Proses</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Pelanggan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    <?php if($orders): foreach($orders as $order): ?>
                    <tr>
                        <td><?= $order['transaction_created'] ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td><?= $order['transaction_status'] ?></td>
                        <td class="text-end">
                            <a href="<?= base_url('admin/transactions/'.$order['transaction_id']) ?>" class="btn btn-sm btn-danger">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            <i>Belum ada transaksi yang menunggu antrian.</i>
                        </td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</section>