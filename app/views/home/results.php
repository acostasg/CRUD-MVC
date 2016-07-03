<?php
require_once '../app/views/templates/header.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Import data</div>
                    <div class="panel-body">
                        <h2>Total products per month</h2>
                        <table class="table table-striped">
                            <tr>
                                <td><strong>Month</strong></td>
                                <td><strong>Count Products</strong></td>
                            </tr>
                            <?php foreach($data['countPerMonth'] as $product) { ?>
                            <tr>
                                <td><?php echo $product['month']; ?></td>
                                <td><?php echo $product['count']; ?></td>
                            </tr>
                        <?php }?>
                            </table>
                        <br>
                        <h2>Total products per Merchant</h2>
                        <table class="table table-striped">
                            <tr>
                                <td><strong>Merchant</strong></td>
                                <td><strong>Total Products</strong></td>
                            </tr>
                            <?php foreach($data['countPerMerchant'] as $merchant) { ?>
                                <tr>
                                    <td><?php echo $merchant['name']; ?></td>
                                    <td><?php echo $merchant['count']; ?></td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once '../app/views/templates/footer.php';
?>