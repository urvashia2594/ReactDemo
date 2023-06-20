import React, { Component } from "react";
import loading from "../Loading.gif";
export default class Spinner extends Component {
  render() {
    return (
      <div className="text-center my-3">
        <img src={loading} />
      </div>
    );
  }
}
