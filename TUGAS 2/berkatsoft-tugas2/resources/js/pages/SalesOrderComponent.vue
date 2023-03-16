<template>
    <div class="container-fluid p-3">
        <h3>Sales Order</h3>
        <button @click="modal_input = true" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModalTambah">
            Tambah Order
        </button>

        <div class=" pt-3">

            <table id="datatable" class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total</th>
                        <th scope="col">Product</th>
                    </tr>
                </thead>
                <tbody>


                    <tr v-for="salesorder, key in salesorders">

                        <th scope="row">{{ key + 1 }}</th>
                        <td>{{ salesorder['customer_nama']}}</td>
                        <td>{{ salesorder['tanggal'] }}</td>
                        <td>{{ salesorder['total_harga'] }}</td>
                        <td>
                            <ul>
                                <li v-for="item in salesorder['products']">{{ item['nama'] }} - {{ item['qty'] }}</li>
                            </ul>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" @submit.prevent="tambahdata">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Customer</label>
                                    <select class="form-control" name="customer" v-model="dataFormTambah.customer_id">
                                        <option> Pilih Customer</option>
                                        <option v-show="customers" v-for="item in customers" :value="item['id']"> {{
                                            item['nama'] }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Product</label>
                                    <div class="row justify-content-between">
                                        <div class="col">
                                            <select class="form-control" name="product" v-model="selected_product_id">
                                                <option> Pilih Produk</option>
                                                <option v-for="item in products" :value="item['id']"> {{ item['nama'] }}
                                                </option>
                                            </select>
                                            <label for="exampleInputPassword1" class="form-label">Qty</label>
                                            <input type="number" class="form-control" id="qty" v-model="selected_product_qty">
                                        </div>
                                        <br>
                                        <div class="col">
                                            <button type="button" class="btn btn-secondary" @click="tambahlist">Tambah
                                                Produk</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Lis Tambah Produk -->
                                <div v-if="dataFormTambah.products" class="mb-3">
                                    <ol class="list-group list-group-numbered" >
                                        <li class="list-group-item" v-for="item in dataFormTambah.products" >{{ item['nama'] }} - {{ item['qty'] }}</li>
                                    </ol>

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
            salesorders:[],
            customers: [],
            products: [],
            product: [],
            selected_product_id: 'Pilih Produk',
            selected_product_qty: '',
            dataFormTambah: {
                customer_id: 'Pilih Customer',
                products: [],

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
        this.getSalesOrders()
        this.getProduct()
        this.getCustomers()
        
    },

    methods: {
        getSalesOrders() {
            axios.get('/api/sales-order').then((response) => {
                // console.log(response)
                this.salesorders = response.data
                console.log(this.salesorders)
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
        getCustomers() {
            axios.get('/api/customer').then((response) => {
                // console.log(response)
                this.customers = response.data

            })
        },
        getProduct() {
            axios.get('/api/product').then((response) => {
                // console.log(response)
                this.products = response.data

            })
        },
        tambahlist() {
            if (this.selected_product_id !== "Pilih Produk" && this.selected_product_qty !== '') {
                axios.get('/api/product/' + this.selected_product_id).then((response) => {
                    let data = {
                        'id':response.data['id'],
                        'nama':response.data['nama'],
                        'harga':response.data['harga'],
                        'qty':this.selected_product_qty
                    }
                
                    
                    this.dataFormTambah.products.push(data)
                    // console.log(this.dataFormTambah);

                })

                // console.log(this.selected_product)
            }

        },


        tambahdata() {
            console.log(this.dataFormTambah)
            axios.post('/api/sales-order/', this.dataFormTambah).then((response) => {
                console.log(response)
                if (response.data.status) {
                    alert(response.data.msg)
                    $("#exampleModalTambah #close").click()
                    this.getSalesOrders()
                    this.dataFormTambah.customer_id = 'Pilih Customer'
                    this.selected_product_id = 'Pilih Produk'
                    this.selected_product_qty = ''
                    this.dataFormTambah.products.splice(0)
                }
                else {
                    alert(response.data.msg)

    
                }

            }).catch((error) => {
                console.log(error)

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
