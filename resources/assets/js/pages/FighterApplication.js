import React, { Component } from 'react';
import { render } from 'react-dom';

export default class FighterApplication extends Component {
    render() {
        return <h1>react div</h1>
    }
}

if(document.getElementById('ranchor_fighterapp')) {
    render(<FighterApplication />, document.getElementById('ranchor_fighterapp'));
}