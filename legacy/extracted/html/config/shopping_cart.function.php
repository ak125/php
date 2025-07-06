<?php
/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/*                Fonctions de base de gestion du panier                   */
/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
function ajout($select)
{
    $ajout = false;
    if(!isset($_SESSION['amcnkCart']['verrouille']) || $_SESSION['amcnkCart']['verrouille'] == false)
    {
        if(!verif_panier($select['id']))
        { 
            $_SESSION['amcnkCart']['id_article'][] =& $select['id'];
            $_SESSION['amcnkCart']['qte'][] =& $select['qte'];
            $_SESSION['amcnkCart']['prix'][] =& $select['prix'];
            $_SESSION['amcnkCart']['consigne'][] =& $select['consigne'];
            $_SESSION['amcnkCart']['urltakentoadd'][] =& $select['urltakentoadd'];	
            $ajout = true;
        }
        /*else
        {
            $ajout = modif_qte($select['id'],$select['qte']);
        }*/

    }
    return $ajout;
}

function supprim_article($ref_article, $reindex = true)
{
    $suppression = false;
    if(!isset($_SESSION['amcnkCart']['verrouille']) || $_SESSION['amcnkCart']['verrouille'] == false)
    {
        $aCleSuppr = array_keys($_SESSION['amcnkCart']['id_article'], $ref_article);

        /* sortie la cl� a �t� trouv�e */
        if (!empty ($aCleSuppr))
        {
            /* on traverse le panier pour supprimer ce qui doit l'�tre */
            foreach ($_SESSION['amcnkCart'] as $k=>$v)
            {
                foreach($aCleSuppr as $v1)
                {
                    unset($_SESSION['amcnkCart'][$k][$v1]);    // remplace la ligne foireuse
                }
                /* R�indexation des cl�s du panier si l'option $reindex a �t� laiss�e � true */
                if($reindex == true)
                {
                    $_SESSION['amcnkCart'][$k] = array_values($_SESSION['amcnkCart'][$k]);
                }
                $suppression = true;
            }
        }
        else
        {
            $suppression = "absent";
        }
    }
    return $suppression;
}


function verif_panier($ref_article)
{
    /* On initialise la variable de retour */
    $present = false;
    /* On v�rifie les num�ros de r�f�rences des articles et on compare avec l'article � v�rifier */
    if( @count($_SESSION['amcnkCart']['id_article']) > 0 && array_search($ref_article,$_SESSION['amcnkCart']['id_article']) !== false)
    {
        $present = true;
    }
    return $present;
}


function paiementAccepte()
{
    unset($_SESSION['amcnkCart']);
}
?> 