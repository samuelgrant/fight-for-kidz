import React from 'react';
import { Checkbox, FormGroup } from '../../components/FormControl';

export default class Declaration extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <div className="col-12 mb-3">
                        <Checkbox id=" " label="I would like to receive Fight for Kidz updates via email" checked/>
                    </div>

                    <div className="col-12">
                        <Checkbox id=" " label="I have provided true and accurate information in this application" checked/>
                    </div>
                </div>

                <button className="btn btn-sm btn-success d-block mx-auto mb-5">
                    <i className="fas fa-check-circle"/> Submit Form
                </button>
            </form>
        )
    }
}