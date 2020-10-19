import React, {Component} from 'react';
import { render } from 'react-dom';

import { FormGroup, Input, TextArea } from '../components/FormControl';
import Button from '../components/Button';
import Wrapper from '../components/Wrapper';

const url = '/a/dashboard/settings';

export default class HomeSettings extends Component {
    constructor(props) {
        super();

        this.state = {
            ready: false
        }

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() {
        $.ajax({url}).done((res) => {
            this.setState({...res, ready: true})
        })
    }

    handleSubmit(e) {
        e.preventDefault();
        alert('fire submit here');
    }

    handleChange(key, val) {
        this.setState({[key]: val});
    }

    render() {
        const { about_us, display_merch, facebook_url } = this.state;
        // TextArea: About us
        // Input URL: FacebookURL
        // Toggle: Merchandise Page
        // Photo: About Us Photo
        return (
            <form className="row" onSubmit={this.handleSubmit}>
                <FormGroup className="form-group col-sm-12 col-md-6" label="Facebook Page URL" htmlFor="facebook_url:">
                    <Input id="facebook_url" type="url" value={facebook_url} onChange={this.handleChange.bind(this, 'facebook_url')} />
                </FormGroup>

                <FormGroup className="form-group col-sm-12 col-md-6" label="Enable Merchandise Page:">
                    <p>// Developer Toggle</p>
                </FormGroup>

                <FormGroup className="form-group col-12" label="About Us Text:" htmlFor="about_us">
                    <TextArea id="about_us" min={150} max={300} rows={3} value={about_us} onChange={this.handleChange.bind(this, 'about_us')} />
                </FormGroup>

                <FormGroup className="form-group w-100" label="About Us Image">
                    <label>About Us Image</label>
                    <div className="col-sm-12 col-md-6">
                        //Image
                    </div>

                    <div className="col-sm-12 col-md-6">
                        //Image controls
                    </div>
                </FormGroup>
            </form>
        )
    }
}

if(document.getElementById('ranchor_home_settings')) {
    render(<HomeSettings />, document.getElementById('ranchor_home_settings'));
}