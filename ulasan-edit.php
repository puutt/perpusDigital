<?php 
include 'koneksi.php';

if (isset($_POST['ubah'])) {
    //updating
    $query = "UPDATE ulasan_buku SET 
                                ulasan='$_POST[ulasan]',
                                rating='$_POST[rating]'
                                WHERE id_ulasan='$_POST[id]'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        echo "<script>
        alert('Kamu berhasil mengedit ulasan buku.');
        document.location.href = 'perpusDigital/..';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mengedit ulasan buku.');
        document.location.href = 'perpusDigital/..';
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
				

				<!-- ulasan -->
				<div class="row mt-5">
					<h4>Edit Ulasan</h4>
					<hr>
					<?php
					$id = $_GET['id'];
					$no = 1;
					$tampil = mysqli_query($koneksi, "SELECT * FROM ulasan_buku AS ub JOIN user AS u ON u.id_user = ub.id_user WHERE ub.id_ulasan='$id'");
					foreach ($tampil as $b) :
						?>
						<section class="isi" id="">
							<div class="isi-container">
								<div class="isi-box">
									<div class='row' style='margin-bottom: 20px;'>
										<div class="col">
											<form method="post">
												<input type="hidden" name="id" value="<?= $b['id_ulasan'] ?>">
												<input type="hidden" name="tgl" value="<?= $b['tgl'] ?>">
												<input type="text" class="form-control" name="nama" value="<?= $b['nama_lengkap'] ?>" readonly> <br>
												<select class="form-select" name="rating" required>
													<option value="<?= $b['rating'] ?>"><?= $b['rating'] ?></option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select> <br>
												<input type="text" class="form-control" name="ulasan" value="<?= $b['ulasan'] ?>"> <br>
												<button type="submit" name="ubah" class="btn btn-warning"> Ubah </button>
												<a href="perpusDigital/../" class="btn btn-secondary"> Kembali </a>
											</form>
											</div>
										</div>
									</div>
								</div>
							</section>
						<?php endforeach; ?>
					</div>

				</div>
			</main>
		</div>
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
