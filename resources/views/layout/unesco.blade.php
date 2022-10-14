<div class="titulo_n">Nomenclatura Internacional de la UNESCO para los campos de Ciencia y Tecnología</div>
<div>
    <div  class="titulo_bu">
        <div class = "campos_e" @click="mostrar_campo">INGRESAR CAMPO</div>
        <div class = "campos_e" @click="mostrar_disciplina">INGRESAR DISCIPLINA</div>
        <div class = "campos_e" @click="mostrar_subdisciplina">INGRESAR SUBDISCIPLINA</div>
    </div>
    <div id="completo">
        <div class="cont_une">
            <div id="combo_campo">
                <q-select filled 
                v-model="s_campo" 
                use-input 
                :options="campos_u" 
                option-value="id" 
                option-label="nombre" 
                {{-- input-debounce="0" --}}
                label="Seleccione Campo" 
                {{-- behavior="menu" --}}
                {{-- dense --}}
                @input="llenar_disciplinas2" 
                >
                </q-select>
            </div>
            <div id="combo_disciplina">
                <q-select filled 
                v-model="s_disciplina" 
                use-input 
                :options="disciplinas_u" 
                option-value="id" 
                option-label="nombre" 
                {{-- input-debounce="0" --}}
                label="Seleccione Disciplina" 
                {{-- behavior="menu" --}}
                
                @input="llenar_subdisciplinas2" 
                >
                </q-select>
            </div>
            
            <div id="combo_subdisciplina">
                <q-select filled 
                v-model="s_subdisciplina" 
                use-input 
                :options="subdisciplinas_u" 
                option-value="id" 
                option-label="nombre" 
                {{-- input-debounce="0" --}}
                label="Seleccione Subdisciplina" 
                {{-- behavior="menu" --}}
                @input="llenar_bandera" 
                
                    >
                </q-select>
            </div>
            
        </div>
    </div>
    <div class="solo_campo" id="solo_campo_">
        <div style="width: 30%;padding: 17px;" id="input_campo">
            <q-input  label="Ingresar" outlined  v-model="campo_t"></q-input>
        </div>
        <div style="width: 30%;padding: 17px;" id="input_dis">
            <q-input  label="Ingresar" outlined  v-model="disciplina_t"></q-input>
        </div>
        <div style="width: 30%;padding: 17px;" id="input_sdis">
            <q-input  label="Ingresar" outlined  v-model="subdisciplina_t"></q-input>
        </div>
        <div class="solo_btn">
            <q-btn color="green-6" icon="save" title="Agregar" @click="editar_campo"></q-btn>
            <q-btn color="green-6" icon="clear" title="Limpiar" @click="limpiar_campo"></q-btn>
            <q-btn color="green-6" icon="delete" title="Limpiar" @click="eliminar_campo"></q-btn>
        </div>
    </div>
        


</div>

