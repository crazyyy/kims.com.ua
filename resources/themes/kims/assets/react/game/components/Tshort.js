import React, { Component, PropTypes } from 'react';
import classnames from 'classnames';

export default class Tshort extends Component {

    static propTypes = {
        step: PropTypes.number.isRequired,
        maxStep: PropTypes.number.isRequired,
        move: PropTypes.func.isRequired
    };

    render() {
        let count = this.props.maxStep + 1; // нужен еще один шаг для подсчетов
        let full_w = 100/count;
        let half_w = full_w / 2;

        let leftPosition = half_w + full_w * (this.props.step-1);
        var positionStyle = {
          left: leftPosition + '%'
        };

        return (
        <div className="game__clothes g-clothes">
            <div className="game__clothes g-clothes__wrapper" style={positionStyle}>
                <div
                    className={classnames('g-clothes__back-btn', this.props.step == 1 ? 'hide' : '')}
                    onClick={this.handleClick.bind(this, 'back')}
                ></div>
                <div className="g-clothes__element icon-t-shirt"></div>
                <div
                    className={classnames('g-clothes__forward-btn', this.props.step == this.props.maxStep ? 'hide' : '')}
                    onClick={this.handleClick.bind(this, 'forward')}
                ></div>
            </div>
        </div>
        );
    }

    handleClick(direction) {
        this.props.move(direction);
    }

}