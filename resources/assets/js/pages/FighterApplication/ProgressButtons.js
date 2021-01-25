import React from 'react';

export default class ProgressButtos extends React.Component {
    render() {
        const { nextIcon, nextText, previousIcon, previousText, handleBack } = this.props;

        return (
            <React.Fragment>
                <button className="btn btn-sm btn-dark float-left" type="button" tabIndex="-1" onClick={() => handleBack()}>
                    { previousIcon ?? <i className="fas fa-arrow-circle-left"/> } { previousText || "Previous" }
                </button>

                <button className="btn btn-sm btn-info float-right" type="submit">
                    { nextText ?? "Next" } { nextIcon ?? <i className="fas fa-arrow-circle-right"/> }
                </button>
            </React.Fragment>
        )
    }
}