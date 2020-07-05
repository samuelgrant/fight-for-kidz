import React from 'react';
import { FormGroup, Input } from '../../components/FormControl';

export default class ContactInformation extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="First Name:" htmlFor="givenname" required>
                        <Input id="givenname" type="text" autoComplete="given-name" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Last Name:" htmlFor="familyname" required>
                        <Input id="familyname" type="text" autoComplete="family-name" required />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Address 1:" htmlFor="addressline1" required>
                        <Input id="addressline1" type="text" autoComplete="address-line1" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Address 2:" htmlFor="addressline2">
                        <Input id="addressline2" type="text" autoComplete="address-line2" />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Suburb:" htmlFor="addresslevel3" required>
                        <Input id="addresslevel3" type="text" autoComplete="address-level3" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="City:" htmlFor="addresslevel2" required>
                        <Input id="addresslevel2" type="text" autoComplete="address-level2" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Post Code:" htmlFor="postalcode" required>
                        <Input id="postalcode" type="number" autoComplete="postal-code" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Email:" htmlFor="email" required>
                        <Input id="email" type="email" autoComplete="email" required />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 1:" htmlFor="tel1" required>
                        <Input id="tel1" type="tel" autoComplete="tel" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 2:" htmlFor="tel2">
                        <Input id="tel2" type="tel" />
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