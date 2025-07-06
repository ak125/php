<?php
// MOBILE, TABLETTE OU PC
$isSmartPhoneVersion = false;
$isSmartPhoneVersion = isset($_SERVER['HTTP_USER_AGENT']) && preg_match('!(mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i', $_SERVER['HTTP_USER_AGENT']) ? true : false;
//$isSmartPhoneVersion = isset($_SERVER['HTTP_USER_AGENT']) && preg_match('!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i', $_SERVER['HTTP_USER_AGENT']) ? true : false;


// MAC ou AUTRE
$isMacVersion = false;
$isMacVersion = isset($_SERVER['HTTP_USER_AGENT']) && preg_match('!(iphone|ipad|ipod|ios|webos)!i', $_SERVER['HTTP_USER_AGENT']) ? true : false;

// ALIAS ALGO
function url_title($string, $separator = '-')
{
        $_transliteration = array(
            '/ä|æ|ǽ/' => 'ae',
            '/ö|œ/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
            '/ç|ć|ĉ|ċ|č/' => 'c',
            '/Ð|Ď|Đ/' => 'D',
            '/ð|ď|đ/' => 'd',
            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
            '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
            '/Ĝ|Ğ|Ġ|Ģ/' => 'G',
            '/ĝ|ğ|ġ|ģ/' => 'g',
            '/Ĥ|Ħ/' => 'H',
            '/ĥ|ħ/' => 'h',
            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
            '/Ĵ/' => 'J',
            '/ĵ/' => 'j',
            '/Ķ/' => 'K',
            '/ķ/' => 'k',
            '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
            '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
            '/Ñ|Ń|Ņ|Ň/' => 'N',
            '/ñ|ń|ņ|ň|ŉ/' => 'n',
            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
            '/Ŕ|Ŗ|Ř/' => 'R',
            '/ŕ|ŗ|ř/' => 'r',
            '/Ś|Ŝ|Ş|Ș|Š/' => 'S',
            '/ś|ŝ|ş|ș|š|ſ/' => 's',
            '/Ţ|Ț|Ť|Ŧ/' => 'T',
            '/ţ|ț|ť|ŧ/' => 't',
            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
            '/Ý|Ÿ|Ŷ/' => 'Y',
            '/ý|ÿ|ŷ/' => 'y',
            '/Ŵ/' => 'W',
            '/ŵ/' => 'w',
            '/Ź|Ż|Ž/' => 'Z',
            '/ź|ż|ž/' => 'z',
            '/Æ|Ǽ/' => 'AE',
            '/ß/' => 'ss',
            '/Ĳ/' => 'IJ',
            '/ĳ/' => 'ij',
            '/Œ/' => 'OE',
            '/ƒ/' => 'f',
            '/ & /' => '-'
        );
        $quotedReplacement = preg_quote($separator, '/');
        $merge = array(
            '/[^\s\p{Zs}\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/[\s\p{Zs}]+/mu' => $separator,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        $map = $_transliteration + $merge;
        unset($_transliteration);
        return strtolower(trim(preg_replace(array_keys($map), array_values($map), $string)));
}
// ALIAS ALGO OPTIMISEE
function url_title_optimizer($string, $separator = '-')
{
        $_transliteration = array(
            '/ä|æ|ǽ/' => 'ae',
            '/ö|œ/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
            '/ç|ć|ĉ|ċ|č/' => 'c',
            '/Ð|Ď|Đ/' => 'D',
            '/ð|ď|đ/' => 'd',
            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
            '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
            '/Ĝ|Ğ|Ġ|Ģ/' => 'G',
            '/ĝ|ğ|ġ|ģ/' => 'g',
            '/Ĥ|Ħ/' => 'H',
            '/ĥ|ħ/' => 'h',
            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
            '/Ĵ/' => 'J',
            '/ĵ/' => 'j',
            '/Ķ/' => 'K',
            '/ķ/' => 'k',
            '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
            '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
            '/Ñ|Ń|Ņ|Ň/' => 'N',
            '/ñ|ń|ņ|ň|ŉ/' => 'n',
            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
            '/Ŕ|Ŗ|Ř/' => 'R',
            '/ŕ|ŗ|ř/' => 'r',
            '/Ś|Ŝ|Ş|Ș|Š/' => 'S',
            '/ś|ŝ|ş|ș|š|ſ/' => 's',
            '/Ţ|Ț|Ť|Ŧ/' => 'T',
            '/ţ|ț|ť|ŧ/' => 't',
            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
            '/Ý|Ÿ|Ŷ/' => 'Y',
            '/ý|ÿ|ŷ/' => 'y',
            '/Ŵ/' => 'W',
            '/ŵ/' => 'w',
            '/Ź|Ż|Ž/' => 'Z',
            '/ź|ż|ž/' => 'z',
            '/Æ|Ǽ/' => 'AE',
            '/ß/' => 'ss',
            '/Ĳ/' => 'IJ',
            '/ĳ/' => 'ij',
            '/Œ/' => 'OE',
            '/ƒ/' => 'f',
            '/ au /' => '-',
            '/ de la /' => '-',
            '/ des /' => '-',
            '/ de /' => '-',
            '/ du /' => '-',
            '/ d\'/' => '-',
            '/ le /' => '-',
            '/ la /' => '-',
            '/ les /' => '-',
            '/ l\'/' => '-',
            '/ et /' => '-',
            '/ & /' => '-'
        );
        $quotedReplacement = preg_quote($separator, '/');
        $merge = array(
            '/[^\s\p{Zs}\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/[\s\p{Zs}]+/mu' => $separator,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        $map = $_transliteration + $merge;
        unset($_transliteration);
        return strtolower(trim(preg_replace(array_keys($map), array_values($map), $string)));
}
?>
<?php
switch ($typefile)
{
    case 'standard':
    {
        
        $query_mta = "SELECT MTA_TITLE, MTA_DESCRIP, MTA_KEYWORDS, MTA_RELFOLLOW, MTA_ARIANE, MTA_ALIAS, MTA_H1, MTA_CONTENT 
            FROM ___META_TAGS_ARIANE 
            WHERE MTA_ALIAS = '$arianefile' ";
        $request_mta = $conn->query($query_mta);
        if ($request_mta->num_rows > 0) 
        {
            $result_mta = $request_mta->fetch_assoc();
            // META
            $pagetitle = $result_mta['MTA_TITLE'];
            $pagedescription = $result_mta['MTA_DESCRIP'];
            $pagekeywords = $result_mta["MTA_KEYWORDS"];
            // ROBOT
            $relfollow = $result_mta['MTA_RELFOLLOW'];
            if($relfollow==1)
                $pageRobots="index, follow";
            else
                $pageRobots="noindex, nofollow";
            // ARIANE
            $arianetitle = $result_mta['MTA_ARIANE'];
            // ALIAS
            $pagealias = $result_mta["MTA_ALIAS"];
            // CONTENT
            $pageh1 = $result_mta['MTA_H1'];
            $pagecontent = $result_mta['MTA_CONTENT'];
        }

    break;
    }
    case 'my':
    {
        $pagetitle = "Mon Compte";
        $pagedescription = "Mon Compte";
        $pagekeywords  = "Mon Compte";
        // ROBOT
        $relfollow = 0;
        if($relfollow==1)
            $pageRobots="index, follow";
        else
            $pageRobots="noindex, nofollow";
        // ARIANE
        $arianetitle = "Mon compte";
        // ALIAS
        $pagealias = "account/";
        // CONTENT
        $pageh1  = "Bienvenue ".$_SESSION['myakciv']." ".$_SESSION['myakprenom']." ".$_SESSION['myaknom'];
        // PAGE AUXILIAIRE
        if($arianefile=="msg") { $pageh1  = "mes messages"; }
        if($arianefile=="order") { $pageh1  = "mes commandes"; }
        if($arianefile=="pswrd.change") { $pageh1  = "changer mon mot de passe"; }
        if($arianefile=="adr.f") { $pageh1  = "adresse de facturation"; }
        if($arianefile=="adr.l") { $pageh1  = "adresses de livraison"; }
    break;
    }
    case 'blog':
    {
        
        $query_mta = "SELECT MTA_TITLE, MTA_DESCRIP, MTA_KEYWORDS, MTA_RELFOLLOW, MTA_ARIANE, MTA_ALIAS, MTA_H1, MTA_CONTENT 
            FROM __BLOG_META_TAGS_ARIANE 
            WHERE MTA_ALIAS = '$arianefile' ";
        $request_mta = $conn->query($query_mta);
        if ($request_mta->num_rows > 0) 
        {
            $result_mta = $request_mta->fetch_assoc();
            // META
            $pagetitle = $result_mta['MTA_TITLE'];
            $pagedescription = $result_mta['MTA_DESCRIP'];
            $pagekeywords = $result_mta["MTA_KEYWORDS"];
            // ROBOT
            $relfollow = $result_mta['MTA_RELFOLLOW'];
            if($relfollow==1)
                $pageRobots="index, follow";
            else
                $pageRobots="noindex, nofollow";
            // ARIANE
            $arianetitle = $result_mta['MTA_ARIANE'];
            // ALIAS
            $pagealias = $result_mta["MTA_ALIAS"];
            // CONTENT
            $pageh1 = $result_mta['MTA_H1'];
            $pagecontent = $result_mta['MTA_CONTENT'];
        }

    break;
    }
    default :
    {
        // les différents titres standarisés de la page d'accueil
        //$hometitle='Vente de pièces détachées automobile en ligne';
    break;
    }
}
?>