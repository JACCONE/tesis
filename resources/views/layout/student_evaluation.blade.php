<body>
    
    <div id="s_e_principal" style="display: flex;justify-content: center;" >
    <div class="q-pa-md" style="width: 75%">
    <q-table
      grid
      grid-header
      @row-click = "onRowClick"
      title="Gestor de Revisión"
      :data="s_e_rows"
      :columns="s_e_columns"
      row-key="name"
      :filter="filter_s_evaluation"
      hide-header
    >
      <template v-slot:top-right>
        <q-input borderless dense debounce="300" v-model="filter_s_evaluation" placeholder="Buscar">
          <template v-slot:append>
            <q-icon name="search"></q-icon>
          </template>
        </q-input>
      </template>
    </q-table>
    </div>
  </div>

  <div id="s_e_individual">
    <q-banner inline-actions rounded class="bg-primary text-white">
        Evaluación de tarea - @{{actual_homework}}
        <template v-slot:action>
          <q-btn flat label="Tarea" @click="abrir_link_evaluar"></q-btn>
          <q-btn flat label="Rubrica" @click="mostrar_rubrica_completa2(id_rub_actual2)"></q-btn>
          <q-btn flat label="Guardar" @click="s_e_save_evaluation"></q-btn>
          <q-btn flat label="Atrás" @click="onRowBack"></q-btn>
        </template>
      </q-banner>
  
      <div style="display: flex;justify-content: center;">
        <div class="q-pa-md" style="width: 50%">
          <template v-for="(item, index) in homework_items" :key="index">
            <div class="row">
              <div class="col" style="display: flex;align-items: center;">@{{item.nombre}}</div>
              <div class="col"><q-select filled v-model="s_e_evaluaciones[index]" 
                :options="t_niveles" 
                option-value="id" 
                option-label="valor" 
                {{-- :options="homework_options"  --}}label="Evaluación"></q-select></div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>

<!--MODAL DE RUBRICA SOLO VISUAL-->
<q-dialog v-model="fullHeightRubrica3" full-height full-width persistent :maximized="maximizedToggle" transition-show="slide-up" transition-hide="slide-down">
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

    