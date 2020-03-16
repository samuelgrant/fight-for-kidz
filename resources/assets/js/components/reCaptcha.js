import React, { Fragment, Component } from 'react';
import Reaptcha from 'reaptcha';

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
        // this.captcha.renderExplicitly();
    }

    onLoad() {
        this.setState({ ready: true });
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
        if(!this.state.ready) return;

        if(this.state.code) {
            this.captcha.reset();
        }

        this.captcha.execute();
    }

    render() {
    const {sitekey, size, theme} = this.props;

        return sitekey ? <Reaptcha
            ref={e => (this.captcha = e)}
            sitekey={this.props.sitekey}
            onExpire={this.onVerify}
            onVerify={this.onVerify}
            onLoad={this.onLoad}
            size={size || "invisible"}
            theme={theme || "light"}
            // explicit
        /> : null;
    }
}