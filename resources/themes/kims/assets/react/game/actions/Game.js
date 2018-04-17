import * as types from '../constants/ActionTypes';

export function skip() {
    return {
        type: types.SKIP,
        true
    };
}

export function end() {
    return {
        type: types.END,
        true
    };
}