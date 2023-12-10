<section class="container mt-5 mb-1" id="order-view" data-clear="<?= $this->input->get('order') ? '1' : '0' ?>">
    <h1 class="mb-3">Detail Transaksi</h1>
    
    <div class="border p-4 mb-5">
        <div class="mb-3">
            <label for="" class="form-label">Kode transaksi</label>
            <input type="text" class="form-control" value="<?= $order['transaction_code'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" class="form-control" value="<?= $order['transaction_status'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Pengiriman</label>
            <div class="border p-3 bg-light rounded">
                <div class="fw-bold"><?= $order['kurir_name'] ?></div>
                <div><?= $order['transaction_address'] ?></div>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Waktu order</label>
            <input type="text" class="form-control" value="<?= date('d F Y, H:i', strtotime($order['transaction_created'])) ?> WIB" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">buku yang dibeli</label>
            <?php foreach($order['details'] as $detail): ?>
            <div class="mb-2 border p-3 d-flex">
                <div>
                    <img src="<?= $detail['book_image'] ?>" style="height: 50px; width: 50px; object-fit: cover;">
                </div>
                <div class="flex-fill ms-3">
                    <div><?= $detail['book_title'] ?></div>
                    <div class="small text-muted">
                        <span><?= $detail['detail_qty'] ?></span>
                        <span>x</span>
                        <span><?= rupiah($detail['detail_price']) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <h1>Detail Pembayaran</h1>
    <div class="border p-4 mb-5">
        <div class="mb-3">
            <label for="" class="form-label">Total order</label>
            <input type="text" class="form-control" value="<?= rupiah($order['transaction_total']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Ongkos kirim</label>
            <input type="text" class="form-control" value="<?= rupiah($order['transaction_ship']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Total bayar</label>
            <input type="text" class="form-control" value="<?= rupiah($order['transaction_total']+$order['transaction_ship']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Metode pembayaran</label>
            <div class="border p-3 bg-light rounded">
                <div class="fw-bold"><?= $order['payment_bank'] ?></div>
                <div><?= $order['payment_an'] ?></div>
                <div><?= $order['payment_rekening'] ?></div>
            </div>
        </div>
    </div>
</section>