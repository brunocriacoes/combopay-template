import Vue from './library/vue.js'
import SuperApp from './library/SuperApp.js'
import Domain from './library/Domain.js'
import cache from './library/cache.js'

const Super = new SuperApp
globalThis.app = new Vue({
    data: {
        Super,
        Domain,
        cache,
        institution_id: null,
        loading: false,
        title: 'Betania',
        logo: {
            top: './sass/doacoesbethania.com.br/logo/2.png',
            footer: './sass/doacoesbethania.com.br/logo/1.png'
        },
        backgroundColor: '#25b3c2',
        header: {
            align: '',
            backgroundColor: '#25b3c2',
            backgoundImage: './sass/doacoesbethania.com.br/galery/1.jpg',
        },
        urlVideo: 'https://www.youtube.com/watch?v=H-GrnWRc2i4',
        videos: [],
        depoimento_video: [],
        galerys: [],
        layout: {
            title_depoimento: "?",
            title_video: "?",
            title_galeria: "?",
            decription_galeria: "?",
            sitacao: "?",
            bio: "?",
            copy: "?",
            logo_topo: '',
            color: '#C00',
            logo: 'default',
            image_1: 'default.png',
            image_2: 'default.png',
            image_3: 'default.png',
            image_4: 'default.png',
            image_5: 'default.png',
            image_6: 'default.png',
            bg_top: 'default.png',
            bg_footer: 'default.png',
        },
        galery_title: null,
        pop_id: 'QpxA_ZxGX_M',
        pop_status: false,
        footer: {
            color: '#FFFFFF',
            backgroundColor: '#25b3c2'
        },
        institution: {},
        flags: [],
        flagsIds: {},
        error: {
            status: false,
            text: 'error ao finalizar tente novamente mais tarde'
        },
        doacao: {
            recorrente: 1,
            amount: '5000',
            amount_custon: 0,
            nome: 'Bruno',
            sobrenome: 'Vieira',
            dataNascimento: '1987-09-18',
            email: 'br.rafael@outlook.com',
            telefone: '11999998888',
            cpf: '76537741807',
            cep: '06786270',
            rua: '',
            numero: '45',
            bairro: '',
            estado: '',
            cidade: '',
            card: "4111111111111111",
            validade: "0922",
            cvv: "123",
            nome_card: "Morpheus Fishburne",
            payment_type: 'card',
            complemento: 'nao definido',
        },

    },
    methods: {
        preview(e) {
            let input = e.target
            let name = e.target.getAttribute('data-name')
            var reader = new FileReader();
            reader.onload = async (e) => {
                this.loading = true
                this.logo = e.target.result
                let res = await this.Super.upload(this.institution_id, input.files[0])
                this.layout[name] = res.nomeImagem
                await this.Super.flag_put(this.flagsIds.LAYOUT, {
                    base64: btoa(JSON.stringify(this.layout)),
                    flag: 'LAYOUT',
                    instituicao_id: this.institution_id
                })
                this.loading = false
            }
            reader.readAsDataURL(input.files[0]);
        },
        error_image(e) {
            e.target.src = './assets/img/default.png'
        },
        async add_galery() {
            let input = this.$refs.image_galery
            this.loading = true
            let res = await this.Super.upload(this.institution_id, input.files[0])
            let playload = {
                src: res.nomeImagem,
                title: this.galery_title,
            }
            this.galerys.push(playload)
            await this.Super.flag_put(this.flagsIds.GALERIA, {
                base64: btoa(JSON.stringify(this.galerys)),
                flag: 'GALERIA',
                instituicao_id: this.institution_id
            })
            this.loading = false

        },
        addVideo() {
            this.videos.push(this.urlVideo)
            this.put_videos()
        },
        addDepoimentos() {
            this.depoimento_video.push(this.urlVideo)
            this.put_depoimento_videos()
        },
        getDomain() {
            return window.location.hostname
        },
        is_site_active(status = true) {
            if (!status)
                window.location.href = "/pagina-em-manutencao.html"
        },
        async exist_flags() {
            let list_flags = Object.keys(this.flags)
            this.Domain.default_flags.forEach(flag_name => {
                if (!list_flags.includes(flag_name)) {
                    let playload = {
                        base64: this.Domain.default_flags_content[flag_name] || btoa(JSON.stringify({})),
                        flag: flag_name,
                        instituicao_id: this.institution_id
                    }
                    this.Super.flag_post(playload)
                }
            })
        },
        async put_videos() {
            let res = await this.Super.flag_put(this.flagsIds.VIDEOS, {
                base64: btoa(JSON.stringify(this.videos)),
                flag: 'VIDEOS',
                instituicao_id: this.institution_id
            })
        },
        async put_depoimento_videos() {
            let res = await this.Super.flag_put(this.flagsIds.DEPOIMENTOS, {
                base64: btoa(JSON.stringify(this.depoimento_video)),
                flag: 'DEPOIMENTOS',
                instituicao_id: this.institution_id
            })
        },
        async put_layout(e) {
            let name = e.target.getAttribute('name')
            this.layout[name] = e.target.innerText
            let res = await this.Super.flag_put(this.flagsIds.LAYOUT, {
                base64: btoa(JSON.stringify(this.layout)),
                flag: 'LAYOUT',
                instituicao_id: this.institution_id
            })
        },
        money() {
            let val = this.doacao.valor_custon
            val = val.replace('.', '')
            val = val.replace(/\D/gi, '')
            val = val ? val : 0
            val = `${parseInt(val)}` ?? '0'
            switch (val.length) {
                case 0:
                    val = '00,00'
                    break;
                case 1:
                    val = val.replace(/(\d{1})/gi, '00,0$1')
                    break;
                case 2:
                    val = val.replace(/(\d{2})/gi, '00,$1')
                    break;
                case 3:
                    val = val.replace(/(\d{1})(\d{2})/gi, '0$1,$2')
                    break;
                case 4:
                    val = val.replace(/(\d{2})(\d{2})/gi, '$1,$2')
                    break;
                case 5:
                    val = val.replace(/(\d{3})(\d{2})/gi, '$1,$2')
                    break;
                case 6:
                    val = val.replace(/(\d{1})(\d{3})(\d{2})/gi, '$1.$2,$3')
                    break;
                default:
                    val = val.replace(/(\d{1})(\d{3})(\d{2})(.*)/gi, '$1.$2,$3')
                    break;
            }

            this.doacao.valor_custon = val
        },
        mask_validade() {
            let mascara = this.doacao.validade
            mascara = mascara.replace(/\D/gi, '')
            mascara = mascara.replace(/(\d{2})(\d{2,4})(.*)/gi, '$1/$2')
            if (mascara.length > 0) {
                this.doacao.validade = mascara
            } else {
                this.doacao.validade = "02/2020"
            }
        },
        mask_cvv() {
            let mascara = this.doacao.cvv
            mascara = mascara.replace(/\D/gi, '')
            mascara = mascara.replace(/(\d{3})(.*)/gi, '$1')
            this.doacao.cvv = mascara

        },
        mask_card() {
            let mascara = this.doacao.card
            mascara = mascara.replace(/\D/gi, '')
            mascara = mascara.replace(/(\d{4})(.*)/gi, '$1 $2')
            mascara = mascara.replace(/(\d{4}\s)(\d{4})(.*)/gi, '$1$2 $3')
            mascara = mascara.replace(/(\d{4}\s)(\d{4}\s)(\d{4})(.*)/gi, '$1$2$3 $4')
            mascara = mascara.replace(/(\d{4}\s)(\d{4}\s)(\d{4}\s)(\d{4})(.*)/gi, '$1$2$3$4')
            this.doacao.card = mascara
        },
        mask_cep() {
            let mascara = this.doacao.cep
            mascara = mascara.replace(/\D/gi, '')
            mascara = mascara.replace(/(\d{5})(.*)/gi, '$1-$2')
            mascara = mascara.replace(/(\d{4}\s)(\d{1,3})(.*)/gi, '$1-$2')
            this.doacao.cep = mascara
        },
        mask_cpf() {
            let mascara = this.doacao.cpf
            mascara = mascara.replace(/\D/gi, '')
            mascara = mascara.replace(/(\d{3})(.*)/gi, '$1.$2')
            mascara = mascara.replace(/(\d{3}\.)(\d{3})(.*)/gi, '$1$2.$3')
            mascara = mascara.replace(/(\d{3}\.)(\d{3}\.)(\d{3})(.*)/gi, '$1$2$3-$4')
            mascara = mascara.replace(/(\d{3}\.)(\d{3}\.)(\d{3})-(\d{2})(.*)/gi, '$1$2$3-$4')
            this.doacao.cpf = mascara
        },
        mask_tel() {
            let mascara = this.doacao.telefone
            mascara = mascara.replace(/\D/gi, '')
            mascara = mascara.replace(/(\d{2})(.*)/gi, '($1) $2')
            mascara = mascara.replace(/\((\d{2})\)\s(\d{1})(.*)/gi, '($1) $2 $3')
            mascara = mascara.replace(/\((\d{2})\)\s(\d{1})\s(\d{4})(.*)/gi, '($1) $2 $3-$4')
            mascara = mascara.replace(/\((\d{2})\)\s(\d{1})\s(\d{4})-(\d{4})(.*)/gi, '($1) $2 $3-$4')
            this.doacao.telefone = mascara
        },
        async pay() {
            this.loading = true
            let res = {}
            if (this.doacao.payment_type == 'boleto') {
                let playload = {
                    ...this.doacao,
                    instituicao_id: this.institution_id,
                    doador_id: 3,
                    quantia: this.doacao.amount,
                    metodo: "boleto",
                    cliente: {
                        nome: this.doacao.nome,
                        cpf: this.doacao.cpf
                    }
                }
                res = await this.Super.payBoleto(playload)
                console.log(res)
            } else {
                let playload = {
                    quantia: this.doacao.amount,
                    metodo: "cartao_credito",
                    instituicao_id: this.institution_id,
                    doador_id: "3",
                    cliente: {
                        nome: this.doacao.nome,
                        cpf: this.doacao.cpf,
                        email: this.doacao.email,
                        telefone:'%2B55'+this.doacao.telefone 
                    },
                    cartao_credito: {
                        nome: this.doacao.nome_card,
                        cvv: this.doacao.cvv,
                        numero: this.doacao.card,
                        expericao: this.doacao.validade
                    },
                    items: {
                        id: "1",
                        nome: "Doação",
                        preco_unico: this.doacao.amount,
                        quantidade: 1
                    }
                }

                res = await this.Super.payCard(playload)
                console.log(res)
            }

            if (res.status == "success") {
                if (this.doacao.payment_type == 'boleto') {
                    this.cache.boleto_code = res.boleto.codigo_barras
                    this.cache.boleto_link = res.boleto.link
                } else {
                    this.cache.boleto_code = false
                    this.cache.boleto_link = false
                }
                // window.location.href = "/obrigado.html"
            } else {
                this.error.status = true
                this.error.text = res.message

            }

            this.loading = false
        },
        async viaCep() {
            this.loading = true
            let res = await fetch(`https://viacep.com.br/ws/${this.doacao.cep}/json/`)
            let address = await res.json()
            this.doacao.rua = address.logradouro
            this.doacao.bairro = address.bairro
            this.doacao.cidade = address.localidade
            this.doacao.estado = address.uf
            this.loading = false
        }


    },
    filters: {
        getIdYoutube: url => new URL(url).searchParams.get('v'),
        getTumb: id => `https://i.ytimg.com/vi/${id}/hqdefault.jpg`,
        getImage: (nameImage, id) => `https://api.doardigital.com.br/storage/app/public/${id}/${nameImage}`,
        money: val => {
            val = val.replace('.', '')
            val = val.replace(/\D/gi, '')
            val = val ? val : 0
            val = `${parseInt(val)}` ?? '0'
            switch (val.length) {
                case 0:
                    val = '00,00'
                    break;
                case 1:
                    val = val.replace(/(\d{1})/gi, '00,0$1')
                    break;
                case 2:
                    val = val.replace(/(\d{2})/gi, '00,$1')
                    break;
                case 3:
                    val = val.replace(/(\d{1})(\d{2})/gi, '0$1,$2')
                    break;
                case 4:
                    val = val.replace(/(\d{2})(\d{2})/gi, '$1,$2')
                    break;
                case 5:
                    val = val.replace(/(\d{3})(\d{2})/gi, '$1,$2')
                    break;
                case 6:
                    val = val.replace(/(\d{1})(\d{3})(\d{2})/gi, '$1.$2,$3')
                    break;
                default:
                    val = val.replace(/(\d{1})(\d{3})(\d{2})(.*)/gi, '$1.$2,$3')
                    break;
            }
            return val
        }
    },
    async mounted() {

        this.doacao.recorrente = localStorage.getItem('recorrente')
        this.doacao.amount = localStorage.getItem('amount')
        this.doacao.email = localStorage.getItem('email')
        this.doacao.amount_custon = localStorage.getItem('amount_custon')

        let instituicao = (await this.Super.get_institution_by_domain(this.Domain.corruent()))
        instituicao.ativo = true
        this.is_site_active(instituicao?.ativo)
        this.institution_id = instituicao?.id


        let all_flags = await this.Super.flag_get_by_institution(this.institution_id)
        this.flagsIds = this.Domain.flags_ids(all_flags)
        this.flags = this.Domain.render_flag(all_flags)


        this.exist_flags()

        this.videos = this.flags.VIDEOS
        this.depoimento_video = this.flags.DEPOIMENTOS
        this.galerys = this.flags.GALERIA
        this.layout = { ...this.layout, ...this.flags.LAYOUT }


    }
}).$mount("#doar_app");