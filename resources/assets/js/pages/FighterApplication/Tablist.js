import React from 'react';

export default class Tablist extends React.Component {
    getClasses(index) {
        const { tabs, tabIndex } = this.props;

        let classes = [];
        if (index == 0) classes.push('first');
        else if (index == (Object.keys(tabs).length - 1)) classes.push('last');

        if (index == tabIndex) classes.push('current')
        else if (index < tabIndex) classes.push('done')

        return classes.join(' ');
    }

    getName(s) {
        return s.replace(/([A-Z])/g, ' $1').trim();
    }

    render() {
        const { tabs, setTabIndex, tabIndex } = this.props;

        let navs = [];
        Object.keys(tabs).forEach((key) => {
           navs.push(
                <li role="tab" aria-disabled="false" key={key}
                    className={this.getClasses(key) || null}
                    onClick={setTabIndex.bind(this, key)}
                >
                    {this.getName(tabs[key].name)}
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
                <div className="progress">
                    <div className="progress-bar bg-info" role="progressbar" style={{width: value*100/outof + '%'}} aria-valuenow={value*100/outof} aria-valuemin="0" aria-valuemax="100">
                        {Math.ceil(value*100/outof) + '%'}
                    </div>
                </div>
            </React.Fragment>
        )
    }
}