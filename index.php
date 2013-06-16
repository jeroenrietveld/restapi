<!DOCTYPE html>
<html>
	<head>
		<title>Rest API</title>

		<link rel="stylesheet" href="public/css/bootstrap.min.css" />
		<link rel="stylesheet" href="public/css/main.css" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="public/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="navbar-wrapper">
			<div class="container">
				<div class="navbar navbar-inverse">
					<div class="navbar-inner">
						<button class="btn btn-navbar" data-target=".navbar-collapse" data-toggle="collapse" type="button">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a href="#" class="brand">Rest API</a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories</a>
									<ul class="dropdown-menu">
										<?php
											$response = file_get_contents("http://".$_SERVER['HTTP_HOST']."/api/v1/categories/json");
											$response = json_decode($response);

											foreach($response->categories as $category) {
												echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/api/v1/categories/'.$category->category->id.'/xml">'.$category->category->name.'</a></li>';
											}
										?>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products</a>
									<ul class="dropdown-menu">
										<?php
											$response = file_get_contents("http://".$_SERVER['HTTP_HOST']."/api/v1/products/json");
											$response = json_decode($response);

											foreach($response->products as $product) {
												echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/api/v1/products/'.$product->product->id.'/xml">'.$product->product->name.'</a></li>';
											}
										?>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<header class="header">
			<div class="container">
				<ul class="row">
					<li class="span3">
						<h4>GET</h4>
						<pre>GET /api/v1/entity_name/{optional_id}/format</pre>
					</li>
					<li class="span3">
						<h4>POST</h4>
						<pre>POST /api/v1/entity_name</pre>
					</li>
					<li class="span3">
						<h4>PUT</h4>
						<pre>PUT /api/v1/entity_name/{optional_id}</pre>
					</li>
					<li class="span3">
						<h4>DELETE</h4>
						<pre>DELETE /api/v1/entity_name/{optional_id}</pre>
					</li>
				</ul>
			</div>
		</header>

		<div class="container">
			<div class="row">
				<div class="span12 well info">
					<h1>Info</h2>
					<div class="row">
						<div class="span6 offset3">
							<h3>Entities</h3>
							<p>
								Available entities are Categories and Products.
								Both have a name. The Categories contain Products.
							</P>
							<p>
								Data can be returned in the formats json and xml
							</p>
						</div>
					</div>
					<div class="row request-info">
						<div class="span5">
							<h3>GET</h3>
							<p>
								To get all instances of an entity use the following get request
								<pre>/api/v1/entity_name/format</pre>

								To get a single instance of an entity specify an id
								<pre>/api/v1/entity_name/id/format</pre>
							</p>
						</div>
						<div class="span5 offset2">
							<h3>POST</h3>
							<p>
								To add a new entity use the following post request
								<pre>/api/v1/entity_name</pre>

								The following post parameters have to be send.
								<pre>Category: name</pre>
								<pre>Product: name, category_name</pre>
							</p>
						</div>
					</div>
					<div class="row request-info">
						<div class="span5">
							<h3>PUT</h3>
							<p>
								To edit an entity use the following put request
								<pre>/api/v1/entity_name/id</pre>

								The following post parameters have to be send.
								<pre>Category: name</pre>
								<pre>Product: name, category_name</pre>
							</p>
						</div>
						<div class="span5 offset2">
							<h3>DELETE</h3>
							<p>
								To delete an entity use the following delete request
								<pre>/api/v1/entity_name/id</pre>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>