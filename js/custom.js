
async function carregar_usuarios(valor) {
    if (valor.length >= 3) {
    //    console.log("Pesquisar: " + valor);

        const dados = await fetch('../relatorios/listar_usuarios.php?nome=' + valor);
        const resposta = await dados.json();
    //    console.log(resposta);

        var html = "<ul style='z-index: 99999;' class='list-group position-absolute'>";

        if (resposta['erro']) {
            html += "<li class='list-group-item list-group-item-dark'>" + resposta['msg'] + "</li>";
        } else {
            for (i = 0; i < resposta['dados'].length; i++) {
                html += "<li class='list-group-item list-group-item-dark' onclick='get_id_usuario0(" + resposta['dados'][i].cod + ","
                    + JSON.stringify(resposta['dados'][i].nome) +
                    "," + JSON.stringify(resposta['dados'][i].cnpj) +
                    "," + JSON.stringify(resposta['dados'][i].nome_fantasia) +
                    "," + JSON.stringify(resposta['dados'][i].credito) +
                    "," + JSON.stringify(resposta['dados'][i].atividade) +
                    "," + JSON.stringify(resposta['dados'][i].filial_coligada) +
                    "," + JSON.stringify(resposta['dados'][i].cod_atendente) +
                    "," + JSON.stringify(resposta['dados'][i].nome_atendente) +
                    "," + JSON.stringify(resposta['dados'][i].observacao) +
                    ")'>" + resposta['dados'][i].nome_fantasia +
                    " " + resposta['dados'][i].nome + "</li>";
            }

        }
        html += "</ul>";

        document.getElementById('resultado_pesquisa0').innerHTML = html;
    }
}

function get_id_usuario0(cod, nome, cnpj, nome_fantasia, credito, atividade, filial, cod_atendente, nome_atendente, observacao) {
    console.log("Id do usuario selecionado: " + cod);
    console.log("nome do usuario selecionado: " + nome);
    console.log("nome_fantasia do usuario selecionado: " + nome_fantasia);
    if(document.getElementById("usuario0")){
        document.getElementById("usuario0").value = nome;
    }
    if(document.getElementById("usuariosigla")){
    document.getElementById("usuariosigla").value = nome_fantasia;
    }
    if(document.getElementById("codigo")){
    document.getElementById("codigo").value = cod;
    }
    if(document.getElementById("codigo1")){
    document.getElementById("codigo1").value = cod;
    }
    if(document.getElementById("numerodocliente")){
    document.getElementById("numerodocliente").value = cod;
    }
    if(document.getElementById("selecioanador_cliente")){
    document.getElementById("selecioanador_cliente").href = "tl-cadastro-notas.php?tp=2&id="+cod;
    }
}

const fechar = document.getElementById('usuario0');
if(document.getElementById('resultado_pesquisa0')){
document.addEventListener('click', function (event) {
    
        const validar_clique = fechar.contains(event.target);
        if (!validar_clique) {
            document.getElementById('resultado_pesquisa0').innerHTML = '';
        }
   

})
}


//

async function carregar_fisico(valor) {
    if (valor.length >= 3) {
        //    console.log("Pesquisar: " + valor);
    
            const dados = await fetch('../relatorios/listar_usuarios_fisico.php?nome=' + valor);
            const resposta = await dados.json();
        //    console.log(resposta);
    
            var html = "<ul style='z-index: 99999;' class='list-group position-absolute'>";
    
            if (resposta['erro']) {
                html += "<li class='list-group-item list-group-item-dark'>" + resposta['msg'] + "</li>";
            } else {
                for (i = 0; i < resposta['dados'].length; i++) {
                    html += "<li class='list-group-item list-group-item-dark' onclick='get_id_usuario1(" + resposta['dados'][i].cod + ","
                        + JSON.stringify(resposta['dados'][i].nome) +
                        "," + JSON.stringify(resposta['dados'][i].cnpj) +
                        ")'>" + resposta['dados'][i].atividade +
                        " " + resposta['dados'][i].nome + "</li>";
                }
    
            }
            html += "</ul>";
   
            document.getElementById('resultador_123').innerHTML = html;
            
        }
}
function get_id_usuario1(cod, nome,) {
    console.log("Id do usuario selecionado: " + cod);
    console.log("nome do usuario selecionado: " + nome);
    if(document.getElementById("usuario1")){
    document.getElementById("usuario1").value = nome;
    }
    if(document.getElementById("codigo1")){
    document.getElementById("codigo1").value = cod;
    }
    if(document.getElementById("codigo")){
    document.getElementById("codigo").value = cod;
    }
    if(document.getElementById("numerodocliente")){
    document.getElementById("numerodocliente").value = cod;
    }
    if(document.getElementById("selecioanador_cliente")){
    document.getElementById("selecioanador_cliente").href = "tl-cadastro-notas.php?tp=1&id="+cod;
    }
    
}

