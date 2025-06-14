const listaClientes = () => {
    return fetch(`http://localhost:3000/profile`)
    .then(resposta => {
        if(resposta.ok) {
            return resposta.json()
        }
        throw new Error('Não foi possível listar os clientes')
    })

}

const criaClientes = (nome, email) => {
    return fetch(`http://localhost:3000/profile`, {
        method: 'POST' ,
        headers: {
            'Content-Type' : 'application/json'
        },
        body: JSON.stringify({
            nome: nome,
            email: email
        })
    })
    .then(resposta => {
        if(resposta.ok){
            return resposta.body
        }
        throw new Error('Não foi possível criar um cliente')
    })
}

const removeCliente = (id) => {
    return fetch(`http://localhost:3000/profile/${id}`, {
        method: 'DELETE'
    }).then(resposta => {
        if(!resposta.ok){
            throw new Error('Não foi possível remover um cliente')
        } 
    })
}

const detalhaCliente = (id) => {
    return fetch(`http://localhost:3000/profile/${id}`)
    .then(resposta => {
        if(resposta.ok){
            return resposta.json()
        } throw new Error('Não foi possível detalhar o cliente')
        
    })
}

const atualizaCliente = (id, nome, email) => {
    return fetch(`http://localhost:3000/profile/${id}`, {
        method: 'PUT',
        headers: {
            'Content-type' : 'application/json'
        },
        body: JSON.stringify({
            nome: nome,
            email: email
        })
    })
    .then(resposta => {
        if(resposta.ok){
            return resposta.json()
        } throw new Error('Não foi possível atualizar um cliente')
    })
}
export const clienteService = {
    listaClientes,
    criaClientes,
    removeCliente,
    detalhaCliente,
    atualizaCliente
}


