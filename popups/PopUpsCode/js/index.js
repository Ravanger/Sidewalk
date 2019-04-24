// // Include "useState" as part of this project
// const { useState } = React;
//
//
//
//     function Channel(props) {
//
//       let rgbNum = props.rgb;
//
//
//       // const increaseValue = () => rgbNum + 1;
//       // const decreaseValue = () => rgbNum - 1;
//       const changeValue = ({target}) => Number(target.value);
//
//       const updateRgb = (channel) => {
//         if (channel >= 0 && channel <= 255)
//         rgbNum = channel;
//         props.handleOnChange(rgbNum);
//
//       }
//
//       return (
//         <div class="channel">
//           <button type="button" class="btn up" onClick={e => updateRgb(rgbNum + 1)}>+</button>
//           <input type="text" class="txt" value={rgbNum} onChange={e => updateRgb(e.target.value )} />
//           <button type="button" class="btn down" onClick={e => updateRgb(rgbNum - 1)}>-</button>
//         </div>
//       );
//     }
//
//     function Colour(props) {
//
//       const[r, setR] = useState (props.red);
//       const[g, setG] = useState (props.green);
//       const[b, setB] = useState (props.blue);
//
//       const myStyles = {
//         backgroundColor: `rgb(${r},${g},${b})`
//       }
//
//       return (
//         <li class="colour" style={myStyles}>
//           <div>rgb(</div>
//             <Channel rgb={r} handleOnChange = {setR} />
//             <Channel rgb={g} handleOnChange = {setG} />
//             <Channel rgb={b} handleOnChange = {setB} />
//           <div>);</div>
//         </li>
//         );
//
//       }
//
//
//       function Palette(props) {
//
//         const allSwatches = props.swatches.map((swatch, i) => <Colour key={i} red={swatch.r} green={swatch.g} blue={swatch.b} />);
//
//         return (
//           <ul class="palette">
//           { allSwatches }
//
//           </ul>
//         );
//       }
//
//       function App () {
//         const startingData = [
//           {r: 250, g: 150, b: 100},
//           {r: 0, g: 0, b: 200},
//           {r: 250, g: 0, b: 100},
//           {r: 80, g: 155, b: 100},
//
//         ];
//
//         return (
//          <Palette swatches={startingData} />
//        );
//       }
//
// ReactDOM.render(<App />, document.getElementById('app') );
