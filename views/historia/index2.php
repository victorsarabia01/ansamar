<style type="text/css">
  #permanente{
    display:none;
   
  }
  #decidua{
    display:none;
  }
  #mixta{
    display:none;
  }
</style>
<div class="container py-3">
  <h2 class="text.center">CONSULTA HISTORIA CLINICA</h2>

  <div class="row justif">
<div class="col-md-8">
<a  class="btn btn-outline-success" href="#" data-bs-toggle="modal" data-bs-target="#nuevoModal">	<i class="align-middle me-2" data-feather="plus-circle"></i> NUEVO REGISTRO</a>
</div>

<form action="">
<div class="form-outline">
  <input  type="text" id="campo" name="campo" class="form-control" placeholder="Type query" aria-label="Search" />
</div>
</form>
</div>

<table class="table table-sm table-striped table-hover mt-4">
<thead class="table-secondary"  >
  <tr>
  <th>#</th>
    <th>cedula</th>
    <th>nombre</th>
    <th>apellido</th>
    <th>alergico a medicameto</th>
    <th>sufre alguna enfermedad</th>
    <th>toma algun medicamento</th>
    <th>Tratamiento</th>
     <th>observacion</th> 
    <th>accion</th>
  </tr>
  </thead>
  <tbody>
					<?php foreach ($this->mode->listarhistoria() as $k) : ?>
						
						<tr class="table">
            <td></td>
            <td><?php echo $k->cedula; ?></td>
            <td><?php echo $k->nombres; ?></td>
            <td><?php echo $k->apellidos; ?></td>
							
							<td><?php echo $k->trabajo; ?></td>
             <td><?php echo $k->observacion; ?></td>
						
							<td>
								<a href="#" data-bs-toggle="modal" <?php echo $k->id; ?>
                 data-bs-target="#editarModal"class="btn btn-info">Editar</a>
							</td>
              </tr>
              

<?php endforeach; ?>

</tbody>

</table>



                   


  
									</div>

                  
                                    <?php include 'nuevomodal.php'; ?>
	<?php include 'editarmodal.php'; ?>


