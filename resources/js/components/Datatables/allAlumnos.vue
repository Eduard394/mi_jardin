<template>
<div class="col-md-12">
   <div class="box box-secondary">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de alumnos</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool"><i class="fa fa-institution text-orange"></i></button>
        </div>
      </div>
      <div class="box-body">
            <div class="users-style">
            <div class="table-style">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default " placeholder="Ingresa la palabra a buscar"  v-model="search" @input="resetPagination()" >
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend ">
                    <label class="input-group-text" for="inputGroupSelect01">Registros</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" v-model="length" @change="resetPagination()">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                  </select>
                </div>
            </div>
            <v-app style="height:10px" v-show="progreso">
                <v-progress-linear indeterminate color="orange darken-2"></v-progress-linear>
            </v-app> 
            <table class="table table-bordered table-striped table-responsive">
                <thead class="text-white bg-dark">
                    <tr>
                        <th v-for="column in columns" :key="column.name" @click="sortBy(column.name)"
                            :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                            style="width: 40%; cursor:pointer;">
                            {{column.label}}
                        </th>
                        <th>Ver</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="alumno in paginatedUsers" :key="alumno.id">
                        <td style="display: none" id="id">{{alumno.id}}</td>
                        <td>{{alumno.nombre}}</td>
                        <td>{{alumno.grado}}</td>
                        <td>{{alumno.acudiente}}</td>
                        <td>{{alumno.telefono}}</td>
                        <td>{{alumno.deuda}}</td>
                        <td><a class="btn btn-success btn-sm text-white" :href="'/alumno/' +  alumno.id" :value="+alumno.id">Ver</a></td>
                        <td><a class="btn btn-danger btn-sm text-white eliminar" @click="guardar(alumno.id)" :value="+alumno.id">Eliminar</a></td>
                        
                    </tr>
                </tbody>
            </table>
            <div>
                <nav class="pagination" v-if="!tableShow.showdata">
                    <span class="page-stats">{{pagination.from}} - {{pagination.to}} de {{pagination.total}}</span>
                    <a v-if="pagination.prevPageUrl" class="btn btn-sm btn-primary pagination-previous" @click="--pagination.currentPage">
                        Prev
                    </a>
                    <a class="btn btn-sm btn-dark pagination-previous" v-else disabled>
                    Prev
                    </a>
                    <a v-if="pagination.nextPageUrl" class="btn btn-sm pagination-next" @click="++pagination.currentPage">
                        Next
                    </a>
                    <a class="btn btn-sm btn-dark pagination-next" v-else disabled>
                        Next
                    </a>
                </nav>
                <nav class="pagination" v-else>
                    <span class="page-stats">
                        {{pagination.from}} - {{pagination.to}} de {{filteredUsers.length}}
                        <span v-if="`filteredUsers.length < pagination.total`"></span>
                    </span>
                    <a v-if="pagination.prevPage" class="btn btn-sm btn-dark pagination-previous ml-3" @click="--pagination.currentPage">
                        Atras
                    </a>
                    <a class="btn btn-sm pagination-previous btn-dark ml-3" v-else disabled>
                    Atras
                    </a>
                    <a v-if="pagination.nextPage" class="btn btn-sm btn-dark pagination-next ml-3" @click="++pagination.currentPage">
                        Siguiente
                    </a>
                    <a class="btn btn-sm pagination-next btn-dark ml-3"  v-else disabled>
                        Siguiente
                    </a>
                </nav>
            </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

    export default {
        created() {
            this.getData();

            Fire.$on('reloadUsers', () => {
                this.getData();
            })
        },

        data() {
            let sortOrders = {};
            let columns = [
                {label: 'Nombre', name: 'nombre' },
                {label: 'Grado', name: 'grado' },
                {label: 'Acudiente', name: 'acudiente'},
                {label: 'Teléfono', name: 'telefono'},
                {label: 'Deuda', name: 'deuda'},

            ];
            columns.forEach((column) => {
            sortOrders[column.name] = -1;
            });
            
            return {
                users: [],
                columns: columns,
                sortKey: 'nombre',
                sortOrders: sortOrders,
                length: 10,
                search: '',
                tableShow: {
                    showdata: true,
                },
                pagination: {
                    currentPage: 1,
                    total: '',
                    nextPage: '',
                    prevPage: '',
                    from: '',
                    to: ''
                },
                progreso : true
            }
        },

        methods: {
            getData() {
                
                axios.get('/alumno/getAlumnos', {params: this.tableShow})
                    .then(response => {
                    
                        this.users = response.data;
                        this.pagination.total = this.users.length;
                        this.progreso = false
                        if(response.data.length == 0){
                            this.$swal('',`Tabla sin datos`,'success')
                        }
                    })
                    .catch(errors => {
                        this.progreso = false
                        console.log(errors);
                    });
            },
            paginate(array, length, pageNumber) {
                this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
                this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
                this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
                this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
                return array.slice((pageNumber - 1) * length, pageNumber * length);
            },
            resetPagination() {
                this.pagination.currentPage = 1;
                this.pagination.prevPage = '';
                this.pagination.nextPage = '';
            },
            sortBy(key) {
                this.resetPagination();
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },  
        
            async guardar (id) {

                let data = {

                    alumno_id: id

                };

                const resp = await  axios.post( '/alumno/eliminar', data );

                if( resp.status == 200 ){

                    console.log(resp.data)
                    if ( resp.data.error ) {
                        toastr.error( resp.data.error );
                    } else {
                        toastr.success( 'El alumno fue eliminado correctamente' );
                        location.reload();
                    }
                    
                } else
                    toastr.error( 'Error eliminando alumno' );
            },
        },
        computed: {

            filteredUsers() {
                let users = this.users;
                if (this.search) {
                    users = users.filter((row) => {
                        return Object.keys(row).some((key) => {
                            return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                        })
                    });
                }
                let sortKey = this.sortKey;
                let order = this.sortOrders[sortKey] || 1;
                if (sortKey) {
                    users = users.slice().sort((a, b) => {
                        let index = this.getIndex(this.columns, 'name', sortKey);
                        a = String(a[sortKey]).toLowerCase();
                        b = String(b[sortKey]).toLowerCase();
                        if (this.columns[index].type && this.columns[index].type === 'date') {
                            return (a === b ? 0 : new Date(a).getTime() > new Date(b).getTime() ? 1 : -1) * order;
                        } else if (this.columns[index].type && this.columns[index].type === 'number') {
                            return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
                        } else {
                            return (a === b ? 0 : a > b ? 1 : -1) * order;
                        }
                    });
                }
                return users;
            },
            paginatedUsers() {
                return this.paginate(this.filteredUsers, this.length, this.pagination.currentPage);
            }
        }
    };

    

</script>


