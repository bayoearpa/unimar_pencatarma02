    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Form Seleksi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if ($nik == null) {
              # code... ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Maaf!</h4>
                    Silakan mengisi form biodata terlebih dahulu untuk dapat mengakses halaman ini. terima kasih.
                </div>
            <?php }else if ($validasi == null) { 
              # code... ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Maaf!</h4>
                    Silakan melakukan pembayaran terlebih dahulu untuk dapat mengakses halaman ini. terima kasih.
                </div>

           <?php }else{ ?>
                <div class="box-body"><h3>Pada Saat Seleksi diharapkan mengisi form yang menggunakan <b>KOP Sekolah dan ditandatangani oleh Kepala Sekolah.</b> untuk format bisa di download di bawah ini :</h3>
                   <a href="<?php echo base_url() ?>download_suket?>" target="__blank"><button type="button" class="btn btn-primary">Download Surat Keterangan</button></a>
                </div>
                 <div class="box-body"><h3>Pada Saat Seleksi diharapkan mengisi form Surat Pernyataan Sehat.</b> yang bisa di download di bawah ini :</h3>
                   <a href="<?php echo base_url() ?>download_supersehatreg?>" target="__blank"><button type="button" class="btn btn-primary">Download Surat Pernyataan Sehat</button></a>
                </div>
                <hr>
                <h5><b>Seleksi samapta akan dilaksanakan secara offline, tunggu pengumuman selanjutnya.</b></h5>
                <!-- <h5><b>Silakan mengisi form seleksi dibawah ini :</b></h5> -->
                <?php echo validation_errors(); 
                  echo $this->session->flashdata('success');
                  echo $this->session->flashdata('error'); ?>
                <p></p>
                <?php if ($seleksi == null) {
                  # code... cek seleksi ?>
                  <!--  <a href="<?php //echo base_url() ?>download_tutorial_form_seleksi_gelombang_dini?>" target="__blank"><button type="button" class="btn btn-primary">Download Tutorial Pengisan Form Seleksi</button></a> -->
              
                 <form action="<?php echo base_url() ?>proses_seleksi_gelombangdini_reguler" name="form1" id="form1" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="no" id="no" value="<?php echo $this->session->userdata('no'); ?>">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Link File KTP</label>
                  <input type="file" class="form-control" id="file_ktp" name="file_ktp" placeholder="Masukan File KTP">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Link File Ijasah atau surat keterangan dari sekolah (jika belum lulus)</label>
                  <input type="file" class="form-control" id="file_ijasah" name="file_ijasah" placeholder="File Ijasah atau surat keterangan dari sekolah (jika belum lulus)">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Rata-Rata Nilai Kelas 10</label>
                  <input type="text" class="form-control" id="" name="" placeholder="Rata-Rata Nilai Semster 1">
                  <input type="text" class="form-control" id="" name="" placeholder="Rata-Rata Nilai Semster 2">
                  <label for="exampleInputEmail1">Rata-Rata Nilai Kelas 11</label>
                  <input type="text" class="form-control" id="" name="" placeholder="Rata-Rata Nilai Semster 1">
                  <input type="text" class="form-control" id="" name="" placeholder="Rata-Rata Nilai Semster 2">
                  <label for="exampleInputEmail1">Rata-Rata Nilai Kelas 12</label>
                  <input type="text" class="form-control" id="" name="" placeholder="Rata-Rata Nilai Semster 1">
                  <input type="text" class="form-control" id="" name="" placeholder="Rata-Rata Nilai Semster 2">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Surat pernyataan dan riwayat kesehatan</label>
                  <input type="file" class="form-control" id="file_supersehat" name="file_supersehat" placeholder="File Surat pernyataan dan riwayat kesehatan">
                  </div>
                
               
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <?php }else{ ?>
                  <table class="table table-striped">
                        <tbody><tr>
                          <th style="width: 10px">#</th>
                          <th>Status</th>
                          <th>Edit Form</th>
                        </tr>
                        <tr>
                          <td>#</td>
                          <td>Anda Telah Mengisi Form Seleksi</td>
                          <td>
                             <div class="form-group" align="center">
                             <button type="button" name="submit" id="editseleksigdr1" class="btn editseleksigdr1 btn-primary"  data-no="<?php echo $this->session->userdata('no'); ?>">Edit Form Seleksi</button>
                            </div>
                          </td>
                        </tr>
                      </tbody></table>
                      <div class="modal fade" id="editFormModal" tabindex="-1" role="dialog" aria-labelledby="editFormModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="editFormModalLabel">Edit Form Seleksi</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <!-- Isi formulir di sini -->
                                  <form action="<?php //echo base_url() ?>proses_seleksi_gelombangdini_reguler_edit" name="form1" id="form1" method="post" enctype="multipart/form-data">
                                      ... (Formulir seperti yang Anda berikan) ...
                                      <input type="hidden" name="no" id="no" value="<?php //echo $this->session->userdata('no'); ?>">
                                      <input type="hidden" name="id_link" id="id_link" value="<?php //echo $this->session->userdata('id_link'); ?>">
                                      <div class="form-group">
                                      <label for="exampleInputEmail1">Link File KTP</label>
                                      <input type="text" class="form-control" id="file_ktp" name="file_ktp" placeholder="Masukan Link File KTP">
                                      </div>
                                      <div class="form-group">
                                      <label for="exampleInputEmail1">Link File Ijasah atau surat keterangan dari sekolah (jika belum lulus)</label>
                                      <input type="text" class="form-control" id="file_ijasah" name="file_ijasah" placeholder="Link File Ijasah atau surat keterangan dari sekolah (jika belum lulus)">
                                      </div>
                                      <div class="form-group">
                                      <label for="exampleInputEmail1">Link File Transkip nilai atau rapor semster 1-5 (jika belum lulus)</label>
                                      <input type="text" class="form-control" id="link_rapor" name="link_rapor" placeholder="Link File Transkip nilai atau rapor semster 1-5 (jika belum lulus)">
                                      </div>
                                      <div class="form-group">
                                      <label for="exampleInputEmail1">Link File Documen pemerikasaan kesehatan dari RS Pemerintah setempat/ Puskesmas</label>
                                      <input type="text" class="form-control" id="link_kesehatan" name="link_kesehatan" placeholder="Link File Documen pemerikasaan kesehatan dari RS Pemerintah setempat/ Puskesmas">
                                      </div>
                                      <div class="form-group">
                                      <label for="exampleInputEmail1">Surat pernyataan dan riwayat kesehatan</label>
                                      <input type="file" class="form-control" id="file_supersehat" name="file_supersehat" placeholder="Link File Surat pernyataan dan riwayat kesehatan">
                                      </div>
                                     
                                      
                                   
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php } ?>                  


            <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->