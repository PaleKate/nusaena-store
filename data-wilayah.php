<?php
	include('includes/config.php');     
	switch ($_GET['jenis']) {
		//ambil data kota / kabupaten
		case 'kota':
		$id_provinces = $_POST['id_provinces'];
		if($id_provinces == ''){
		     exit;
		}else{
		     $getcity = mysqli_query($koneksidb,"SELECT  * FROM regencies WHERE province_id ='$id_provinces' ORDER BY kota ASC") or die ('Query Gagal');
		     while($data = mysqli_fetch_array($getcity)){
		          echo '<option value="'.$data['id'].'">'.$data['kota'].'</option>';
		     }
		     exit;    
		}
		break;

		//ambil data kecamatan
		case 'kecamatan':
		$id_regencies = $_POST['id_regencies'];
		if($id_regencies == ''){
		     exit;
		}else{
		     $getcity = mysqli_query($koneksidb,"SELECT  * FROM districts WHERE regency_id ='$id_regencies' ORDER BY kecamatan ASC") or die ('Query Gagal');
		     while($data = mysqli_fetch_array($getcity)){
		          echo '<option value="'.$data['id'].'">'.$data['kecamatan'].'</option>';
		     }
		     exit;    
		}
		break;
		

		//ambil data kelurahan
		case 'kelurahan':
		$id_district = $_POST['id_district'];
		if($id_district == ''){
		     exit;
		}else{
		     $getcity = mysqli_query($koneksidb,"SELECT  * FROM villages WHERE district_id ='$id_district' ORDER BY kelurahan ASC") or die ('Query Gagal');
		     while($data = mysqli_fetch_array($getcity)){
		          echo '<option value="'.$data['id'].'">'.$data['kelurahan'].'</option>';
		     }
		     exit;    
		}
		break;
		
	}
?>