const fechar1 = document.getElementById('usuario1');
if(document.getElementById('resultador_123')){
document.addEventListener('click', function (event) {
        const validar_clique = fechar1.contains(event.target);
        if (!validar_clique) {
            document.getElementById('resultador_123').innerHTML = '';
        }
   

})
}
// 

// 


async function carregar_sigla(valor) {
    if (valor.length >= 3) {
    //    console.log("Pesquisar: " + valor);

        const dados = await fetch('../relatorios/listar_sigla.php?nome=' + valor);
        const resposta = await dados.json();
    //    console.log(resposta);

        var html = "<ul style='z-index: 99999;' class='list-group position-absolute'>";

        if (resposta['erro']) {
            html += "<li class='list-group-item list-group-item-dark'>" + resposta['msg'] + "</li>";
        } else {
            for (i = 0; i < resposta['dados'].length; i++) {
                html += "<li class='list-group-item list-group-item-dark' onclick='get_id_usuariosigla(" + resposta['dados'][i].cod + ","
                    + JSON.stringify(resposta['dados'][i].nome) +
                    "," + JSON.stringify(resposta['dados'][i].cnpj) +
                    "," + JSON.stringify(resposta['dados'][i].nome_fantasia) +
                    "," + JSON.stringify(resposta['dados'][i].credito) +
                    "," + JSON.stringify(resposta['dados'][i].atividade) +
                    "," + JSON.stringify(resposta['dados'][i].filial_coligada) +
                    "," + JSON.stringify(resposta['dados'][i].cod_atendente) +
                    "," + JSON.stringify(resposta['dados'][i].nome_atendente) +
                    "," + JSON.stringify(resposta['dados'][i].observacao) +
                    ")'>" + resposta['dados'][i].nome_fantasia +
                    " " + resposta['dados'][i].nome + "</li>";
            }

        }
        html += "</ul>";

        document.getElementById('resultado_sigla').innerHTML = html;
    }
}

function get_id_usuariosigla(cod, nome, cnpj, nome_fantasia, credito, atividade, filial, cod_atendente, nome_atendente, observacao) {
    console.log("Id do usuario selecionado: " + cod);
    console.log("nome do usuario selecionado: " + nome);
    console.log("nome_fantasia do usuario selecionado: " + nome_fantasia);
    if(document.getElementById("numerodocliente")){
    document.getElementById("numerodocliente").value = cod;
    }
    if(document.getElementById("usuario0")){
    document.getElementById("usuario0").value = nome;
    }
    if(document.getElementById("codigo")){
    document.getElementById("codigo").value = cod;
    }
    if(document.getElementById("usuariosigla")){
    document.getElementById("usuariosigla").value = nome_fantasia;
    }
    if(document.getElementById("selecioanador_cliente")){
    document.getElementById("selecioanador_cliente").href = "tl-cadastro-notas.php?tp=2&id="+cod;
    }

}

const fecharsigla = document.getElementById('usuariosigla');
if(document.getElementById('resultado_sigla')){
document.addEventListener('click', function (event) {
    
        const validar_clique = fecharsigla.contains(event.target);
        if (!validar_clique) {
            document.getElementById('resultado_sigla').innerHTML = '';
        }
   

})
}

