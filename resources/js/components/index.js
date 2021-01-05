import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

import AddressField from './AddressField';

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            fromAddress: 'anekdotgata',
            toAddress: 'karl johansgatan',
            fromAddressLookup: {},
            toAddressLookup: {},
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.validateInput = this.validateInput.bind(this);
    }

    handleSubmit() {
        Promise.all([
            axios.post(`http://localhost/api/address/autocomplete`, { address: this.state.toAddress }),
            axios.post(`http://localhost/api/address/autocomplete`, { address: this.state.fromAddress })
        ]).then(res => {
            const fromAddress = res[0].data.items[0];
            const toAddress = res[1].data.items[0];
            this.setState({
                fromAddressLookup: fromAddress,
                fromAddress: fromAddress.address.label,
                toAddressLookup: toAddress,
                toAddress: toAddress.address.label
            })

            console.log(toAddress)
        })
    }

    validateInput() {
        return this.state.fromAddress.length > 3 && this.state.toAddress.length > 3
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Hitta den prefekta podcasten för din resa</div>

                            <div className="card-body">Lorem nånting nånting</div>

                            <AddressField value={this.state.fromAddress} onChange={value => {
                                this.setState({ fromAddress: value })
                            }} />
                            <AddressField value={this.state.toAddress} onChange={value => {
                                this.setState({ toAddress: value })
                            }} />
                            <button onClick={this.handleSubmit} disabled={!this.validateInput()}>Skicka</button>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
