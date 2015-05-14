<?php

	// defining default SEO parameters

	$seo_description = "Le site officiel de la société tunisien des services « www.servicek.net » assemble tout les secteurs de services en Tunisie dans un même espace dont il facilite la façon de chercher les différents moyens d’informations sur les divers types de produits ou de services";

	$ogp = new OpenGraphProtocol();
    $ogp->setLocale( 'fr_FR' );
    $ogp->setSiteName("Servicek.net");
    $ogp->setTitle("Servicek.net");
    $ogp->setDescription($seo_description);
    $ogp->setType( 'website' );
    $ogp->setURL( 'http://servicek.net/' );
    $ogp->setDeterminer( 'auto' );

    $ref=array(
        "twitter:title"=>"Servicek.net",
        "twitter:description"=>$seo_description,
        "twitter:image:src"=>cdn."/img/main_ref.png"
    );

	// playing requested page
	ob_start();
	include $req_page;
	$content = ob_get_contents();
	ob_end_clean();

	if($ogp->getImage()==NULL){
        $image = new OpenGraphProtocolImage();
        $image->setURL( cdn."/img/main_ref.png" );
        //$image->setSecureURL( cdn."/img/main_ref.png" );
        $image->setType( 'image/png' );
        $image->setWidth( 500 );
        $image->setHeight( 500 );

        $ogp->addImage($image);
    }

    $ogp_objects = array( $ogp );
    if(isset($article)) $ogp_objects[]=$article;

    $prefix = '';
    $meta = '';
    foreach ( $ogp_objects as $ogp_object ) {
        $prefix .= $ogp_object::PREFIX . ': ' . $ogp_object::NS . ' ';
        $meta .= $ogp_object->toHTML() . PHP_EOL;
    }

	// select and display right view
	// ...
	include "view_1.php";

?>
