<div id="aut" style="height: 100%;">
<div style="display: grid; grid-template-columns: 25% 75%; height: 100%;">
  <div  style="padding: 10px;height: 100vh;overflow-y: auto;">
    <div style="width: 100%;padding: 10px;">
      <q-select outlined
        v-model="rubricas_eval" 
        :options="rub_evaluadas" 
        option-value="id_rubrica" 
        option-label="nombre" 
        label="Rúbricas" 
        behavior="menu"
        @input="expertos_rubrica"
        dense
        >
      </q-select>
    </div>
    <div style="width: 100%;padding: 10px;">
      <q-select outlined
        v-model="metricas_s" 
        :disable ="m_disabled"
        :options="metricas" 
        option-value="id_metrica" 
        option-label="nombre" 
        label="Métricas" 
        behavior="menu"
        @input="mostrar_metrica"
        dense
        >
      </q-select>
      
     </div>
     <div style="width: 100%;padding: 10px;" id="docentes_eva">
      <q-select outlined
        v-model="docentes_eval" 
        multiple
        :options="doc_eval" 
        option-value="id_experto" 
        option-label="nombres" 
        label="Expertos" 
        behavior="menu"
        
        {{-- @input="llenar_items" --}}
        dense
        >
        <template v-slot:append>
          <q-btn round dense flat icon="search" @click="mostrar_evaluaciones" ></q-btn>
        </template>
      </q-select>
     </div>

