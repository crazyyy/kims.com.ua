import * as types from '../constants/ActionTypes';

export function move(direction) {

    return (direction == 'forward') ? {type: types.MOVE_TSHORT_FORWARD} : {type: types.MOVE_TSHORT_BACK};

}
