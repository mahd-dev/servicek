<link href="<?php echo url_root;?>/pages/company/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo cdn;?>/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css"/>

<?php if(!$is_contracted){?>
<div class="row">
	<div class="col-md-12">
		<div class="note note-warning">
			<h4 class="block">Cette société n'est pas pubiée</h4>
			<p>
				 Cette société n'est pas disponible au public, vous seul vous pouvez y accéder.<br>
				 Vous ne disposez pas encore de contrat de publication.<br><br>
				 <a class="btn green ajaxify" href="<?php echo url_root."/".$company->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }?>
<div class="row">
	<div class="profile-sidebar col-md-3">
		<div class="portlet light profile-sidebar-portlet">
			<!--
			<div class="profile-userpic">
				<img src="../../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
			</div>
			-->
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<a class="editable" data-name="name" data-type="text" ><?php echo $company->name;?></a>
				</div>
				<div class="profile-usertitle-job">
					<a class="editable" data-name="slogan" data-type="text" ><?php echo $company->slogan;?></a>
				</div>
			</div>
			

		</div>
		<div class="portlet light">
			<h5>A propos :</h5>
			<a class="editable" data-name="description" data-type="textarea" ><?php echo $company->description;?></a>
		</div>
	</div>
	<div class="profile-content col-md-9">
		<div class="row">
			<div class="col-md-6">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase"><a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="name" data-type="text" ><?php echo $s->name; ?></a></span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<p class="margin-bottom-30">
									<strong><h5>Adresse :</h5></strong> <a class="" data-pk="<?php echo $s->id;?>" data-name="address" data-type="text" ><?php echo $s->address; ?></a>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Téléphone :</h5></strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="tel" data-type="text" ><?php echo $s->tel; ?></a>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Portable :</h5></strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="mobile" data-type="text" ><?php echo $s->mobile; ?></a>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Email :</h5></strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="email" data-type="text" ><?php echo $s->email; ?></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Map</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content aspectratio-container aspect-4-3 fit-width">
							<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<ul class="nav nav-tabs pull-left">
							<li class="active"><a href="#services" data-toggle="tab" aria-expanded="true">Services</a></li>
							<li><a href="#prods" data-toggle="tab" aria-expanded="false">Produits</a></li>
						</ul>
						<div class="btn-group btn-group-solid pull-right">
							<a type="button" class="btn  green-haze " data-toggle="modal" href="#new_service_modal">Ajouter un Services</a>
							<a type="button" class="btn  blue-madison" data-toggle="modal" href="#new_produit_modal">Ajouter un Produits</a>&nbsp; &nbsp;
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane row active" id="services">
							<?php foreach ($company->products as $p) { ?>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="thumbnail">
										<!--<img src="" alt="100%x200" style="width: 100%;  display: block;">-->
										<div class="caption">
											<h3><a href="javascript:;" class="product_editable"  data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
											<p><a href="javascript:;" class="product_editable"  data-name="description" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->description; ?></a></p>
											<p><a href="javascript:;" class="product_editable"  data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number" ><?php echo $p->price; ?> DNT</a></p>
										</div>
									</div>
								</div>
							<?php }?>
							</div>
							<div class="tab-pane row" id="prods">
							<?php foreach ($company->services as $p) {?>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="thumbnail">
										<!--<img src="" alt="100%x200" style="width: 100%;  display: block;">-->
										<div class="caption">
											<h3><a href="javascript:;" class="service_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
											<p><a href="javascript:;" class="service_editable"  data-name="description" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->description; ?></a></p>
											<p><a href="javascript:;" class="service_editable"  data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number" ><?php echo $p->price; ?> DNT</a></p>
										</div>
									</div>
								</div>
							<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="new_service_modal" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ajouter un Service</h4>
			</div>
			<form>
			<div class="modal-body">
				 <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">Nom</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Nom">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputDesc3" class="col-sm-2 control-label" placeholder="Déscription">Déscription</label>
				    <div class="col-sm-10">
				    	<textarea class="form-control" rows="3"></textarea>
				    </div>
				    
				  </div>
				  <div class="form-group">
				   <label for="exampleInputAmount" class="col-sm-2 control-label">Prix</label>
				  	<div class="col-sm-10">
				    <div class="input-group ">
				      <div class="input-group-addon">DNT</div>
				      <input type="text" class="form-control" id="exampleInputAmount" placeholder="Prix">
				    </div>
				  	</div>
				  </div>
				 <p class="help-block">&nbsp;</p>
			</div>
			<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Fermer</button>
				<button type="button" class="btn blue">Ajouter</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="new_produit_modal" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ajouter un Produit</h4>
			</div>
			<form>
			<div class="modal-body">
			
				 <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">Nom</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Nom">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputDesc3" class="col-sm-2 control-label" placeholder="Déscription">Déscription</label>
				    <div class="col-sm-10">
				    	<textarea class="form-control" rows="3"></textarea>
				    </div>
				    
				  </div>
				  <div class="form-group">
				   <label for="exampleInputAmount" class="col-sm-2 control-label">Prix</label>
				  	<div class="col-sm-10">
				    <div class="input-group ">
				      <div class="input-group-addon">DNT</div>
				      <input type="text" class="form-control" id="exampleInputAmount" placeholder="Prix">
				    </div>
				  	</div>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputFile" class="col-sm-2 control-label">Image</label>
				    <div class="col-sm-10">
				    <input type="file" id="InputFile">				    	
				    </div>
				    <p class="help-block">&nbsp;</p>
				    
				  </div>
				</div>
			<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Fermer</button>
				<button type="button" class="btn blue">Ajouter</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- custom page script -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="<?php echo url_root;?>/pages/company/script_2<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
