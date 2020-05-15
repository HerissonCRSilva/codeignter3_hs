<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <title>Página Inicial</title>
        <meta name="description" content="Página Inicial" />
        <link rel="shortcut icon" href="<?php echo (base_url('assets/img/favicon-2.png')) ?>" />
        <link rel="icon" href="<?php echo (base_url('assets/img/favicon-2.png')) ?> " type="image/x-icon" />

        <?php
        if (isset($links_header)) {
            foreach ($links_header as $item) {
                ?>
                <link rel="stylesheet" href="<?= $item ?>">

                <?php
            }
        }

        if (isset($scripts_header)) {
            foreach ($scripts_header as $item) {
                ?>
                <script src="<?= $item ?>" type="text/javascript"></script>
                <?php
            }
        }
        ?>

        <?php
        if (isset($alerts)) {
            foreach ($alerts as $key => $item) {
                ?><script type="text/javascript">
                    $(document).ready(function () {
                        $.notify("<?= $item ?>", '<?= $key ?>');
                    });
                </script>
                <?php
            }
        };
        ?>  
    </head>

    <body class="">
