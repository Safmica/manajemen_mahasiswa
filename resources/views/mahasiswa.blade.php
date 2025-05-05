<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Mahasiswa</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <h3>Data Mahasiswa</h3>

    <form id="form-tambah" class="mb-4">
        <div class="row g-2">
            <div class="col-md-2"><input type="text" class="form-control" name="nim" placeholder="NIM" required>
            </div>
            <div class="col-md-3"><input type="text" class="form-control" name="nama" placeholder="Nama" required>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="fakultas"></select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="jurusan"></select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="prodi_id" id="prodi"></select>
            </div>
            <div class="col-md-3"><input type="text" class="form-control" name="alamat" placeholder="Alamat"></div>
            <div class="col-md-2">
                <select class="form-select" name="angkatan">
                    <script>
                        const tahun = new Date().getFullYear();
                        for (let i = 2018; i <= tahun; i++) {
                            document.write(`<option value="${i}">${i}</option>`);
                        }
                    </script>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered" id="tabel-mahasiswa">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Prodi</th>
                <th>Alamat</th>
                <th>Angkatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
    </table>

    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mahasiswa</h5>
                </div>
                <div class="modal-body">
                    <form id="form-edit">
                        <input type="hidden" name="id">
                        <input type="text" name="nim" class="form-control mb-2" placeholder="NIM">
                        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama">
                        <input type="text" name="alamat" class="form-control mb-2" placeholder="Alamat">
                        <select name="angkatan" class="form-select mb-2">
                            <script>
                                for (let i = 2018; i <= tahun; i++) {
                                    document.write(`<option value="${i}">${i}</option>`);
                                }
                            </script>
                        </select>
                        <select name="fakultas_id" id="edit-fakultas" class="form-select mb-2"></select>
                        <select name="jurusan_id" id="edit-jurusan" class="form-select mb-2"></select>
                        <select name="prodi_id" id="edit-prodi" class="form-select mb-2"></select>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                loadFakultas();
                loadMahasiswa();

                function loadFakultas() {
                    $.get('/api/fakultas', function(data) {
                        $('#fakultas').html('<option value="">Pilih Fakultas</option>');
                        data.forEach(f => $('#fakultas').append(`<option value="${f.id}">${f.nama}</option>`));
                    });
                }

                $('#fakultas').on('change', function() {
                    $.get('/api/jurusan?fakultas_id=' + this.value, function(data) {
                        $('#jurusan').html('<option value="">Pilih Jurusan</option>');
                        data.forEach(j => $('#jurusan').append(
                            `<option value="${j.id}">${j.nama}</option>`));
                    });
                });

                $('#jurusan').on('change', function() {
                    $.get('/api/prodi?jurusan_id=' + this.value, function(data) {
                        $('#prodi').html('<option value="">Pilih Prodi</option>');
                        data.forEach(p => $('#prodi').append(
                            `<option value="${p.id}">${p.nama}</option>`));
                    });
                });

                $('#form-tambah').on('submit', function(e) {
                    e.preventDefault();
                    let form = $(this);
                    $.ajax({
                        url: '/api/mahasiswa',
                        type: 'POST',
                        data: form.serialize(),
                        success: function() {
                            form.trigger('reset');
                            loadMahasiswa();
                        },
                        error: function(res) {
                            alert('Gagal: ' + JSON.stringify(res.responseJSON.errors));
                        }
                    });
                });

                function loadMahasiswa() {
                    $.get('/api/mahasiswa', function(data) {
                        let rows = '';
                        data.forEach(m => {
                            rows += `<tr>
          <td>${m.nim}</td><td>${m.nama}</td>
          <td>${m.prodi.jurusan.fakultas.nama}</td>
          <td>${m.prodi.jurusan.nama}</td>
          <td>${m.prodi.nama}</td>
          <td>${m.alamat || '-'}</td><td>${m.angkatan}</td>
          <td>
            <button class="btn btn-warning btn-sm edit" data-id="${m.id}">Edit</button>
            <button class="btn btn-danger btn-sm hapus" data-id="${m.id}">Hapus</button>
          </td></tr>`;
                        });
                        $('#tabel-mahasiswa tbody').html(rows);
                    });
                }

                $(document).on('click', '.hapus', function() {
                    if (confirm('Yakin hapus?')) {
                        $.ajax({
                            url: '/api/mahasiswa/' + $(this).data('id'),
                            type: 'DELETE',
                            success: function() {
                                loadMahasiswa();
                            }
                        });
                    }
                });

                function loadFakultas(selectedFakultasId = '') {
                    $.get('/api/fakultas', function(fakultasList) {
                        let fakultasSelect = $('#edit-fakultas');
                        fakultasSelect.empty().append('<option value="">Pilih Fakultas</option>');
                        fakultasList.forEach(f => {
                            fakultasSelect.append(`<option value="${f.id}">${f.nama}</option>`);
                        });
                        if (selectedFakultasId) fakultasSelect.val(selectedFakultasId);
                    });
                }

                function loadJurusan(fakultasId, selectedJurusanId = '') {
                    $.get('/api/jurusan?fakultas_id=' + fakultasId, function(jurusanList) {
                        let jurusanSelect = $('#edit-jurusan');
                        jurusanSelect.empty().append('<option value="">Pilih Jurusan</option>');
                        jurusanList.forEach(j => {
                            jurusanSelect.append(`<option value="${j.id}">${j.nama}</option>`);
                        });
                        if (selectedJurusanId) jurusanSelect.val(selectedJurusanId);
                    });
                }

                function loadProdi(jurusanId, selectedProdiId = '') {
                    $.get('/api/prodi?jurusan_id=' + jurusanId, function(prodiList) {
                        let prodiSelect = $('#edit-prodi');
                        prodiSelect.empty().append('<option value="">Pilih Prodi</option>');
                        prodiList.forEach(p => {
                            prodiSelect.append(`<option value="${p.id}">${p.nama}</option>`);
                        });
                        if (selectedProdiId) prodiSelect.val(selectedProdiId);
                    });
                }

                $('#edit-fakultas').on('change', function() {
                    let fakultasId = $(this).val();
                    $('#edit-jurusan').empty();
                    $('#edit-prodi').empty();
                    if (fakultasId) {
                        loadJurusan(fakultasId);
                    }
                });

                $('#edit-jurusan').on('change', function() {
                    let jurusanId = $(this).val();
                    $('#edit-prodi').empty();
                    if (jurusanId) {
                        loadProdi(jurusanId);
                    }
                });

                $(document).on('click', '.edit', function() {
                    let id = $(this).data('id');
                    $.get(`/api/mahasiswa/${id}`, function(data) {
                        $('#form-edit [name=id]').val(data.id);
                        $('#form-edit [name=nim]').val(data.nim);
                        $('#form-edit [name=nama]').val(data.nama);
                        $('#form-edit [name=alamat]').val(data.alamat);
                        $('#form-edit [name=angkatan]').val(data.angkatan);

                        let fakultasId = data.prodi.jurusan.fakultas.id;
                        let jurusanId = data.prodi.jurusan.id;
                        let prodiId = data.prodi.id;

                        loadFakultas(fakultasId);
                        loadJurusan(fakultasId, jurusanId);
                        loadProdi(jurusanId, prodiId);

                        $('#modalEdit').modal('show');
                    });
                });



                $('#form-edit').on('submit', function(e) {
                    e.preventDefault();
                    let id = $('#form-edit [name=id]').val();
                    $.ajax({
                        url: '/api/mahasiswa/' + id,
                        type: 'PUT',
                        data: $(this).serialize(),
                        success: function() {
                            $('#modalEdit').modal('hide');
                            loadMahasiswa();
                        }
                    });
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
