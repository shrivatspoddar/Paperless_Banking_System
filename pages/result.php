 <?php
if (isset($_POST['Result']))
  {
$radioVal = $_POST["MyRadio"];

if($radioVal == "First")
{
echo("You chose the first button. Good choice. :D");
}
else if ($radioVal == "Second")
{
echo("Second, eh?");
}
}
?>