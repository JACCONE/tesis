const configComponent = Vue.component('config',{
template:`
<div>
<span>prueba</span>
</div>
`
});

const app = new Vue({
  el: '#app',
  beforeMount() {
    //console.log("before mounted");
    this.cargar_data_combos();
   
  },
  mounted() {
    console.log("mounted");
  },
  data: function () {
    return {
      usuario: 'Jorge', //variable temporal para guardar el usuario activo en la aplicación
      c_niveles: 4, // utilizada en metodos para controlar y cambiar el campo valor de los niveles
      c_criterios: 0, // validar si se va a usar
      c_item: 0, //temporal para cantidad de item por criterio, al guardar criterio debe volver a cero
      id_criterio: 0, //temporal para id criterio generado, al guardar criterio debe ser '' nuevamente
      criterio_id: 0, // para generar id de criterios
      item_id: 0, // para generar id de items

      control_guardar_editar: 1, // 1 para guardar, 2 para editar criterio
      t_niveles :[ // niveles de l cabecera de la rubrica
          {texto: 'Totalmente Adecuado', valor: 4, id_b: 'b1', id:0, id_r:0},
          {texto: 'Bastante Adecuado', valor: 3, id_b:  'b2', id:0, id_r:0},
          {texto: 'Adecuado', valor: 2, id_b: 'b3', id:0, id_r:0},
          {texto: 'Nada Adecuado', valor: 1, id_b: 'b4',id:0, id_r:0}
      ],
      //objeto par datos generales de rubrica
      /*rubrica_g:{
        //id:1
        id_asignatura:2,
        id_docente:10,
        nombre:'Rubrica10',
        descripcion:'prueba de descripcion 10',
        estado:'A'
      },*/
      t_criterios:{ //este array maneja toda la informacion referente a los criterios en la matriz
        criterio : [],
        items : [],
        texto_niveles : [/*{id_c: 'cri1', nivel: 4, texto: "el ldsmsldalskd lkamdlaskd"} */]
      },
      item_criterio_temporal : [
      ],
            //todos los valores de id generados se deben actualizar al iniciar la aplicacion con el último valor de extraido de la base     
      n_nivel_act: '',//esta variable es para manejar el nombre actual del texto del nivel a modificar
      id_b_actual: '',//esta variable es para manejar el id_b actual modificado del nivel 
      b_id: 4, // para generar id de botones eliminar
      item_tem_id: '', // usado para eliminar o actualizar items    
      currentTab: 'inicio', 
      model : {cam:null,dis:null, sub:null, mat:null, rub: null},// validado para model de select
      hab : {cam:false,dis:true, sub:true, mat:true, rub: false},// validado para habilitar select
      combos:{// para recibir los datos de bd
        campo :[],
        disciplina : [],
        subdisciplina : [],
        materia : [],
        rubrica : []
      },
      campo :[],
      disciplina : [],
      subdisciplina : [],
      materia : [],
      rubrica : [],
      expanded: true,
      fab1: false,
      conf_item: false,
      persistent: false,
      persistent2:false,
      persistent3:false,
      persistent4:false,
      persistent5:false,
      n_rubrica:'',
      d_rubrica:'',
      n_criterio: '', //temporal para nombre del criterio
      n_porcentaje: '', //temporal para porcentaje de criterio
      andamiaje_item: '', //temporal para andamiaje por item
      valor_actual: 0, //temporal para saber el nivel actual que contiene el texto modificado
      n_item: '',
      t_nivel_criterio_temp: '',//temporal para el texto del nivel por criterio
      alert: false,
      t_alert_1: 'Campos Nombre Item y Andamiaje son obligatorios',
      prompt: false,
      alert3: false,
      alert4:false,
      validador: 1,
      no_items: [] //array para nombres de items no nombrados en texto niveles antes de guardar
           
    }
  },
  methods: {
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
    }
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
  sumar_niveles () {
    for(let nivel of this.t_niveles){
        nivel.valor = nivel.valor+1;
    }
    this.t_niveles.push({texto: 'Descripción Nivel', valor: 1,id_b: this.generar_id_btn(), id:0, id_r:0});
  },
  generar_id_btn(){// validado
    this.b_id = this.b_id + 1;
    let n = this.b_id.toString();
    let id = 'b'+ n;
    return id;
  },
  generar_id_criterio(){
    this.criterio_id = this.criterio_id + 1;
    let id = this.criterio_id;
    return id;
  },
  generar_id_item(){
    this.item_id = this.item_id + 1;
    let id = this.item_id;
    return id;
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
  seleccionar_item(id_item){
    this.item_criterio_temporal.forEach(element => {
      if(element.id_i == id_item){
        this.n_item = element.n_item;
        this.andamiaje_item = element.andamiaje;
        this.item_tem_id = id_item;
      }   
    });
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
  editar_item(){ //revisión completada, este metodo es funcional correcto
    for (let i = 0; i < this.item_criterio_temporal.length; i++) {
      if(this.item_criterio_temporal[i].id_i = this.item_tem_id){
        this.item_criterio_temporal[i].n_item = this.n_item;
        this.item_criterio_temporal[i].andamiaje = this.andamiaje_item;
        this.n_item = '';
        this.andamiaje_item = '';
        this.item_tem_id = '';
      }
    }
  },
  guardar_item_criterio(){
    if(this.control_guardar_editar == 1){
      //console.log("entre a guardar nuevo")
      if(this.n_criterio == '' || this.n_porcentaje == '' || this.c_item == 0){
        alert("Verifique que ha ingresado el nombre del criterio, porcentaje, al menos debe tener un item agregado")
      }
      else{
        let existe = this.existe_criterio(this.n_criterio);
        let validacion = this.validar_porcentaje_criterio();
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
  editar_criterio(index){//metodo para editar informacion de criterios
    this.id_criterio = this.t_criterios.criterio[index].id_c;
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
  },

  vaciar_array_temporal(array){//metodo para limpiar array temporales
    for (let i = array.length; i > 0; i--) {
      array.pop();
    }
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
  eliminar_nivel(nivel,valor){//metodo para eliminar niveles de la data
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
  existe_item_criterio(id_c, n_item){ // método para validar si ya existe n_item dentro del criterio
    let existe = 0;
    this.item_criterio_temporal.forEach(element => {
      if(element.id_c == id_c && element.n_item == n_item){
        existe = 1;
      }
    });
    return existe;
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
  validar_porcentaje_criterio(){// metodo para validar el maximo del porcentaje como 100%
    let validacion = 0;
    let por_total = this.n_porcentaje;
    console.log("por total: ", por_total);
    this.t_criterios.criterio.forEach(element => {
        por_total = parseInt(por_total) + parseInt(element.porcentaje);
    });
    console.log("por total des: ", por_total);
    if(por_total > 100){
      validacion = 1;
    }
    return validacion;
  },
  actualzar_criterio(){//este metodo actualiza un criterio sin los textos que corresponden a cada nivel
    let nombre = this.n_criterio;
    let porc = this.n_porcentaje;
    let c_i = this.c_item;

    if(this.n_criterio == '' || this.n_porcentaje == '' || this.c_item == 0){
      alert("Verifique que ha ingresado el nombre del criterio, porcentaje, al menos debe tener un item agregado")
    }else{
                //actualizacion parte criterio      
      let validacion = this.validar_porcentaje_criterio();
      if (validacion == 1){
        alert("El valor total del porcentaje para esta rubrica es superior al 100%");
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
        let posicion = this.t_nivel_criterio_temp.indexOf(element.n_item);
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

  habilitar_dis(obj_model){//metodo para habilitar disiplina segun selecccion de campo
    //console.log('model de campo: ', obj_model);
    const nueva = this.combos.disciplina.filter(x => x.id_campo == obj_model.id);
    this.disciplina = nueva;
    this.model.dis = null;
    this.model.sub = null;
    this.model.mat = null;
    this.hab.dis = false;
    this.hab.sub = true;
    this.hab.mat = true;
    this.hab.rub = false;
  },
  habilitar_sub(obj_model){//metodo para habilitar subdisiplina segun selecccion de disciplina
   // console.log('model de disciplina: ', obj_model);
    const nueva = this.combos.subdisciplina.filter(x => x.id_disciplina == obj_model.id);
    this.subdisciplina = nueva;
    this.model.sub = null;
    this.hab.sub = false;
    this.hab.mat = true;
    this.hab.rub = false;
    this.model.sub = null;
    this.model.mat = null;
  },
  habilitar_mat(obj_model){
    //console.log('model de subdisciplina: ', obj_model);
    const nueva = this.combos.materia.filter(x => x.id_subdisciplina == obj_model.id);
    this.materia = nueva;
    this.hab.mat = false;
    this.model.mat = null;
  },
  rubricas_usuario(){
    this.combos.rubrica.forEach(element => {
      //console.log("ciclo for: ", element.nombre, " ", this.usuario);
      if(element.id_docente == this.usuario){
        //console.log("iingrese a if");
        let nombre = element.nombre;
        this.rubrica.push(nombre);
      }
      
    });
  },
  mostrar_rubrica(obj_model){
    //console.log("di lcic en nueva rubrica");
    //validar que no exista una rubrica en curso y mostrar mensaje antes de cargar la rubrica
    if(this.t_criterios.criterio.length > 0 && this.t_criterios.items.length > 0){
      //console.log("entre a validacion");
      this.alert4 = true;
    }else{
      //poner valores a combos
      this.model.mat = this.combos.materia.find(el=>el.id==this.model.rub.id_asignatura);
      this.model.sub = this.combos.subdisciplina.find(el=>el.id==this.model.mat.id_subdisciplina);
      this.model.dis = this.combos.disciplina.find(el=>el.id==this.model.sub.id_disciplina);
      this.model.cam = this.combos.campo.find(el=>el.id==this.model.dis.id_campo);
      /* this.combos.materia.forEach(mate =>{
        console.log("materia ss: ", mate);
        
         if(mate.id == this.model.rub.id_asignatura){
          this.model.mat = mate;
        } 


      }) */
      


      this.cargar_data_rubrica()
    }


    //cargar clasificacion
    



    //cargar rubrica

  },
  cargar_data_rubrica(){
    this.alert4= false;
    //console.log("rubrica seleccionada: ",this.model.rub.id);
    //trae data y llenar varibales

    axios
    .get(window.location.href+'api/criterio/'+this.model.rub.id)
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
      });
   // console.log("enviando: ", items_criterios2.length);
    axios
    .post(window.location.href+'api/items/multiple/show',items_criterios2)
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
      .get(window.location.href+'api/niveles/'+this.model.rub.id)
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
        })

        //PETICIONA DESCRIPCIONES
     
      axios
      .post(window.location.href+'api/descripciones/multiple/show',items_criterios2)
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
      });
      }); 

      }); 

      



    }); 


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
    actualizar_bd(){
      console.log("aqui guardo a la base de datos toda la informacion");
      //validar si es actualización o es nueva rubrica
      if(this.model.rub != null){
        console.log("actualizacion de rubrica");
        this.d_rubrica=this.model.rub.descripcion;
        this.n_rubrica=this.model.rub.nombre;
        
        this.persistent5 = true;
        
        

      }

      //caso nueva rubrica
        //validar que los combos de clasificacion esten llenos especificamente el de materia
        if(this.model.mat != null && this.model.rub == null){
          //console.log("validado aui 1");
          if(this.t_criterios.criterio.length == 0 || this.t_criterios.items.length == 0){
            alert("Para guardar la Rúbrica debe tener al menos 1 criterio con 1 item ingresado");
            //validar que exista al menos 1 criterio con 1 item 
          }else if(this.t_criterios.criterio.length > 0 && this.t_criterios.items.length > 0){
            
            //abrir modal para ingresar nombre y descripcion de la rubrica
            this.persistent4 = true; 
            //la accion de guardar se ejecuta en el boton guardar  del modal
            //luego de guardar se limpia todo la visual y se debe volver a cargar las rubricas para que aparezca la nueva y pueda ser seleccionada
          }
        }else if(this.model.mat == null){
          alert("Selecciones los campos de clasificación requeridos para la rúbrica");
        }
        
        //abrir modal para ingresar nombre a la rubrica y descripcion
    },
    actualizar_rubrica_bd(){
      console.log("nueva forma de actualizacion en caso de que la rubrica este en construccion");
      axios
      .delete(window.location.href+'api/rubrica/'+this.model.rub.id)
      .then(response9 => {
        console.log("Rubrica eliminada?: ",response9.data );
        this.guardar_rubrica_bd();
      });

/*
      let rubrica_criterios = [];
      let items_criterios = [];

      let temp =[{
        "id":this.model.rub.id,
        "id_asignatura":this.model.rub.id_asignatura,
        "id_docente":this.model.rub.id_docente,
        "nombre":this.n_rubrica,
        "descripcion": this.d_rubrica,
        "estado": this.model.rub.estado
      }];

      axios
      .put(window.location.href+'api/rubrica',temp)
      .then(response2 => {
       // this.combos.disciplina = response2.data;
        //this.model.dis = this.disciplina.find(el=>el.id==2);
        console.log("rubrica guardada: ", response2.data);

        this.t_criterios.criterio.forEach(element4 => {
          //console.log("hola2");
          let temp ={
            "id":element4.id_bd,
            "id_rubrica":this.model.rub.id,
            "nombre":element4.nombre,
            "porcentaje":element4.porcentaje
          };
          //console.log("temporal de criterior par enviar: ", temp);
          rubrica_criterios.push(temp);
        });

        axios
        .put(window.location.href+'api/criterio',rubrica_criterios)
        .then(response3 =>{
          console.log("actualizacion criterios: ", response3.data);
          let ides_criterios = response3.data;
          let cont2 = 0;
          //parte de items por criterios
          this.t_criterios.criterio.forEach(element_c => {
            this.t_criterios.items.forEach(element_i =>{
              if(element_i.id_c == element_c.id_c){
                let temp3 ={
                  "id": element_i.id_i,
                  "id_criterio":ides_criterios[cont2],
                  "nombre":element_i.n_item,
                  "andamiaje":element_i.andamiaje
                }
                items_criterios.push(temp3);
              }
              
            })
            
            cont2=cont2+1;
          });

          axios
          .put(window.location.href+'api/items',items_criterios)
          .then(response4 => {
            console.log("actualizacion items: ", response4.data)

          })



        })// aqui termina peticion actualizacion criterios



      }); //aqui termina el axios de rubrica actualizacion
*/
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
      //preparar la data

      const array_rubrica = {
        "id_asignatura" : this.model.mat.id,
        "id_docente" : 14,
        "nombre" : this.n_rubrica,
        "descripcion" : this.d_rubrica,
        "estado": "A"
      };

      //peticion para rubrica general
      //let prueba = this.peticion_rubrica_general(array_rubrica);
      
      //console.log("id_rubrica almacenada: ", prueba);
      
      axios
            .post(window.location.href+'api/rubrica',array_rubrica)// ejemplo para update pasar id_rubrica
            .then(response => {
              //console.log("response: ", response.data);
              id_rubrica = response.data;

              //aqui se debe crear la siguiente peticion
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
              .post(window.location.href+'api/niveles/multiple',rubrica_niveles)
              .then(response2=>{
                //console.log("response de niveles: ", response2.data);
                niveles = response2.data;
                //console.log("hola");
                //let criterios_temp = [];
                //criterios_temp = this.t_criterios.criterios;
                //console.log("criterios: ",this.t_criterios.criterio);
                 //para tabla de criterios por rubrica
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
                  .post(window.location.href+'api/criterio/multiple',rubrica_criterios)
                  .then(response3=>{
                    console.log("response de criterios: ", response3.data);
                    criterios= response3.data;
                    console.log("criterios: ", criterios);
                    console.log("hola3");

                           
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
                  .post(window.location.href+'api/descripciones/multiple',descripcion_niveles)
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
                  .post(window.location.href+'api/items/multiple',items_criterios)
                  .then(response5 =>{
                    //console.log("response de items: ", response5.data);
                  })
                  this.limpiar_rubrica(); 
                  this.cargar_data_combos();
                  })
                  })
              })       
      });
        
      //this.limpiar_rubrica(); -- cometado para probar si es por esto el error
      //peticiones para actualizar el combo de rubrica
      



    },//aqui termina la funcion de guardar  
    limpiar_rubrica(){
      this.t_criterios.criterio = [];
      this.t_criterios.texto_niveles = [];
      this.t_criterios.items = [];
      this.t_niveles = [
      {texto: 'Totalmente Adecuado', valor: 4/*, id_v: 'v1' , estado: 1 , id:'a1'*/, id_b: 'b1'/* , niv1:false */},
      {texto: 'Bastante Adecuado', valor: 3/*, id_v: 'v2' , estado: 1 , id:'a2'*/, id_b:  'b2'/* , niv1:false  */},
      {texto: 'Adecuado', valor: 2/*, id_v: 'v3' , estado: 1 , id:'a3'*/, id_b: 'b3'/* , niv1:false */},
      {texto: 'Nada Adecuado', valor: 1/*, id_v: 'v4' , estado: 1 , id:'a4'*/, id_b: 'b4'/* , niv1:false */}
      ]
      this.n_rubrica='';
      this.d_rubrica='';
    },
    cargar_data_combos(){
      axios
      .get(window.location.href+'api/campos')
      .then(response1 => {
        this.campo = response1.data;
        this.combos.campo = response1.data;
        //this.model.cam = this.campo.find(el=>el.id==1);
      }); 
      axios
      .get(window.location.href+'api/disciplinas')
      .then(response2 => {
        this.combos.disciplina = response2.data;
        //this.model.dis = this.disciplina.find(el=>el.id==2);
      });
      axios
      .get(window.location.href+'api/subdisciplinas')
      .then(response3 => {
        this.combos.subdisciplina=response3.data;
        //this.model.sub = this.subdisciplina.find(el=>el.id==2);
      });
      axios
      .get(window.location.href+'api/asignaturas')
      .then(response4 => {
        this.combos.materia=response4.data;
        //this.model.mat = this.asignaturas.find(el=>el.id==1);
      });
      axios
      .get(window.location.href+'api/rubrica')
      .then(response5 => {
        this.rubrica = response5.data;
        this.combos.rubrica=response5.data;
        //console.log("rubricas: ", response5.data);
        this.rubricas_usuario();
        //this.model.mat = this.asignaturas.find(el=>el.id==1);
      });
    }

    
  },
 

})
