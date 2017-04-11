<template>
    <div>
        <h1>Purchases</h1>
        <div>
            <template v-if="!purchases.length">
                There are no purchase, yet :(
            </template>
            <template v-else>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Offering title</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="purchase in purchases">
                            <td>{{ purchase.id }}</td>
                            <td>{{ purchase.offering.title }}</td>
                            <td>{{ purchase.quantity }}</td>
                            <td>{{ purchase.offering.price }}$</td>
                            <td>{{ purchase.total_price }}$</td>
                        </tr>
                    </tbody>
                </table>
            </template>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                purchases: []
            }
        },
        mounted() {
           this.fetch();
        },
        methods: {
            fetch() {
                axios.get('/api/purchases')
                    .then(response => {
                        this.purchases = response.data
                    })
                    .catch(() => {
                        swal("Oops...", "Something went wrong!", "error");
                    });
            }
        }
    }
</script>
