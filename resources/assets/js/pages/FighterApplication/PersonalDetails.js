import React from 'react';
import { FormGroup, Input, Radio } from '../../components/FormControl';

export default class PersonalDetails extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
            <form>
                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Date of Birth:" htmlFor="dob" required>
                        <Input id="dob" type="date" autoComplete="bday" required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Height (cm):" htmlFor="height" required>
                        <Input id="height" type="number" required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Current Weight (kg):" htmlFor="currentweight" required>
                        <Input id="currentweight" type="number" required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Expected Weight (kg):" htmlFor="expectedweight">
                        <Input id="expectedweight" type="number"/>
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Occupation:" htmlFor="occupation" required>
                        <Input id="occupation" type="text" required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Employer:" htmlFor="employer">
                        <Input id="employer" type="text" />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 form-group" label="Are you:" required>
                        <Radio options={['Male', 'Female']} />
                    </FormGroup>

                    <FormGroup className="col-md-6 form-group" label="Are you:" required>
                        <Radio options={['Left-handed', 'Right-handed']} />
                    </FormGroup>

                    <FormGroup className="col-md-12 form-group" label="Can you secure your own sponsor? (Not a condition of entry)" required>
                        <Radio options={['Yes', 'No']} inline />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Preferred Fight Name:" htmlFor="fightname">
                        <Input id="fightname" type="text" placeHolder="Leave blank if undecided" />
                    </FormGroup>

                    <FormGroup className="col-md-12 form-group" label="Please upload a recent photo of yourself:" required>
                        <h1 className="text-danger">TO DO</h1>
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