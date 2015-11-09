<script type="text/javascript">
window.onload = function() {
  var c = document.getElementById('platypus1');
  var d = document.getElementById('platypus2');
  c.onclick = function() {
    if (c.value == "platypus1") {
	document.getElementById('answer1').style.display = 'inline';
	document.getElementById('answer2').style.display = '';
	}
  }

  d.onclick = function() {
    if (d.value == "platypus2") {
	document.getElementById('answer2').style.display = 'inline';
	document.getElementById('answer1').style.display = '';
	}
  }
}
</script>

<style type="text/css">
#answer1 {display:none;}
#answer2 {display:none;}
</style>

<label for="platypus1">Are you a platypus?</label>
<input id="platypus1" type="radio" name="monotreme" value="platypus1" />
  <select name="answer" id="answer1">
    <option value="yes">Yes</option>
    <option value="no">No</option>
  </select>
<label for="platypus2">Are you a platypus?</label>
<input id="platypus2" type="radio" name="monotreme" value="platypus2" />
  <select name="answer" id="answer2">
    <option value="yes">Yes</option>
    <option value="no">No</option>
  </select>
