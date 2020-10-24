import React from 'react';
import Wrapper from '../../components/Wrapper';
import { Checkbox, FormGroup, Input, TextArea } from '../../components/FormControl';
import Button from '../../components/Button';
import ImageUploader from '../../components/ImageUpload';

const url = '/a/site-settings/home';

export default class HomePage extends React.Component {
    constructor(props) {
        super();

        this.state = {
            ready: false,
            image: {}
        }

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() { this.fetchData() }

    fetchData() {
        $.ajax({url}).done((settings) => {
            this.setState({...settings, image: {}, ready: true})
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
        const { pending, ready, about_us, display_merch, facebook_url, image } = this.state;

        if (!ready)  return (
            <span>
                <i className="fas fa-spinner fa-1x fa-spin mr-2"/>
                Loading...
            </span>
        );
            
        return (
            <Wrapper AlertRef={Alert => (this.Alert = Alert)}>
                <form className="pt-3" onSubmit={this.handleSubmit}>
                    <FormGroup label="About Us Text" htmlFor="aboutus" required>
                        <TextArea id="aboutus" rows={5} value={about_us} onChange={this.handleChange.bind(this, 'about_us')} required />
                    </FormGroup>

                    <FormGroup label="Facebook URL" htmlFor="facebookUrl" required>
                        <Input id="facebookUrl" type="url" value={facebook_url} onChange={this.handleChange.bind(this, 'facebook_url')} required />
                    </FormGroup>

                    <Checkbox id="emailUpdates" label="Enable Merchandise Page"
                        checked={display_merch} onChange={this.handleChange.bind(this, 'display_merch')}
                    />

                    <FormGroup className="form-group pt-3" label="Featured Image">
                        <ImageUploader previewSrc={image.file || `/storage/images/mainPagePhoto.jpg`}
                            onError={(msg) => this.Alert.error(msg)}
                            onSelect={(image) => this.handleChange('image', image)} 
                        />
                    </FormGroup>

                    <div className="text-right">
                        <Button className="btn btn-sm btn-danger mx-1" onClick={() => this.fetchData()}>
                            <i className="fas fa-undo" /> Reset    
                        </Button>

                        <Button className="btn btn-sm btn-success" pending={pending} type="submit">
                            <i className="fas fa-check-circle" /> Save Changes
                        </Button>
                    </div>
                </form>        
            </Wrapper>
        )
    }
}