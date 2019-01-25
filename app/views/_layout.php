<?php defined('BASEPATH') OR exit('No direct script access allowed');
	//$this->viewbag->layout = "_layoutMaster"; // defined in appsettings.default_layout
?>

<?php $this->load->view("_header") ?>
<main>
    <div class="container">
        <?= $CONTENT ?>
    </div>
</main>
<?php $this->load->view("_footer") ?>