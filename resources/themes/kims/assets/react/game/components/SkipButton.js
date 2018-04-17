import React, { Component, PropTypes } from 'react';

export default class SkipButton extends Component {

    static propTypes = {
        skip: PropTypes.func.isRequired
    };

    render() {
        return (
        <a className="game__skip-btn" onClick={this.handleClick.bind(this)}>
            Пропустить
        </a>
        );
    }

    handleClick(e) {
        this.props.skip();
    }

}