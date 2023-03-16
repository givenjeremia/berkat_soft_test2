<template>
    <div class="container-fluid p-3">
        <h3>Product</h3>
        <button @click="modal_input = true" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModalTambah">
            Tambah Product
        </button>

        <div class=" pt-3">

            <table id="datatable" class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody v-if="!isEmptyProducts">


                    <tr v-for="product, key in products">

                        <th scope="row">{{ key + 1 }}</th>
                        <td>{{ product.nama }}</td>
                        <td>{{ product.qty }}</td>
                        <td>{{ product.harga }}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModalEdit" class="btn btn-primary" href=""
                                @click.prevent='detailEdit(product.id)'><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                </svg></a>
                            <a class="btn btn-danger" href="" @click.prevent='hapusProduct(product.id)'><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg></a>

                        </td>
                    </tr>


                </tbody>
            </table>

        </div>
        <!-- Modal Tambah -->
        <div v-show="modal_input">

            <div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" @submit.prevent="tambahdata">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Product</label>
                                    <input type="text" class="form-control" id="nama" v-model="dataFormTambah.nama"
                                        required>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">QTY</label>
                                    <input type="number" class="form-control" id="qty" v-model="dataFormTambah.qty">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="qty" v-model="dataFormTambah.harga">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button id="close" type="button" class="btn btn-secondary" @click="modal_input = false"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit -->
        <div>

            <div   class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <div v-if="product.length > 0" >
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" @submit.prevent="editdata">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Product</label>
                                    <input type="text" class="form-control" id="nama" v-model="dataFormEdit.nama"  required>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">QTY</label>
                                    <input type="number" class="form-control" id="qty" v-model="dataFormEdit.qty">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="qty" v-model="dataFormEdit.harga">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button id="closeEdit" type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- <newproduk-component></newproduk-component> -->
</template>

<script>

import "jquery/dist/jquery.min.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import axios from "axios";
import $ from "jquery";
import Test from './Test.vue'

export default {

    props: ['id'],
    data() {
        return {
            products: [],
            product: [],
            dataFormTambah: {
                nama: '',
                qty: '',
                harga: '',

            },
            dataFormEdit: {
                nama: '',
                qty: '',
                harga: '',

            },
            modal_input: false,
            raw_edit: ''

        }
    },
    components: {
        Test
    },
    mounted() {
        // console.log('Component mounted.')
        // $("#datatable").DataTable()
        this.getProduct()
        console.log(this.$refs)

    },

    methods: {
        getProduct() {
            axios.get('/api/product').then((response) => {
                // console.log(response)
                this.products = response.data
                this.$nextTick(function() {
                    this.initDt()
                });

            })
        },
        initDt() {
            $('#datatable').DataTable({
                // destroy: true,
                retrieve: true,
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });    
        },
        detailProduct(id_pro) {

            axios.get('/api/product/' + id_pro).then((response) => {
                console.log(response.data);
                this.product = response.data
            })

        },
        detailEdit(id_pro) {
            axios.get('/api/product/' + id_pro).then((response) => {
                console.log(response.data);
                this.product.splice(0)
                this.product.push(response.data)
                this.dataFormEdit.nama = response.data.nama
                this.dataFormEdit.qty = response.data.qty
                this.dataFormEdit.harga = response.data.harga
            })
            
        },

        tambahdata() {
            // console.log(this.dataFormTambah)
            axios.post('/api/product/', this.dataFormTambah).then((response) => {
                if (response.data.status) {
                    alert(response.data.msg)
                    $("#exampleModalTambah #close").click()
                    this.getProduct()
                    // this.$router.go(0)
                    this.dataFormTambah.nama = ''
                    this.dataFormTambah.qty = ''
                    this.dataFormTambah.harga = ''
                }
                else {
                    alert(response.data.msg)
                    this.$router.go(0)

                }

            }).catch((error) => {
                console.log(error)

            }
            )
        },
        editdata() {
            // console.log(this.product[0]['id']);
            axios.put('/api/product/'+this.product[0]['id'], this.dataFormEdit).then((response) => {
                console.log(response)
                if (response.data.status) {
                    alert(response.data.msg)
                    $("#exampleModalEdit #closeEdit").click()
                    this.getProduct()
           
                }
                else {
                    alert(response.data.msg)
                    this.$router.go(0)

                }

            }).catch((error) => {
                console.log(error)

            }
            )
        },
        hapusProduct(id) {
            // alert(id);
            axios.delete('/api/product/' + id).then((response) => {
                alert("Data Produk Berhasil Di Hapus")

                this.getProduct()

            }).catch((error) => {
                console.log(error)
                this.getProduct()

            }
            )
        },


    },
    computed: {
        isEmpty: function () {
            return $.isEmptyObject(this.product)
        },
        isEmptyProducts: function () {
            return $.isEmptyObject(this.products)
        }
    }


}
</script>
