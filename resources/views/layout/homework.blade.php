
<div id="aut" style="height: 100%;"> 
<div id="principal_h">
<template>
  <div style="height: 67px;
  cursor: pointer;
  border: 1px solid #cfcfcf;
  border-radius: 3px;
  background: whitesmoke;
  display: flex;
  align-items: center;"
  @click="getHomeWorkInfo(id_tarea_temp)">
  <q-icon name="add_circle_outline" style="font-size: 3.4em;"></q-icon>
  <div style="padding-left: 9px;">Añadir Tarea</div>
  </div>
</template>  
<template v-for="(rub, index) in homeworks" :key="index">
        <div class="row rub_1">
            <q-bar class="card_r shadow-2 bg-grey-2">
                <div>
                    <div><a style="font-weight: bold;">@{{rub.materia}}:</a> @{{rub.nombre}}</div>
                    <div class="text-caption text-grey-7">@{{rub.fecha}}</div>
                </div>
                <q-space></q-space>
                <div class="status noselect bg-grey-4 text-grey-7">
                    @{{rub.estado}}
                </div>
                <q-btn color="green-6" label="GESTION">
                <q-menu>
                  <q-list style="min-width: 100px">
                    <q-item clickable v-close-popup>
                      <q-item-section @click="tarea_info = true, getHomeWorkInfo(rub.id_tarea,rub.evaluacion_pares)">Editar Información</q-item-section>
                    </q-item>
                    <q-item clickable v-close-popup>
                      <q-item-section @click="estado_tarea(rub.id_tarea,rub.id_asi)" >Proceso de tarea</q-item-section>
                    </q-item>
                  </q-list>
                </q-menu>
              </q-btn>
            </q-bar>
        </div>
    </template>

<!--MODAL DE GESTOR DE TAREA DE DOCENTE-->
<q-dialog v-model="each_tarea" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
<q-card class="column full-height">
    <q-card-section>
        <div class="text-h6">Gestor de @{{tarea_actual}}</div>
    </q-card-section>
    <q-card-section class="col q-pt-none scroll">
      <div class="q-pa-md">
        <div  class="evaluar" @click = "asig_evaluaciones" id="asignar">
           Asignar Evaluaciones
        </div>
        <table class="tabla_1" style="width: 100%; padding:23px; display: none;" id="tbl_1">
          <thead style="height: 50px;">
            <tr>
              <th class="cabecera" style="width: 30%">ESTUDIANTE</th>
              <th class="cabecera" style="width: 22%">CORREO</th>
              <th class="cabecera" style="width: 13%">ESTADO</th>
              <th class="cabecera" style="width: 15%">FECHA ENVÍO</th>
              <th class="cabecera" style="width: 6%;">LINK</th>
            </tr>
          </thead>  
          <tbody>
            <tr v-for="(estu, index) in estudiantes_lista" :key="index" style="height: 45px">
              <td>@{{estu.estudiante}}</td>
              <td>@{{estu.correo}}</td>
              <td>@{{estu.estado}}</td>
              <td>@{{estu.fecha_envio}}</td>
              <td> <q-btn v-if = "estu.link_envio != ''"
                round
                color="primary"
                size="sm" 
                icon="link"
                @click = "abrir_link_envio(estu.link_envio)"
              /></td>
            </tr>
          </tbody>        
        </table>
        <table class="tabla_1" id="tbl_2"  style="width: 100%; padding:23px; display: none;">
          <thead style="height: 50px;">
            <tr>
              <th class="cabecera" style="width: 30%">ESTUDIANTE</th>
              <th class="cabecera" style="width: 22%">CORREO</th>
              <th class="cabecera" style="width: 15%">FECHA ENVÍO</th>
              <th class="cabecera" style="width: 6%;">LINK</th>
            </tr>
          </thead>  
          <tbody>
            <tr v-for="(estu2, index) in estudiantes_entrega" :key="index" style="height: 45px">
              <td>@{{estu2.estudiante}}</td>
              <td>@{{estu2.correo}}</td>
              <td>@{{estu2.fecha_envio}}</td>
              <td> <q-btn v-if = "estu2.link_envio != ''"
                round
                color="primary"
                size="sm" 
                icon="link"
                @click = "abrir_link_envio(estu2.link_envio)"
              /></td>
            </tr>
          </tbody>
        </table>
        <table  class="tabla_1" id="tbl_3" style="width: 100%; padding:23px; display: none;">
          <thead style="height: 50px;">
            <tr>
              <th class="cabecera" style="width: 25%">ESTUDIANTE</th>
              <th class="cabecera" style="width: 10%">NOTA DOCENTE</th>
              {{-- <th class="cabecera" style="width: 6%;">LINK</th> --}}
              <th class="cabecera" style="width: 30%">EVALUACIONES</th>
            </tr>
          </thead>  
          <tbody>
            <tr v-for="(eva, index) in estudiantes_evaluar" :key="index" style="height: 45px">
              <td>@{{eva.estudiante}}</td>
              <td>@{{eva.nota_docente}}</td>
              {{-- <td> <q-btn v-if = "eva.link_envio != ''"
                round
                color="primary"
                size="sm" 
                icon="link"
                @click = "abrir_link_envio(eva.link_envio)"
              /></td> --}}
              <td class="flex column">
                <div v-for="asignados in eva.asignados" style="display: flex;">
                  <div style="width: 60%; display:flex; align-items:center;">@{{asignados.nombre}}</div>
                  {{-- <div style="width: 20%; display:flex; align-items:center;">@{{asignados.porcentaje}}%</div> --}}
                  <div style="width: 20%; display:flex; align-items:center;">@{{asignados.nota}}</div>
                  
                </div>
              </td>
               {{--  <div v-for="(asig, index) in eva.asignados"></div>
                    <div>@{{asig.nombre}}</div>
              </td> --}}
            </tr>
          </tbody>
        </table>
      </div>

    </q-card-section>
    <q-separator></q-separator>
    <q-card-actions align="right">
        <q-btn flat label="SALIR" color="green-9" @click="limpiar_array_estudiantes"></q-btn>
    </q-card-actions>
