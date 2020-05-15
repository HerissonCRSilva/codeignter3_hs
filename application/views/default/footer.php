<?php
if (isset($links_footer)) {
    foreach ($links_footer as $item) {
        ?>
        <link rel="stylesheet" href="<?= $item ?>">

        <?php
    }
}

if (isset($scripts_footer)) {
    foreach ($scripts_footer as $item) {
        ?>
        <script src="<?= $item ?>" type="text/javascript"></script>
        <?php
    }
}
?>
</body>
</html>