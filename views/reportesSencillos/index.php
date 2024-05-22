                





                <p></p>
                <div class="accordion container" id="accordionExample">
                <div class="col-md-6">
                            <label><b>Módulo:</b></label>
                             <select name="modulos" id="modulos" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Selecciona</option>
                                <?php foreach ($this->mode->Consultar("listarModulos")  as $k) : ?>
                                    <option value="<?php echo $k->id ?>"> <?php echo $k->nombre ?></option>
                                <?php endforeach ?>
         
                            </select>
                            <label><b>Realizar búsqueda personalizada:</b></label>
                            <select name="consultorio" id="consultorio" class="form-select form-select-lg mb-1" aria-label="Ejemplo de .form-select-lg" required>
                                <option value="0">Selecciona</option>
                                <option value="0">Todos</option>
                                <option value="0">Fecha</option>
                                <option value="0">Status</option>
                            </select>
                            <p></p>
                            
                            <button type="submit" id="btnguardar" class="btn btn-outline-success">Buscar</button>
                            
                </div>
                </div>