</q-card>
</q-dialog>
<!-- ------------ -->


<q-dialog v-model="tarea_info" persistent>
  <q-card style="width: 1000px;max-width: 1000px">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6">Información de @{{tarea_actual}}</div>
      <q-space></q-space>
      <q-btn icon="close" flat round dense v-close-popup @click="limpiar_tarea"></q-btn>
    </q-card-section>

    <q-card-section>
    <div id="tarea_form">
          <div>
              <div class="row">
                  <q-input class="col" outlined v-model="periodo_actual" label="Periodo Actual" :dense="periodo_dense" style="padding: 3px;" disable ></q-input>
              </div>
              <div class="row">
              <q-select class="col" outlined 
              v-model="materia_lista" 
              :options="campo_asignatura" 
              option-value="id_materia" 
              option-label="nombre" 
              @input="obtener_paralelos" 
              label="Materia" style="padding: 3px;">
            </q-select>
              <q-select class="col" outlined 
              v-model="paralelo_lista" 
              :disable = "disable_paralelo"
              :options="paralelo_lista_options" 
              option-value="idparalelo" 
              option-label="nombre" 
              label="Paralelo" 
              style="padding: 3px;" 
              ></q-select>
              </div>
              <div class="row">
                  <q-input class="col" outlined v-model="tarea_nombre" label="Nombre de la tarea" :dense="dense" style="padding: 3px;"></q-input>
                  <q-select class="col" outlined 
                  v-model="rubrica_tarea" 
                  :options="rubrica_tarea_options" 
                  option-value="id" 
                  option-label="nombre" 
                  label="Rúbrica" 
                  style="padding: 3px;" 
                  ></q-select>
              </div>
              <div class="row">
                  <q-input class="col" outlined v-model="tarea_descripcion" label="Descripción" :dense="dense" type="textarea" style="padding: 3px;"></q-input>
              </div>
              <div class="row">
                  <q-input class="col" outlined v-model="tarea_url" label="Archivo Adjunto" :dense="dense" style="padding: 3px;"></q-input>
              </div>
              <div class="row justify-end">
                  <q-input type="number" class="col-2" outlined v-model="tarea_nota_maxima" label="Calificación máxima" :dense="dense" style="padding: 3px;"></q-input>
                  
                  
            <div class="col" style="display: flex;justify-content: center;align-items: center;">
              <div style="padding-right: 10px;">Fecha Inicio</div>
                <q-input filled v-model="tarea_inicio">
                  <template v-slot:prepend>
                    <q-icon name="event" class="cursor-pointer">
                      <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                        <q-date v-model="tarea_inicio" mask="YYYY-MM-DD HH:mm">
                          <div class="row items-center justify-end">
                            <q-btn v-close-popup label="Close" color="primary" flat />
                          </div>
                        </q-date>
                      </q-popup-proxy>
                    </q-icon>
                  </template>

                  <template v-slot:append>
                    <q-icon name="access_time" class="cursor-pointer">
                      <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                        <q-time v-model="tarea_inicio" mask="YYYY-MM-DD HH:mm" format24h>
                          <div class="row items-center justify-end">
                            <q-btn v-close-popup label="Close" color="primary" flat />
                          </div>
                        </q-time>
                      </q-popup-proxy>
                    </q-icon>
                  </template>
                </q-input>
              </div>
              
              <div class="col" style="display: flex;justify-content: center;align-items: center;">
              <div style="padding-right: 10px;">Fecha Fin</div>
              <q-input filled v-model="tarea_fin">
                  <template v-slot:prepend>
                    <q-icon name="event" class="cursor-pointer">
                      <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                        <q-date v-model="tarea_fin" mask="YYYY-MM-DD HH:mm">
                          <div class="row items-center justify-end">
                            <q-btn v-close-popup label="Close" color="primary" flat />
                          </div>
                        </q-date>
                      </q-popup-proxy>
                    </q-icon>
                  </template>

                  <template v-slot:append>
                    <q-icon name="access_time" class="cursor-pointer">
                      <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                        <q-time v-model="tarea_fin" mask="YYYY-MM-DD HH:mm" format24h>
                          <div class="row items-center justify-end">
                            <q-btn v-close-popup label="Close" color="primary" flat />
                          </div>
                        </q-time>
                      </q-popup-proxy>
                    </q-icon>
                  </template>
                </q-input>
              </div>

            </div>

          
            <div style="padding: 5px;display: flex;justify-content: end;">
                <q-btn color="green-6" 
                label="GUARDAR" 
                :disable = "btn_guadar_tarea"
                @click="actualizar_tareas_envio()"></q-btn>
            </div>
      </div>
    </div>
  
    </q-card-section>
  </q-card>
