<?php
session_start();
// parametres relatifs à la page
$typefile="fiche";
// fichier de recuperation et d'affichage des parametres de la base de données
require_once('config/sql.conf.php');
// parametres relatifs à la page
$arianefile="fiche";
// fichier de recuperation et d'affichage des parametres du site
require_once('config/meta.conf.php');

// article à ajouter
$this_piece_id = $_GET['piece_id'];
$this_type_id = $_GET['type_id'];
?>
<?php
// QUERY SELECTOR
$query_selector = "SELECT PIECE_REF, PIECE_DES, PIECE_NAME, PIECE_NAME_COMP, 
    COALESCE(PSF_SIDE,PIECE_NAME_SIDE) AS PIECE_NAME_SIDE, PIECE_DISPLAY, 
    PIECE_HAS_IMG,  
    PM_NAME, PM_LOGO, COALESCE(PIECE_DES,PM_QUALITY) AS PM_QUALITY
    FROM PIECES_RELATION_TYPE
    INNER JOIN PIECES_SIDE_FILTRE ON PSF_ID = RTP_PSF_ID
    INNER JOIN PIECES ON PIECE_ID = RTP_PIECE_ID
    INNER JOIN PIECES_MARQUE ON PM_ID = PIECE_PM_ID
    WHERE RTP_TYPE_ID = $this_type_id AND RTP_PIECE_ID = $this_piece_id";
