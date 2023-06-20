import React, { Component } from "react";

export class NewsItems extends Component {
  render() {
    let { title, description, imgUrl, newsUrl, author,publishedAt, source  } = this.props;
    return (
      <div>
        <div className="card">
          

          <span className="position-absolute top-0  translate-middle badge rounded-pill bg-danger" style={{zIndex:'1',left: '90%'}}>
            {source.name}
          </span>

          <img src={imgUrl} className="card-img-top" alt="..." />
          <div className="card-body">
            <h5 className="card-title">{title}</h5>
            <p className="card-text">{description}</p>
            <p className="card-text"><small className="text-body-secondary">by {author} on {new Date(publishedAt).toDateString() }</small></p>
            <a href={newsUrl} target="_blank" className="btn btn-sm btn-dark">
              read more
            </a>
          </div>
        </div>
      </div>
    );
  }
}

export default NewsItems;
