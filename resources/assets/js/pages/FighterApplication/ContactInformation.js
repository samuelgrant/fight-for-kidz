import React from 'react';
import { FormGroup, Input } from '../../components/FormControl';

export default class ContactInformation extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.contact || {
            firstName: "",
            lastName: "",
            address1: "",
            address2: "",
            suburb: "",
            city: "",
            postcode: "",
            email: "",
            phone1: "",
            phone2: ""
        }
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const { contact } = nextProps.formdata;

        if(!!contact && prevState != contact){
            return nextProps.formdata.contact;
        }

        return prevState;
    }

    handleChange(key, val) {
        this.setState({[key]: val})
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('contact', this.state)
        this.props.setTabIndex(this.props.tabIndex * 1 +1)
    }


    render() {
        const { firstName, lastName, address1, address2, suburb, city, postcode, email, phone1, phone2 } = this.state;

        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="First Name:" htmlFor="givenname" required>
                        <Input id="givenname" type="text" autoComplete="given-name" value={firstName} onChange={(val) => this.handleChange('firstName', val)} required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Last Name:" htmlFor="familyname" required>
                        <Input id="familyname" type="text" autoComplete="family-name" value={lastName} onChange={(val) => this.handleChange('lastName', val)} required />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Address 1:" htmlFor="addressline1" required>
                        <Input id="addressline1" type="text" autoComplete="address-line1" value={address1} onChange={(val) => this.handleChange('address1', val)} required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Address 2:" htmlFor="addressline2">
                        <Input id="addressline2" type="text" autoComplete="address-line2" value={address2} onChange={(val) => this.handleChange('address2', val)} />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Suburb:" htmlFor="addresslevel3" required>
                        <Input id="addresslevel3" type="text" autoComplete="address-level3" value={suburb} onChange={(val) => this.handleChange('suburb', val)} required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="City:" htmlFor="addresslevel2" required>
                        <Input id="addresslevel2" type="text" autoComplete="address-level2"  value={city} onChange={(val) => this.handleChange('city', val)} required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Post Code:" htmlFor="postalcode" required>
                        <Input id="postalcode" type="number" autoComplete="postal-code"  value={postcode} onChange={(val) => this.handleChange('postcode', val)} required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Email:" htmlFor="email" required>
                        <Input id="email" type="email" autoComplete="email" value={email} onChange={(val) => this.handleChange('email', val)} required />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 1:" htmlFor="tel1" required>
                        <Input id="tel1" type="tel" autoComplete="tel"  value={phone1} onChange={(val) => this.handleChange('phone1', val)} required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 2:" htmlFor="tel2">
                        <Input id="tel2" type="tel"  value={phone2} onChange={(val) => this.handleChange('phone2', val)} />
                    </FormGroup>
                </div>

                <button className="btn btn-sm btn-dark float-left" type="button"
                    onClick={this.props.setTabIndex.bind(this, this.props.tabIndex-1)}>
                    <i className="fas fa-arrow-circle-left"/> Previous
                </button>

                <button className="btn btn-sm btn-info float-right" type="submit">
                    Next <i className="fas fa-arrow-circle-right"/>
                </button>
            </form>
        )
    }
}