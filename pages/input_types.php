<!DOCTYPE html>
<html>
<body>
<h2>Radio Buttons</h2>

<form method="get" action="input_types.php">
  <input type="radio" name="gender" value="male">MALE<br>
  <input type="radio" name="gender" value="female">FEMALE<br>
  <input type="radio" name="gender" value="other">OTHER<br>
  <input type="submit" value="submit">
</form> 

<form method="POST" action="Result.php">
    <input type="radio" name="MyRadio" value="First" checked>First<br> 
    <input type="radio" name="MyRadio" value="Second">Second<br>
    <input type="submit" value="Result" name="Result">
</form>

</body>
</html>