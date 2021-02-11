// actions.js são as ações realizadas de incremento e decremento que contém type como tipo

// exporta increment function
export function increment() {
    return {
        type: 'counter/incremented' // tipo de envio (ação (action))
    }
}

// exporta decrement function
export function decrement() {
    return {
        type: 'counter/decremented' // tipo de envio (ação (action))
    }
}