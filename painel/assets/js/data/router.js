export default [
    { path: '/', component: { template: '<c-login></c-login>' } },
    { path: '/recuperar-senha', component: { template: '<c-recuperar></c-recuperar>' } },
    { path: '/inicio', component: { template: '<c-inicio></c-inicio>' } },
    { path: '/metas/:ano', component: { template: '<c-metas></c-metas>' } },
    { path: '/perfil', component: { template: '<c-perfil></c-perfil>' } },
    { path: '/politica-de-privacidade', component: { template: '<c-privacidade></c-privacidade>' } },
    { path: '/configuracao', component: { template: '<c-config></c-config>' } },
    { path: '/instituicoes', component: { template: '<c-instituicao></c-instituicao>' } },
    { path: '/script', component: { template: '<c-script></c-script>' } },
    { path: '/modulos', component: { template: '<c-modulos></c-modulos>' } },
    { path: '/doadores', component: { template: '<c-doadores></c-doadores>' } },
    { path: '/doacoes', component: { template: '<c-doacoes></c-doacoes>' } },
    { path: '/credenciais/nova', component: { template: '<c-credenciais-novo></c-credenciais-novo>' } },
    { path: '/credenciais/:step', component: { template: '<c-credenciais></c-credenciais>' } },
    { path: '/credenciais/editar/:id', component: { template: '<c-credenciais-editar></c-credenciais-editar>' } },
    { path: '/planos', component: { template: '<c-planos></c-planos>' } },
    { path: '/planos/novo', component: { template: '<c-planos-novo></c-planos-novo>' } },
    { path: '/planos/editar/:id', component: { template: '<c-planos-editar></c-planos-editar>' } },
    { path: '/modelo-de-emails', component: { template: '<c-emails></c-emails>' } },
    { path: '/modelo-de-emails/:id', component: { template: '<c-emails-edit></c-emails-edit>' } },
    { path: '/usuarios', component: { template: '<c-usuarios></c-usuarios>' } },
    { path: '/usuarios/novo', component: { template: '<c-usuarios-novo></c-usuarios-novo>' } },
    { path: '/usuarios/novo/:id', component: { template: '<c-usuarios-edit></c-usuarios-edit>' } },
    { path: '/sass/novo', component: { template: '<c-sass-novo></c-sass-novo>' } },
    { path: '/sass/:step', component: { template: '<c-sass></c-sass>' } },
    { path: '/sass/editar/:id', component: { template: '<c-sass-editar></c-sass-editar>' } },

    { path: '/correios', component: { template: '<c-correios></c-correios>' } },
    { path: '/mailing-boss', component: { template: '<c-mailing-boss></c-mailing-boss>' } },
    { path: '/email', component: { template: '<c-email></c-email>' } },
    { path: '/rd-station', component: { template: '<c-rd-station></c-rd-station>' } },
    { path: '/evendas', component: { template: '<c-evendas></c-evendas>' } },
]