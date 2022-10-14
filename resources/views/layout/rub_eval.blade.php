
<div style="display: flex; justify-content: center; height: 453px;">
  



  <div style="width: 35%; max-height: 507px; margin-top:25px;background: rgb(242, 242, 242);">
      <div style=" background: #ffffff; display: none">
          <q-input  label="Buscar..."  v-model="filtro" ></q-input>
      </div>
      <div>
        <q-select filled 
                v-model="tipo_eval" 
                use-input 
                :options="tipo_eval_" 
                option-value="id" 
                option-label="nombre" 
                {{-- input-debounce="0" --}}
                label="Seleccione caso" 
                {{-- behavior="menu" --}}
                @input="mostrar_casos" 
                    >
          </q-select>
      </div>
      <div id="filtrado">
        <template v-for="rub in rub_filtrado">
          <div class="row rub_1_exp" >
              <q-bar class="card_r_exp shadow-2 bg-white">
                  <div>
                      <div>@{{rub.nombre}}</div>
                      <div class="text-caption text-grey-7">@{{rub.descripcion}}</div>
                  </div>
                  <q-space></q-space>
                  <div class="status noselect bg-grey-4 text-grey-7">
                      @{{rub.estado}}
                  </div>
                  <q-btn padding="8px 5px" color="blue-6" icon="school" title="Evaluación" @click="evaluar_rubrica(rub.id)"></q-btn>
                  <q-btn padding="8px 5px" color="green-6" icon="remove_red_eye" title="Editar" @click="mostrar_rubrica_completa(rub)"></q-btn>

              </q-bar>
          </div>
        </template>
      </div>
      <div id="filtrado_e">
        <template v-for="rub in rub_filtrado_e">
          <div class="row rub_1_exp" >
              <q-bar class="card_r_exp shadow-2 bg-white">
                  <div>
                      <div>@{{rub.nombre}}</div>
                      <div class="text-caption text-grey-7">@{{rub.descripcion}}</div>
                  </div>
                  <q-space></q-space>
                  <div class="status noselect bg-grey-4 text-grey-7">
                      @{{rub.estado}}
                  </div>
                  <q-btn padding="8px 5px" color="green-6" icon="remove_red_eye" title="Visual" @click="mostrar_evaluacion(rub)"></q-btn>

              </q-bar>
          </div>
        </template>

      </div>
      
  </div>

  <div id="criterios_e" style="width: 35%;display:flex; flex-direction: row; margin-top:25px;justify-content: center;">
    <div id="criterios_c">
      <div style="display: flex;flex-direction: column; margin-bottom: 5px;">
        {{-- <div style="margin-bottom: 6px;">Criterios</div> --}}
        <q-select filled 
          v-model="m_criterio" 
          use-input 
          :options="t_criterios.criterio" 
          option-value="id_c" 
          option-label="nombre" 
          input-debounce="0"
          label="Criterios..." 
          behavior="menu"
          @input="llenar_items" 
          dense
          >
        </q-select>
      </div>
      <div style="display: flex;flex-direction: column; margin-bottom: 15px;">
        {{-- <div style="margin-bottom: 6px;">Items</div> --}}
        <q-select filled 
          v-model="m_item" 
          use-input 
          :options="item_criterio_temporal" 
          option-value="id_i" 
          option-label="n_item"             
          label="Items..." 
          behavior="menu"
          @input="activar_evaluacion"
          dense
          >
          </q-select>


      </div>
      <div class="estilo14">
        {{-- <div style="margin-bottom: 6px;">Suficiencia</div> --}}
          <q-input
            v-model.number="n_suficiencia"
            :disable="disable_c"
            type="number"
            outlined
            min = 1
            max = 4
            label="Suficiencia" 
  {{--      style="max-width: 100px; background: rgb(235, 235, 235) !important;" --}} 
            dense
            @change = "validar_limite()"
          ></q-input>  
      </div>  
      
      <div class="estilo14">
        {{-- <div style="margin-bottom: 6px;">Coherencia</div> --}}
        <q-input
          v-model.number="n_coherencia"
          :disable="disable_i"
          type="number"
          label="Coherencia" 
          outlined
          min = 1
          max = 4
{{--      style="max-width: 100px; background: rgb(235, 235, 235) !important;" --}} 
          dense
          @change = "validar_limite()"
        ></q-input>
      </div>
      <div class="estilo14">
        {{-- <div style="margin-bottom: 6px;">Relevancia</div> --}}
        <q-input
          v-model.number="n_relevancia"
          :disable="disable_i"
          type="number"
          label="Relevancia"
          outlined
          min = 1
          max = 4
{{--      style="max-width: 100px; background: rgb(235, 235, 235) !important;" --}} 
          dense
          @change = "validar_limite()"
        ></q-input>
      </div>
      <div class="estilo14">
        {{-- <div style="margin-bottom: 6px;">Claridad</div> --}}
        <q-input
          v-model.number="n_claridad"
          :disable="disable_i"
          type="number"
          label="Claridad"
          outlined
          min = 1
          max = 4
{{--      style="max-width: 100px; background: rgb(235, 235, 235) !important;" --}} 
          dense
          @change = "validar_limite()"
        ></q-input>
      </div>
      <div class="estilo14">
        {{-- <div style="margin-bottom: 6px;">Observación</div> --}}
        <q-input 
          {{-- style="margin-top: 10px;" --}}
          v-model="n_observacion"
          :disable="disable_i"
          label="Observación"
          outlined
          type="textarea"
          
          >
        </q-input>
      </div>
      <div style="display: flex;flex-direction: row;justify-content: space-evenly;">
        <q-btn color="green-6" icon-right="check_circle" label="Finalizar" @click="finalizar_evaluacion"></q-btn>
        <q-btn color="green-6" icon-right="add_circle" label="Guardar" @click="guardar_evaluacion_item"></q-btn>
      </div>
    </div>
   {{--  <div id="valores_e" >
     



    </div> --}}
