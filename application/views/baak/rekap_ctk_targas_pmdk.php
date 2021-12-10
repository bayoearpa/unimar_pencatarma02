<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
 		body {
    margin: 0;
    padding: 0;
    /*background-color: #FAFAFA;*/
    font: 11pt "Tahoma";
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.page {
    width: 40cm;
    min-height: 21.5cm;
    padding: 0.5cm;
    margin: 0.5cm auto;
    /*border: 1px #D3D3D3 solid;*/
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    font-size: 13px;
}
.subpage {
    /*padding: 1cm;*/
    /*border: 5px red solid;*/
    /*height: 256mm;*/
    /*outline: 2cm #FFEAEA solid;*/
}
table{
	/*font-size: 18px;*/
}

@page {
    size: F4;
    margin: 0;
}
@media print {
    .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}

 	</style>
</head>
<?php 
$value=array_chunk($catar, 10);
$noKelompok=1;
 ?>

<body>

<?php foreach ($value as $val): ?>
<div class="page">
<p style="margin: 0px;text-align: center;">UNIVERSITAS MARITIM AMNI SEMARANG</p>
<p style="margin: 0px;text-align: center;">JALAN SOEKARNO HATTA NOMOR 180 SEMARANG</p>
<center><p style="margin: 0px;text-align: center;">DAFTAR SELESKSI CALON TARUNA - MAHASISWA T.A <?php echo $ta; ?></p></center>
<center><p style="margin: 0px;text-align: center;">TANGGAL : <?php echo $tgl; ?></p></center>	
<center><p style="margin: 0px;text-align: center;">PETUGAS TARGAS : .........................</p></center>	
<table width="100%">
	<tr>
	<th align="left"><h3>
<?php echo $jurusan ?>
</h3></th>
	<th align="right">
		<h3>
<?php if ($jk=="Pria") {
		echo "A.".$noKelompok++; 
		}else{
		echo "A.".$noKelompok++; 
		} ?>
	</h3>
	</th>
	</tr>
</table>
<table width="100%" border="1" style="border: 1px solid black;border-collapse: collapse;">
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>No. Catarma</th>
			<th>L/P</th>
			<th>Hadir Hr Pertama</th>
			<th>Hadir Hr Kedua</th>
			<th>Hadir Hr ketiga</th>
			<th>Penjelasan Umum</th>
			<th>Test TKD</th>
			<th>Test Wawancara</th>
			<th>Pemeriksaan Kesehatan</th>
			<th>Test Samapta</th>
			<th>Psikotest</th>
			<th>Ukuran Pakaian</th>
			<th>Pantukir</th>
		</tr>
<?php //---------------------------------------------------------per tabel 10------------------------------------------ ?>
<?php
$no=1;
 foreach ($val as $v): ?>
	<tr>
		<td height="10px"><?php echo $no++; ?></td>
		<td><?php $text1= strtolower($v->nama);echo ucwords($text1) ?></td>
		<td align="center">
		<?php 
		echo $v->no; 
		echo "/A/"; 
		echo date("Y");
		?>
		</td>

		<td><?php if ($v->jk == "Pria") {
			# code...
			echo "L";
		}else{
			echo "P";
		} ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
<?php endforeach ?>
<?php //---------------------------------------------------------akhir per tabel 10------------------------------------------ ?>
</table>
</div>
<?php endforeach ?>

</body>
</html>