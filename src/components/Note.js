import React from "react";

class Note extends React.Component {
  render() {
    return (
      <div
        onClick={this.props.toggleModal}
        className={this.props.classes}
        data-id={parseInt(this.props.id) + 1}
      >
        {this.props.children}
      </div>
    );
  }
}

export default Note;
