<?php 
include 'koneksi.php';

if (isset($_POST['pinjam'])) {
    $judul = $_POST['judul'];
    $id_buku = $_POST['id_buku'];
    $id_user = $_POST['id_user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $jml_pinjam = $_POST['jml_pinjam'];
    $darijam = $_POST['darijam'];
    $sampaijam = $_POST['sampaijam'];
	$jam = $darijam ."-". $sampaijam;
    $guru = $_POST['guru'];
	$tgl_kembali = strtotime("+7 day", strtotime($tgl_pinjam)); // +7 hari dari tgl peminjaman
	$tgl_kembali = date('Y-m-d', $tgl_kembali); // format tgl peminjaman tahun-bulan-hari

	//cek apakah peminjam telah meminjam buku tsb apa blm
	$pinjam_query = "SELECT * FROM peminjaman WHERE id_buku = '$id_buku'";
	$pinjam_query_run = mysqli_query($koneksi, $pinjam_query);
	if (mysqli_num_rows($pinjam_query_run) > 0){
		echo "<script>
		alert('Anda telah meminjam buku ini');
		document.location.href = '';
		</script>";
		exit();
	}

	//cek apakah peminjam telah meminjam buku sebanyak 3 atau blm
	$pinjam_query = "SELECT * FROM peminjaman WHERE id_user = '$id_user'";
	$pinjam_query_run = mysqli_query($koneksi, $pinjam_query);
	if (mysqli_num_rows($pinjam_query_run) === 3){
		echo "<script>
		alert('Anda telah meminjam buku sebanyak 3');
		document.location.href = '';
		</script>";
		exit();
	}

    //memasukkan data buku ke db
    $query = mysqli_query($koneksi, "INSERT INTO peminjaman (id_user, id_buku, buku, tgl_peminjaman, tgl_kembali, jml_pinjam, jam, guru) VALUES ('$id_user', '$id_buku', '$judul', '$tgl_pinjam', '$tgl_kembali', '$jml_pinjam', '$jam', '$guru')");

  if ($query) {
  	$sisa = $_POST["jml_buku"] - $_POST["jml_pinjam"];

    // Ubah data jml buku dari setelah sukses meminjam buku
    $queryInsert = mysqli_query($koneksi, "UPDATE buku SET jml_buku = '$sisa' WHERE id_buku = '$_POST[id_buku]'");
    
    if ($queryInsert) {
      echo "<script>
      alert('Kamu berhasil meminjam buku.');
      document.location.href = '';
      </script>";
    } else {
      echo "<script>
      alert('Kamu gagal meminjam buku.');
      document.location.href = '';
      </script>";
    }
  } else {
    echo "<script>
    alert('Kamu gagal meminjam buku.');
    document.location.href = '';
    </script>";
    exit();
  }
}

if (isset($_POST['ulas'])) {
    $ulas = $_POST['komentar'];
    $id_buku = $_POST['id_buku'];
    $id_user = $_POST['id_user'];
    $tgl = $_POST['tgl'];
    $ratedIndex = $_POST['rating'];

    //memasukkan data buku ke db
    $query = mysqli_query($koneksi, "INSERT INTO ulasan_buku (id_user, id_buku, ulasan, tgl, rating) VALUES ('$id_user', '$id_buku', '$ulas', '$tgl', '$ratedIndex')");

    if ($query) {
        echo "<script>
        alert('Kamu berhasil mengulas buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mengulas buku.');
        document.location.href = '';
        </script>";
        exit();
    }
}

if (isset($_POST['hapus-ulasan'])) {

    $id = $_POST['id_buku'];

    $query = "DELETE FROM buku WHERE id_buku='$id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        echo "<script>
        alert('Kamu berhasil menghapus data buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menghapus data buku.');
        document.location.href = '';
        </script>";
    }
}


