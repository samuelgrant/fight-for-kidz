import React, { Component, Fragment } from 'react';

export default class Spinner extends Component {

    render() {
        return this.props.loading ? (
            <div className="sk-chase d-block mx-auto pt-5 mt-5">
                <div className="sk-chase-dot"></div>
                <div className="sk-chase-dot"></div>
                <div className="sk-chase-dot"></div>
                <div className="sk-chase-dot"></div>
                <div className="sk-chase-dot"></div>
                <div className="sk-chase-dot"></div>
            </div>
        ) : this.props.children;
    }
}