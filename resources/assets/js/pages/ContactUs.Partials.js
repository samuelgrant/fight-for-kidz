import React, { Component, Fragment } from 'react';
import { FormGroup, Input, Select, TextArea } from '../components/FormControl';

export class General extends Component {
    render() {
        const { message } = this.props.fields;

        return (
            <FormGroup className="form-group col col-12" label='Your Message:' htmlFor='message' required>
                <TextArea id='message' maxLength='1000' rows='6' required value={message}
                    onChange={this.props.onChange.bind(this, 'fields', 'message')} 
                />
            </FormGroup>
        )
    }
}

export class Table extends Component {
    render() {
        const { message } = this.props.fields;

        return (
            <FormGroup className="form-group col col-12" label='Your Message: (Optional)' htmlFor='message'>
                <TextArea id='message' maxLength='1000' rows='6' value={message}
                    onChange={this.props.onChange.bind(this, 'fields', 'message')}
                />
            </FormGroup>
        )
    }
}

const options = [
    { label: 'event', value: 'event'},
    { label: 'bout', value: 'bout'},
    { label: 'contender', value: 'contender'},
    { label: 'team', value: 'team'},
]

export class Sponsorship extends Component {   
    _handleSelectChange(selected){
        this.props.onChange('fields', 'sponsorshipTypes', selected.map(prop => prop.value));
    }

    _getSelectedOptions(selected){
        let array = [];
        for(let i = 0; i < selected.length; i++){
            array.push(options.filter(s => s.value == selected[i]));
        }

        return array;
    }

    render() {
        const { company, message, sponsorshipTypes} = this.props.fields;
        
        return (
            <Fragment>
                <FormGroup className="form-group col col-12" label="Your Company: (Optional)" htmlFor="company">
                    <Input id="company" type="tel" autoComplete="company" value={company} 
                        onChange={this.props.onChange.bind(this, 'fields', 'company')}
                    />
                </FormGroup>

                <FormGroup className="form-group col col-12" label="What type(s) of sponsorship are you interested in?" required>
                    <Select options={options} value={sponsorshipTypes} isMulti required
                        onChange={this._handleSelectChange.bind(this)} 
                    />
                    <label className="text-danger">Select any that apply</label>
                </FormGroup>

                <FormGroup className="form-group col col-12" label='Your Message: (Optional)' htmlFor='message'>
                    <TextArea id='message' maxLength='1000' rows='6' value={message}
                        onChange={this.props.onChange.bind(this, 'fields', 'message')}
                    />
                </FormGroup>
            </Fragment>
        )
    }
}
