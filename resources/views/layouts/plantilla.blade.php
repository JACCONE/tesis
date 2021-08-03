<!DOCTYPE html>
<html>

<!--
    WARNING! Make sure that you match all Quasar related
    tags to the same version! (Below it's "@1.15.20")
  -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINA PRINCIPAL RUBRICA </title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet"
        type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/quasar@1.15.20/dist/quasar.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('estilos/plantilla.css') }}" rel="stylesheet" >
    <link href="{{ asset('estilos/inicio.css') }}" rel="stylesheet" >
    
</head>

<body>
    <!-- Add the following at the end of your body tag -->
    <div id="app">
        <template>
            <q-layout view="hHh lpR fFf">

                <q-header elevated class="bg-indigo-1 text-white" height-hint="88">
                    <q-toolbar>
                        <q-toolbar-title>
                            <div class="q-pa-xs q-gutter-sm" id="cabecera">
                                <div>
                                    <div class="label bg-indigo-1 text-black text-caption" >Jorge Alberto Cedeño Cevallos</div>
                                    <div class="label bg-indigo-1 text-black text-caption" >1003410741</div>
                                    <div class="label bg-indigo-1 text-black text-caption" >
                                        <a href="">Cerrar Sesión</a>
                                    </div>
                                </div>         
                                     <!--
                                    <q-side-link tag="a" to="https://www.google.com/" >Cerrar Sesión</q-side-link>
                                    -->
                                     
                                <div>
                                    <q-avatar size= "60px" >
                                        <img src="https://us.123rf.com/450wm/nokfreelance/nokfreelance1705/nokfreelance170500366/79626216-grey-gradient-abstract-background-gray-room-studio-background-dark-tone-for-used-background-or-wallp.jpg?ver=6">
                                    </q-avatar> 
                                
                                </div>                                   
                                
                              </div>
                            
                        </q-toolbar-title>
                    </q-toolbar >
                    <div style = "background: rgb(28, 126, 25);">
                        <q-tabs align="center"  v-model="currentTab" dense>
                            <q-tab name="inicio" label="Inicio"></q-tab>
                            <q-tab name="info" label="Información"></q-tab>
                            <q-tab name="panel" label="Panel de Control"></q-tab>
                        </q-tabs>
                    </div>
                   
                </q-header>
            
                <q-page-container>
                    <q-tab-panels v-model="currentTab" animated>
                        <!--VENTANA INICIO -->
                        <q-tab-panel name="inicio">
                          <div id="superior">
                              <div class="titulo">
                                <q-expansion-item  class= "titulo_expansion"
                                  v-model="expanded"
                                  label="Clasificación"
                                  

                                >
                                  <q-card>
                                    <div id="accion">
                                        <div class="selecciones q-mr-xl">
                                          <span class="text-subtitle1">Campo</span>
                                          <span class="text-subtitle1">Disciplina</span>
                                          <span class="text-subtitle1">Subdisciplina</span>
                                          <span class="text-subtitle1">Materia</span>
                                        </div>
                                        <div  class="selecciones">
                                            <div class="q-mb-xs">
                                              <q-select filled v-model="model" :options="campo" label="Seleccione" option-value="id"
                                              option-label="nombre" dense/> 
                                            </div>
                                            <div class="q-mb-xs">
                                              <q-select filled v-model="model" :options="disciplina" label="Seleccione" dense/>
                                            </div>
                                            <div class="q-mb-xs">
                                              <q-select filled v-model="model" :options="subdisciplina" label="Seleccione" dense/>
                                            </div>
                                            <div class="q-mb-xs">
                                              <q-select filled v-model="model" :options="materia" label="Seleccione" dense/>
                                            </div>
                                        </div>
                                    </div>
                                  </q-card>
                                </q-expansion-item>
                              </div>
                          </div>
                          <div id="inferior">
                            <q-toolbar class="text-dark" >
                              <div>
                             <q-fab style="margin-left: 55px;"
                               v-model="fab1"
                               label="Opciones"
                               label-position="top"
                               external-label
                               color="black"
                               icon="settings"
                               direction="right"
                               padding="xs"
                             >
                              <q-fab-action padding="5px" external-label label-position="bottom" color="primary" @click="fila_criterio(1)" icon="psychology" label="Añadir Criterio"></q-fab-action>
                               <q-fab-action padding="5px" external-label label-position="top" color="primary" @click="columna_nivel" icon="leaderboard" label="Añadir nivel"></q-fab-action>
                               <q-fab-action padding="5px" external-label label-position="bottom" color="primary" @click="editar_andamiaje" icon="edit_note" label="Andamiaje"></q-fab-action>
                             </q-fab>
                           </div>
                             <!--<q-btn flat round dense icon="settings"></q-btn> -->
                             <q-toolbar-title style="text-align: center; font-size: 17px !important;font-weight: bold;padding-right: 115px;">
                               Rúbrica
                             </q-toolbar-title>
                           </q-toolbar>
                           <div id="contenedor_rubrica"> 
                            <div id="rubrica_interna">
                              <div id="columnas">
 
                                 <div class="row nivel">
                                  <div class="col cab_rub criterio" >Criterios</div>
                                  <div class="col cab_rub" v-for = "(nivel,index) in t_niveles" v-bind:key = "index">
                                    <span style="display: block">@{{nivel.texto}}</span>
                                    <span>(@{{nivel.valor}})</span>
                                    <q-btn v-if = "index <= 3" @click="modificar_texto_nivel(nivel.id_b)" push color="green" text-color="white" round icon="edit_note" padding=none style="position: relative; left: 15px;"></q-btn>  
                                    <q-btn v-if = "index > 3" @click = "eliminar_nivel(nivel.id_b,nivel.valor)" push color="white" text-color="primary" round icon="delete_forever" padding=none style="position: relative; left: 15px;"></q-btn>  
                                    <q-btn v-if = "index > 3" @click = "modificar_texto_nivel(nivel.id_b)" push color="white" text-color="primary" round icon="edit_note" padding=none style="position: relative; left: 16px;"></q-btn>  

                              </div>
                                </div>

                                {{-- </div> --}}
                                  <!-- -->
                                  
                              </div>
                              <div class="columnas">
                                <div class="row nivel" v-for = "(criterio,index) in t_criterios.criterio" v-bind:key = "index">
                                  <div class="col cab_rub nuevo_criterio">
                                    <div style="width: 70%; display:flex; flex-direction: column;">
                                      <span class="estilo4">@{{criterio.nombre}}</span>
                                      <span class="estilo5">(@{{criterio.porcentaje}}%)</span>

                                    </div>
                                        

                                        <div style="margin-left: 12px;">
                                          <q-fab 
                                            v-model= criterio.model
                                            label="Opciones"
                                            label-position="top"
                                            external-label
                                            color="indigo-5"
                                            icon="settings"
                                            direction="right"
                                            padding="xs"
                                          >
                                           <q-fab-action padding="5px" external-label label-position="bottom" color="black" @click="editar_criterio(index)" icon="edit" label=""></q-fab-action>
                                            <q-fab-action padding="5px" external-label label-position="top" color="black" @click="eliminar_criterio(criterio.id_c)" icon="delete_forever" label=""></q-fab-action>
                                          </q-fab>
                                        </div>
                                        {{-- <span class="material-icons" style="font-size: 25px;"  @click = "editar_criterio(index)">mode_edit</span>
                                        <span class="material-icons" style="font-size: 25px;"  @click = "eliminar_criterio(criterio.id_c)">delete_forever</span> --}}
                                  </div>
                                  <div class="col cab_rub " v-for = "(nivel,index2) in t_niveles" v-bind:key = "index2" @click = "editar_nivel_criterio(criterio.id_c,nivel.valor,event)">
                                    <span class="estilo6" v-for = "cri in t_criterios.texto_niveles" v-if = "criterio.id_c == cri.id_c && cri.nivel == nivel.valor ">@{{cri.texto}}</span>
                                   
                                    
                                  </div>

                                </div>
                              </div>
                              <q-page-sticky position="bottom-right" :offset="[18, 18]">
                                <q-btn fab icon="add" color="accent" />
                              </q-page-sticky>
                            </div>
                           </div>
                           
                          </div>

                        </q-tab-panel>
                        <!--VENTANA INFORMACION -->
                        <q-tab-panel name="info">
                          <div class="text-h6">AQUI VA EL CONTENIDO DE LA VISUAL DE INFORMACION</div>
                        </q-tab-panel>
                        <!--VENTANA PANEL -->    
                        <q-tab-panel name="panel">

                          

                          <div class="text-h6">AQUI VA EL CONTENIDO DE LA INTERFAZ DEL PANEL DE CONTROL</div>
                        </q-tab-panel>
                      </q-tab-panels>
                    <!--
                      <router-view />
                    -->
                    
                </q-page-container>

            </q-layout>
        </template>

