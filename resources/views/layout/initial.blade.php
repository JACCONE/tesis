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

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/quasar@1.15.20/dist/quasar.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('estilos/login.css') }}" rel="stylesheet">
    <link href="{{ asset('estilos/p_rubrica.css') }}" rel="stylesheet">
    <link href="{{ asset('estilos/inicio.css') }}" rel="stylesheet">
    <script src="../scripts/rubrica.js"></script>

</head>

<body>
    <!-- Add the following at the end of your body tag -->
    <div id="aut" style="height: 100%;">
        <q-layout view="hHh Lpr lff" container>
            <q-header elevated class="bg-green-10">
                <q-toolbar>
                    <q-btn flat @click="drawer = !drawer" round dense icon="menu"></q-btn>
                    <q-toolbar-title style="font-size: 17px;"> @{{plantilla_name}}</q-toolbar-title>
                </q-toolbar>
            </q-header>

            <q-drawer v-model="drawer" :width="300" :breakpoint="500" overlay bordered class="bg-grey-3">
                <q-scroll-area style="height: calc(100% - 150px); margin-top: 150px; border-right: 1px solid #ddd">
                    <q-list padding class="menu-list" id="modulo_cont">

                        <template v-for="(menuItem, index) in modulos" :key="index">
                            <q-item clickable :active="menuItem.nombre_modulo === 'Outbox'" @click="drawer = !drawer, changeInterface(menuItem.plantilla_modulo,menuItem.nombre_modulo)" class="noselect" v-ripple>
                                <q-item-section avatar>
                                    <q-icon :name="menuItem.icon" color="grey-10"></q-icon>
                                </q-item-section>
                                <q-item-section>
                                    @{{menuItem.nombre_modulo}}
                                </q-item-section>
                            </q-item>
                            <q-separator :key="'sep' + index" v-if="menuItem.separator"></q-separator>
                        </template>

                        <q-separator></q-separator>

                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-icon name="logout" color="grey-9" />
                            </q-item-section>

                            <q-item-section @click="logout">
                                Cerrar Sesión
                            </q-item-section>
                        </q-item>
                    </q-list>
                </q-scroll-area>

                <q-img class="absolute-top" src="https://i0.wp.com/informateypunto.com/wp-content/uploads/2020/09/u.t.-manabi.jpg" style="height: 150px">
                    <div class="absolute-bottom bg-transparent">
                        <q-avatar size="56px" class="q-mb-sm">
                            <img src="https://cdn.quasar.dev/img/boy-avatar.png">
                        </q-avatar>
                        <div class="text-weight-bold">@{{username}}</div>
                        <div>@{{email}}</div>
                    </div>
                </q-img>

            </q-drawer>

            <q-page-container>
                <q-page>
                    <div id="rubrica_interface" class="interface" style="display: none;">@include('layout.rubrica')</div>
                    <div id="rub_eval_interface" class="interface" style="display: none;">@include('layout.rub_eval')</div>
                    <div id="eva_estudiante_interface" class="interface" style="display: none;">@include('layout.eva_estudiante')</div>
                    <div id="homework_interface" class="interface" style="display: none;">@include('layout.homework')</div>
                    <div id="homework_e_interface" class="interface" style="display: none;">@include('layout.homework_e')</div>

                </q-page>
            </q-page-container>
        </q-layout>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@^2.0.0/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quasar@1.15.20/dist/quasar.umd.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../scripts/inicio.js"></script>

</body>
</html>