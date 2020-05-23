<div class="page-header">
    <h2>Registrasi Donasi Dhana</h2>
</div>

<form action="/register" role="form" method="post">
    <fieldset>
        <div class="control-group">
            <label for="name" class="control-label">Nama Lengkap</label>
            <div class="controls">
                <input type="text" name="name" id="name" class="form-control" required>
                <p class="help-block" style="color:red">(required)</p>
            </div>
        </div>

        <div class="control-group">
            <label for="username" class="control-label">Username</label>
            <div class="controls">
                <input type="text" name="username" id="username" class="form-control" required>
                <p class="help-block" style="color:red">(required)</p>
            </div>
        </div>

        <div class="control-group">
            <label for="email" class="control-label">Email</label>
            <div class="controls">
                <input type="email" name="email" id="email" class="form-control" required>
                <p class="help-block" style="color:red">(required)</p>
            </div>
        </div>

        <div class="control-group">
            <label for="password" class="control-label">Password</label>
            <div class="controls">
                <input type="password" name="password" id="password" class="form-control" required>
                <p class="help-block" style="color:red">(minimum 8 characters)</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="repeatPassword">Konfirmasi Password</label>
            <div class="controls">
                <input type="password" name="repeatPassword" id="repeatPassword" class="form-control" required>
            </div>
        </div>
        <br>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </fieldset>
</form>
