import React, { Component } from 'react';
import { Provider } from 'react-redux';
import { createStore, combineReducers } from 'redux'

import GameApp from './GameApp';
import * as reducers from '../reducers';

const reducer = combineReducers(reducers);
const store = createStore(reducer, {},
    window.devToolsExtension ? window.devToolsExtension() : undefined
);

export default class App extends Component {
  render() {
    return (
      <div>
        <Provider store={store}>
          <GameApp />
        </Provider>
      </div>
    );
  }
}