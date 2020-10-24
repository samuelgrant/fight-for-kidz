import React from 'react';
import Wrapper from '../../components/Wrapper';
import { Checkbox, FormGroup, Input, TextArea } from '../../components/FormControl';
import Button from '../../components/Button';

const url = '/a/site-settings/home';
const maxSize = 2000000;//2Mb in Bytes 

export default class HomePage extends React.Component {
    constructor(props) {
        super();

        this.state = {
            ready: false,
            image: {}
        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleImgUpload = this.handleImgUpload.bind(this);
    }

    componentDidMount() { this.fetchData() }

    fetchData() {
        $.ajax({url}).done((settings) => {
            this.setState({...settings, image: {}, ready: true})
        });
    }

    handleImgUpload(evt) {
        evt.preventDefault();
        evt.stopPropagation();

        // Get the image from the input and validate image size
        var file = this.validateFileSize(evt.target.files[0]);
        if (!file) return;

        const FR = new FileReader();
        FR.addEventListener("load", () => this.handleChange('image', {file: FR.result, name: file.name}), false)
        FR.readAsDataURL(file);
    }

    done(FR) {
        console.log(FR.file);
    }
    
    validateFileSize(file) {
        if(!file) {
            this.Alert.error('No image selected');
            return null;
        }

        // Block files that are too large
        if (file.size > maxSize) {
            this.Alert.error(`${file.name} is too big. The maximum file size is ${maxSize / 1000000}MB`);
            return null;
        }

        return file;
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
        const { pending, ready, about_us, display_merch, facebook_url } = this.state;

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
                        <div className="row">
                            <div className="col-md-6 col-sm-12">
                                <img className="img-fluid" src={this.state.image.file || `/storage/images/mainPagePhoto.jpg`} />
                            </div>

                            <div className="col-md-6 col-sm-12 text-center mt-auto mb-auto">
                                Featured on the home page, below the About Us text and next to the Facebook widget.
                                <input type="file" className="d-none" accept={[".jpg", ".jpeg"]} onChange={this.handleImgUpload} ref={(x) => this.fileInput = x} />

                                <Button type="button" className="btn btn-info btn-sm btn-file my-3" onClick={() => this.fileInput.click()} >
                                    <i className="fas fa-upload"/> Upload New Image
                                </Button>
                                
                                <label className="text-muted">Image must be a JPG &amp; less than 2MB</label>
                            </div>
                        </div>
                    </FormGroup>

                    <div className="text-right">
                        <Button className="btn btn-sm btn-danger mx-1" onClick={() => this.fetchData()}>Cancel</Button>
                        <Button className="btn btn-sm btn-success" pending={pending} type="submit">
                            <i className="fas fa-check-circle" /> Save Changes
                        </Button>
                    </div>
                </form>        
            </Wrapper>
        )
    }
}