if (isset($_POST['koleksi'])) {
    $u = $_POST['id_user'];
    $b = $_POST['id_buku'];

    // Periksa apakah buku sudah ada di koleksi pengguna
    $check_query = mysqli_query($koneksi, "SELECT * FROM koleksi_pribadi WHERE id_user = '$u' AND id_buku = '$b'");
    $existing_book = mysqli_fetch_assoc($check_query);
    if ($existing_book) {
        // Jika buku sudah ada, tampilkan pesan kesalahan
        echo "<script>
        alert('Buku sudah ada di dalam koleksi kamu.');
        document.location.href = '';
        </script>";
        exit();
    }

    // Jika buku belum ada, masukkan data buku ke dalam database
    $query = mysqli_query($koneksi, "INSERT INTO koleksi_pribadi (id_user, id_buku) VALUES ('$u', '$b')");

    if ($query) {
        echo "<script>
        alert('Kamu berhasil mengkoleksi buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mengkoleksi buku.');
        document.location.href = '';
        </script>";
        exit();
    }
}


?>


<?php 
include 'header-user.php';
?>
<?php 
include 'navbar-user.php';
?>

<div class="container" style="padding-top: 90px;">
	<div id="layoutSidenav_content">
		<main>
			<div class="container px-4">
				<?php 
				$id = $_GET['id'];
				$no = 1;
				$query = "SELECT b.*, 
                 			(SELECT COUNT(ulasan) FROM ulasan_buku WHERE id_buku = b.id_buku) AS jumlah_ulasan,
			                (SELECT COUNT(*) FROM koleksi_pribadi WHERE id_buku = b.id_buku) AS jumlah_koleksi
			          FROM buku AS b 
			          WHERE b.id_buku='$id'";

				$query_run = mysqli_query($koneksi, $query);

				if (mysqli_num_rows($query_run) > 0) {
					foreach ($query_run as $row) {
						?>
						<div class="row">
							<div class="col-6">
								<span >
									<img class="border rounded p-3" src="img/<?= $row['foto']; ?>" width="70%">
								</span>
							</div>
							<div class="col-6">
								<h1 class="mt-4"><?= $row['judul']; ?></h1>
								<?php if ($row['jml_buku'] >= 1) { ?>
									<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pinjamBuku">Pinjam</button>
								<?php } else { ?>
									<p style="color: red;">Buku telah dipinjam, tunggu stok buku tersedia kembali.</p>
								<?php } ?>
								<span style="color: black; margin-left: 5px;"> <i class="fas fa-comment fa-regular"></i> <?= $row['jumlah_ulasan'] ?> ulasan </span>
								<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#koleksiBuku"><?= $row['jumlah_koleksi'] ?> <i class="fas fa-regular fa-bookmark"></i></button>
								<hr>
								<h6>Deskripsi Buku</h6>
								<p><?= $row['sinopsis']; ?></p>
								<hr>
								<h6>Detail Buku</h6>
								<div class="row">
									<div class="col">
										<p> <span class="fw-medium">Jumlah Halaman</span> <br>
											<?= $row['jumlah_halaman']; ?></p>
									</div>
									<div class="col">
										<p><span class="fw-medium">Nama Penulis</span> <br>
											<?= $row['penulis']; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<p><span class="fw-medium">Penerbit</span> <br>
											<?= $row['penerbit']; ?></p>
									</div>
									<div class="col">
										<p><span class="fw-medium">Tahun Terbit</span> <br>
											<?= $row['tahun_terbit']; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<p><span class="fw-medium">Kategori</span> <br>
											<?= $row['kategori']; ?></p>
									</div>
									<div class="col">
										<p><span class="fw-medium">Stok Tersedia</span> <br>
											<?= $row['jml_buku']; ?></p>
									</div>
								</div>

								<!-- modal pinjam -->
								<div class="modal fade" id="pinjamBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h1 class="modal-title fs-5" id="exampleModalLabel">Form Pinjam Buku</h1>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div class="alert alert-info" role="alert">
													<h4 class="alert-heading">Catatan</h4>
													<p>* Waktu peminjaman buku hanya 1 minggu/7 hari <br>
														* Denda keterlambatan 1000/hari
													</p>
												</div>
												<form method="post">
													<div class="mb-3">
														<input type="hidden" value="<?= $row['id_buku']; ?>" name="id_buku">
														<input type="hidden" value="<?= $_SESSION['id_user']; ?>" name="id_user">
														<input type="hidden" value="<?= $row['jml_buku']; ?>" name="jml_buku">
														<label for="inputJudul" class="form-label">Buku yang dipinjam</label>
														<input type="text" class="form-control" name="judul" id="inputJudul" value="<?= $row['judul']; ?>" readonly>
													</div>
													<div class="mb-3">
														<label for="inputNama" class="form-label">Nama</label>
														<input type="text" class="form-control" name="nama" id="inputNama" value="<?= $_SESSION['nama_lengkap'] ?>" readonly>
													</div>
													<div class="mb-4">
														<label for="inputPinjam" class="form-label">Jumlah Pinjam</label>
														<select class="form-select" name="jml_pinjam" id="inputPinjam" required>
														<?php for ($i=1; $i <= $row['jml_buku']; $i++) { ?>
															<option value="<?= $i ?>"><?= $i ?></option>
														<?php } ?>
														</select>
													</div>
													<div class="mb-3">
													  <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_pinjam" id="inputTgl">
													</div>
													<div class="input-group mb-3">
													  <span class="input-group-text">Dari Jam ke</span>
													  <select class="form-select" name="darijam" id="inputPinjam" required>
													        <option value="-">-</option>
														<?php for ($i=1; $i <= 10; $i++) { ?>
															<option value="<?= $i ?>"><?= $i ?></option>
														<?php } ?>
														</select>
													  <span class="input-group-text">Sampai Jam ke</span>
													  <select class="form-select" name="sampaijam" id="inputPinjam" required>
													        <option value="-">-</option>
														<?php for ($i=1; $i <= 10; $i++) { ?>
															<option value="<?= $i ?>"><?= $i ?></option>
														<?php } ?>
														</select>
													</div>
													<div class="mb-3">
														<label for="inputGuru" class="form-label">Guru yang mengajar</label>
														<select required class="form-select" name="guru" id="inputGuru" required>
                                                            <option value="">Pilih Guru</option>
                                                            <option value="-">-</option>
                                                            <?php 
                                                                $sql = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
                                                                while ($data = mysqli_fetch_array($sql)) {
                                                            
                                                                echo '<option value=" '.$data['nama'].' "> '.$data['nama'].' </option>';
                                                            } ?>
                                                        </select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
													<button type="submit" name="pinjam" class="btn btn-primary">Pinjam</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<div class="modal fade" id="koleksiBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form method="post">
													<div class="mb-3">
														<input type="hidden" value="<?= $row['id_buku']; ?>" name="id_buku">
														<input type="hidden" value="<?= $_SESSION['id_user']; ?>" name="id_user">
														<label for="inputJudul" class="form-label">Apakah anda ingin menambahkan buku ini ke koleksi buku anda?</label>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
													<button type="submit" name="koleksi" class="btn btn-primary">Koleksi</button>
												</div>
											</form>
										</div>
									</div>
								</div>

							</div>
						</div>

						<hr>

						<form method="post">
							<input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">
							<input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
						<div class="card p-4 mt-5">
						<div class="row float-center">
							<div class="row g-2">
								<div class="col-md me-5">
									<div class="form-floating">
<!-- 										<div>
											<i class="fa fa-star" data-index="0"></i>
											<i class="fa fa-star" data-index="1"></i>
											<i class="fa fa-star" data-index="2"></i>
											<i class="fa fa-star" data-index="3"></i>
											<i class="fa fa-star" data-index="4"></i>
										</div> -->
										<select class="form-select" name="rating" required>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<label>Rating</label>
									</div>
									<div class="form-floating mt-2">
										<input type="text" class="form-control" name="nama" id="floatingInputGrid1" placeholder="Masukkan nama anda" value="<?= $_SESSION['nama_lengkap'] ?>" readonly>
										<label for="floatingInputGrid1">Nama</label>
									</div>
									<div class="form-floating mt-2">
										<textarea type="text" class="form-control" name="komentar" id="floatingInputGrid2" placeholder="Masukkan komentar anda" required></textarea>
										<label for="floatingInputGrid2">Komentar</label>
									</div>
										
									<div class="form-floating">
										<input type="hidden" class="form-control" name="tgl" id="floatingInputGrid" placeholder="Masukkan nama anda" value="<?= date('l, d-m-Y H:i') ?>">
									</div>
								</div> 
								<div class="col-md border-start">
									<div class="form-floating">
										<p class="ms-5">Silakan kirimkan ulasan dengan perkataan yang baik dan sopan, jika ada kendala silakan tuliskan dengan jelas.</p>
										<h5 class="text-center">"Membaca buku-buku yang baik berarti memberi makanan rohani yang baik." </h5>
										<h6 class="text-center"><a href="https://id.wikipedia.org/wiki/Hamka" class="text-decoration-none">Buya Hamka</a></h6>
									</div>
								</div> 
								
								<div class="col-12">
									<button type="submit" name="ulas" class="btn btn-primary">Kirim</button>
								</div>

							</div>
						</div>
						</div>
						</form>
					</div>

							<!-- ulasan -->
							<div class="row mt-5">
							<h4>Ulasan</h4>
							<hr>
						  <?php
				          $no = 1;
				          $tampil = mysqli_query($koneksi, "SELECT * FROM ulasan_buku AS ub JOIN user AS u ON ub.id_user = u.id_user WHERE ub.id_buku='$id'");
				          foreach ($tampil as $b) :
				          ?>
							<section class="isi" id="">
								<div class="isi-container">
									<div class="isi-box">
										<div class="card shadow-sm" style='margin-bottom: 20px;'>
											<div class="card-body">
												<div class='row'>
													<div class="col-6">
														<p> <img src="img/<?= $b['foto'] ?>" width="45" class="rounded-circle"> <span class="fw-bold"><?= $b['nama_lengkap'] ?></span> <br>
															<?php  
														$star = 1;
														while ($star <= 5) {
															if ($b['rating'] < $star) {
															?>
																<i class="fa fa-star"></i>
															<?php
															} else {
															?>
																<i class="fa fa-star checked"></i>
															<?php
															}

															$star++;

														}
														?>
														<?= $b['tgl'] ?> <br>
														<?= $b['ulasan'] ?> </p> 
													</div>
													<?php if ($b['id_user'] == $_SESSION['id_user']): ?>
													<div class="col-6 text-end">
														<a href="ulasan-edit?id=<?= $b['id_ulasan'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
														<a href="hapus-ulasan?id=<?= $b['id_ulasan'] ?>"><i class="fa-solid fa-trash"></i></a>
													</div>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<?php endforeach; ?>
						</div>

					<!-- Modal Edit-->
					<!-- <div class="modal fade" id="#pinjamBuku<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Pinjam Buku</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form method="post">
										<input type="hidden" name="id_peminjaman" value="<?= $loop['id_peminjaman'] ?>">
										<div class="mb-3">
											<label for="inputNama" class="form-label">Nama</label>
											<input type="text" class="form-control" name="nama" id="inputNama" value="<?= $loop['nama_lengkap']; ?>">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
										<button type="submit" name="ubah" class="btn btn-primary">Pinjam</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div> -->

					<!-- Modal Edit-->
					<!-- <div class="modal fade" id="#editUlasan<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Pinjam Buku</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form method="post">
										<input type="hidden" name="id_peminjaman" value="<?= $loop['id_peminjaman'] ?>">
										<div class="mb-3">
											<label for="inputNama" class="form-label">Nama</label>
											<input type="text" class="form-control" name="nama" id="inputNama" value="<?= $loop['nama_lengkap']; ?>">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
										<button type="submit" name="ubah" class="btn btn-primary">Pinjam</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div> -->
				<?php
			}
		}

		?>
	</div>
</main>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- <script>
	var ratedIndex = -1;

	$(document).ready(function () {
		resetStarColors();

		if (localStorage.getItem('ratedIndex') != null)
			setStars(parseInt(localStorage.getItem('ratedIndex')));

		$('.fa-star').on('click', function () {
			ratedIndex = parseInt($(this).data('index'));
			localStorage.setItem('ratedIndex', ratedIndex);
			saveToTheDB();
		});

		$('.fa-star').mouseover(function () {
			resetStarColors();
			var currentIndex = parseInt($(this).data('index'));
			setStars(currentIndex);
		});

		$('.fa-star').mouseleave(function () {
			resetStarColors();

			if (ratedIndex != -1)
				setStars(ratedIndex);
		});
	});

	function saveToTheDB() {
		$.ajax({
			url: "detail-buku.php",
			method: "POST",
			dataType: 'json',
			data: {
				save: 1,
				rating: ratedIndex
			}, success: function (r) {

			}
		})
	}

	function setStars(max) {
		for (var i=0; i <= max; i++)
			$('.fa-star:eq('+i+')').css('color', 'green');
	}

	function resetStarColors() {
		$('.fa-star').css('color', 'gray');
	}
</script> -->

<?php
include 'footer-user.php';
?>