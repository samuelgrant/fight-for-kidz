import React from 'react';
import { FormGroup, Radio, TextArea } from '../../components/FormControl';
import ProgressButtos from './ProgressButtons';

export default class SportingExperience extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.previousSport || {
            fitnessLevel: null,
            boxingExperience: false,
            boxingDescribe: "",            
            otherExperience: "",
            hobbies: ""
        }
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const { previousSport } = nextProps.formdata;

        if(!!previousSport && prevState != previousSport){
            return nextProps.formdata.previousSport;
        }

        return prevState;
    }

    handleChange(key, val) {
        this.setState({[key]: val})
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('previousSport', this.state)
        this.props.setTabIndex(this.props.tabIndex * 1 +1)
    }

    render() {
        const { boxingExperience, boxingDescribe, fitnessLevel, hobbies, otherExperience } = this.state;

        if(boxingExperience == "No") this.handleChange.bind(this, 'boxingDescribe', null);

        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="How would you rate you fitness levels?" required>
                        <Radio id="fitnessLevel" options={["1", "2", "3", "4", "5"]} prefix="Poor" suffix="Excellent" inline
                           value={fitnessLevel} onChange={(val) => this.handleChange('fitnessLevel', val)}  required
                        />
                    </FormGroup>

                    <FormGroup className="col-12 form-group" label="Have you ever done boxing/kickboxing/martial arts?" required>
                        <Radio id="boxingExperience" options={["Yes", "No"]} inline required
                            value={boxingExperience} onChange={(val) => this.handleChange('boxingExperience', val)}
                        />
                        {
                            boxingExperience == "Yes" ? (
                                <TextArea placeHolder="Please describe your prior experience..." required
                                    value={boxingDescribe} onChange={(val) => this.handleChange('boxingDescribe', val)}
                                />
                            ) : null
                        }
                    </FormGroup>

                    <FormGroup className="col-12 form-group" label="Other Sporting Experience:" htmlFor="otherExperience" required>
                        <TextArea id="otherExperience" required
                            value={otherExperience} onChange={(val) => this.handleChange('otherExperience', val)}
                        />
                    </FormGroup>

                    <FormGroup className="col-12 form-group" label="Hobbies/interests:" htmlFor="hobbies" required>
                        <TextArea id="hobbies" required 
                            value={hobbies} onChange={(val) => this.handleChange('hobbies', val)}
                        />
                    </FormGroup>
                </div>

                <ProgressButtos handleBack={() => this.props.setTabIndex(this.props.tabIndex -1) } />
            </form>
        )
    }
}