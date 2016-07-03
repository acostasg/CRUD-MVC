<?php
require_once '../app/views/templates/header.php';
?>
<br>
<div class="col-sm-offset-3 col-sm-6">
    <form role="form" action="upload" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Upload your .Tab file:</label>

            <input type="file" name="file" id="file">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
<?php
require_once '../app/views/templates/footer.php';
?>