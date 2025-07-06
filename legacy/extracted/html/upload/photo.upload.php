<?php 
function uploadimage($fichier,$taille,$tmp,$chemintoupload)
{
	//On param�tre la largeur, la hauteur et le poids maxi � ne pas d�passer.
	$width_maxi = "2000000000000000000000";
	$height_maxi = "100000000000000000000000";
	$taille_maxi ="100000000000000000000000";
	//bytes
	$domain='http://ways2com.com/firastravel.com/';

	@$size_tmp=getimagesize ($tmp);

	if ($fichier !="none")
	{
		if (($taille < $taille_maxi) && ($size_tmp[0] <= $width_maxi) && ($size_tmp[1] <= $height_maxi))
		{
			$point=strrpos($fichier, ".");

			if ($point)
			$extension=substr ($fichier, $point);
			else
			$extension ="";
			$nom=explode(".",$fichier);
			$date=date("ymdhis");

			//indiquer l'url relative vers le dossier d'upload
			$chemin=$chemintoupload;

			//un nouveau nom qui prend en compte la date, l'heure, les minutes 
			//et secondes est cr�e ; ainsi, aucune image ne peut �tre �cras�e sur le serveur
			//$nouveau_nom = $chemin.$nom[0].$extension;
			$datenom = date("YmdHis");
			$nouveau_nom = $chemin.$datenom.$extension;
			if (move_uploaded_file($tmp, $nouveau_nom)) 
			{
				$echec=$echec."Transfert du fichier r�ussi";
				$size=getimagesize ($nouveau_nom);
				$echec=$echec."Largeur = ".$size[0]." pixels<br/>";
				$echec=$echec."Hauteur = ".$size[1]." pixels<br/>";
				$echec=$echec."Poids = ".$taille." octets<br/>";

				// resize and save differents variant
					//mini
					$resized_name = $chemin.'mini/'.$datenom.$extension;
					$resized_width = '120';
					$resized_height = '120';
						$img = file_get_contents($domain.$nouveau_nom);
						$im = imagecreatefromstring($img);
						$width = imagesx($im);
						$height = imagesy($im);
						$newwidth = $resized_width;
						$newheight = $resized_height;
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						imagejpeg($thumb,$resized_name); //save image as jpg
						imagedestroy($thumb); 
						imagedestroy($im);
					//medium
					$resized_name = $chemin.'medium/'.$datenom.$extension;
					$resized_width = '380';
					$resized_height = '220';
						$img = file_get_contents($domain.$nouveau_nom);
						$im = imagecreatefromstring($img);
						$width = imagesx($im);
						$height = imagesy($im);
						$newwidth = $resized_width;
						$newheight = $resized_height;
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						imagejpeg($thumb,$resized_name); //save image as jpg
						imagedestroy($thumb); 
						imagedestroy($im);
					//large
					$resized_name = $chemin.'large/'.$datenom.$extension;
					$resized_width = '800';
					$resized_height = '100';
						$img = file_get_contents($domain.$nouveau_nom);
						$im = imagecreatefromstring($img);
						$width = imagesx($im);
						$height = imagesy($im);

						$ratio_orig = $width/$height;
						if ($resized_width/$resized_height > $ratio_orig) {
						   $newheight = $resized_width/$ratio_orig;
						   $newwidth = $resized_width;
						} else {
						   $newwidth = $resized_height*$ratio_orig;
						   $newheight = $resized_height;
						}
						$x_mid = $newwidth/2;  //horizontal middle
						$y_mid = $newheight/2; //vertical middle
						$thumb = imagecreatetruecolor(round($newwidth), round($newheight)); 

						imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

						imagejpeg($thumb,$resized_name); //save image as jpg
						imagedestroy($thumb); 
						imagedestroy($im);
				// fin resize and save differents variant 
			}
			else 
			{
				$taille_maxi_ko=$taille_maxi/1024;
				$echec=$echec."<span class=a2>Transfert �chou�<br/>";
				$echec=$echec."La largeur de l'image ne doit pas �tre sup�rieure � $width_maxi pixels.<br/>";
				$echec=$echec."La hauteur de l'image ne doit pas �tre sup�rieure � $height_maxi pixels.<br/>";
				$echec=$echec."Le fichier ne doit pas d�passer $taille_maxi_ko Ko.<br/></span>";
				$nouveau_nom = "NULL";
			}

		}
		else 
		{
			$taille_maxi_ko=$taille_maxi/1024;
			$echec=$echec."<span class=a2>Le fichier est trop lourd : envoi refus�<br/>
			Le fichier ne doit pas d�passer $taille_maxi_ko Ko.<br/>";
			$echec=$echec."La largeur de l'image ne doit pas �tre sup�rieure 
			� $width_maxi pixels; elle fait ici $size_tmp[0] pixels<br/>";
			$echec=$echec."La hauteur de l'image ne doit pas �tre sup�rieure 
			� $height_maxi pixels ; elle fait ici $size_tmp[1] pixels<br/></span>";
			$nouveau_nom = "NULL";
		}

	}

}


?>