import React from 'react';
import { FormGroup, Radio, TextArea } from '../../components/FormControl';
import ProgressButtos from './ProgressButtons';

const cq = {
    0: 'customZero',
    1: 'customOne',
    2: 'customTwo',
    3: 'customThree',
    4: 'customFour'
}

export default class Additional extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.additional || {
            customZero: null,
            customOne: null,
            customTwo: null,
            customThree: null,
            customFour: null,
            criminalConvictions: false,
            drugTest: false
        }

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('additional', this.state)
        this.props.setTabIndex(this.props.tabIndex * 1 + 1)
    }

    handleChange(key, val) {
        this.setState({ [key]: val })
        return null;
    }


    render() {
        const { criminalConvictions, drugTest } = this.state;

        return (

            <form onSubmit={this.handleSubmit}>
                <div className="row application-section">
                    {                      
                        this.props.customQuestions.map((question, key) => {
                            return <CustomQuestion id={key} question={question} value={this.state[cq[key]]} required={question.required} onChange={this.handleChange.bind(this, cq[key])} key={key} />
                        })
                    }
                </div>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Do you have any criminal convictions or are facing charges?" required>
                        <Radio id="criminalConvictions" options={['Yes', 'No']} inline
                            value={criminalConvictions} onChange={(val) => this.handleChange('criminalConvictions', val)} required
                        />
                    </FormGroup>

                    <FormGroup className="col-12 form-group" label="Are you happy to take a drug screening test?" required>
                        <Radio id="drugTest" options={['Yes', 'No']} inline
                            value={drugTest} onChange={(val) => this.handleChange('drugTest', val)} required
                        />
                    </FormGroup>
                </div>

                <ProgressButtos handleBack={() => this.props.setTabIndex(this.props.tabIndex -1) } />
            </form>
        )
    }
}

class CustomQuestion extends React.Component {
    render() {
        const { id, question, value, onChange } = this.props;
        return !!question ? (
            <FormGroup className="col-12 form-group" label={question.text} htmlFor={`cq-${id}`} required={!!question.required}>
                { 
                    question.type == "Text" ? 
                    <TextArea id={`cq-${id}`} required={!!question.required} value={value} onChange={onChange} /> :
                    <Radio options={['Yes', 'No']} inline value={value} onChange={onChange} required={!!question.required} /> 
                }
            </FormGroup>
        ) : null;
    }
}