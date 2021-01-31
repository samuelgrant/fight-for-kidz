import React from 'react';
import { Checkbox, FormGroup } from '../../components/FormControl';
import ProgressButtos from './ProgressButtons';

export default class Declaration extends React.Component {
    constructor(props) {
        super(props);

        this.state = this.props.formdata.declaration || {
            updates: false,
            declaration: false,
        }
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
                        <Checkbox id="updates" label="I would like to receive Fight for Kidz updates via email"
                            checked={updates} onChange={(val) => this.handleChange('updates', val)} 
                        />
                    </div>

                    <div className="col-12" required>
                        <Checkbox id="declaration" label="I have provided true and accurate information in this application"
                            required checked={declaration} onChange={(val) => this.handleChange('declaration', val)} 
                        />
                    </div>
                </div>

                <ProgressButtos nextText="Submit Application" nextIcon={<i className="fas fa-check-circle" />}
                    handleBack={() => this.props.setTabIndex(this.props.tabIndex -1) } />
            </form>
        )
    }
}