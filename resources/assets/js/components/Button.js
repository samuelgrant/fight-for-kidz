import { extend } from 'lodash';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { setTimeout } from 'timers';

export default class Button extends Component {
    constructor() {
        super();

        this.state = {
            width: 0
        };

        this.contentRef = React.createRef();
    }

    componentDidMount() {
        let width = ReactDOM.findDOMNode(this.contentRef.current).getBoundingClientRect().width;

        if(width > this.state.width) {
            let width = Math.trunc(Math.round(width));
            this.setState({width});
        }
    }

    handleClick() {
        if(this.props.onClick) {
            this.props.onClick();
        }
    }

    render() {
        return <button className={this.props.className || "btn btn-primary"}
            type={this.props.type || "button"} disabled={this.props.disabled || this.props.pending}
            style={{ minWidth: `${this.state.width}px` }}
            ref={this.contentRef} onClick={this.handleClick.bind(this)} >
                {this.props.pending ? <i className="fas fa-spinner-third fa-spin"/> : this.props.children || ""}
        </button>
    }
}