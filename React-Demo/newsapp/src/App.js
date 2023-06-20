import "./App.css";

import React, { Component } from "react";
import Navbar from "./Components/Navbar";
import News from "./Components/News";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
//35 - remin to imolemnt in demo 2023-05-09   https://www.youtube.com/watch?v=yLox5lhwaEU&list=PLu0W_9lII9agx66oZnT6IyhcMIbUMNMdt&index=35
export default class App extends Component {
  pagesize = "10";
  render() {
    return (
      <Router>
        <div>
          <Navbar />
        </div>
        <div className="my-3">
          <Routes>
            <Route
              exact
              path="/"
              element={
                <News
                  key="general"
                  pagesize={this.pagesize}
                  country="in"
                  category="general"
                />
              }
            />

            <Route
              exact
              path="/business"
              element={
                <News
                  key="business"
                  pagesize={this.pagesize}
                  country="in"
                  category="business"
                />
              }
            />

            <Route
              exact
              path="/entertainment"
              element={
                <News
                  key="entertainment"
                  pagesize={this.pagesize}
                  country="in"
                  category="entertainment"
                />
              }
            />

            <Route
              exact
              path="/general"
              element={
                <News
                  key="general"
                  pagesize={this.pagesize}
                  country="in"
                  category="general"
                />
              }
            />

            <Route
              exact
              path="/health"
              element={
                <News
                  key="health"
                  pagesize={this.pagesize}
                  country="in"
                  category="health"
                />
              }
            />

            <Route
              exact
              path="/science"
              element={
                <News
                  key="science"
                  pagesize={this.pagesize}
                  country="in"
                  category="science"
                />
              }
            />

            <Route
              exact
              path="/sports"
              element={
                <News
                  key="sports"
                  pagesize={this.pagesize}
                  country="in"
                  category="sports"
                />
              }
            />

            <Route
              exact
              path="/technology"
              element={
                <News
                  key="technology"
                  pagesize={this.pagesize}
                  country="in"
                  category="technology"
                />
              }
            />
          </Routes>
        </div>
      </Router>
    );
  }
}
