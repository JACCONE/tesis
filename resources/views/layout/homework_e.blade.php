<div style="display: flex;flex-flow: row;justify-content: center;">
    <div v-for="(tar, index) in tareas_estudiante" :key="index" style="padding: 11px;">
        <q-card class="my-card" style="max-width: 450px;width: 450px;">
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
            
            </q-card-section>
    
            <q-card-actions vertical>
            <q-btn flat>Abrir</q-btn>
            </q-card-actions>
        </q-card>
    </div>
</div>
  