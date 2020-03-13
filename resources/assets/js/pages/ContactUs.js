import React, {Component, Fragment} from 'react';
import { render } from 'react-dom';
import { FormGroup, Input, Select, Checkbox } from '../components/FormControl';
import { General, Table, Sponsorship} from './ContactUs.Partials';
import $ from 'jquery';
import Spinner from '../components/Spinner';

const partials = {
    general: General,
    table: Table, 
    sponsorship: Sponsorship
};

export default class ContactUs extends Component {
    constructor(props){
        super(props);

        this.state = {
            type: 'general',
            types: [],
            loading: false,
            fields: {
                name: '',
                email: '',
                phone: '',
                message: '',
                company: '',
                sponsorshipTypes: [''],
                subscribe: true
            }
        }
    }

    componentDidMount(){
        this._getData();//If Any
    }

    _getData(){
        // ajax call to get data???
        // Maybe block some contact types during the year
        this.setState({
            types: [
                {value: 'general', label: 'General enquiry'},
                {value: 'table', label: 'Booking a corporate table'},
                {value: 'sponsorship', label: 'Becoming a Sponsor'}
            ]
        });
    }

    _updateState(key, val){
        this.setState({[key]: val});
    }

    _updateStateObj(objKey, key, val){
        let obj = this.state[objKey];
        obj[key] = val;       
        this.setState({[objKey]: obj});
    }

    _handleSubmit(e) {
        e.preventDefault();

        //Validate that we have sponsor types if required

        let formData = this.state.fields;
        formData['type'] = this.state.type;

        this._updateState('loading', true);

        //send
        $.ajax({
            method: 'post',
            url: '/contact-us',
            data: formData,
        }).done((json) => {
            console.log('sent', json);
            this._updateState('loading', false);
        }).fail((err) => {
            console.log(err);
            this._updateState('loading', false);
        });
    }

    render() {
        const Partial = partials[this.state.type];
        const { name, email, phone, subscribe } = this.state.fields;
        
        return (
            <div className="text-white text-center">
                <h1 className="mb-2">Contact Us</h1>
                <p className="mb-5">Send us a message and we will get back to you as soon as we can.</p>
                <Spinner loading={this.state.loading}>
                <form className="text-left" onSubmit={this._handleSubmit.bind(this)}>
                    <div className="row">
                        <FormGroup className="form-group col col-md-6 col-sm-12" label="Your Name:" htmlFor="name" required>
                            <Input id="name" type="text" value={name} 
                                onChange={this._updateStateObj.bind(this, 'fields', 'name')} required
                            />
                        </FormGroup>

                        <FormGroup className="form-group col col-md-6 col-sm-12" label="Your Email:" htmlFor="email" required>
                            <Input id="email" type="email" value={email} 
                                onChange={this._updateStateObj.bind(this, 'fields', 'email')} required 
                            />
                        </FormGroup>

                        <FormGroup className="form-group col col-md-6 col-sm-12" label="Your Phone Number:" htmlFor="phone" required>
                            <Input id="phone" type="tel" value={phone} 
                                onChange={this._updateStateObj.bind(this, 'fields', 'phone')} required 
                            />
                        </FormGroup>

                        <FormGroup className="form-group col col-md-6 col-sm-12" label="Talk to us about...." required>
                            <Select options={this.state.types} onChange={(selected) => this._updateState('type', selected.value)} 
                                defaultValue={{value: 'general', label: 'General enquiry'}} required
                            />
                        </FormGroup>

                        <Partial fields={this.state.fields} onChange={this._updateStateObj.bind(this)} />

                        <FormGroup>
                            <Checkbox id="emailUpdates" label="I would like to receive Fight for Kidz updates via email"
                                 checked={subscribe} onChange={this._updateStateObj.bind(this, 'fields', 'subscribe')}
                            />
                        </FormGroup>
                    </div>

                    <button className="btn btn-primary d-block mx-auto" type="submit">Send Email</button>
                </form>
                </Spinner>
            </div>
        )
    }
}

if(document.getElementById('ranchor_contactUs'))
    render(<ContactUs />, document.getElementById('ranchor_contactUs'));