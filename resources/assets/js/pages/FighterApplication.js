import React, { Component } from 'react';
import { render } from 'react-dom';
import ReactError from './FighterApplication/Error';
import Cookies from 'js-cookie'
/** Application Sections */
import Tablist from './FighterApplication/Tablist';
import PrivacyStatement from './FighterApplication/PrivacyStatement';
import ContactInformation from './FighterApplication/ContactInformation';
import PersonalDetails from './FighterApplication/PersonalDetails';
import EmergencyContact from './FighterApplication/EmergencyContact';
import SportingExperience from './FighterApplication/SportingExperience';
import MedicalOne from './FighterApplication/MedicalOne';
import MedicalTwo from './FighterApplication/MedicalTwo';
import Additional from './FighterApplication/Additional';
import Declaration from './FighterApplication/Declaration';

/** Define the order of the tabs */
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

export default class FighterApplication extends Component {
    constructor(props) {
        super(props);

        this.state = {
            _cookieConsent: false,
            _hasError: false,
            _ready: false,
            eventdata: {},
            formdata: {},
            tabIndex: 0
        }

        this.handleAutoSave  = this.setAutosave.bind(this);
        this.handleSetTabIndex = this.setTabIndex.bind(this);
        this.handleSetFormData = this.setFormData.bind(this);
    }

    static getDerivedStateFromError(error) {
        return { _hasError: true };
    }

    componentDidMount() {
        $.ajax({
            method: 'get',
            url: '/api/fighter-application',
            success: ((eventdata) => {
                let formdata = {};

                if(!!Cookies.getJSON('fighterapp')) {
                    formdata = Cookies.getJSON('fighterapp');
                }

                this.setState({
                    eventdata,
                    formdata,
                    _ready: true
                });
            }),
        })
    }

    // Store the applicaiton data in the cookie
    componentDidUpdate(){
        if(this.state._cookieConsent) {
            // Expires in seven days
            let expires = new Date(new Date());
            expires.setDate(expires.getDate() + 7)

            Cookies.set('fighterapp', this.state.formdata, {expires})
        }
    }

    // Enable/disable the auto save cookie
    setAutosave(bool) {
        let formdata = this.state.formdata;
        if(!bool) {
            formdata = {};
            Cookies.remove('fighterapp');
        }

        this.setState({
            _cookieConsent: bool,
            formdata
        });
    }

    // Update the applicants data (form answers)
    setFormData(key, val) {
        let formdata = this.state.formdata;
        formdata[key] = val;
        this.setState({formdata});
    }

    // Change the application tab
    setTabIndex(tabIndex) {
        this.setState({tabIndex});
    }

    render() {
        const { formdata, eventdata, tabIndex } = this.state;
        // Loading application settings from API.
        if(!this.state._ready) return null;

        // Fetch the active tab from the tabs object
        // using this.state.tabIndex
        const Partial = tabs[tabIndex];

        return this.state._hasError ?
        <ReactError /> : (
            <div className="row">
                <div className="col-auto">
                    <Tablist tabs={tabs}
                        setTabIndex={this.handleSetTabIndex}
                        tabIndex={this.state.tabIndex}
                    />
                </div>

                <div className="col">
                    <h4 className="pb-4">{Partial.name.replace(/([A-Z])/g, ' $1').trim()}</h4>
                    <p>A red asterisk (<span className="font-weight-bold text-danger">*</span>) indicates a required field.</p>
                    <hr />
                    <Partial formdata={formdata}
                        // Event attributes
                        name={eventdata._eventName}
                        customQuestions={eventdata._customQuestions}
                        autoSave={this.handleAutoSave}
                        // Tabs
                        updateState={this.handleSetFormData}
                        setTabIndex={this.handleSetTabIndex}
                        tabIndex={tabIndex}
                    />
                </div>
            </div>
        )
    }
}

if(document.getElementById('ranchor_fighterapp')) {
    render(<FighterApplication />, document.getElementById('ranchor_fighterapp'));
}