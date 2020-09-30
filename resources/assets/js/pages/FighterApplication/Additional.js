import React from 'react';
import { FormGroup, Radio, TextArea } from '..//../components/FormControl';

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
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const { additional } = nextProps.formdata;

        if (!!additional && prevState != additional) {
            return nextProps.formdata.additional;
        }

        return prevState;
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

            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    {                      
                        this.props.customQuestions.map((question, key) => {
                            console.log(key);
                            return <CustomQuestion id={key} question={question} value={this.state[cq[key]]} onChange={this.handleChange.bind(this, cq[key])} key={key} />
                        })
                    }
                </div>

                <div className="row application-section">
                    <FormGroup className="col-12 form-group" label="Do you have any criminal convictions or are facing charges?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={criminalConvictions} onChange={(val) => this.handleChange('criminalConvictions', val)} required
                        />
                    </FormGroup>

                    <FormGroup className="col-12 form-group" label="Are you happy to take a drug screening test?" required>
                        <Radio options={['Yes', 'No']} inline
                            value={drugTest} onChange={(val) => this.handleChange('drugTest', val)} required
                        />
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