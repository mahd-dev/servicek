<?php
	// defining seo parameters
	if(isset($ogp)){
        $ogp->setTitle( "A propos de Servicek.net" );
        $ogp->setURL( url_root."/about" );

        $ref["twitter:title"]="A propos de Servicek.net";
        
    }

	// select and display right view
	// ...
	
	include "view_1.php";
?>
