<template>
    <v-container>
      <v-card class="mx-auto overflow-hidden" height="800"> 
      <v-app-bar color="deep-purple" dark>
          <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

          <v-toolbar-title>Title</v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer" absolute temporary>
          <v-list nav dense> 
            <v-list-item-group v-model="group" active-class="deep-purple--text text--accent-4">
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-home</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Home</v-list-item-title>
              </v-list-item>

              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-account</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Account</v-list-item-title>
              </v-list-item>

              <v-list-item>
                <v-btn
                  class="mx-2"
                  fab
                  dark
                  large
                  color="purple"
                  @click="salir"
                >
                  <v-icon dark>
                    mdi-android
                  </v-icon>
                </v-btn>
              </v-list-item>  
              
            </v-list-item-group>
          </v-list>
        </v-navigation-drawer>
      </v-card>
      <v-card>
        <alumno />
      </v-card>
    </v-container>
</template>


<script>
  
  import alumno from '../components/alumnos/alumnos.vue'

  export default {
    components: {    
    'alumno': alumno,  
    },
    data: () => ({
      drawer: false,
      group: null,
    }),
    computed () {

    },
    methods : {
      salir(){
        window.location.replace("/logout");
      }      
    }
  }
</script>
