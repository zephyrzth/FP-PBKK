<div class="row">
    <div class="col-md-10">
        <h2>Rekapitulasi Total Semua Donasi</h2>
    </div>
    <div class="col-md-2">
        <button type="button"class="btn btn-primary" data-toggle="modal" data-target="#addDonasi">Tambah Donasi</button>
    </div>
</div>

<br><br>
<div class="table-responsive">
    <table id="tabel-donasi" class="table stripe table-stripped">
        <thead>
            <tr>
                <th>Donatur</th>
                <th>Kategori Bantuan</th>
                <th>Tanggal</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            {% for row in donasis %}
            <tr>
                <td>{{ row.users.name }}</td>
                <td>{% for namakategori in row.getNamaBantuanAsArray() %}
                    {{ namakategori }}, 
                {% endfor %}</td>
                <td>{{ row.created_at }}</td>
                <td><a href="/donasi/show/{{ row.id }}" class="btn btn-success">Detail</a></td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
</div>

<div class="modal fade" id="addDonasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Form Tambah Donasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/donasi/store" method="post">
                <div class="modal-body">
                    <div class="row">
                    {% for row in kategori_bantuans %}
                        <div class="control-group col-12 checkbox">
                            <label><input type="checkbox" name="kategori[]" value="{{ row.id }}" id="checkbox-{{ row.id }}" onclick="showForm(this)"> {{ row.nama_kategori }}</label>
                        </div>
                        <div class="control-group col-12" style="display: none;" id="div_jumlah_{{ row.id }}">
                            <label for="jumlah{{ row.id }}" class="control-label">Jumlah (satuan rupiah jika uang, kg jika bahan makanan, jumlah jika bantuan lain)</label>
                            <div class="controls">
                                <input type="number" name="jumlah_{{ row.id }}" id="jumlah_{{ row.id }}" class="form-control">
                            </div>
                        </div>
                    {% endfor %}
                        <div class="control-group col-12">
                            <label for="keterangan" class="control-label">Keterangan / Deskripsi / Pesan</label>
                            <div class="controls">
                                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tabel-donasi').DataTable({
            "order": [],
            "autoWidth": true,
            "columnDefs": [ {
                "targets": 0,
                "orderable": false
            }]
        });
    });
</script>

<script>
function showForm(checknya) {
    var value = checknya.value;
    var theDiv = document.getElementById('div_jumlah_' + value);
    if (checknya.checked == true) {
        console.log(theDiv);
        theDiv.style.display = 'block';
    } else {
        console.log(theDiv);
        theDiv.style.display = 'none';
    }
}
</script>