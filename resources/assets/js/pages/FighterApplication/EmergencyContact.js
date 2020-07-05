import React from 'react';
import { FormGroup, Input } from '../../components/FormControl';

export default class EmergencyContact extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="First Name:" htmlFor="em:firstname" required>
                        <Input id="em:firstname" type="text" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Last Name:" htmlFor="em:lastname" required>
                        <Input id="em:lastname" type="text" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Relationship:" htmlFor="em:relationship" required>
                        <Input id="em:relationship" type="text" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Email:" htmlFor="em:email" required>
                        <Input id="em:email" type="email" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 1:" htmlFor="em:phone1" required>
                        <Input id="em:phone1" type="tel" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 2:" htmlFor="em:phone2">
                        <Input id="em:phone2" type="tel" />
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