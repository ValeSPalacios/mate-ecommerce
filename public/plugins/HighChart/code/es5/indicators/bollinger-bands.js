!/**
 * Highstock JS v11.4.0 (2024-03-04)
 *
 * Indicator series type for Highcharts Stock
 *
 * (c) 2010-2024 Paweł Fus
 *
 * License: www.highcharts.com/license
 */function(t){"object"==typeof module&&module.exports?(t.default=t,module.exports=t):"function"==typeof define&&define.amd?define("highcharts/indicators/bollinger-bands",["highcharts","highcharts/modules/stock"],function(o){return t(o),t.Highcharts=o,t}):t("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(t){"use strict";var o=t?t._modules:{};function e(t,o,e,i){t.hasOwnProperty(o)||(t[o]=i.apply(null,e),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:o,module:t[o]}})))}e(o,"Stock/Indicators/MultipleLinesComposition.js",[o["Core/Series/SeriesRegistry.js"],o["Core/Utilities.js"]],function(t,o){var e,i=t.seriesTypes.sma.prototype,n=o.defined,r=o.error,a=o.merge;return function(t){var o=["bottomLine"],e=["top","bottom"],s=["top"];function p(t){return"plot"+t.charAt(0).toUpperCase()+t.slice(1)}function l(t,o){var e=[];return(t.pointArrayMap||[]).forEach(function(t){t!==o&&e.push(p(t))}),e}function h(){var t,o=this,e=o.pointValKey,s=o.linesApiNames,h=o.areaLinesNames,c=o.points,u=o.options,d=o.graph,f={options:{gapSize:u.gapSize}},y=[],m=l(o,e),g=c.length;if(m.forEach(function(o,e){for(y[e]=[];g--;)t=c[g],y[e].push({x:t.x,plotX:t.plotX,plotY:t[o],isNull:!n(t[o])});g=c.length}),o.userOptions.fillColor&&h.length){var v=y[m.indexOf(p(h[0]))],b=1===h.length?c:y[m.indexOf(p(h[1]))],x=o.color;o.points=b,o.nextPoints=v,o.color=o.userOptions.fillColor,o.options=a(c,f),o.graph=o.area,o.fillGraph=!0,i.drawGraph.call(o),o.area=o.graph,delete o.nextPoints,delete o.fillGraph,o.color=x}s.forEach(function(t,e){y[e]?(o.points=y[e],u[t]?o.options=a(u[t].styles,f):r('Error: "There is no '+t+' in DOCS options declared. Check if linesApiNames are consistent with your DOCS line names."'),o.graph=o["graph"+t],i.drawGraph.call(o),o["graph"+t]=o.graph):r('Error: "'+t+" doesn't have equivalent in pointArrayMap. To many elements in linesApiNames relative to pointArrayMap.\"")}),o.points=c,o.options=u,o.graph=d,i.drawGraph.call(o)}function c(t){var o,e=[],n=[];if(t=t||this.points,this.fillGraph&&this.nextPoints){if((o=i.getGraphPath.call(this,this.nextPoints))&&o.length){o[0][0]="L",e=i.getGraphPath.call(this,t),n=o.slice(0,e.length);for(var r=n.length-1;r>=0;r--)e.push(n[r])}}else e=i.getGraphPath.apply(this,arguments);return e}function u(t){var o=[];return(this.pointArrayMap||[]).forEach(function(e){o.push(t[e])}),o}function d(){var t,o=this,e=this.pointArrayMap,n=[];n=l(this),i.translate.apply(this,arguments),this.points.forEach(function(i){e.forEach(function(e,r){t=i[e],o.dataModify&&(t=o.dataModify.modifyValue(t)),null!==t&&(i[n[r]]=o.yAxis.toPixels(t,!0))})})}t.compose=function(t){var i=t.prototype;return i.linesApiNames=i.linesApiNames||o.slice(),i.pointArrayMap=i.pointArrayMap||e.slice(),i.pointValKey=i.pointValKey||"top",i.areaLinesNames=i.areaLinesNames||s.slice(),i.drawGraph=h,i.getGraphPath=c,i.toYData=u,i.translate=d,t}}(e||(e={})),e}),e(o,"Stock/Indicators/BB/BBIndicator.js",[o["Stock/Indicators/MultipleLinesComposition.js"],o["Core/Series/SeriesRegistry.js"],o["Core/Utilities.js"]],function(t,o,e){var i,n=this&&this.__extends||(i=function(t,o){return(i=Object.setPrototypeOf||({__proto__:[]})instanceof Array&&function(t,o){t.__proto__=o}||function(t,o){for(var e in o)Object.prototype.hasOwnProperty.call(o,e)&&(t[e]=o[e])})(t,o)},function(t,o){if("function"!=typeof o&&null!==o)throw TypeError("Class extends value "+String(o)+" is not a constructor or null");function e(){this.constructor=t}i(t,o),t.prototype=null===o?Object.create(o):(e.prototype=o.prototype,new e)}),r=o.seriesTypes.sma,a=e.extend,s=e.isArray,p=e.merge,l=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}return n(e,t),e.prototype.init=function(){o.seriesTypes.sma.prototype.init.apply(this,arguments),this.options=p({topLine:{styles:{lineColor:this.color}},bottomLine:{styles:{lineColor:this.color}}},this.options)},e.prototype.getValues=function(t,e){var i,n,r,a,p,l,h,c,u,d=e.period,f=e.standardDeviation,y=[],m=[],g=t.xData,v=t.yData,b=v?v.length:0,x=[];if(!(g.length<d)){var C=s(v[0]);for(u=d;u<=b;u++)p=g.slice(u-d,u),l=v.slice(u-d,u),a=(c=o.seriesTypes.sma.prototype.getValues.call(this,{xData:p,yData:l},e)).xData[0],i=c.yData[0],h=function(t,o,e,i){for(var n,r=t.length,a=0,s=0;a<r;a++)s+=(n=(e?t[a][o]:t[a])-i)*n;return Math.sqrt(s/=r-1)}(l,e.index,C,i),n=i+f*h,r=i-f*h,x.push([a,n,i,r]),y.push(a),m.push([n,i,r]);return{values:x,xData:y,yData:m}}},e.defaultOptions=p(r.defaultOptions,{params:{period:20,standardDeviation:2,index:3},bottomLine:{styles:{lineWidth:1,lineColor:void 0}},topLine:{styles:{lineWidth:1,lineColor:void 0}},tooltip:{pointFormat:'<span style="color:{point.color}">●</span><b> {series.name}</b><br/>Top: {point.top}<br/>Middle: {point.middle}<br/>Bottom: {point.bottom}<br/>'},marker:{enabled:!1},dataGrouping:{approximation:"averages"}}),e}(r);return a(l.prototype,{areaLinesNames:["top","bottom"],linesApiNames:["topLine","bottomLine"],nameComponents:["period","standardDeviation"],pointArrayMap:["top","middle","bottom"],pointValKey:"middle"}),t.compose(l),o.registerSeriesType("bb",l),l}),e(o,"masters/indicators/bollinger-bands.src.js",[o["Core/Globals.js"]],function(t){return t})});