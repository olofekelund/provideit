import React from 'react';

class AddressField extends React.Component {
    render() {
        return (
            <input type="text"
                value={this.props.value}
                onChange={event => this.props.onChange(event.target.value)}
            />
        );
    }
}

export default AddressField;
