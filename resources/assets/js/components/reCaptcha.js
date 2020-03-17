import React, { Fragment, Component } from 'react';
import Reaptcha from 'reaptcha';
import $ from 'jquery';

export default class Captcha extends Component {
    constructor(props) {
        super(props);

        this.captcha = null;
        this.onVerify = this.recaptchaResponse.bind(this);
        this.onLoad = this.onLoad.bind(this);

        this.state = { 
            code: null,
            ready: false
        }
    }

    componentDidMount() {
        this.props.onRef(this);

        $.ajax({
            url: '/api/captcha'
        }).done((captcha) => {
            this.setState({
                sitekey: captcha.sitekey
            })
        });
    }

    onLoad() {
        console.log('captcha loaded');
        this.captcha.renderExplicitly();
    }

    recaptchaResponse(code) {
        this.setState({
            code: code || null
        }, () => {
            if(code) {
                this.props.onVerified(code)
            }
        });
    };

    execute() {
        if(!!this.props.requireReady && !this.state.ready) return;

        if(this.state.code) {
            this.captcha.reset();
        }

        this.captcha.execute();
    }

    render() {
    const {size, theme} = this.props;

        if(!this.state.sitekey) return null;
        
        return <Reaptcha
            ref={e => (this.captcha = e)}
            sitekey={this.state.sitekey}
            onExpire={this.onVerify}
            onVerify={this.onVerify}
            onLoad={this.onLoad}
            inject={false}
            size={size || "invisible"}
            theme={theme || "light"}
            explicit
        />
    }
}