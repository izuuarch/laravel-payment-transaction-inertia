<script setup>
import AppLayout from "../Layouts/Applayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
const form = useForm({
 payment_name: '',
 payment_amount: '',
 payment_description: '',
 card_number: '',
 card_cvc: '',
 card_expiry_month: '',
 card_expiry_year: '',
 userid:'',
});
const submit = () => {
    form.post(route('pay'), {
        
    });
};
defineProps({

});
</script>
<template>
    <AppLayout>
        <div class="d-flex justify-content-center">
    <div class="col-md-6">
        <form @submit.prevent="submit">
            <!-- <input type="hidden"  v-model="form.userid"> -->
            <div class="form-group">
                <label>Payment Name</label>
                <input class="au-input au-input--full form-control" type="text" v-model="form.payment_name">
            </div>
         
            <div class="form-group">
                <label>Payment Amount</label>
                <input class="au-input au-input--full form-control" type="text" v-model="form.payment_amount">
            </div>
            <div class="form-group">
                <label>Payment Description</label>
                <input class="au-input au-input--full form-control" type="text"  v-model="form.payment_description">
            </div>
            <div class="form-group">
                <label>Card Number</label>
                <input class="au-input au-input--full form-control" type="number" v-model="form.card_number">
            </div>
            <div class="form-group">
                <label>Card CVC</label>
                <input class="au-input au-input--full form-control" type="number" v-model="form.card_cvc">
            </div>
            <div class="form-group">
                <label>Expiry Month</label>
                <input class="au-input au-input--full form-control" type="number" v-model="form.card_expiry_month">
            </div>
            <div class="form-group">
                <label>Expiry Year</label>
                <input class="au-input au-input--full form-control" type="number" v-model="form.card_expiry_year">
            </div>
            <button class="au-btn au-btn--block au-btn--green m-b-20 btn btn-block" type="submit" style="background: black; color:white;">pay</button>
            <Link :href="route('payment')">Go back</Link>
        </form>
    </div>
</div>
    </AppLayout>

</template>