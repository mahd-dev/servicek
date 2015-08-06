<link href="<?php echo cdn;?>/libraries/jquery-nestable/jquery.nestable<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
<link href="<?php echo url_root;?>/pages_admin/categories/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<?php function recursive_item($c){ ?>
	<?php
		$job_publish_price=$c->job_publish_price;
		$shop_publish_price=$c->shop_publish_price;
		$company_publish_price=$c->company_publish_price;
		$service=$c->service;
		$product=$c->product;
		$portfolio=$c->portfolio;
		$icon=$c->icon;
		if(!$icon) $icon = "fa fa-flag";
	?>
	<li class="dd-item dd3-item" data-id="<?php echo $c->id; ?>">
		<div class="dd-handle dd3-handle"></div>
		<div class="dd3-content box">
			<button class="show_hide_inputs btn btn-flat btn-xs"><i class="fa fa-chevron-down"></i></button>
			<a href="javascript:;" class="category_editable" data-pk="<?php echo $c->id; ?>" data-name="name" data-type="text"><?php echo $c->name; ?></a>
			<button class="delete_category btn btn-danger btn-xs pull-right"><i class="fa fa-times"></i></button>

			<div class="toggle_inputs hide">
				<div class="togglebutton"><label><input type="checkbox" class="job_able"<?php if($job_publish_price) echo " checked"; ?>> Métier </label>
					<span class="value<?php if(!$job_publish_price) echo " hide"; ?>">
						<a href="javascript:;" class="category_editable" data-pk="<?php echo $c->id; ?>" data-name="job_publish_price" data-type="number"><?php echo $job_publish_price; ?></a><sup> DNT/An/Métier</sup>
					</span>
				</div>
				<div class="togglebutton"><label><input type="checkbox" class="shop_able"<?php if($shop_publish_price) echo " checked"; ?>> Boutique </label>
					<span class="value<?php if(!$shop_publish_price) echo " hide"; ?>">
						<a href="javascript:;" class="category_editable" data-pk="<?php echo $c->id; ?>" data-name="shop_publish_price" data-type="number"><?php echo $shop_publish_price; ?></a><sup> DNT/An/Boutique</sup>
					</span>
				</div>
				<div class="togglebutton"><label><input type="checkbox" class="company_able"<?php if($company_publish_price) echo " checked"; ?>> Société </label>
					<span class="value<?php if(!$company_publish_price) echo " hide"; ?>">
						<a href="javascript:;" class="category_editable" data-pk="<?php echo $c->id; ?>" data-name="company_publish_price" data-type="number"><?php echo $company_publish_price; ?></a><sup> DNT/An/Société</sup>
					</span>
				</div>
				<div class="togglebutton"><label><input type="checkbox" class="service_able"<?php if($service) echo " checked"; ?>> Service</label></div>
				<div class="togglebutton"><label><input type="checkbox" class="product_able"<?php if($product) echo " checked"; ?>> Produit</label></div>
				<div class="togglebutton"><label><input type="checkbox" class="portfolio_able"<?php if($portfolio) echo " checked"; ?>> Portefeuille</label></div>

				<div class="input-group category_icon">
	          <input type="text" class="form-control" value="<?php echo $icon; ?>">
						<span class="input-group-addon"><i class="<?php echo $icon; ?>"></i></span>
	      </div>
			</div>
		</div>
		<?php if($c->count_sub_categories) { ?>
			<ol class="dd-list">
				<?php foreach ($c->sub_categories as $sc) recursive_item($sc); ?>
			</ol>
		<?php } ?>
	</li>

<?php } ?>

<div class="row">
	<div class="col-md-12">
		<div class="dd">
	    <ol class="dd-list outer">
				<?php foreach (category::get_roots() as $rc) recursive_item($rc); ?>
	    </ol>
			<button class="btn btn-primary btn-raised add_category"><i class="fa fa-plus"></i> Nouvelle catégorie</button>
		</div>
	</div>
</div>

<li class="category_template dd-item dd3-item hide" data-id="">
	<div class="dd-handle dd3-handle"></div>
	<div class="dd3-content box">
		<button class="show_hide_inputs btn btn-flat btn-xs"><i class="fa fa-chevron-down"></i></button>
		<a href="javascript:;" class="category_editable" data-pk="" data-name="name" data-type="text"></a>
		<button class="delete_category btn btn-danger btn-xs pull-right"><i class="fa fa-times"></i></button>

		<div class="toggle_inputs">
			<div class="togglebutton"><label><input type="checkbox" class="job_able"> Métier </label>
				<span class="value hide">
					<a href="javascript:;" class="category_editable" data-pk="" data-name="job_publish_price" data-type="number"></a><sup> DNT/An/Métier</sup>
				</span>
			</div>
			<div class="togglebutton"><label><input type="checkbox" class="shop_able"> Boutique </label>
				<span class="value hide">
					<a href="javascript:;" class="category_editable" data-pk="" data-name="shop_publish_price" data-type="number"></a><sup> DNT/An/Boutique</sup>
				</span>
			</div>
			<div class="togglebutton"><label><input type="checkbox" class="company_able"> Société </label>
				<span class="value hide">
					<a href="javascript:;" class="category_editable" data-pk="" data-name="company_publish_price" data-type="number"></a><sup> DNT/An/Société</sup>
				</span>
			</div>
			<div class="togglebutton"><label><input type="checkbox" class="service_able"> Service</label></div>
			<div class="togglebutton"><label><input type="checkbox" class="product_able"> Produit</label></div>

			<div class="input-group category_icon">
					<input type="text" class="form-control" value="fa fa-flag">
					<span class="input-group-addon"><i class="fa fa-flag"></i></span>
			</div>
		</div>
	</div>
</li>

<div data-jsload="sc1" data-href="<?php echo cdn;?>/libraries/jquery-nestable/jquery.nestable<?php if(!debug) echo ".min";?>.js"></div>
<script src="<?php echo url_root;?>/pages_admin/categories/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
