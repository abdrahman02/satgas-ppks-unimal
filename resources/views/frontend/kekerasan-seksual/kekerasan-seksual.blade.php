@extends('frontend.layout.main')
@section('content')
<main id="kekerasan-seksual">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Kekerasan Seksual</li>
                <li>Kekerasan Seksual</li>
            </ol>
            <h2>Kekerasan Seksual</h2>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <section class="kekerasan-seksual">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img src="{{ asset('img/image-dukung-hapus-kekerasan-seksual.png') }}" class="img-fluid">
                </div>
                <div class="col-lg-8">
                    <h3 style="color: #25B97C">Mari Gerak Bersama!</h3>
                    <p>Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi (Kemendikbudristek) telah
                        menerbitkan Permendikbudristek tentang Pencegahan dan Penanganan Kekerasan Seksual di
                        Lingkungan Pendidikan Tinggi atau Permen PPKS. Langkah ini merupakan komitmen serius
                        Kemendikbudristek dalam upaya pencegahan dan penanganan kekerasan seksual di lingkungan
                        pendidikan Indonesia untuk memastikan terpenuhinya hak dasar atas pendidikan bagi seluruh
                        warga negara. Hal ini dilakukan sebagai bentuk perwujudan Pasal 31 Undang-Undang Dasar
                        Negara Republik Indonesia Tahun 1945, serta Tujuan Pembangunan Berkelanjutan khususnya
                        Tujuan 4 mengenai Pendidikan dan Tujuan 5 mengenai Kesetaraan Gender, dengan memastikan
                        upaya menghentikan kekerasan seksual di lingkungan satuan pendidikan berjalan tanpa
                        menghambat warga negara dalam mengakses dan melanjutkan pendidikannya.</p>
                </div>
            </div>

            <ul class="nav nav-pills nav-fill mt-3" id="tabKekerasanSeksual" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="defenisi-jenis-dan-bentuk" data-bs-toggle="tab"
                        data-bs-target="#konten-defenisi-jenis-dan-bentuk" type="button" role="tab"
                        aria-controls="konten-defenisi-jenis-dan-bentuk" aria-selected="true">Defenisi, Jenis, dan
                        Bentuk</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="dampak-dan-tantangan" data-bs-toggle="tab"
                        data-bs-target="#konten-dampak-dan-tantangan" type="button" role="tab"
                        aria-controls="konten-dampak-dan-tantangan" aria-selected="false">Dampak dan Tantangan</button>
                </li>
            </ul>

            <div class="tab-content" id="tabKekerasanSeksualContent">
                <div class="tab-pane fade show active" id="konten-defenisi-jenis-dan-bentuk" role="tabpanel"
                    aria-labelledby="defenisi-jenis-dan-bentuk">

                    <div class="col-lg-12 p-1 mt-2 rounded-top" style="background-color: #25B97C">
                        <h4><strong>Defenisi Kekerasan Seksual</strong></h4>
                    </div>

                    <p>Kekerasan Seksual adalah setiap perbuatan merendahkan, menghina, melecehkan, dan/atau menyerang
                        tubuh, dan/atau fungsi reproduksi seseorang, karena ketimpangan relasi kuasa dan/atau gender,
                        yang berakibat atau dapat berakibat penderitaan psikis dan/atau fisik termasuk yang mengganggu
                        kesehatan reproduksi seseorang dan hilang kesempatan melaksanakan pendidikan dengan aman dan
                        optimal.</p>

                    <strong>Apa itu “ketimpangan relasi kuasa dan/atau gender”?</strong>

                    <p>Menurut Komnas Perempuan (2017), “ketimpangan relasi kuasa dan/atau gender” adalah sebuah keadaan
                        terlapor menyalahgunakan sumber daya pengetahuan, ekonomi dan/ atau penerimaan masyarakat atau
                        status sosialnya untuk mengendalikan korban.</p>



                    <div class="col-lg-12 p-1 mt-2 rounded-top" style="background-color: #25B97C">
                        <h4><strong>Jenis kekerasan, termasuk juga kekerasan seksual</strong></h4>
                    </div>

                    <p>Berdasarkan jenisnya, kekerasan seksual dapat digolongkan menjadi kekerasan seksual yang
                        dilakukan secara:</p>
                    <ol>
                        <li>
                            verbal,
                        </li>
                        <li>
                            nonfisik,
                        </li>
                        <li>
                            fisik, dan
                        </li>
                        <li>
                            daring atau melalui teknologi informasi dan komunikasi.
                        </li>
                    </ol>



                    <div class="col-lg-12 p-1 mt-2 rounded-top" style="background-color: #25B97C">
                        <h4><strong>Contoh Bentuk Kekerasan Seksual</strong></h4>
                    </div>

                    <p>Selain pemerkosaan, perbuatan-perbuatan di bawah ini termasuk kekerasan seksual.</p>

                    <ol>
                        <li>
                            berperilaku atau mengutarakan ujaran yang mendiskriminasi atau melecehkan penampilan fisik,
                            tubuh ataupun identitas gender orang lain (misal: lelucon seksis, siulan, dan memandang
                            bagian tubuh orang lain);
                        </li>
                        <li>
                            menyentuh, mengusap, meraba, memegang, dan/atau menggosokkan bagian tubuh pada area pribadi
                            seseorang;
                        </li>
                        <li>
                            mengirimkan lelucon, foto, video, audio atau materi lainnya yang bernuansa seksual tanpa
                            persetujuan penerimanya dan/atau meskipun penerima materi sudah menegur pelaku;
                        </li>
                        <li>
                            menguntit, mengambil, dan menyebarkan informasi pribadi termasuk gambar seseorang tanpa
                            persetujuan orang tersebut;
                        </li>
                        <li>
                            memberi hukuman atau perintah yang bernuansa seksual kepada orang lain (seperti saat
                            penerimaan siswa atau mahasiswa baru, saat pembelajaran di kelas atau kuliah jarak jauh,
                            dalam pergaulan sehari-hari, dan sebagainya);
                        </li>
                        <li>
                            mengintip orang yang sedang berpakaian;
                        </li>
                        <li>
                            membuka pakaian seseorang tanpa izin orang tersebut;
                        </li>
                        <li>
                            membujuk, menjanjikan, menawarkan sesuatu, atau mengancam seseorang untuk melakukan
                            transaksi atau kegiatan seksual yang sudah tidak disetujui oleh orang tersebut;
                        </li>
                        <li>
                            memaksakan orang untuk melakukan aktivitas seksual atau melakukan percobaan pemerkosaan; dan
                        </li>
                        <li>
                            melakukan perbuatan lainnya yang merendahkan, menghina, melecehkan, dan/atau menyerang
                            tubuh, dan/atau fungsi reproduksi seseorang, karena ketimpangan relasi kuasa dan/atau
                            gender, yang berakibat atau dapat berakibat penderitaan psikis dan/atau fisik termasuk yang
                            mengganggu kesehatan reproduksi seseorang dan hilang kesempatan melaksanakan pendidikan
                            dengan aman dan optimal.
                        </li>
                    </ol>
                    <p>Kata kunci yang menjadi indikator suatu <strong>kekerasan</strong> adalah
                        <strong>paksaan</strong>. Kegiatan apa pun yang
                        mengandung paksaan adalah kekerasan.
                    </p>
                </div>



                <div class="tab-pane fade mt-2" id="konten-dampak-dan-tantangan" role="tabpanel"
                    aria-labelledby="dampak-dan-tantangan">
                    <p>Secara umum, hal yang membedakan kekerasan seksual dengan jenis kekerasan yang lainnya adalah
                        dampaknya yang amat besar dan mendalam bagi korban, tetapi dianggap paling sulit dibuktikan. Ada
                        beberapa konsep dasar yang perlu kita pelajari supaya dapat lebih memahami mengapa kasus
                        kekerasan seksual lebih sulit diproses dibandingkan jenis kekerasan lainnya. Berikut ini
                        beberapa konsep khas yang ada dalam kekerasan seksual.</p>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    1. Kelumpuhan Sementara atau Tonic Immobility
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <p>Tonic immobility adalah keadaan lumpuh sementara yang tak disengaja, dimana
                                        seorang
                                        individu tidak dapat bergerak, atau dalam banyak kasus, bahkan tak dapat
                                        mengeluarkan suara (Mölle, 2017). Menurut sebuah studi yang dilakukan terhadap
                                        300
                                        perempuan yang mengunjungi klinik penanganan korban perkosaan, “7 dari 10 orang
                                        korban kekerasan seksual mengalami tonic immobility yang signifikan” (Miller,
                                        2017).</p>

                                    <p>Korban kekerasan seksual seringkali dipersalahkan karena tidak melawan, berteriak
                                        atau lari saat mengalami kekerasan, padahal saat itu mereka masih mengalami
                                        tonic
                                        immobility. Konsep ini penting untuk kita pahami, supaya kita tidak dengan mudah
                                        menganggap bahwa kekerasan seksual yang terjadi pada korban adalah aktivitas
                                        seksual
                                        “suka sama suka” karena menganggap korban tidak melawan, berteriak, berlari
                                        ataupun
                                        melaporkan saat kejadian. Diamnya korban tidak berarti setuju ataupun suka sama
                                        suka.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    2. Menyalahkan Korban atau Victim Blaming
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p>
                                        Tindakan menyalahkan korban adalah sikap yang menunjukkan bahwa korbanlah yang
                                        bertanggung jawab atas kekerasan seksual yang dialaminya, bukan pelaku.
                                        Menyalahkan korban terjadi ketika korban diasumsikan melakukan sesuatu untuk
                                        memprovokasi atau menyebabkan kekerasan seksual melalui tindakan, kata-kata,
                                        atau pakaiannya. Salah satu penyebab minimnya pelaporan korban kekerasan seksual
                                        atas kejadian yang dialaminya adalah victim blaming yang dilakukan oleh bermacam
                                        pihak, baik itu dari aparat penegak hukum, lingkungan tempat kerja maupun
                                        pendidikan, atau bahkan anggota keluarga korban sendiri.
                                    </p>
                                    <p>
                                        Biasanya, bentuk victim blaming yang dilakukan terhadap korban kekerasan seksual
                                        di Indonesia berkisar pada cara berpakaian korban yang dianggap “mengundang”,
                                        kata-kata dan perilaku korban yang dianggap “provokatif”, dan respons korban
                                        yang tidak melawan pelaku. Oleh karena itu, bila konsep tonic immobility tadi
                                        tidak dipahami, dampaknya akan terjadi pada dua tingkat.
                                    </p>
                                    <p>
                                    <ol>
                                        <li>
                                            Internal: menyalahkan diri sendiri atau self-blaming yang dilakukan oleh
                                            korban terhadap dirinya sendiri; dan
                                        </li>
                                        <li>
                                            Eksternal: pihak lain menyalahkan korban atau victim blaming yang dilakukan
                                            oleh orang lain terhadap korban.
                                        </li>
                                    </ol>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    3. Tuduhan Palsu atau False Accusation
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p>
                                        Hal lain yang juga membuat banyak korban kekerasan seksual enggan melaporkan
                                        kasusnya adalah pandangan bahwa mereka melakukan tuduhan palsu. Tidak hanya itu,
                                        banyak korban kekerasan (seksual) yang kemudian malah dilaporkan balik dengan
                                        pasal pencemaran nama baik, karena dianggap tidak memiliki bukti yang cukup
                                        kuat.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseFour">
                                    4. Pembebanan Pembuktian
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p>
                                        Tantangan yang dihadapi korban dan pendamping korban kekerasan seksual juga
                                        ditambah lagi dengan pembebanan pembuktian yang seolah menjadi “tanggung jawab”
                                        pihak korban untuk membuktikan keabsahan kasus yang dilaporkannya. Tidak jarang,
                                        saat melaporkan ke pihak berwenang, pihak korban yang dituntut untuk mencari
                                        identitas dan data lengkap pelaku hingga memberikan rujukan pasal dalam aturan
                                        hukum yang bisa digunakan oleh aparat untuk memproses kasusnya lebih lanjut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <h2><span>21 JENIS</span> KEKERASAN SEKSUAL</h2>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_1.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_2.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_3.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_4.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_5.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_6.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_7.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_8.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_9.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_10.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_11.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_12.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_13.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_14.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_15.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_16.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_17.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_18.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_19.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_20.jpg') }}" alt=""
                        class="img-fluid"></div>
                <div class="col-lg-4"><img src="{{ asset('img/jenis-kekerasan-seksual/1_21.jpg') }}" alt=""
                        class="img-fluid"></div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('custom-style')
<style>
    .nav-pills .nav-link {
        color: #25B97C;
    }

    .nav-pills .nav-link.active {
        background-color: #25B97C;
        color: #fff;
    }

    .kekerasan-seksual .container .row h2 {
        color: #444;
        font-family: "Nunito", sans-serif;
        font-weight: 700;
        text-align: center;
        margin-top: 30px
    }

    .kekerasan-seksual .container .row h2 span {
        color: #25B97C;
    }
</style>
@endpush