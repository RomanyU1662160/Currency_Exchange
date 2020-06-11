<template>
    <div>
        <p>Rate = {{ rate }}</p>
        <p>Base = {{ base }}</p>
        <p>target= {{ target }}</p>
        <p>result= {{ result }}</p>

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
                    @focus="calculate"
                />
                {{ amount }}
            </div>
            <div class="form-group">
                <label for="base"> From </label>
                <select
                    class="form-control"
                    name="base"
                    id="base"
                    v-model="base"
                    @change="Calculate"
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
                    Calculate
                </button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            base: "",
            target: "",
            amount: null,
            rates: [],
            rate: "",
            result: ""
        };
    },
    methods: {
        callApi() {
            try {
                axios
                    .get(`rates/${this.base}`)
                    .then(res => (this.rates = res.data))
                    .then(console.log("api called"));
            } catch (error) {
                console.log(erorr);
            }
        },
        getRate() {
            let targetCurrency = this.rates.filter(rate => {
                return rate.targetCurrency == this.target;
            });
            console.log("GetRateCalled");
            this.rate = targetCurrency[0].exchangeRate;
        },
        calculate() {
            this.callApi();
            this.getRate();
            console.log("calcluate called");
            return (this.result = parseInt(this.amount) * this.rate);
        }
    },
    mounted() {
        console.log("Component mounted.");
        console.log("amount:>>", typeof this.base);
    }
};
</script>
