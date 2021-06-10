<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" 
              href="<?php echo SITE_ROOT ?>arrowchat/external.php?type=css" charset="utf-8"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gestion des activités académique</title>
        <link href = "<?php echo SITE_ROOT; ?>public/img/favicon.ico" rel = "shortcut icon" type = "image/vnd.microsoft.icon" />
        <link href="<?php echo SITE_ROOT; ?>public/css/select2.min.css" rel="stylesheet" />
        <link href="<?php echo SITE_ROOT; ?>public/css/jquery.ui.timepicker.css" rel="stylesheet" />
        <link href = "<?php echo SITE_ROOT; ?>public/css/style.css" rel = 'stylesheet' type = 'text/css' />
        <?php
        $school_css = SITE_ROOT."public/css/".strtolower(INSTITUTION_CODE).".css";
       // if(file_exists($school_css)){
         echo "<link href = '".$school_css."' rel = 'stylesheet' type = 'text/css' />";
        //}
        # <link href = "<?php echo SITE_ROOT; public/css/jquery.datetimepicker.css" rel = 'stylesheet' type = 'text/css' />
        global $css;
        if (!empty($css)) {
        echo $css;
        }
        # <script type="text/javascript" src="<?php echo SITE_ROOT; public/js/jquery.datetimepicker.js"></script>
        ?><script type="text/javascript" src="<?php echo SITE_ROOT; ?>public/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo SITE_ROOT; ?>public/js/select2.min.js"></script>
        <script src="<?php echo SITE_ROOT; ?>public/js/jquery.ui.timepicker.js"></script>
        <script type="text/javascript" src="<?php echo SITE_ROOT; ?>public/js/scripts.js"></script>
        <?php 
        if(isset($_COOKIE['langue']) && $_COOKIE['langue'] === "en"){
             echo '<script type="text/javascript" src="'.SITE_ROOT.'public/js/script_en.js"></script>';
        }else{
             echo '<script type="text/javascript" src="'.SITE_ROOT.'public/js/script_fr.js"></script>';
        }
        ?>
        <?php echo $clientsjs; ?>
        <?php
        global $_JS;
        if (!empty($_JS)) {
            echo "<script>$_JS</script>";
        }
        ?>
        <script>
            $(document).ready(function () {
                if ($(".status").length !== 0) {
<?php
if (isset($_SESSION['user']) && isset($_SESSION['anneeacademique'])) {

    echo '$(".status").html("'.__t('Utilisateur connect&eacute;').' : ' . $_SESSION['user'] . "    ".INSTITUTION_CODE
            . " / ".__t('ANNEE SCOLAIRE')." : " . $_SESSION['anneeacademique'] . '");';
}
?>
                }
            });
</script>
      </head>
    <body>
        <div id="container">
           <?php
            echo $header;
            if ($authentified) {
                echo '<div id = "page-content">' . $content . '</div>';
            } else {
                echo '<div id = "page-connect">' . $content . "</div>";
            }
            ?>

            <div id="page-footer">
                <?php echo $footer; ?>
            </div>
            <div id="loading"><p>
                    <img src="<?php echo SITE_ROOT . "public/img/loading.gif" ?>" />
                </p>
            </div>
        </div>
        <!-- Inclure late loading fichier JS -->
          <script type="text/javascript" src="<?php echo SITE_ROOT ?>arrowchat/external.php?type=djs" charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo SITE_ROOT ?>arrowchat/external.php?type=js" charset="utf-8"></script>
    </body>
</html>
<?php
/*
 *  <!-- tous les includes doivent se passer dans le controller
        Correspondant et l'obtenir sous la forme d'une variable data[];
         Pour le cas du template, c'est le controller de base
            -->
 */