const configComponent = Vue.component('config',{
template:`
<div>
<span>prueba</span>
</div>
`
});

const app = new Vue({
    el: '#app',
    components:{
      "config": configComponent
    },
    /* watch: {// pendiente validar funcionalidad con respecto a repeticiones en nombres de items por criterio
      n_item: function () {
        this.item_criterio_temporal.forEach(element => {
          if(element.n_item == this.n_item ){
            console.log("ya existe este nombre de item en este criterio");
          }
        });
        
      }
    }, */
    beforeMount() {
      console.log("before mounted");
      axios
      .get('http://localhost/tesis/public/api/disciplinas')
      .then(response => {
        this.campo=response.data;
        this.model = this.campo.find(el=>el.id==2);
      })

 
  },
    mounted() {
      console.log("mounted");
    },
    data: function () {
        
        return {
            c_niveles: 4, // utilizada en metodos para controlar y cambiar el campo valor de los niveles
            c_criterios: 0, // validar si se va a usar
            c_item: 0, //temporal para cantidad de item por criterio, al guardar criterio debe volver a cero
            id_criterio: '', //temporal para id criterio generado, al guardar criterio debe ser '' nuevamente
            control_guardar_editar: 1, // 1 para guardar, 2 para editar criterio
            t_niveles :[
                {texto: 'Totalmente Adecuado', valor: 4, id_v: 'v1', estado: 1, id:'a1', id_b: 'b1', niv1:false},
                {texto: 'Bastante Adecuado', valor: 3, id_v: 'v2', estado: 1, id:'a2', id_b:  'b2', niv1:false },
                {texto: 'Adecuado', valor: 2, id_v: 'v3', estado: 1, id:'a3', id_b: 'b3', niv1:false},
                {texto: 'Nada Adecuado', valor: 1, id_v: 'v4', estado: 1, id:'a4', id_b: 'b4', niv1:false}
            ],
            t_criterios:{ //este array maneja toda la informacion referente a los criterios en la matriz
              criterio : [],
              items : [],
              texto_niveles : [/*{id_c: 'cri1', nivel: 4, texto: "el ldsmsldalskd lkamdlaskd"} */]
            },
            andamiaje_criterio:[
                //{id_c: 'cri1',id_i:'i1', texto_andamiaje: 'este es el andamiaje de este imte'} 
    /*
              {
                id_c: 'cri1',
                andamiaje_criterio:{id_i:'i1', texto_andamiaje: 'este es el andamiaje de este imte'} 
              } */

            ],

            item_criterio_temporal : [
             /*  {id_i:'i1', id_c: '1', n_item: 'carátula', andamiaje: 'este es el anadamiaje'},
              {id_i:'i2', id_c: '1', n_item: 'carátula 2', andamiaje: 'este es el anadamiaje 2'},
              {id_i:'i3', id_c: '1', n_item: 'carátula 3', andamiaje: 'este es el anadamiaje 2'},
              {id_i:'i4', id_c: '1', n_item: 'carátula 4', andamiaje: 'este es el anadamiaje 2'},
              {id_i:'i5', id_c: '1', n_item: 'carátula 5', andamiaje: 'este es el anadamiaje 2'} */
            ],
            
            item_criterio: [ // pendiente validar si se utiliza
              //{id_i:'i1' id_c: '1', n_item: 'carátula', andamiaje: 'este es el anadamiaje'}
            ],

            //todos los valores de id generados se deben actualizar al iniciar la aplicacion con el último valor de extraido de la base
            model_nivel: 4, //para generar v-model para los botones de config niveles
            n_nivel_act: '',//esta variable es para manejar el nombre actual del texto del nivel a modificar
            id_b_actual: '',//esta variable es para manejar el id_b actual modificado del nivel 
            c_id: 4, // para generar id de niveles
            b_id: 4, // para generar id de botones eliminar
            v_id: 4, // para generar id de valores
            criterio_id: 0, // para generar id de criterios
            item_id: 0, // para generar id de items

            item_tem_id: '', // usado para eliminar o actualizar items

            left: true,
            currentTab: 'inicio',
            model: null,
            campo: [
                'campo1', 'campo2', 'campo3'
            ],
            disciplina: [
                'disciplina1', 'disciplina2', 'disciplina3'
            ],
            subdisciplina: [
                'subdisciplina1', 'subdisciplina2', 'subdisciplina3'
            ],
            materia: [
                'materia1', 'materia2', 'materia3'
            ],
            expanded: true,
            expanded_rubrica : false,
            drawer: false,
            miniState: true,

            menu_abrir: 'inicio',
            fab1: false,
            fab2: false,
            conf_item: false,
            conf_criterio: false,
            persistent: false,
            persistent2:false,
            persistent3:false,
            fixed: false,
            n_criterio: '', //temporal para nombre del criterio
            n_porcentaje: '', //temporal para porcentaje de criterio
            andamiaje_item: '', //temporal para andamiaje por item
            valor_actual: 0, //temporal para saber el nivel actual que contiene el texto modificado
            n_item: '',
            t_nivel_criterio_temp: '',//temporal para el texto del nivel por criterio
            alert: false,
            prompt: false,
            /* c_model_crtirerio = 0,
            v_model_c = {
              
            }, */

            t_alert_1: 'Campos Nombre Item y Andamiaje son obligatorios',
            //varables de v-model de componentes ocultos
            //conf1 : false
        }
    },
    methods: {
      editar_andamiaje() {
        //alert("aqui se despliega modal");
        this.persistent3=true;
      },
      fila_criterio (control) {
        if(control == 0){
          //caso para editar criterio existente
        }else{
          //caso para añadir nuevo criterio
          this.fixed = true;
          this.persistent = true;
          this.c_criterios=this.c_criterios+1;
          this.id_criterio = this.generar_id_criterio();
        }
      },

      columna_nivel (){ //validado -- añade un nuevo nivel 
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
        this.t_niveles.push({texto: 'Descripción Nivel', valor: 1, id_v: this.generar_id_valor(), estado: 0, id: this.generar_id_nivel(), id_b: this.generar_id_btn(), niv1:false});
      },
      cabecera_rubrica (){//validar si se va a usar
        let contenedor = document.getElementById("columnas");
        let div = document.createElement("div");
        div.setAttribute("class","row nivel");
        let div_c = document.createElement("div");
        div_c.setAttribute("class","col cab_rub criterio");
        let texto = document.createTextNode("Criterio");
        div_c.appendChild(texto);
        div.appendChild(div_c);
        for(let i = 0; i<this.t_niveles.length; i++){
            let div_n = document.createElement("div");
            div_n.setAttribute("class","col cab_rub");
            let span_t = document.createElement("span");
            span_t.setAttribute("id",this.t_niveles[i].id);
            span_t.setAttribute("style","display: block !important;");
            let span_v = document.createElement("span");
            span_v.setAttribute("id", this.t_niveles[i].id_v);
            let btn = document.createElement("buttom");
            btn.setAttribute("style","cursor:pointer;position:absolute;top:-15px;right:-10px;");
            btn.setAttribute("id", this.t_niveles[i].id_b);
            let span_b = document.createElement("span");
            span_b.setAttribute("style", "font-size:22px;color:#fff;background:#000;border-radius:18px; position: relative; z-index: 1;")
            let icono = document.createTextNode("remove_circle_outline");
            span_b.appendChild(icono);
            span_b.setAttribute("class","material-icons"+" "+this.t_niveles[i].id_b);
            btn.appendChild(span_b);
            let texto = document.createTextNode(this.t_niveles[i].texto);
            let texto2 = document.createTextNode(' ('+this.t_niveles[i].valor+')');
            span_t.appendChild(texto);
            span_t.setAttribute("contenteditable",true); 
            span_v.appendChild(texto2);
            div_n.appendChild(span_t);
            div_n.appendChild(span_v);
            if(this.t_niveles[i].estado == 0){
              div_n.appendChild(btn);
            }
            div.appendChild(div_n);

        }
        contenedor.appendChild(div);
        this.asig_event_cabec_niveles();
        this.asig_event_btn_level();
        //console.log("criterios: ", this.c_criterios, " niveles: ", this.c_niveles);
        for(let i = 0; i<this.c_criterios; i++){
          this.fila_criterio(0);
        }
 
      },
      generar_model_nivel(){
        this.model_nivel = this.model_nivel + 1;
        let n = this.c_id.toString();
        let id = 'niv'+ n;
        return id;
      },
      generar_id_nivel(){
        this.c_id = this.c_id + 1;
        let n = this.c_id.toString();
        let id = 'a'+ n;
        return id;
      },
      generar_id_btn(){
        this.b_id = this.b_id + 1;
        let n = this.b_id.toString();
        let id = 'b'+ n;
        return id;
      },
      generar_id_valor(){
        this.v_id = this.v_id + 1;
        let n = this.v_id.toString();
        let id = 'v'+ n;
        return id;
      },
      generar_id_criterio(){
        this.criterio_id = this.criterio_id + 1;
        let n = this.criterio_id.toString();
        let id = 'cri'+ n;
        return id;
      },
      generar_id_item(){
        this.item_id = this.item_id + 1;
        let n = this.item_id.toString();
        let id = 'it'+ n;
        return id;
      },
     /*  generar_model(id){ //metodo para generar v_model para los botones de configuracion de criterios
        this.c_model_crtirerio = this.c_model_crtirerio + 1;
        let n = this.item_id.toString();
        let model = 'model_'+ n;
        this.v_model_c.push('model':false]);
      }, */
      asig_event_cabec_niveles (){
        for(let i=0; i<this.t_niveles.length; i++){
          document.getElementById(this.t_niveles[i].id).addEventListener("input", inputEvt => {
            this.t_niveles[i].texto = inputEvt.target.outerText;
          }, false);
        }
      },
      actualizar_t_n (id){//metodo para actualizar valores en data y actualizar valores en span visual, pendiente ver si se utiliza
        for(let i=0; i<this.t_niveles.length; i++){
          if(this.t_niveles[i].id_b == id){
            this.t_niveles.splice(i,1);
            this.c_niveles = this.c_niveles-1;
          }
        }
        for(let i = 0; i<this.c_niveles; i++){
          this.t_niveles[i].valor = this.c_niveles - i;
        }
        for(let i=0; i<this.t_niveles.length; i++){
          let n = this.t_niveles[i].valor.toString();
          document.getElementById(this.t_niveles[i].id_v).innerHTML = "("+n+")";
        }
        
    },
      asig_event_btn_level(){ // validar si se está utilizando
        for(let i=0; i<this.t_niveles.length; i++){
          if(this.t_niveles[i].estado==0){
            
            document.getElementById(this.t_niveles[i].id_b).addEventListener('click', function(event){        
              let padre = event.target.parentNode.parentNode.parentNode;
              let hijo = event.target.parentNode.parentNode;
              padre. removeChild(hijo);
              let column = document.getElementsByClassName(event.target.parentNode.id);
              //console.log("divs nuevos a eliminar: ", column);
              let ancho = column.length;
              for (let i = 0; i<ancho; i++) {
                let p = column[0].parentNode;
                p.removeChild(column[0]);
            }
              app.actualizar_t_n(event.target.parentNode.id);
              
            })
          }
        }

      },
      agregar_item(){ //revisión completada, este metodo es funcional correcto
        //console.log("cantidad criterios: ", this.c_criterios);

        if(this.n_item == '' || this.andamiaje_item == ""){
          //console.log("entre a validacion");
          this.alert = true;
        }else{
          //control de data
          let existe = this.existe_item_criterio(this.id_criterio, this.n_item);
          if(existe == 1){
            alert("ya existe este nombre de item para este criterio");
          }else{
            let id_i = this.generar_id_item();
            this.c_item = this.c_item + 1;
            let valor_item = {id_i:id_i, id_c: this.id_criterio, n_item: this.n_item, andamiaje: this.andamiaje_item};
            this.item_criterio_temporal.push(valor_item);
            //console.log("item agregado: ", this.item_criterio_temporal);
            this.n_item = '';
            this.andamiaje_item = '';
            //console.log("cantidad de item: ", this.c_item);
          }
         
        }
      },
      seleccionar_item(id_item){//revisión completada, este metodo es funcional correcto
        //console.log("item pasado: ", id_item);
        this.item_criterio_temporal.forEach(element => {
          if(element.id_i == id_item){
            this.n_item = element.n_item;
            this.andamiaje_item = element.andamiaje;
            this.item_tem_id = id_item;
          }
          
        });
      },
      eliminar_item(){ // previsión completada, este metodo es funcional correcto
        //console.log("entre a eliminar item");
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
        
        //console.log(this.item_criterio_temporal);

      },
      editar_item(){ //revisión completada, este metodo es funcional correcto
        //console.log("entre a editar item");
        for (let i = 0; i < this.item_criterio_temporal.length; i++) {
          if(this.item_criterio_temporal[i].id_i = this.item_tem_id){
            this.item_criterio_temporal[i].n_item = this.n_item;
            this.item_criterio_temporal[i].andamiaje = this.andamiaje_item;
            this.n_item = '';
            this.andamiaje_item = '';
            this.item_tem_id = '';
          }
        }
        
        //console.log("temporal: ",this.item_criterio_temporal);
        //console.log("real: ", this.t_criterios.items);
      },
      guardar_item_criterio(){//validado, este metodo guarda un criterio en el array de data
        //console.log("aqui esto validando la edicion ");
        //validaciones
        if(this.control_guardar_editar == 1){
          console.log("entre a guardar nuevo")
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
              let criterio = {id_c: this.id_criterio, nombre: this.n_criterio, porcentaje: this.n_porcentaje , c_item: this.c_item, model: false};
              this.t_criterios.criterio.push(criterio);
              //let items = [];
              this.item_criterio_temporal.forEach(element => {
                this.t_criterios.items.push(element);
              });
              //console.log("criterios2: ", this.t_criterios);
              //guardar en array de andamiaje para modal
              /* let id_c = this.id_criterio;
              let array_andamiaje = {};
              this.item_criterio_temporal.forEach(element => {
                array_andamiaje = {id_c: id_c, id_i: element.id_i, texto_andamiaje: element.andamiaje};
                this.andamiaje_criterio.push(array_andamiaje);
              }); */

              //setear a cero las variables
              this.n_criterio = '';
              this.n_porcentaje = '';
              this.c_item = 0;
              this.vaciar_array_temporal(this.item_criterio_temporal);
              this.id_criterio = '';
              this.persistent = false; 
              //this.control_guardar_editar = 1;
            }
          }
        }else if(this.control_guardar_editar == 2){
          
            this.actualzar_criterio();

        }
        
        //
      },
      editar_criterio(index){//metodo para editar informacion de criterios
        this.id_criterio = this.t_criterios.criterio[index].id_c;
        this.control_guardar_editar = 2;        
        this.n_criterio = this.t_criterios.criterio[index].nombre;
        this.n_porcentaje = this.t_criterios.criterio[index].porcentaje;
        this.c_item = this.t_criterios.criterio[index].c_item;
        this.persistent = true;
        //agregar al array temporal de items los items del criterio seleccionado
       // console.log("id_criterio_seleccionado. ", this.t_criterios.criterio[index].id_c);
        
        for(let i = 0 ; i<this.t_criterios.items.length; i++){
          //console.log("id elemento; ", this.t_criterios.items[i].id_c, " id recibido: ", this.t_criterios.criterio[index].id_c);
          if (this.t_criterios.items[i].id_c == this.t_criterios.criterio[index].id_c) {
            //console.log("entre a la asignacion temporal");
            let valor = {
              id_i: this.t_criterios.items[i].id_i,
              id_c: this.t_criterios.items[i].id_c, 
              n_item: this.t_criterios.items[i].n_item, 
              andamiaje: this.t_criterios.items[i].andamiaje
            };
            this.item_criterio_temporal.push(valor);
          }  
        }
       /*  this.t_criterios.items..forEach(element => {
          console.log("elemtos de items; ", element);
          console.log("id elemento; ", element[0].id_c, " id recibido: ", this.t_criterios.criterio.[index].id_c);
          if (element.id_c == this.t_criterios.criterio.[index].id_c) {
            console.log("entre a la asignacion temporal");
            this.item_criterio_temporal.push(element);
          }  
        }); */
        //console.log("temporal_itme: ", this.item_criterio_temporal);

      },
      vaciar_modal_criterio(){
        //proceso para vaciar campos y arrays 
        this.n_criterio = '';
        this.n_porcentaje = '';
        this.vaciar_array_temporal(this.item_criterio_temporal);
        this.n_item = '';
        this.andamiaje_item = '';
        this.id_criterio = '';
        this.persistent= false;
        this.control_guardar_editar = 1;
      },

      vaciar_array_temporal(array){//metodo para limpiar array temporales
        for (let i = array.length; i > 0; i--) {
          array.pop();
        }
      },
/* 
      generar_fila_criterio(){
        let cont = document.getElementById("columnas");
        let div_p = document.createElement("div");
        div_p.setAttribute("class","row nivel");
        for(let i = 0; i <= this.c_niveles; i++){
            let div = document.createElement("div");
            div.setAttribute("class","col cab_rub");
            div.classList.add("estilo_interno");
            if(i == 0){
              div.classList.add(this.id_criterio);
              //añadir contenido 
              //let text = document.createTextNode(this.n_criterio.toUpperCase());
              //div.appendChild(text);
              div.innerHTML = '<config></config>';

            }
            if(i >=1){
              div.classList.add(this.t_niveles[i-1].id_b);
            }
            div_p.appendChild(div);
        }
        cont.appendChild(div_p);
      }, */
      modificar_texto_nivel(nivel){ // esta funcion es parte para cambiar el texto del nivel
        console.log("estoy aqui en ");
        this.t_niveles.forEach(element => {
          if(element.id_b == nivel){
            this.n_nivel_act = element.texto;
            this.id_b_actual = nivel
          }
        });
        this.prompt = true;
        //this.n_nivel_act
      },
      guardar_texto_nivel_cabecera(){ // este método guarda el nuevo texto modificado en el array de t_niveles
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
          console.log("entre a validacion: ", this.t_criterios.texto_niveles[index].nivel, " nivel: ", valor );
          if(this.t_criterios.texto_niveles[index].nivel > valor){
            console.log("disminuir: ", index);
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
        this.t_criterios.criterio.forEach(element => {
            por_total = por_total + element.porcentaje;
        });
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
          
          
          //actualizacion parte items
          //borrar items
          for (let index = 0; index < this.t_criterios.items.length; index++) {
            if(this.t_criterios.items[index].id_c == this.id_criterio){
              //console.log("actual: ", this.t_criterios.items[index]);
              this.t_criterios.items.splice(index,1);
            }
          }
          //agregar nuevamente los items actualizados
          this.item_criterio_temporal.forEach(element => {
            this.t_criterios.items.push(element);
          });        
          //vaciar
              this.n_criterio = '';
              this.n_porcentaje = '';
              this.c_item = 0;
              this.vaciar_array_temporal(this.item_criterio_temporal);
              this.id_criterio = '';
              this.persistent = false; 

        }
      }
      this.control_guardar_editar = 1;
      },
      eliminar_criterio(id_c){// validado
        //console.log("criterio a eliminar: ", id_c);
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
        //console.log("criterio eliminado");
      },
      editar_nivel_criterio(id_c, valor, event){//validado
        //console.log("criterio: ", id_c, " valor_nivel: ", valor, " evento: ", event );
        this.valor_actual = valor;
        this.id_criterio = id_c;
        
        for (let index = 0; index < this.t_criterios.texto_niveles.length; index++) {
         // console.log("dentro comparacion: ", this.t_criterios.texto_niveles[index].id_c, " valor: ", this.t_criterios.texto_niveles[index].nivel )
          if(this.t_criterios.texto_niveles[index].id_c == this.id_criterio && this.t_criterios.texto_niveles[index].nivel == this.valor_actual){
            //console.log("entre: ", this.t_criterios.texto_niveles[index].texto);
            let texto = this.t_criterios.texto_niveles[index].texto;
            this.t_nivel_criterio_temp = texto;
          }else{
            //this.t_nivel_criterio_temp = '';
          }
        }
        this.persistent2 = true; 

      },
      salir_texto_nivel(){ //validado
        this.valor_actual = 0;
        this.id_criterio = '';
        this.t_nivel_criterio_temp = '';
        this.persistent2 = false; 
      },
      guardar_texto_nivel(){
        if(this.t_nivel_criterio_temp == ''){
          alert("LLene el campo correspondiente al texto del nivel de este criterio");
        }else{
        if(this.t_criterios.texto_niveles.length == 0){
          //console.log("caso de guardar el primero");
          let temp = this.t_nivel_criterio_temp;
          let temp2 = this.id_criterio;
          let temp3 = this.valor_actual;
          let nivel_texto = {id_c: temp2, nivel: temp3, texto: temp};
          this.t_criterios.texto_niveles.push(nivel_texto);
        }else{
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
              let nivel_texto = {id_c: temp2, nivel: temp3, texto: temp};
              this.t_criterios.texto_niveles.push(nivel_texto);
          }
        }
        this.salir_texto_nivel();
      }
      },
      control_andamiaje(){// metodo para actualizar la data del andamiaje para enviarla al modal

      }

    },


})
