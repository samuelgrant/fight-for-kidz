import React from 'react';
import Tablist from './Tablist';
import PrivacyStatement from './PrivacyStatement';
import ContactInformation from './ContactInformation';
import PersonalDetails from './PersonalDetails';
import EmergencyContact from './EmergencyContact';
import SportingExperience from './SportingExperience';
import MedicalOne from './MedicalOne';
import MedicalTwo from './MedicalTwo';
import Additional from './Additional';
import Declaration from './Declaration';

const tabs = {
    0: PrivacyStatement,
    1: ContactInformation,
    2: PersonalDetails,
    3: EmergencyContact,
    4: SportingExperience,
    5: MedicalOne,
    6: MedicalTwo,
    7: Additional,
    8: Declaration
}

export default class Sections extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            tab: 0
        }

        this.enableAutosave = this.enableAutosave.bind(this);
        this.handleTabChange = this.changeTab.bind(this);
    }

    changeTab(tab) {
        this.setState({tab});
    }

    enableAutosave(bool) {
        if(bool) {
            this.props.enableAutosave();
        }

        this.changeTab(1);
    }

    render() {
        const Partial = tabs[this.state.tab];
        return (
            <div className="row">
                <div className="col-auto">
                    <Tablist tabs={tabs}
                        handleTabChange={this.handleTabChange}
                        tabIndex={this.state.tab}
                    />
                </div>

                <div className="col">
                    <h4 className="pb-4">{Partial.name.replace(/([A-Z])/g, ' $1').trim()}</h4>
                    <p>A red asterisk (<span className="font-weight-bold text-danger">*</span>) indicates a required field.</p>
                    <hr />
                    <Partial name={this.props.name}
                        enableAutosave={this.enableAutosave}
                        // Tabs
                        handleTabChange={this.handleTabChange}
                        tabIndex={this.state.tab}
                    />
                </div>
            </div>
        )
    }
}