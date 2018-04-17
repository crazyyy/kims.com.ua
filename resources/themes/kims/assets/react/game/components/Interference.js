import React, { Component, PropTypes } from 'react';
import classnames from 'classnames';

import { InterferenceItem } from '../components';

export default class Interference extends Component {

    static propTypes = {
        items: PropTypes.array.isRequired,
        move : PropTypes.func.isRequired
    };

    constructor(props) {
        super(props);
        this.availableItems = {
            nature : 'g-interference__nature icon-nature',
            tomato: 'g-interference__tomato icon-tomato',
            drink: 'g-interference__drink icon-drink',
            meat  : 'g-interference__meat icon-meat'
        };
    }

    render() {

        let items = [];
        for (let item of this.props.items) {


            items.push(
            <InterferenceItem
            key={item.position}
            id={item.position}
            position={item.position}
            speed={item.speed}
            type={item.type}
            moveTo={item.movement.next}
            onRest={this.props.move}

            />);
        }

        return (
        <div className="game__interference g-interference">
            {items}
        </div>

        );
    }

}