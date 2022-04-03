<div style="display: flex;padding-top: 30px; width: 90%;justify-content: center;">
    <div style="width: 25%;height: 508px; margin-right: 28px;">
        <div style="height: 10%;">
            <q-btn color="grey-11" style="width: 100%; height: 60px; color: black !important" @click="nueva_rubrica()">
                <q-icon left size="20px" name="edit"></q-icon>
                <div  style="margin-right: 43px;">EDITAR RÚBRICA</div>
                <q-btn unelevated round color="primary" icon="keyboard_arrow_down" style="display: none;"></q-btn>
                <q-btn outline round color="primary" icon="keyboard_arrow_up" style="display: none"></q-btn>
            </q-btn>
        </div>
        <div style="display: flex; flex-direction:column;justify-content: space-around;height: 89%;padding: 10px;;">
            <q-input v-model="n_rub" label="Nombre Rúbrica" dense></q-input>
            <q-input 
            v-model="d_rub" 
            filled
            type="textarea"
            color="black"
            label="Descripción Rúbrica"
            dense
            >
            </q-input>
            <q-select filled 
            v-model="s_asignatura" 
            use-input 
            :options="asignatura_filtro" 
            option-value="idmateria" 
            option-label="nombre" 
            input-debounce="0"
            label="Asignatura (UTM)" 
            behavior="menu"
            dense
            @input-value="filterFn_a" 
            {{-- @input="importDocente" --}}>
            </q-select>
        </div>
    </div>
    <div style="width: 40%;max-height: 507px;">
        <div style=" background: #ffffff;">
            <q-input  label="Buscar..."  v-model="filtro" ></q-input>
        </div>

        <q-scroll-area id="s_alto" style="height:86%; max-width: 100%; padding:10px;">
        <template v-for="(rub, index) in rub_filtrado" :key="index">
            <div class="row rub_1">
                <q-bar class="card_r shadow-2 bg-grey-2">
                    <div>
                        <div>@{{rub.nombre}}</div>
                        <div class="text-caption text-grey-7">@{{rub.descripcion}}</div>
                    </div>
                    <q-space></q-space>
                    <div class="status noselect bg-grey-4 text-grey-7">
                        @{{rub.estado}}
                    </div>
                    <q-btn padding="8px 5px" color="green-6" icon="edit" title="Editar" @click="mostrar_rubrica(rub)"></q-btn>
                    <q-btn padding="8px 5px" color="blue-6" icon="school" title="Evaluación" @click="get_expertos(rub.id)"></q-btn>
                </q-bar>
            </div>
        </template>
        </q-scroll-area>
  
    </div>
</div>



