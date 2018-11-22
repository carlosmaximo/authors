<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
		<!-- <script src="/js/jquery-3.3.1.min.js"></script> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
		<script language="javascript">
			$(document).ready(function(){
				$('.excluir').on('click', function(e){
					e.preventDefault();

					var ref = $(this).attr('ref');
					var url = '/api/authors/'+ref;

					$.ajax({
						url: url,
						type: 'POST',
						data: {id: ref, '_method': 'delete'},
						//dataType: "json",
					    complete: function(xhr, textStatus) {
					        if (xhr.status != 200)
					        {
					        	alert('Houve uma falha ao tentar excluir o registro. '+textStatus);
					        	return false;
					        }
					        else
					        {
					        	alert('Registro excluido corretamente!');
					        	location.href = '/api/authors';
					        }
					    } 
					});
				});
			});
		</script>
	</head>
    <body>
    	<div id="div_form" style="width:80%;margin:auto;">
    		<form action="/api/authors/<?= $selecionado['id']; ?>" method="post">
    			<input type="hidden" name="_method" value="<?= $selecionado['method']; ?>" />
    			<input type="hidden" id="id" name="id" value="<?= $selecionado['id']; ?>" />
    			<table class="table">
    				<tr>
    					<td>
	    					<label class="label" for="name">Nome</label>
	    					<input type="text" class="form-control" id="name" name="name" value="<?= $selecionado['name']; ?>" />
	    				</td>
	    			
	    				<td>
	    					<label class="label" for="email">Email</label>
	    					<input type="text" class="form-control" id="email" name="email" value="<?= $selecionado['email']; ?>" />
	    				</td>
    				</tr>
    				<tr>
	    				<td>
	    					<label class="label" for="location">Local</label>
	    					<input type="text" class="form-control" id="location" name="location" value="<?= $selecionado['location']; ?>" />
	    				</td>
    					<td>
	    					<label class="label" for="github">Git Hub</label>
	    					<input type="text" class="form-control" id="github" name="github" value="<?= $selecionado['github']; ?>" />
	    				</td>
    				</tr>
    				<tr>
	    				<td>
	    					<label class="label" for="twitter">Twitter</label>
	    					<input type="text" class="form-control" id="twitter" name="twitter" value="<?= $selecionado['twitter']; ?>" />
	    				</td>
       					<td valign="bottom">
    						<input type="submit" class="btn" name="btn_submit" id="btn_submit" />
    						<button class="btn" name="btn_cancelar" onclick=window.location('./api/authors') id="btn_cancelar">Cancelar</button>
    					</td>
    				</tr>
    			</table>
    		</form>
    	</div>
    	<div style="width:80%;margin:auto;">
	        <table class="table table-bordered table-condensed table-hover">
	        	<tr>	
	        		<th>Nome</th>
	        		<th>Email</th>
	        		<th>Local</th>
	        		<th colspan="2" class="text-center">Ação</th>
	        	</tr>
	        	<?php foreach ($data as $k => $author): ?>
	        		<tr>
	        			<td><?= $author['name']; ?></td>
	     				<td><?= $author['email']; ?></td>
	     				<td><?= $author['location']; ?></td>
	     				<td width="5%">
	     					<a href="/api/authors/<?= $author['id']; ?>" id="frmDelete_<?=$author['id'];?>" name="frmDelete_<?=$author['id'];?>">Editar</a>
	     				</td>
	     				<td width="5%">
	     					<a href="javascript:void(0);" class="excluir" ref="<?= $author['id']; ?>">Excluir</a>
	     				</td>
	        		</tr>
	        	<?php endforeach; ?>
	        </table>
	    </div>
    </body>
</html>