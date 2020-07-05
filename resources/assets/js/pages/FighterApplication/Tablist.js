import React from 'react';

export default class Tablist extends React.Component {
    getClasses(k) {
        const { tabs, tabIndex } = this.props;

        let classes = [];
        if (k == 0) classes.push('first');
        else if (k == (Object.keys(tabs).length - 1)) classes.push('last');

        if (k == tabIndex) classes.push('current')
        else if (k < tabIndex) classes.push('done')

        return classes.join(' ');
    }

    getName(s) {
        return s.replace(/([A-Z])/g, ' $1').trim();
    }

    render() {
        const { handleTabChange, tabs, tabIndex } = this.props;
        let navs = [];
        Object.keys(tabs).forEach((key) => {
           navs.push(
                <li role="tab" aria-disabled="false" key={key}
                    className={this.getClasses(key) || null}
                    onClick={handleTabChange.bind(this, key)}
                >
                    {this.getName(tabs[key].name)}
                </li>
            )
        });

        let percent  = tabIndex*100/(Object.keys(tabs).length -1);

        return tabs ? (
            <React.Fragment>
                <ul className="steps" role="tablist">
                    { navs }
                </ul>

                <hr />

                <p>Application Progress:</p>
                <div className="progress">
                    <div className="progress-bar bg-info" role="progressbar" style={{width: percent + '%'}} aria-valuenow={percent} aria-valuemin="0" aria-valuemax="100">
                        {percent.toFixed(2) + '%'}
                    </div>
                </div>
            </React.Fragment>
        ) : null
    }
}