import React, {Component} from 'react';
import { render } from 'react-dom';

import { FormGroup, Input } from '../components/FormControl';
import Button from '../components/Button';
import Wrapper from '../components/Wrapper';

const url = '/a/dashboard/settings/metadata';

export default class Metasettings extends Component {
    constructor(props) {
        super();

        this.state = {
            ready: false
        }

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() {
        $.ajax({url}).done((metadata) => {
            this.setState({...metadata, ready: true})
        });
    }

    handleSubmit(e) {
        e.preventDefault();
        $.ajax({
            url,
            method: 'patch',
            data: {
                ...this.state,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: this.setState({pending: true}),
            allways: this.setState({pending: false}),
            success: (msg) => this.Alert.success(msg),
            error: () => this.Alert.error('Something went wrong, please try again later!')
        });
    }

    handleChange(key, val) {
        this.setState({[key]: val});
    }

    render() {
        const { pending, ready, seo_author, seo_description, seo_keywords, seo_theme_color } = this.state;

        if (!ready)  return (
            <span>
                <i className="fas fa-spinner fa-1x fa-spin mr-2"/>
                Loading...
            </span>
        );

        return (
            <Wrapper AlertRef={Alert => (this.Alert = Alert)}>
                <form onSubmit={this.handleSubmit}>
                    <FormGroup htmlFor="seo_author" label="Author" >
                        <Input id="seo_author" type="text" value={seo_author} onChange={this.handleChange.bind(this, 'seo_author')} />
                    </FormGroup>

                    <FormGroup htmlFor="seo_description" label="Description" >
                        <Input id="seo_description" type="text" value={seo_description} onChange={this.handleChange.bind(this, 'seo_description')} />
                    </FormGroup>

                    <FormGroup htmlFor="seo_keywords" label="Keywords" >
                        <Input id="seo_keywords" type="text" value={seo_keywords} onChange={this.handleChange.bind(this, 'seo_keywords')} />
                    </FormGroup>

                    <FormGroup htmlFor="seo_theme_color" label="Theme Colour:" >
                        <Input id="seo_theme_color" className="form-control d-inline" type="color" value={seo_theme_color}  onChange={this.handleChange.bind(this, 'seo_theme_color')} />
                    </FormGroup>

                    <Button className="btn btn-primary" pending={pending} type="submit">
                        <i className="fas fa-check-circle" /> Save Changes
                    </Button>
                </form>
            </Wrapper>
        );
    }
}

if(document.getElementById('ranchor_metadata')) {
    render(<Metasettings />, document.getElementById('ranchor_metadata'));
}
