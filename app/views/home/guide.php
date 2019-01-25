<?php defined('BASEPATH') OR exit('No direct script access allowed');

	$this->viewbag->layout = "_layout";
	$this->viewbag->title = "Guide";
	$this->viewbag->description = "Guide";

	$test_local = "Lorem local view variable";
?>

<h1>Guide</h1>
<section>
	<h2>Render Data</h2>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<h5 class="card-header">
					Standard PHP Syntax
				</h5>
				<div class="card-body">
					<p><b>Long php syntax:</b> <?php echo $test_var ?></p>
					<p><b>Short php syntax:</b> <?= $test_local ?></p>
					<ul>
					<?php foreach ($test_arr as $item): ?>
						<li><?=$item['name']?> - <em><?=$item['email']?></em></li>
					<?php endforeach; ?>
					</ul>
					<a href="https://www.codeigniter.com/user_guide/general/alternative_php.html" class="btn btn-primary">Details</a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<h5 class="card-header">
					Template parser syntax
				</h5>
				<div class="card-body">
					<p><b>Simple variable:</b> {test_var}</p>
					<p><b>Array:</b></p>
					<ul>
						{test_arr}
						<li>{name} - <em>{email}</em></li>
						{/test_arr}
					</ul>	
					<a href="https://www.codeigniter.com/user_guide/libraries/parser.html" class="btn btn-primary">Details</a>	
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<h2>Layouts</h2>
	<p>Default layout should be specified in <code>app/config/appsettings > default_layout</code> property</p>
	<p>Also layout can be specified inside desirable views via <code>$this->viewbag->layout</code> on top of view file:</p>
	<pre>$this->viewbag->layout = "_layoutNew";</pre>
	<p>Nested layout are supported.</p>
</section>	
<section>
	<h2>Viewbag</h2>
	<p><b>Render test variable from viewbag: </b><?= $this->viewbag->test ?></p>
</section>	
<section>
	<h2>Error Handling</h2>
	<pre>return $this->error_404();</pre>
	<pre>return show_404();</pre>
</section>	