<!--MODAL DE EXPERTOS-->
<q-dialog v-model="fullHeight" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
  <q-card class="column full-height">
      <q-card-section>
          <div class="text-h6">Panel de evaluación</div>
      </q-card-section>
      <q-separator></q-separator>
      <q-card-section class="col q-pt-none scroll">
          <div class="eval_container_0" style="padding-top: 20px;">
              <div class="eval_container_1">
                  <div class="e_container eval_new">
                      <div class="text-grey-8" style="padding: 5px;display: flex;justify-content: center;font-size: 1.25rem;font-weight: 500;">Ingresar Nuevo Experto</div>
                      <div id="experto_base">
                          <q-select filled v-model="docente_seleccionado" use-input :options="docentes_filtro" option-value="idpersonal" option-label="nombre_select" label="Docente (UTM)" stack-label :dense="dense" @input-value="filterFn" @input="importDocente"></q-select>
                          <!--q-select filled v-model="model" :options="options" @filter="filterFn" style="width: 250px; padding-bottom: 32px"></q-select-->
                      </div>
                      <div id="experto_nuevo">
                          <div class="text-grey-8" style="padding: 5px;font-style: oblique;font-weight: 500;">Externo:</div>
                          <div>
                              <div class="row">
                                  <q-input class="col" outlined v-model="experto_nombres" label="Nombres" :dense="dense" style="padding: 3px;"></q-input>
                                  <q-input class="col" outlined v-model="experto_apellidos" label="Apellidos" :dense="dense" style="padding: 3px;"></q-input>
                              </div>
                              <div class="row">
                                  <q-input class="col" outlined v-model="experto_email" label="Correo electrónico" :dense="dense" style="padding: 3px;"></q-input>
                              </div>
                              <div class="row">
                                  <q-input class="col" outlined v-model="experto_formacion" label="Formación Académica" :dense="dense" style="padding: 3px;"></q-input>
                              </div>
                              <div class="row">
                                  <q-input class="col" outlined v-model="experto_cargo" label="Cargo Actual" :dense="dense" style="padding: 3px;"></q-input>
                              </div>
                              <div class="row">
                                  <q-input class="col" outlined v-model="experto_institucion" label="Institución" :dense="dense" style="padding: 3px;"></q-input>
                              </div>
                              <div class="row">
                                  <q-input class="col" outlined v-model="experto_pais" label="País" :dense="dense" style="padding: 3px;"></q-input>
                                  <q-input class="col" min = 1 outlined v-model="experto_anios" label="Años de Experiencia" type="number" :dense="dense" style="padding: 3px;"></q-input>
                              </div>

                          </div>
                          <div style="padding: 5px;display: flex;justify-content: end;">
                              <q-btn color="green-6" icon-right="add_circle" label="Agregar" @click="set_expertos"></q-btn>
                          </div>

                      </div>

                  </div>
                  <div class="e_container eval_list bg-grey-2">
                      <div class="text-grey-8" style="padding: 5px;display: flex;justify-content: center;font-size: 1.25rem;font-weight: 500;">Lista</div>
                      <div class="list_container">
                          <template v-for="(exp, index) in expertos_list" :key="index">
                              <div class="row rub_1">
                                  <q-bar class="card_r shadow-1 bg-grey-1">
                                      <div>
                                          <div>@{{exp.nombres}} @{{exp.apellidos}}</div>
                                          <div class="text-caption text-grey-7">@{{exp.email}} · @{{exp.cargo_actual}} · @{{exp.estado}}</div>
                                      </div>
                                      <q-space></q-space>
                                      <q-btn v-if="exp.estado == 'AGREGADO'" padding="8px 5px" color="blue-6" icon="forward_to_inbox" title="Enviar Invitación" @click="processOption(1,exp.id_experto,exp.nombres,exp.email)"></q-btn>
                                      <q-btn v-if="exp.estado == 'INVITADO'" padding="8px 5px" color="green-6" icon="thumb_up" title="Aceptó la invitación" @click="processOption(2,exp.id_experto,exp.nombres,exp.email)"></q-btn>
                                      <q-btn v-if="exp.estado == 'INVITADO'" padding="8px 5px" color="red-7" icon="thumb_down" title="Rechazó la invitación" @click="processOption(3,exp.id_experto,exp.nombres,exp.email)"></q-btn>
                                      <q-btn v-if="exp.estado == 'ACEPTADO'" padding="8px 5px" color="blue-6" icon="attach_email" title="Enviar rúbrica para evaluar" @click="processOption(4,exp.id_experto,exp.nombres,exp.email)"></q-btn>
                                      <div style="margin-right: 0px;" v-if="exp.estado == 'TERMINADO'" class="status noselect bg-grey-4 text-grey-7">
                                          @{{exp.estado}}
                                      </div>
                                      <div style="margin-right: 0px;" v-if="exp.estado == 'EVALUANDO'" class="status noselect bg-grey-4 text-grey-7">
                                          @{{exp.estado}}
                                      </div>
                                      <q-btn v-if="exp.estado == 'RECHAZADO'" padding="8px 5px" color="red-9" icon="delete" title="Eliminar" @click="processOption(5,exp.id_experto,exp.nombres,exp.email)"></q-btn>
                                  </q-bar>
                              </div>
                          </template>
                      </div>
                  </div>
              </div>
              <!--q-btn flat label="ENVIAR PRUEBA" color="green-9" @click="sendMail"></q-btn-->

          </div>

      </q-card-section>
      <q-separator></q-separator>
      <q-card-actions align="right">
          <q-btn flat label="SALIR" color="green-9" v-close-popup></q-btn>
      </q-card-actions>
  </q-card>
</q-dialog>


{{-- <!--MODAL DE EXPERTOS-->
<q-dialog v-model="fullHeight" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
    <q-card class="column full-height">
        <q-card-section>
            <div class="text-h6">Panel de evaluación</div>
        </q-card-section>
        <q-separator></q-separator>
        <q-card-section class="col q-pt-none scroll">
            <div style="padding-top: 20px;">
                
                <q-btn flat label="ENVIAR PRUEBA" color="green-9" @click="sendMail"></q-btn>
                
            </div>
            
        </q-card-section>
        <q-separator></q-separator>
        <q-card-actions align="right">
            <q-btn flat label="SALIR" color="green-9" v-close-popup></q-btn>
        </q-card-actions>
    </q-card>
</q-dialog>
<!--MODAL DE EXPERTOS--> --}}

