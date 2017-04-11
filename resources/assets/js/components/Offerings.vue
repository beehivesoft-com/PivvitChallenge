<template>
    <div>
        <h1>Offerings</h1>
        <div>
            <template v-if="!offerings.length">
                There are no offerings, yet :(
            </template>
            <template v-else>
                <form @onsubmit.prevent="save()">
                    <div class="form-group">
                        <label for="customer_name">Customer Name:</label>
                        <input type="text" class="form-control" id="customer_name">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="text" class="form-control" id="quantity">
                    </div>
                    <div class="form-group">
                        <label for="offering_id">Quantity:</label>
                        <select id="offering_id">
                            <!--<option v-for="offering as offerings">-->
                                <!--{{ offering.title }} {{ offering.price }}$-->
                            <!--</option>-->
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

    export default {
        data() {
            return {
                offerings: []
            }
        },
        mounted() {
            this.fetch();
        },
        methods: {
            fetch() {
                let self = this;

                axios.get('/api/offerings')
                    .then(function (response) {
                        self.offerings = response.data
                    })
                    .catch(function (error) {
                        alert(error);
                    });
            },
            save() {

            }
        }
    }
</script>
