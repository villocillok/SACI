<style>
	#footer{
		text-align: center;
		bottom:0px;
		margin:0px auto;
	}	
</style>
</body>
<div class="grid" id="footer">
	<div class="cell offset2 padding20 ">
<script>
//document.getElementById('demo').innerHTML = Date()
</script>

<?php
	date_default_timezone_set('Asia/Manila');
	// print(date('Y-m-d H:iA:s'));
	print(date('Y-m-d h:iA'));
?>
	</div>
</div>
</html>