import React from 'react';
import { FormGroup, Radio, TextArea } from '../../components/FormControl';

export default class SportingExperience extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
        <form onSubmit={this.handleSubmit.bind(this)}>
            <div className="row application-section">
                <FormGroup className="col-12 form-group" label="How would you rate you fitness levels?" required>
                    <Radio options={["1", "2", "3", "4", "5"]} prefix="poor" suffix="Excellent" inline required />
                </FormGroup>

                <FormGroup className="col-12 form-group" label="Have you ever done boxing/kickboxing/martial arts?" required>
                    <Radio options={["Yes", "No"]} inline required />
                    <TextArea placeHolder="Please describe your prior experience..." />
                </FormGroup>

                <FormGroup className="col-12 form-group" label="Other Sporting Experience:" htmlFor="othersports" required>
                    <TextArea id="othersports" required/>
                </FormGroup>

                <FormGroup className="col-12 form-group" label="Hobbies/interests:" htmlFor="hobbies" required>
                    <TextArea id="hobbies" required />
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