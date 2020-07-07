import React from 'react';
import { Checkbox, TextArea, FormGroup, Radio } from '../../components/FormControl'

export default class MedicalOne extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <fieldset className="application-section mb-4">
                    <legend className="ml-3">Previous History</legend>
                    <h6 className="ml-4">Which conditions have you had in the past?</h6>
                    <div className="row mx-auto">
                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Heart Disease" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Heart Surgery" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Heart Attack" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Stroke" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Smoking" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Cancer" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Breathlessness" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Epilepsy" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Chest Pain" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Irregular Heartbeat" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Respiratory Problems" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Joint Pain" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Surgery" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Dizziness or Fainting" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="High Cholesterol" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Hypertension" />
                        </div>

                        <div className="col-md-4 col-sm-6">
                            <Checkbox id=" " label="Other" />
                        </div>

                        <div className="col-12 pt-3 mb-0">
                            <TextArea placeHolder="Please explain...." />
                        </div>
                    </div>
                </fieldset>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Have you ever had any hand injuries?" required>
                        <Radio options={['Yes', 'No']} inline />
                        <TextArea className="mt-2 form-control" placeHolder="Please explain" />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Have you ever had any significant injuries (especially head injuries)?" required>
                        <Radio options={['Yes', 'No']} inline />
                        <TextArea className="mt-2 form-control" placeHolder="Please explain" />
                    </FormGroup>
                </div>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Are you currently taking any medications?" required>
                        <Radio options={['Yes', 'No']} inline />
                        <TextArea className="mt-2 form-control" placeHolder="Please explain" />
                    </FormGroup>
                </div>

                <button className="btn btn-sm btn-info float-left"
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