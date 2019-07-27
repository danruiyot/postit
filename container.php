<ul class="w3-navbar w3-large w3-black w3-left-align">
  <li class="w3-hide-medium w3-hide-large w3-black w3-opennav w3-right">
    <a href="javascript:void(0);" onclick="myFunction()">☰</a>
  </li>
  <li><a href="index.php">Home</a></li>
  <li class="w3-hide-small"><a href="profile.php">Profile </a></li>
<li class="w3-hide-small"><a href="message.php">message </a></li>
  <li class="w3-hide-small"><a href="logout.php">Log out</a></li>
</ul>

<div id="demo" class="w3-hide w3-hide-large w3-hide-medium">
  <ul class="w3-navbar w3-left-align w3-large w3-black">
    <li><a href="profile.php">Profile</a></li>
    <li><a href="all.php">Message</a></li>
<li><a href="logout.php">Log Out</a></li>
  </ul>
</div>
<script>
function myFunction() {
    document.getElementById("demo").classList.toggle("w3-show");
}
</script>
