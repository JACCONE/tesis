<!DOCTYPE html>
<html>

<!--
    WARNING! Make sure that you match all Quasar related
    tags to the same version! (Below it's "@1.15.20")
  -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINA PRINCIPAL RUBRICA </title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet"
        type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/quasar@1.15.20/dist/quasar.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('estilos/login.css') }}" rel="stylesheet">
    
</head>

<body>
    <!-- Add the following at the end of your body tag -->
    <div id="aut" style="height: 100%;">
      
            <div class="principal_container">
                <q-card class="card_1">

                    <q-card-section style="text-align: center; padding-top: 40px; padding-bottom: 0px;">
                        <img src="images/logo_utm.png">
                    </q-card-section>

                    <q-card-section class="form">
                        <q-input v-model="user" label="Usuario"></q-input>
                        <q-input v-model="password" label="Clave" type="password"></q-input>
                    </q-card-section>

                    <q-list>
                        <q-item id="login" clickable>
                            <q-item-section>
                                <q-item-label @click="sesion" class="noselect">Iniciar Sesión</q-item-label>
                            </q-item-section>
                        </q-item>
                    </q-list>
                </q-card>
            </div>

  </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@^2.0.0/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar@1.15.20/dist/quasar.umd.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.slim.js"
  integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" 
  integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" 
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="scripts/inicio.js"></script>
    
</body>

</html>