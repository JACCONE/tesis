<div class="descarga">
    <div id="combo_campo">
        <q-select filled 
        v-model="s_campo_d" 
        use-input 
        :options="campos_u_d" 
        option-value="id" 
        option-label="nombre" 
        {{-- input-debounce="0" --}}
        label="Seleccione Campo" 
        {{-- behavior="menu" --}}
        {{-- dense --}}
        @input="llenar_disciplinas2_d" 
        >
        </q-select>
    </div>
    <div id="combo_disciplina">
        <q-select filled 
        v-model="s_disciplina_d" 
        use-input 
        :options="disciplinas_u_d" 
        option-value="id" 
        option-label="nombre" 
        {{-- input-debounce="0" --}}
        label="Seleccione Disciplina" 
        {{-- behavior="menu" --}}
        
        @input="llenar_subdisciplinas2_d" 
        >
        </q-select>
    </div>
    
    <div id="combo_subdisciplina">
        <q-select filled 
        v-model="s_subdisciplina_d" 
        use-input 
        :options="subdisciplinas_u_d" 
        option-value="id" 
        option-label="nombre" 
        {{-- input-debounce="0" --}}
        label="Seleccione Subdisciplina" 
        {{-- behavior="menu" --}}
        @input="llenar_bandera" 
        
            >
        </q-select>
    </div>
    <div id="d_e_rubrica" style="display: flex;padding-right: 237px;padding-top: 20px;">
        <span style="line-height: 30px;font-size: 19px;font-weight: bold;color: black;">Descargar</span> 
        <q-btn icon="download" @click="descargar_e_r" dense flat></q-btn>
        <a id="test3_n" href="" style = "display = none">test.xls</a>
      </div>


</div>