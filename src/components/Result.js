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

  //compares two dates and returns true if the first day is smaller than the second date

  render() {
    return (
      <>
        <div className="container-grid">
          {this.state.days.map((v, i) => {
            let classes =
              +this.state.activeDay.day === i + 1 &&
              this.state.activeDay.month === this.state.month &&
              this.state.activeDay.year === this.state.year
                ? "note active"
                : "note";
            let disable =
              (i + 1 < this.state.activeDay.day &&
                this.state.month <= this.state.activeDay.month &&
                this.state.year <= this.state.activeDay.year) ||
              (this.state.month < this.state.activeDay.month &&
                this.state.year <= this.state.activeDay.year) ||
              this.state.year < this.state.activeDay.year
                ? "disable"
                : "";

            let success = disable === "disable"; //DETERMINES IF THE PERSON FILLED OUT YESTERDAY'S INFO
            classes = `${classes} ${disable}`;
            return (
              <Note
                toggleModal={this.props.toggleModal}
                key={i}
                classes={classes}
                id={i}
              >
                {i + 1}
                {success ? (
                  <img
                    className="check"
                    alt="checkmark"
                    src={require("../assets/purplecheck.png")}
                  />
                ) : null}
              </Note>
            );
          })}
        </div>
        <div>
          {this.state.showModal ? (
            <Modal>
              <button id="xbutton" onClick={this.props.toggleModal}>
                X
              </button>

              <p>Tell me something positive today!</p>
              <input onChange={this.props.onChange} type="text" />
              <button id="done" onClick={this.props.onSubmit}>
                done
              </button>
            </Modal>
          ) : null}
        </div>
      </>
    );
  }
}

export default Result;
