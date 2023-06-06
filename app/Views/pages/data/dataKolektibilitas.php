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
                    </div>
                </div>
                <?= $this->include('pages/partials/modalKolektibilitas') ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Author</th>
                            <th>Cabang</th>
                            <th>Nasabah</th>
                            <th>Dana</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
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
                            <td><?= $data['nama_cabang'] ?></td>
                            <td><?= $data['nasabah'] ?> Orang</td>
                            <td><?= $data['dana'] ? number_to_currency($data['dana'], 'IDR') : 'IDR 0' ?></td>
                            <td>   
                                <span class="badge badge-success"><?= $data['kategori'] ?></span>
                            </td>
                            <td>
                                <span class="badge badge-primary"><?= $data['waktu'] ?></span>    
                            </td>
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
$(document).ready(function() {
    $('#cabang').select2();
});

function Save() {
    const id = $('#id').val();
    const url = id ? `${base_url}dashboard/data/kolektibilitas/update/${id}` : `${base_url}dashboard/data/kolektibilitas`;

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
        url: `${base_url}dashboard/data/kolektibilitas/update/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            $('#id').val(respond.id);
            $('#cabang').val(respond.cabang);
            $('#dana').val(respond.dana);
            $('#nasabah').val(respond.nasabah);
            $('#kategori').val(respond.kategori);
            $('#waktu').val(respond.waktu);
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
                url: `${base_url}dashboard/data/kolektibilitas/delete/${id}`,
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