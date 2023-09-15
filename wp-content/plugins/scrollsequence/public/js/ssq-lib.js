function scrollsequenceMainFunction() {
if (document.getElementsByClassName('scrollsequence-wrap')[0]) {
"use strict";   
/**
* --------------------------------------------------------- PHASE 1 -----------------------------------------------------------------
* ------------------------------------ SELF EXECUTED INIT (RUNS ONLY ONCE IN A DEFINED SEQUENCE) ------------------------------------
*/
/**
* Define Initial Variables
*/ 
  let SHOWMARKERS =ssqInput.debug.includes('markers');   
  let DEBUG = ssqInput.debug.includes('debug');   
  let PRELOADDEBUG = ssqInput.debug.includes('preloaddebug');
  //let SCROLLDEBUG = ssqInput.debug.includes('scrolldebug'); 
  let ssqCalc,ssqImg;  
  let ssqCur={};  
  let ssqInit={};
  let ssqHtml=[];

  //Manual debug override (optional)
    // SHOWMARKERS=true;
    // DEBUG = true; 
    // PRELOADDEBUG = true;
    // SCROLLDEBUG = true;
/**
* SsqInput object length
*/ 
  ssqInput.scLength=ssqInput.sc.length;
  DEBUG && console.log('0.00 ms ssqInput:',ssqInput);
/**
* INIT ssqCur object 
*/
function initSsqCur(){
  ssqCur.lastPImgRenderedOnSc=[];
  ssqCur.logObj={
    renderSuccess:[], 
    renderRestrict:[],
  }
  for (let s = 0; s < ssqInput.scLength; s++) { 
    ssqCur.lastPImgRenderedOnSc[s]=[];
  } 
}initSsqCur();
/** 
* INIT ssqHtml object 
* ssqHtml object serves mainly so we have a way how to easily identify an element in a logical way. 
* It is populated only once at page load and it is not re-loaded if there is any DOM change or reflow. 
*/
function initSsqHtml(){ let t0 = performance.now();
  let allScEl=document.getElementsByClassName('scrollsequence-wrap');
  for (let s = 0; s < ssqInput.scLength; s++) { 
    ssqHtml[s]={
      wrap:allScEl[s],
      sticky:allScEl[s].getElementsByClassName('scrollsequence-sticky')[0],
      canvas:allScEl[s].getElementsByClassName('scrollsequence-canvas')[0],  
      //trigger:allScEl[s].getElementsByClassName('scrollsequence-trigger')[0],  // Delete???????????
      //ssqalert:allScEl[s].getElementsByClassName('scrollsequence-ssqalert')[0],  // Delete???????????
      //pagesWrap:allScEl[s].getElementsByClassName('scrollsequence-pages-wrap')[0],  // Delete???????????
      //spacer:allScEl[s].getElementsByClassName('scrollsequence-spacer')[0],  // removed 1.3.0 
    };
    ssqHtml[s].page=[];
    ssqHtml[s].pageLen=allScEl[s].getElementsByClassName('scrollsequence-page').length;
    for (let i = 0; i < ssqHtml[s].pageLen; i++) { 
      ssqHtml[s].page[i]=allScEl[s].getElementsByClassName('scrollsequence-page')[i];
      ssqHtml[s].page[i].curentImageNo=0;
    }// End of i for loop 
  }// End of s for loop  
  let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  DEBUG&&console.log(tdelta,'ms ssqHtml: ',ssqHtml);  
}initSsqHtml(); 
/**
* INIT ssqCanvas 
*/ 
function initSsqCanvas(){ let t0 = performance.now();
  for (let s = 0; s < ssqInput.scLength; s++) { 
    ssqHtml[s].canvas.style.zIndex=ssqInput.sc[s].zIndex;   
    ssqHtml[s].canvas.style.opacity=ssqInput.sc[s].imageOpacity;  
    ssqHtml[s].context=ssqHtml[s].canvas.getContext("2d")
    // CanvasDPR
    ssqHtml[s].canvas.aaaDPR = (ssqInput.sc[s].canvasDPR === 'quality') ? window.devicePixelRatio : 1
    //console.log('ssqHtml[s].canvas.aaaDPR:',ssqHtml[s].canvas.aaaDPR,'  (ssqInput.sc[s].canvasDPR:',ssqInput.sc[s].canvasDPR,')')
    
    // Optional (below is only for pre-draw loading screen): 
        // // Height and Width
        //   var canvasWidth = document.getElementsByClassName('scrollsequence-pages-wrap')[s].offsetWidth*1;
        //   var canvasHeight = document.getElementsByClassName('scrollsequence-pages-wrap')[s].offsetHeight*1;
        //   // CSS - Canvas pixel dimensions on screen (=size)
        //   ssqHtml[s].canvas.style.width = (canvasWidth*1)+"px";       
        //   ssqHtml[s].canvas.style.height =  (canvasHeight*1)+"px"; 
        //   // CANVAS - How many pixels the canvas has (=quality)
        //   ssqHtml[s].context.canvas.width = canvasWidth*1;
        //   ssqHtml[s].context.canvas.height = canvasHeight*1;
        // // Draw Something nice  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //     ssqHtml[s].context.font = "20px Poppins";
        //     ssqHtml[s].context.textAlign = "center";
        //     ssqHtml[s].context.fillText("LOADING", canvasWidth/2, canvasHeight/2-20);
        //     ssqHtml[s].context.fillText("PLEASE WAIT", canvasWidth/2, canvasHeight/2+20);

  }
  let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  DEBUG && console.log(tdelta,'ms Canvas Init: ');
}initSsqCanvas(); 
/**
* INIT ssqImg
*/ 
function initSsqImg(){ let t0 = performance.now();
  ssqImg =  {
    objArray:[], 
    absoluteOrder:[], 
    totalImageNo:0,
    priorityImagesPreloadedCount:0,
    nonPriorityImagesPreloadedCount:0,
    priorityLoadingFinished:false,
    nonPriorityLoadingFinished:false, 
    zfirstDrawCalled:false, 
  };
  let absCountImg = 0;    
  for (let s = 0; s < ssqInput.scLength; s++) { 
      ssqImg.objArray[s]=[];
      for (let i = 0; i <  ssqInput.sc[s].pageLength; i++) {  
              ssqImg.totalImageNo=ssqImg.totalImageNo+ssqInput.sc[s].page[i].imagesLength // calculate total image length
              ssqImg.objArray[s][i] = [];  // prepare empty array for each page               
              for (let j = 0; j < ssqInput.sc[s].page[i].imagesLength; j++) { // Loop through images 
                  ssqImg.objArray[s][i][j] = new Image(); // Create a new image  object 
                  ssqImg.absoluteOrder[absCountImg]=[s,i,j]; // Calculate absolute image order
                  absCountImg = absCountImg + 1
              } // End of j loop 
      }  // End of i loop 
  }// End of s loop 
  let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  DEBUG && console.log(tdelta,'ms ssqImg: ',ssqImg);
}initSsqImg(); 
/**
* --------------------------------------------------------- PHASE 2 -----------------------------------------------------------------
* ------------------------------------ NOT SELF  EXECUTED   PHASE 2 -------------- FUNCTIONS ----------------------------------------
*/
/**
* SsqCalculate function (sc: begin end, page:absbegin abs end)
*/ 
function ssqCalcCalculate(){let t0 = performance.now();
  ssqCalc={}
  ssqCalc.sc=[]
    for (let s = 0; s < ssqInput.scLength; s++) {   
      ssqCalc.sc[s]={}
      ssqCalc.sc[s].absBegin=document.getElementsByClassName('scrollsequence-wrap')[s].getBoundingClientRect().top+window.scrollY;  // Does not work on iPhone 6 => document.documentElement.scrollTop
      ssqCalc.sc[s].absEnd=ssqCalc.sc[s].absBegin+ssqInput.sc[s].scSpacer
      // Distance from the left - for future use 
        ssqCalc.sc[s].leftDistance=document.getElementsByClassName('scrollsequence-wrap')[s].getBoundingClientRect().left+document.documentElement.scrollLeft;      
      ssqCalc.sc[s].page=[]
      for (let i = 0; i <  ssqInput.sc[s].pageLength; i++) { 
        ssqCalc.sc[s].page[i]={}
        ssqCalc.sc[s].page[i].absBegin=ssqCalc.sc[s].absBegin+ssqInput.sc[s].page[i].pageAbsBegin;
        ssqCalc.sc[s].page[i].absEnd=ssqCalc.sc[s].absBegin+ssqInput.sc[s].page[i].pageAbsEnd;
      }
    }
 let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  DEBUG && console.log(tdelta,'ms ssqCalc:',ssqCalc)
} // End of ssqCalcCalculate
/**
* ssqCur Object Calculate
*   - Needs to run in init
*   - ssqCur object is supposed to capture the "curent" state of display of the Scrollsequence(s). 
* When not active isActive = false and all other values are undefined
*/
function ssqCurCalculate(scroll_pos){ let t0 = performance.now();
  // reset isActive value
    ssqCur.isActive=false
  // Check if scroll_pos has active scrollsequence
  for (let s = 0; s < ssqInput.scLength; s++) { 
    if (scroll_pos>= ssqCalc.sc[s].absBegin && scroll_pos<ssqCalc.sc[s].absEnd){
      ssqCur.isActive=true
      ssqCur.sc=s
      for (let i = 0; i <  ssqInput.sc[s].pageLength; i++) {
        if (scroll_pos>= ssqCalc.sc[s].page[i].absBegin && scroll_pos<ssqCalc.sc[s].page[i].absEnd){
            ssqCur.page=i              
            ssqCur.pageProgress= (scroll_pos-ssqCalc.sc[s].page[i].absBegin)/(ssqInput.sc[s].page[i].pageSpacer)
            ssqCur.image=Math.round(ssqCur.pageProgress*(ssqInput.sc[s].page[i].imagesLength-1))
            ssqCur.pixel=scroll_pos;
            //console.log(ssqCur.pixel,' px - ACTIVE ACTIVE ACTIVE  Scrollsequence is active:',ssqCur.isActive,ssqCur.sc,ssqCur.page,ssqCur.image,'prog:',ssqCur.pageProgress, ssqCur.pixel  )
        break
        } // end of IF (i)
      } //end of i loop
    break
    } // End of IF s
  } // end of s loop

  // IF NOT ACTIVE:  
  if (!ssqCur.isActive){ 
    ssqCur.isActive=false;
    ssqCur.sc;
    ssqCur.page;
    ssqCur.pageProgress;      
    ssqCur.image;
    ssqCur.pixel=scroll_pos;
    //console.log(ssqCur.pixel,' px - NOT ACTIVE - NOT NOT NOT:',ssqCur.isActive,ssqCur.sc,ssqCur.page,ssqCur.image,'prog:',ssqCur.pageProgress, ssqCur.pixel  )
  }// end of NOT active  
  let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  DEBUG && console.log(tdelta,'ms ssqCur(',scroll_pos,'):', ssqCur); 
} // End of ssqCurCalculate
/**  
* ssqInit - Calculate curent or nearest absolute image 
* Used by: Image Preload Functions 
*/   
function ssqInitCalculate(){let t0 = performance.now();
  // just FYI
  ssqInit.aascr=window.scrollY;
  //Get the latest Cur values and store them separately
    ssqInit.active={}
    ssqInit.active.sc=ssqCur.sc; 
    ssqInit.active.page=ssqCur.page; 
    ssqInit.active.pageProgress=ssqCur.pageProgress;
    ssqInit.active.image=ssqCur.image;
    ssqInit.active.pixel=ssqCur.pixel;
    ssqInit.active.isActive=ssqCur.isActive;    
  // IF ACTIVE  Scrollsequence 
    if (ssqInit.active.isActive){ 
      ssqInit.active.curAbsImg=ssqUtilsConvToAbs(ssqInit.active.sc,ssqInit.active.page, ssqInit.active.image);
    } 
  // Get all NOT ACTIVE Scrollsequence & Look for nearest
    ssqInit.notActive=[];
    for (let s = 0; s < ssqInput.scLength; s++) { 
       // look for nearest begining (aka NEXT)
      if (window.scrollY < ssqCalc.sc[s].absBegin){
        ssqInit.notActive.push({
          type:'next',
          distance:Math.abs(window.scrollY - ssqCalc.sc[s].absBegin),
          sc:s, 
          page:0, 
          image:0, 
          pageProgress:0,
        });
      }
      // look for nearest end (aka PREV sc)
      if (window.scrollY > ssqCalc.sc[s].absEnd){
         ssqInit.notActive.push({
          type: 'prev',
          distance:Math.abs(window.scrollY - ssqCalc.sc[s].absEnd),
          sc:s,
          page:ssqInput.sc[s].pageLength-1, 
          image: ssqInput.sc[s].page[ssqInput.sc[s].pageLength-1].imagesLength-1,
          pageProgress:1,
        });
      }        
    } // end of s loop
  // find the smallest distance in the array and assign it as 
    let notActiveDistanceArray=[];
    for (let x = 0; x < ssqInit.notActive.length; x++) { 
      notActiveDistanceArray[x]=ssqInit.notActive[x].distance
    }
    // sort by absolute value
    notActiveDistanceArray.sort((a,b) => a-b);
  // FINALLY assign out which one is nearest
    for (let x = 0; x < ssqInit.notActive.length; x++) { 
      if (notActiveDistanceArray[0] === ssqInit.notActive[x].distance ){
        ssqInit.notActive.nearAbsImg=ssqUtilsConvToAbs(ssqInit.notActive[x].sc, ssqInit.notActive[x].page, ssqInit.notActive[x].image)
        break
      } // end IF 
    } // end of x for loop
  // OUTPUT - To make a simple answer to "which abs image to use for preload" use variable aaaCurImg below:
    if (ssqInit.active.curAbsImg == undefined){ // if active is not present => use the nearest image
      ssqInit.aaaCurImg=ssqInit.notActive.nearAbsImg
    }else{  // if active - use cur img
      ssqInit.aaaCurImg=ssqInit.active.curAbsImg
    }
  let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  DEBUG && console.log(tdelta,'ms ssqInit:',ssqInit)
}// End of ssqInitCalculate
//-------------------- IMAGE PRELOAD FUNCTIONS ----------------------- 
/**
* ssqDumbPreloadArray
*/ 
function ssqDumbPreloadArray(curImg,imageTotalLength){ let t0 = performance.now(); //cur img is absolute
  PRELOADDEBUG && console.log('INITIAL CONDITIONS: curImg:',curImg,' length:',imageTotalLength );
  // Define Variables
    var justOddArray=[];
    for (var i=0; i< (imageTotalLength)/2; i++) { 
        justOddArray[i]=i*2+1;  // red number sequence  
    }
    //PRELOADDEBUG && console.log('justOddArray',justOddArray);
  // POSITIVE SIDE   
    var blueArrayLimit=[]; 
    for (var i=0; i< (imageTotalLength-curImg)/2; i++) { 
        blueArrayLimit[i]=Math.log((imageTotalLength-curImg)/justOddArray[i])/Math.log(2);
    }   
    //PRELOADDEBUG && console.log('blueArrayLimit:',blueArrayLimit);
    var blueArray=[]
    for (var i=0; i< (imageTotalLength-curImg)/2; i++) {  // or equal results in empty array
        blueArray[i]=[] 
        for (var j=0; j< blueArrayLimit[i]; j++) { // or equal results in cur=9 for length=9
            blueArray[i][j] = Math.pow(2,[j])*justOddArray[i]+curImg;
        };
    }
    //PRELOADDEBUG && console.log('blueArray',blueArray);
    var blueArrayLinear = [];
    var blueArrayLength = blueArray.length;
    for (var i=0; i< blueArrayLength; i++) { 
        var blueArrayLengthSub=blueArray[i].length;
        for (var j=0; j< blueArrayLengthSub; j++) { 
            blueArrayLinear.push(blueArray[i][j]);
        }
    }
  // NEGATIVE SIDE 
    var pinkArrayLimit=[];
    for (var i=0; i< (curImg)/2; i++) { 
        pinkArrayLimit[i]=Math.log((curImg)/justOddArray[i])/Math.log(2);
    }   
    //PRELOADDEBUG && console.log('pinkArrayLimit:',pinkArrayLimit);          
    var pinkArray=[]
    for (var i=0; i< (curImg)/2; i++) { // or equal results in empty array
        pinkArray[i]=[] 
        for (var j=0; j<= pinkArrayLimit[i]; j++) { // if or equal is not there, zero does not get counted
            pinkArray[i][j] = -Math.pow(2,[j])*justOddArray[i]+curImg;
        };
    }   
    //PRELOADDEBUG && console.log('pinkArray',pinkArray);
    var pinkArrayLinear = []
    var pinkArrayLength = pinkArray.length;
    for (var i=0; i< pinkArrayLength; i++) { 
        var pinkArrayLengthSub=pinkArray[i].length;
        for (var j=0; j< pinkArrayLengthSub; j++) { 
            pinkArrayLinear.push(pinkArray[i][j]);
        }
    }
  // Combine Positive and negative side
    //PRELOADDEBUG && console.log('COMB:',curImg,'blueArrayLinear:',blueArrayLinear,'pinkArrayLinear:',pinkArrayLinear)
    var combinedArray=[curImg]
    var maxLengthOfBlueAndPink=Math.max(blueArrayLinear.length, pinkArrayLinear.length)
    for (var i=0; i< maxLengthOfBlueAndPink; i++) {
        //console.log('combine runs:',i)
        if (blueArrayLinear[i]!== undefined){ 
        combinedArray.push(blueArrayLinear[i])
        }
        if (pinkArrayLinear[i]!== undefined){ 
        combinedArray.push(pinkArrayLinear[i])
        }
    }
  //WRITE RESULT TO CUR OBJECT
    ssqImg.dumbPreloadOrder=combinedArray; 

  let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  PRELOADDEBUG && console.log(tdelta,'ms ssqImg.dumbPreloadOrder:', ssqImg.dumbPreloadOrder) 
}// end of ssqDumbPreloadArray

/**
* preloadPriorityAndNonPriorityImages
*/
function preloadPriorityAndNonPriorityImages(){let t0 = performance.now();
  // PRIORITY IMAGE ARRAY PRELOAD
  ssqImg.priorityImageArray=[] // Create array of priority images
    for (let x=0; x< ssqInit.notActive.length; x++) {
      var shc = ssqInit.notActive[x].sc;
      var str = ssqInit.notActive[x].page;
      var obr = ssqInit.notActive[x].image;
      ssqImg.priorityImageArray[x]=ssqUtilsConvToAbs(shc,str,obr);
      ssqImg.objArray[shc][str][obr].aaaaaaIsPriority=true;
      ssqImg.objArray[shc][str][obr].aaaImageInfo={sc:shc,page:str,image:obr,}; 
      ssqImg.objArray[shc][str][obr].onload =preloadImagesCallbackFunction;
      ssqImg.objArray[shc][str][obr].src =ssqInput.sc[shc].page[str].imagesFull[obr];

    } 
  // NON PRIORITY IMAGE ARRAY SUBSTRACT
  const subtractTwoArrays = (arr1, arr2) => arr1.filter( el => !arr2.includes(el) )
  ssqImg.nonPriorityImageArray=subtractTwoArrays(ssqImg.dumbPreloadOrder, ssqImg.priorityImageArray) // create array of non  priority images
  // NON PRIORITY IMAGE ARRAY PRELOAD
  for (var i=0; i< ssqImg.nonPriorityImageArray.length; i++) {
      var shc = ssqImg.absoluteOrder[ssqImg.nonPriorityImageArray[i]][0]
      var str = ssqImg.absoluteOrder[ssqImg.nonPriorityImageArray[i]][1] 
      var obr = ssqImg.absoluteOrder[ssqImg.nonPriorityImageArray[i]][2]  
      ssqImg.objArray[shc][str][obr].aaaaaaIsPriority=false;
      ssqImg.objArray[shc][str][obr].aaaImageInfo={sc:shc,page:str,image:obr}; 
      ssqImg.objArray[shc][str][obr].onload =preloadImagesCallbackFunction;
      ssqImg.objArray[shc][str][obr].src =ssqInput.sc[shc].page[str].imagesFull[obr];
  }
  // Count non priority images required
  ssqImg.nonPriorityImageCountRequired =  Math.round((ssqImg.totalImageNo-ssqImg.priorityImageArray.length)*ssqInput.preloadPercentage)

  let t1 = performance.now(); let tdelta =(t1 - t0).toFixed(2);  PRELOADDEBUG && console.log(tdelta,'ms preloadPriorityAndNonPriorityImages','PRIORITY:',ssqImg.priorityImageArray, 'NON-PRIORITY:',ssqImg.nonPriorityImageArray, 'NON PRIORITY REQD: ',ssqImg.nonPriorityImageCountRequired ) 
} // end of preloadPriorityAndNonPriorityImages

function preloadImagesCallbackFunction(){
  this.aaaLoaded=true;
  imageWasLoaded(this.aaaImageInfo, this.aaaaaaIsPriority)  
} // end of preloadImagesCallbackFunction
/**  
* imageWasLoaded
*/ 


function imageWasLoaded(imageInfo, isPriority){
  // Count priority and non priority images
    if (isPriority){ // Count Priority Images 
      ssqImg.priorityImagesPreloadedCount = ssqImg.priorityImagesPreloadedCount+1;    
    } else {// Count non-priority Images
      ssqImg.nonPriorityImagesPreloadedCount=ssqImg.nonPriorityImagesPreloadedCount+1;
    }
  // run if all priority images are loaded 
    if (ssqImg.priorityImagesPreloadedCount >= ssqImg.priorityImageArray.length ){ PRELOADDEBUG && console.log('All priority images have been loaded. Loading non-priority now. ssqImg.nonPriorityImagesPreloadedCount:',ssqImg.nonPriorityImagesPreloadedCount,'/',ssqImg.nonPriorityImageCountRequired  )
      ssqImg.priorityLoadingFinished=true;

    } // end if priority images 
    if ( ssqImg.nonPriorityImagesPreloadedCount >= ssqImg.nonPriorityImageCountRequired ){ //console.log('IMAGE PRELOAD PERCENTAGE WAS MET ')
      ssqImg.nonPriorityLoadingFinished=true;
    } // end of preload count

    if (ssqImg.priorityLoadingFinished && ssqImg.nonPriorityLoadingFinished ){
      if(!ssqImg.zfirstDrawCalled) {
        ssqImg.zfirstDrawCalled=true;  
        PRELOADDEBUG &&  console.log('PRIORITY AND ENOUGH OF NON PRIORITY IMAGES ARE LOADED ------------- >>> RENDER SCROLLSEQUENCE ------------------------------')
        ssqFirstDraw()
        // Create and dispatch event that says that preloadPercentage has been met
          const event = document.createEvent('Event'); // Create the event.
          event.initEvent('ssqPreloadPercentage', true, true); // Define that the event name is 'ssqPreloadPercentage'.
          document.dispatchEvent(event);// target can be any Element or other EventTarget. In this case, the target is document object   
      }
    }

} // end of imageWasLoaded
//-------------------- RENDER FUNCTIONS ----------------------- ARE CALLED ON SCROLL
/**
*           THIS IS USED MOSTLY IN PRO VERSION, AS FREE DEALS WITH IT DIFFERENTLY
* renderRequest(requestor) function  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*
* Who can call this? (sorted by frequency likely to be called)
* OK  - Update of tween (sc,page,image) => check if sc/page/image has changed since last + render)
*     - Resize                          => limit to reasonable ammount (2fps?) - on mobile 
*     - Recalc                          => just run, no questions asked (not likely to fire a lot)
*     - Init                            => just run, called only few times
*     - Orientation change              => just run, no questions asked (not likely to fire a lot)
*
*   There should be a counter of requests vs renders completed with their respective requestors
*     ssqCur.logObj={
*       lastPImgRenderedOnSc:[#,#], [#,#], [#,#],                   [page,image]
*       renderSuccess:[[#,#,#],[#,#,#],[#,#,#],[#,#,#],[#,#,#]]     [sc,page,image]
*       renderRestrict:[[#,#,#],[#,#,#],[#,#,#],[#,#,#],[#,#,#]]    [sc,page,image]
*  
*      }
*
*
*/ 
function renderRequest(sc,page,image,requestor, info){
  //console.log('RENDER REQUEST:',requestor,'" [sc,page,image]:',sc,page, image );
    switch(requestor) {
      case 'tween':
        // Check if last page/image combination on SC is the same if yes = no need to re-render. Else Render.
        if(ssqCur.lastPImgRenderedOnSc[sc][0] === page && ssqCur.lastPImgRenderedOnSc[sc][1] === image){
          // OPTIONAL: save to log 
            // ssqCur.logObj.renderRestrict.push([sc,page,image,requestor]);
        } else {
          renderCanvas(sc,page,image,requestor, info)
          // OPTIONAL: save to log 
            // ssqCur.logObj.renderSuccess.push([sc,page,image,requestor]);
        }
        break;
      case 'resize':
        /**
        *
        *
        */
        //console.log('requested by resize event') 
        renderCanvas(sc,page,image,requestor, info); // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 
        // OPTIONAL: save to log 
          // ssqCur.logObj.renderSuccess.push([sc,page,image,requestor]);         
        break;        
      case 'initActive':
        renderCanvas(sc,page,image,requestor, info)
        // OPTIONAL: save to log 
          ssqCur.logObj.renderSuccess.push([sc,page,image,requestor]);
        break;
      case 'initNotActive':
        renderCanvas(sc,page,image,requestor, info)
        // OPTIONAL: save to log 
          ssqCur.logObj.renderSuccess.push([sc,page,image,requestor]);
        break;   
      case 'orientationChange':
        renderCanvas(sc,page,image,requestor, info)
        // OPTIONAL: save to log 
          ssqCur.logObj.renderSuccess.push([sc,page,image,requestor]);
        break;

      default:
        console.log('warning: no render requestor') // code block
    } // end of switch 
}
/**
* renderCanvas() function
*/ 
function renderCanvas(sc,page,image, requestor,info) {   // Check screen size, update canvas size (css + canvas) and render with scale and align
  DEBUG && console.log('RenderCanvas:',sc,page,image, requestor,info);
  if (ssqImg.objArray[sc][page][image].aaaLoaded){

    let canvasWidth,canvasHeight,canvasAspectRatio;

    // CanvasDPR
    let canvasDPR = ssqHtml[sc].canvas.aaaDPR

    if (ssqInput.sc[sc].forceFullWidth){
      canvasWidth =  document.documentElement.clientWidth;
      ssqHtml[sc].canvas.style.left = -document.getElementsByClassName('scrollsequence-wrap')[sc].getBoundingClientRect().left-document.documentElement.scrollLeft+"px"; 
    } else {
      canvasWidth = document.getElementsByClassName('scrollsequence-pages-wrap')[sc].offsetWidth*1;
    }
    canvasHeight = document.getElementsByClassName('scrollsequence-pages-wrap')[sc].offsetHeight*1;
    //document.getElementsByClassName("ssqalert")[0].innerHTML = 'offheight:'+canvasHeight;
    canvasAspectRatio =  canvasWidth / canvasHeight
    // CSS - Canvas pixel dimensions on screen (=size)
    ssqHtml[sc].canvas.style.width = (canvasWidth*1)+"px";       
    ssqHtml[sc].canvas.style.height =  (canvasHeight*1)+"px"; 
    // CANVAS - How many pixels the canvas has (=quality)
    ssqHtml[sc].context.canvas.width = canvasWidth*canvasDPR;
    ssqHtml[sc].context.canvas.height = canvasHeight*canvasDPR;
    //SCROLLDEBUG && console.log('renderCanvas - canvasAspectRatio:',canvasAspectRatio);  
    if (canvasAspectRatio>=1){ // Panorama aka desktop monitor
        renderScaled(sc,page,ssqImg.objArray[sc][page][image], ssqInput.sc[sc].page[page].scaleTo.desktop, ssqInput.sc[sc].page[page].alignX.desktop, ssqInput.sc[sc].page[page].alignY.desktop);
        //SCROLLDEBUG && console.log('renderScaled LANDSCAPE (DESKTOP) :', ssqInput.sc[sc].page[page].scaleTo.desktop);
    } else {  // Portrait aka mobile screen
        renderScaled(sc,page,ssqImg.objArray[sc][page][image], ssqInput.sc[sc].page[page].scaleTo.mobile, ssqInput.sc[sc].page[page].alignX.mobile, ssqInput.sc[sc].page[page].alignY.mobile);        
        //SCROLLDEBUG && console.log('renderScaled PORTRAIT (MOBILE) :', ssqInput.sc[sc].page[page].scaleTo.mobile);
    }
  } else {console.log('Image [',sc,',',page,',',image,'] was not loaded in time ')};
}
/**
* renderScaled(img, fitOrFill, alignX, alignY) function 
*/  
function renderScaled(sc,page,image, fitOrFill, alignX, alignY){
  var scale, x,y;
  switch (fitOrFill) {
      case "fill": //FILL
          scale = Math.max(ssqHtml[sc].canvas.width / image.width, ssqHtml[sc].canvas.height / image.height);
          break;
      case "fit": // fit 100 %
          scale = Math.min(ssqHtml[sc].canvas.width / image.width, ssqHtml[sc].canvas.height / image.height);
          break;
      default:  // fit (fitOrFill) %
          scale = Math.min(ssqHtml[sc].canvas.width / image.width, ssqHtml[sc].canvas.height / image.height)*fitOrFill;
  }
  switch (alignX) {
      case "left": // Legacy 0.9.93
          x = 0;
          break;
      case "right": // Legacy 0.9.93
          x = (ssqHtml[sc].canvas.width ) - (image.width ) * scale; 
          break;
      case "center": // Legacy 0.9.93
          x = (ssqHtml[sc].canvas.width / 2) - (image.width / 2) * scale;
          break;                  
      default:
          x = (ssqHtml[sc].canvas.width * alignX) - (image.width * alignX) * scale;
  }
  switch (alignY) {
      case "top": // Legacy 0.9.93
          y = 0;
          break;
      case "bottom": // Legacy 0.9.93
          y = (ssqHtml[sc].canvas.height ) - (image.height ) * scale;
          break;
      case "center": // Legacy 0.9.93
          y = (ssqHtml[sc].canvas.height / 2) - (image.height / 2) * scale;
          break;
      default:
          y = (ssqHtml[sc].canvas.height * alignY) - (image.height * alignY) * scale;
  }
  ssqHtml[sc].context.drawImage(image, Math.round(x), Math.round(y), Math.ceil(image.width * scale),Math.ceil(image.height * scale)); // math ceil added to avoid sub-pixel rendering
  ssqCur.lastPImgRenderedOnSc[sc]=[page,image.aaaImageInfo.image];//save last rendered values
  //SCROLLDEBUG && console.log('Rendered scale:',scale,' x:',x,' alignX:',alignX,' y:',y,' alignY:',alignY);
}
//-------------------- UTILITY FUNCTIONS -----------------------
/**
* Utility function that converts (sc,page,image) to absolute image number required by image preload function
*/ 
function ssqUtilsConvToAbs(sc,page,image){
  for (let x = 0; x < ssqImg.totalImageNo; x++) { 
    if (ssqImg.absoluteOrder[x][0] === sc && ssqImg.absoluteOrder[x][1] === page &&ssqImg.absoluteOrder[x][2] === image ){
      return x;
      break
    }
  } 
}




















// ROADM STARTS HERE -  ROADM STARTS HERE -  ROADM STARTS HERE -  ROADM STARTS HERE -  ROADM STARTS HERE -  ROADM STARTS HERE -  ROADM STARTS HERE -  ROADM STARTS HERE -  ROADM STARTS HERE -
/**
*
* Works nicely, almost there. Except onload it makes things sticky.
* Also ssqCur is not being "obeyed" as there are some other vars being used for "simplicity"
*
*
*
*
*/


// Define variables: 

  let lastOnScrollScStatus,lastOnScrollPage,lastOnScrollImage;

  let stickyPinWrap;

  let ticking = false;
  let countFastFire=0;
  let countRafFire=0;

// Load HTML elements into object variable for later use 
  for (let s = 0; s < ssqInput.scLength; s++) { 
    for (let i=0; i<ssqInput.sc[s].page.length; i++) {
      for (let j=0; j<ssqInput.sc[s].page[i].animElLength; j++) {
        ssqInput.sc[s].page[i].animEl[j].thisIsElement=jQuery(".ssq-wrap-"+s+" "+ssqInput.sc[s].page[i].animEl[j].ssqnce_anim_io_id);
                                                      // ssqInput.sc[s].page[i].animEl[j].ssqnce_anim_io_id //  This selects all elements anywhere matching the selector 
                                                      // "#ssq-page-"+s+"-"+i+" "+ssqInput.sc[s].page[i].animEl[j].ssqnce_anim_io_id // -- This selects only selector from this sc and page
      } // End of j loop
    } // End of i loop
  } // End of s loop


/**
 * This block deals with sticky. It either makes the sticky via JS or CSS 
 * Updated since: 1.3.0 
 * 
 * Old version used to wrap the sticky and had a spacer. New version removed spacer and sticky wrap elements
 * 
 */
  if (ssqInput.sc[0].position == 'sticky-js'){
    DEBUG&&console.log('sticky js ')
    /**
    * BEFORE: 
    *   .scrollsequence-sticky: reset style to orig
    */
    function ssqStickyPinWrapBefore(){
      ssqHtml[0].sticky.setAttribute("style", "position:relative;box-sizing: border-box;border:-1px dashed lightgreen;"); // should be same as php, used for reverting the active/after state
    }
    /**
    * ACTIVE: 
    */
    function ssqStickyPinWrapActive(){
      let stickyWidth, stickyHeight, stickyLeft;
      stickyHeight=document.getElementsByClassName('scrollsequence-pages-wrap')[0].offsetHeight*1;
      stickyWidth = document.getElementsByClassName('scrollsequence-wrap')[0].offsetWidth*1;
      stickyLeft = document.getElementsByClassName('scrollsequence-wrap')[0].getBoundingClientRect().left-document.documentElement.scrollLeft+"px"; 
      ssqHtml[0].sticky.setAttribute("style","position:fixed; left:"+stickyLeft+"; top:0px;height:"+stickyHeight+"px; width:"+stickyWidth+"px;margin:0px;padding:0px;border:0px")
    }
    /**
    * AFTER 
    *  .scrollsequence-sticky: 
    */
    function ssqStickyPinWrapAfter(){
      ssqHtml[0].sticky.setAttribute("style", "position:relative;transform: translate3d(0px, "+ssqInput.sc[0].scSpacer+"px, 0px);box-sizing: border-box;border:-1px dashed lightgreen;");
    }

  } else { 
    DEBUG&&console.log('not sticky-js');
  }



/**
* Scroll Event (Throttled to RAF)
*
*
*/
function ssqEventOnScroll(scroll_pos, nopin){
  // RUNS ON EACH SCROLL 
    let curOnScrollScStatus;
    // Check what is the status
      if (scroll_pos >= ssqCalc.sc[0].absBegin && scroll_pos < ssqCalc.sc[0].absEnd ) { 
          curOnScrollScStatus='active'
          for (let i=0; i<ssqInput.sc[0].page.length; i++) { // Loop through pages
            if (scroll_pos >= ssqCalc.sc[0].page[i].absBegin && scroll_pos< ssqCalc.sc[0].page[i].absEnd){ 
              ssqCur.sc=0
              ssqCur.page=i
              ssqCur.pageProgress= (scroll_pos-ssqCalc.sc[0].page[i].absBegin)/(ssqInput.sc[0].page[i].pageSpacer)
              ssqCur.image=Math.round(ssqCur.pageProgress*(ssqInput.sc[0].page[i].imagesLength-1))   
              //console.log('found active page:',i,'ssqCur:',ssqCur.sc,ssqCur.page,ssqCur.image,scroll_pos);       
              break;
            }
          } // end of i loop      
      } else if (scroll_pos < ssqCalc.sc[0].absBegin){ 
          curOnScrollScStatus='before'
      } else  { 
          curOnScrollScStatus='after'
      }    
    //console.log(curOnScrollScStatus);

  // Runs O-N-L-Y when the SC status has changed ????????????????? WHAT ABOUT WHEN IS INITIALLY ACTIVE ???????? 
    // Deal with Sticky first
      if (lastOnScrollScStatus!==curOnScrollScStatus){ 
        //console.log('!!!!!!!!!!!!!!!!!!!!!!!!!!!!status has changed! previous:', lastOnScrollScStatus,'curOnScrollScStatus:', curOnScrollScStatus);
        lastOnScrollScStatus=curOnScrollScStatus
        // Update DOM according to new status
          if ( ssqInput.sc[0].position == 'sticky-js' ){ // Since 1.3.0
              switch(curOnScrollScStatus) {
              case 'active':
                if (!nopin){
                  //console.log(window.scrollY,"!!!!!!!!!!!!!!!!!!!!!!!!!is sticky")
                  ssqStickyPinWrapActive();              
                }
                break;
              case 'after':
                if (!nopin){
                  //console.log(window.scrollY,"!!!!!!!!!!!!!!!!!!!!!!!!after sticky")
                  ssqStickyPinWrapAfter()
                }
                break;
              default: // before 
                if (!nopin){
                  //console.log(window.scrollY,"!!!!!!!!!!!!!!!!!!!!!!!!!before sticky")
                  ssqStickyPinWrapBefore()
                }
              } // end of switch
          } // end of if sticky=js  
      } // end of IF - do this ONLY on the status change

  // Runs O N L Y when active 
    if (curOnScrollScStatus==='active'){
      // Runs ONLY when cur page has changed 
        // Deal with pages next 
          if(lastOnScrollPage!==ssqCur.page){
            lastOnScrollPage=ssqCur.page;
            //console.log('NEW PAGE DISPLAY PLEASE');
            for (let i=0; i<ssqInput.sc[0].page.length; i++) { // Loop through pages
              if (i === ssqCur.page){
                ssqHtml[0].page[i].style.display = "block"; 
              } else {
                ssqHtml[0].page[i].style.display = "none"; 
              } //end of else 
            } // end of i loop
          } //end of if 
      // Runs Only when cur image has changed 
        // deal with elements
          if(lastOnScrollImage!==ssqCur.image){
            lastOnScrollImage = ssqCur.image
            //console.log('NEW IMAGE = ANIM EL STEP PLEASE');
            for (let j=0; j<ssqInput.sc[0].page[ssqCur.page].animElLength; j++) {
                        //      or equal was here long time ago                                                 // or equal added 2020-17-12
              if (ssqCur.image >= ssqInput.sc[0].page[ssqCur.page].animEl[j].ssqnce_anim_io_start && ssqCur.image <= ssqInput.sc[0].page[ssqCur.page].animEl[j].ssqnce_anim_io_end){
                for (let k=0; k<ssqInput.sc[0].page[ssqCur.page].animEl[j].thisIsElement.length; k++) { // loop through elements if more are selected
                  ssqInput.sc[0].page[ssqCur.page].animEl[j].thisIsElement[k].style.visibility = "inherit";
                }
              }else{
                for (let k=0; k<ssqInput.sc[0].page[ssqCur.page].animEl[j].thisIsElement.length; k++) { // loop through elements if more are selected
                  ssqInput.sc[0].page[ssqCur.page].animEl[j].thisIsElement[k].style.visibility = "hidden";
                }
              }
            } // end of j loop  
            //console.log('RENDER PLASE');
            renderCanvas(0,ssqCur.page,ssqCur.image)


          } // end of if 
    } // end of curOnScrollScStatus === active 
} // end of ssqEventOnScroll


/**
* RESIZE EVENT
*
*
*/
let lastWindowWidth; // required for resize event checking
let lastWindowHeight; // required for resize event checking


function ssqEventReqAnimFrameFire(scroll_pos, requestor){
  //countRafFire=countRafFire+1; console.log('RAF:',countRafFire, requestor);
  switch(requestor) {
    case "scroll":
      ssqEventOnScroll(scroll_pos)
      break;
    case "resize":
        if(document.documentElement.clientWidth!==lastWindowWidth){ //console.log('WIDTH IS CHANGING ');
          lastWindowWidth=document.documentElement.clientWidth
          ssqCalcCalculate()
          // ssqCurCalculate(window.scrollY) <- should be scrollpos, anyway - is this line even required???? 
          renderCanvas(0,ssqCur.page,ssqCur.image)
        } else if(document.documentElement.clientHeight!==lastWindowHeight){ //console.log('HEIGHT IS CHANGING ');
          lastWindowHeight=document.documentElement.clientHeight
          renderCanvas(0,ssqCur.page,ssqCur.image)
        }  // end of changing height
      break;
    case "orientationchange": // console.log('orientation changed')
        ssqCalcCalculate()
        renderCanvas(0,ssqCur.page,ssqCur.image)
      break;    
    default:
      console.log('ERROR REQUESTOR NOT DEFINED!')
  }  

} // end of ssqEventReqAnimFrameFire

/**
* Called by scroll, resize orientationchange
*/
function ssqEventFastFire(scroll_pos, requestor){
  //countFastFire=countFastFire+1; console.log('FAST:',countFastFire, requestor);
    if (!ticking) {
      window.requestAnimationFrame(function() {
        ssqEventReqAnimFrameFire(scroll_pos, requestor);
        ticking = false;
      });
      ticking = true;
    }
} // end of ssqEventFastFire



/**
* --------------------- DELAYED INITIAL TIMING  -----------------
* --------------------- DELAYED INITIAL TIMING  -----------------
* --------------------- DELAYED INITIAL TIMING  -----------------
*/




function ssqFirstDraw(){
 //console.log('ssqFirstDraw start.')
 ssqCalcCalculate(); // run this because it's cheap and get fresh values of  absBegin, absEnd, left etc
 ssqCurCalculate(window.scrollY) // run this because it's cheap and get fresh values of  ssqCur
 ssqEventOnScroll(window.scrollY, true); // run this in order  to get lastOnScrollScStatus

 //console.log('ssqFirstDraw mid. status:',lastOnScrollScStatus)
  if (lastOnScrollScStatus === 'before'){
    ssqEventOnScroll(ssqCalc.sc[0].absBegin, true); // this is to render canvas 
    ssqEventOnScroll(window.scrollY); // to reset to correct state 1.3.0 !!! nevim jestli to je spravne.
  }
  else if (lastOnScrollScStatus === 'active'){
    // do nothing, should be rendered already from first iteration above
    //console.log('THIS STUFF IS ACTIVEEEEEEEE',window.scrollY)
    (ssqInput.sc[0].position == 'sticky-js') && ssqStickyPinWrapActive(); // "(ssqInput.sc[0].position == 'sticky-js')" Since 1.3.0 // not sure why this has to be here explicitly. should be done within ssqEventOnScroll below. !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    ssqEventOnScroll(window.scrollY);
  }
  else if (lastOnScrollScStatus === 'after'){
    ssqEventOnScroll(ssqCalc.sc[0].absEnd-1, true); // one pixel before the end. should be okay i believe. just 1 px dirty
    ssqEventOnScroll(window.scrollY); // to reset to correct state 1.3.0 !!! nevim jestli to je spravne.
  } else {
    //console.log('ERROR in ssqFirstDraw - SC Status is not defined.')
  }

  //ssqEventOnScroll(window.scrollY) // Only in FREE VERSION ???????

// Add Listeners
  window.addEventListener("scroll", function() {ssqEventFastFire(window.scrollY,'scroll')});
  window.addEventListener("resize", function() {ssqEventFastFire(window.scrollY,'resize')});
  window.addEventListener("orientationchange", function() {ssqEventFastFire(window.scrollY,'orientationchange')}); 

// VERY IMPORTANT  - continuus recalc
  let nula=0;
  let interval = setInterval(function() {
      nula=nula+1;
             ssqCalcCalculate();
   }, 1000); 

// VERY IMPORTANT  - continuus recalc




 // Make stuff visible 
 jQuery('.scrollsequence-wrap').css("visibility", "inherit");


} // end of ssqFirstDraw

/**
* SAME AS FREE/PRO
*/
function delayedInitialExecution(){
  ssqCalcCalculate();
  ssqCurCalculate(window.scrollY)
  ssqInitCalculate();
  ssqDumbPreloadArray(ssqInit.aaaCurImg,ssqImg.totalImageNo);
  preloadPriorityAndNonPriorityImages() // this used to be -> dumberPreloadArray();  
  // preloadImages();  // removed 
                    /** ==> imageWasLoaded() 
                    *     => once 25%  
                    *        ==> ssqTimelines7 => multiple times randomly
                    *           ==> renderRequest 
                    *           ==> renderCanvas 
                    *           ==> renderScaled
                    *        ==> ssqFirstDraw
                    */

}

// window.addEventListener("load", function(){ setTimeout(delayedInitialExecution, 50); }); // OBSOLETE 
setTimeout(delayedInitialExecution, 50) // This was changed 1.1.2. frin an onload event listener above




// Closing the re-run function so that it can re-run if scrollsequence-wrap is not ready yet
} else {
  setTimeout(scrollsequenceMainFunction, 100);
  console.log('"scrollsequence-wrap" container not found in DOM - trying again in 100ms')
}
}scrollsequenceMainFunction();
