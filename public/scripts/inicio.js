const aut = new Vue({
  
  el: '#aut',
  data: {
    user:'', //v-model
    correo:'',
    password:'',
    id_pesonal_temp:'',

    //NUEVAS 2021-11-04
    username:'',
    email: '',
    plantilla_name:'Inicio',
    modulos:[],
    currentPage:'rubrica',
    rub_general: [],
    rub_general_expertos: [],
    fixed: false,
    maximizedToggle: true,
    fullHeight: false,
    fullHeightRubrica: false,
    fullHeightRubrica2: false, // PARA VISUAL DE RUBRICA SOLO VISUAL SIN EDICION
    drawer:false,
    //NUEVAS 2021 -12-08
    //PARA INGRESAR EXPERTO
    experto_nombres:'',
    experto_apellidos:'',
    experto_formacion:'',
    experto_cargo:'',
    experto_institucion:'',
    experto_pais:'',
    experto_anios:'',
    experto_email:'',
    dense:false,
    id_rubrica_actual:'',
    expertos_list:[],
    docentes_filtro: [],
    docente_seleccionado:'',
    label2:'',
    //para nuevos cambios en rub Jorge
    n_rub : '',
    d_rub : '',
    id_rub_temp: '',
    s_periodo:'',
    bandera_unesco:'',// 1-> campo, 2->disciplina, 3-> subdisciplina
    s_campo:'', // model de select de campos
    campos_u:[], // variable que contiene los campos
    campo_t:'',
    control_cam:0,
    control_dis:0,
    control_sub:0,
    s_disciplina:'', // model de select de disciplinas
    disciplinas_u:[], // variable que contiene las disciplinas
    disciplina_t:'',
    s_subdisciplina:'', // model de select de subdisciplinas
    subdisciplinas_u:[], // variable que contiene las subdisciplinas
    subdisciplina_t:'',
    s_asignatura:'',
    campo_periodo :[], // quemado por el momento, se debe llenar con una peticion
    campo_asignatura :[{
      "id":2, "nombre_a": 'Matemáticas'
    }],
    rub_filtrado: [], //para el buscador de rubricas
    rub_filtrado_expertos: [], // para el buscador de rubricas a evaluar

    texto: '', // ""
    texto_exp: '',
  //PARA LA GESTION DE LA RUBRICA
  t_niveles :[ // niveles de l cabecera de la rubrica
    {texto: 'Totalmente Adecuado', valor: 4, id_b: 'b1', id:0, id_r:0},
    {texto: 'Bastante Adecuado', valor: 3, id_b:  'b2', id:0, id_r:0},
    {texto: 'Adecuado', valor: 2, id_b: 'b3', id:0, id_r:0},
    {texto: 'Nada Adecuado', valor: 1, id_b: 'b4',id:0, id_r:0}
  ],
  t_criterios:{ //este array maneja toda la informacion referente a los criterios en la matriz
    criterio : [],
    items : [],
    texto_niveles : [/*{id_c: 'cri1', nivel: 4, texto: "el ldsmsldalskd lkamdlaskd"} */]
  },
  c_niveles: 4, // utilizada en metodos para controlar y cambiar el campo valor de los niveles
  c_criterios: 0, // 
  c_item: 0, //temporal para cantidad de item por criterio, al guardar criterio debe volver a cero
  id_criterio: 0, //temporal para id criterio generado, al guardar criterio debe ser '' nuevamente
  criterio_id: 0, // para generar id de criterios
  item_id: 0, // para generar id de items
  control_guardar_editar: 1, // 1 para guardar, 2 para editar criterio
  item_criterio_temporal : [
  ],
  //todos los valores de id generados se deben actualizar al iniciar una edicion de cualquier rúbrica    
  n_nivel_act: '',//esta variable es para manejar el nombre actual del texto del nivel a modificar
  id_b_actual: '',//esta variable es para manejar el id_b actual modificado del nivel 
  b_id: 4, // para generar id de botones eliminar
  item_tem_id: '', // usado para eliminar o actualizar items    
  persistent: false,
  persistent2:false,
  n_criterio: '', //temporal para nombre del criterio
  n_porcentaje: '', //v-model para porcentaje de criterio
  n_item: '',
  andamiaje_item: '', //temporal para andamiaje por item
  fab1: false,
  t_nivel_criterio_temp: '',  //temporal para el texto del nivel por criterio
  persistent3:false,
  persistent4:false,
  persistent5:false,
  n_rubrica:'',
  d_rubrica:'',
  alert3: false,
  alert4:false,
  alert: false,
  t_alert_1: 'Campos Nombre Item y Andamiaje son obligatorios',
  prompt: false,
  validador: 1,
  no_items: [], //array para nombres de items no nombrados en texto niveles antes de guardar
  porcentaje_temp: 0,
  asignatura_seleccionado: '',
  asignatura_filtro:[],
  total_asig: [],
  control:0,// control para guardar editar rubrica
  // 19/12/2021 para parte nueva de gestor de evaluaciones
  externo: false,
  cabecera_eval: [
  'CRITERIO',
  'ITEM',
  'SUFICIENCIA',
  'COHERENCIA',
  'RELEVANCIA',
  'CLARIDAD',
  'OBSERVACIÓN'
  ],
  temp: 0, //para control de construccion de matriz de evaluacion de rubrica
  n_coherencia:'',
  n_relevancia:'',
  n_claridad:'',
  n_suficiencia:'',
  n_observacion:'',
  m_criterio:'',
  m_item:'',
  disable_c:true,
  disable_i:true,
  id_rub_exp_temp: '',
  id_eval_exp: '',
  id_eval_temp_gen: 11111111,
  id_eval_temp_suf: 11111111,
  n_rub_visual:'',
  persistent2_v:false,
  t_nivel_criterio_temp_v: '',
  confirm_1:false,
  confirm_2:false,
  eva_observacion: '',
  crit_4: false,
  // para gestion de tareas docente
  dense:false,
        fixed: false,
        maximizedToggle: true,
        drawer: false,
        //NUEVOS HACIA ABAJO
        homeworks: [
          {id_tarea: 1, materia: "BASE DE DATOS", nombre: "TAREA 1",fecha: "20/01/2022 16:00 - 20/02/2022 16:00",estado: "EN DESARROLLO"},
          {id_tarea: 2, materia: "BASE DE DATOS", nombre: "TAREA 2",fecha: "20/01/2022 16:00 - 20/02/2022 16:00",estado: "EN DESARROLLO"},
          {id_tarea: 3, materia: "BASE DE DATOS", nombre: "TAREA 3",fecha: "20/01/2022 16:00 - 20/02/2022 16:00",estado: "EN DESARROLLO"}],
        each_tarea:false,
        tarea_actual:'nueva tarea',
        id_tarea_actual: 0,
        tarea_nombre:'',
        tarea_descripcion:'',
        tarea_url:'',
        tarea_inicio:'2019/02/01',
        tarea_fin:'2019/02/01',
        tarea_nota_maxima:'',
        periodo_actual:'',
        tarea_info:false,
        materia_lista:'',
        paralelo_lista:'',
        materia_lista_options:[],
        paralelo_lista_options:[],
        periodo_dense:true,
        id_tarea_temp: 0,
        disable_periodo: true,
        disable_paralelo:true,
        control_nueva_tarea:0,
        rubrica_tarea_options:[],
        rubrica_tarea:'',
        mensaje_tarea: false,
        valor_asignaciones : false,
        cantidad_tareas: 2,
        mensaje_v : '',
        maximo : 0,
        estudiantes_add:[],
        estudiantes_lista: [],
        estudiantes_entrega:[],
        estudiantes_evaluar:[],
        validar_ciclo : 0,
        array_ciclo: [],
        tareas_estudiante : [],
        materias_estudiante: [],
        tarea_estudiante_info: false,
        tarea_descripcion_e:'',
        tarea_url_e:'',
        fecha_fin_e:'',
        tarea_url_e:'',
        adjunto_e: '',
        disable_entrega:true,
        id_tarea_temp_e: 0,
        asignatura_actual_temp: 0,
          c_eval_pares:0,
          eval_fin:'',
          //parte para evaluacion por pares de estudiantes
          filter_s_evaluation:'',
           //parte para evaluacion por pares de estudiantes
          filter_s_evaluation_t:'',
          pagination: {
            rowsPerPage: 30 // current rows per page being displayed
          },
          s_e_columns: [
            {
              name: 'desc',
              required: true,
              label: 'Nombre de tarea',
              align: 'left',
              field: row => row.nombre_tarea,
              sortable: true
            },
           // { name: 'description', align: 'center', label: 'Descripción', field: 'd_tarea', sortable: true },
            { name: 'course', label: 'Asignatura', field: 'nombre_mat', sortable: true },
            { name: 'teacher', label: 'Docente', field: 'docente' },
           // { name: 'status', label: 'Estado', field: 'estado' }
          ],
          s_e_rows: [],
            s_e_columns_t: [
              {
                name: 'desc',
                required: true,
                label: 'Nombre de tarea',
                align: 'left',
                field: row => row.nombre_tarea,
                sortable: true
              },
             // { name: 'description', align: 'center', label: 'Descripción', field: 'd_tarea', sortable: true },
              { name: 'course', label: 'Asignatura', field: 'nombre_mat', sortable: true },
              { name: 'teacher', label: 'Docente', field: 'docente' },
             // { name: 'status', label: 'Estado', field: 'estado' }
            ],
            s_e_rows_t:[],

            homework_items: [   
            ],
            actual_homework: '',
            id_rub_actual2: 0, 
            s_e_evaluaciones:[],
            homework_options: [1, 2, 3, 4, 5],
            btn_guadar_tarea:false,
            fullHeightRubrica3 : false,
            link_evaluar:'',
            id_asig_estu: 0,
             //para la parte de cuestionarios de validacion y satisfaccion
            question: false,
            validacion:[],
            cabecera_pregunta_validacion:[
              {
                'id_tipo': 1,
                'cabecera': 'Pienso que la rúbrica'
              }
            ],
            cabecera_preguntas_satisfaccion:[
              {
                'id_tipo': 2,
                'cabecera': 'Me ha resultado útil para'
              }
            ],
            preguntas_val: [],
            preguntas_sat: [],
            satisfaccion:[],
            observacion:[],
            id_estudiante_tarea: 0,
            id_tarea_actual2: 0,
            notas_docente: [],
            //para estadisticas y calculos
            rubricas_eval:[],
            rub_evaluadas:[],
            docentes_eval:[],
            docentes_eval2:[],
            doc_eval:[],
            metricas:[
              {
                'id_metrica': 1,
                'nombre': 'Evaluaciones de Expertos'
              },
              {
                'id_metrica': 2,
                'nombre': 'CVI General'
              },
              {
                'id_metrica': 3,
                'nombre': 'Alfa de Cronbach'
              },
              {
                'id_metrica': 4,
                'nombre': 'Satisfacción y Validez'
              },
              {
                'id_metrica': 5,
                'nombre': 'V de Aiken'
              }
            ],
            metricas_s:[],
            m_disabled : true,
            criterio_e:[],
            items_e:[],
            suficiancia_cal: [],
            generales_cal:[],
            generales_obs:[],
            control_exp: 1,
            cvi_general: 0,
            cal_satis_vali : [],
            cue_cal_niv_1 : [], // variable que contiene los calculos de las notas del cuestionario de la rubrica
            cue_cal_niv_2 : [],
            cue1_suma_niv : [], // contiene las sumas de los porcentajes por nivel y preguntas para obtener la frecuencia        
            cue2_suma_niv : [],
            tbl_fre_pro_1 : [{ // contiene los datos de la tabla de frecuencia, porcentaje, porcentaje acumulado
                'nivel':'Muy Bajo', 
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Bajo',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Medio',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Alto',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Muy Alto',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Total',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': ''
              }
            ], 
            tbl_fre_pro_2 : [
              {
                'nivel':'Muy Bajo', 
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Bajo',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Medio',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Alto',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Muy Alto',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': 0
              },
              {
                'nivel':'Total',
                'frecuencia': 0,
                'porentaje': 0,
                'porcentaje_a': ''
              }
              
            ],
            array_tbl_6: [],
            ICV_G2 : 0,
            satis_vali : 0,
            tbl_v_aiken : [],
            tr_v_aiken_f : [{
              "nombre": "Total",
              "suficiencia": 0,
              "coherencia": 0,
              "relevancia": 0,
              "claridad": 0
            }],
            tareas_docente :[], //v-model del combo
            t_docente:[], //variable con los datos
            calificaciones_tar : [], // contiene todas las calificaciones para el calculo del alfa de una tarea
            alfa_c: 0,
            tbl_alfa:[]       
  },
  beforeMount() {
    let cookie_array = document.cookie.split(";");
    let validador = 0;
    cookie_array.forEach(element => {
      if(element.includes("TOKEN_1")== true){
        validador = 1;
        console.log("validador: ", validador);
      }
    });
    if(validador == 1){
      console.log(this.getCookie('TOKEN_2'));

      axios
      .get('modulos/'+this.getCookie('TOKEN_2'))
      .then(response => {
        this.modulos=response.data;
        console.log("modulos: ", this.modulos);
        $('#rubrica_interface').hide();
        this.username = this.getCookie('TOKEN_3');
        this.email = this.getCookie('TOKEN_4');
        //peticion para obtener periodos
            if(this.getCookie('TOKEN_2') != "EXTERNO"){  
              axios.get('periodo')
              .then(response2 => {
                console.log("periodos: ", response2.data[0].idperiodo);
                this.campo_periodo = response2.data;
              })
            }
          });

          //aqui va la peticion de asignaturas
        if(this.getCookie('TOKEN_2') != "EXTERNO"){  
          axios
          .get('asignaturas')
          .then(response_a => {
            this.total_asig = response_a.data;
            this.asignatura_filtro = this.total_asig;
            console.log("total de asignaturas: ", this.total_asig);

          });
        }else{
          //peticion para rubricas a evaluar de experto externo
          //this.get_rubricas_expertos();
        }
    }
    //console.log("before mounted");
    //this.cargar_data_combos();
  
  },
  mounted() {
    console.log("mounted2");
    if(window.location.pathname == '/sistema/public/'){
      console.log("entre a validacion inicial");
      let cookie_array = document.cookie.split(";");
      let validador = 0;
      cookie_array.forEach(element => {
        if(element.includes("TOKEN_1")== true){
          validador = 1;
        }
      });
      if(validador == 1){
        axios
          .get('api/home')
          .then(response => {
          })
      }else{
        //console.log("iniciar sesion");
      }
    }
  },
  computed:{
    filtro:{
      get(){
        return this.texto
      },
      set(value){
       // console.log('filtro ejecutado!');
        value = value.toLowerCase();
        this.rub_filtrado = this.rub_general.filter(rubrica => rubrica.nombre.toLowerCase().indexOf(value) !== -1)
        this.texto = value
      }
    },
  },
  methods: {
    /*metodos para parte de la unesco*/ 
    mostrar_campo(){
      this.bandera_unesco = 1;
      $('#solo_campo_').show();
      $('#completo').show();
      $('#combo_campo').show();
      $('#combo_subdisciplina').hide();
      $('#combo_disciplina').hide();
      $('#input_campo').show();
      $('#input_dis').hide();
      $('#input_sdis').hide();
      
    },
    mostrar_subdisciplina(){
      this.bandera_unesco = 3;
      $('#solo_campo_').show();
      $('#completo').show();
      $('#input_campo').hide();
      $('#input_dis').hide();
      $('#input_sdis').show();
      $('#combo_campo').show();
      $('#combo_disciplina').show();
      $('#combo_subdisciplina').show();
      
    },
    mostrar_disciplina(){
      console.log("etoy en mostrar disciplina");
      this.bandera_unesco = 2;
      $('#completo').show();
      $('#solo_campo_').show();
      $('#input_dis').show();
      $('#input_sdis').hide();
      $('#input_campo').hide();
      $('#combo_campo').show();
      $('#combo_disciplina').show();
      $('#combo_subdisciplina').hide();
      this.s_disciplina.value = '';
      this.s_campo = '';
      
    },
    editar_campo(){
      if(this.bandera_unesco == 1){
        if(this.campo_t.trim() == ''){
          alert("Ingrese el nombre del campo");
        }else{
          if(this.control_cam == 1){
            //petición para editar
            let array = {
              'id': this.s_campo.id,
              'nombre': this.campo_t
            };
            axios.put('update_campo',array)
             .then(upd => {
              alert("Campo Actualizado");
              console.log(upd.data);
              this.get_campos();
              this.campo_t = '';
              this.control_cam = 0;
              this.s_campo = '';
             })
          }else{
            //petición para guardar nuevo
            let array2 = {
              'nombre': this.campo_t
            };
           
            axios.put('save_campo',array2)
             .then(save => {
              alert("Campo Registrado: ");
              console.log(save.data);
              this.get_campos();
              this.campo_t = '';
              this.control_cam = 0;
              this.s_campo = '';
             })
          }
    
        }
      }
      if(this.bandera_unesco == 2){
        console.log("edicion de disciplina");
        if(this.control_dis == 1){
          //petición para editar
          let array = {
            'id': this.s_disciplina.id,
            'nombre': this.disciplina_t
          };
          axios.put('update_dis',array)
           .then(upd => {
            alert("Disciplina Actualizada");
            //console.log(upd.data);
            this.get_campos();
           // this.llenar_disciplinas();
            this.campo_t = '';
            this.disciplina_t = '';
            this.control_dis = 0;
            this.s_campo = '';
            this.s_disciplina = '';
            this.disciplinas_u = '';
           })
        }else{
          //petición para guardar nuevo
          let array2 = {
            'nombre': this.disciplina_t,
            'id_campo': this.s_campo.id
          };
         
          axios.put('save_dis',array2)
           .then(save => {
            alert("Disciplina Registrada");
            //console.log(save.data);
            this.get_campos();
            this.campo_t = '';
            this.disciplina_t = '';
            this.control_dis = 0;
            this.s_campo = '';
            this.s_disciplina = '';
            this.disciplinas_u = '';
           })
        }
      }
      if(this.bandera_unesco == 3){
        console.log("edicion de subdisciplinas");
        if(this.control_sub == 1){
          //petición para editar
          let array = {
            'id': this.s_subdisciplina.id,
            'nombre': this.subdisciplina_t
          };
          axios.put('update_sdis',array)
           .then(supd => {
            alert("Subdisciplina Actualizada");
            //console.log(upd.data);
            this.get_campos();
           // this.llenar_disciplinas();
            this.campo_t = '';
            this.disciplina_t = '';
            this.subdisciplina_t = '';
            this.control_sub = 0;
            this.s_campo = '';
            this.s_disciplina = '';
            this.s_subdisciplina = '';
            this.disciplinas_u = '';
            this.subdisciplinas_u = '';
           })
        }else{
          //petición para guardar nuevo
          let array2 = {
            'nombre': this.subdisciplina_t,
            'id_disciplina': this.s_disciplina.id
          };
         
          axios.put('save_sdis',array2)
           .then(save => {
            alert("Subdisciplina Registrada");
            //console.log(save.data);
            this.get_campos();
            this.campo_t = '';
            this.disciplina_t = '';
            this.subdisciplina_t = '';
            this.control_sub = 0;
            this.s_campo = '';
            this.s_disciplina = '';
            this.s_subdisciplina = '';
            this.disciplinas_u = '';
            this.subdisciplinas_u = '';
           })
        }


      }
      
      
    },
    limpiar_campo(){
      this.control_cam = 0;
      this.control_dis = 0;
      this.control_sub = 0;
      this.campo_t = '';
      this.disciplina_t = '';
      this.subdisciplina_t = '';
      this.s_campo = '';
      this.s_disciplina = ''
      this.s_subdisciplina = '';
      this.disciplinas_u = '';
      this.subdisciplinas_u = '';
    },
    get_campos(){
      axios.get('get_campos_u')
           .then(cam => {
             //console.log("resultado: ", rub_eval.data);
            this.campos_u = cam.data;
            console.log("campos: ",this.campos_u);
           })
    },
    llenar_disciplinas(){
      this.s_disciplina = "";
      this.s_subdisciplina = "";
      console.log("entre a consultar disciplinas");
      axios.get('get_disciplinas_u/'+this.s_campo.id)
           .then(dis => {
            console.log("peticion");
             //console.log("resultado: ", rub_eval.data);
            this.disciplinas_u = dis.data;
            console.log("campos: ",this.disciplinas_u);
            
           })
    },
    llenar_disciplinas2(){
      this.control_cam = 1;
      this.control_dis = 0;
      this.control_sub = 0;
      this.campo_t = this.s_campo.nombre;
      this.s_disciplina = "";
      this.s_subdisciplina = "";
      console.log("entre a consultar disciplinas");
      axios.get('get_disciplinas_u/'+this.s_campo.id)
           .then(dis => {
            console.log("peticion");
             //console.log("resultado: ", rub_eval.data);
            this.disciplinas_u = dis.data;
            console.log("campos: ",this.disciplinas_u);
           })
    },
    
    llenar_bandera(){
      this.control_cam = 0;
      this.control_dis = 0;
      this.control_sub = 1;
      this.subdisciplina_t = this.s_subdisciplina.nombre;
    },
    llenar_subdisciplinas2(){
      this.control_cam = 0;
      this.control_dis = 1;
      this.control_sub = 0;
      this.s_subdisciplina = "";
      axios.get('get_subdisciplinas_u/'+this.s_disciplina.id)
      .then(sub => {
       console.log("peticion");
        //console.log("resultado: ", rub_eval.data);
       this.subdisciplinas_u = sub.data;
       console.log("sub: ",this.subdisciplinas_u);
       this.disciplina_t = this.s_disciplina.nombre;

      })

    },
    llenar_subdisciplinas(){
      this.s_subdisciplina = "";
      axios.get('get_subdisciplinas_u/'+this.s_disciplina.id)
      .then(sub => {
       console.log("peticion");
        //console.log("resultado: ", rub_eval.data);
       this.subdisciplinas_u = sub.data;
       console.log("sub: ",this.subdisciplinas_u);
      })

    },
    
    //metodo para descarga de informacion en excel
    excel_download(){
      console.log("funciona");  
      /* console.log(document.getElementById("ambiente_p").children[0].children[0].children[0]);
      console.log(document.getElementById("ambiente_d"));
      console.log($P{usu_no_rep}); */
      //var json=$P{usu_no_rep};

  
      testTypes = {
            "expertos": "String",
            "items_entre_3_y_4": "String",
            "items_totales": "String",
            "total": "String"
        };
    
    emitXmlHeader = function () {
        var headerRow =  '<ss:Row>\n';
        for (var colName in testTypes) {
            headerRow += '  <ss:Cell>\n';
            headerRow += '    <ss:Data ss:Type="String">';
            headerRow += colName + '</ss:Data>\n';
            headerRow += '  </ss:Cell>\n';        
        }
        headerRow += '</ss:Row>\n';    
        return '<?xml version="1.0"?>\n' +
               '<ss:Workbook xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">\n' +
               '<ss:Worksheet ss:Name="Sheet1">\n' +
               '<ss:Table>\n\n' + headerRow;
    };
     
    emitXmlFooter = function() {
        return '\n</ss:Table>\n' +
               '</ss:Worksheet>\n' +
               '</ss:Workbook>\n';
    };
    
    jsonToSsXml = function (jsonObject) {
        var row;
        var col;
        var xml;
        var data = typeof jsonObject != "object" ? JSON.parse(jsonObject) : jsonObject;
        
        xml = emitXmlHeader();
    
        for (row = 0; row < data.length; row++) {
            xml += '<ss:Row>\n';
          
            for (col in data[row]) {
                xml += '  <ss:Cell>\n';
                xml += '    <ss:Data ss:Type="' + testTypes[col]  + '">';
                xml += data[row][col] + '</ss:Data>\n';
                xml += '  </ss:Cell>\n';
            }
    
            xml += '</ss:Row>\n';
        }
        
        xml += emitXmlFooter();
        return xml;  
    };
   
    //console.log(jsonToSsXml(json);
    
    download = function (content, filename, contentType) {
        if (!contentType) contentType = 'application/octet-stream';
        var a = document.getElementById('test2');
        var blob = new Blob([content], {
            'type': contentType
        });
        console.log("blob", blob, " content recibido: ", content);
        a.href = window.URL.createObjectURL(blob);
        a.download = filename;
        a.click();
    };
    
    download(jsonToSsXml(this.array_tbl_6), 'CVI_General.xls', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

      
    },


    //metodos para gestor de estadisticas y calculos
    get_rubricas_evaluadas(){
      axios.get('get_rub_eval/'+this.getCookie('TOKEN_1'))
           .then(rub_eval => {
             //console.log("resultado: ", rub_eval.data);
            this.rub_evaluadas = rub_eval.data;
           })
    },
    expertos_rubrica(){
      //console.log("seleccion: ", this.rubricas_eval.id_rubrica);
      axios.get('get_exp_rub/'+this.rubricas_eval.id_rubrica)
           .then(rub_exp => {
             //console.log("resultado expertos: ", rub_exp.data);
            this.doc_eval = rub_exp.data;
            this.m_disabled = false;
            //peticion 1 para traer criterios e items
            axios.get('get_cri_rub_eval/'+this.rubricas_eval.id_rubrica)
           .then(rub_cri => {
             //console.log("criterios evaluados: ",rub_cri.data );
             this.criterio_e = rub_cri.data;

             //peticion para obtener los items de la rubrica
              axios.get('get_ite_eval/'+this.rubricas_eval.id_rubrica)
              .then(rub_ite => {
              //console.log("items evaluados: ",rub_ite.data );
              this.items_e = rub_ite.data;

                //peticion para calificaciones de suficiencia
                axios.get(' get_cal_suficiencia/'+this.rubricas_eval.id_rubrica)
                  .then(suf_cal => {
                  //console.log("suficiencia calificaciones: ",suf_cal.data );
                  this.suficiancia_cal = suf_cal.data;
                    
                    //peticion para obtener las calificaciones de claridad, coherencia, etc
                    axios.get('get_cal_generales/'+this.rubricas_eval.id_rubrica)
                      .then(gen_cal => {
                      //console.log("calificaciones generales: ",gen_cal.data );
                      this.generales_cal = gen_cal.data;

                        //peticion para obtener observaciones generales
                        axios.get('get_obs_generales/'+this.rubricas_eval.id_rubrica)
                          .then(obs_gen => {
                         // console.log("observaciones generales: ",obs_gen.data );
                          this.generales_obs = obs_gen.data;

                          })

                      })
                  
                  })

              })

           })
      })
    },
    mostrar_metrica(){
     // console.log("metrica a usar : ", this.metricas_s);
      if(this.metricas_s.id_metrica == 1){
        $("#docentes_eva").show();
        $("#evaluacion_m").show();
        $("#cvi_general").hide();
        $("#alfa_cron").hide();
        $("#satis_validez").hide();
        $("#v_aiken").hide();
        //$("#tareas_doc").hide();
      }else if(this.metricas_s.id_metrica == 2){
        $("#docentes_eva").hide();
        $("#evaluacion_m").hide();
        $("#cvi_general").show();
        $("#alfa_cron").hide();
        $("#satis_validez").hide();
        $("#v_aiken").hide();
       // $("#tareas_doc").hide();
        //funcion para los cálculos

        //validar que todos los expertos han evaluado
        let control = 0;
        axios.get('get_control_eva/'+this.rubricas_eval.id_rubrica)
        .then(con => {
         // console.log("existe: ", con.data);
          this.control_exp = con.data;
          if(this.control_exp == 0){
            this.calculo_cvr();
            
            //$("#metricas_eva").show();
          }else{
            alert("Aún existen evaluaciones de expertos pendientes");
          }


        })

        
      }else if(this.metricas_s.id_metrica == 3){
        this.mostrar_alfa();
        $("#docentes_eva").hide();
        $("#evaluacion_m").hide();
        $("#cvi_general").hide();
        $("#alfa_cron").show();
        $("#satis_validez").hide();
        $("#v_aiken").hide();
      }else if(this.metricas_s.id_metrica == 4){
        this.obtener_satis_valida();
        $("#docentes_eva").hide();
        $("#evaluacion_m").hide();
        $("#cvi_general").hide();
        $("#alfa_cron").hide();
        $("#satis_validez").show();
        $("#v_aiken").hide();
      }else if (this.metricas_s.id_metrica == 5){
        $("#docentes_eva").hide();
        $("#evaluacion_m").hide();
        $("#cvi_general").hide();
        $("#alfa_cron").hide();
        $("#satis_validez").hide();
        $("#v_aiken").show();
      }
      /* else if(this.metricas_s.id_metrica == 3){
        $("#docentes_eva").hide();
        //proceso para alfa de cronbanch
        //peticion para obtener tareas
        axios.get('get_tar_doc/'+this.getCookie('TOKEN_1')+'/'+this.rubricas_eval.id_rubrica)
        .then(tar =>{
          console.log("tareas obtenidas: ", tar.data);
          this.t_docente = tar.data;
          $("#tareas_doc").show();

      });

      
        
      } */
    },
    mostrar_alfa(){
      //peticion para obtener tareas
      //console.log("seleccion: ", this.tareas_docente);
      //variables para calculo de alfa
      let cal_doc = [];
      let cal_est = [];
      let total_crit = this.criterio_e.length;
      let suma_varianzas = 0; //
      let suma_varianzas_items = 0;
      let suma_total1 = [];
      let promedios = [] //contiene promedios para calcular la varianza
      let promedios2 = [] // segunda parte 
    
      
      //peticiones para obtener calificaciones de docente y estudiantes
      axios.get('get_cali_doc/'+this.rubricas_eval.id_rubrica)
        .then(tard =>{
          //console.log("calificaciones docente: ", tard.data);
          cal_doc = tard.data;
          axios.get('get_cali_est/'+this.rubricas_eval.id_rubrica)
          .then(tare =>{
            //console.log("calificaciones docente: ", tare.data);
            cal_est = tare.data;
            console.log("unidos: ", cal_doc.concat(cal_est));
            this.calificaciones_tar = cal_doc.concat(cal_est);

            this.criterio_e.forEach(cri => {
              let cont = 0;
              let acu = 0;
              this.calificaciones_tar.forEach(tar => {
                
                if(tar.id_criterio == cri.id_criterio){
                 /*  if(cri.id_criterio == 74){
                    console.log("evaluador:",tar.id_evaluador," asignado: ",tar.id_asignado ," criterio: ", cri.id_criterio, " valor: ", tar.valoracion);
                  }
                   */
                  acu = acu + tar.valoracion;
                  cont = cont + 1;
                }
              
              });
              let pro = acu/cont;
              console.log("criterio: ", cri.id_criterio, " promedio: ", pro);
              promedios.push({"id_criterio": cri.id_criterio,"nombre":cri.nombre, "promedio": pro.toFixed(2), "varianza":''});
            });
            console.log("promedios: ", promedios);
            promedios.forEach(pro => {
              let cont2 = 0;
              let acu2 = 0;
              this.calificaciones_tar.forEach(tar2 => {
                if(tar2.id_criterio == pro.id_criterio){
                  //resta
                  acu2 = acu2 + Math.pow((tar2.valoracion - pro.promedio),2);
                  cont2 = cont2 + 1;
                }
                
              });
              let pro2 = acu2/cont2;
              promedios2.push({"id_criterio": pro.id_criterio, "promedio": pro2}) 
              
            });
            console.log("varianza: ", promedios2);
            //suma de varianzas 
            promedios2.forEach(pro3 => {
              suma_varianzas = suma_varianzas + pro3.promedio;
            });
            console.log("suma varianzas: ", suma_varianzas);
            //preparar data para tabla de alfa
            this.tbl_alfa = promedios
            this.tbl_alfa .forEach(prome => {
              promedios2.forEach(prome2 => {
                if(prome.id_criterio == prome2.id_criterio){
                  prome.varianza = prome2.promedio.toFixed(2);
                }
              });
            });
            console.log("para table alfa : ", this.tbl_alfa);

            //varianza de la suma de los items(criterios)
           //peticion para traer la suma de los totales desde base
           axios.get('get_totale/'+this.rubricas_eval.id_rubrica)
           .then(t_e =>{
              axios.get('get_totald/'+this.rubricas_eval.id_rubrica)
              .then(t_d =>{
                 console.log("suma total por evaluador y asignado ", t_e.data.concat(t_d.data));
                 suma_total1 =  t_e.data.concat(t_d.data);
                 let promedio_t = 0;
                 let cont3 = 0
                 let acu3 = 0;
                 suma_total1.forEach(s_t => {
                  acu3 = acu3 + s_t.suma;
                  cont3 = cont3 + 1;
                   
                 });
                 promedio_t = acu3/cont3;
                 //calculo de la varianza del las suma totales:
                 let cont4 = 0;
                 let acu4 = 0;
                 suma_total1.forEach(s_2 => {
                      //resta
                      acu4 = acu4 + Math.pow((s_2.suma - promedio_t),2);
                      cont4 = cont4 + 1;
                });
                suma_varianzas_items = acu4/cont4;
                console.log("suma de varianza de los items: ", suma_varianzas_items);

                //calculo de alfa final
                this.alfa_c = (total_crit/(total_crit-1))*(1-(suma_varianzas/suma_varianzas_items));
                this.alfa_c = this.alfa_c.toFixed(4);
                console.log("alfa_final: ", this.alfa_c);
                
              })
           })
            


            
        });
      });

      
    },
    obtener_satis_valida(){
      //obtener preguntas
      let preguntas = [];
      let total_estu = 0;
      axios.get('get_total_est/'+this.rubricas_eval.id_rubrica)
      .then(tot =>{
        total_estu = tot.data;
        console.log("total estudintes: ", total_estu);
        axios.get('get_cue_pre/'+this.rubricas_eval.id_rubrica)
        .then(pre =>{
          preguntas = pre.data;
          axios.get('get_calif_satis_vali/'+this.rubricas_eval.id_rubrica)
          .then(satis => {
           // console.log("calificaciones saits...: ", satis.data)
                this.cal_satis_vali = satis.data;
                //let total_est = this.cal_satis_vali.length;
                //let valores_s = [0,0,0,0,0]
                /* let valor_1_s = 0;
                let valor_2_s = 0;
                let valor_3_s = 0;
                let valor_4_s = 0;
                let valor_5_s = 0; */
                preguntas.forEach(pre1 => {
                  
                  let temp5 = {
                    'id_tipo': pre1.tipo,
                    'id_pregunta': pre1.id,
                    'pregunta': pre1.pregunta,
                    'level_1': 0,
                    'level_2': 0,
                    'level_3': 0,
                    'level_4': 0,
                    'level_5': 0,
                    'por_l_1': 0,
                    'por_l_2': 0,
                    'por_l_3': 0,
                    'por_l_4': 0,
                    'por_l_5': 0
                  }
                  if(pre1.tipo == 1){
                    this.cue_cal_niv_1.push(temp5);
                  }
                  if(pre1.tipo == 2){
                    this.cue_cal_niv_2.push(temp5);
                  }
                  
                });
              //  console.log("cuestionario enc cascara: ", this.cue_cal_niv_1, ' ',this.cue_cal_niv_2);
    
                this.cue_cal_niv_1.forEach(sat_val => {
                  this.cal_satis_vali.forEach(cali => {
                    if(cali.id_pregunta == sat_val.id_pregunta){
                      if(cali.calificacion == 1 && cali.tipo == 1){
                        sat_val.level_1 = sat_val.level_1 + 1;
                      }
                      if(cali.calificacion == 2 && cali.tipo == 1){
                        sat_val.level_2 = sat_val.level_2 + 1;
                      }
                      if(cali.calificacion == 3 && cali.tipo == 1){
                        sat_val.level_3 = sat_val.level_3 + 1;
                      }
                      if(cali.calificacion == 4 && cali.tipo == 1){
                        sat_val.level_4 = sat_val.level_4 + 1;
                      }
                      if(cali.calificacion == 5 && cali.tipo == 1){
                        sat_val.level_5 = sat_val.level_5 + 1;
                      }
                    }
                    
                  });
                });
                this.cue_cal_niv_2.forEach(sat_val2 => {
                  this.cal_satis_vali.forEach(cali2 => {
                   // console.log("pregunta cue_cal: ", sat_val2.id_pregunta ," pregunta cali: ",cali2.id_pregunta, " tipo: ", cali2.id_tipo);
                    if(cali2.id_pregunta == sat_val2.id_pregunta){
                      if(cali2.calificacion == 1 && cali2.tipo == 2){
                        sat_val2.level_1 = sat_val2.level_1 + 1;
                      }
                      if(cali2.calificacion == 2 && cali2.tipo == 2){
                        sat_val2.level_2 = sat_val2.level_2 + 1;
                      }
                      if(cali2.calificacion == 3 && cali2.tipo == 2){
                        sat_val2.level_3 = sat_val2.level_3 + 1;
                      }
                      if(cali2.calificacion == 4 && cali2.tipo == 2){
                        sat_val2.level_4 = sat_val2.level_4 + 1;
                      }
                      if(cali2.calificacion == 5 && cali2.tipo == 2){
                        sat_val2.level_5 = sat_val2.level_5 + 1;
                      }
                    }
                    
                  });
                });
               // console.log("cuestionario con calificaciones sumadas: ", this.cue_cal_niv_1,' ', this.cue_cal_niv_2);

                //ciclos para calcular porcentajes
                this.cue_cal_niv_1.forEach(cue1 => {
                  cue1.por_l_1 = (cue1.level_1 / total_estu ) * 100;
                  cue1.por_l_2 = (cue1.level_2 / total_estu ) * 100;
                  cue1.por_l_3 = (cue1.level_3 / total_estu ) * 100;
                  cue1.por_l_4 = (cue1.level_4 / total_estu ) * 100;
                  cue1.por_l_5 = (cue1.level_5 / total_estu ) * 100;
                });
                this.cue_cal_niv_2.forEach(cue2 => {
                  cue2.por_l_1 = (cue2.level_1 / total_estu ) * 100;
                  cue2.por_l_2 = (cue2.level_2 / total_estu ) * 100;
                  cue2.por_l_3 = (cue2.level_3 / total_estu ) * 100;
                  cue2.por_l_4 = (cue2.level_4 / total_estu ) * 100;
                  cue2.por_l_5 = (cue2.level_5 / total_estu ) * 100;
                });
              //  console.log("despues de ciclo para porcentajes: ", this.cue_cal_niv_1);
                //ciclos para sumas de porcentajes por nivel
                let temp6 = {
                  'sum_l_1':0,
                  'sum_l_2':0,
                  'sum_l_3':0,
                  'sum_l_4':0,
                  'sum_l_5':0
                };
                this.cue1_suma_niv.push(temp6);
                let temp7 = {
                  'sum_l_1':0,
                  'sum_l_2':0,
                  'sum_l_3':0,
                  'sum_l_4':0,
                  'sum_l_5':0
                };
                this.cue2_suma_niv.push(temp7);
                this.cue_cal_niv_1.forEach(cue3 => {
                  this.cue1_suma_niv[0].sum_l_1 = this.cue1_suma_niv[0].sum_l_1 + cue3.level_1;
                  this.cue1_suma_niv[0].sum_l_2 = this.cue1_suma_niv[0].sum_l_2 + cue3.level_2;
                  this.cue1_suma_niv[0].sum_l_3 = this.cue1_suma_niv[0].sum_l_3 + cue3.level_3;
                  this.cue1_suma_niv[0].sum_l_4 = this.cue1_suma_niv[0].sum_l_4 + cue3.level_4;
                  this.cue1_suma_niv[0].sum_l_5 = this.cue1_suma_niv[0].sum_l_5 + cue3.level_5;
                });
                this.cue_cal_niv_2.forEach(cue4 => {
                  this.cue2_suma_niv[0].sum_l_1 = this.cue2_suma_niv[0].sum_l_1 + cue4.level_1;
                  this.cue2_suma_niv[0].sum_l_2 = this.cue2_suma_niv[0].sum_l_2 + cue4.level_2;
                  this.cue2_suma_niv[0].sum_l_3 = this.cue2_suma_niv[0].sum_l_3 + cue4.level_3;
                  this.cue2_suma_niv[0].sum_l_4 = this.cue2_suma_niv[0].sum_l_4 + cue4.level_4;
                  this.cue2_suma_niv[0].sum_l_5 = this.cue2_suma_niv[0].sum_l_5 + cue4.level_5;
                });
              // console.log("porcentajes sumados: ", this.cue1_suma_niv, " ", this.cue2_suma_niv);
                //obtener tabla de frecuencia porcentaje y porcentaje acumulado
                let long_cue1 = this.cue_cal_niv_1.length;
                let long_cue2 = this.cue_cal_niv_2.length;
                this.cue1_suma_niv.forEach(sum => {
                  this.tbl_fre_pro_1[0].frecuencia = sum.sum_l_1 / long_cue1;
                  this.tbl_fre_pro_1[0].frecuencia = this.tbl_fre_pro_1[0].frecuencia.toFixed(2);
                  this.tbl_fre_pro_1[1].frecuencia = sum.sum_l_2 / long_cue1;
                  this.tbl_fre_pro_1[1].frecuencia = this.tbl_fre_pro_1[1].frecuencia.toFixed(2);
                  this.tbl_fre_pro_1[2].frecuencia = sum.sum_l_3 / long_cue1;
                  this.tbl_fre_pro_1[2].frecuencia = this.tbl_fre_pro_1[2].frecuencia.toFixed(2);
                  this.tbl_fre_pro_1[3].frecuencia = sum.sum_l_4 / long_cue1;
                  this.tbl_fre_pro_1[3].frecuencia = this.tbl_fre_pro_1[3].frecuencia.toFixed(2);
                  this.tbl_fre_pro_1[4].frecuencia = sum.sum_l_5 / long_cue1;
                  this.tbl_fre_pro_1[4].frecuencia = this.tbl_fre_pro_1[4].frecuencia.toFixed(2);
                  this.tbl_fre_pro_1[5].frecuencia = (sum.sum_l_1 / long_cue1)+(sum.sum_l_2 / long_cue1)+(sum.sum_l_3 / long_cue1)+(sum.sum_l_4 / long_cue1)+(sum.sum_l_5 / long_cue1);
                  
                  this.tbl_fre_pro_1[0].porcentaje = sum.sum_l_1 *100/ (long_cue1 * total_estu);
                  this.tbl_fre_pro_1[0].porcentaje = parseFloat(this.tbl_fre_pro_1[0].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_1[1].porcentaje = sum.sum_l_2 *100/ (long_cue1 * total_estu);
                  this.tbl_fre_pro_1[1].porcentaje = parseFloat(this.tbl_fre_pro_1[1].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_1[2].porcentaje = sum.sum_l_3 *100/ (long_cue1 * total_estu);
                  this.tbl_fre_pro_1[2].porcentaje = parseFloat(this.tbl_fre_pro_1[2].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_1[3].porcentaje = sum.sum_l_4 *100/ (long_cue1 * total_estu);
                  this.tbl_fre_pro_1[3].porcentaje = parseFloat(this.tbl_fre_pro_1[3].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_1[4].porcentaje = sum.sum_l_5 *100/ (long_cue1 * total_estu);
                  this.tbl_fre_pro_1[4].porcentaje = parseFloat(this.tbl_fre_pro_1[4].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_1[5].porcentaje = 100; // quemado por el momento

                  this.tbl_fre_pro_1[0].porcentaje_a = this.tbl_fre_pro_1[0].porcentaje;
                  this.tbl_fre_pro_1[1].porcentaje_a = this.tbl_fre_pro_1[0].porcentaje + this.tbl_fre_pro_1[1].porcentaje;
                  this.tbl_fre_pro_1[2].porcentaje_a = this.tbl_fre_pro_1[0].porcentaje + this.tbl_fre_pro_1[1].porcentaje + this.tbl_fre_pro_1[2].porcentaje;
                  this.tbl_fre_pro_1[3].porcentaje_a = this.tbl_fre_pro_1[0].porcentaje + this.tbl_fre_pro_1[1].porcentaje + this.tbl_fre_pro_1[2].porcentaje + this.tbl_fre_pro_1[3].porcentaje;
                  this.tbl_fre_pro_1[4].porcentaje_a = this.tbl_fre_pro_1[0].porcentaje + this.tbl_fre_pro_1[1].porcentaje + this.tbl_fre_pro_1[2].porcentaje + this.tbl_fre_pro_1[3].porcentaje + this.tbl_fre_pro_1[4].porcentaje;
                  this.tbl_fre_pro_1[0].porcentaje_a = this.tbl_fre_pro_1[0].porcentaje_a.toFixed(2);
                  this.tbl_fre_pro_1[1].porcentaje_a = this.tbl_fre_pro_1[1].porcentaje_a.toFixed(2);
                  this.tbl_fre_pro_1[2].porcentaje_a = this.tbl_fre_pro_1[2].porcentaje_a.toFixed(2);
                  this.tbl_fre_pro_1[3].porcentaje_a = this.tbl_fre_pro_1[3].porcentaje_a.toFixed(2);
                });
               // console.log("tabla1: ", this.tbl_fre_pro_1);
                this.cue2_suma_niv.forEach(sum2=> {
                  this.tbl_fre_pro_2[0].frecuencia = sum2.sum_l_1 / long_cue2;
                  this.tbl_fre_pro_2[0].frecuencia = this.tbl_fre_pro_2[0].frecuencia.toFixed(2);
                  this.tbl_fre_pro_2[1].frecuencia = sum2.sum_l_2 / long_cue2;
                  this.tbl_fre_pro_2[1].frecuencia = this.tbl_fre_pro_2[1].frecuencia.toFixed(2);
                  this.tbl_fre_pro_2[2].frecuencia = sum2.sum_l_3 / long_cue2;
                  this.tbl_fre_pro_2[2].frecuencia = this.tbl_fre_pro_2[2].frecuencia.toFixed(2);
                  this.tbl_fre_pro_2[3].frecuencia = sum2.sum_l_4 / long_cue2;
                  this.tbl_fre_pro_2[3].frecuencia = this.tbl_fre_pro_2[3].frecuencia.toFixed(2);
                  this.tbl_fre_pro_2[4].frecuencia = sum2.sum_l_5 / long_cue2;
                  this.tbl_fre_pro_2[4].frecuencia = this.tbl_fre_pro_2[4].frecuencia.toFixed(2);
                  this.tbl_fre_pro_2[5].frecuencia = (sum2.sum_l_1 / long_cue2)+(sum2.sum_l_2 / long_cue2)+(sum2.sum_l_3 / long_cue2)+(sum2.sum_l_4 / long_cue2)+(sum2.sum_l_5 / long_cue2);

                  this.tbl_fre_pro_2[0].porcentaje = sum2.sum_l_1 *100/ (long_cue2 * total_estu);
                  this.tbl_fre_pro_2[0].porcentaje = parseFloat(this.tbl_fre_pro_2[0].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_2[1].porcentaje = sum2.sum_l_2 *100/ (long_cue2 * total_estu);
                  this.tbl_fre_pro_2[1].porcentaje = parseFloat(this.tbl_fre_pro_2[1].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_2[2].porcentaje = sum2.sum_l_3 *100/ (long_cue2 * total_estu);
                  this.tbl_fre_pro_2[2].porcentaje = parseFloat(this.tbl_fre_pro_2[2].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_2[3].porcentaje = sum2.sum_l_4 *100/ (long_cue2 * total_estu);
                  this.tbl_fre_pro_2[3].porcentaje = parseFloat(this.tbl_fre_pro_2[3].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_2[4].porcentaje = sum2.sum_l_5 *100/ (long_cue2 * total_estu);
                  this.tbl_fre_pro_2[4].porcentaje = parseFloat(this.tbl_fre_pro_2[4].porcentaje.toFixed(2)); 
                  this.tbl_fre_pro_2[5].porcentaje = 100; //quemado momentaneamente

                  this.tbl_fre_pro_2[0].porcentaje_a = this.tbl_fre_pro_2[0].porcentaje;
                  this.tbl_fre_pro_2[1].porcentaje_a = this.tbl_fre_pro_2[0].porcentaje + this.tbl_fre_pro_2[1].porcentaje;
                  this.tbl_fre_pro_2[2].porcentaje_a = this.tbl_fre_pro_2[0].porcentaje + this.tbl_fre_pro_2[1].porcentaje + this.tbl_fre_pro_2[2].porcentaje;
                  this.tbl_fre_pro_2[3].porcentaje_a = this.tbl_fre_pro_2[0].porcentaje + this.tbl_fre_pro_2[1].porcentaje + this.tbl_fre_pro_2[2].porcentaje + this.tbl_fre_pro_2[3].porcentaje;
                  this.tbl_fre_pro_2[4].porcentaje_a = this.tbl_fre_pro_2[0].porcentaje + this.tbl_fre_pro_2[1].porcentaje + this.tbl_fre_pro_2[2].porcentaje + this.tbl_fre_pro_2[3].porcentaje + this.tbl_fre_pro_2[4].porcentaje;
                  this.tbl_fre_pro_2[0].porcentaje_a = this.tbl_fre_pro_2[0].porcentaje_a.toFixed(2);
                  this.tbl_fre_pro_2[1].porcentaje_a = this.tbl_fre_pro_2[1].porcentaje_a.toFixed(2);
                  this.tbl_fre_pro_2[2].porcentaje_a = this.tbl_fre_pro_2[2].porcentaje_a.toFixed(2);
                  this.tbl_fre_pro_2[3].porcentaje_a = this.tbl_fre_pro_2[3].porcentaje_a.toFixed(2);
                });
                //calcular valor de porcentaje obtenido de los dos niveles mas altos 
                //validez 9 preguntas, satisfaccion 10
                this.satis_vali = (parseInt(this.tbl_fre_pro_2[3].porcentaje) + parseInt(this.tbl_fre_pro_2[4].porcentaje) + parseInt(this.tbl_fre_pro_1[3].porcentaje) + parseInt(this.tbl_fre_pro_1[4].porcentaje))/2;
                //console.log("satisfaccion y validez final: ", this.satis_vali);

                //calculo de la v de aiken


                
            })
        })

      })
      
      
    },
    calculo_cvr(){
   
        this.array_tbl_6 = []
      //nueva para calculos por agrupacion de expertos
      //expander suficiencia a cada item
      let suficiancia_cal2 = [];
      this.items_e.forEach(items2 => {
        this.suficiancia_cal.forEach(sufi => {
          if(items2.id_criterio == sufi.id_criterio){
          suficiancia_cal2.push({"id_experto": sufi.id_experto,"id_item": items2.id_item, "suficiencia": sufi.suficiencia})
          }
        });
      })

      //console.log("nueva suficiencia: ", suficiancia_cal2);
      //añadir a calificaciones generales la suficiencia 
      this.generales_cal.forEach(cal_gen_1 => {
        suficiancia_cal2.forEach(cal_suf_1 => {
          if(cal_gen_1.id_experto == cal_suf_1.id_experto && cal_gen_1.id_item == cal_suf_1.id_item){
            cal_gen_1.suficiencia = cal_suf_1.suficiencia
          }
          
        });
      });
      console.log("general completo: ", this.generales_cal);
      //ciclo sobre expertos
      let expertos_1 = [];
      this.doc_eval.forEach(expertos => {
        let temp = [
          {"id_experto":expertos.id_experto},
          {"nombres":expertos.nombres},
          {"evaluaciones":[]},
          {"total":0},
          {"CVI":0}
        ];
        expertos_1.push(temp);
      });
      //console.log("general por experto: ", expertos_1);

      //ciclo para añadir calificaciones por expertos
      this.generales_cal.forEach(add => {
        expertos_1.forEach(exp => {
          if(exp[0].id_experto == add.id_experto){
            //console.log(add, ' ',exp);
            let temp2 = {
              'id_criterio': add.id_criterio,
              'id_item': add.id_item,
              'coherencia': add.coherencia,
              'observacion': add.observacion,
              'relevancia': add.relevancia,
              'suficiencia': add.suficiencia,
              'claridad': add.claridad,
            };
            //console.log("temp2: " , temp2);
            exp[2].evaluaciones.push(temp2);
          }
        });
      });
        //console.log("expertos + evaluaciones: ", expertos_1);
        // 
        let total_ICV_G = 0;
        expertos_1.forEach(expe => {
          let temp_e = 0;
          
          //let nombre_e = '';
          expe[2].evaluaciones.forEach(eva2 => {
            let temp8 = 0;
            let total = 0;
            if(parseInt(eva2.claridad) >= 3){
              temp8 = temp8 + 1;
            }
            if(parseInt(eva2.coherencia) >= 3){
              temp8 = temp8 + 1;
            }
            if(parseInt(eva2.suficiencia) >= 3){
              temp8 = temp8 + 1;
            }
            if(parseInt(eva2.relevancia) >= 3){
              temp8 = temp8 + 1;
            }
            total = temp8 / 4;
            temp_e = temp_e + total;
          })
          let temp_a = {'expertos': expe[1].nombres, 'items_entre_3_y_4': temp_e, 'items_totales': this.items_e.length, 'total': temp_e/this.items_e.length};
          this.array_tbl_6.push(temp_a);
          total_ICV_G = total_ICV_G + (temp_e/this.items_e.length);
        });
         this.ICV_G2 = total_ICV_G.toFixed(2)/this.doc_eval.length;
         this.ICV_G2 = this.ICV_G2.toFixed(2);
        //console.log("para tabla 6: ", this.array_tbl_6, 'total ICV_G: ', this.ICV_G2);

        //agrupacion por categorias
        let suficiencia_1 =[];
        let coherencia_1 =[];
        let relevancia_1 =[];
        let claridad_1 =[];
        this.generales_cal.forEach(cali3 => {
          let temp_s = {"suficiencia": cali3.suficiencia, "id_item":cali3.id_item, "id_criterio": cali3.id_criterio, "id_experto": cali3.id_experto};
          let temp_co = {"coherencia": cali3.coherencia, "id_item":cali3.id_item, "id_criterio": cali3.id_criterio, "id_experto": cali3.id_experto};
          let temp_r = {"relevancia": cali3.relevancia, "id_item":cali3.id_item, "id_criterio": cali3.id_criterio, "id_experto": cali3.id_experto};
          let temp_cl = {"claridad": cali3.claridad, "id_item":cali3.id_item, "id_criterio": cali3.id_criterio, "id_experto": cali3.id_experto};
          suficiencia_1.push(temp_s);
          coherencia_1.push(temp_co);
          relevancia_1.push(temp_r);
          claridad_1.push(temp_cl);
        });
        //convertir valores en porcentajes
        for (let i = 0; i < suficiencia_1.length; i++) {
          if(parseInt(suficiencia_1[i].suficiencia)==2){
            suficiencia_1[i].suficiencia = 1 / 3
          }else if(parseInt(suficiencia_1[i].suficiencia)==3){
            suficiencia_1[i].suficiencia = (1 / 3)*2
          }else if(parseInt(suficiencia_1[i].suficiencia)==4){
            suficiencia_1[i].suficiencia = (1 / 3)*3
          }else if(parseInt(suficiencia_1[i].suficiencia)==1){
            suficiencia_1[i].suficiencia = 0;
          }
        }
        for (let i = 0; i < coherencia_1.length; i++) {
          if(parseInt(coherencia_1[i].coherencia)==2){
            coherencia_1[i].coherencia = 1 / 3
          }else if(parseInt(coherencia_1[i].coherencia)==3){
            coherencia_1[i].coherencia = (1 / 3)*2
          }else if(parseInt(coherencia_1[i].coherencia)==4){
            coherencia_1[i].coherencia = (1 / 3)*3
          }else if(parseInt(coherencia_1[i].coherencia)==1){
            coherencia_1[i].coherencia = 0;
          }
        }
        for (let i = 0; i < relevancia_1.length; i++) {
          if(parseInt(relevancia_1[i].relevancia)==2){
            relevancia_1[i].relevancia = 1 / 3
          }else if(parseInt(relevancia_1[i].relevancia)==3){
            relevancia_1[i].relevancia = (1 / 3)*2
          }else if(parseInt(relevancia_1[i].relevancia)==4){
            relevancia_1[i].relevancia = (1 / 3)*3
          }else if(parseInt(relevancia_1[i].relevancia)==1){
            console.log("entre aqui: ", relevancia_1[1])
            relevancia_1[i].relevancia = 0;
          }
        }
        console.log("relevancia 1: ", relevancia_1);

        for (let i = 0; i < claridad_1.length; i++) {
          if(parseInt(claridad_1[i].claridad)==2){
            claridad_1[i].claridad = 1 / 3
          }else if(parseInt(claridad_1[i].claridad)==3){
            claridad_1[i].claridad = (1 / 3)*2
          }else if(parseInt(claridad_1[i].claridad)==4){
            claridad_1[i].claridad = (1 / 3)*3
          }else if(parseInt(claridad_1[i].claridad)==1){
            claridad_1[i].claridad = 0;
          }
        }
        //suma de valores obtenidos por items
        let suficiencia_s =[];
        let coherencia_s =[];
        let relevancia_s =[];
        let claridad_s =[];
        //console.log("antes de sumar: ", suficiencia_1)
        this.items_e.forEach(ite_e => {
          let acu = 0;
          let conteo = 0;
          let temp = {};
          suficiencia_1.forEach(s_1 => {
            if(s_1.id_item == ite_e.id_item){
              acu = acu + s_1.suficiencia;
              conteo = conteo + 1;
            }
          });
          if(conteo == this.doc_eval.length){
            temp = {"id_item": ite_e.id_item, "id_criterio": ite_e.id_criterio, "suma": acu/conteo}
            suficiencia_s.push(temp);
          }

          acu = 0;
          conteo = 0;
          temp = {}
          coherencia_1.forEach(c_1 => {
            if(c_1.id_item == ite_e.id_item){
              acu = acu + c_1.coherencia;
              conteo = conteo + 1;
            }
          });
          if(conteo == this.doc_eval.length){
            temp = {"id_item": ite_e.id_item, "id_criterio": ite_e.id_criterio, "suma": acu/conteo}
            coherencia_s.push(temp);
          }

          acu = 0;
          conteo = 0;
          temp = {}
         
          relevancia_1.forEach(r_1 => {
            if(r_1.id_item == ite_e.id_item){
              acu = acu + r_1.relevancia;
              conteo = conteo + 1;
            }
          });
          if(conteo == this.doc_eval.length){
            temp = {"id_item": ite_e.id_item, "id_criterio": ite_e.id_criterio, "suma": acu/conteo}
            relevancia_s.push(temp);
          }

          acu = 0;
          conteo = 0;
          temp = {}
          claridad_1.forEach(cl_1 => {
            if(cl_1.id_item == ite_e.id_item){
              acu = acu + cl_1.claridad;
              conteo = conteo + 1;
            }
          });
          if(conteo == this.doc_eval.length){
            temp = {"id_item": ite_e.id_item, "id_criterio": ite_e.id_criterio, "suma": acu/conteo}
            claridad_s.push(temp);
          }
        });
        console.log("relevancia s: ", relevancia_s);
        //preparar array para tabla de v aiken
        this.criterio_e.forEach(crite =>{
          let temp = {"id_criterio":crite.id_criterio,"nombre": crite.nombre, "suficiencia": 0, "coherencia": 0, "relevancia":0, "claridad":0,"total": 0};
          this.tbl_v_aiken.push(temp);
        })
        //suma y promedio por criterio

        this.tbl_v_aiken.forEach(cri_1 =>{
          let acu2 = 0;
          let conteo2 = 0;
          suficiencia_s.forEach(val_2 => {
            if(val_2.id_criterio == cri_1.id_criterio){
              acu2 = acu2 + val_2.suma;
              conteo2 = conteo2 + 1
            }
          });
          cri_1.suficiencia = acu2/conteo2;
          

          acu2 = 0;
          conteo2 = 0;
          coherencia_s.forEach(val_3 => {
            if(val_3.id_criterio == cri_1.id_criterio){
              acu2 = acu2 + val_3.suma;
              conteo2 = conteo2 + 1
            }
          });
          cri_1.coherencia = acu2/conteo2;
          

          acu2 = 0;
          conteo2 = 0;
          relevancia_s.forEach(val_4 => {
            if(val_4.id_criterio == cri_1.id_criterio){
              acu2 = acu2 + val_4.suma;
              conteo2 = conteo2 + 1
            }
          });
          cri_1.relevancia = acu2/conteo2;
          

          acu2 = 0;
          conteo2 = 0;
          claridad_s.forEach(val_4 => {
            if(val_4.id_criterio == cri_1.id_criterio){
              acu2 = acu2 + val_4.suma;
              conteo2 = conteo2 + 1
            }
          });
          cri_1.claridad = acu2/conteo2;
          

          cri_1.total =  (cri_1.suficiencia + cri_1.coherencia + cri_1.relevancia + cri_1.claridad)/4;

          cri_1.suficiencia = cri_1.suficiencia.toFixed(2);
          cri_1.coherencia = cri_1.coherencia.toFixed(2);
          cri_1.relevancia = cri_1.relevancia.toFixed(2);
          cri_1.claridad = cri_1.claridad.toFixed(2);
          cri_1.total = cri_1.total.toFixed(2);
          
        });
        //total parte final v de aiken
        let cont_s = 0;
        let cont_co = 0;
        let cont_r = 0;
        let cont_cl = 0;
        let cont_t = 0;
        this.tbl_v_aiken.forEach(aiken_2 => {
          cont_s = cont_s + parseFloat(aiken_2.suficiencia);
          cont_co = cont_co + parseFloat(aiken_2.coherencia);
          cont_r = cont_r + parseFloat(aiken_2.relevancia);
          cont_cl = cont_cl + parseFloat(aiken_2.claridad);
          cont_t = cont_t + parseFloat(aiken_2.total);
        });
        this.tr_v_aiken_f[0].suficiencia = (cont_s / this.criterio_e.length).toFixed(2);
        this.tr_v_aiken_f[0].coherencia = (cont_co / this.criterio_e.length).toFixed(2);
        this.tr_v_aiken_f[0].relevancia = (cont_r / this.criterio_e.length).toFixed(2);
        this.tr_v_aiken_f[0].claridad = (cont_cl / this.criterio_e.length).toFixed(2);
        this.tr_v_aiken_f[0].total = (cont_t / this.criterio_e.length).toFixed(2);

        
        //console.log("tabla v aiken: ", this.tbl_v_aiken);
        //calculo de alfa de cronbanch



        //contar cantidad de items con valores entre 3 y 4
/*  //calculo comentado por el de arriba que es el de la tabla 6
        expertos_1.forEach(expe => {
          let temp3 = 0;

          for(var i = 0; i<expe[2].evaluaciones.length; i++){
            //console.log("valor claridad: ", parseInt(expe[2].evaluaciones[i].claridad));
            if(parseInt(expe[2].evaluaciones[i].claridad) >= 3){
              expe[3].total = expe[3].total + 1;
            }
            if(parseInt(expe[2].evaluaciones[i].coherencia) >= 3){
              expe[3].total = expe[3].total + 1;
            }
            if(parseInt(expe[2].evaluaciones[i].relevancia) >= 3){
              expe[3].total = expe[3].total + 1;
            }
            if(parseInt(expe[2].evaluaciones[i].suficiencia) >= 3){
              expe[3].total = expe[3].total + 1;
            }
          }
        });
      console.log("total 3 y 4 por experto e item: ", expertos_1);
      //total items x categorias
      let total_items = this.items_e.length * 4;
      console.log("total a multiplicar: ", total_items);
      //calculo de CVI por experto:
      expertos_1.forEach(calc => {
        calc[4].CVI = calc[3].total /total_items;
      });
      console.log("CVI por experto calculado: ", expertos_1);
      //calculo de CVI general este valor se guarda en base
      let acu = 0;
      expertos_1.forEach(cvi_g => {
        acu = acu + cvi_g[4].CVI;
      });

      this.cvi_general = acu / this.doc_eval.length;

      console.log("CVI GENERAL FINAL: ", this.cvi_general);*/


/* //este calculo se hizo tomando como ejemplo la pestaña CVS del documento excel
      let claridad_v =[];
      let coherencia_v =[];
      let relevancia_v =[];
      let suficiencia_v = [];

      

      this.items_e.forEach(items => {
        this.generales_cal.forEach(cal_gen => {
          if(items.id_item == cal_gen.id_item){
            let temp = 0;

            if(parseInt(cal_gen.claridad) >= 3){
              temp = 1;
            }else{
              temp = 0;
            }
            claridad_v.push({"calificacion":temp, "id_experto": cal_gen.id_experto, "id_item": cal_gen.id_item });
            
            if(parseInt(cal_gen.coherencia) >= 3){
              temp = 1;
            }else{
              temp = 0;
            }
            coherencia_v.push({"calificacion":temp, "id_experto": cal_gen.id_experto, "id_item": cal_gen.id_item });

            if(parseInt(cal_gen.relevancia) >= 3){
              temp = 1;
            }else{
              temp = 0;
            }
            relevancia_v.push({"calificacion":temp, "id_experto": cal_gen.id_experto, "id_item": cal_gen.id_item });

          }
        });

        suficiancia_cal2.forEach(sufi2 => {
          if(items.id_item == sufi2.id_item){
            let temp_s = 0;
            if(parseInt(sufi2.suficiencia) >= 3){
              temp_s = 1;
            }else{
              temp_s = 0;
            }
            suficiencia_v.push({"calificacion":temp_s, "id_experto": sufi2.id_experto, "id_item": sufi2.id_item });
            
          }
          
        });
        console.log("suficiencia_v ", suficiencia_v);
        //parte para suficiencia
        
      });
      
      

      //ciclo a items para obtener 1 cvr por categoria e item
      let claridad_cvr_cvi = [];
      let coherencia_cvr_cvi = [];
      let relevancia_cvr_cvi = [];
      let suficiencia_cvr_cvi = [];
      let t_expertos = this.doc_eval.length/2;
      let t_expertos_cvi = this.doc_eval.length;
      this.items_e.forEach(ite_c => {
        let total = 0;
        claridad_v.forEach(cla => {
          if(cla.id_item == ite_c.id_item){
            if(cla.calificacion == 1){
              total = total + 1;
            }
          }
          
        });
        //console.log("total: ", total, " t_expertos(N/2): ",t_expertos);
        let calculo = (total - t_expertos)/t_expertos;
        let calculo_cvi = total / t_expertos_cvi;
        claridad_cvr_cvi.push({"id_item": ite_c.id_item, "cvr": calculo, "cvi": calculo_cvi});

        let total2 = 0;
        coherencia_v.forEach(cohe => {
          if(cohe.id_item == ite_c.id_item){
            if(cohe.calificacion == 1){
              total2 = total2 + 1;
            }
          }
          
        });
        //console.log("total: ", total, " t_expertos(N/2): ",t_expertos);
        let calculo2 = (total2 - t_expertos)/t_expertos;
        let calculo2_cvi = total2 / t_expertos_cvi;
       coherencia_cvr_cvi.push({"id_item": ite_c.id_item, "cvr": calculo2, "cvi": calculo2_cvi});

       let total3 = 0;
        relevancia_v.forEach(rele => {
          if(rele.id_item == ite_c.id_item){
            if(rele.calificacion == 1){
              total3 = total3 + 1;
            }
          }
          
        });
        //console.log("total: ", total, " t_expertos(N/2): ",t_expertos);
        let calculo3 = (total3 - t_expertos)/t_expertos;
        let calculo3_cvi = total3 / t_expertos_cvi;
       relevancia_cvr_cvi.push({"id_item": ite_c.id_item, "cvr": calculo3, "cvi": calculo3_cvi});

       let total4 = 0;
        suficiencia_v.forEach(sufi3 => {
          if(sufi3.id_item == ite_c.id_item){
            //console.log("sufi3 ", sufi3, "ite_c ", ite_c);
            if(sufi3.calificacion == 1){
              total4 = total4 + 1;
            }
          }
          
        });
        //console.log("total: ", total4, " t_expertos(N/2): ",t_expertos);
        let calculo4 = (total4 - t_expertos)/t_expertos;
        let calculo4_cvi = total4 / t_expertos_cvi;
        suficiencia_cvr_cvi.push({"id_item": ite_c.id_item, "cvr": calculo4, "cvi": calculo4_cvi}); 

      })
      console.log("claridad cvr_cvi: ", claridad_cvr_cvi);
      console.log("coherencia cvr_cvi: ", coherencia_cvr_cvi);
      console.log("relevancia cvr_cvi: ", relevancia_cvr_cvi);
      console.log("suficiencia cvr_cvi: ", suficiencia_cvr_cvi); */
      //fin categoria claridad
    },

    mostrar_evaluaciones(){
      console.log("expertos a mostrar evaluaciones: ",this.docentes_eval);
      this.docentes_eval2 = this.docentes_eval;


    },


    //metodos para evaluacion por pares
    onRowClick (evt, row) {
      console.log("fila seleccionada: ", row);
      this.id_asig_estu = row.id_asignacion_estudiante;
      this.actual_homework = row.nombre_tarea+" - "+row.d_tarea;
      this.id_rub_actual2 = row.id_rubrica;
      this.link_evaluar = row.link_drive;
      this.id_tarea_actual2 = row.id_tarea;
      this.id_estudiante_tarea = row.id_estudiante;
      $("#s_e_individual").show();
      $("#s_e_principal").hide();
      //$("#rurbica_m").show();
      this.criterios_niveles_evaluacion(row.id_rubrica);
      this.mostrar_rubrica_completa2(this.id_rub_actual2);
      // peticion para traer la rubrica
      //peticion para obtener los criterios de la rubrica en los arrays
  },
  onRowClick_t(evt, row){
    console.log("fila seleccionada: ", row);
    this.filter_s_evaluation = row.nombre_tarea;
    this.id_rub_actual2 = row.id_rubrica;
    $("#tareas_tablas").hide();
    $("#tareas_estudiante").show();
    //$("#rurbica_m").hide();
  },
  onRowBack(){
      $("#s_e_individual").hide();
      $("#s_e_principal").show();
      //$("#rurbica_m").hide();
      this.t_niveles = [];
      this.t_criterios.criterios = [];
      this.homework_items = [];
      this.s_e_evaluaciones = [];
      this.observacion = [];
  },
  onRowBack_t(){
    $("#tareas_tablas").show();
    $("#tareas_estudiante").hide();
    //$("#rurbica_m").hide();
},
  criterio_nota(criterio){
    console.log("criterio que se califica: ", criterio);
  },
  validar_calificacion(objeto){
    console.log("objeto:", objeto);
  },
  s_e_save_evaluation() {
      if (this.s_e_evaluaciones.length === this.homework_items.length && this.observacion.length == this.homework_items.length) {
        //validar primero el cuestionario
        if(this.getCookie('TOKEN_2')== 'ESTUDIANTE'){
            axios.get('validar_cuestionario/'+this.id_rub_actual2+'/'+this.getCookie('TOKEN_1'))
          .then(val=>{
            if(val.data == 0){
              //peticion para obtener preguntas de satisfaccion
              axios.get('question_satisfaccion/'+1)
              .then(con=>{
                this.preguntas_val = con.data;
                axios.get('question_satisfaccion/'+2)
                .then(con2=>{
                  this.preguntas_sat = con2.data;
                  this.question = true;
                });
              });
            }else{

              this.save_question();
            }
            
          });
        }else if(this.getCookie('TOKEN_2')== 'DOCENTE'){
          this.save_question_docente(); 
        }
        //guardar cuestionario de satisfaccion de la rubrica
      } else {
          alert("Complete todos los items");
      }
  },
    // fin metodos para evaluacion por pares
    //metodos adicionale

    getHomeWorkInfo(id_tarea,asig_pares){
        if(id_tarea == 0){
          this.get_asignaturas();
          this.get_rubricas_tareas();
          this.periodo_actual = this.campo_periodo[0].nombre;
          this.tarea_info = true;
        }else{
          //validar si la tarea ya tiene ejecucion por pares
          //console.log("estado asignacion: ", asig_pares);
          if(asig_pares == 1){
            //bloquear edición de tarea
            this.btn_guadar_tarea = true;
          }else{
            this.btn_guadar_tarea = false;
          }
          this.id_tarea_actual = id_tarea;
          console.log('id_tarea_actual: ', id_tarea);
          this.periodo_actual = this.campo_periodo[0].nombre;
          this.homeworks.forEach(tarea => {
            if(tarea.id_tarea == id_tarea){
              this.materia_lista = {'id_materia':tarea.id_asi, 'nombre': tarea.materia};
              this.paralelo_lista = {'idparalelo':tarea.id_paralelo, 'nombre': tarea.paralelo};
              this.tarea_nombre = tarea.nombre;
              this.rubrica_tarea = {'id':tarea.id_rubrica, 'nombre':tarea.rubrica};
              this.tarea_descripcion = tarea.descripcion;
              this.tarea_nota_maxima = tarea.nota_maxima;
              this.tarea_url = tarea.link;
              this.tarea_inicio = tarea.fecha_inicio;
              this.tarea_fin = tarea.fecha_fin;
            }
          });
          this.get_asignaturas();
          this.get_paralelos();
          this.get_rubricas_tareas();
        }
        //this.tarea_actual = id_tarea;

    },
    save_question(){
           //guardar parte de evaluacion por pares
           let array_cal = [];
           for (let i = 0; i < this.s_e_evaluaciones.length; i++) {
             //console.log("calificacion: " + this.s_e_evaluaciones[i].id + " " + this.homework_items[i].nombre + " id_item:" + this.homework_items[i].id)
             let temp= {
               'id_asignacion_estudiante': this.id_asig_estu,
               'id_nivel': this.s_e_evaluaciones[i].id,
               'id_criterio': this.homework_items[i].id,
               'observacion': this.observacion[i]
             }
             array_cal.push(temp);
           }
           //peticion para guardar evaluaciones por pares
           axios.put('evaluacion_pares_estudiante',array_cal)
           .then(resultado => {
             console.log("resultado: ", resultado.data);
             this.asig_eval_estudiantes();
             this.onRowBack();
           });
    },
    save_question_docente(){
      //guardar parte de evaluacion por pares
      let array_cal2 = [];
      for (let i = 0; i < this.s_e_evaluaciones.length; i++) {
        //console.log("calificacion: " + this.s_e_evaluaciones[i].id + " " + this.homework_items[i].nombre + " id_item:" + this.homework_items[i].id)
        let temp5= {
          'id_tarea': this.id_tarea_actual2,
          'id_estudiante': this.id_estudiante_tarea,
          'id_nivel': this.s_e_evaluaciones[i].id,
          'id_criterio': this.homework_items[i].id,
          'observacion': this.observacion[i]
        }
        array_cal2.push(temp5);
      }
      //peticion para guardar evaluaciones por pares
      axios.put('evaluacion_pares_docente',array_cal2)
      .then(resultado => {
        console.log("resultado: ", resultado.data);
        this.asig_eval_docente();
        this.onRowBack();
      });
},
    save_cuestionario(){
      let temp =0;
      let temp2 =0;
      this.validacion.forEach(vali => { 
        if(vali != ""){
          temp = temp + 1;
        }
      });
      this.satisfaccion.forEach(sati => { 
        if(sati != ""){
          temp2 = temp2 + 1;
        }
      });
      if(this.preguntas_sat.length == temp2 && this.preguntas_val.length == temp){
        //guardo el cuestionario
        let array_cuestionario =[];
        for(let i = 0 ; i<this.satisfaccion.length; i++){
          let temp3 = {
            'id_rubrica': this.id_rub_actual2,
            'id_estudiante': this.getCookie('TOKEN_1'),
            'calificacion': this.satisfaccion[i],
            'id_pregunta': this.preguntas_sat[i].id
          };
          array_cuestionario.push(temp3);
        };
        for(let j = 0 ; j<this.validacion.length; j++){
          let temp4 = {
            'id_rubrica': this.id_rub_actual2,
            'id_estudiante': this.getCookie('TOKEN_1'),
            'calificacion': this.validacion[j],
            'id_pregunta': this.preguntas_val[j].id
          };
          array_cuestionario.push(temp4);
        }
        console.log("array cuestionario: ", array_cuestionario);
        axios.post('guardar_cuestionario',array_cuestionario)
        .then(cuestio => {
          console.log("guardado: ", cuestio.data);
          if( cuestio.data == 1){
            this.question = false;
            this.preguntas_sat = [];
            this.preguntas_val = [];
            this.satisfaccion = [];
            this.validacion = [];
            this.save_question();
          }else{
            alert("Error al guardar...");
          }
        })
      }else{
        alert("Complete el cuestionario");
      }
      
    },
    asig_eval_docente(){
      axios.get('get_asignaciones_doce/'+this.getCookie('TOKEN_1'))
      .then(res =>{
        console.log("asignados para evaluarse con el docente: ", res.data);
        this.s_e_rows = res.data;
        //array para nueva tabla de mostrar tareas solamente
        let temp_n = [];
        
        this.s_e_rows.forEach(todos => {
          let control = 0;
         // console.log("entre a ciclo todos: " ,todos);
          if(this.s_e_rows_t.length == 0){
            console.log("entre a primero.")
            let temp = todos;
            this.s_e_rows_t.push(temp);
          }else{
            this.s_e_rows_t.forEach(ele => {
           // console.log("entre a ciclo ele: " ,ele);
            if(ele.nombre_tarea == todos.nombre_tarea ){
              control = 1;
              
            }     
          });
          if(control == 0){
            let temp = todos;
              this.s_e_rows_t.push(temp);
              console.log("control: ", control, "nombre tarea: ", todos.nombre_tarea)
          }
        }
          
        });
      });

    },
    asig_eval_estudiantes(){
      axios.get('get_asignaciones_eval/'+this.getCookie('TOKEN_1'))
      .then(res =>{
        console.log("asignados para evaluarse: ", res.data);
        this.s_e_rows = res.data;
        //array para nueva tabla de mostrar tareas solamente
         //array para nueva tabla de mostrar tareas solamente
         let temp_n = [];
        
         this.s_e_rows.forEach(todos => {
           let control = 0;
           //console.log("entre a ciclo todos: " ,todos);
           if(this.s_e_rows_t.length == 0){
             console.log("entre a primero.")
             let temp = todos;
             this.s_e_rows_t.push(temp);
           }else{
             this.s_e_rows_t.forEach(ele => {
             //console.log("entre a ciclo ele: " ,ele);
             if(ele.nombre_tarea == todos.nombre_tarea ){
               control = 1;
               
             }     
           });
           if(control == 0){
             let temp = todos;
               this.s_e_rows_t.push(temp);
               console.log("control: ", control, "nombre tarea: ", todos.nombre_tarea)
           }
         }
           
         });
       /*  let temp_n = [];
        this.s_e_rows.forEach(todos => {
          temp_n.forEach(ele => {
            if(ele.nombre_tarea != todos.nombre_tarea ){
              let temp = todos;
              temp_n.push(temp);
            }
            this.s_e_rows_t.push(temp_n);
          });
          
        }); */
      });

    },
    asig_evaluaciones(){
      //validar que no tenga la asignacion realizada
      //console.log("estado asignacion: ", this.c_eval_pares);
      if(this.c_eval_pares == 0){
        const fecha = Date.now();
        const hoy = new Date(fecha);
        let fecha_fin = ''
        this.homeworks.forEach(tareas => {
          if(tareas.id_tarea == this.id_tarea_actual){
            fecha_fin = tareas.fecha_fin;
          }
        });
        let fecha_f = new Date(fecha_fin);
        if(hoy > fecha_f){
          this.valor_asignaciones = true;
        }else{
          this.mensaje_v = "Tarea activa para entregas, fecha final: "+fecha_fin;
          this.mensaje_tarea = true;
        }
      }else{
        this.mensaje_v = "La asignación ya se encuantra realizada";
        this.mensaje_tarea = true;
      }
      
    },

    ditribuir_tareas(){
      if(this.cantidad_tareas > this.maximo){
        this.mensaje_v = "El máximo permitido es: "+this.maximo;
        this.mensaje_tarea = true;
      }else{
        if(this.eval_fin.trim()== ""){
          this.mensaje_v = "Sleccione fecha fin para ejecutar evaluaciones";
          this.mensaje_tarea = true;
        }else{
          //
          //algoritmo para asignar evaluaciones por pares
        //------
        const estudiantes_id = [];
        this.estudiantes_add = [];
        let contador = 1;
        this.estudiantes_entrega.forEach(lista => {
          //array de estudiantes con asignaciones
          this.estudiantes_add.push({'idpersonal':lista.idpersonal,/*  'nombre':lista.estudiante, */'asignaciones':[],'asignado': 0});
          contador = contador + 1;
        });
        contador = 0;
        const estudiantes_copia = this.estudiantes_entrega;
        //console.log("estudiantes_add: ", this.estudiantes_add);
        this.estudiantes_add.forEach(estud => {
          let control = 0;
          do {
            let found = [];  
              let control1= 0;
              do{
                let num = this.getRandomInt(0,estudiantes_copia.length);
                if(estud.idpersonal != this.estudiantes_add[num].idpersonal && 
                  this.estudiantes_add[num].asignado < this.cantidad_tareas &&
                  this.asignado_estudiante(estud,this.estudiantes_add[num]) == 0
                  ){
                  control1 = 1;
                  found = this.estudiantes_add[num];
                  this.estudiantes_add[num].asignado = this.estudiantes_add[num].asignado + 1;
                  
                }
                
                this.array_ciclo.forEach(ciclo => {
                  if(ciclo.idpersonal == this.estudiantes_add[num].idpersonal && ciclo.cantidad > 2){
                    control1 = 1;
                    this.array_ciclo = [];
                  }
                });
              }while(control1 == 0);
              //.find(element => element.posicion == num);
              //console.log("found: ", found);
              estud.asignaciones.push(/* [ */found.idpersonal/* ,found.nombre] */);
              control = control + 1;
          } while (control < this.cantidad_tareas);
          /*for (let i = 0; i  < this.cantidad_tareas; i++) {
            const found = estudiantes_id.find(element => element.posicion = num);
            console.log("encontrado ", found);  
          }*/
        });
          //console.log("final: ", this.estudiantes_add);
          //armar array para tbl 3 primera asignacion de evaluacion
          this.estudiantes_entrega.forEach(entrega => {
            let temp = {
              'idpersonal': entrega.idpersonal,
              'estudiante': entrega.estudiante,
              'correo': entrega.correo,
              'link_envio': entrega.link_envio,
              'fecha_envio': entrega.fecha_envio,
              'asignados':[]
            }
            //let control = 0;
            this.estudiantes_add.forEach(add => {
              
              if(entrega.idpersonal == add.idpersonal){

                for(var i = 0; i<add.asignaciones.length; i++){
                  //console.log("ultima: ", add.asignaciones[i]);
                  if(add.asignaciones[i] != undefined){
                    //console.log("indefinido aqui");
                    let temp_nombre = '';
                    for (let j = 0; j < this.estudiantes_entrega.length; j++) {
                      if(this.estudiantes_entrega[j].idpersonal == add.asignaciones[i]){
                        temp_nombre = this.estudiantes_entrega[j].estudiante;
                        j = this.estudiantes_entrega.length;
                      }   
                    };
                    let temp2 = {
                      'nombre': temp_nombre,
                      'porcentaje': '--',
                      'nota': '--',
                    }
                    temp.asignados.push(temp2);
                  }
                  
                }
                
              }
            });
            this.estudiantes_evaluar.push(temp);
            
          });
          //console.log("estudiantes evaluar: ", this.estudiantes_evaluar)
          document.getElementById("tbl_3").style.display = null;
          document.getElementById("tbl_2").style.display = 'none';
          document.getElementById("tbl_1").style.display = 'none';
          //guardar asignaciones
          let con = {
            'docente': this.getCookie('TOKEN_1'),
            'tarea': this.id_tarea_actual,
            'fecha': this.eval_fin
          }
          axios.put('tarea_control',con)
          .then(respuesta => {
           // console.log("id_control: ",respuesta.data);
            let id_asig = respuesta.data;
            let array_e = [];
            this.estudiantes_add.forEach(estu => {
              for(var i = 0; i<estu.asignaciones.length; i++){
                if(estu.asignaciones[i]== undefined){
                  console.log("indefinido");
                }else{
                  let temp = {
                    'id_asignacion': id_asig,
                    'id_estudiante': estu.idpersonal,
                    'id_asignado': estu.asignaciones[i]
                  }
                  array_e.push(temp);
                }
                
              }
            });
           
            //peticion a almacenar las asignaciones
            axios.put('tarea_asignaciones',array_e)
            .then(asig =>{
              
              document.getElementById("asignar").style.display = "none";

            })
          });

          this.valor_asignaciones = false;

        }
        
        
      }
    },
    limpiar_array_estudiantes(){
      //limpiar arrays de estudiantes
      this.c_eval_pares = 0;
      this.estudiantes_add = [];
      this.estudiantes_lista = [],
      this.estudiantes_entrega = [],
      this.estudiantes_evaluar = [],
      this.each_tarea = false;
    },
    asignado_estudiante(estudiante, estudiante_asignar){
      let control = 0;
      estudiante.asignaciones.forEach(asig => {
       
        if(asig == estudiante_asignar.idpersonal){
          if(this.array_ciclo.length == 0){
            this.array_ciclo.push({'idpersonal': estudiante_asignar.idpersonal, 'cantidad':1});
          }else{
            for(var i = 0; i<this.array_ciclo.length; i++){
              if(this.array_ciclo[i].idpersonal == estudiante_asignar.idpersonal){
                this.array_ciclo[i].cantidad = this.array_ciclo[i].cantidad + 1;
              }else{
                this.array_ciclo.push({'idpersonal': estudiante_asignar.idpersonal, 'cantidad':1});
              }
            }
          }
          control = 1;
        }
      });
     
      return control;
    },
    getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min)) + min;
    },
    estado_tarea(id_tarea,id_asigna){
      //this.showLoading();
      
       document.getElementById("log").style.display = null;
       document.getElementById("principal_h").style.display = "none";
      
      /*document.getElementById("log").style.display = null; */
      const fecha = Date.now();
      const hoy = new Date(fecha);
      let fecha_f = '';

      this.id_tarea_actual = id_tarea;
      let array = {};
      let array2 = {};
      this.homeworks.forEach(tareas => {
        if(tareas.id_tarea == id_tarea){
          let _f = tareas.fecha_fin
          fecha_f = new Date(_f);
          array = {
            'id_periodo': this.campo_periodo[0].idperiodo,
            'id_docente': this.getCookie('TOKEN_1'),
            'id_materia': tareas.id_asi,
            'id_paralelo': tareas.id_paralelo,
            'id_tarea': tareas.id_tarea
          };
          array2 = {
            'docente': this.getCookie('TOKEN_1'),
            'tarea': tareas.id_tarea
          }
        }
      });
     
    axios.post('estudiante_paralelo',array)
      .then(estudiantes =>{
        
        this.estudiantes_lista = estudiantes.data;
        this.estudiantes_entrega = this.estudiantes_lista.filter(x => x.estado == "ENVIADA");
       
        this.maximo = this.estudiantes_lista.length;
        // peticion para obtener el estado de la asignacion de la evaluacion por pares
        
        axios.post('estado_evaluacion',array2)
        .then(est => {
              
              this.c_eval_pares = est.data;
             // console.log("hoy: ", fecha, " fecha_f: ", fecha_f);
            if(fecha_f <= fecha){
              console.log("entrando aqui");
              document.getElementById("tbl_1").style.display = "none";
              if(this.c_eval_pares == 0){
                //caso no asignado evaluacion por pares
                document.getElementById("asignar").style.display = null;
                document.getElementById("tbl_2").style.display = null;
                document.getElementById("tbl_3").style.display = 'none';
              }else{
                //caso asignado evaluacion por pares
                //validar inahabilitar btn de asignacion de evaluacion
               
                document.getElementById("asignar").style.display = "none";
                //peticiones para traer datos
                axios.get('get_asignaciones/'+this.id_tarea_actual)
                .then(actual =>{
                  
                  let general = actual.data;

                  axios.get('get_asignaciones_tarea/'+this.id_tarea_actual)
                .then(asigna =>{
                  
                  let asignaciones = asigna.data; 
// prueba para traer notas docente y estudiantes
                axios.get('get_notas_docente/'+this.id_tarea_actual)
                .then(notas=>{
                  console.log("estudiantes con notas: ", notas.data);
                  let temp_notas = notas.data[0];
                  let temp_notas_e = notas.data[1];

                  let asignados_1 = [];
                  for (let i = 0; i < general.length; i++) {
                    let nota_temp = 'S/N';
                    for(let n = 0; n < temp_notas.length; n++){
                      if(temp_notas[n][0] == general[i].idpersonal){
                        nota_temp = temp_notas[n][1];
                      }
                    }
                    let temp1 =
                      {
                        "id_estudiante": general[i].idpersonal,
                        'estudiante': general[i].estudiante,
                        //'fecha_envio': general[i].fecha_envio,
                        //'link_envio':general[i].link_envio,
                        'nota_docente': nota_temp,
                        'asignados': []
                      }
                    
                    for (let j = 0; j < asignaciones.length; j++) {
                      //para notas de evaluaciones por pares
                      
                      //console.log("general[]:", general[i]);
                      if(general[i].idpersonal == asignaciones[j].idpersonal ){
                        let nota_temp = 'S/N';
                        for(let k = 0; k<temp_notas_e.length; k++){
                          if(temp_notas_e[k][0] == general[i].idpersonal && temp_notas_e[k][1] == asignaciones[j].asignado){
                            nota_temp = temp_notas_e[k][2];
                          }
                        }

                        let temp2 = {
                          'nombre': asignaciones[j].n_asignado,
                          /* 'porcentaje': '--', //pendiente consultar */
                          'nota': nota_temp
                        }
                        temp1.asignados.push(temp2);
                      }
                    }
                    this.estudiantes_evaluar.push(temp1);
                  }
                document.getElementById("tbl_1").style.display = 'none';
                document.getElementById("tbl_2").style.display = 'none';
                document.getElementById("tbl_3").style.display = null;         
                })
                });
                })

                
              }
              
            }else{
              console.log("entrando aqui2");
              document.getElementById("tbl_1").style.display = null;
              document.getElementById("tbl_2").style.display = "none";
              document.getElementById("tbl_3").style.display = "none";
            }
            //this.hideLoading();
            //console.log(document.getElementById("tbl_1"));
          });
          this.each_tarea = true;
          document.getElementById("log").style.display = 'none';
          document.getElementById("principal_h").style.display = null;
        });
        //
        
    },
    obtener_paralelos(){
      this.paralelo_lista = '';
      this.get_paralelos();
    },
    get_paralelos(){
      axios.get('paralelos/'+this.campo_periodo[0].idperiodo+'/'+this.getCookie('TOKEN_1')+'/'+this.materia_lista.id_materia)
      .then(paralelo =>{
       
        this.disable_paralelo = false;
        this.paralelo_lista_options = paralelo.data;
      });
    },
    get_rubricas_tareas(){
      axios.get('rubricas_tarea/'+this.getCookie('TOKEN_1'))
      .then(rub_tarea => {
        console.log("rurbicas tarea: ", rub_tarea.data);
        this.rubrica_tarea_options = rub_tarea.data;
      });
    },
    actualizar_tareas_envio(){
      //caso de nueva tarea
      if(this.id_tarea_temp == 0){
        //validacion campos llenos
        
        let fecha_i = new Date(this.tarea_inicio);
        let fecha_f = new Date(this.tarea_fin);
        
        
        if(this.materia_lista != '' && this.paralelo_lista != ''
        && this.tarea_nombre != '' && this.rubrica_tarea != ''
        && this.tarea_descripcion != '' && this.tarea_nota_maxima != ''
        && this.tarea_inicio != '' && this.tarea_fin != ''){
          if(fecha_i >= fecha_f){
            
            this.mensaje_v = "La fecha final debe ser mayor a la incial";
            this.mensaje_tarea = true;
          }else{
            
            const tarea = {
              'id_tarea' : this.id_tarea_actual, 
              'id_docente': this.getCookie('TOKEN_1'),
              'id_periodo': this.campo_periodo[0].idperiodo,
              'id_asignatura': this.materia_lista.id_materia,
              'paralelo': this.paralelo_lista.idparalelo,
              'id_rubrica': this.rubrica_tarea.id,
              'nombre': this.tarea_nombre,
              'descripcion': this.tarea_descripcion,
              'nota_maxima': this.tarea_nota_maxima,
              'fecha_inicio': this.tarea_inicio,
              'fecha_fin': this.tarea_fin,
              'link': this.tarea_url,
              'estado': 'EN DESARROLLO'
            };
            axios.post('update_tarea',tarea)
            .then(tarea_act => {
              
              //vaciar modal
              this.limpiar_tarea();
              //recargar tareas
              this.get_tareas_docente();
              //cerrar modal
              this.tarea_info = false;
              this.id_tarea_actual = 0;
            });
          }
          
          //array para guardar tarea nueva          
        }else{
          this.mensaje_v = "Faltan llenar campos obligatorios para guardar la tarea"
          this.mensaje_tarea = true;
          
        }

      }
    },
    get_tareas_docente(){
      axios.get('get_tareas_docente/'+this.getCookie('TOKEN_1'))
      .then(tar_rec => {
        
        this.homeworks = tar_rec.data;
      });
    },
    limpiar_tarea(){
      this.materia_lista = '';
      this.paralelo_lista = '';
      this.tarea_nombre = '';
      this.rubrica_tarea = '';
      this.tarea_descripcion = '';
      this.tarea_url = '';
      this.tarea_nota_maxima = '';
      this.disable_paralelo= true;
      this.id_tarea_actual = 0;
    },

    abrir_tarea(id_tarea){
      
      this.id_tarea_temp_e = id_tarea;
      let tarea_actual;
      this.tareas_estudiante.forEach(tar => {
        if(tar.id == id_tarea){
          this.tarea_descripcion_e = tar.descripcion;
          this.fecha_fin_e = tar.fecha_fin;
          this.adjunto_e = tar.link;
          this.tarea_url_e = tar.link_envio;
          if(tar.estado == "ACTIVA"){
          
            this.disable_entrega = false;
           
          }else {
            
            this.disable_entrega = true;
            
          }
        }
        
      });
      this.tarea_estudiante_info = true;
    },
    abrir_link(){
      window.open(this.adjunto_e, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
    },
    abrir_link_envio(link){
      window.open(link, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
    },
    abrir_link_evaluar(){
      window.open(this.link_evaluar, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
    },
    enviar_tarea(){
      let control = new Date(this.fecha_fin_e) < new Date();
      if(control == true){
        
        this.mensaje_v = "Tarea Expirada";
        this.mensaje_tarea = true;
        
      }else{
        
        if(this.tarea_url_e.trim() != ''){
          //envio de tarea
          let tarea = {
            'estudiante': this.getCookie('TOKEN_1'),
            'tarea': this.id_tarea_temp_e,
            'link': this.tarea_url_e
          };
          axios.put('tareas_envio',tarea)
            .then(envio =>{
             
              this.mensaje_v = "Tarea enviada";
              this.mensaje_tarea = true;
              this.tarea_estudiante_info = false;
              /*Recargar tareas*/
              this.get_tareas_estudiante(this.asignatura_actual_temp);


            });
        }else{
          this.mensaje_v = "Ingrese el link de la tarea a entregar";
          this.mensaje_tarea = true;
        }
        
      }
    },
    get_tareas_estudiante(id_asig){
      
      let array_tar = {
        'periodo': this.campo_periodo[0].idperiodo,
        'asignatura': id_asig,
        'estudiante': this.getCookie('TOKEN_1')
      };
     
      axios.post("estudiante_tareas",array_tar)
      .then(tar_estu => {
        
        this.tareas_estudiante = tar_estu.data;
        this.asignatura_actual_temp = id_asig;
      });
    },

    get_materias_estudiante(){
      let array_mat = {
        'periodo': this.campo_periodo[0].idperiodo,
        'estudiante': +this.getCookie('TOKEN_1')
      };
      axios.post("estudiante/materias",array_mat)
      .then(mat_estu => {
       
        this.materias_estudiante = mat_estu.data;
      });

    },

    //metodos para evaluar rubrica
    salir_visual_texto(){
      this.persistent2_v = false, 
      this.t_nivel_criterio_temp_v=''
    },
    finalizar_evaluacion(){
     
      this.confirm_2 = true;
    },
    finalizar_evaluacion_confirmacion(){
      this.confirm_1 = false;
      if(this.id_rub_exp_temp != ""){
        let datos ={
          "id_eva": this.id_eval_exp,
          "id_rubrica": this.id_rub_exp_temp,
          "email":this.getCookie('TOKEN_4'),
          "tipo": this.getCookie('TOKEN_2'),
          "observacion": this.eva_observacion
        }
        
        axios.post("finalizar/evaluacion",datos)
        .then(final =>{
         
          if(final.data == 0){
            this.confirm_1 = true;
            
          }else{
            this.get_rubricas_expertos();
            //camboar el update del status del experto exxterno por un delete del registro de la clave
            this.n_suficiencia = '';
            this.n_coherencia= '';
            this.n_relevancia= '';
            this.n_claridad= '';
            this.n_observacion= '';
            this.m_criterio='';
            this.m_item='';
            this.eva_observacion = '';
            this.confirm_2 = false;
          }
          
        });
      }
    },
    llenar_items(){
      let suf = [];
      this.m_item = '';
      this.vaciar_array_temporal(this.item_criterio_temporal);
      
      this.t_criterios.items.forEach(element => {
        if(element.id_c == this.m_criterio.id_c){
          let valor_item = {id_i: element.id_i, n_item: element.n_item};
          this.item_criterio_temporal.push(valor_item);
          this.disable_c = false;
        }
        
      });
      //peticiones para obtener si ya existe suficiencia guardada
      let temp4 = {
        'id_evaluacion':this.id_eval_exp,
        'id_criterio':this.m_criterio.id_c
      };
      axios
      .post('obtener/suficiencia', temp4)
      .then(get_suf => {
        //console.log("suficiencia obtenida: ", get_suf.data[0]['suficiencia']);
        if(get_suf.data.length > 0){
          this.id_eval_temp_suf = get_suf.data[0]['id'];
          this.n_suficiencia = get_suf.data[0]['suficiencia'];
          this.n_coherencia= '';
          this.n_relevancia= '';
          this.n_claridad= '';
          this.n_observacion= '';
        }else if(get_suf.data.length == 0){
          this.n_suficiencia = '';
          this.n_coherencia= '';
          this.n_relevancia= '';
          this.n_claridad= '';
          this.n_observacion= '';
          this.id_eval_temp_gen = 11111111;
          //this.id_eval_temp_suf = 11111111;
        } 
      });

    },
    activar_evaluacion(){
      this.disable_i = false;
      let eva_g = [];
      //peticion para obtener si ya existen registros 
      const eva = this.id_eval_exp
      let temp5 = {
        'id_eva':eva,
        'id_item':this.m_item.id_i
      };
     
      eva_g.push(temp5);
      axios
      .post('obtener/evaluacion',temp5)
      .then(eva_general => {
       
          if(eva_general.data.length > 0){
          this.id_eval_temp_gen = eva_general.data[0]['id'];
          this.n_coherencia= eva_general.data[0]['coherencia'];
          this.n_relevancia= eva_general.data[0]['relevancia'];
          this.n_claridad= eva_general.data[0]['claridad'];
          this.n_observacion= eva_general.data[0]['observacion'];
        }else if(eva_general.data.length == 0){
          this.n_coherencia= '';
          this.n_relevancia= '';
          this.n_claridad= '';
          this.n_observacion= '';
          this.id_eval_temp_gen = 11111111;
          //this.id_eval_temp_suf = 11111111;
        }  
      });
    },
    validar_limite(){
      if(this.n_coherencia > 4 || this.n_coherencia < 1 && this.n_coherencia !=''){
        alert("el rango de valores es de 1 a 4");
        this.n_coherencia = 1;
      }
      if(this.n_relevancia > 4 || this.n_relevancia < 1 && this.n_relevancia !=''){
        alert("el rango de valores es de 1 a 4");
        this.n_relevancia = 1;
      }
      if(this.n_claridad > 4 || this.n_claridad < 1 && this.n_claridad !=''){
        alert("el rango de valores es de 1 a 4");
        this.n_claridad = 1;
      }
      if(this.n_suficiencia > 4 || this.n_suficiencia < 1 && this.n_suficiencia !=''){
        alert("el rango de valores es de 1 a 4");
        this.n_suficiencia = 1;
      }
    },
    evaluar_rubrica(id_rubrica){
      this.cargar_data_rubrica(id_rubrica);
      //obtencion de valores para posterior update de la evaluacion
      this.id_rub_exp_temp = id_rubrica;
      this.rub_general.forEach(gen => {
        if(gen.id == id_rubrica){
          this.id_eval_exp = gen.id_evaluacion;
        }
      });

      
    },
    guardar_evaluacion_item(){
     
      let eval = [];
      let eval_suf = [];
      //validaciones de campos llenos
      if(this.n_suficiencia == '' || this.n_coherencia == '' || this.n_relevancia == '' || this.n_claridad == ''){
        alert("Suficiencia, Coherencia, Relevancia y Claridad deben tener un valor");
      }else{
        //preparar arrays para peticiones
        let temp = {
          'id': this.id_eval_temp_gen, 
          'id_evaluacion': this.id_eval_exp, 
          'id_item': this.m_item.id_i,
          'coherencia' : this.n_coherencia,
          'relevancia' :this.n_relevancia,
          'claridad' : this.n_claridad,
          'observacion': this.n_observacion
        };
        eval.push(temp);
        axios
        .put('evaluacion/general',temp )
        .then(response_eva =>{
         
          //peticion para guardar suficiencia
          let temp2 = {
            'id': this.id_eval_temp_suf,
            'id_evaluacion': this.id_eval_exp, 
            'id_criterio': this.m_criterio.id_c,
            'suficiencia': this.n_suficiencia
          }; 
          eval_suf.push(temp2);
          axios
          .put('evaluacion/suficiencia',temp2)
          .then(response_suf => {
           
          });

        })
        
      }
    },
    //metodos para expertos 2021-12-08
    processOption(status,id_experto,nombres,mail,apellidos){
      
      //1: ENVIAR INVITACION -ESTADO INVITADO
      //2: ACEPTAR INVITACION - ESTADO ACEPTO
      //3: RECHAZAR INVITACION - ESTADO RECHAZO
      //4: ENVIAR RUBRICA - ESTADO EVALUANDO
      //5: ELIMINAR

      switch (status) {
          case 1:
              let info = {
                  id_experto: id_experto,
                  NOMBRE: nombres,
                  to: mail,
                  CORREO_DOCENTE: this.email,
                  DOCENTE: this.username,
                  id_rubrica: this.id_rubrica_actual,
              };

              axios
                  .post("experto/sendInvitation", info)
                  .then((response30) => {
                      
                      this.get_expertos(this.id_rubrica_actual);

                      //añadido 31/12/2021 para cambiar estado de la rubrica
                      let estado = [];
                      let temp_est = {
                        "id_rub": this.id_rubrica_actual,
                        "estado": "EVALUACION"
                      };
                      estado.push(temp_est);
                      axios
                        .put("rubrica/estado",temp_est)
                        .then(est =>{
                          
                        });
                  });
              break;

          case 2:
              let info2 = {
                  id_rubrica: this.id_rubrica_actual,
                  id_experto: id_experto,
                  estado: "ACEPTADO",
              };

              axios
                  .post("experto/changeStatus", info2)
                  .then((response30) => {
                      
                      this.get_expertos(this.id_rubrica_actual);
                  });
              break;

          case 3:
              let info3 = {
                  id_rubrica: this.id_rubrica_actual,
                  id_experto: id_experto,
                  estado: "RECHAZADO",
              };

              axios
                  .post("experto/changeStatus", info3)
                  .then((response30) => {
                     
                      this.get_expertos(this.id_rubrica_actual);
                  });
              break;

          case 4:
              let info4 = {
                  nombres: nombres,
                  apellidos: apellidos,
                  to: mail,
                  DOCENTE: this.username,
                  id_experto: id_experto,
                  id_rubrica: this.id_rubrica_actual
              };

              axios
                  .post("experto/sendRubric", info4)
                  .then((response30) => {
                     
                      this.get_expertos(this.id_rubrica_actual);
                  });
              break;

          case 5:
              let info5 = {
                  id_experto: id_experto,
              };

              axios
              .delete("experto/delete/"+id_experto)
              .then((response30) => {
                
                  this.get_expertos(this.id_rubrica_actual);
              });
              break;
      }
      
    },
    importDocente(docente){
      this.experto_nombres = docente.nombres;
      this.experto_apellidos = docente.apellido1 + " " + docente.apellido2;
      this.experto_formacion = docente.titulo;
      this.experto_cargo = docente.rol;
      this.experto_institucion = docente.universidades;
      this.experto_email = docente.correo;
    },
    filterFn (value) {
      if(value !== ""){
        axios
        .get('expertos/docente_filtros/'+value.toUpperCase())
        .then(response => {
          this.docentes_filtro=response.data;
        });
      }
    },
    clearExpertosForm(){
      this.experto_nombres='';
      this.experto_apellidos='';
      this.experto_formacion='';
      this.experto_cargo='';
      this.experto_institucion='';
      this.experto_pais='';
      this.experto_anios='';
      this.experto_email='';
    },

      //METODOS PARA EXPERTOS

      get_expertos(id_rubrica){
        let estado_temp = '';
        let prueba = '';
        this.rub_general.forEach(rub_gen => {
          if(rub_gen.id == id_rubrica){
            estado_temp = rub_gen.estado;
            prueba = "rubrica: " + rub_gen.nombre + ' id: ' + rub_gen.id;
          }
        });
        if(estado_temp == "COMPLETADA" || estado_temp == "EVALUACION"){
          axios
          .get('expertos/'+id_rubrica)
          .then(response29 => {
            this.expertos_list=response29.data;
            this.id_rubrica_actual=id_rubrica;
            this.docente_seleccionado=[];
            this.clearExpertosForm();
            this.fullHeight = true;
          });
        }else if(estado_temp == "EDICION"){
          alert("La Rubrica no está completada!");
        }else{
          alert("La Rubrica no se encuentra en estado para evaluación!")
        }

        
      },
      set_expertos(){
          if(this.experto_anios < 0){
            alert("Años de experiencia no pueden ser negativos");
          }else{
          let experto = {
            "nombres":this.experto_nombres,
            "apellidos":this.experto_apellidos,
            "formacion":this.experto_formacion,
            "cargo":this.experto_cargo,
            "institucion":this.experto_institucion,
            "pais":this.experto_pais,
            "anios":this.experto_anios,
            "email":this.experto_email,
            "id_rubrica":this.id_rubrica_actual,
            "estado":"AGREGADO"
          };

          axios
          .post('expertos/insertar',experto)
          .then(response30 => {
            this.get_expertos(this.id_rubrica_actual);
              this.clearExpertosForm();
          });
        }
      },
    



   filterFn_a (value) {
        if(value !== ""){
          
          value = value.toLowerCase();
          this.asignatura_filtro = this.total_asig.filter(asig => asig.nombre.toLowerCase().indexOf(value) !== -1);
          
        }
  },
    //METODO PARA OBTENER VALOR DE COOKIES
    getCookie(cName) {
      const name = cName + "=";
      const cDecoded = decodeURIComponent(document.cookie); //to be careful
      const cArr = cDecoded.split('; ');
      let res;
      cArr.forEach(val => {
        if (val.indexOf(name) === 0) res = val.substring(name.length);
      })
      return res
    },
    //METODO PARA CONTROLLAR INTERFACES 2021-11-04
    changeInterface(plantilla,plantilla_nombre){
      console.log("pantilla: ", plantilla, " nombre: ", plantilla_nombre);
      this.plantilla_name = plantilla_nombre;
      
      var interfaces = document.getElementsByClassName('interface');
      for (var i = 0; i < interfaces.length; i++) {
        $(interfaces[i]).hide();
      }

      $('#'+plantilla+'_interface').show();
      console.log(plantilla);
      
      switch(plantilla) {
        case 'rubrica':
          this.get_rubricas();
          this.get_campos();
          this.limpiar_campo();
          break;
        case 'rub_eval': 
          this.get_rubricas_expertos();
          this.limpiar_campo();
          break;
        case 'eva_estudiante':
          
          break;
        case 'homework':
          this.get_tareas_docente();
          this.limpiar_campo();

          break;
        case 'homework_e':
          //this.get_tareas_estudiante();
          this.get_materias_estudiante();
          this.limpiar_campo();
          

          break;
        case 'student_e':
          $("#tareas_tablas").show();
          $("#s_e_principal").show();
          $("#s_e_individual").hide();
          $("#tareas_estudiante").hide();
          this.limpiar_campo();
         // $("#rurbica_m").hide();
          if(this.getCookie('TOKEN_2') == 'ESTUDIANTE'){
            this.asig_eval_estudiantes();
          }
          if(this.getCookie('TOKEN_2') == 'DOCENTE'){
            this.asig_eval_docente();
          }
          break;
        case 'estadisticas_e':
          this.limpiar_campo();
          this.get_rubricas_evaluadas();
          $("#docentes_eva").hide();
          $("#metricas_eva").hide();
          //$("#tareas_doc").hide();
          $("#evaluacion_m").hide();
          $("#cvi_general").hide();
          $("#alfa_cron").hide();
          $("#satis_validez").hide();
          $("#v_aiken").hide();
          this.rubricas_eval = [];
          this.metricas_s = [];
          this.docentes_eval = [];
          console.log("estadísticas");
          break;
        case 'unesco_e':
          /* console.log("aqui es unesco"); */
          this.get_campos();
          $('#completo').hide();
          $('#solo_campo_').hide();
          
          break;
        default:
      }
    },
    //---------------------------------------------------------------
    get_rubricas(){//peticion para datos generales de rubricas
     // let id_docente = 1; // quemado hasta resolver lo de la sesion  
      axios
      .get('rub_general/'+this.getCookie("TOKEN_1"))
      .then(response25 => {
        this.rub_general=response25.data;
        this.rub_filtrado = this.rub_general;
        
        //this.model.sub = this.subdisciplina.find(el=>el.id==2);
      });
    },
    get_rubricas_expertos(){//peticion para datos generales de rubricas de expertos para evaluar
      //let id_docente = 1; // quemado hasta resolver lo de la sesion  
      axios
      .get('rub_general/experto/'+this.getCookie("TOKEN_4"))
      .then(response_4 => {
        //this.rub_general=response_4.data;
        //this.rub_filtrado = this.rub_general; 
       
        this.rub_general=response_4.data;
        let tmp = response_4.data;
        this.rub_filtrado = tmp; 
        //traer id_evaluacion

        
        //this.model.sub = this.subdisciplina.find(el=>el.id==2);
      });
    },
    get_asignaturas(){//peticion para materias de docente segun periodo
       axios.get('materias/'+this.campo_periodo[0].idperiodo+'/'+this.getCookie('TOKEN_1'))
        .then(response3 => {
          this.campo_asignatura = response3.data;
        })
    }, 
    //METODOS PARA SESION 
    sesion(){
      if(this.user.trim() == "" || this.password.trim() ==''){
        alert("Usuario y contraseña requeridos");
      }else{
        let datos = {
          'email': this.user,
          'password': this.password
        }
        axios
          .post('api/autenticar_p',datos)
          .then(response => {
            if(response.data.error == "Ok."){
              //let ok = response.data;
              this.id_pesonal_temp = response.data.id_personal;
              let ok = {
                'cedula': response.data.cedula,
                'id_personal': response.data.id_personal,
                'email': this.user,
                'nombres': response.data.nombres,
                'password': this.password,
                'rol': response.data.rol
              };
              axios 
              .post('api/registrar',ok)
              .then(response21 => {
                console.log("usuario: ", response21.data);
                document.cookie = "TOKEN_1="+response21.data.id_personal;
                document.cookie = "TOKEN_2="+response21.data.rol;
                document.cookie = "TOKEN_3="+response21.data.nombres;
                document.cookie = "TOKEN_4="+response21.data.email;
                console.log("cookies despues: ", document.cookie);
                location.href = window.location.href+'api/home';
                console.log("se ejecutó");
              });                   
            }else{
              
              //nuevo para autenticar expertos externos
              axios
              .post('api/autenticar/externos',datos)
              .then(response2 => {
                console.log("respuesta 1: ", response2.data);
                if(response2.data.length > 0){
                  this.id_pesonal_temp = response2.data[0].id;
                  let ok = {
                    'cedula': "externo",
                    'id_personal': this.id_pesonal_temp,
                    'email': this.user,
                    'nombres': response2.data[0].nombres,
                    'password': this.password,
                    'rol': response2.data[0].rol
                  };
                  axios 
                  .post('api/registrar',ok)
                  .then(response3 => {
                    console.log("response de registro: ", response3.data);
                    document.cookie = "TOKEN_1="+response2.data[0].id;
                    document.cookie = "TOKEN_2="+response2.data[0].rol;
                    document.cookie = "TOKEN_3="+response2.data[0].nombres;
                    document.cookie = "TOKEN_4="+response2.data[0].email;
                    location.href = window.location.href+'api/home';
                    /* axios
                    .get('api/home')
                    .then(response30 =>{
                      document.body.innerHTML = response30.data;
    
                    }) */
                  });                   

                  /* this.id_pesonal_temp = response2.data[0].id;
                  document.cookie = "TOKEN_1="+response2.data[0].id;
                  document.cookie = "TOKEN_2="+response2.data[0].rol;
                  document.cookie = "TOKEN_3="+response2.data[0].nombres;
                  document.cookie = "TOKEN_4="+response2.data[0].email;
                  location.href = window.location.href+'api/home';
 */
                }else{
                  alert("Autenticación Fallida");
                }

                
              })

              
            }

          });
        }
        
    },
    validar_sesion(){
      axios
      .get('api/validar/'+this.id_pesonal_temp)
      .then(response3 => {
        console.log("Respuesta de validacion: ", response3.data);
        console.log(response3.data);
      });
    },
    logout(){
      axios
      .delete('logout',)
      .then(response27 => {
        console.log("respuesta de salir: ", response27.data);
        document.cookie = "TOKEN_1=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/tesis/public";
        document.cookie = "TOKEN_2=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/tesis/public;";
        document.cookie = "TOKEN_3=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/tesis/public;";
        document.cookie = "TOKEN_4=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/tesis/public;";
        /* axios
        .get('http://localhost/sistema/public/')
        .then(response28 => {

        }) */
        location.href = window.location.href;
      });
    },

    //FIN DE METODOS PARA SESION 
        //--------------------------------------------
        
  

        //----------------------------------------------------------

    //METODOS PARA GESTION DE RUBRICA
    validacion_rubrica_completa(){
      //para validar que la rubrica este completa y cambiarla de estado
      //validar total porcentaje
      //multiplicar criterios por niveles y debe ser igual a la cantidad de descripcion niveles registrados
      
    },

    nueva_rubrica(){
      //validacion campos obligatorios llenos
      if(this.n_rub.trim() == "" || this.d_rub.trim() == ""  || this.s_asignatura == '' || this.s_campo == '' || this.s_disciplina == '' || this.s_subdisciplina == ''){
        alert("Todos los campos son obligatorios");
      }else{
        if(this.control == 0){
          this.fullHeightRubrica = true;
        }else if(this.control == 1){
          this.cargar_data_rubrica(this.id_rub_temp)
          this.fullHeightRubrica = true;
        }
        

      }

      
      
    },
    editar_item(){ //revisión completada, este metodo es funcional correcto
      console.log("entre a editar item: items temporales: ", this.item_criterio_temporal);
      for (let i = 0; i < this.item_criterio_temporal.length; i++) {
        if(this.item_criterio_temporal[i].id_i == this.item_tem_id){
          console.log("item: ", this.item_criterio_temporal[i].n_item, ' item ingresado: ', this.n_item);
          this.item_criterio_temporal[i].n_item = this.n_item;
          this.item_criterio_temporal[i].andamiaje = this.andamiaje_item;
          this.n_item = '';
          this.andamiaje_item = '';
          this.item_tem_id = '';
        }
      }
    },
    eliminar_item(){ // revisión completada, este metodo es funcional correcto
      if(this.item_tem_id != ''){
        for (let i = 0; i < this.item_criterio_temporal.length; i++) {
          if(this.item_criterio_temporal[i].id_i == this.item_tem_id){
            this.item_criterio_temporal.splice(i,1);
            this.n_item = '';
            this.andamiaje_item = '';
            this.item_tem_id = '';
            this.c_item = this.c_item - 1;
          }
        }
      }else{
        alert("Seleccione Item a eliminar");
      }
    },

    eliminar_nivel(nivel,valor){
      for(let i=0; i<this.t_niveles.length; i++){
        if(this.t_niveles[i].id_b == nivel){
          this.t_niveles.splice(i,1);
          this.c_niveles = this.c_niveles-1;
        }
      };
      for(let i = 0; i<this.c_niveles; i++){
        this.t_niveles[i].valor = this.c_niveles - i;
      };
      //eliminar los textos niveles en t_criterios
      for (let index = 0; index < this.t_criterios.texto_niveles.length; index++){
        if(this.t_criterios.texto_niveles[index].nivel == valor){
          this.t_criterios.texto_niveles.splice(index,1);
        }
      };
      //disminuir nivel en t_criterios
      for (let index = 0; index < this.t_criterios.texto_niveles.length; index++) {
        //console.log("entre a validacion: ", this.t_criterios.texto_niveles[index].nivel, " nivel: ", valor );
        if(this.t_criterios.texto_niveles[index].nivel > valor){
          //console.log("disminuir: ", index);
          this.t_criterios.texto_niveles[index].nivel = this.t_criterios.texto_niveles[index].nivel-1;
        }
        
      }
      //this.t_criterios.items.splice(index,1);
    },

    agregar_item(){ 
      if(this.n_item == '' || this.andamiaje_item == ""){
        this.alert = true;
      }else{
        //control de data
        let existe = this.existe_item_criterio(this.id_criterio, this.n_item);
        if(existe == 1){
          alert("ya existe este nombre de item para este criterio");
        }else{
          let id_i = this.generar_id_item();
          this.c_item = this.c_item + 1;
          let valor_item = {id_i:id_i, id_c: this.id_criterio, n_item: this.n_item, andamiaje: this.andamiaje_item, id_bd:0};
          this.item_criterio_temporal.push(valor_item);
          this.n_item = '';
          this.andamiaje_item = '';
        }
        
      }
    },
    guardar_item_criterio(){
      if(this.control_guardar_editar == 1){
        //console.log("entre a guardar nuevo")
        console.log("entre guardar como nuevo", this.control_guardar_editar);
  
        if(this.n_criterio == '' || this.n_porcentaje == '' || this.c_item == 0 || this.n_porcentaje <= 0){
          alert("Verifique que ha ingresado el nombre del criterio, porcentaje correcto, al menos debe tener un item agregado")
        }
        else{
          let existe = this.existe_criterio(this.n_criterio);
          let validacion = this.validar_porcentaje_criterio('nombre',1);
          if(existe == 1){
            alert("ya existe un criterio con este nombre");
          }else if(validacion == 1 || this.n_porcentaje > 100){
            alert("El valor total del porcentaje para esta rubrica es superior al 100%");
            
          }else{
            let criterio = {id_c: this.id_criterio, nombre: this.n_criterio, porcentaje: this.n_porcentaje , c_item: this.c_item, model: false, id_bd:0};
            this.t_criterios.criterio.push(criterio);
            this.item_criterio_temporal.forEach(element => {
              this.t_criterios.items.push(element);
            });
            //setear a cero las variables
            this.n_criterio = '';
            this.n_porcentaje = '';
  
            this.c_item = 0;
            this.vaciar_array_temporal(this.item_criterio_temporal);
            this.id_criterio = 0;
            this.persistent = false; 
            //this.control_guardar_editar = 1;
          }
        }
      }else if(this.control_guardar_editar == 2){  
          this.actualzar_criterio();
      }
    },
    vaciar_modal_criterio(){
      //proceso para vaciar campos y arrays 
      this.n_criterio = '';
      this.n_porcentaje = '';
      this.vaciar_array_temporal(this.item_criterio_temporal);
      this.n_item = '';
      this.andamiaje_item = '';
      this.id_criterio = 0;
      this.persistent= false;
      this.control_guardar_editar = 1;
      console.log("guardar editar: ", this.control_guardar_editar);
    },
    modificar_texto_nivel(nivel){ // esta funcion es parte para cambiar el texto del nivel
      //console.log("estoy aqui en ");
      this.t_niveles.forEach(element => {
        if(element.id_b == nivel){
          this.n_nivel_act = element.texto;
          this.id_b_actual = nivel
        }
      });
      this.prompt = true;
    },
    guardar_texto_nivel_cabecera(){ // este método guarda el nuevo texto modificado en el array de t_niveles
      //console.log("aqui es");
      this.t_niveles.forEach(element => {
        if(element.id_b == this.id_b_actual){
          element.texto =  this.n_nivel_act;
        }
      });
      this.prompt = false;
      this.n_nivel_act = '';
      this.id_b_actual = '';
    },
    columna_nivel (){ //añade un nuevo nivel 
      this.sumar_niveles ();
      let contador = 0;
      this.c_niveles = this.c_niveles +1;
      //actualizar niveles en array de crtierios
      for (let index = 0; index < this.t_criterios.texto_niveles.length; index++) {
        this.t_criterios.texto_niveles[index].nivel = this.t_criterios.texto_niveles[index].nivel+1;
      }
    },
    editar_andamiaje() {
      this.persistent3=true;
    },
    fila_criterio (control) {
      if(control == 0){
        //caso para editar criterio existente
      }else{
        //caso para añadir nuevo criterio
        this.persistent = true;
        this.c_criterios=this.c_criterios+1;
        this.id_criterio = this.generar_id_criterio();
      /*  let div_criterio = document.getElementById("criterios");
        div_criterio.style.display = "block";
        let div_rubrica = document.getElementById("rubrica");
        div_rubrica.style.display = "none"; */
      }
    },
    generar_id_criterio(){
      this.criterio_id = this.criterio_id + 1;
      let id = this.criterio_id;
      return id;
    },
    vaciar_array_temporal(array){//metodo para limpiar array temporales
      for (let i = array.length; i > 0; i--) {
        array.pop();
      }
    },
    salir_texto_nivel(){
      this.valor_actual = 0;
      this.id_criterio = 0;
      this.t_nivel_criterio_temp = '';
      this.persistent2 = false; 
    },
    guardar_texto_nivel(){
      
      if(this.t_nivel_criterio_temp == ''){
        alert("LLene el campo correspondiente al texto del nivel de este criterio");
      }else{
        //console.log("aqui entre aesta funcion");
        let cont = 0;
        let items_no = [];
        //validacion para verificar que ha nombrado todos los items
        const items = this.t_criterios.items.filter(x => x.id_c == this.id_criterio);
        items.forEach(element => {
          let posicion = this.t_nivel_criterio_temp.toUpperCase().indexOf(element.n_item.toUpperCase());
          if(posicion !== -1){

          }else{
          // console.log("este item no esta nombrado");
            cont= cont + 1 ;
            items_no.push(element.n_item);
          }
        });
        this.no_items = items_no;
      if(this.t_criterios.texto_niveles.length == 0){
        if(cont > 0){
          this.alert3 = true;
          this.validador = 1;
        }else if(cont == 0){
          this.guardar_confirmacion_texto_niveles(1);
        }
      }else{
        if(cont > 0){
          this.validador = 2;
          this.alert3 = true;
        }else if(cont == 0){
          this.guardar_confirmacion_texto_niveles(2);
        }
      }
      //this.salir_texto_nivel();
    }
    },
    existe_item_criterio(id_c, n_item){ // método para validar si ya existe n_item dentro del criterio
      let existe = 0;
      this.item_criterio_temporal.forEach(element => {
        if(element.id_c == id_c && element.n_item == n_item){
          existe = 1;
        }
      });
      return existe;
    },
    generar_id_item(){
      this.item_id = this.item_id + 1;
      let id = this.item_id;
      return id;
    },
    generar_id_btn(){
      this.b_id = this.b_id + 1;
      let n = this.b_id.toString();
      let id = 'b'+ n;
      return id;
    },
    seleccionar_item(id_item){
      this.item_criterio_temporal.forEach(element => {
        if(element.id_i == id_item){
          this.n_item = element.n_item;
          this.andamiaje_item = element.andamiaje;
          this.item_tem_id = id_item;
        }   
      });
    },
    sumar_niveles () {
      for(let nivel of this.t_niveles){
          nivel.valor = nivel.valor+1;
      }
      this.t_niveles.push({texto: 'Descripción Nivel', valor: 1,id_b: this.generar_id_btn(), id:0, id_r:0});
    },

    guardar_rubrica_bd(){//metodo para guardar rubrica en bd
      //variables necesarias
      let niveles = [];
      let criterios =[];
      let id_rubrica = 0;
      const rubrica_criterios =[];
      const rubrica_niveles =[];
      const descripcion_niveles = [];
      const items_criterios = [];
      let asignaturas_temp = [];
      //preparar la data
      
      //validacion de estado
        //validacion de porcentaje
        let total = 0;
        let estado_d = 'EDICION';
        this.t_criterios.criterio.forEach(crit => {
          total = total + parseInt(crit.porcentaje);
        });
        if(total != 100){
          console.log("aún está en edición: ", total);
          estado_d = "EDICION";
        }else{
          console.log("esta completada: ", total);
          let cant_niv = this.t_niveles.length;
          let cant_cri = this.t_criterios.criterio.length;
          let cant_mul = cant_niv * cant_cri;
          if(this.t_criterios.texto_niveles.length == cant_mul && cant_cri >= 4){
            estado_d = "COMPLETADA";
          }else{
            estado_d = "EDICION";
            console.log("antes de:");
            this.crit_4= true;
            console.log("despues de:");
          }
          
        }


      const array_rubrica = {
        "id_asignatura" : this.s_asignatura.idmateria,
        "id_docente" : this.getCookie("TOKEN_1"),
        "nombre" : this.n_rubrica,
        "descripcion" : this.d_rubrica,
        "id_campo": this.s_campo.id,
        "id_disciplina": this.s_disciplina.id,
        "id_subdisciplina": this.s_subdisciplina.id,
        "estado": estado_d
      };    
      console.log("array pasado a rubrica: ", array_rubrica);
      //peticion primero para guardar asignatura en tabla interna
      asignaturas_temp = [
        {
          "id": this.s_asignatura.idmateria,
          "id_subdisciplina": 1,
          "nombre": this.s_asignatura.nombre,
          "estado": "A"
        }
      ] ;
      axios
      .put('asignatura',asignaturas_temp )
      .then(response_a =>{
        //console.log("se guardó asignatura?: ", response_a.data);
        axios
        .post('rubrica',array_rubrica)// ejemplo para update pasar id_rubrica
        .then(response => {
        //console.log("response: ", response.data);
        id_rubrica = response.data;
        //para tabla de niveles por rubrica
        this.t_niveles.forEach(element => {
          let temp2 = {
            "id_rubrica":id_rubrica,
            "valoracion":element.valor,
            "nombre":element.texto
          }
          rubrica_niveles.push(temp2);
        })
        axios
        .post('niveles/multiple',rubrica_niveles)
        .then(response2=>{
          niveles = response2.data;
          this.t_criterios.criterio.forEach(element => {
            //console.log("hola2");
            let temp ={
              "id_rubrica":id_rubrica,
              "nombre":element.nombre,
              "porcentaje":element.porcentaje
            };
            //console.log("temporal de criterior par enviar: ", temp);
            rubrica_criterios.push(temp);
          });
          axios
            .post('criterio/multiple',rubrica_criterios)
            .then(response3=>{
              //console.log("response de criterios: ", response3.data);
              criterios= response3.data;
              //console.log("criterios: ", criterios);
              //console.log("hola3");
              this.persistent4 = false;
  
                      
            //para la parte de descripciones en niveles por criterio y nivel         
            let cont = 0;
            let longitud = niveles.length;
            //console.log("criterios despues: ", criterios);
            this.t_criterios.criterio.forEach(element_c => {
              //console.log("hola4");
              this.t_criterios.texto_niveles.forEach(element_n => {
                if(element_n.id_c == element_c.id_c){
                  let temp2 ={
                    "id_criterio": criterios[cont],
                    "id_nivel": niveles[(longitud-1)-(element_n.nivel-1)],
                    "descripcion":element_n.texto
                  };
                  //console.log("temporal de descripciones: ", temp2);
                  descripcion_niveles.push(temp2);
                  
                }
              });
              cont=cont+1;
            });
            
            
            axios
            .post('descripciones/multiple',descripcion_niveles)
            .then(response4 => {
              //console.log("response de descripciones: ", response4.data);
              //criterios= response.data;
              let cont2 = 0;
              //parte de items por criterios
              this.t_criterios.criterio.forEach(element_c => {
                this.t_criterios.items.forEach(element_i =>{
                  if(element_i.id_c == element_c.id_c){
                    let temp3 ={
                      "id_criterio":criterios[cont2],
                      "nombre":element_i.n_item,
                      "andamiaje":element_i.andamiaje
                    }
                    items_criterios.push(temp3);
                  }
                  
                })
                
                cont2=cont2+1;
              });
              axios
            .post('items/multiple',items_criterios)
            .then(response5 =>{
              
              console.log("rubrica despues de guardar: ", id_rubrica);
              this.id_rub_temp = id_rubrica;
              this.get_rubricas();
              this.limpiar_rubrica(); 
              //this.cargar_data_rubrica(id_rubrica);
              
              //validacion de porcentaje
            /*   let total = 0;
              this.t_criterios.criterio.forEach(crit => {
                total = total + parseInt(crit.porcentaje);
              });
              if(total != 100){
                console.log("aún está en edición: ");
              }else{
                console.log("esta completada");
              } */
              
              
              

            })
            
            
            this.fullHeightRubrica = false;
            //this.cargar_data_combos();
            })
            })
        })       
        });//fin del response de rubrica
      })  
        
      //this.limpiar_rubrica(); -- cometado para probar si es por esto el error

    },//aqui termina la funcion de guardar

    limpiar_rubrica(){
      this.t_criterios.criterio = [];
      this.t_criterios.texto_niveles = [];
      this.t_criterios.items = [];
      this.n_rub = '';
      this.d_rub = '';
      this.s_periodo = '';
      this.s_asignatura = '';
      this.t_niveles = [
      {texto: 'Totalmente Adecuado', valor: 4/*, id_v: 'v1' , estado: 1 , id:'a1'*/, id_b: 'b1'/* , niv1:false */},
      {texto: 'Bastante Adecuado', valor: 3/*, id_v: 'v2' , estado: 1 , id:'a2'*/, id_b:  'b2'/* , niv1:false  */},
      {texto: 'Adecuado', valor: 2/*, id_v: 'v3' , estado: 1 , id:'a3'*/, id_b: 'b3'/* , niv1:false */},
      {texto: 'Nada Adecuado', valor: 1/*, id_v: 'v4' , estado: 1 , id:'a4'*/, id_b: 'b4'/* , niv1:false */}
      ]
      this.n_rubrica = '';
      this.d_rubrica = '';
      this.control = 0;
      this.s_campo='';
      this.campos_u=[];
      this.s_disciplina='';
      this.disciplinas_u=[];
      this.s_subdisciplina='';
      this.subdisciplinas_u=[];
      this.get_campos();
    },

    actualizar_rubrica_bd(){
      console.log("nueva forma de actualizacion en caso de que la rubrica este en construccion");
      axios
      .delete('rubrica/'+this.id_rub_temp)
      .then(response9 => {
        console.log("Rubrica eliminada?: ",response9.data );
        this.guardar_rubrica_bd();
      });
    },
    existe_criterio(n_c){// metodo para validar si existe un criterio con el mismo nombre
      let existe = 0;
      this.t_criterios.criterio.forEach(element => {
        if(element.nombre == n_c){
          existe = 1;
        }
      });
      return existe;
    },
    validar_porcentaje_criterio(id_c, val){// metodo para validar el maximo del porcentaje como 100%
      let validacion = 0;
      if(val== 2){
        let por_total = this.n_porcentaje;
        console.log("por total actualizacion: ", por_total);
        this.t_criterios.criterio.forEach(element => {
          if(element.id_c != this.id_criterio){
            console.log("element idc: ", element.id_c, " recibido: ", id_c, " this: ", this.id_criterio);
            por_total = parseInt(por_total) + parseInt(element.porcentaje);
          }  
      });
      console.log("por total des actualizacion: ", por_total);
      if(por_total > 100){
        validacion = 1;
      }
        
      }else if(val == 1){
      validacion = 0;
      let por_total = this.n_porcentaje;
      console.log("por total: ", por_total);
      this.t_criterios.criterio.forEach(element => {
          por_total = parseInt(por_total) + parseInt(element.porcentaje);
      });
      console.log("por total des: ", por_total);
      if(por_total > 100){
        validacion = 1;
      }
    }
      return validacion;
    },

    editar_criterio(index){//metodo para editar informacion de criterios
      console.log("entre a editar criterio")
      this.id_criterio = this.t_criterios.criterio[index].id_c;
      this.porcentaje_temp = this.t_criterios.criterio[index].porcentaje;
      this.control_guardar_editar = 2;        
      this.n_criterio = this.t_criterios.criterio[index].nombre;
      this.n_porcentaje = this.t_criterios.criterio[index].porcentaje;
      this.c_item = this.t_criterios.criterio[index].c_item;
      this.persistent = true;
      //agregar al array temporal de items los items del criterio seleccionado        
      for(let i = 0 ; i<this.t_criterios.items.length; i++){
        if (this.t_criterios.items[i].id_c == this.t_criterios.criterio[index].id_c) {
          let valor = {
            id_i: this.t_criterios.items[i].id_i,
            id_c: this.t_criterios.items[i].id_c, 
            n_item: this.t_criterios.items[i].n_item, 
            andamiaje: this.t_criterios.items[i].andamiaje
          };
          this.item_criterio_temporal.push(valor);
        }  
      }
    },
    actualzar_criterio(){//este metodo actualiza un criterio sin los textos que corresponden a cada nivel
      let nombre = this.n_criterio;
      let porc = this.n_porcentaje;
      let c_i = this.c_item;
      console.log("entre a actualizar criterio: control: ", this.control_guardar_editar);
  
      if(this.n_criterio == '' || this.n_porcentaje == '' || this.c_item == 0){
        alert("Verifique que ha ingresado el nombre del criterio, porcentaje, al menos debe tener un item agregado")
      }else{
                  //actualizacion parte criterio 
          let id_temp = '';
          this.t_criterios.criterio.forEach(element => {
            if(element.nombre != nombre){
              id_temp = element.id_c;
            }  
        });    
        let validacion = this.validar_porcentaje_criterio(id_temp,2);
        if (validacion == 1){
          alert("El valor total del porcentaje para esta rubrica es superior al 100%");
          this.control_guardar_editar = 2;
  
  
  
        }else{
          for (let i = 0; i < this.t_criterios.criterio.length; i++) {
            if(this.t_criterios.criterio[i].id_c == this.id_criterio){
              this.t_criterios.criterio[i].nombre = nombre;
              this.t_criterios.criterio[i].porcentaje = porc;
              this.t_criterios.criterio[i].c_item = c_i;
  
            }
          }
          var cont = 0;
          const item_t = this.t_criterios.items;
          const items_temp = this.t_criterios.items.filter(x => x.id_c != this.id_criterio);
          //console.log("con filter: ", items_temp);
          this.t_criterios.items=[];
          this.t_criterios.items = items_temp;
  
        //agregar nuevamente los items actualizados
        for (let index = 0; index < this.item_criterio_temporal.length; index++) {
          //console.log("index: ",index);
          let array = this.item_criterio_temporal[index];
          this.t_criterios.items.push(array);
          
        }
        //vaciar
            this.n_criterio = '';
            this.n_porcentaje = '';
            this.c_item = 0;
            this.vaciar_array_temporal(this.item_criterio_temporal);
            this.id_criterio = 0;
            this.persistent = false; 
      }
    }
    this.control_guardar_editar = 1;
    },
    editar_nivel_criterio_v(id_c, valor){
      this.valor_actual = valor;
      this.id_criterio = id_c;
      
      for (let index = 0; index < this.t_criterios.texto_niveles.length; index++) {
        if(this.t_criterios.texto_niveles[index].id_c == this.id_criterio && this.t_criterios.texto_niveles[index].nivel == this.valor_actual){
          let texto = this.t_criterios.texto_niveles[index].texto;
          this.t_nivel_criterio_temp_v = texto;
        }else{
        }
      }
      this.persistent2_v = true; 
  
    },
    editar_nivel_criterio(id_c, valor){
      this.valor_actual = valor;
      this.id_criterio = id_c;
      
      for (let index = 0; index < this.t_criterios.texto_niveles.length; index++) {
        if(this.t_criterios.texto_niveles[index].id_c == this.id_criterio && this.t_criterios.texto_niveles[index].nivel == this.valor_actual){
          let texto = this.t_criterios.texto_niveles[index].texto;
          this.t_nivel_criterio_temp = texto;
        }else{
        }
      }
      this.persistent2 = true; 
  
    },
    eliminar_criterio(id_c){
      for (let index = 0; index < this.t_criterios.criterio.length; index++) {
        if(this.t_criterios.criterio[index].id_c == id_c){
          this.t_criterios.criterio.splice(index,1);
        }
      };
      for (let index = 0; index < this.t_criterios.items.length; index++) {
        if(this.t_criterios.items[index].id_c == id_c){
          this.t_criterios.items.splice(index,1);
        }
      };
      for (let index = 0; index < this.t_criterios.texto_niveles.length; index++) {
        if(this.t_criterios.texto_niveles[index].id_c == id_c){
          this.t_criterios.texto_niveles.splice(index,1);
        }
      };
    },
    guardar_confirmacion_texto_niveles(val){
      if(val == 1){
        let temp = this.t_nivel_criterio_temp;
        let temp2 = this.id_criterio;
        let temp3 = this.valor_actual;
        let nivel_texto = {id_c: temp2, nivel: temp3, texto: temp, id_bd:0};
        this.t_criterios.texto_niveles.push(nivel_texto);
        this.alert3 = false;
      }else if(val== 2){
        let validacion = 0;
        let i = 0;
  
        for (let index = 0; index < this.t_criterios.texto_niveles.length; index++) {
          if(this.t_criterios.texto_niveles[index].id_c == this.id_criterio && this.t_criterios.texto_niveles[index].nivel == this.valor_actual){
            validacion = 1;
            i = index; 
          }
        };
        if(validacion == 1){
          let temp = this.t_nivel_criterio_temp;
          this.t_criterios.texto_niveles[i].texto = temp;
        }else if(validacion == 0){
          let temp = this.t_nivel_criterio_temp;
            let temp2 = this.id_criterio;
            let temp3 = this.valor_actual;
            let nivel_texto = {id_c: temp2, nivel: temp3, texto: temp, id_bd:0};
            this.t_criterios.texto_niveles.push(nivel_texto);
        }
        this.alert3 = false;
        
      }
      this.salir_texto_nivel();
      this.validador= 1;
      this.no_items = []; 
    },
    mostrar_rubrica_completa(rubrica){
      console.log("rubrica a mostrar: ", rubrica);
      this.cargar_data_rubrica(rubrica.id);
      this.n_rub_visual = rubrica.nombre;
      this.fullHeightRubrica2 = true;
    },
    mostrar_rubrica_completa2(id_rubrica){
      this.cargar_data_rubrica(id_rubrica);
      //this.n_rub_visual = rubrica.nombre;
      //this.fullHeightRubrica3 = true;
    },
    criterios_niveles_evaluacion(id_rubrica)
    {
      axios
      .get('criterio/'+id_rubrica)
      .then(response2 => {
        //console.log("data de criterios de rubrica: ", response2.data);
        //this.model.cam = this.campo.find(el=>el.id==1);
        this.t_criterios.criterio = [];
        for (let i = 0; i< response2.data.length; i++) {
          let temp = {};
            temp = {id_c:response2.data[i].id, nombre:response2.data[i].nombre,porcentaje:response2.data[i].porcentaje,c_item:0,model:false,id_bd:response2.data[i].id};
            this.t_criterios.criterio.push(temp);
        };
        this.t_criterios.criterio.forEach(element_c => {
              let temp4 = {
                'id': element_c.id_c,
                'nombre': element_c.nombre
              }
              this.homework_items.push(temp4);
        });

        axios
        .get('niveles/'+id_rubrica)
        .then(response7 => {
         // console.log("data de niveles de rubrica: ", response7.data);
          //this.model.cam = this.campo.find(el=>el.id==1);
          this.t_niveles = [];
          let cont = 0;
          response7.data.forEach(element7 =>{
           // console.log("element7: ", element7.id);
            let id_b = "b"+(cont+1);
            let temp = {};
            let id = element7.id;
            //console.log("id del nivel tomado: ", id)
            temp = {
              id:id
              ,id_r:element7.id_rubrica
              ,texto:element7.nombre
              ,valor:element7.valoracion
              ,id_b:id_b
            };
              this.t_niveles.push(temp);
              //console.log("t_nevieles despues de guardarlo: ", this.t_niveles);
              cont= cont+1;

          });this.c_niveles = cont;
          console.log("niveles: ", this.c_niveles);
        });  

      });

    },
    mostrar_rubrica(rub){
      this.control = 1;
        //validacion de estado de la rubrica
        if(rub.estado == "EVALUACION" || rub.estado == "EN USO"){
          alert("No se puede editar Rúbrica en estado de evaluación o en uso");
        }else{
        
          this.n_rub = rub.nombre;
          this.d_rub = rub.descripcion;
          //this.d_rubrica = rub.descripcion;
          var nombre_asig = '';
          this.total_asig.forEach(element => {
            if(element.idmateria == rub.asignatura){
              nombre_asig = element.nombre;
            }
          });
          this.s_asignatura = 
            {
              "docente": this.getCookie('TOKEN_3'),
              "id_docente": this.getCookie('TOKEN_1'),
              "nombre": nombre_asig,
              "idmateria": rub.asignatura
            };
          
          
          this.id_rub_temp = rub.id;
          //this.cargar_data_rubrica(rub.id)
          //this.fullHeightRubrica = true;

          // para la parte nueva de UNESCO
          //llenar los v-model
          this.campos_u.forEach(camp => {
            if(camp.id == rub.id_campo){
              this.s_campo = {
                "id": rub.id_campo,
                "nombre": camp.nombre
              }
            }
          });
          axios.get('get_disciplinas_u/'+this.s_campo.id)
           .then(dis => {
            this.disciplinas_u = dis.data;
            this.disciplinas_u.forEach(dis => {
              if(dis.id == rub.id_disciplina){
                this.s_disciplina = {
                  "id": dis.id,
                  "nombre": dis.nombre
                }
              }
            });
            axios.get('get_subdisciplinas_u/'+this.s_disciplina.id)
              .then(sub => {
                this.subdisciplinas_u = sub.data;
                this.subdisciplinas_u.forEach(sdis => {
                  if(sdis.id == rub.id_subdisciplina){
                    this.s_subdisciplina = {
                      "id": sdis.id,
                      "nombre": sdis.nombre
                    }
                  }
                });
                
              })
            
           })

          

        //}
        }
    },
    validacion_salir_edicion_rubrica(){
      if(this.t_criterios.criterio.length > 0 && this.t_criterios.items.length > 0){
        //console.log("entre a validacion");
        this.alert4 = true;
      }else{
        this.salir_edicion_rubrica();
      }
    },
    salir_edicion_rubrica(){
      //limpiar rubrica
      this.limpiar_rubrica();
      //cerrar_modal
      this.fullHeightRubrica = false;
      this.alert4 = false;
    },
    cargar_data_rubrica(id_rubrica){
      this.alert4= false;
      //console.log("rubrica seleccionada: ",this.model.rub.id);
      //trae data y llenar varibales
  
      axios
      .get('criterio/'+id_rubrica)
      .then(response2 => {
        //console.log("data de criterios de rubrica: ", response2.data);
        //this.model.cam = this.campo.find(el=>el.id==1);
        this.t_criterios.criterio = [];
        for (let i = 0; i< response2.data.length; i++) {
          //let id_b = "b"+(i+1);
          let temp = {};
            temp = {id_c:response2.data[i].id, nombre:response2.data[i].nombre,porcentaje:response2.data[i].porcentaje,c_item:0,model:false,id_bd:response2.data[i].id};
            this.t_criterios.criterio.push(temp);
        };
        let items_criterios2 = [];
        this.t_criterios.items = [];
        this.t_criterios.criterio.forEach(element_c => {
         // console.log("estoy aqui");
              let temp3 ={
                "id_criterio":element_c.id_c,
                "nombre":element_c.nombre
              }
              items_criterios2.push(temp3);
              /* let temp4 = {
                'id': element_c.id_c,
                'nombre': element_c.nombre
              }
              this.homework_items.push(temp4); */
        });
     // console.log("enviando: ", items_criterios2.length);
      axios
      .post('items/multiple/show',items_criterios2)
      .then(response3 => {
       // console.log("data de items de criterios: ", response3.data);
        //this.model.cam = this.campo.find(el=>el.id==1);
      
        response3.data.forEach(element2 => {
         // console.log("elemento: ",element2);
          let temp3  = [];
          temp3 = {
            id_i:element2.id, 
            id_c:element2.id_criterio, 
            n_item:element2.nombre,
            andamiaje:element2.andamiaje,
            id_bd:element2.id
          };
          this.t_criterios.items.push(temp3);
        }); 
        }); 
        this.t_criterios.texto_niveles = [];
        //PETICION A NIVELES
        axios
        .get('niveles/'+id_rubrica)
        .then(response7 => {
         // console.log("data de niveles de rubrica: ", response7.data);
          //this.model.cam = this.campo.find(el=>el.id==1);
          this.t_niveles = [];
          let cont = 0;
          response7.data.forEach(element7 =>{
           // console.log("element7: ", element7.id);
            let id_b = "b"+(cont+1);
            let temp = {};
            let id = element7.id;
            //console.log("id del nivel tomado: ", id)
            temp = {
              id:id
              ,id_r:element7.id_rubrica
              ,texto:element7.nombre
              ,valor:element7.valoracion
              ,id_b:id_b
            };
              this.t_niveles.push(temp);
              //console.log("t_nevieles despues de guardarlo: ", this.t_niveles);
              cont= cont+1;

          });this.c_niveles = cont;
          console.log("niveles: ", this.c_niveles);
  
          //PETICIONA DESCRIPCIONES
       
        axios
        .post('descripciones/multiple/show',items_criterios2)
        .then(response4 => {
        //console.log("data de descripciones de criterios: ", response4.data);
        //this.model.cam = this.campo.find(el=>el.id==1);
      
        response4.data.forEach(element3 => {
          let nivel_temp = 0;
         // console.log("hola de nuevo: ", element3);
          //const niveles_temp = this.t_niveles;
          this.t_niveles.forEach(element5 =>{
            //console.log("elemento 5: ", element5);
            //console.log("elemento 3: ", element3);
            if(element5.id == element3.id_nivel){
              nivel_temp = element5.valor;
            }
          })
          //console.log("elemento: ",element2);
          //let nivel_texto = {id_c: temp2, nivel: temp3, texto: temp, id_bd:0};
          let temp4  = [];
          temp4 = {
            id_c:element3.id_criterio, 
            nivel:nivel_temp, //cambiar por el valor del nivel y no el id nivel 
            texto:element3.descripcion,
            id_bd:element3.id
          };
          //console.log("temp4: ", temp4);
          this.t_criterios.texto_niveles.push(temp4); 
  
          //Actualizacion de cantidad de items por criterio
          this.t_criterios.criterio.forEach(element8 => {
            let cant = 0;
            this.t_criterios.items.forEach(items => {
              if(items.id_c == element8.id_c ){
                cant = cant+1;
              }
              element8.c_item = cant;
            })
            
          })
          //actualizacion del porcentaje total de rubrica
  
  
        });
        }); 
  
        }); 
  
        
  
  
  
      }); 
  
  
    },

    actualizar_bd(){
      console.log("aqui guardo a la base de datos toda la informacion");
      //validar si es actualización o es nueva rubrica
      if(this.id_rub_temp != null){
        console.log("actualizacion de rubrica");
        this.d_rubrica=this.d_rub;
        this.n_rubrica=this.n_rub;
        this.actualizar_rubrica_bd();
        //this.persistent5 = true;
      }

      //caso nueva rubrica
        //validar que los combos de clasificacion esten llenos especificamente el de materia
        /* if(this.s_asignatura != null){
          //console.log("validado aui 1");
          if(this.t_criterios.criterio.length == 0 || this.t_criterios.items.length == 0){
            alert("Para guardar la Rúbrica debe tener al menos 1 criterio con 1 item ingresado");
            //validar que exista al menos 1 criterio con 1 item 
          }else if(this.t_criterios.criterio.length > 0 && this.t_criterios.items.length > 0){
            
            //abrir modal para ingresar nombre y descripcion de la rubrica
            //this.persistent4 = true; 
            //la accion de guardar se ejecuta en el boton guardar  del modal
            //luego de guardar se limpia todo la visual y se debe volver a cargar las rubricas para que aparezca la nueva y pueda ser seleccionada
          }
        }else if(this.s_asignatura == null){
          alert("Selecciones los campos de clasificación requeridos para la rúbrica");
        } */
        
        //abrir modal para ingresar nombre a la rubrica y descripcion
    },

        //---FIN DE METODOS DE GESTION DE RUBRICA
  },
  })