</div>
</div>

<div id="rubrica_m" style="margin-top: 50px !important">
  <q-banner inline-actions rounded class="bg-primary text-white">
    RÚBRICA
   {{--  <template v-slot:action>
      <q-btn flat label="Mostrar" @click="mostrar_rubrica_completa2(id_rub_actual2)"></q-btn>
    </template> --}}
  </q-banner>
  <q-card class="column full-height">
    <q-card-section>
        <div class="text-h6">@{{n_rub_visual}}</div>
    </q-card-section>
    <q-separator></q-separator>
    <q-card-section class="col q-pt-none scroll">
        <div style="padding-top: 20px;">
          <div id="inferior">
            <div style="display: flex; justify-content: center;">
              <div style="width: 90%; display:flex; background:#f1f1f1">

            </div>
          </div>

            
            <div id="contenedor_rubrica"> 
            <div id="rubrica_interna">
          
              <div id="columnas">
          
                <div class="row nivel">
                  <div class="col cab_rub criterio" >Criterios</div>
                  <div class="col cab_rub" v-for = "(nivel,index) in t_niveles" v-bind:key = "index">
                    <span style="display: block">@{{nivel.texto}}</span>
                    <span>(@{{nivel.valor}})</span>

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
                          
                        </div>
                       
                  </div>
                  <div class="col cab_rub " v-for = "(nivel,index2) in t_niveles" v-bind:key = "index2" @click = "editar_nivel_criterio_v(criterio.id_c,nivel.valor)">
                    <span class="estilo6" v-for = "cri in t_criterios.texto_niveles" v-if = "criterio.id_c == cri.id_c && cri.nivel == nivel.valor ">@{{cri.texto}}</span>
                    
                    
                  </div>
          
                </div>
              </div>

            </div>
            </div>
            
          </div>            
            
            
        </div>
        
    </q-card-section>
    <q-separator></q-separator>
    <q-card-actions align="right">
      <div>          
        <q-btn flat label="Volver" color="green-9" @click="fullHeightRubrica3 = false"></q-btn>
      </div>
      <div>          
{{--           <q-btn flat label="Finalizar" color="green-9" @click="validacion_rubrica_completa"></q-btn>
--}}          {{-- <q-btn flat label="Guardar" color="green-9" @click="actualizar_bd()"></q-btn> --}}
      </div>
    </q-card-actions>
</q-card>

</div>



