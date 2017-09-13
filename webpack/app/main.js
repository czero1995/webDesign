// import './main.css';//使用require导入css文件
require("!style-loader!css-loader!less-loader!postcss-loader!./main.less");
// import './main.less';//使用require导入css文件
const greeter = require('./Greeter.js');
document.querySelector("#root").appendChild(greeter());
