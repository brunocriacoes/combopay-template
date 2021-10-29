import App from '../library/superApp.js'
import cache from '../library/cache.js'
import Domain from '../library/Domain.js'

const Super = new App
export default {
    template: "#c-edit-modulo",
    data: function () {
        return {
            Super,
            cache,
            Domain,
            form: {
                host_smtp: null,
                port: null,
                email: null,
                senha: null,
                name: null
            
            },
            title: 'Configurar E-mail',
            flag: 'PHP_MAILER',
            loading: false,
            is_flag: false,
            id: null,
            user: {
                credencial: null
            },
            autoForm: [
                { label: 'Host SMTP', name: 'host_smtp' },
                { label: 'Porta', name: 'port' },
                { label: 'E-mail', name: 'email' },
                { label: 'Senha', name: 'senha' },
                { label: 'Nome', name: 'name' },
            ],
            error: {
                status: false,
                text: 'Salvo com sucesso',
                type: 'success'
            },
        }
    },
    async mounted() {
        this.user = await this.Super.get_admin(this.cache.user_logged_id)
        this.load()

    },
    methods: {
        async create_flag() {
            let playload = {
                base64: btoa(JSON.stringify({})),
                flag: this.flag,
                instituicao_id: this.cache.institution
            }
            return await this.Super.flag_post(playload)
        },
        async load() {
            let smtp = await this.Super.get_smtp(this.cache.institution)
            this.form.host_smtp = smtp.host || null
            this.form.port = smtp.porta || null
            this.form.email = smtp.usuario || null
            this.form.senha = smtp.senha || null
            this.form.name = smtp.nome || null
            

        },
        async save() {
            this.loading = true
            let playload = {
                base64: btoa(JSON.stringify(this.form)),
                flag: this.flag,
                instituicao_id: this.cache.institution
            }
            let payload = { 
                instituicao_id: this.cache.institution,
                 host_smtp: this.form.host_smtp,
                 port: this.form.port, 
                 email: this.form.email, 
                 senha: this.form.senha, 
                 name: this.form.name
                }

            let res = await this.Super.save_smtp(payload)
            this.error.status = true
            this.error.text = res.message
            this.error.type = res.status
            this.loading = false

        },
        async pular() {
            localStorage.setItem('user_logged_credential_id', 19)
            await this.Super.put_admin(this.user.id, {
                credencial: 19
            }) 
            window.location.href = '#/modelo-de-emails'            
        }
    }
}