</q-dialog>

<q-dialog v-model="mensaje_tarea">
  <q-card>
    <q-card-section>
      <div class="text-h6">Mensaje</div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      @{{mensaje_v}}
    </q-card-section>

    <q-card-actions align="right">
      <q-btn flat label="OK" color="primary" v-close-popup ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>

<q-dialog v-model="valor_asignaciones">
  <q-card>
    <q-card-section>
    </q-card-section>

    <q-card-section class="q-pt-none">
  <div>
   <div style="margin-bottom: 10px;">
      <div>
        <q-input class="col" outlined v-model="cantidad_tareas" 
        :dense="dense" style="padding: 3px;"
        type="number" 
        min = 2
        label = "cantidad"></q-input>
      </div>
    </div>
    <div>
      <div>
        <q-input filled v-model="eval_fin" label="Fecha fin">
          <template v-slot:prepend>
            <q-icon name="event" class="cursor-pointer">
              <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                <q-date v-model="eval_fin" mask="YYYY-MM-DD HH:mm">
                  <div class="row items-center justify-end">
                    <q-btn v-close-popup label="Close" color="primary" flat />
                  </div>
                </q-date>
              </q-popup-proxy>
            </q-icon>
          </template>

          <template v-slot:append>
            <q-icon name="access_time" class="cursor-pointer">
              <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                <q-time v-model="eval_fin" mask="YYYY-MM-DD HH:mm" format24h>
                  <div class="row items-center justify-end">
                    <q-btn v-close-popup label="Close" color="primary" flat />
                  </div>
                </q-time>
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
      </div>
      </div>
    </div>

    </q-card-section>

    <q-card-actions align="right">
      <q-btn flat label="Asignar" color="primary" @click="ditribuir_tareas" ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>
</div>
<div id="log" class="loading" style="display: none">
  <div class="loader"></div> 
</div>
</div> 

