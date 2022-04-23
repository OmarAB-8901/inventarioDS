<template>

    <!-- Apartado para la visualizacion individual de los productos -->
    <div class="viewProducts" v-if="typeView=='products'">

        <div class="container" data-v="producto" v-if="viewDetail">

            <div class="row justify-content-center">

                <div class="container container_products">
                    <div class="row justify-content-center">
                        <div>
                            <a @click="cancelarAction()" class="primary" style="font-size: 1rem; margin-bottom: 0.5rem; cursor: pointer;"> <svg xmlns="http://www.w3.org/2000/svg" width="38" height="23" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg></a>
                        </div>

                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 1rem">

                    <div class="card-body borderProduct">

                        <div class="row justify-content-center">

                            <div class="col-md-3 justify-content-center showedProduct">
                                <img :src="imgUrl" alt="product_image" class="singleProductsImage" style="width: auto; height: 20rem;">
                            </div>

                            <div class="col-md-9 descriptionProduct">
                                <h5>{{producto.nombre}}</h5>
                                <p style="margin-bottom: 0 !important;">By
                                    <a href="https://www.apple.com/mx/" target="__blank">{{producto.nombre}}</a>
                                </p>

                                <div class="oneProduct" style="display: inline-flex;">

                                    <p style="margin-bottom: .5rem !important; margin-right:1rem; color: purple;">${{formatNumber(producto.precio)}}</p>

                                    <p class="clasificacion viewAllProducts" style="margin-bottom: 0 !important;">

                                        <label id="start1" for="start1">★</label>
                                        <label id="start2" for="start2">★</label>
                                        <label id="start3" for="start3">★</label>
                                        <label id="start4" for="start4">★</label>
                                        <label id="start5" for="start5">★</label>
                                    </p>

                                </div>

                                <p style="color: green;" v-if="producto.estado == 1">In Stock</p>
                                <p style="color: red;" v-else> No Disponible</p>

                                <h4>Descripción:</h4>
                                <p>{{producto.descripcion}}</p>
                                <hr>

                                <button type="button" @click="calificarProducto(producto.id)" class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg> Calificar</button>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div><!-- End view apartado detalle producto -->

        <!-- Apartado para la visualizacion de todos los productos registrado en la base de datos -->
        <div class="container" v-else>

            <div class="row justify-content-center">

                <div class="container container_products">
                    <div class="row justify-content-center">
                        <div>
                            <button @click="moduloRegistrar()" class="btn btn-primary" style="font-size: 1rem; margin-bottom: 0.5rem"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg></button>
                            <label for="" class="primary">inventario</label>
                        </div>

                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 1rem">

                    <div class="card-body borderProduct" v-for="(product, index) in productos" :key="index" style="margin-bottom: 1rem;">

                        <div class="row justify-content-center">

                            <div class="col-md-3 justify-content-center showedProduct showDetailProduct" @click="viewDetailProduct(product.id)">
                                <img :src="imgUrl" :class="imgClass" alt="product_image" style="width:auto; height: 10rem;">
                            </div>

                            <div class="col-md-6" style="border-right: 1px solid rgba(0, 0, 0, 0.125);">
                                <h5 >{{product.nombre}} <svg style="cursor:pointer; margin-right: 0.5rem;" @click="moduloEditar(product)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg> </h5>
                                <p style="margin-bottom: 0 !important;">By
                                    <a href="https://www.apple.com/mx/" target="__blank">{{product.nombre}}</a>
                                </p>

                                <p class="clasificacion viewAllProducts" style="margin-bottom: 0 !important;">
                                    <label id="start1" for="start1">★</label>
                                    <label id="start2" for="start2">★</label>
                                    <label id="start3" for="start3">★</label>
                                    <label id="start4" for="start4">★</label>
                                    <label id="start5" for="start5">★</label>
                                </p>

                                <p style="color: green;" v-if="product.estado == '1'">In Stock</p>
                                <p style="color: red;" v-else> No Disponible</p>

                                <div class="input-group mb-3" style="width: 18%;">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="button-minus">-</button>
                                    <input id="cantProducts" type="text" class="form-control form-control-sm"  value="0" style="text-align: center;">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" id="button-addon">+</button>
                                </div>
                            </div>

                            <div class="col-md-3 showedProduct">
                                <p style="margin-bottom: .5rem !important; color: purple;">${{formatNumber(product.precio)}}</p>
                                <span class="badge badge-success" style="margin-bottom: .5rem" v-if="product.estado == '1'"><p style="margin-bottom: 0.2rem; color: green;">Disponible</p></span>
                                <span class="badge badge-danger" style="margin-bottom: .5rem" v-else><p style="margin-bottom: 0.2rem; color: red;">No Disponible</p></span>

                                <div class="actionButtons">

                                    <button type="button" @click="Eliminar(product.id)" class="btn btn-secondary" style="margin-bottom: .5rem; width: 100%;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/> <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/></svg>Eliminar</button>
                                    <button type="button" @click="calificarProducto(product.id)" class="btn btn-primary" style="margin-bottom: .5rem;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg> Calificar</button>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div> <!--End View todos Productos -->

    <!-- Apartado para registrar ´y actualizar los productos -->
    <div class="registerNewProduct" v-else-if="typeView=='register'">

        <div class="container container_products">
            <div class="row justify-content-center">
                <div>
                    <a @click="cancelarAction()" class="primary" style="font-size: 1rem; margin-bottom: 0.5rem; cursor: pointer;"> <svg xmlns="http://www.w3.org/2000/svg" width="38" height="23" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg></a>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12" style="margin-top: 1rem">
                    <div class="card borderProduct">

                        <div class="card-header" v-if="!modoEditar">Registrar Producto</div>
                        <div class="card-header" v-else>Editar Producto</div>

                        <div class="card-body" v-if="!modoEditar">

                            <form @submit.prevent="registrarProducto()">

                                <div class="row justify-center">
                                    <div class="col-md-6">
                                        <label for="">SKU</label>
                                        <input type="text" class="form-control" name="sku" v-model="nuevoProducto.sku">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" v-model="nuevoProducto.nombre">
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-center">
                                    <div class="col-md-6">
                                        <label for="">id Categoría</label>
                                        <!-- <input type="text" class="form-control" name="idCategoria" v-model="nuevoProducto.categoria"> -->

                                        <select class="form-select" name="" id="idCategoria" v-model="nuevoProducto.categoria">
                                            <option value="">Seleccione una categoria</option>
                                            <option v-for="(categoria, index) in categorias" :key="index" :value="categoria.id">{{categoria.descripcion}}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" v-model="nuevoProducto.descripcion">
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-center">
                                    <div class="col-md-6">
                                        <label for="">Precio</label>
                                        <input type="text" class="form-control" name="precio" v-model="nuevoProducto.precio">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Cantidad</label>
                                        <input type="text" class="form-control" name="cantidad" v-model="nuevoProducto.cantidad">
                                    </div>
                                </div>
                                <hr>
                                <div class="row justify-content-xl-end" style="text-align: right; margin-top: 1rem">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>

                            </form>

                        </div> <!-- Termina modulo de registro de Producto -->

                        <div class="card-body" v-else>

                            <form @submit.prevent="actualizarProducto(nuevoProducto)">

                                <div class="row justify-center">
                                    <div class="col-md-6">
                                        <label for="">SKU</label>
                                        <input type="text" class="form-control" name="sku" v-model="nuevoProducto.sku">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" v-model="nuevoProducto.nombre">
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-center">
                                    <div class="col-md-6">
                                        <label for="">id Categoría</label>
                                        <!-- <input type="text" class="form-control" name="idCategoria" v-model="nuevoProducto.categoria"> -->

                                        <select class="form-select" name="" id="idCategoria" v-model="nuevoProducto.categoria">
                                            <option value="">Seleccione una categoria</option>
                                            <option v-for="(categoria, index) in categorias" :key="index" :value="categoria.id">{{categoria.descripcion}}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" v-model="nuevoProducto.descripcion">
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-center">
                                    <div class="col-md-6">
                                        <label for="">Precio</label>
                                        <input type="text" class="form-control" name="precio" v-model="nuevoProducto.precio">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Cantidad</label>
                                        <input type="text" class="form-control" name="cantidad" v-model="nuevoProducto.cantidad">
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-center">
                                    <div class="col-md-6">
                                        <label for="">In Stock</label>
                                        <!-- <input type="text" class="form-control" name="precio" v-model="nuevoProducto.stock"> -->

                                        <select class="form-select" name="" id="idCategoria" v-model="nuevoProducto.stock">
                                            <option value="0">No Disponible</option>
                                            <option value="1">Disponible</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row justify-content-xl-end" style="text-align: right; margin-top: 1rem">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Editar</button>
                                    </div>
                                </div>

                            </form>

                        </div> <!-- Termina modulo de editado de producto -->

                    </div>
                </div>
            </div>
        </div>
    </div><!-- End View registrar, actualizar productos -->

    <!-- Apaartado para calificacion de los productos -->
    <div class="qualifyProduct" v-else>

        <div class="container container_products">
            <div class="row justify-content-center">
                <div>
                    <a @click="cancelarAction()" class="primary" style="font-size: 1rem; margin-bottom: 0.5rem; cursor: pointer;"> <svg xmlns="http://www.w3.org/2000/svg" width="38" height="23" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg></a>
                </div>

            </div>
        </div>

        <div class="container container_products">
            <div class="row justify-content-center">
                <div class="col-md-12" style="margin-top: 1rem">

                    <div class="card-body borderProduct">

                        <div class="row justify-content-center">

                            <div class="col-md-4 justify-content-center showedProduct" style="border-right: 1px solid rgba(0, 0, 0, 0.125);">
                                <img :src="imgUrl" alt="product_image" class="singleProductsImage">
                            </div>

                            <div class="col-md-8 descriptionProduct" style="padding: 1.5rem">
                                <h5 style="margin-bottom: 2rem;">Calificacion del Apple Watch</h5>

                                <h6>Calidad Producto:</h6>
                                <div class="oneProduct">

                                    <p class="clasificacion viewDetailProducts" style="margin-bottom: 0 !important; font-size: 2rem;">

                                        <label id="start1" @click="realizarCalificacion(1, 'qualy1')" class="qualy1" for="start1">★</label>
                                        <label id="start2" @click="realizarCalificacion(2, 'qualy1')" class="qualy1" for="start2">★</label>
                                        <label id="start3" @click="realizarCalificacion(3, 'qualy1')" class="qualy1" for="start3">★</label>
                                        <label id="start4" @click="realizarCalificacion(4, 'qualy1')" class="qualy1" for="start4">★</label>
                                        <label id="start5" @click="realizarCalificacion(5, 'qualy1')" class="qualy1" for="start5">★</label>
                                    </p>

                                </div>

                                <h6>Calificacion 2:</h6>
                                <div class="oneProduct" style="display: inline-flex;">

                                    <p class="clasificacion viewDetailProducts" style="margin-bottom: 0 !important; font-size: 2rem;">

                                        <label id="start1" @click="realizarCalificacion(1, 'qualy2')" class="qualy2" for="start1">★</label>
                                        <label id="start2" @click="realizarCalificacion(2, 'qualy2')" class="qualy2" for="start2">★</label>
                                        <label id="start3" @click="realizarCalificacion(3, 'qualy2')" class="qualy2" for="start3">★</label>
                                        <label id="start4" @click="realizarCalificacion(4, 'qualy2')" class="qualy2" for="start4">★</label>
                                        <label id="start5" @click="realizarCalificacion(5, 'qualy2')" class="qualy2" for="start5">★</label>
                                    </p>

                                </div>

                                <h6>Calidficacion 3:</h6>
                                <div class="oneProduct" style="display: inline-flex;">

                                    <p class="clasificacion viewDetailProducts" style="margin-bottom: 0 !important; font-size: 2rem;">

                                        <label id="start1" @click="realizarCalificacion(1, 'qualy3')" class="qualy3" for="start1">★</label>
                                        <label id="start2" @click="realizarCalificacion(2, 'qualy3')" class="qualy3" for="start2">★</label>
                                        <label id="start3" @click="realizarCalificacion(3, 'qualy3')" class="qualy3" for="start3">★</label>
                                        <label id="start4" @click="realizarCalificacion(4, 'qualy3')" class="qualy3" for="start4">★</label>
                                        <label id="start5" @click="realizarCalificacion(5, 'qualy3')" class="qualy3" for="start5">★</label>
                                    </p>

                                </div>

                                <!-- <br> -->

                                <!-- <label for="">Comentarios:</label>
                                <textarea name="textArea" id="" rows="8" style="width: 100%; resize: none"></textarea>

                                <br>
                                <hr> -->

                                <!-- <div style="text-align: right;">

                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-danger">Cancelar</button>

                                </div> -->

                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div><!-- End View calificacion productos  -->

