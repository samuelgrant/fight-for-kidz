import React from 'react';
import { FormGroup, Radio, TextArea } from '../../components/FormControl';

export default class MedicalTwo extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.medicalTwo || {
            heartCondition: false,
            chestPain: false,
            recentChestPain: false,
            dizziness: false,
            jointProblems: false,
            medication: false,
            knockedOut: false,
            knockedOutExplain: "",
            prohibited: false,
            prohibitedExplain: ""
        }
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const { medicalTwo } = nextProps.formdata;

        if (!!medicalTwo && prevState != medicalTwo) {
            return nextProps.formdata.medicalTwo;
        }

        return prevState;
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('medicalTwo', this.state)
        this.props.setTabIndex(this.props.tabIndex * 1 + 1)
    }

    handleChange(key, val) {
        this.setState({ [key]: val })
        return null;
    }
    render() {
        const {
            heartCondition,
            chestPain,
            recentChestPain,
            dizziness,
            jointProblems,
            medication,
            knockedOut,
            knockedOutExplain,
            prohibited,
            prohibitedExplain
        } = this.state

        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <h5 className="pb-4">Please answer the following eight questions carefully.</h5>

                <div className="application-section">
                    <FormGroup label="1. Has a physician ever said that you have a heart condition and recommended only medically supervised activity?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={heartCondition} onChange={(val) => this.handleChange('heartCondition', val)} required
                        />
                    </FormGroup>

                    <FormGroup label="2. Do you have chest pain that’s brought on by physical activity?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={chestPain} onChange={(val) => this.handleChange('chestPain', val)} required
                        />
                    </FormGroup>

                    <FormGroup label="3. Have you developed chest pain in the past month?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={recentChestPain} onChange={(val) => this.handleChange('recentChestPain', val)} required
                        />
                    </FormGroup>

                    <FormGroup label="4. Have you on one or more occasions lost consciousness or fallen over as a result of dizziness?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={dizziness} onChange={(val) => this.handleChange('dizziness', val)} required
                        />
                    </FormGroup>

                    <FormGroup label="5. Do you have a bone or joint problem that could be aggravated by the proposed physical activity?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={jointProblems} onChange={(val) => this.handleChange('jointProblems', val)} required
                        />
                    </FormGroup>

                    <FormGroup label="6. Has a physician ever recommended medication for your blood pressure or a heart condition?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={medication} onChange={(val) => this.handleChange('medication', val)} required
                        />
                    </FormGroup>

                    <FormGroup label="7. Have you ever been knocked out or concussed?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={knockedOut} onChange={(val) => this.handleChange('knockedOut', val)} required
                        />
                        {
                            knockedOut == "Yes" ? (
                                <TextArea className="mt-2 form-control" placeHolder="Please explain..." required
                                    value={knockedOutExplain} onChange={(val) => this.handleChange('knockedOutExplain', val)} required
                                />
                            ) : this.handleChange.bind(this, 'knockedOutExplain', null)
                        }
                    </FormGroup>

                    <FormGroup label="8. Are you aware, through your own experience or a physician’s advice, of any other reason that would prohibit you from exercising without medical supervision?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={prohibited} onChange={(val) => this.handleChange('prohibited', val)} required
                        />
                        {
                            prohibited == "Yes" ? (
                                <TextArea className="mt-2 form-control" placeHolder="Please explain..." required
                                    value={prohibitedExplain} onChange={(val) => this.handleChange('prohibitedExplain', val)} required
                                />
                            ) : this.handleChange.bind(this, 'prohibitedExplain', null)
                        }
                    </FormGroup>
                </div>

                <h6>If you answered “yes” to any of these eight questions you should consult your Physician before participation in any physical training can begin.</h6>

                <button className="btn btn-sm btn-info float-left"
                    onClick={this.props.setTabIndex.bind(this, this.props.tabIndex - 1)}>
                    <i className="fas fa-arrow-circle-left" /> Previous
                </button>
                <button className="btn btn-sm btn-info float-right" type="submit">
                    Next <i className="fas fa-arrow-circle-right" />
                </button>
            </form>
        )
    }
}