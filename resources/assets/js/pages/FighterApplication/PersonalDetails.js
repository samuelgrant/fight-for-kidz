import React from 'react';
import { FormGroup, Input, Radio } from '../../components/FormControl';

export default class PersonalDetails extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.personal || {
            currentWeight: "",
            dob: "",
            employer: "",
            expectedWeight: "",
            fightname: "",
            gender: "",
            hand: "",
            height: "",
            image: "",
            occupation: "",
            ownsponsor: ""
        }
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const { personal } = nextProps.formdata;

        if(!!personal && prevState != personal){
            return nextProps.formdata.personal;
        }

        return prevState;
    }

    handleChange(key, val) {
        this.setState({[key]: val})
    }

    handleImageUpload(e) {
        this.handleChange('image', e.target.files[0]);
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('personal', this.state)
        this.props.setTabIndex(this.props.tabIndex * 1 +1)
    }

    render() {
        const { currentWeight, dob, employer, expectedWeight, gender, hand, height, image, occupation, ownsponsor } = this.state;
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Date of Birth:" htmlFor="dob" required>
                        <Input id="dob" type="date" autoComplete="bday" value={dob} onChange={(val) => this.handleChange('dob', val)} required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Height (cm):" htmlFor="height" required>
                        <Input id="height" type="number" value={height} onChange={(val) => this.handleChange('height', val)} required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Current Weight (kg):" htmlFor="currentweight" required>
                        <Input id="currentweight" type="number"  value={currentWeight} onChange={(val) => this.handleChange('currentWeight', val)} required/>
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Expected Weight (kg):" htmlFor="expectedweight">
                        <Input id="expectedweight" type="number"  value={expectedWeight} onChange={(val) => this.handleChange('expectedWeight', val)}/>
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Occupation:" htmlFor="occupation" required>
                        <Input id="occupation" type="text"  value={occupation} onChange={(val) => this.handleChange('occupation', val)} required />
                    </FormGroup>

                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Employer:" htmlFor="employer">
                        <Input id="employer" type="text"  value={employer} onChange={(val) => this.handleChange('employer', val)} />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 form-group" label="Are you:" required>
                        <Radio options={['Male', 'Female']} value={gender} onChange={(val) => this.handleChange('gender', val)} />
                    </FormGroup>

                    <FormGroup className="col-md-6 form-group" label="Are you:" required>
                        <Radio options={['Left-handed', 'Right-handed']} value={hand} onChange={(val) => this.handleChange('hand', val)} />
                    </FormGroup>

                    <FormGroup className="col-md-12 form-group" label="Can you secure your own sponsor? (Not a condition of entry)" required>
                        <Radio options={['Yes', 'No']} inline  value={ownsponsor} onChange={(val) => this.handleChange('ownsponsor', val)} />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-md-6 col-sm-12 form-group" label="Preferred Fight Name:" htmlFor="fightname">
                        <Input id="fightname" type="text" placeHolder="Leave blank if undecided" onChange={(val) => this.handleChange('fightname', val)} />
                    </FormGroup>

                    <FormGroup className="col-md-12 form-group" label="Please upload a recent photo of yourself:" htmlFor="photo" required>
                        <input id="photo" type="file" accept="image/*"  onChange={(file) => this.handleImageUpload(file)} required />
                    </FormGroup>
                </div>

                <button className="btn btn-sm btn-dark float-left"
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