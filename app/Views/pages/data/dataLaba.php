<?= $this->extend('layout/Layout') ?>

<?= $this->section('content') ?>

            <div class="row">
              <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h4>DataTables</h4>
                    <div class="card-header-action">
                        <?php if (session()->get('role') != 'admin'): ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data
                            </button>
                        <?php endif ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#rangeDate">
                            Export Laporan
                        </button>
                    </div>
                </div>
                <?= $this->include('pages/partials/modalLaba') ?>
                <?= $this->include('pages/partials/modalRangeDate') ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Author</th>
                            <th>Nama Akun</th>
                            <th>Kategori</th>
                            <th>Cabang</th>
                            <th>Dana</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1; 
                        foreach($content as $data): ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['nama_akun'] ?></td>
                            <td><?= $data['kategori'] ?></td>
                            <td><?= $data['nama_cabang'] ?></td>
                            <td><?= number_to_currency($data['dana'], 'IDR') ?></td>
                            <td>
                                <button class="btn btn-primary" onclick="updateItem(<?= $data['id'] ?>)">Update</button>
                                <button class="btn btn-danger" onclick="deleteItem(<?= $data['id'] ?>)">Delete</button>
                            </td>
                          </tr>
                        <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
          var startDate = document.getElementById('start').value;
          var endDate = document.getElementById('end').value;
          var url = `${base_url}dashboard/data/laba/export/${startDate}/${endDate}`
          window.open(url, '_blank');
      });
function Save() {
    const id = $('#id').val();
    const url = id ? `${base_url}dashboard/data/laba/update/${id}` : `${base_url}dashboard/data/laba`;

    $.ajax({
        url,
        type: 'POST',
        data: $('#form').serialize(),
        dataType: 'JSON',
        success: (response) => {
            showAlert(response.icon, response.title, response.text);
            location.reload();
        },
        error: () => {
            alert('An error occurred while processing your request.');
        },
    });
}


function updateItem(id) {
    $.ajax({
        url: `${base_url}dashboard/data/laba/update/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            $('#id').val(respond.id);
            $('#author').val(respond.author);
            $('#cabang').val(respond.cabang);
            $('#dana').val(respond.dana);
            $('#nama_akun').val(respond.nama_akun);
            $('#kategori').val(respond.kategori);
            $('#kode_akun').val(respond.kode_akun);
            $('#myModal').modal({
                backdrop: false
            });
            $('#author').prop('readonly', true);
            $('#myModal').modal('show');
            $('.modal-header button.close, .modal-footer button[data-dismiss="modal"]').on('click', function() {
                $('#myModal').modal('hide');
            });
            $('.modal-title').text(`Update Data`);
            $('#myModal').on('hidden.bs.modal', function() {
                $('#form')[0].reset();
            }); 
        },
        error: function(textStatus) {
            showAlert('error', 'Error!', textStatus)
        }
    });
}

function deleteItem(id) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin melakukan operasi ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${base_url}dashboard/data/laba/delete/${id}`,
                type: 'GET',
                dataType: 'JSON',
                success: (respond) => {
                    Swal.fire(respond.icon, respond.title, respond.text);
                    location.reload();
                },
                error: function(textStatus) {
                    Swal.fire('error', 'Error!', textStatus);
                }
            });
        }
    });
}
</script>
<?= $this->endSection() ?>