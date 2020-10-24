import React from 'react';
import Button from './Button';

const maxSize = 2000000;//2Mb in Bytes 

export default class ImageUploader extends React.Component {
    constructor(props) {
        super();

        this.handleImgUpload = this.handleImgUpload.bind(this);
    }

    handleImgUpload(evt) {
        evt.preventDefault();
        evt.stopPropagation();

        // Get the image from the input and validate image size
        var file = this.validateFileSize(evt.target.files[0]);
        if (!file) return;

        const FR = new FileReader();
        FR.addEventListener("load", () => this.props.onSelect({file: FR.result, name: file.name}), false)
        FR.readAsDataURL(file);
    }
    
    validateFileSize(file) {
        if(!file) {
            this.props.onError('No image selected');
            return null;
        }

        // Block files that are too large
        if (file.size > (this.props.maxSize || maxSize)) {
            this.props.onError(`${file.name} is too big. The maximum file size is ${(this.props.maxSize || maxSize) / 1000000}MB`);
            return null;
        }

        return file;
    }

    render() {
        const { previewSrc } = this.props;

        return (
            <div className="row">
                <div className="col-md-6 col-sm-12">
                    <img className="img-fluid" src={previewSrc} />
                </div>

                <div className="col-md-6 col-sm-12 text-center mt-auto mb-auto">
                    Featured on the home page, below the About Us text and next to the Facebook widget.
                    <input type="file" className="d-none" accept={[".jpg", ".jpeg"]} onChange={this.handleImgUpload} ref={(x) => this.fileInput = x} />

                    <Button type="button" className="btn btn-info btn-sm btn-file my-3" onClick={() => this.fileInput.click()} >
                        <i className="fas fa-upload"/> Upload New Image
                    </Button>
                    
                    <label className="text-muted">Image must be a JPG &amp; less than {`${(this.props.maxSize || maxSize) / 1000000}MB`}</label>
                </div>
            </div>
        )
    }
}