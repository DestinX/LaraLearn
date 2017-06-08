import React, { Component } from 'react';
import ReactDOM from 'react-dom';

// class Example extends Component {
//     render() {
//         return (
//             <div>
//                 <h1>React app is working!</h1>
//             </div>
//         );
//     }
// }
//
// export default Example;
//
// // We only want to try to render our component on pages that have a div with an ID
// // of "example"; otherwise, we will see an error in our console
// if (document.getElementById('example-react-comments')) {
//     ReactDOM.render(<Example />, document.getElementById('example-react-comments'));
// }


var Comment = React.createClass({

  rawMarkup: function() {
    var md = new Remarkable();
    var rawMarkup = md.render(this.props.children.toString());
    var Markup = {__html: rawMarkup};
    return { __html: rawMarkup };
  },
  handleDelete: function() {

    var send_id = {id: this.props.id};

    $.ajax({
      url: this.props.deleteurl,
      type: 'POST',
      data: send_id,
      success: function(data) {
        // console.log(this.props.onCommentDelete);
        this.props.onCommentDelete(data);
      }.bind(this),
      error: function(xhr, status, err) {
        { /* this.setState({data: curr_comments}); // 3333) för att återställa det tillfälligt visade och återgå till orginal komentarer */ }
        console.error(this.props.deleteurl, status, err.toString());
        // console.error(this.props.deleteurl, status, xhr, err.toString()); //bättre error!!!
      }.bind(this)
    });
  },
  render: function () {
    // console.log(this.props.onCommentDelete);

    return (
      <div className="comment">
        <h4 className="commentAuthor" style={{"marginBottom": 5 + 'px'}}>{this.props.author}</h4>
        {this.props.id + ' - ' + this.props.children} <button onClick={this.handleDelete}>Delete</button>
        { /* {this.props.id}<span dangerouslySetInnerHTML={this.rawMarkup()} /> */}
      </div>
    );
  }
});

var CommentList = React.createClass({
  render: function () {
    var ad = this.props.onCommentDelete;
    // console.log(this.props.data[1].text);
    var commentNodes = this.props.data.map(function(comment) {
      return (
        <Comment author={comment.author} key={comment.id} id={comment.id} data={comment} onCommentDelete={ad} deleteurl="http://localhost/codebase/feedreact/delete/" >
          {comment.text}
        </Comment>
      );
    });

    return (
      <div className="commentList">
        {commentNodes}
      </div>
    );

  }
});

var CommentForm = React.createClass({
  getInitialState: function() {
    return ({
      author: '',
      text: ''
    });
  },
  handleAuthorChange: function(e) {
    this.setState({author: e.target.value});
  },
  handleTextChange: function(e) {
    this.setState({text: e.target.value});
  },
  handleSubmit: function(e) {
    e.preventDefault();
    var author = this.state.author.trim();
    var text = this.state.text.trim();
    if(!author || !text)
      return;

    this.props.onCommentSubmit({author: author, text: text});
    this.setState({author: '', text: ''}); // Sätt till tomma fält när kommentaren skickats in
  },
  render: function () {
    return (
      <div className="formHolder">
        <br/>
        <form className="commentForm" onSubmit={this.handleSubmit}>
          <input type="text" placeholder="Ditt namn" value={this.state.author} onChange={this.handleAuthorChange} />
          <input type="text" placeholder="Skriv något.." value={this.state.text} onChange={this.handleTextChange} />
          <input type="submit" value="Skicka" />
        </form>
      </div>
    );
  }
});

var CommentBox = React.createClass({
  loadCommentsFromServer: function() {
    $.ajax({
      url: this.props.url,
      dataType: 'json',
      cache: false,
      success: function(data) {
        // console.log(data);
        this.setState({data: data});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
        // console.error(this.props.deleteurl, status, xhr, err.toString()); //bättre error!!!
      }.bind(this)
    });
  },
  handleCommentSubmit: function(comment) {
    // 3333) Visa aktuell kommentar innan comment skickas till server och i väntan på svar
    // var curr_comments = this.state.data;
    // var new_comments = curr_comments.concat([comment]);
    // this.setState({data: new_comments});
    // console.log(comment);

    $.ajax({
      url: this.props.url,
      dataType: 'json',
      type: 'POST',
      data: comment,
      success: function(data) {
        // console.log(data);
        this.setState({data: data});
      }.bind(this),
      error: function(xhr, status, err) {
        // this.setState({data: curr_comments}); // 3333) för att återställa det tillfälligt visade och återgå till orginal komentarer
        console.error(this.props.url, status, err.toString(), xhr);
        // console.error(this.props.deleteurl, status, xhr, err.toString()); //bättre error!!!
      }.bind(this)
    });
  },
  handleCommentDelete: function(data) {
    this.setState({data: data});
  },
  getInitialState: function() {
    // return {data: []};
    return {data: this.props.data};
  },
  componentDidMount: function() {
    this.loadCommentsFromServer();
    setInterval(this.loadCommentsFromServer, this.props.pollInterval);
  },
  render: function() {
    return (
      <div className="commentBox">
        <h1>Kommentarer</h1>
        <CommentList data={this.state.data} onCommentDelete={this.handleCommentDelete} />
        <CommentForm onCommentSubmit={this.handleCommentSubmit} />
      </div>
    );
  }
});

var data = [
  {id: 1, author: "Pete Hunt", text: "This is **one** comment"},
  {id: 2, author: "Jordan Walke", text: "This is *another* comment"}
];

if (document.getElementById('example-react-comments')) {
  ReactDOM.render(
    <CommentBox data={data} url="http://localhost/codebase/feedreact/json" pollInterval={2000} />,
    document.getElementById('example-react-comments')
  );
}

// ReactDOM.render(
//   <h1>Annan DIV Andra komponenter</h1>,
//   document.getElementById('annan')
// );
