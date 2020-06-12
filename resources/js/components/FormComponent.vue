<template>
    <div>
        <div class=" bg-info">
            <div v-if="!loading" class=" alert border">
                <div v-if="reversed">
                    <h3 class="test-info">Reversed</h3>
                    <p>Rate = {{ rate }}</p>
                    <p>Base = {{ target }}</p>
                    <p>target= {{ base }}</p>
                    <p v-if="isNaN(result)">result = Now add amount</p>
                    <p v-else-if="!result">result = Please complete the form</p>
                    <p v-else>result= {{ result }}</p>
                </div>
                <div v-else>
                    <h3 class="test-info">Original</h3>

                    <p>Rate = {{ rate }}</p>
                    <p>inverseRate = {{ baseCurrency.inverseRate }}</p>
                    <p>Base = {{ revirsed ? target : base }}</p>
                    <p>target= {{ revirsed ? base : target }}</p>
                    <p v-if="isNaN(result)">result = Now add amount</p>
                    <p v-else-if="!result">result = Please complete the form</p>
                    <p v-else>result= {{ result }}</p>
                </div>
            </div>
            <div
                v-else-if="loading"
                class="spinner-border text-success"
                role="status"
            >
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <span class="sr-only">{{ result }}</span>
            </div>
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
                    @change="resetBase"
                >
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
                    <option value="GBP">GBP</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="EGP">EGP</option>
                </select>
            </div>
        </form>
        <div class="alert">
            <button class="btn btn-info float-right" @click="reverse">
                Reverse
            </button>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            baseCurrency: {},
            base: "GBP",
            target: "USD",
            amount: null,
            rates: [],
            rate: "",
            loading: false,
            result: null,
            reversed: false
        };
    },
    methods: {
        async callApi() {
            const url = `rates/${this.base.toLowerCase()}`;
            const res = await fetch(url);
            const data = await res.json();
            this.rates = data;
            await this.setBaseCurrency();
            console.log(this.baseCurrency);
        },

        setBaseCurrency() {
            let Currency = this.rates.map(rate => {
                rate.baseCurrency == this.base
                    ? (this.baseCurrency = rate)
                    : {};
            });
        },

        async resetBase() {
            this.loading = true;
            await this.callApi();
            await this.getRate();
            this.loading = false;
            this.result = (parseInt(this.amount) * this.rate).toFixed(2);
        },

        getRate() {
            let targetCurrency = this.rates.filter(rate => {
                return this.target == rate.targetCurrency;
            });
            console.log("GetRateCalled");
            return this.reversed
                ? (this.rate = targetCurrency[0].inverseRate)
                : (this.rate = targetCurrency[0].exchangeRate);
        },

        getReverseRate() {
            let targetCurrency = this.rates.filter(rate => {
                return this.target == rate.targetCurrency;
            });

            console.log("GetRateCalled");
            return (this.rate = targetCurrency[0].inverseRate);
        },

        calculate() {
            this.getRate();
            this.result = (parseInt(this.amount) * this.rate).toFixed(2);
            console.log("calclulate called  :>>");
        },

        reverse() {
            this.reversed = !this.reversed;
            this.getRate();
            this.calculate();
        }
    },
    mounted() {
        this.callApi();
        console.log("Component mounted.");
    }
};
</script>
