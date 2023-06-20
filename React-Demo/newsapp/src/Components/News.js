import React, { Component } from "react";
import NewsItems from "./NewsItems";
import Spinner from "./Spinner";
import propTypes from "prop-types";
import InfiniteScroll from "react-infinite-scroll-component";

export class News extends Component {
  static defaultProps = {
    country: "in",
    pagesize: 5,
    category: "general",
  };

  static propTypes = {
    country: propTypes.string.isRequired,
    category: propTypes.string.isRequired,
    pagesize: propTypes.string.isRequired,
  };

  constructor(props) {
    super(props);
    this.state = {
      articales: [],
      loading: false,
      page: 1,
      previousDisabled: true,
      nextDisabled: false,
      totalResults: 0,
    };
    document.title = `${this.props.category} - Newsmoneky`
  }

  // async getApiData()
  // {
  //  let url = `https://newsapi.org/v2/top-headlines?country=${this.props.country}&category=${this.props.category}&apiKey=8743d1438f64429885464ef43a93cb72&page=${this.state.page}&pagesize=${this.props.pagesize}`;

  //   this.setState({
  //     loading: true,
  //   });
  //   let data = await fetch(url);
  //   let newsData = await data.json();
  //   return newsData;
  // }

  async componentDidMount() {
    console.log('from did mounr');
      console.log(this.state.page);

    // let newsData =await this.getApiData(1);
    let url = `https://newsapi.org/v2/top-headlines?country=${this.props.country}&category=${this.props.category}&apiKey=8743d1438f64429885464ef43a93cb72&page=${this.state.page}&pagesize=${this.props.pagesize}`;

    this.setState({
      loading: true,
    });
    let data = await fetch(url);
    let newsData = await data.json();
    this.setState({
      articales: newsData.articles,
      totalResults: newsData.totalResults,
      loading: false,
    });
  }

  // handlePreviousClick = async () => {
  //   let currPage = this.state.page - 1;

  //   let newsData =await this.getApiData(currPage);


  //   if (currPage >= 2) {
  //     this.setState({
  //       articales: newsData.articles,
  //       page: currPage,
  //       nextDisabled: false,
  //       previousDisabled: false,
  //       loading: false,
  //     });
  //   } else {
  //     this.setState({
  //       page: currPage,
  //       previousDisabled: true,
  //       nextDisabled: false,
  //       loading: false,
  //     });
  //   }
  // };

  // handleNextClick = async () => {
  //   let currPage = this.state.page + 1;

  //   let newsData =await this.getApiData(currPage);


  //   if (currPage < Math.ceil(this.state.totalResults / this.props.pagesize)) {
  //     this.setState({
  //       articales: newsData.articles,
  //       page: currPage,
  //       nextDisabled: false,
  //       previousDisabled: false,
  //       loading: false,
  //     });
  //   } else {
  //     this.setState({
  //       page: currPage,
  //       nextDisabled: true,
  //       previousDisabled: false,
  //       loading: false,
  //     });
  //   }
  // };

  fetchMoreData =  async ()=>{
    let currPage = this.state.page + 1;
   
    let url = `https://newsapi.org/v2/top-headlines?country=${this.props.country}&category=${this.props.category}&apiKey=8743d1438f64429885464ef43a93cb72&page=${currPage}&pagesize=${this.props.pagesize}`;

    this.setState({
      loading: true,
    });
    let data = await fetch(url);
    let newsData = await data.json();

    this.setState({
      articales: this.state.articales.concat(newsData.articles),
      totalResults: newsData.totalResults,
      loading: false,
      page: currPage
    });

  }

  render() {
    return (
      <>
        <h2 className="text-center" style={{ margin: "15px 0px" }}>
          This is news commponent
        </h2>
        {this.state.loading && <Spinner />}

        <InfiniteScroll
          dataLength={this.state.articales.length}
          next={this.fetchMoreData}
          hasMore={this.state.articales.length != this.state.totalResults}
          loader={<Spinner/>}
        >
        <div className="container">
        <div className="row">
          { this.state.articales?.map((element) => (
              <div className="col-md-4 my-3" key={element.url}>
                <NewsItems
                  title={
                    element.title
                      ? element.title.length > 48
                        ? element.title.slice(0, 48) + "..."
                        : element.title.slice(0, 48)
                      : ""
                  }
                  description={
                    element.description
                      ? element.description.length > 48
                        ? element.description.slice(0, 88) + "..."
                        : element.description.slice(0, 88)
                      : ""
                  }
                  imgUrl={
                    element.urlToImage
                      ? element.urlToImage
                      : "https://img.etimg.com/thumb/msid-99606244,width-1070,height-580,imgsize-14782,overlay-etmarkets/photo.jpg"
                  }
                  newsUrl={element.url ? element.url : ""} author={element.author} publishedAt={element.publishedAt} source={element.source}
                />
              </div>
            ))}
        </div>
        </div>
        </InfiniteScroll>

        {/* <div className="container d-flex justify-content-between">
          <button
            type="button"
            className="btn btn-dark"
            onClick={this.handlePreviousClick}
            disabled={this.state.previousDisabled}
          >
            &larr; Previous
          </button>
          <button
            type="button"
            className="btn btn-dark"
            onClick={this.handleNextClick}
            disabled={this.state.nextDisabled}
          >
            &rarr; Next
          </button>
        </div> */}
      </>
    );
  }
}

export default News;
