<template>
    <div>
        <p>Rate = {{ rate }}</p>
        <p>Base = {{ base }}</p>
        <p>target= {{ target }}</p>
        <p>result= {{ result }}</p>

        <div v-if="loading" class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <form method="get" action="" @submit.prevent="getRates">
            <div class="form-group">
                <label for="amount"> Amount </label>
                <input
                    type="number"
                    class="form-control"
                    placeholder="amount"
                    name="amount"
                    id="amount"
                    value="10"
                    v-model="amount"
                    @keyup="calculate"
                    @input="calculate"
                />
            </div>
            <div class="form-group">
                <label for="base"> From </label>
                <select
                    class="form-control"
                    name="base"
                    id="base"
                    v-model="base"
                    @change="recallApi"
                >
                    <option value=""> select target currency</option>
                    <option value="GBP">GBP</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="EGP">EGP</option>
                </select>
            </div>

            <div class="form-group">
                <label for="target"> To </label>

                <select
                    class="form-control"
                    name="target"
                    id="target"
                    v-model="target"
                    @change="calculate"
                >
                    <option value=""> select target currency</option>
                    <option value="GBP">GBP</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="EGP">EGP</option>
                </select>
            </div>
            <div class="alert">
                <button class="btn btn-info float-right" type="submit">
                    Reverse
                </button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            base: "GBP",
            target: "",
            amount: null,
            rates: [],
            rate: "",
            loading: false,
            result: ""
        };
    },
    methods: {
        async callApi() {
            const url = `rates/${this.base.toLowerCase()}`;
            const res = await fetch(url);
            const data = await res.json();
            this.rates = data;
            console.log(this.rates);
        },
        getRate() {
            let targetCurrency = this.rates.filter(rate => {
                return this.target == rate.targetCurrency;
            });
            console.log("GetRateCalled");
            return (this.rate = targetCurrency[0].exchangeRate);
        },

        async recallApi() {
            this.loading = true;
            await this.callApi();
            await this.getRate();
            this.loading = false;
            this.result = (parseInt(this.amount) * this.rate).toFixed(2);
        },
        async calculate() {
            await this.getRate();
            this.result = (parseInt(this.amount) * this.rate).toFixed(2);
        }
    },
    mounted() {
        this.callApi();
        console.log("Component mounted.");
    }
};
</script>
