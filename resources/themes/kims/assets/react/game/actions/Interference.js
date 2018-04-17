import * as types from '../constants/ActionTypes';

export function move(id) {
    return {
        type: types.MOVE_INTERFERENCE,
        id: id
    };
}
