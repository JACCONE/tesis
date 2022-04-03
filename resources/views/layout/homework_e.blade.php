<div id="aut" style="height: 100%;">
    <div class="mat_estu_general">
    <div class="mat_estu_asignaturas"> <!-- materias estudiante -->
        <div style="padding-bottom: 5px;"><div class="mat_estu_asig_name text-green-6 noselect">ASIGNATURAS</div></div>
            <div v-for="(mat, index) in materias_estudiante" :key="index" 
            class="mat_estu" @click = "get_tareas_estudiante(mat.id_asignatura)">
                <div style="font-weight: bold;">@{{mat.nombre}}</div>
                <div><span style="font-weight: bold;" class="text-caption text-grey-7">@{{mat.tareas}}</span><span class="text-caption text-grey-7"> tareas pendientes</span></div>
            </div>
    </div>
    <div class="mat_estu_tareas"><!-- tareas por materia -->
        <div v-for="(tar, index) in tareas_estudiante" :key="index" style="">
        <q-card class="my-card" flat bordered @click="abrir_tarea(tar.id)">
            <q-card-section >
                <div class="text-h5">@{{tar.nombre}}</div>
                <div class="text-caption text-grey">
                <span style="font-weight: bold;">Asignatura: </span> @{{tar.materia}}
                </div>
                <div class="text-caption text-grey">
                <span style="font-weight: bold;">Descripción: </span>@{{tar.descripcion}}
                </div>
                <div class="text-caption text-grey">
                    <span style="font-weight: bold;">Estado: </span>@{{tar.estado}}
                </div>
            </q-card-section>
        </q-card>
        
   
        </div>
    </div>





</div>
</div>

{{-- <div style="display: flex;
flex-direction: row;">
    <div style="display: flex;
    flex-direction: column;
    padding: 36px;
    position: fixed;
    height: 100%;
    line-height: 26px;"> <!-- materias estudiante -->
        <div style="text-align: center;
        font-size: 19px;
        border-bottom: 2px solid #d5d5d5;
        margin-bottom: 4px;">ASIGNATURAS</div>
            <div v-for="(mat, index) in materias_estudiante" :key="index" 
            class="mat_estu" @click = "get_tareas_estudiante(mat.id_asignatura)">
                <div>@{{mat.nombre}}</div>
                <div>Cantidad Tareas: @{{mat.tareas}}</div>
            </div>
    </div>
    <div style="display: flex;
    flex-direction: column;
    margin-left: 413px;
    padding-top: 40px;
    border-left: 1px solid rgb(239, 239, 239);
    margin-top: 23px;
    margin-bottom: 5px;
    padding-left: 23px;
    padding-right: 31px;
    min-height: 590px;
    width: 100% !important;"><!-- tareas por materia -->
        <div v-for="(tar, index) in tareas_estudiante" :key="index" style="">
            <q-card class="my-card" >
                <q-card-section>
                <div style="font-size: 17px;text-align: center;border-bottom: 1px solid #e7e7e7;">
                    @{{tar.nombre}}
                </div>
                <div style="display: flex;flex-direction: row;">
                    <div style="padding: 13px;font-size: 15px;">Materia:</div>
                    <div style="padding: 13px;font-size: 14px;">@{{tar.materia}}</div>
                </div>
                <div style="display: flex;flex-direction: row;">
                    <div style="padding: 13px;font-size: 15px;">Descricpión:</div>
                    <div style="padding: 13px;font-size: 14px;">@{{tar.descripcion}}</div>
                </div>
                <div style="display: flex;flex-direction: row;">
                    <div style="padding: 13px;font-size: 15px;">Estado:</div>
                    <div style="padding: 13px;font-size: 14px;">@{{tar.estado}}</div>
                </div>
                
                </q-card-section>
        
                <q-card-actions vertical>
                <q-btn flat @click="abrir_tarea(tar.id)">Abrir</q-btn>
                </q-card-actions>
            </q-card>
        </div>

    </div>
</div>
 --}}
<q-dialog v-model="tarea_estudiante_info" persistent>
    <q-card style="width: 1000px;max-width: 1000px">
      <q-card-section class="row items-center q-pb-none">
        <div class="text-h6">Tarea: @{{tarea_actual}}</div>
        <q-space></q-space>
        <q-btn icon="close" flat round dense v-close-popup @click="limpiar_tarea"></q-btn>
      </q-card-section>
  
      <q-card-section>
      <div id="tarea_form">
            <div>
                <div class="row">
                    <q-input class="col" outlined v-model="tarea_descripcion_e" label="Descripción" :dense="dense" type="textarea" style="padding: 3px;" disable></q-input>
                </div>
                <div class="row">
                  <div class="col link" @click="abrir_link">
                     Archivo Adjunto: @{{adjunto_e}} 
                  </div>
                </div>
                <div class="row">
                    <q-input class="col" outlined v-model="fecha_fin_e" label="Fecha final" :dense="dense" style="padding: 3px;" disable></q-input>
                </div>
                <div class="row">
                    <q-input class="col" outlined 
                    v-model="tarea_url_e" label="Link de entrega" 
                    :disable = "disable_entrega"
                    :dense="dense" style="padding: 3px;"></q-input>
                </div>
              <div style="padding: 5px;display: flex;justify-content: end;">
                  <q-btn color="green-6" label="ENVIAR" @click="enviar_tarea()"></q-btn>
              </div>
        </div>
      </div>
    
      </q-card-section>
    </q-card>
  </q-dialog>