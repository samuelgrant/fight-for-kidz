import React from 'react';
import { render } from 'react-dom';

import HomePage from './WebsiteSettings/HomePage';
import Metadata from './WebsiteSettings/Metadata';

const Partials = {
    0: HomePage,
    1: Metadata
}

export default class WebsiteSettings extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            index: 0
        }
    }

    getComponentName(s) {
        return s.name.replace(/([A-Z])/g, ' $1').trim();
    }

    render() {
        const TabView = Partials[this.state.index];

        let navs = [];
        Object.keys(Partials).forEach((key) => {
            navs.push(
                <li role="tab" key={key}
                    className={`nav-link ${key == this.state.index ? 'active': null}`}
                    data-toggle="tab"
                    aria-controls={this.getComponentName(Partials[key])}
                    onClick={() => this.setState({index: key})}
                >
                    {this.getComponentName(Partials[key])}
                </li>
            )
        })

        return (
            <React.Fragment>
                <nav>
                    <div className="nav nav-tabs" id="nav-tab" role="tablist">
                        {navs}
                    </div>

                    <TabView />
                </nav>
            </React.Fragment>
        )
    }
}

if(document.getElementById('ranchor_site-settings')) {
    render(<WebsiteSettings />, document.getElementById('ranchor_site-settings'));
}