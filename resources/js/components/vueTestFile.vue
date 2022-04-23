<template>
  <div>
    <form @submit.prevent="editarNota(nota)" v-if="modoEditar">

        <div class="container container_products">
            <div class="row justify-content-center">
                <div>

                    <a href="{{route('home')}}" style="font-size: 2rem;"> <svg xmlns="http://www.w3.org/2000/svg" width="38" height="23" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                    </a>

                </div>

            </div>
        </div>

        <div class="container container_products">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div class="card-body borderProduct">

                        <div class="row justify-content-center">

                            <div class="col-md-4 justify-content-center showedProduct">
                                <img src="../img/apple_watch.jpg" alt="product_image" class="singleProductsImage">
                            </div>

                            <div class="col-md-8 descriptionProduct">
                                <h5 style="margin-bottom: 2rem;">Calificacion del Apple Watch</h5>

                                <h6>Calidad Producto:</h6>
                                <div class="oneProduct">

                                    <p class="clasificacion viewDetailProducts" style="margin-bottom: 0 !important; font-size: 2rem;">

                                        <label for="start1">★</label>
                                        <label for="start2">★</label>
                                        <label for="start3">★</label>
                                        <label for="start4">★</label>
                                        <label for="start5">★</label>
                                    </p>

                                </div>

                                <h6>Calificacion 2:</h6>
                                <div class="oneProduct" style="display: inline-flex;">

                                    <p class="clasificacion viewDetailProducts" style="margin-bottom: 0 !important; font-size: 2rem;">

                                        <label for="start1">★</label>
                                        <label for="start2">★</label>
                                        <label for="start3">★</label>
                                        <label for="start4">★</label>
                                        <label for="start5">★</label>
                                    </p>

                                </div>

                                <h6>Calidficacion 3:</h6>
                                <div class="oneProduct" style="display: inline-flex;">

                                    <p class="clasificacion viewDetailProducts" style="margin-bottom: 0 !important; font-size: 2rem;">

                                        <label for="start1">★</label>
                                        <label for="start2">★</label>
                                        <label for="start3">★</label>
                                        <label for="start4">★</label>
                                        <label for="start5">★</label>
                                    </p>

                                </div>

                                <br>

                                <label for="">Comentarios:</label>
                                <textarea name="textArea" id="" rows="8" style="width: 100%; resize: none"></textarea>

                                <br><hr>

                                <div style="text-align: right;">

                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-danger">Cancelar</button>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

    </form>

    <form @submit.prevent="agregar" v-else>
      <h3>Agregar nota</h3>
      <input type="text" class="form-control mb-2"
        placeholder="Nombre de la nota" v-model="nota.nombre">
      <input type="text" class="form-control mb-2"
        placeholder="Descripción de la nota" v-model="nota.descripcion">
      <button class="btn btn-primary" type="submit">Agregar</button>
    </form>
    <hr>
    <h3>Lista de notas:</h3>
    <ul class="list-group">
         <li class="list-group-item"
            v-for="(item, index) in notas" :key="index" >
          <span class="badge badge-primary float-right">
            {{item.updated_at}}
          </span>
          <p>{{item.nombre}}</p>
          <p>{{item.descripcion}}</p>
          <p>
            <button class="btn btn-warning btn-sm"
                @click="editarFormulario(item)">Editar</button>
            <button class="btn btn-danger btn-sm"
                @click="eliminarNota(item, index)">Eliminar</button>
          </p>
        </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notas: [],
      modoEditar: false,
      nota: {nombre: '', descripcion: ''}
    }
  },
  created(){
    axios.get('/notas').then(res=>{
      this.notas = res.data;
    })
  },
  methods:{
    agregar(){
      if(this.nota.nombre.trim() === '' || this.nota.descripcion.trim() === ''){
        alert('Debes completar todos los campos antes de guardar');
        return;
      }
      const notaNueva = this.nota;
      this.nota = {nombre: '', descripcion: ''};
      axios.post('/notas', notaNueva)
        .then((res) =>{
          const notaServidor = res.data;
          this.notas.push(notaServidor);
        })
    },
    editarFormulario(item){
      this.nota.nombre = item.nombre;
      this.nota.descripcion = item.descripcion;
      this.nota.id = item.id;
      this.modoEditar = true;
    },
    editarNota(nota){
      const params = {nombre: nota.nombre, descripcion: nota.descripcion};
      axios.put(`/notas/${nota.id}`, params)
        .then(res=>{
          this.modoEditar = false;
          const index = this.notas.findIndex(item => item.id === nota.id);
          this.notas[index] = res.data;
        })
    },
    eliminarNota(nota, index){
      const confirmacion = confirm(`Eliminar nota ${nota.nombre}`);
      if(confirmacion){
        axios.delete(`/notas/${nota.id}`)
          .then(()=>{
            this.notas.splice(index, 1);
          })
      }
    },
    cancelarEdicion(){
      this.modoEditar = false;
      this.nota = {nombre: '', descripcion: ''};
    }
  }
}
</script>
