import React from 'react';
import { Checkbox, FormGroup } from '../../components/FormControl';

export default class Declaration extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.declaration || {
            updates: false,
            declaration: false,
        }
    }

    static getDerivedStateFromProps(nextProps, prevState) {
        const { declaration } = nextProps.formdata;

        if (!!declaration && prevState != declaration) {
            return nextProps.formdata.declaration;
        }

        return prevState;
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateState('declaration', this.state)


    }

    handleChange(key, val) {
        this.setState({ [key]: val })
        return null;
    }

    render() {
        const { updates, declaration } = this.state;

        return (
            <form onSubmit={this.handleSubmit.bind(this)}>
                <div className="row application-section">
                    <div className="col-12 mb-3">
                        <FormGroup label="I would like to receive Fight for Kidz updates via email">
                            <Checkbox id="updates" checked={updates} onChange={(val) => this.handleChange('updates', val)} />
                        </FormGroup>
                    </div>

                    <div className="col-12" required>
                        <FormGroup label="I have provided true and accurate information in this application" required>
                            <Checkbox id="declaration" required checked={declaration} onChange={(val) => this.handleChange('declaration', val)} />
                        </FormGroup>
                    </div>
                </div>

                <button className="btn btn-sm btn-success d-block mx-auto mb-5">
                    <i className="fas fa-check-circle" /> Submit Form
                </button>
            </form>
        )
    }
}