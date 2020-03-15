import React, { Component } from 'react';
import { ReCaptcha } from 'react-recaptcha-google'

export default class Captcha extends Component {
    constructor(props) {
        super(props);

        this.state = {
            code: null
        };

        this.onLoadRecaptcha = this.onLoadRecaptcha.bind(this);
        this.verifyCallback = this.verifyCallback.bind(this);
        this.onExpired = this.failedCallback.bind(this, 'Expired');
        this.onErrored = this.failedCallback.bind(this, 'Errored');
    }

    componentDidMount() {
        // Required JavaScript
        // const script = document.createElement('script');
        // script.src = 'https://www.google.com/recaptcha/api.js';
        // script.async = false;
              
        // document.body.appendChild(script);

        // Create Ref
        this.props.onRef(this);
    } 

    componentWillUnmount() {
        this.props.onRef(null);
    }

    execute() {
        // Invoke the invisible captcha
        this.captcha.execute();
    }

    onLoadRecaptcha() {
        if (this.captcha) {
            this.captcha.reset();
        }
    }
    
    verifyCallback(code) {
        this.setState({
            code: code
        }, this.props.onVerified(code))       
    }

    failedCallback(msg) {
        this.setState({
            code: null
        }, console.error(`reCAPTCHA ${msg}`));
    }
    
    render() {
        const {sitekey, size, theme} = this.props;

        
        return sitekey ? <ReCaptcha render="explicit"
                sitekey={sitekey}
                size={size || "invisible"}
                theme={theme || "light"}
                
                // callbacks & Refs
                ref={captcha => (this.captcha = captcha)}
                onloadCallback={this.onLoadRecaptcha}
                onExpired={this.failedCallback}
                onErrored={this.failedCallback}
                verifyCallback={this.verifyCallback}
            /> : null;
    };
};