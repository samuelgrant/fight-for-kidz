import React from 'react';
import { FormGroup, Radio, TextArea } from '..//../components/FormControl';

export default class Additional extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <h5 className="text-danger">Custom Questions Here</h5>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Do you have any criminal convictions or are facing charges?" required>
                        <Radio options={['Yes', 'No']} />
                    </FormGroup>

                    <FormGroup className="col-12 form-group" label="Are you happy to take a drug screening test?" required>
                        <Radio options={['Yes', 'No']} />
                    </FormGroup>
                </div>

                <button className="btn btn-sm btn-info float-left"
                    onClick={this.props.handleTabChange.bind(this, this.props.tabIndex-1)}>
                    <i className="fas fa-arrow-circle-left"/> Previous
                </button>
                <button className="btn btn-sm btn-info float-right" type="submit">
                    Next <i className="fas fa-arrow-circle-right"/>
                </button>
            </form>
        )
    }
}