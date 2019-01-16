<?php
require_once('app/config/config.php');
require_once('app/modules/hg-api.php');
$hg = new HgApi(HG_API_KEY);
$dollar = $hg->dollarQuotation();
if (!$hg->isErr()) {
    $variation = ($dollar['variation'] < 0) ? 'danger' : 'info';
}
?>
<!DOCTYPE <!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cotação do Dólar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>Cotação Dólar</p>
                <?php if (!$hg->isErr()) : ?>
                <p>USD: <span class='badge badge-pill badge-<?php echo ($variation); ?>'>
                        <?php echo $dollar['buy']; ?></span></p>
                <?php else : ?>
                <p>USD: <span class="badge badge-pill badge-danger">Serviço Indisponível no momento!</span></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>