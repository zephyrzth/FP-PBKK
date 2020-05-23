<a href="/donasi/index" class="btn btn-md btn-danger">Kembali</a>
<br><br>
<div class="row">
    <div class="col-md-12">
        <h2>Detail Transaksi</h2>
        <br>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-5">
                <b style="float: right">:</b>
                <b>ID Transaksi</b>
            </div>
            <div class="col-md-7">{{donasi[0]['transaksi_id']}}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-5">
                <b style="float: right">:</b>
                <b>Nama Donatur</b>
            </div>
            <div class="col-md-7">{{donasi[0]['name']}}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-5">
                <b style="float: right">:</b>
                <b>Email Donatur</b>
            </div>
            <div class="col-md-7">{{donasi[0]['email']}}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-5">
                <b style="float: right">:</b>
                <b>Username Donatur</b>
            </div>
            <div class="col-md-7">{{donasi[0]['username']}}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-5">
                <b style="float: right">:</b>
                <b>Tanggal Donasi</b>
            </div>
            <div class="col-md-7">{{donasi[0]['created_at']}}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-5">
                <b style="float: right">:</b>
                <b>Keterangan</b>
            </div>
            <div class="col-md-7">{{donasi[0]['keterangan']}}</div>
        </div>
    </div>
    
    
    <div class="col-md-12 table-responsive">
    <br>
        <table id="tabel-donasi" class="table stripe table-stripped">
            <thead>
                <tr>
                    <th>Kategori Bantuan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                {% for row in donasi %}
                <tr>
                    <td>{{ row['nama_kategori'] }}</td>
                    <td>{{ row['jumlah'] }}</td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>

    
</div>