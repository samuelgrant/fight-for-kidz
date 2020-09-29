import React from 'react';
import { Checkbox, TextArea, FormGroup, Radio } from '../../components/FormControl'

export default class MedicalOne extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.medicalOne || {
            checkboxes: {
                "HeartDisease": false,
                "HeartSurgery": false,
                "HeartAttack": false,
                "Stroke": false,
                "Smoking": false,
                "Cancer": false,
                "Breathlessness": false,
                "Epilepsy": false,
                "ChestPain": false,
                "IrregularHeartbeat": false,
                "RespiratoryProblems": false,
                "JointPain": false,
                "Surgery": false,
                "DizzinessOrFainting": false,
                "HighCholesterol": false,
                "Hypertension": false,
                "Other": false
            },
            otherExplain: "",
            handInjuries: false,
            handInjuriesExplain: "",
            injuries: false,
            injuriesExplain: "",
            medication: false,
            medicationExplain: ""
        }
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const { medicalOne } = nextProps.formdata;

        if (!!medicalOne && prevState != medicalOne) {
            return nextProps.formdata.medicalOne;
        }

        return prevState;
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('medicalOne', this.state)
        this.props.setTabIndex(this.props.tabIndex * 1 + 1)
    }

    handleChange(key, val) {
        this.setState({ [key]: val })
        return null;
    }

    handleCheckboxChange(key, val) {
        let checkboxes = this.state.checkboxes;
        checkboxes[key] = val;
        this.setState({ checkboxes })
    }

    render() {
        const {
            checkboxes,
            otherExplain,
            handInjuries,
            handInjuriesExplain,
            injuries,
            injuriesExplain,
            medication,
            medicationExplain
        } = this.state;

        const boxes = Object.keys(checkboxes).map((p, key) => {
            name = p.replace(/([A-Z])/g, ' $1').trim();

            return (
                <div className="col-md-4 col-sm-6" key={key}>
                    <Checkbox id={p} label={name} checked={checkboxes[p]} onChange={(val) => this.handleCheckboxChange(p, val)} />
                </div>
            )
        });

        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <fieldset className="application-section mb-4">
                    <legend className="ml-3">Previous History</legend>
                    <h6 className="ml-4">Which conditions have you had in the past?</h6>
                    <div className="row mx-auto">

                        {boxes}

                        {checkboxes["Other"] ? (
                            <div className="col-12 pt-3 mb-0">
                                <TextArea placeHolder="Please explain...." required
                                    value={otherExplain} onChange={(val) => this.handleChange('otherExplain', val)}
                                />
                            </div>
                        ) : this.handleChange.bind(this, 'otherExplain', null)}

                    </div>
                </fieldset>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Have you ever had any hand injuries?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={handInjuries} onChange={(val) => this.handleChange('handInjuries', val)} required
                        />
                        {
                            handInjuries == 'Yes' ? (
                                <TextArea className="mt-2 form-control" placeHolder="Please explain" required
                                    value={handInjuriesExplain} onChange={(val) => this.handleChange('handInjuriesExplain', val)}
                                />
                            ) : this.handleChange.bind(this, 'handInjuriesExplain', null)
                        }
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Have you ever had any significant injuries (especially head injuries)?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={injuries} onChange={(val) => this.handleChange('injuries', val)} required
                        />
                        {
                            injuries == 'Yes' ? (
                                <TextArea className="mt-2 form-control" placeHolder="Please explain" required
                                    value={injuriesExplain} onChange={(val) => this.handleChange('injuriesExplain', val)}
                                />
                            ) : this.handleChange.bind(this, 'injuriesExplain', null)
                        }
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Are you currently taking any medications?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={medication} onChange={(val) => this.handleChange('medication', val)} required
                        />
                        {
                            medication == 'Yes' ? (
                                <TextArea className="mt-2 form-control" placeHolder="Please explain" required
                                    value={medicationExplain} onChange={(val) => this.handleChange('medicationExplain', val)}
                                />
                            ) : this.handleChange.bind(this, 'medicationExplain', null)
                        }
                    </FormGroup>
                </div>

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