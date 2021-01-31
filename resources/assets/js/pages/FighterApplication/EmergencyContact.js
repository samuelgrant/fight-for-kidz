import React from 'react';
import { FormGroup, Input } from '../../components/FormControl';
import ProgressButtos from './ProgressButtons';

export default class EmergencyContact extends React.Component {
    constructor(props) {
        super(props);

        this.state  = this.props.formdata.emergency || {
            firstName: "",
            lastName: "",
            email: "",
            phone1: "",
            phone2: "",
            relationship: ""
        }
    }

    handleChange(key, val) {
        this.setState({[key]: val})
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('emergency', this.state)
        this.props.setTabIndex(this.props.tabIndex * 1 +1)
    }

    render() {
        const { firstName, lastName, email, phone1, phone2, relationship } = this.state;

        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="First Name:" htmlFor="em:firstname" required>
                        <Input id="em:firstname" type="text" value={firstName} onChange={(val) => this.handleChange('firstName', val)}  required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Last Name:" htmlFor="em:lastname" required>
                        <Input id="em:lastname" type="text" value={lastName} onChange={(val) => this.handleChange('lastName', val)}  required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Relationship:" htmlFor="em:relationship" required>
                        <Input id="em:relationship" type="text" value={relationship} onChange={(val) => this.handleChange('relationship', val)}  required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Email:" htmlFor="em:email" required>
                        <Input id="em:email" type="email" value={email} onChange={(val) => this.handleChange('email', val)}  required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 1:" htmlFor="em:phone1" required>
                        <Input id="em:phone1" type="tel" value={phone1} onChange={(val) => this.handleChange('phone1', val)}  required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Phone 2:" htmlFor="em:phone2">
                        <Input id="em:phone2" type="tel" value={phone2} onChange={(val) => this.handleChange('phone2', val)}/>
                    </FormGroup>
                </div>

                <ProgressButtos handleBack={() => this.props.setTabIndex(this.props.tabIndex -1) } />
            </form>
        )
    }
}