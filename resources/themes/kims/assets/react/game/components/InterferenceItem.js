import React, { Component, PropTypes } from 'react';
import ReactDOM from 'react-dom';
import classnames from 'classnames';
import {Motion, spring} from 'react-motion';


export default class InterferenceItem extends Component {
    static propTypes = {
        id      : PropTypes.number.isRequired,
        position: PropTypes.number.isRequired,
        speed   : PropTypes.number.isRequired,
        type    : PropTypes.string.isRequired,
        moveTo  : PropTypes.number.isRequired,
        onRest  : PropTypes.func.isRequired
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

    componentDidMount() {

        var transitionEvent = this._whichTransitionEvent();

        transitionEvent && ReactDOM.findDOMNode(this).addEventListener(transitionEvent, ()=>this._handleTransitionEvents());

        setTimeout(()=>{this._handleTransitionEvents();}, 100);
    }

    componentWillUnmount() {

        var transitionEvent = this._whichTransitionEvent();

        transitionEvent && ReactDOM.findDOMNode(this).removeEventListener(transitionEvent, ()=>this._handleKeyboardEvents());
    }

    _handleTransitionEvents() {
        this.props.onRest(this.props.id);
    }

    _getClassName(type) {
        return this.availableItems[type] ? this.availableItems[type] : this.availableItems['tomato'];
    }

    /* From Modernizr */
    _whichTransitionEvent(){
        var t;
        var el = document.createElement('fakeelement');
        var transitions = {
          'transition':'transitionend',
          'OTransition':'oTransitionEnd',
          'MozTransition':'transitionend',
          'WebkitTransition':'webkitTransitionEnd'
        }

        for(t in transitions){
            if( el.style[t] !== undefined ){
                return transitions[t];
            }
        }
    }

    render() {

        const className = this._getClassName(this.props.type);
        return (
            <div
            className={classnames(className, 'g-interference__step-' + this.props.position)}
            style={{top: `${this.props.moveTo}%`, transition: `top ${this.props.speed/10}s linear`}}
            />
        );
    }
}
