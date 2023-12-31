<div class="container" style="margin-top: 140px; margin-bottom: 50px;">

<div class="container pt-3 pb-5">
    <h1><?= $category["category_title"]?></h1><br>
    <div class="row">
        <div class="col-md"></div>
        <div class="col-md-3">
            <form action="<?= current_url() ?>" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Disini.." value="<?= $this->input->get("search") ?>" name="search">
                    <button type="submit" class="btn btn-outline-danger">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <?php if($this->input->get("search")): ?>
    <div class="mb-4">
        <span>Hasil pencarian untuk:</span>
        <span class="text-danger"><?= $this->input->get("search") ?></span>
        <a href="<?= current_url() ?>" class="text-danger"><i class="bi bi-x-circle"></i></a>
    </div>
    <?php endif ?>
    <div class="row">
        <?php foreach ($books as $book) : ?>
        <div class="col-sm-12 col-md-3 mb-5">
            <div class="card h-100">
                <img src="<?= $book['book_image']?>" class="card-img-top book-image" alt="...">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark"><?=$book['book_title'] ?></h5>
                    <p class="card-text text-dark max-line-3 small"><?= substr($book['book_desc'], 0, 100) ?>...</p>
                    <div class="mt-auto">
                        <p class="text-danger">Rp<?= number_format($book['book_price'],0) ?></p>
                        <a href="<?= base_url('book/desc/'.$book['book_slug']) ?>" class="btn btn-danger w-100">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?= $this->pagination->create_links(); ?>
</div>