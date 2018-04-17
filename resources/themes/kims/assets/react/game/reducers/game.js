import assign from 'lodash/assign';
import map from 'lodash/map';
import random from 'lodash/random';
import filter from 'lodash/filter';

let items = [
    {type: 'tomato', color: '#e2774f'},
    {type: 'nature', color: '#b2da66'},
    {type: 'drink', color: '#856f4c'},
    {type: 'meat', color: '#d2728b'},
    {type: 'tomato', color: '#e2774f'},
];

let initialState = {
    visible       : false,
    availableItems: items,
    items         : [],
    tshort: {
        step: 1,
        maxStep: 15
    },
    gameOver: false
};


let _randomItem = (id = random(0, initialState.availableItems.length -1)) => {
    let item = initialState.availableItems[id];

    return {
        type : item.type,
        speed: random(15, 20),
        color: item.color
    }
};

let steps = [5,7,9,11,13];

for (let _i of [0, 1, 2, 3, 4]) {
    let item = _randomItem(_i);
    let id = steps[_i];

    item.id = id;
    item.position = id;

    item.movement = {
        next    : random(1) == 0 ? 10 : 90,
        previous: 50
    };

    initialState.items.push(item);
}

export default function game(state = initialState, action) {

    switch (action.type) {
        case 'END':
            return assign({}, state, {visible: false});
        case 'SKIP':
            let _gameOverItem = _randomItem();
            let _gameOver= {step: state.tshort.step, color: _gameOverItem['color'], type: _gameOverItem['type']};

            return assign({}, state, {gameOver: _gameOver});
        case 'MOVE_INTERFERENCE':

            if (state.gameOver !== false) {
                return state;
            }

            let gameOverItem = filter(state.items, function(o) {return o.position == state.tshort.step && o.movement.next == 50; });
            return {
                ...state,
                items: map(state.items, (item) => {

            if (item.id === action.id) {

            let next = 50;
            if (item.movement.next == 50) {
                next = item.movement.previous < 50 ? 90 : 10;
            }
            return assign({}, item, {movement: {previous: item.movement.next, next: next}});

        }
            return item;
    }),
    gameOver: gameOverItem.length == 0 ? false : {step: state.tshort.step, color: gameOverItem[0]['color'], type: gameOverItem[0]['type']}
}

    case 'MOVE_TSHORT_FORWARD':

    let st = (state.tshort.step < state.tshort.maxStep) ?
        assign({}, state, {
            tshort: {step: state.tshort.step + 1, maxStep: state.tshort.maxStep}
        }) :
        assign({}, assign, {}); // purify object

    if (st.tshort.step == st.tshort.maxStep) {
        // release the kraken

        let kraken = _randomItem();
        kraken.id = 15;
        kraken.position = 15;
        kraken.speed = 7;
        kraken.movement = {
            next    : 0,
            previous: 50
        };

        st.items.push(kraken)
    }

    return st;
    case 'MOVE_TSHORT_BACK':
    return (state.tshort.step < state.tshort.maxStep && state.tshort.step > 1) ?
        assign({}, state, {
            tshort: {step: state.tshort.step - 1, maxStep: state.tshort.maxStep}
        }) :
        state;

    default:
    return state
}
}