<template>
    <div class="summaries">
        <div class="container">
            <div class="row">
                <div class="col m4 s1 l4">
                    <div class="summary red darken-3 z-depth-4">
                        <div class="header">
                            <h1><span class="fa fa-balance-scale"></span> {{ totalProducts}}</h1>
                        </div>
                        <hr>
                        <div class="footer right-align">
                            <p>Total Products</p>
                        </div>
                    </div>
                </div>

                <div class="col m4 s1 l4">
                    <div class="summary blue lighten-2 z-depth-4">
                        <div class="header">
                            <h1><span class="fa fa-balance-scale"></span> {{ totalBatches}}</h1>
                        </div>
                        <hr>
                        <div class="footer right-align">
                            <p>Total Batches</p>
                        </div>
                    </div>
                </div>

                <div class="col m4 s1 l4">
                    <div class="summary green accent-2 z-depth-4">
                        <div class="header">
                            <h1><span class="fa fa-balance-scale"></span> {{ expired}}</h1>
                        </div>
                        <hr>
                        <div class="footer">
                            <p class="left">Value: &#8358;{{expireVal}}</p>
                            <p class="right">Products Expiring Soon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from 'moment';
    export default {
        name: "SummaryComponent",
        data(){
            return {
                totalProducts:0,
                totalBatches:0,
                expired:0,
                expireVal:0,
            }
        },
        methods:{
            getSummary(){
                axios.get(url+'products').then(res=>{
                    this.totalProducts = res.data.length;

                    let products= res.data.filter(product=>{
                        return moment(product.expiry_date).isSameOrBefore(moment().add(30,'d'))

                    });
                    this.expired = products.length;
                    products.forEach(p=>{
                        this.expireVal+=p.price;
                    })
                });

                axios.get(url+'batches').then(res=>{
                    this.totalBatches = res.data.length
                })
            }
        },
        created(){
            this.getSummary();
        }
    }
</script>

<style scoped>

</style>