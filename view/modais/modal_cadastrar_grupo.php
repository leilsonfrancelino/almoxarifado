 <!-- select do código -->
 <?php
  require "../dao/conexao.php";
  $sql_grupo = "SELECT id FROM grupos ORDER BY id DESC LIMIT 1";
  $result_grupo = mysqli_query($conexao, $sql_grupo);
  $dados_grupo = mysqli_fetch_array($result_grupo);
  ?>
 <!-- Modal -->
 <div class="modal fade bd-example-modal-lg" id="modal_cadastrar_grupo" tabindex="-1" role="dialog" aria-labelledby="modal_cadastrar_grupoTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div style="background-color:#007bff;" class="modal-header">
         <h5 class="modal-title" style="color:white;" id="modal_cadastrar_grupoTitle">Cadastrar novo grupo de produtos:</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <!--Formulario-->
         <form method="POST" action="../valida/valida_cadastro_grupo.php">
           <div class="modal-body">
		     <div class="form-row">
		       <div class="form-group col-md-2">
                 <label for="data">Código:</label>
                 <input class="form-control" id="data_cadastro" value="<?php echo ($dados_grupo['id'] + 1); ?>" disabled>
               </div>
			   </div>
             <div class="form-group">
               <label for="inputAddress">Nome do grupo:</label>
               <input type="text" name="nome_grupo" class="form-control" id="nome_grupo" placeholder="Nome" required>       
               
             </div>
             
           </div>
       </div>
       <div class="modal-footer">
         <button type="button" style="width:15%;" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
         <button type="submit" style="width:15%;" name="cadastrar" class="btn btn-primary"><div style="color:white">Cadastrar</div></button>
       </div>
       </form>
     </div>
   </div>
 </div>
 </form>