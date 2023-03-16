<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <router-link to="/customer" class="navbar-brand" aria-current="page">BerkatSoft Tes</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link to="/customer" class="nav-link" aria-current="page">Customer</router-link>
                        <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                    </li>
                    <li class="nav-item">
                        <router-link to="/product" class="nav-link" aria-current="page">Product</router-link>
                        <!-- <a class="nav-link" href="#">Features</a> -->
                    </li>
                    <li class="nav-item">
                        <router-link to="/sales-order" class="nav-link" aria-current="page">Sales Order</router-link>
                        <!-- <a class="nav-link" href="#">Pricing</a> -->
                    </li>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <button class="btn btn-warning" href="#" @click.prevent="logout()">Logout</button>

                        </li>
                    </ul>

                </ul>

            </div>
            
            
        </div>
    </nav>
</template>
<script>
export default {
    name: "Logout",
    methods: {
        logout() {
            axios.post('/logout').then((response) => {
                window.location.href = '/login';

            }).catch((error) => {
                console.log(error)

            }
            )
        }
    }
}
</script>