{{--      <div style="width: 100%;padding: 10px;" id="tareas_doc">
      <q-select outlined
        v-model="tareas_docente"  
        :options="t_docente" 
        option-value="id" 
        option-label="nombre" 
        label="Tareas" 
        behavior="menu"
        dense
        >
        <template v-slot:append>
          <q-btn round dense flat icon="search" @click="mostrar_alfa" ></q-btn>
        </template>
      </q-select>
     </div>
 --}}
  </div>
  <div id="evaluacion" style="padding: 10px;height: 100vh;overflow-y: auto;">
    <div style="display: flex;justify-content: end;padding: 7px;">
      <span style="line-height: 30px;font-size: 15px;font-weight: bold;color: black;">Download</span> 
      <q-btn icon="download" @click="excel_download" dense flat></q-btn>
      <a id="test2" href="" style = "display = none">test.xls</a>
    </div>
    <div id="evaluacion_m">
      
    <div v-for="(doc, index) in docentes_eval2" :key="index" class="cont_tabla">
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
        <tr v-for="(crit, index_c) in criterio_e" :key="index_c" style="border-bottom: 1px solid #c2c2c2;">
          <td style="padding-left: 5px;">@{{crit.nombre}}</td>
          <td style="padding-left: 5px;">
            <div v-for="(ite, index3) in items_e" :key="index3" v-if = "crit.id_criterio == ite.id_criterio" >
              @{{ite.nombre}}{{-- , @{{ite.id_item}} --}}
            </div>
          </td>
          <td style="text-align: center;">
            <div v-for="(sufi, index4) in suficiancia_cal" :key="index4" 
            v-if = "sufi.id_experto == doc.id_experto && sufi.id_criterio == crit.id_criterio" >
              @{{sufi.suficiencia}}
            </div>
          </td>
          <td style="text-align: center;">
            <div v-for="(cohe, index5) in generales_cal" :key="index5" 
            v-if = "cohe.id_criterio == crit.id_criterio && cohe.id_experto == doc.id_experto">
            @{{cohe.coherencia}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
              
            </div>
          </td>
          <td style="text-align: center;">
            <div v-for="(rele, index6) in generales_cal" :key="index6" 
            v-if = "rele.id_criterio == crit.id_criterio && rele.id_experto == doc.id_experto">
            @{{rele.relevancia}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
            </div>
          </td>
          <td style="text-align: center;">
            <div v-for="(cla, index7) in generales_cal" :key="index7" 
            v-if = "cla.id_criterio == crit.id_criterio && cla.id_experto == doc.id_experto">
            @{{cla.claridad}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
            </div>
          </td>
          <td style="text-align: center;">
            <div v-for="(obs, index8) in generales_cal" :key="index8" 
            v-if = "obs.id_criterio == crit.id_criterio && obs.id_experto == doc.id_experto">
            @{{obs.observacion}}{{-- , @{{cohe.id_criterio}}, @{{cohe.id_item}} --}}
            </div>
          </td>
          

        </tr>
      </table>
      <div class= "observaciones_g" v-for="(obs_gen, index9) in generales_obs" :key="index9" 
      v-if = "obs_gen.id_experto == doc.id_experto">
      @{{obs_gen.observacion}}
      </div>

    </div>
  </div>
  <div id="cvi_general">
    {{-- <div style="display: flex;justify-content: end;padding: 7px;">
      <span style="line-height: 30px;font-size: 15px;font-weight: bold;color: black;">Download</span> 
      <q-btn icon="download" @click="excel_download" dense flat></q-btn>
      <a id="test2" href="" style = "display = none">test.xls</a>
    </div> --}}
    <div style="padding: 20px;display: grid;">
      {{-- <div>Índice de validación de contenido general (IVCG)</div>
      <div>
        <q-input outlined v-model="cvi_general" label="Outlined" dense></q-input>
      </div> --}}
      <table id="tbl_6" class="tabla_e">
        <tr>
          <td colspan="4" class = "tbl_6_tit">Índice de validación de contenido general (IVCG) de la rúbrica</td>
        </tr>
        <tr style="height: 26px;border-bottom: 1px solid black;">
          <th style="width: 30%">Experto</th>
          <th style="width: 20%">Items calificados entre 3 y 4</th>
          <th style="width: 25%">Items del instrumento</th>
          <th style="width: 25%">IVC=ne/N</th>
        </tr>
        <tr v-for="(cvig, index) in array_tbl_6" :key="index" class="tbl_6_tr">
          <td>@{{cvig.expertos}}</td>
          <td style="text-align: center">@{{cvig.items_entre_3_y_4}}</td>
          <td style="text-align: center">@{{cvig.items_totales}}</td>
          <td style="text-align: center">@{{cvig.total}}</td>
        </tr>
        <tr class="tbl_6_tr">
          <td></td>
          <td></td>
          <td style="text-align: center">IVC GENERAL</td>
          <td style="text-align: center">@{{ICV_G2}}</td>
        </tr>
      </table>
    </div>

  </div>
  <div id="satis_validez">
    <div>
      <div id="validez" style="padding: 20px;display: grid;">
        <table class="tabla_e">
          <tr>
            <td colspan="4" class = "tbl_6_tit">Percepción de la validez de la Rúbrica por los estudiantes</td>
          </tr>
          <tr style="height: 26px;border-bottom: 1px solid black;">
            <th style="width: 30%">Calificación</th>
            <th style="width: 20%">Frecuencia</th>
            <th style="width: 25%">Porcentaje</th>
            <th style="width: 25%">Porcentaje Acumulado</th>
          </tr>
          <tr v-for="(val, index) in tbl_fre_pro_1" :key="index" class="tbl_6_tr">
            <td style="text-align: center">@{{val.nivel}}</td>
            <td style="text-align: center">@{{val.frecuencia}}</td>
            <td style="text-align: center">@{{val.porcentaje}}</td>
            <td style="text-align: center">@{{val.porcentaje_a}}</td>
          </tr>
        </table>
      </div>
      <div id="satisfacción" style="padding: 20px;display: grid;">
        <table class="tabla_e">
          <tr>
            <td colspan="4" class = "tbl_6_tit">Percepción de la satisfacción de la Rúbrica</td>
          </tr>
          <tr style="height: 26px;border-bottom: 1px solid black;">
            <th style="width: 30%">Calificación</th>
            <th style="width: 20%">Frecuencia</th>
            <th style="width: 25%">Porcentaje</th>
            <th style="width: 25%">Porcentaje Acumulado</th>
          </tr>
          <tr v-for="(val2, index) in tbl_fre_pro_2" :key="index" class="tbl_6_tr">
            <td style="text-align: center">@{{val2.nivel}}</td>
            <td style="text-align: center">@{{val2.frecuencia}}</td>
            <td style="text-align: center">@{{val2.porcentaje}}</td>
            <td style="text-align: center">@{{val2.porcentaje_a}}</td>
          </tr>
        </table>

      </div>
      <div class="sat_v">
        <div class="sal_v2">Porcentaje satisfacción Validez de la Rúbrica</div>
        <div class="sat_v3">@{{satis_vali}}</div>
      </div>

    </div>

  </div>
  <div id="v_aiken">
    <div style="display: grid;margin-top: 20px;">
      <table class="tabla_e">
        <tr>
          <td colspan="6" class = "tbl_6_tit">Resultado del análisis cuantitativo de la V de Aiken</td>
        </tr>
        <tr style="height: 26px;border-bottom: 1px solid black;">
          <th style="width: 25%">Criterio</th>
          <th style="width: 15%">Suficiencia</th>
          <th style="width: 15%">Coherencia</th>
          <th style="width: 15%">Relevancia</th>
          <th style="width: 15%">Claridad</th>
          <th style="width: 15%">Total</th>
        </tr>
        <tr v-for="(aiken, index) in tbl_v_aiken" :key="index" class="tbl_6_tr">
          <td style="text-align: center">@{{aiken.nombre}}</td>
          <td style="text-align: center">@{{aiken.suficiencia}}</td>
          <td style="text-align: center">@{{aiken.coherencia}}</td>
          <td style="text-align: center">@{{aiken.relevancia}}</td>
          <td style="text-align: center">@{{aiken.claridad}}</td>
          <td style="text-align: center">@{{aiken.total}}</td>
        </tr>
        <tr v-for="(aiken_f, index) in tr_v_aiken_f" :key="index" class="tbl_6_tr">
          <td style="text-align: center">@{{aiken_f.nombre}}</td>
          <td style="text-align: center">@{{aiken_f.suficiencia}}</td>
          <td style="text-align: center">@{{aiken_f.coherencia}}</td>
          <td style="text-align: center">@{{aiken_f.relevancia}}</td>
          <td style="text-align: center">@{{aiken_f.claridad}}</td>
          <td style="text-align: center">@{{aiken_f.total}}</td>
          
        </tr>
      </table>
    </div>

  </div>
  <div id="alfa_cron">
    <div style="display: grid;margin-top: 20px;">
      <table class="tabla_e">
        <tr>
          <td colspan="6" class = "tbl_6_tit">Estadísticas de elemento</td>
        </tr>
        <tr style="height: 26px;border-bottom: 1px solid black;">
          <th style="width: 50%">Criterio</th>
          <th style="width: 25%">Media</th>
          <th style="width: 25%">Varianza</th>
        </tr>
        <tr v-for="(alfa, index) in tbl_alfa" :key="index" class="tbl_6_tr">
          <td style="text-align: center">@{{alfa.nombre}}</td>
          <td style="text-align: center">@{{alfa.promedio}}</td>
          <td style="text-align: center">@{{alfa.varianza}}</td>
        </tr>
      </table>
    </div>
    <div class="sat_v" style="margin-top: 25px;display: flex;justify-content: center;">
      <div class="sal_v2">Alfa de Cronbanch</div>
      <div class="sat_v3">@{{alfa_c}}</div>
    </div>


    
    
    
  </div>
  </div>
</div>
</div>