<!--MODAL DE evaluacion realizada SOLO VISUAL-->
<q-dialog v-model="eva_exp_v" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
  <q-card class="column full-height">
      <q-card-section>
          <div class="text-h6">Visual Evaluación Realizada</div>
      </q-card-section>
      <q-separator></q-separator>
      <q-card-section class="col q-pt-none scroll">
        <div id="evaluacion_m_e">
      
          <div v-for="(doc, index) in docentes_eval2_e" :key="index" class="cont_tabla">
            <table class = "tabla_e" style="width:90%">
              <tr>
                <td colspan="7" style="text-align: center;
                height: 35px;
                background: #3b2de8;
                color: white;
                font-weight: bold;
                border-radius: 6px;">@{{doc.nombres}}</td>
              </tr>
              <tr style="border-bottom: 1px solid black;">
                <th>CRITERIO</th>
                <th>ITEM</th>
                <th>SUFICIENCIA</th>
                <th>COHERENCIA</th>
                <th>RELEVANCIA</th>
                <th>CLARIDAD</th>
                <th>OBSERVACIÓN</th>
              </tr>
              <tr v-for="(crit, index_c) in criterio_e_2" :key="index_c" style="border-bottom: 1px solid #c2c2c2;">
                <td style="padding-left: 5px;">@{{crit.nombre}}</td>
                <td style="padding-left: 5px;">
                  <div v-for="(ite, index3) in items_e_2" :key="index3" v-if = "crit.id_criterio == ite.id_criterio" >
                    @{{ite.nombre}}{{-- , @{{ite.id_item}} --}}
                  </div>
                </td>
                <td style="text-align: center;">
                  <div v-for="(sufi, index4) in suficiancia_cal_2" :key="index4" 
                  v-if = "sufi.id_experto == doc.id_experto && sufi.id_criterio == crit.id_criterio" >
                    @{{sufi.suficiencia}}
                  </div>
                </td>
                <td style="text-align: center;">
                  <div v-for="(cohe, index5) in generales_cal_2" :key="index5" 
                  v-if = "cohe.id_criterio == crit.id_criterio && cohe.id_experto == doc.id_experto">
                  @{{cohe.coherencia}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
                    
                  </div>
                </td>
                <td style="text-align: center;">
                  <div v-for="(rele, index6) in generales_cal_2" :key="index6" 
                  v-if = "rele.id_criterio == crit.id_criterio && rele.id_experto == doc.id_experto">
                  @{{rele.relevancia}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
                  </div>
                </td>
                <td style="text-align: center;">
                  <div v-for="(cla, index7) in generales_cal_2" :key="index7" 
                  v-if = "cla.id_criterio == crit.id_criterio && cla.id_experto == doc.id_experto">
                  @{{cla.claridad}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
                  </div>
                </td>
                <td style="text-align: center;">
                  <div v-for="(obs, index8) in generales_cal_2" :key="index8" 
                  v-if = "obs.id_criterio == crit.id_criterio && obs.id_experto == doc.id_experto">
                  @{{obs.observacion}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
                  </div>
                </td>
                
        
              </tr>
            </table>
            <div class= "observaciones_g" v-for="(obs_gen, index9) in generales_obs_2" :key="index9" 
            v-if = "obs_gen.id_experto == doc.id_experto">
            @{{obs_gen.observacion}}
            </div>
        
          </div>
        </div>
          
      </q-card-section>
      <q-separator></q-separator>
      <q-card-actions align="right">
        <div>          
        <q-btn flat label="Volver" color="green-9" @click="eva_exp_v = false"></q-btn>
        </div>
      </q-card-actions>
  </q-card>
</q-dialog>

<!--MODAL DE RUBRICA SOLO VISUAL-->
<q-dialog v-model="fullHeightRubrica2" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
  <q-card class="column full-height">
      <q-card-section>
          <div class="text-h6">@{{n_rub_visual}}</div>
      </q-card-section>
      <q-separator></q-separator>
      <q-card-section class="col q-pt-none scroll">
          <div style="padding-top: 20px;">
            <div id="inferior">
              <div style="display: flex; justify-content: center;">
                <div style="width: 90%; display:flex; background:#f1f1f1">
                  {{-- <div class="btn_cab">
                    <q-btn flat class="btn_interno"  label="Añadir Criterio"  @click="fila_criterio(1)"></q-btn>
                  </div>
                  <div class="btn_cab">
                    <q-btn flat class="btn_interno"    label="Añadir Nivel"  @click="columna_nivel"></q-btn>
                  </div>
                  <div class="btn_cab2">
                    <q-btn flat class="btn_interno"   label="Andamiaje"  @click="editar_andamiaje"></q-btn>
                  </div> --}}

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
                      {{-- <q-btn v-if = "index <= 3" @click="modificar_texto_nivel(nivel.id_b)"  color="primary" text-color="white"  icon="edit" padding=none style="position: relative; left: 15px;"></q-btn>  
                      <q-btn v-if = "index > 3" @click = "eliminar_nivel(nivel.id_b,nivel.valor)"  color="white" text-color="primary"  icon="delete" padding=none style="position: relative; left: 15px;"></q-btn>  
                      <q-btn v-if = "index > 3" @click = "modificar_texto_nivel(nivel.id_b)"  color="white" text-color="primary"  icon="edit" padding=none style="position: relative; left: 16px;"></q-btn>   --}}
            
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
                            {{-- <q-fab 
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
                            </q-fab> --}}
                          </div>
                          {{-- <span class="material-icons" style="font-size: 25px;"  @click = "editar_criterio(index)">mode_edit</span>
                          <span class="material-icons" style="font-size: 25px;"  @click = "eliminar_criterio(criterio.id_c)">delete_forever</span> --}}
                    </div>
                    <div class="col cab_rub " v-for = "(nivel,index2) in t_niveles" v-bind:key = "index2" @click = "editar_nivel_criterio_v(criterio.id_c,nivel.valor)">
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
      <q-card-actions align="right">
        {{-- <div>          
          <q-btn flat label="Volver" color="green-9" @click="fullHeightRubrica2 = false"></q-btn>
        </div> --}}
        <div>          
{{--           <q-btn flat label="Finalizar" color="green-9" @click="validacion_rubrica_completa"></q-btn>
 --}}          {{-- <q-btn flat label="Guardar" color="green-9" @click="actualizar_bd()"></q-btn> --}}
        </div>
      </q-card-actions>
  </q-card>
</q-dialog>
{{-- fin de modal de visual de rubrica  --}}

{{-- modal para edital texto niveles de criterios --}}
<q-dialog v-model="persistent2_v">
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
      v-model="t_nivel_criterio_temp_v"
      filled
      type="textarea"
    ></q-input>
    </q-card-section>

    <q-card-actions align="right" style="margin-top: 67px;background: #114c0f;">
       <q-btn flat label="Salir" color="white" @click = "salir_visual_texto" ></q-btn>
       {{--  <q-btn flat label="Guardar" color="white" @click = "guardar_texto_nivel" ></q-btn> --}}
    </q-card-actions>
  </q-card>
</q-dialog>

{{-- para mensaje de finalizacion en caso de no finalizar --}}
<q-dialog v-model="confirm_1" persistent>
  <q-card>
    <q-card-section class="row items-center">
      <q-avatar icon="warning" color="primary" text-color="white" ></q-avatar>
      <span class="q-ml-sm">No se pudo finalizar, la evaluación no está completa</span>
    </q-card-section>

    <q-card-actions align="right">
      <q-btn flat label="Salir" color="primary" v-close-popup ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>

{{-- para mensaje de finalizacion en caso de si finalizar --}}
<q-dialog v-model="confirm_2" persistent >
  <q-card style="min-height: 300px !important;max-width: 444px;">
    <q-card-section class="row items-center">
      <div >
        <q-avatar icon="warning" color="primary" text-color="white" ></q-avatar>
        <span class="q-ml-sm">Aviso: Al finalizar la evaluación no podrá hacer cambios. </span>
        <span style="display: block;margin-top: 10px;" class="q-ml-sm">Ingrese una observación general de la evaluación </span>
      </div>
      
      <div style="min-height: 156px;">
        <q-input style="height:60px; width: 400px;"
        v-model="eva_observacion"
        filled
        type="textarea"
        ></q-input>
      </div>
      <div>
        <span class="q-ml-sm">¿Desea Continuar? </span>
      </div>
      
    </q-card-section>

    <q-card-actions align="right">
      <q-btn flat label="Aceptar" color="primary" @click="finalizar_evaluacion_confirmacion" ></q-btn>
      <q-btn flat label="Cancelar" color="primary" v-close-popup ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>

<q-dialog v-model="crit_4">
  <q-card>
    <q-card-section>
      <div class="text-h6">Mensaje</div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      Para que la rúbirca se considere completa debe contener un mínimo de 4 criterios con un porcentaje global del 100%.
    </q-card-section>

    <q-card-actions align="right">
      <q-btn flat label="OK" color="primary" v-close-popup ></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>