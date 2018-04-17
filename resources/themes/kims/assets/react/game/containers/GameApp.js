import React, { Component, PropTypes } from 'react';
import { bindActionCreators } from 'redux';
import { connect } from 'react-redux';
import classnames from 'classnames';

import { SkipButton, Tshort, Interference } from '../components';

import * as GameActions from '../actions/Game';
import * as TshortActions from '../actions/Tshort';
import * as InterferenceActions from '../actions/Interference';

@connect(state => ({
    game  : state.game
}))

export default class GameApp extends Component {

    static propTypes = {
        dispatch: PropTypes.func.isRequired
    }

    constructor(props) {
        super(props);
        this._handleKeyboardEvents = this._handleKeyboardEvents.bind(this);
    }

    _handleKeyboardEvents(e) {
        switch (e.keyCode) {
            case 37: // left
                this.props.dispatch(TshortActions.move('back'));
                break;
            case 39: // right
                this.props.dispatch(TshortActions.move('forward'));
                break;
        }
    }

    componentDidMount() {
        window.addEventListener('keyup', this._handleKeyboardEvents);
    }

    componentWillUnmount() {
        window.removeEventListener('keyup', this._handleKeyboardEvents);
    }

    render() {

        const { game, dispatch } = this.props;

        // на этом моменте есть смысл проверять, не закрыта ли игра
        // если закрыта - ничего не рендерим и не отрабатываем
        if (!game.visible) return null;

        const gameActions = bindActionCreators(GameActions, dispatch);
        const tshortActions = bindActionCreators(TshortActions, dispatch);
        const interferenceActions = bindActionCreators(InterferenceActions, dispatch);

        let dots = [];
        for (let i = 0; i < 14; i++) {
            dots.push(<li key={i} className="g-tracker__dots-item"></li>);
        }

        let game_description = window.game_description;

        let times = [];
        times.push(<li key="1" className="g-tracker__date-item">8:00</li>);
        times.push(<li key="2" className="g-tracker__date-item">14:00</li>);
        times.push(<li key="3" className="g-tracker__date-item">19:00</li>);

        // overlay class
        let overlay =  <div className={classnames('game__overlay')} ></div>;

        // в отличии от game.visible - эту штуку проверяем в рендере
        // на этом этапе нам надо отработать некоторые кейсы, показать оверлей и добавить адекватный класс для мейн контейнера
        if (game.gameOver !== false){
            $('.main')
                .removeClass('tomato')
                .removeClass('nature')
                .removeClass('drink')
                .removeClass('meat');

            // игра закончилась - обновляем класс и скипаем интро
            document.querySelector('.main').classList.add(game.gameOver.type);
            document.querySelector('.main-icon').classList.add('icon-' + game.gameOver.type);
            $.fn.fullpage.moveTo('main');
            setTimeout(() => {
                this.props.dispatch(gameActions.end());
            }, 2000);


            let count = game.tshort.maxStep + 1; // нужен еще один шаг для подсчетов
            let full_w = 100/count;
            let half_w = full_w / 2;

            let leftPosition = half_w + full_w * (game.gameOver.step-1) + 100 / (game.tshort.maxStep * 2);
            let overlayStyle = {
                left: leftPosition + '%',
                backgroundColor: game.gameOver.color
            };

            overlay = <div
                className={classnames('game__overlay', 'show')}
                style={overlayStyle}
            />
        }

        return (
        <div className={classnames('game', game.visible ? '' : 'inactive')}>
            {overlay}
            <div className="game__wrapper">
                <div className="game__tracker g-tracker">
                    <ul className="g-tracker__dots-list clear">
                        {dots}
                    </ul>
                    <ul className="g-tracker__date-list clear">
                        {times}
                    </ul>
                </div>

                <Tshort move={tshortActions.move} step={game.tshort.step} maxStep={game.tshort.maxStep}/>
                <Interference items={game.items} move={interferenceActions.move}/>



            </div>
            <div className="game__text">
                {game_description}
            </div>

            <SkipButton skip={gameActions.skip}/>
        </div>

        );
    }
}
