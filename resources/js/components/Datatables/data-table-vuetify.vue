<template>
  <v-row>
    <v-col cols="12">
      <v-card>
        <v-card-title >
          <p class="text-orange lighten-2">{{titulo}}</p>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Buscar"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="headers"
          :items="desserts"
          :search="search"
        ></v-data-table>
      </v-card>
    </v-col>
  </v-row>
</template>


<script>
  export default {
    props: ['titulo','path','cabezeras'],
    mounted(){
      this.getData()
      this.formato()
    },
    data () {
      return {
        search: '',
        headers: [],
        desserts: [],
      }
    },
    methods : {
      async getData(){
        const response = await  axios.get(this.path);
        if(response.status == 200){
          this.desserts = response.data
        }      
      },
      formato (){
        this.headers = this.cabezeras
      },
    }
  }
</script>