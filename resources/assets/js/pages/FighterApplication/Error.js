import React from 'react';

export default class ReactError extends React.Component {
    render() {
        return (
            <div className="text-center text-white">
                <i className="fas fa-cog fa-7x text-danger fa-pulse slow" data-fa-transform="right-6 up-3" />
                <i className="fas fa-cog fa-5x text-dark" data-fa-transform="down-4" />
                <i className="fas fa-cog fa-10x text-warning fa-pulse slow" data-fa-transform="left-6" style={{'animationDirection': 'reverse'}} />

                <h1 className="pt-2 mb-1">Internal Server Error</h1>
                <span>This error was probably our fault. <br /> Please flick us a message and tell us what page you were trying to visit.</span>
            </div>
        )
    }
}