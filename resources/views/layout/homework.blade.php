
<div id="aut" style="height: 100%;">
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
                      <q-item-section @click="tarea_info = true, getHomeWorkInfo(rub.id_tarea)">Editar Información</q-item-section>
                    </q-item>
                    <q-item clickable v-close-popup>
                      <q-item-section @click="estado_tarea(rub.id_tarea)" >Proceso de tarea</q-item-section>
                    </q-item>
                  </q-list>
                </q-menu>
              </q-btn>
            </q-bar>
        </div>
    </template>

<!--MODAL DE EXPERTOS-->
<q-dialog v-model="each_tarea" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
<q-card class="column full-height">
    <q-card-section>
        <div class="text-h6">Gestor de @{{tarea_actual}}</div>
    </q-card-section>
    <q-separator></q-separator>
    <q-card-section class="col q-pt-none scroll">
      <div style="cursor: pointer; border: 1px solid black;" @click= "asig_evaluaciones">ASIGNAR EVALUACIONES</div>
    </q-card-section>
    <q-separator></q-separator>
    <q-card-actions align="right">
        <q-btn flat label="SALIR" color="green-9" v-close-popup></q-btn>
    </q-card-actions>
</q-card>
</q-dialog>
<!--MODAL DE EXPERTOS-->


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
                <q-btn color="green-6" label="GUARDAR" @click="actualizar_tareas_envio()"></q-btn>
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
     <div>Treas/Estudiantes</div>
     <q-input class="col" outlined v-model="cantidad_tareas" 
     :dense="dense" style="padding: 3px;"
     type="number" 
     min = 2></q-input>

    </q-card-section>

    <q-card-actions align="right">
      <q-btn flat label="OK" color="primary" @click="ditribuir_tareas" ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>

</div>

