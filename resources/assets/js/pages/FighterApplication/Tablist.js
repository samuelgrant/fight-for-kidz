import React from 'react';

export default class Tablist extends React.Component {
    constructor(props) {
        super(props);

        this.handleClick = this.handleClick.bind(this);
    }

    getClasses(index) {
        const { tabs, maxIndex, tabIndex } = this.props;

        let classes = [];
        if (index == 0) classes.push('first');
        else if (index == (Object.keys(tabs).length - 1)) classes.push('last');

        if (index == tabIndex) classes.push('current')
        else if (index > maxIndex) classes.push('disabled')
        else if (index < tabIndex) classes.push('done')

        return classes.join(' ');
    }

    handleClick(tabIndex) {
        // Do not handle the click if the tab item is disabled
        if (tabIndex <= this.props.maxIndex) {
            this.props.setTabIndex(tabIndex);
        }
    }

    render() {
        const { tabs, tabIndex } = this.props;

        let navs = [];
        Object.keys(tabs).forEach((key) => {
            let name = tabs[key].name.replace(/([A-Z])/g, ' $1').trim();
            
            navs.push(
                <li role="tab" key={key} className={this.getClasses(key) || null} onClick={() => this.handleClick(key)}>
                    {name.trim()}
                </li>
            )
        });

        return tabs ? (
            <React.Fragment>
                <ul className="steps" role="tablist">
                    { navs }
                </ul>

                <hr />

                <ProgressBar value={tabIndex} outof={Object.keys(tabs).length -1} />
            </React.Fragment>
        ) : null
    }
}

class ProgressBar extends React.Component {
    render() {
        const { value, outof } = this.props;

        return (
            <React.Fragment>
                <p>Application Progress:</p>
                <div className="progress" style={{'position': 'relative'}}>
                    <div className="progress-bar bg-info" role="progressbar" style={{width: value*100/outof + '%'}} aria-valuenow={value*100/outof} aria-valuemin="0" aria-valuemax="100"/>
                    <span style={{'position': 'absolute', 'width': '100%', 'textAlign': 'center', 'color': 'black'}}>{value} of {outof}</span>
                </div>
            </React.Fragment>
        )
    }
}