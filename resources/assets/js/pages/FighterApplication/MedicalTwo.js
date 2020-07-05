import React from 'react';
import { FormGroup, Radio, TextArea } from '../../components/FormControl';

export default class MedicalTwo extends React.Component {
    handleSubmit(e) {
        e.preventDefault();
        alert('submit form');
        // if validates push data to top level state, then move to next tab
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <h5 className="pb-4">Please answer the following eight questions carefully.</h5>

                <div className="application-section">
                    <FormGroup label="1. Has a physician ever said that you have a heart condition and recommended only medically supervised activity?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                    </FormGroup>

                    <FormGroup label="2. Do you have chest pain that’s brought on by physical activity?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                    </FormGroup>

                    <FormGroup label="3. Have you developed chest pain in the past month?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                    </FormGroup>

                    <FormGroup label="4. Have you on one or more occasions lost consciousness or fallen over as a result of dizziness?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                    </FormGroup>

                    <FormGroup label="5. Do you have a bone or joint problem that could be aggravated by the proposed physical activity?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                    </FormGroup>

                    <FormGroup label="6. Has a physician ever recommended medication for your blood pressure or a heart condition?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                    </FormGroup>

                    <FormGroup label="7. Have you ever been knocked out or concussed?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                        <TextArea className="mt-2 form-control" placeHolder="Please explain..." required />
                    </FormGroup>

                    <FormGroup label="8. Are you aware, through your own experience or a physician’s advice, of any other reason that would prohibit you from exercising without medical supervision?" required>
                        <Radio options={['Yes', 'No']}  inline/>
                        <TextArea className="mt-2 form-control" placeHolder="Please explain..." required />
                    </FormGroup>
                </div>

                <h6>If you answered “yes” to any of these eight questions you should consult your Physician before participation in any physical training can begin.</h6>

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