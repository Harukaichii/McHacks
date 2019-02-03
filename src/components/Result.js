import React from "react";
import Note from "./Note";
import Modal from "./Modal";

// Result displays the results of the query
class Result extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      year: this.props.year,
      month: this.props.month,
      days: this.props.day,
      activeDay: this.props.activeDay
    };
  }

  static getDerivedStateFromProps({ year, month, days, activeDay, showModal }) {
    return { year, month, days, activeDay, showModal };
  }

  render() {
    return (
      <>
        <div className="container-grid">
          {this.state.days.map((v, i) => {
            let classes =
              +this.state.activeDay === i + 1 ? "note active" : "note";
            let disable = i + 1 < this.state.activeDay ? "disable" : null;

            classes = `${classes} ${disable}`;
            return (
              <Note
                toggleModal={this.props.toggleModal}
                key={i}
                classes={classes}
              >
                {i + 1}
              </Note>
            );
          })}
        </div>
        <div>
          {this.state.showModal ? (
            <Modal>
              <button onClick={this.props.toggleModal}>X</button>
              <p>hi</p>
            </Modal>
          ) : null}
        </div>
        {}
      </>
    );
  }
}

export default Result;
