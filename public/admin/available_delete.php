<?php include("include/init.php"); ?>

<?php 

if(empty($_GET['id'])) {
	redirect_to("available.php");
}

$user = Availability::find_by_id($_GET['id']);

if($user)
{
	$session->message("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              The {$user->available_date} has been deleted.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
	$user->delete_photo();
	redirect_to("available.php");
} else {
	redirect_to("available.php");
}

?>
