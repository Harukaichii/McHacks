import React from "react";

class Note extends React.Component {
  render() {
    return (
      <div onClick={this.props.toggleModal} className={this.props.classes}>
        {this.props.children}
      </div>
    );
  }
}

export default Note;
