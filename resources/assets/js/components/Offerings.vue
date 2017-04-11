<template>
    <div>
        <h1>Offerings</h1>
        <div>
            <template v-if="!offerings.length">
                There are no offerings, yet :(
            </template>
            <template v-else>
                <form @submit.prevent="save()">
                    <div class="form-group">
                        <label for="customer_name">Customer Name:</label>
                        <input v-model.trim="customer_name" placeholder="Enter customer name..." type="text" class="form-control" id="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input @change="castToInt" v-model.number="quantity" placeholder="Enter quantity..." type="number" class="form-control" id="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="offering_id">Quantity:</label>
                        <select v-model="offering_id" id="offering_id" class="form-control" required>
                            <option v-for="element in offerings" v-bind:value="element.id">
                                {{ element.title }} {{ element.price }}$
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </template>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import swal from 'sweetalert'
    import _ from 'lodash'

    export default {
        data() {
            return {
                offering_id: null,
                customer_name: null,
                price: 0,
                quantity: 0,
                offerings: []
            }
        },
        mounted() {
            this.fetch();
        },
        methods: {
            castToInt() {
                let parsed = parseInt(this.quantity);

                if (isNaN(parsed)) {
                    this.quantity =  0;
                } else {
                    this.quantity = parsed;
                }
            },
            fetch() {
                axios.get('/api/offerings')
                    .then(response => {
                        this.offerings = response.data
                    })
                    .catch(() => {
                        swal("Oops...", "Something went wrong!", "error");
                    });
            },
            save() {
                if (!this.customer_name || !this.offering_id || !this.quantity) {
                    swal("Oops...", "Fill all fields, please!", "error");
                }

                if (this.quantity < 1) {
                    swal("Oops...", "Quantity mast be greater than 0!", "error");
                }

                let payload = {
                    customer_name: this.customer_name,
                    offering_id: this.offering_id,
                    quantity: this.quantity
                };

                axios.post('/api/purchases', payload)
                    .then(() => {
                        swal("Hooray!", "Purchase have been successfully created!", "success");
                    })
                    .catch(()  => {
                        swal("Oops...", "Something went wrong!", "error");
                    });
            }
        }
    }
</script>
