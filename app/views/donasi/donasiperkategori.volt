<canvas id="myChart" width="400" height="100"></canvas>

<br><br>
<div class="row">
    <div class="col-md-10">
        <h2>Rekapitulasi Per Kategori:</h2>
        <h2>Kategori {{ kategori_satu['nama_kategori'] }}</h2>
    </div>
    <div class="col-md-2">
        <button type="button"class="btn btn-primary" data-toggle="modal" data-target="#addDonasi">Tambah Donasi</button>
    </div>
</div>

<div class="control-group">
    <select class="form-control" id="tanggal" name="tanggal" style="width: 100%;">
        <option value="">--Pilih Kategori Bantuan--</option>
        {% for row in countPerKategori %}
            <option value="{{ row['id'] }}">
                {{ row['nama_kategori'] }}
            </option>
        {% endfor %}
    </select>
</div>

<br><br>
<div class="table-responsive">
    <table id="tabel-donasi" class="table stripe table-stripped">
        <thead>
            <tr>
                <th>Donatur</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            {% for row in donasiPerKategori %}
            <tr>
                <td>{{ row['name'] }}</td>
                <td>{{ row['jumlah'] }}</td>
                <td>{{ row['keterangan'] }}</td>
                <td>{{ row['created_at'] }}</td>
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
        $(document).on('change', '#tanggal', function() {
            window.location.href = $(this).val();
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

<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            {% for row in countPerKategori %}
                "{{ row['nama_kategori'] }}",
            {% endfor %}
        ],
        datasets: [{
            label: '# of Votes',
            data: [
                {% for row in countPerKategori %}
                    "{{ row['count'] }}",
                {% endfor %}
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>