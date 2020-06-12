<template>
    <div>
        <div class="row">
            <p class="float-left text-info ">
                Rates on : {{ baseCurrency.pubDate }}
            </p>
        </div>

        <div v-if="loading" class="alert">
            <div class="spinner-border text-success text-center" role="status">
                <span class="sr-only ">Loading...</span>
            </div>
        </div>

        <div v-else class="card">
            <div class="card-header bg-secondary">
                <!-- Original header -->
                <h5 v-if="!reversed" class="card-title text-center">
                    <span v-if="isNaN(result)" class="text-warning"
                        >Please add amount</span
                    >
                    <span v-else-if="!result" class="text-warning">
                        Please add amount
                    </span>
                    <span v-else class="text-warning">
                        <span class="badge-info rounded p-2 mr-2">
                            {{ amount }} </span
                        >{{ base }} =
                        <span class="badge-success p-2 mr-2 rounded ">
                            {{ result }}
                        </span>
                        {{ target }}
                    </span>
                </h5>
                <!-- Reversed header-->
                <h5 v-else class="card-title text-center">
                    <span v-if="isNaN(result)" class="text-warning"
                        >Now add amount</span
                    >
                    <span v-else-if="!result">
                        Please add amount
                    </span>
                    <span v-else class="text-warning">
                        <span class="float-right text-warning rounded">
                            Reversed
                        </span>
                        <span class="badge-info p-2 mr-2 rounded">
                            {{ amount }} </span
                        >{{ target }} =
                        <span class="badge-success p-2 mr-2">
                            {{ result }}
                        </span>
                        {{ base }}
                    </span>
                </h5>
            </div>
            <div v-if="amount">
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <tr>
                            <th>Rate :</th>
                            <td>1 {{ base }} = {{ rate }} {{ target }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div v-if="rates" class="mt-4">
            <div class="form-group">
                <label for="amount" class="font-weight-bold"> Amount </label>
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
                <label for="base" class="font-weight-bold"> From </label>
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
                <label for="target" class="font-weight-bold"> To </label>

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
        </div>

        <div v-if="amount" class="alert">
            <button
                v-if="!reversed"
                class="btn btn-info float-right"
                @click="reverse"
            >
                Reverse
            </button>
            <button v-else class="btn btn-info float-right" @click="reverse">
                Original
            </button>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            baseCurrency: {},
            base: "EGP",
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
            this.rate = this.baseCurrency.exchangeRate;
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