<!-- para mostrar modales de criterios -->

<q-dialog v-model="persistent" persistent transition-show="scale" transition-hide="scale">
  <q-card class="text-black" style="width: 600px; height: 420px; background: rgb(255, 255, 255) !important;">
    <q-card-section id="basico1">
      <div style="display: flex">
        <span class="label basico" >Criterio: </span>
        <q-input outlined v-model="n_criterio" dense style="background: white !important; text-transform: uppercase;"></q-input>
        <span class="label basico" style="padding-left: 52px;">Porcentaje (%)</span>
        <q-input
        v-model.number="n_porcentaje"
        type="number"
        filled
        style="max-width: 100px; background: rgb(235, 235, 235) !important;"
        dense
      ></q-input>
        
      </div>
    </q-card-section>
    <q-card-section style="padding-top: 14px !important;  background: rgb(231, 231, 231) !important;">
      <div style="display: flex;">
      <div style="display: flex; justify-content: left; border: 1px solid #dcd3d3; padding-top: 7px; padding-bottom: 7px; width: 70%; background: white !important;border-radius: 5px;">
        
        <div id="cont_item">
          <span class="label" >Nombre Item</span>
          <q-input outlined v-model="n_item" dense style="margin-bottom: 10px; margin-top: 10px;"></q-input>
          <span class="label" >Andamiaje</span>
          <q-input style="margin-top: 10px;"
          v-model="andamiaje_item"
          filled
          type="textarea"
        ></q-input>
        </div>
        <div id="btn_conf_item">
          <q-fab style="position: relative; top:34px;"
            v-model="conf_item"
            label="Opciones"
            label-position="top"
            external-label
            color="black"
            icon="settings"
            direction="down"
            padding="xs"
          >
           <q-fab-action padding="5px" external-label label-position="bottom" color="primary" @click="eliminar_item" icon="delete_forever" label=""></q-fab-action>
            <q-fab-action padding="5px" external-label label-position="top" color="primary" @click="editar_item" icon="edit" label=""></q-fab-action>
          </q-fab>
        </div>
      </div>
      <div id="i_nuevo_contenedor">
        <div id="estilo_3">
          <q-btn class="text-black" color="white"  @click="agregar_item" icon-right="add_circle" label="Item"></q-btn>
        </div>
        <div id="item_nuevo">
          <div class="item_n" v-for = "(item,index) in item_criterio_temporal" v-bind:key = "index" @click = "seleccionar_item(item.id_i)">
              @{{item.n_item}}
            <span class="material-icons" style="font-size: 20px;">mode_edit</span>
          </div>
      </div>
    </div>
      </div>
    </q-card-section>

    <q-card-actions align="right" class="text-white" style="border-top: 1px solid #dcd3d3;">

      <q-btn flat icon-right="save" label="Criterio" class="text-black" @click="guardar_item_criterio" ></q-btn>
      <q-btn flat label="Cancelar" class="text-black" @click = "vaciar_modal_criterio" ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog> 

