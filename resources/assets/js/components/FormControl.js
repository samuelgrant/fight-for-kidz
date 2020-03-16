import React, { Component } from 'react';
import Rselect from 'react-select';
import { render } from 'react-dom';
import { isFunction } from '../helper';

// Dev docs: https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/autocomplete
const AutoComplete = [
    // Generic fields
    "off", "on", "email", "tel", "username", "new-password", "one-time-code",
    // Org fields
    "organization-title", "organization",
    // Name fields    
    "name", "honorific-prefix", "given-name", "additional-name", "family-name",
    // Address fields
    "street-address", "address-line1", "address-line2", "address-level4", "address-level3", "address-level2", "address-level1", "country", "country-name", "postal-code",
]

const Type = ["email", "password", "url", "number", "tel"];

// checkbox
export class Checkbox extends Component {
    constructor(props){
        super(props);

        this.state = {
            checked: this.props.checked || false
        };
    }

    _handleChange() {
        this.setState({
            checked: !this.state.checked
        }, () => {
            const onChange = this.props.onChange;
            if(isFunction(onChange)) {
                onChange(this.state.checked)
            }
        });
    }

    render() {
        const {id, label, noSelector} = this.props;

        if(!id) throw ("An id is required");

        return (
            <div className={`custom-control custom-checkbox ${noSelector ? 'noselect' :''}`}>
                <input type="checkbox" className="custom-control-input" id={id} checked={this.state.checked} onChange={this._handleChange.bind(this)} />
                <label className="custom-control-label" htmlFor={id}>{label}</label>
            </div>
        )
    }
}

export class FormGroup extends Component {
    render() {
        const { children, className, htmlFor, label, required, style} = this.props;

        let _label = label ? (
                <label className={required ? "required" : ''} htmlFor={htmlFor || null} >
                    {label}
                </label>
            ) : null ;

        return (
            <div className={className || 'form-group'} style={style}>
                {_label}
                {children}
            </div>
        )
    }
}

export class Input extends Component {
    constructor(props) {
        super(props);

        this.state = {
            value: this.props.value || ""
        }
    }

    handleChange(e) {
        let value = e.target.value;

        this.setState({value}, () => {
            let onChange = this.props.onChange;

            // Send the value to the (optional) callback
            if(isFunction(onChange)){
                onChange(value);
            }
        });
    }

    getAutoComplete() {
        // Check against our allowed auto completes
        if (AutoComplete.includes(this.props.autoComplete))
            return this.props.autoComplete;

        // Guess the probable setting or return off
        switch (this.props.autoComplete) {
            case "phone":
                return "tel";
            case "password":
                return "current-password";
            case "newpassword":
                return "new-password";
            default:
                return "off";
        }
    }

    getType() {
        if (!this.props.type)
            throw 'You must provide a type for the input field';

        // Check against our allowed types
        if (Type.includes(this.props.type))
            return this.props.type;

        // No type found? - use TEXT as default
        
        return 'text';
    }

    componentWillReceiveProps(nextProps) {
        if (this.state.value != nextProps.value)
            this.setState({
                value: nextProps.value
            });
    }


    render() {
        const { id, className, name, placeHolder,
            autoFocus, disabled, minLength, maxLength, readOnly, required // attribute properties
        } = this.props;
        
        return (
            <input id={id || null}
                className={className || 'form-control'}
                type={this.getType()}
                name={name || null}
                autoComplete={this.getAutoComplete()}
                placeholder={placeHolder || null}
                                
                // Attribute properties
                autoFocus={!!autoFocus}
                disabled={!!disabled}
                minLength={minLength || null}
                maxLength={maxLength || null}
                readOnly={!!readOnly}
                required={!!required}
                                
                // Controlled props
                onChange={this.handleChange.bind(this)}
                onPaste={this.handleChange.bind(this)}
                value={this.state.value || ""}
            />
        )
    }
}

export class Select extends Component {  
    _handleChange(selected) {
        this.props.onChange((!!selected) ? selected : []);
    }

    render() {
        const { className, name, options, style, placeHolder,
            autoFocus, isDisabled, isMulti, isSearchable, required, // attribute properties
            defaultValue, value
        } = this.props;

        return  <Rselect className={className}
            name={name}
            placeHolder={placeHolder}
            style={style}
            required={required}

            Attribute properties
            autoFocus={autoFocus}
            isDisabled={isDisabled}
            isMulti={isMulti}
            isSearchable={isSearchable}
            options={options}

            Controlled props
            value={value}
            defaultValue={defaultValue}
            onChange={this._handleChange.bind(this)}
        />
    }
}

export class TextArea extends Component {
    constructor(props) {
        super(props);

        this.state = {
            value: this.props.value
        }
    }

    handleChange(e) {
        let value = e.target.value;

        this.setState({
            value
        }, () => {
            let onChange = this.props.onChange;
            
            // Send the value to the (optional) callback
            if(isFunction(onChange)){
                onChange(value);
            }
        });
    }

    componentWillReceiveProps(nextProps) {
        if (this.state.value != nextProps.value) {
            this.setState({
                value: nextProps.value
            });
        }
    }

    getCharCount() {
        return this.state.value && this.state.value.length ? this.state.value.length : 0
    }

    render() {
        const { id, className, name, placeHolder,
            autoFocus, disabled, minLength, maxLength, readOnly, required, rows // attribute properties
        } = this.props;

        let charLimit;
        if (this.props.maxLength) {
            charLimit = (
                <span className="d-block text-right">{maxLength - this.getCharCount()} characters remaining</span>
            )
        }

        return (
            <React.Fragment>
                <textarea id={id || null}
                    className={className || 'form-control'}
                    name={name || null}
                    placeholder={placeHolder || null}
                    
                    // Attribute properties
                    autoFocus={!!autoFocus}
                    disabled={!!disabled}
                    maxLength={maxLength || null}
                    minLength={minLength || null}
                    readOnly={!!readOnly}
                    required={!!required}
                    rows={rows || null}

                    // Controlled props
                    onChange={this.handleChange.bind(this)}
                    value={this.state.value || ""}
                />
                {charLimit}
            </React.Fragment>
        )
    }
}