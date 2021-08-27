import App from '../library/superApp.js'
import cache from '../library/cache.js'
const Super = new App

export default {
    template: "#c-planos",
    data: function () {
        return {
            Super,
            cache,
            institution_id: null,
            planos: [],
        }
    },
    methods: {
        async apagar(id) {
            this.Super.plano_put(id, {
                institution_id: this.institution_id,
                status: 'inactive'
            })
        },
        async status(id, status) {
            let playload = {
                status: status ? 0 : 1
            }
            let res = await this.Super.plano_put(id, playload)
        }
    },
    async mounted() {
        this.institution_id = this.cache.institution
        let res = await this.Super.plano_get_by_institution(this.institution_id)
        this.planos = res
    },
    filters: {
        is_price(price) {
            let valor = (price/100).toLocaleString('pt-br', { minimumFractionDigits: 2 })
            return `R$ ${valor}`
        }
    }
}