<!--MODAL DE RUBRICA-->
<q-dialog v-model="fullHeightRubrica" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
  <q-card class="column full-height">
      <q-card-section>
          <div class="text-h6">@{{n_rub}}</div>
      </q-card-section>
      <q-separator></q-separator>
      <q-card-section class="col q-pt-none scroll">
          <div style="padding-top: 20px;">
            <div id="inferior">
              <div style="display: flex; justify-content: center;">
                <div style="width: 90%; display:flex; background:#f1f1f1">
                  <div class="btn_cab">
                    <q-btn flat class="btn_interno"  label="Añadir Criterio"  @click="fila_criterio(1)"></q-btn>
                  </div>
                  <div class="btn_cab">
                    <q-btn flat class="btn_interno"    label="Añadir Nivel"  @click="columna_nivel"></q-btn>
                  </div>
                  <div class="btn_cab2">
                    <q-btn flat class="btn_interno"   label="Andamiaje"  @click="editar_andamiaje"></q-btn>
                  </div>

                  {{-- <q-fab style="margin-left: 55px;"
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
                </q-fab> --}}
              </div>
            </div>
                <!--<q-btn flat round dense icon="settings"></q-btn> -->
                {{-- <q-toolbar-title style="text-align: center; font-size: 17px !important;font-weight: bold;padding-right: 115px;">
                  Rúbrica
                </q-toolbar-title> --}}
              
              <div id="contenedor_rubrica"> 
              <div id="rubrica_interna">
            
                <div id="columnas">
            
                  <div class="row nivel">
                    <div class="col cab_rub criterio" >Criterios</div>
                    <div class="col cab_rub" v-for = "(nivel,index) in t_niveles" v-bind:key = "index">
                      <span style="display: block">@{{nivel.texto}}</span>
                      <span>(@{{nivel.valor}})</span>
                      <q-btn v-if = "index <= 3" @click="modificar_texto_nivel(nivel.id_b)"  color="primary" text-color="white"  icon="edit" padding=none style="position: relative; left: 15px;"></q-btn>  
                      <q-btn v-if = "index > 3" @click = "eliminar_nivel(nivel.id_b,nivel.valor)"  color="white" text-color="primary"  icon="delete" padding=none style="position: relative; left: 15px;"></q-btn>  
                      <q-btn v-if = "index > 3" @click = "modificar_texto_nivel(nivel.id_b)"  color="white" text-color="primary"  icon="edit" padding=none style="position: relative; left: 16px;"></q-btn>  
            
                    </div>
                  </div>
                    
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
                              <q-fab-action padding="5px" external-label label-position="bottom" color="white" text-color="primary"  @click="editar_criterio(index)" icon="edit" label=""></q-fab-action>
                              <q-fab-action padding="5px" external-label label-position="top" color="white" text-color="primary" @click="eliminar_criterio(criterio.id_c)" icon="delete" label=""></q-fab-action>
                            </q-fab>
                          </div>
                          {{-- <span class="material-icons" style="font-size: 25px;"  @click = "editar_criterio(index)">mode_edit</span>
                          <span class="material-icons" style="font-size: 25px;"  @click = "eliminar_criterio(criterio.id_c)">delete_forever</span> --}}
                    </div>
                    <div class="col cab_rub " v-for = "(nivel,index2) in t_niveles" v-bind:key = "index2" @click = "editar_nivel_criterio(criterio.id_c,nivel.valor)">
                      <span class="estilo6" v-for = "cri in t_criterios.texto_niveles" v-if = "criterio.id_c == cri.id_c && cri.nivel == nivel.valor ">@{{cri.texto}}</span>
                      
                      
                    </div>
            
                  </div>
                </div>
{{--                 <q-page-sticky position="bottom-right" :offset="[18, 18]">
                  <q-btn fab icon="save" color="accent" @click = "actualizar_bd()"></q-btn>
                </q-page-sticky> --}}
              </div>
              </div>
              
            </div>            
              
              
          </div>
          
      </q-card-section>
      <q-separator></q-separator>
      <q-card-actions class="row justify-between">
        <div>          
          <q-btn flat label="Volver" color="green-9" @click="validacion_salir_edicion_rubrica"></q-btn>
        </div>
        <div>          
{{--           <q-btn flat label="Finalizar" color="green-9" @click="validacion_rubrica_completa"></q-btn>
 --}}          <q-btn flat label="Guardar" color="green-9" @click="actualizar_bd()"></q-btn>
        </div>
      </q-card-actions>
  </q-card>
</q-dialog>

<!--MODAL DE RUBRICA-->

<!-- MODAL DE CRITERIOS-->

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
          min = 1
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
            {{-- 
            <q-fab style="position: relative; top:34px;"
              v-model="conf_item"
              label="Opciones"
              label-position="top"
              external-label
              color="black"
              icon="settings"
              direction="down"
              padding="xs"
            > --}}
            <q-fab-action padding="5px" external-label label-position="top" color="primary" @click="editar_item" icon="edit" label="" ></q-fab-action>
             <q-fab-action padding="5px" external-label label-position="bottom" color="primary" @click="eliminar_item" icon="delete_forever" label="" style="margin-top: 10px" ></q-fab-action>
           {{--  </q-fab> --}}
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
<!--FIN MODAL DE CRITERIOS-->

  {{--MODAL DESCRIPCION NIVELES--}}
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
  {{-- FIN MODAL DESCRIPCION NIVELES--}}