</template>

<script>
export default {

    data(){
        return{
            imgUrl: '../../../img/apple_watch.jpg',
            imgClass: "allProductsImage",
            productos: [],
            categorias: [],
            producto: {},
            nuevoProducto: {sku: '', nombre: '', categoria: '', descripcion: '', precio: '', cantidad: '', stock: ''},
            typeView: 'products',
            viewDetail: false,
            modoEditar: false
        }
    },

    /**
     * @author: Carlos Omar Anaya Barajas
     * @date: 2022-04-22 16:23:38
     * @param:
     * @return:
     * @desc:
    */
    created(){

        this.getDataProducts();
    },

    methods:{

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        formatNumber(numberToFormat){

            let numberFormat = Intl.NumberFormat('es-MX');
            return numberFormat.format(numberToFormat);
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        getDataProducts(){

            axios.get('/inventario/getProducts').then(res=>{

                this.typeView = 'products';
                this.viewDetail = false;
                this.modoEditar = false;
                this.productos = res.data[0];
                this.categorias = res.data[1];
            });
        },
        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        viewDetailProduct(id){

            this.viewDetail = true;

            axios.get(`inventario/getProduct/${id}`).then(res=>{

                this.producto = res.data[0];
            });
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        moduloRegistrar(){

            this.modoEditar = false;
            this.typeView = 'register';
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        registrarProducto(){

            const dataProduct = this.nuevoProducto;
            this.nuevoProducto = {sku: '', nombre: '', categoria: '', descripcion: '', precio: '', cantidad: '', stock: '', id: ''};

            axios.post(`/inventario/saveProducts`, dataProduct)
                .then(()=>{
                    this.getDataProducts();
            });
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        moduloEditar(producto){

            this.nuevoProducto.sku = producto.sku;
            this.nuevoProducto.nombre = producto.nombre;
            this.nuevoProducto.categoria = producto.id_categoria;
            this.nuevoProducto.descripcion = producto.descripcion;
            this.nuevoProducto.precio = producto.precio;
            this.nuevoProducto.cantidad = producto.cantidad;
            this.nuevoProducto.precio = producto.precio;
            this.nuevoProducto.stock = producto.estado;
            this.nuevoProducto.id = producto.id;

            this.modoEditar = true;
            this.typeView = 'register';
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        actualizarProducto(nuevoProducto){

            const dataProduct = this.nuevoProducto;
            this.nuevoProducto = {sku: '', nombre: '', categoria: '', descripcion: '', precio: '', cantidad: '', stock: ''};

            axios.put(`/inventario/updateProducts/${nuevoProducto.id}`, dataProduct)
                .then(()=>{
                    this.getDataProducts();
            });
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        Eliminar(id){

            const confirmacion = confirm(`Eliminar producto`);

            if(confirmacion){
                axios.delete(`inventario/deleteProducts/${id}`)
                .then(()=>{

                    this.getDataProducts();
                });
            }
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        cancelarAction(){

            this.typeView = 'products';
            this.viewDetail = false;
        },

        /**
         * @author: Carlos Omar Anaya Barajas
         * @date: 2022-04-22 16:23:38
         * @param:
         * @return:
         * @desc:
        */
        calificarProducto(){

            this.typeView = 'calificar';

            // axios.get(`inventario/getProduct/${id}`).then(res=>{

            //     this.producto = res.data[0];
            // });
        },

        realizarCalificacion(starNum, classQualy){

            let starts = document.getElementsByClassName(classQualy);
            let totStart = starNum;

            for(let i=(totStart-1); i >= 0; i++){

                starts[i].classList.add('startSelected');
                // console.log(starts[i]);
            }

        },
    },
}
</script>
