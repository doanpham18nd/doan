import React, {Component} from 'react';

class CategoryOption extends Component {
    render() {
        return (
            <option value={this.props.obj.id}>{this.props.obj.name}</option>
        );
    }
}

export default CategoryOption;