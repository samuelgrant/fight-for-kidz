import React, { Component } from 'react';
import { render } from 'react-dom';
import Sections from './FighterApplication/Sections';
import ReactError from './FighterApplication/Error';
import Cookies from 'js-cookie'

export default class FighterApplication extends Component {
    constructor(props) {
        super(props);

        this.state = {
            _cookieConsent: false,
            _hasError: false,
            answers: {}
        }
    }

    static getDerivedStateFromError(error) {
        return { _hasError: true };
    }

    componentDidMount() {
        $.ajax({
            method: 'get',
            url: '/api/fighter-application',
            success: ((data) => this.setState(data))
        })
    }

    clearCookie() {
        Cookies.remove('fighterapp');
    }

    getCookie() {
        if (!Cookies.get('fighterapp')) {// cookie exists
            this.setState({
                answers: {}//cookie value
            });
        }
    }

    setCookie() {
        if(this.state._cookieConsent) {
            Cookies.set('fighterapp', this.state.answers)
        }
    }

    render() {
        const { answers, _applicationDocs, _customQuestions, _eventName  } = this.state;

        return this.state._hasError ?
        <ReactError /> : (
            <Sections
                name={_eventName}
                answers={answers}
                applicationDocs={_applicationDocs}
                customQuestions={_customQuestions}
                updateState={(answers) => this.setState(answers)}
                updateCookie={this.updateCookie}
            />
        )
    }
}

if(document.getElementById('ranchor_fighterapp')) {
    render(<FighterApplication />, document.getElementById('ranchor_fighterapp'));
}