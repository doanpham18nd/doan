import React, {Component} from 'react';

class Address extends Component {

    checkDefault = () => {
        if(this.props.obj.default) {
            return 'checked'
        }
        return  ''
    };

    render() {
        return (
            <div>
                <input type="radio" name="address" id={"address" + this.props.obj.id} onChange={(event) => this.props.handleFieldChange(event)} value={this.props.obj.id}
                       defaultChecked={this.checkDefault()}
                />
                <label htmlFor={"address" + this.props.obj.id} className="address-label"> <span
                    className="">{this.props.username} {this.props.phone} </span> -
                    {this.props.obj.address}, {this.props.obj.ward_name}, {this.props.obj.district_name}, {this.props.obj.province_name}</label>
            </div>
        );
    }
}

export default Address;