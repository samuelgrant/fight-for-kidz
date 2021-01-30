import React, { Component } from 'react';
import Rselect from 'react-select';
import { isFunction } from '../helper';

// Dev docs: https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/autocomplete
const AutoComplete = [
    // Generic fields
    "off", "on", "email", "tel", "username", "new-password", "one-time-code", "bday",
    // Org fields
    "organization-title", "organization",
    // Name fields
    "name", "honorific-prefix", "given-name", "additional-name", "family-name",
    // Address fields
    "street-address", "address-line1", "address-line2", "address-level4", "address-level3", "address-level2", "address-level1", "country", "country-name", "postal-code",
]

const Type = ["date", "email", "file", "number", "password", "url",  "tel"];

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

    componentDidUpdate(prevProps) {
        if(prevProps.value != this.props.value) {
            this.setState({value: this.props.value});
        }
    }

    render() {
        const { id, className, name, placeHolder,
            autoFocus, accept, disabled, minLength, maxLength, readOnly, required // attribute properties
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
                accept={accept || null}

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

    _getValues(){
        const {options, value} = this.props;

        // No options provided
        if(!options[0]) return {};
        // No value selected, return first
        if(!value) return options[0];

        if(Array.isArray(value)) {
            return options.filter(opt => value.includes(opt.value));
        } else {
            return options.filter(opt => opt.value === value);
        }
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
            value={this._getValues()}
            // defaultValue={defaultValue}
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

    componentDidUpdate(prevProps) {
        if(prevProps.value != this.props.value) {
            this.setState({value: this.props.value});
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

export class Radio extends Component {
    constructor(props) {
        super(props);

        this.state = {
            value: this.props.value
        }
    }

    componentDidUpdate(prevProps) {
        if(prevProps.value != this.props.value) {
            this.setState({value: this.props.value});
        }
    }

    handleClick(e) {
        let value = e.target.value;

        this.setState({
            value
        }, () => {
            if(isFunction(this.props.onChange)) {
                this.props.onChange(value);
            }
        });
    }

    render() {
        const { id, inline, options, prefix, required, suffix } = this.props;

        return (
            <div>
                { options.map((option, key) => {
                    return (
                    <div className={inline ? 'form-check-inline' : 'form-check' } key={key}>
                        { prefix ?
                            key == 0 ? <span className="mr-3">{prefix}</span> : ""
                        : null}

                        <input id={`${id}:${option}`}
                            className="form-check-input"
                            name={id || null}
                            type="radio"
                            value={option}
                            required={required}
                            checked={option.toLowerCase() == (this.state.value || "").toLowerCase()}
                            onChange={this.handleClick.bind(this)}
                        />

                        <label className="form-check-label" htmlFor={`${id}:${option}`}>
                            {option}
                        </label>

                        { suffix ?
                            key == (options.length -1) ? <span className="ml-3">{suffix}</span> : ""
                        : null}
                    </div>
                    )
                })}
            </div>
        )
    }
}