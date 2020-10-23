import React, { Component } from 'react';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

export default class Wrapper extends Component {

    /**
     * Creates the required ref
     * so we can call the alert()
     * and responseAlert() methods
     */
    componentDidMount() {
        if (this.props.AlertRef) {
            this.props.AlertRef(this);
        }
    }

    /**
     * Tides up resources after use
     */
    componentWillUnmount() {
        if (this.props.AlertRef) {
            this.props.AlertRef(undefined);
        }
    }

    info(message) { toast.info(message); }
    success(message) { toast.success(message); }
    warn(message) { toast.warning(message); console.warn(message); }
    error(message) { toast.error(message); console.error(message); }

    render() {
        return (
            <div className={this.props.className || null}>
                {
                    this.props.loading ?
                    <div className="sk-chase d-block mx-auto pt-5 mt-5">
                        <div className="sk-chase-dot"></div>
                        <div className="sk-chase-dot"></div>
                        <div className="sk-chase-dot"></div>
                        <div className="sk-chase-dot"></div>
                        <div className="sk-chase-dot"></div>
                        <div className="sk-chase-dot"></div>
                    </div>
                    : this.props.children

                }

                <ToastContainer
                    position="top-right"
                    autoClose={10 * 1000}
                    hideProgressBar={false}
                    closeOnClick={true}
                    newestOnTop={false}
                    closeButton={false}
                    pauseOnHover
                />
            </div>
        );
    }
}