{{-- modal para edital texto niveles de criterios --}}
<q-dialog v-model="persistent2">
  <q-card>
    <q-card-section style="padding-top:13px;padding-bottom:8px;border-bottom:1px solid #d0d0d0;">
      <div style="display: flex; flex-direction: row;">
        <div style="font-size: 17px; font-weight: bold;">ITEMS: </div>
        <div v-for = "items in t_criterios.items" v-if = "items.id_c == id_criterio"  style="padding-left: 10px; padding-top: 2px;">
       @{{items.n_item}}
        </div>
      </div>

    </q-card-section>

    <q-card-section style="max-height: 100px">
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
{{--FIN modal para edital texto niveles de criterios --}}

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
{{--FIN modal para andamiaje --}}

{{-- modal para nombre y descripcion de la rubrica al guardar --}}
<q-dialog v-model="persistent4" persistent>
  <q-card style="min-width: 350px">
    <q-card-section class="estilo7">
      <div style="font-size:16px;font-weight:500;line-height: 2rem;">Datos Generales</div>
    </q-card-section>

    <q-card-section class="q-pt-none scroll">
      <div class="estilo13">Nombre Rúbrica</div>
      <q-input dense v-model="n_rubrica"></q-input>
      <div class="estilo13">Descripción Rúbrica</div>
      <q-input dense v-model="d_rubrica"></q-input>
    </q-card-section>

    <q-card-actions align="right" class="estilo11">
      <q-btn flat label="Cancelar" color="white" v-close-popup></q-btn>
      <q-btn flat label="Guardar" color="white" @click="guardar_rubrica_bd"></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>
{{--FIN modal para nombre y descripcion de la rubrica al guardar --}}

{{-- modal para nombre y descripcion de la rubrica al acttalizar --}}
<q-dialog v-model="persistent5" persistent>
  <q-card style="min-width: 350px">
    <q-card-section class="estilo7">
      <div style="font-size:16px;font-weight:500;line-height: 2rem;">Datos Generales</div>
    </q-card-section>

    <q-card-section class="q-pt-none scroll">
      <div class="estilo13">Nombre Rúbrica</div>
      <q-input dense v-model="n_rubrica"></q-input>
      <div class="estilo13">Descripción Rúbrica</div>
      <q-input dense v-model="d_rubrica"></q-input>
    </q-card-section>

    <q-card-actions align="right" class="estilo11">
      <q-btn flat label="Cancelar" color="white" v-close-popup></q-btn>
      <q-btn flat label="Actualizar" color="white" @click="actualizar_rubrica_bd"></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>
{{--FIN modal para nombre y descripcion de la rubrica al acttalizar --}}

{{-- modal para mensaje antes de cargar la rubrica seleccionada --}}
<q-dialog v-model="alert4">
  <q-card>
    <q-card-section style="padding-top:13px;padding-bottom:8px;border-bottom:1px solid #d0d0d0;">
      <div class="text-h6">Importante:</div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div>Usted tiene una rubrica en edición si continúa perderá la Información, puede guardar la Rúbrica
        antes de continuar, de clic en continuar si No desea guardar la rúbrica en edición </div>
    </q-card-section>

    <q-card-actions align="right" style="background: #114c0f;">
      <q-btn flat label="Continuar" color="white" @click = "salir_edicion_rubrica()"></q-btn>
      <q-btn flat label="Cancelar" color="white" v-close-popup></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>
{{-- FIN modal para mensaje antes de cargar la rubrica seleccionada --}}

{{-- modal para texto de alerta para casos de texto de criterios en niveles --}}
<q-dialog v-model="alert3">
  <q-card>
    <q-card-section style="padding-top:13px;padding-bottom:8px;border-bottom:1px solid #d0d0d0;">
      <div class="text-h6">Importante:</div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div>Los siguientes items no están considerados en el texto: </div>
      <div>
          <ul>
            <li v-for = "it in no_items">
              @{{it}}
            </li>
          </ul>
      </div>
      <div>Click en cancelar para volver a editar</div>
      <div>Click en Guardar para continuar</div>
    </q-card-section>

    <q-card-actions align="right" style="background: #114c0f;">
      <q-btn flat label="Guardar" color="white" @click = "guardar_confirmacion_texto_niveles(validador)"></q-btn>
      <q-btn flat label="Cancelar" color="white" v-close-popup></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>
{{--FIN modal para texto de alerta para casos de texto de criterios en niveles --}}

{{--  para mensajes de alerta --}}
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
{{--FIN  para mensajes de alerta --}}


