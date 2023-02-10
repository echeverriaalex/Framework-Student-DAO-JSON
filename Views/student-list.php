<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de estudiantes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Apellido</th>
                         <th>Nombre</th>
                         <th>Opciones</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($studentList as $student)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $student->getRecordId() ?></td>
                                             <td><?php echo $student->getLastName() ?></td>
                                             <td><?php echo $student->getFirstName() ?></td>
                                             <td>
                                                  <form action="<?php echo FRONT_ROOT ?>Student/Delete" method="post">
                                                  <input type="text" name="recordId" value="<?php echo $student->getRecordId();?>" class="form-control" hidden>
                                                       <button type="submit"> Borrar</button>
                                                  </form>
                                                  <form action="<?php echo FRONT_ROOT ?>Student/ShowEditView" method="post">
                                                       <input type="text" name="recordId" value="<?php echo $student->getRecordId();?>" class="form-control" hidden>
                                                       <input type="text" name="firstName" value="<?php echo $student->getFirstName();?>" class="form-control" hidden>
                                                       <input type="text" name="lastName" value="<?php echo $student->getLastName();?>" class="form-control" hidden>
                                                       <button type="submit"> Editar</button>
                                                  </form>
                                             </td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>