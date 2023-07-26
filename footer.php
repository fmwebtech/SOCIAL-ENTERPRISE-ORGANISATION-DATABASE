
<footer class="footer" style="position:relative">
  <div class="container">
    <div class="text-center">
      Copyright © <?php echo date('Y');?> Copperbelt University
    </div>
  </div>
</footer>

<script>

function openMessageModal(title,message)
{
document.getElementById("messageBodyAlert").innerHTML=message;
document.getElementById("messageTitleAlert").innerHTML=title;
$('#generalAlertModel').modal('show');

}
</script>

<div class="modal fade text-dark" id="generalAlertModel" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
        

				<h4 id="messageTitleAlert" class="modal-title text-dark"></h4><button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
     
			<div class="modal-body">
				<div id="messageBodyAlert" class="form-group">
					
				</div>
			</div>
	
		</div>

	</div>
</div>