$request_selector = $conn->query($query_selector);
if ($request_selector->num_rows > 0) 
{
    $result_selector = $request_selector->fetch_assoc();
    if($result_selector['PIECE_DISPLAY']==1)
    {
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////                           200                       ////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
        // META
        $pagetitle = $result_selector['PIECE_NAME']." ".$result_selector['PIECE_NAME_SIDE']." ".$result_selector['PIECE_NAME_COMP']." ".$result_selector['PM_NAME']." ".$result_selector['PIECE_REF'];
        $pagedescription = $result_selector['PIECE_NAME']." ".$result_selector['PIECE_NAME_SIDE']." ".$result_selector['PIECE_NAME_COMP']." ".$result_selector['PM_NAME']." ".$result_selector['PIECE_REF'];
        $pagekeywords = $result_selector['PIECE_NAME']." ".$result_selector['PIECE_NAME_SIDE']." ".$result_selector['PIECE_NAME_COMP']." ".$result_selector['PM_NAME']." ".$result_selector['PIECE_REF'];
        // CONTENT
        $pageh1 = $result_selector['PIECE_NAME']." ".$result_selector['PIECE_NAME_SIDE']." ".$result_selector['PIECE_NAME_COMP']." ".$result_selector['PM_NAME']." ".$result_selector['PIECE_REF'];
        $pagecontent = $result_selector['PIECE_NAME']." ".$result_selector['PIECE_NAME_SIDE']." ".$result_selector['PIECE_NAME_COMP']." ".$result_selector['PM_NAME']." ".$result_selector['PIECE_REF'];
        // ROBOT
        $pageRobots="noindex, nofollow";
        $relfollow = 0;
?>
<!doctype html>
<html lang="<?php echo $hr; ?>">
<head>
<meta charset="utf-8">
<title><?php  echo $pagetitle; ?></title>
<meta name="title" content="<?php  echo $pagetitle; ?>" />
<meta name="description" content="<?php  echo $pagedescription; ?>" />
<meta name="keywords" content="<?php  echo $pagekeywords; ?>"/>
<meta name="robots" content="<?php echo $pageRobots; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Url de base du site -->
<base href="<?php echo $domain; ?>">
<!-- CSS -->
<style>
@import url('https://fonts.googleapis.com/css?family=Oswald:300,400,700&display=swap');
</style>
<link href="/system/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
<link href="/assets/css/<?php echo $hr;?>.css" rel="stylesheet" media="all">
</head>
<body class="BODY-MODAL">

<div class="container-fluid titleFiche text-center w-100">
    <h1><?php  echo $pageh1; ?></h1>
</div>
<div class="container-fluid modalPageFiche w-100">

    <div class="row">
        <div class="col-md-5 pl-md-0">

            <?php
            if($result_selector['PIECE_HAS_IMG']==1)
            {
                $query_item_list_img = "SELECT CONCAT('rack/',PMI_FOLDER,'/',PMI_NAME,'.webp') AS PIECE_IMG 
                    FROM PIECES_MEDIA_IMG WHERE PMI_PIECE_ID = $this_piece_id AND PMI_DISPLAY = 1";
                $request_item_list_img = $conn->query($query_item_list_img);
                if($request_item_list_img->num_rows)
                {
                    $result_item_list_img = $request_item_list_img->fetch_assoc();
                    $photo_link = $result_item_list_img['PIECE_IMG'];
                    $photo_alt = "";
                    $photo_title = "";
                }
                else
                {
                    $photo_link = "upload/articles/no.png";
                    $photo_alt = "";
                    $photo_title = "";
                }
                ?>
                <img src="<?php echo $domain; ?>/<?php echo $photo_link; ?>" alt="<?php echo $photo_alt; ?>" title="<?php echo $photo_title; ?>" class="w-100" />
                <?php
            }
            ?>

        </div>
        <div class="col-md-7 pt-3 pt-md-0">

                <div class="row">
                    <div class="col-12 pl-0">
                        <h2>Critères techniques</h2>
                    </div>
                    <?php
                    $query_item_list_technical = "SELECT DISTINCT PCL_CRI_ID, PCL_CRI_CRITERIA, PC_CRI_VALUE AS PCL_VALUE,
                        PCL_CRI_UNIT, PCL_SORT, PCL_LEVEL
                        FROM PIECES_CRITERIA
                        INNER JOIN PIECES_CRITERIA_LINK ON PCL_CRI_ID = PC_CRI_ID AND PCL_PG_PID = PC_PG_PID AND PC_DISPLAY = 1
                        WHERE PC_PIECE_ID = $this_piece_id AND PCL_DISPLAY = 1 
                        UNION 
                        SELECT DISTINCT PCL_CRI_ID, PCL_CRI_CRITERIA, RCP_CRI_VALUE AS PCL_VALUE, PCL_CRI_UNIT, PCL_SORT, PCL_LEVEL
                        FROM PIECES_RELATION_CRITERIA
                        INNER JOIN PIECES_CRITERIA_LINK ON PCL_CRI_ID = RCP_CRI_ID AND PCL_PG_PID = RCP_PG_PID AND RCP_DISPLAY = 1
                        WHERE RCP_TYPE_ID = $this_type_id AND RCP_PIECE_ID = $this_piece_id AND PCL_DISPLAY = 1 
                        ORDER BY PCL_LEVEL, PCL_SORT, PCL_CRI_CRITERIA";
                    $request_item_list_technical = $conn->query($query_item_list_technical);
                    if($request_item_list_technical->num_rows)
                    {
                        while($result_item_list_technical= $request_item_list_technical->fetch_assoc())
                        {
                        ?>
                        <div class="col-7 fiche-criteria-title pl-0">
                            <?php echo $result_item_list_technical["PCL_CRI_CRITERIA"]; ?>
                        </div>
                        <div class="col-5 fiche-criteria-value pl-0">
                            <?php echo $result_item_list_technical["PCL_VALUE"]." <span>".$result_item_list_technical["PCL_CRI_UNIT"]."</span>"; ?>
                        </div>
                        <?php
                        }
                    }
                    ?>
                </div>

        </div>
    </div>

    <?php
    $query_item_list_technical = "SELECT DISTINCT PLI_QUANTITY , PIECE_NAME  FROM PIECES_LIST
        INNER JOIN PIECES ON PIECE_ID = PLI_PIECE_COMPONENT
        WHERE PLI_PIECE_ID = $this_piece_id ORDER BY PLI_SORT;";
    $request_item_list_technical = $conn->query($query_item_list_technical);
    if($request_item_list_technical->num_rows)
    {
    ?>
    <div class="row">
        <div class="col-12 padding37">

                <div class="row">
                    <div class="col-12 pl-0">
                        <h2>Composition</h2>
                    </div>
                    <?php
                    while($result_item_list_technical= $request_item_list_technical->fetch_assoc())
                    {
                    ?>
                    <div class="col-12 pl-0">
                        <?php echo $result_item_list_technical["PLI_QUANTITY"]." x ".$result_item_list_technical["PIECE_NAME"]; ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>

        </div>
    </div>
    <?php
    }
    ?>

    <div class="row">
        <div class="col-sm-6">
            <?php
            $query_item_list_oem = "SELECT DISTINCT PRB_ID, PRB_NAME 
                FROM PIECES_REF_OEM
                INNER JOIN PIECES_REF_BRAND ON PRB_ID = PRO_PRB_ID
                WHERE PRO_PIECE_ID = $this_piece_id ORDER BY PRB_NAME";
            $request_item_list_oem = $conn->query($query_item_list_oem);
            if($request_item_list_oem->num_rows)
            {
            ?>
            <div class="row">
                <div class="col-12 padding37">

                    <div class="row">
                        <div class="col-12 pl-0">
                            <h2>References OEM</h2>
                        </div>
                    <?php
                    while($result_item_list_oem= $request_item_list_oem->fetch_assoc())
                    {
                        $prb_id_this = $result_item_list_oem["PRB_ID"];

                        $query_item_list_oem_ref = "SELECT PRO_OEM 
                            FROM PIECES_REF_OEM
                            WHERE PRO_PIECE_ID = $this_piece_id AND PRO_PRB_ID = $prb_id_this";
                        $request_item_list_oem_ref = $conn->query($query_item_list_oem_ref);
                        if($request_item_list_oem_ref->num_rows)
                        {
                        ?>
                        <div class="col-12 fiche-monte-marque">
                        <?php echo $result_item_list_oem["PRB_NAME"]; ?>
                        </div>
                        <?php
                        $linecount = 1;
                        while($result_item_list_oem_ref= $request_item_list_oem_ref->fetch_assoc())
                        {
                        ?>
                            <div class="col-12 fiche-monte-motorisation-<?php echo $linecount; ?>">
                            <?php echo $result_item_list_oem_ref["PRO_OEM"]; ?>
                            </div>
                        <?php
                        if($linecount==1) $linecount=2; else $linecount=1;
                        }
                        }

                    }
                    ?>
                    </div>

                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="col-sm-6">
            <?php
            $query_item_list_oemeq = "SELECT DISTINCT PRB_ID, PRB_NAME
                FROM PIECES_REF_SEARCH
                INNER JOIN PIECES_REF_BRAND ON PRB_ID = PRS_PRB_ID AND PRS_KIND IN (4,2)
                WHERE PRS_PIECE_ID = $this_piece_id ORDER BY PRB_NAME";
            $request_item_list_oemeq = $conn->query($query_item_list_oemeq);
            if($request_item_list_oemeq->num_rows)
            {
            ?>
            <div class="row pl-sm-0 ml-sm-0">
                <div class="col-12 padding37">

                    <div class="row">
                        <div class="col-12 pl-0">
                            <h2>References Equipementiers</h2>
                        </div>
                    <?php
                    while($result_item_list_oemeq= $request_item_list_oemeq->fetch_assoc())
                    {
                        $prb_id_this = $result_item_list_oemeq["PRB_ID"];

                        $query_item_list_oemeq_ref = "SELECT PRS_REF
                            FROM PIECES_REF_SEARCH
                            WHERE PRS_PIECE_ID = $this_piece_id AND PRS_PRB_ID = $prb_id_this";
                        $request_item_list_oemeq_ref = $conn->query($query_item_list_oemeq_ref);
                        if($request_item_list_oemeq_ref->num_rows)
                        {
                        ?>
                        <div class="col-12 fiche-monte-marque">
                        <?php echo $result_item_list_oemeq["PRB_NAME"]; ?>
                        </div>
                        <?php
                        $linecount = 1;
                        while($result_item_list_oemeq_ref= $request_item_list_oemeq_ref->fetch_assoc())
                        {
                        ?>
                            <div class="col-12 fiche-monte-motorisation-<?php echo $linecount; ?>">
                            <?php echo $result_item_list_oemeq_ref["PRS_REF"]; ?>
                            </div>
                        <?php
                        if($linecount==1) $linecount=2; else $linecount=1;
                        }
                        }

                    }
                    ?>
                    </div>

                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    

    <?php
    $query_item_list_marque = "SELECT DISTINCT MARQUE_ID , MARQUE_NAME FROM
        PIECES_RELATION_TYPE
        INNER JOIN AUTO_TYPE ON TYPE_ID = RTP_TYPE_ID
        INNER JOIN AUTO_MARQUE ON MARQUE_ID = TYPE_MARQUE_ID
        WHERE RTP_PIECE_ID = $this_piece_id AND TYPE_DISPLAY = 1 AND MARQUE_DISPLAY = 1
        ORDER BY MARQUE_SORT";
    $request_item_list_marque = $conn->query($query_item_list_marque);
    if($request_item_list_marque->num_rows)
    {
    ?>
    <div class="row">
        <div class="col-12 padding37">

            <div class="row">
                <div class="col-12 pl-0">
                    <h2>Peut être montée sur</h2>
                </div>
            <?php
            while($result_item_list_marque= $request_item_list_marque->fetch_assoc())
            {
                $marque_id_this = $result_item_list_marque["MARQUE_ID"];
                ?>
                <div class="col-12 fiche-monte-marque">
                <?php echo $result_item_list_marque["MARQUE_NAME"]; ?>
                </div>



<?php
$query_item_list_modele = "SELECT DISTINCT MODELE_ID , MODELE_NAME FROM
    PIECES_RELATION_TYPE
    INNER JOIN AUTO_TYPE ON TYPE_ID = RTP_TYPE_ID
    INNER JOIN AUTO_MODELE ON MODELE_ID = TYPE_MODELE_ID
    WHERE RTP_PIECE_ID = $this_piece_id  AND TYPE_DISPLAY = 1 AND TYPE_MARQUE_ID = $marque_id_this AND MODELE_DISPLAY = 1
    ORDER BY MODELE_SORT";
$request_item_list_modele = $conn->query($query_item_list_modele);
if($request_item_list_modele->num_rows)
{
$linecount = 1;
while($result_item_list_modele= $request_item_list_modele->fetch_assoc())
{
$modele_id_this = $result_item_list_modele["MODELE_ID"];
$modele_name_this = $result_item_list_modele["MODELE_NAME"];
    $query_item_list_type = "SELECT DISTINCT TYPE_ID , TYPE_NAME, TYPE_FUEL , TYPE_POWER_PS FROM
        PIECES_RELATION_TYPE
        INNER JOIN AUTO_TYPE ON TYPE_ID = RTP_TYPE_ID
        WHERE RTP_PIECE_ID = $this_piece_id AND TYPE_DISPLAY = 1 AND TYPE_MODELE_ID = $modele_id_this
        ORDER BY TYPE_SORT";
    $request_item_list_type = $conn->query($query_item_list_type);
    if($request_item_list_type->num_rows)
    {
    while($result_item_list_type= $request_item_list_type->fetch_assoc())
    {
    ?>
        <div class="col-4 fiche-monte-motorisation-<?php echo $linecount; ?>">
        <?php echo $modele_name_this; ?>
        </div>
        <div class="col-3 fiche-monte-motorisation-<?php echo $linecount; ?>">
        <?php echo $result_item_list_type["TYPE_NAME"]; ?>
        </div>
        <div class="col-3 fiche-monte-motorisation-<?php echo $linecount; ?>">
        <?php echo $result_item_list_type["TYPE_FUEL"]; ?>
        </div>
        <div class="col-2 fiche-monte-motorisation-<?php echo $linecount; ?>">
        <?php echo $result_item_list_type["TYPE_POWER_PS"]; ?> Ch
        </div>
    <?php
    if($linecount==1) $linecount=2; else $linecount=1;
    }
    }
}
}
?>



                <?php
            }
            ?>
            </div>

        </div>
    </div>
    <?php
    }
    ?>
    
</div>

</body>
</html>
<!-- JS Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="/system/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////                         FIN 200                     ////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
    }
    else
    {
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////                           412                       ////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
?>
412
<?php
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////                         FIN 412                     ////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
    }
}
else
{
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////                           410                       ////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
?>
410
<?php
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* ////////////                         FIN 410                     ////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////// */
}
?>