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
}
.subpage {
    /*padding: 1cm;*/
    /*border: 5px red solid;*/
    /*height: 256mm;*/
    /*outline: 2cm #FFEAEA solid;*/
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
$value=array_chunk($catar, 20);
$noKelompok=1;
 ?>

<body>

<?php foreach ($value as $val): ?>
<div class="page">
<p style="margin: 0px;text-align: center;">UNIVERSITAS MARITIM AMNI SEMARANG</p>
<p style="margin: 0px;text-align: center;font-size: 5px;">JALAN SOEKARNO HATTA NOMOR 180 SEMARANG</p>
<center><p style="margin: 0px;text-align: center;font-size: 5px;">DAFTAR CALON TARUNA - MAHASISWA T.A 2023/2024</p></center>
<center><p style="margin: 0px;text-align: center;font-size: 5px;">PRODI : <?php echo $prodi; ?></p></center>
<center><p style="margin: 0px;text-align: center;font-size: 5px;">KELAS : <?php if ($kelas == "reg") {
	# code... 
	echo "REGULER";
}else{ echo "FAST TRACK";} ?></p></center>


<table width="100%" border="1" style="border: 1px solid black;border-collapse: collapse;">
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>No. Catarma</th>
			<th>L/P</th>
			<th>TTD</th>
		</tr>
<?php //---------------------------------------------------------per tabel 20------------------------------------------ ?>
<?php
$no=1;
 foreach ($val as $v): ?>
	<tr>
		<td height="10px"><?php echo $no++; ?></td>
		<td><?php $text1= strtolower($key->nama);echo ucwords($text1) ?></td>
		<td align="center"><?php echo $key->no; ?></td>
		<td><?php if ($key->jk == "Pria") {
			# code...
			echo "L";
		}else{
			echo "P";
		} ?></td>
		<td></td>
	</tr>
<?php endforeach ?>
<?php //---------------------------------------------------------akhir per tabel 10------------------------------------------ ?>
</table>
</div>
<?php endforeach ?>

</body>
</html>
