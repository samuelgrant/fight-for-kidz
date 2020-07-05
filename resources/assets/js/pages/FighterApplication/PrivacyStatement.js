import React from 'react';

export default class PrivacyStatement extends React.Component {
    render() {
        return (
            <React.Fragment>
                <p className="font-weight-bold mb-0">Thank You for Your Interest in {this.props.name}</p>
                <p className="font-italic">It can take between 30 - 60 minutes to complete this form.</p>

                <p>This form has an 'auto-save' feature which saves your answers using cookies at each stage of the application. If you do not complete the application your answers will be retained for 7 days and the application form will be pre-populated on your return.</p>
                <p className="mb-0">Do not use the autosave feature if:</p>
                <ul>
                    <li>You are using a public or shared computer</li>
                    <li>You have blocked cookies on our website</li>
                    <li>You clear cookies/browsing data at the end of your browsing session</li>
                </ul>

                <div className="alert alert-info">We cannot see your answers until you click the submit button at the end of the application!</div>

                <button className="btn btn-sm btn-info" onClick={this.props.enableAutosave.bind(this, false)}>Continue Without AutoSave</button>
                <button className="btn btn-sm btn-success" onClick={this.props.enableAutosave.bind(this, true)}>Use AutoSave</button>
            </React.Fragment>
        )
    }
}