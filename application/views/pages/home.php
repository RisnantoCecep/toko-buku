<div class="container pt-3 pb-5 mt-2" id="about">
    <h2 class="mb-1">About Us</h2>
    <img class="mb-3 rounded-2" width="100%" src="<?= base_url('assets/img/img-about.jpg')?>" alt="">
    <h2 class="fw-bold">Situs BuLite!</h2>
    <p>Butuh penjelasan soal berbagai fitur di BuLite!? cari tahu disini.</p>
    <div class="accordion mt-5" id="accordionExample">
      <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
              Tentang T.BuLite
            </button>
          </h2>
        <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body small">
            T.BuLite adalah toko buku online yang di buat oleh mahasiswa sistem informasi, untuk memenuhi nilai pada matakuliah webprograming. dengan dibuatnya web ini di harapkan tiap individu terutama mahasiswa/i bisa membudayakan membaca dan terciptanya pemahaman yang fasih pada bidang yang digelutinya, bukan hanya sekedar tahu. <br> <br>
            Misi kami adalah meningkatkan literasi dan memberikan kemudahan akses pada dunia pengetahuan di seluruh indonesia dengan memanfaatkan teknologi 
          </div>
        </div>
      </div>

      <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
              Dimana Bisa Menghubungi Customer Service?
            </button>
          </h2>
        <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Perlu bantuan? Hubungi kami di: <br><br>
            <div class="small">
              Chat: Buka situs T.BuLite, Dan klik Contact admin pada menu navbar <br>
              email:customercare@tbulite.com
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="true" aria-controls="collapse-3">
              Dimana aku bisa menyapa BuLite! di media sosial?
            </button>
          </h2>
        <div id="collapse-3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body small">
            Kami ada di <a href="#">instagram</a>
          </div>
        </div>
      </div>
      
      
    </div>
</div>

<div class="container pt-5 pb-5">
  <h2>Buku Terbaru</h2><br>
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
</div>

<section id="teams" class="chefs section-bg">
  <div class="container aos-init aos-animate" data-aos="fade-up">

    <div class="section-header">
      <h2 class="fw-bold">Teams</h2>
      <p>Bersama <span>Mengembangkan</span> Budaya Literasi</p>
    </div>

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/teamwp/trisna.jpeg" class="img-fluid teams-image" alt="">
          </div>
          <div class="member-info">
            <h4>Trisnawan</h4>
            <span>Mentor & Model</span>
            <p>Semakin aku banyak membaca, semakin aku banyak berpikir; semakin aku banyak belajar, semakin aku sadar bahwa aku tak mengetahui apa pun.
              <!-- -Voltaire -->
            </p>
          </div>
        </div>
      </div><!-- End Chefs Member -->

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/teamwp/imong.jpeg" class="img-fluid teams-image" alt="">
          </div>
          <div class="member-info">
            <h4>Imong</h4>
            <span>Views & Controller</span>
            <p>Satu-satunya kebijaksanaan sejati adalah mengetahui bahwa Anda tidak mengetahui apa-apa.
              <!-- -Socrates   -->
          </p>
          </div>
        </div>
      </div><!-- End Chefs Member -->

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/teamwp/merdian.jpeg" class="img-fluid teams-image" alt="">
          </div>
          <div class="member-info">
            <h4>Merdian</h4>
            <span>Views</span>
            <p>Seni adalah literasi hati.
              <!-- -Elliot Eisner -->
            </p>
          </div>
        </div>
      </div><!-- End Chefs Member -->
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/teamwp/fai.jpeg" class="img-fluid teams-image" alt="">
          </div>
          <div class="member-info">
            <h4>Fai</h4>
            <span>Makalah 1</span>
            <p>Mendorong sastra dan seni adalah kewajiban setiap warga negara yang baik kepada negaranya.
              <!-- -George Washington -->
            </p>
          </div>
        </div>
      </div><!-- End Chefs Member -->
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/teamwp/ucup.jpeg" class="img-fluid teams-image" alt="">
          </div>
          <div class="member-info">
            <h4>Yusuf</h4>
            <span>Makalah 2</span>
            <p>Literasi adalah jembatan dari kesengsaraan menuju harapan.
                <!-- -Kofi Anan -->
            </p>
          </div>
        </div>
      </div><!-- End Chefs Member -->
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">
        <div class="chef-member">
          <div class="member-img">
            <img src="assets/img/teamwp/aldo.jpeg" class="img-fluid teams-image" alt="">
          </div>
          <div class="member-info">
            <h4>Reynaldo</h4>
            <span>Power Point</span>
            <p>Orang yang tidak membaca tidak memiliki kelebihan dibandingkan orang yang tidak bisa membaca.
                <!-- -Mark Twaina -->
            </p>
          </div>
        </div>
      </div><!-- End Chefs Member -->

    </div>

  </div>
</section>

