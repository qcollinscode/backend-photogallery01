console.log('react hello');

// class Home extends React.Component {
//     constructor(props) {
//         super(props);
//         this.state = {
//             categories: [],
//             selectedCategoryId: -1,
//             name: "Joe",
//             description: '',
//             price: '',
//             successCreation: null
//         };
//
//     }
//
//     shouldComponentUpdate(nextProps, nextState) {
//         this.serverRequest = $.get("api/read_all_categories.php", function(categories) {
//             console.log(categories)
//             this.setState({
//                 name: "hello"
//             });
//
//         }.bind(this));
//     }
//
//     render() {
//         return (
//             <nav>
//                 <h1>{this.state.name}</h1>
//
//             </nav>
//         );
//     }
//     componentWillUnmount() {
//         this.serverRequest.abort();
//     }
// }
//
// class App extends React.Component {
//     render () {
//         return <Home/>;
//     }
// }
//
//
// ReactDOM.render(
//   <App/>,
//   document.getElementById('content')
// );