{{-- modal para cambiar valor de los niveles--}}
<q-dialog v-model="prompt" persistent>
  <q-card style="min-width: 350px">
    <q-card-section class="q-pt-none">
      
    </q-card-section>
    <q-card-section class="q-pt-none">
      <q-input dense v-model="n_nivel_act" autofocus></q-input>
    </q-card-section>

    <q-card-actions align="right" class="text-primary" color="black">
      <q-btn flat label="Cancelar" @click = "prompt = false;"> </q-btn>
      <q-btn flat label="Guardar" @click = "guardar_texto_nivel_cabecera"> </q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>


<!-- para mensajes de alerta-->
<q-dialog v-model="alert">
  <q-card>
    <q-card-section>
      <div class="text-h6">Información</div>
    </q-card-section >

    <q-card-section class="q-pt-none">
      <div class="alerta_t">@{{t_alert_1}}</div>
      
    </q-card-section >

    <q-card-actions align="right">
      <q-btn flat label="OK" color="primary" v-close-popup></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>

{{-- modal para edital texto niveles de criterios --}}

<q-dialog v-model="persistent2">
  <q-card>
    <q-card-section style="padding-top:13px;padding-bottom:8px;border-bottom:1px solid #d0d0d0;">
      <div style="display: flex; flex-direction: row;">
        <div style="font-size: 17px; font-weight: bold;">ITEMS: </div>
        <div v-for = "items in t_criterios.items" v-if = "items.id_c == id_criterio" style="padding-left: 10px; padding-top: 2px;">
       @{{items.n_item}}
        </div>
      </div>

    </q-card-section>

    <q-card-section style="max-height: 100px" cass="scroll">
      <q-input style="height:80px; width: 400px;"
      v-model="t_nivel_criterio_temp"
      filled
      type="textarea"
    ></q-input>
    </q-card-section>

    <q-card-actions align="right" style="margin-top: 67px;background: #114c0f;">
      <q-btn flat label="Cancelar" color="white" @click = "salir_texto_nivel" ></q-btn>
      <q-btn flat label="Guardar" color="white" @click = "guardar_texto_nivel" ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>

{{-- modal para andamiaje --}}
<q-dialog v-model="persistent3" persistent>
  <q-card style="width: 500px;">
    <q-card-section class="estilo7">
      <div style="font-size:16px;font-weight:500;line-height: 2rem;">ANDAMIAJE</div>
    </q-card-section>

    <q-card-section style="max-height: 50vh; background: #dad6d6;" class="scroll">
      {{-- conenido del andamieje --}}
      <div class="estilo12" v-for = "(cri,index) in t_criterios.criterio" v-bind:key = "index">
        <span class="estilo8">@{{cri.nombre}}</span>
        <div class="estilo9" v-for = "(item,index) in t_criterios.items" v-bind:key = "index" v-if = "item.id_c == cri.id_c">
          <span>@{{item.n_item}}:</span>
          <textarea class="estilo10" v-model=item.andamiaje></textarea>
          
          
        </div>
      </div>

    </q-card-section>

    <q-card-actions align="right" class="estilo11">
      <q-btn flat label="Listo" color="white" v-close-popup></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>
</div>

    <script src="https://cdn.jsdelivr.net/npm/vue@^2.0.0/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar@1.15.20/dist/quasar.umd.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.slim.js"
  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" 
  integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" 
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="scripts/inicio.js"></script>
    
</body>

</html>