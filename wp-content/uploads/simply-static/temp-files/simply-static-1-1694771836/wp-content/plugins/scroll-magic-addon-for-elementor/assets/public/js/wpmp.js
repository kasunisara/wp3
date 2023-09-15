'use strict';

(function($) {

    $( document ).ready(function(){
        var deviceW = 'desktop';
        if(document.body.offsetWidth <= 1024 && document.body.offsetWidth > 420){
            deviceW = "tablet";
        }
        if(document.body.offsetWidth <= 420){
            deviceW = "mobile";
        }
        $('.scrollMagicControl').each(function(v,i){
            
            const seft = this;
            const control = seft.attributes;
            if(typeof control['wpmp_enable_'+deviceW] !== 'undefined'){
                return;
            }

            const seftID = $(seft).attr('id');
            var effect = JSON.parse(
                $(seft).attr('effect')
                .replace( /,}/g, "}")
                .replace( /'/g, '"')
                .replace( /wpmp_/g, '')
                .replace( /p-l/g, 'p l')
                .replace( /p-c/g, 'p c')
                .replace( /p-r/g, 'p r')
                .replace( /r-l/g, 'r l')
                .replace( /r-c/g, 'r c')
                .replace( /r-r/g, 'r r')
                .replace( /m-l/g, 'm l')
                .replace( /m-c/g, 'm c')
                .replace( /m-r/g, 'm r')
            );
            $.each(effect,function(index,value){
                if(typeof value.yoyo !== 'undefined'){
                    effect[index].yoyo = true;
                }
                if(typeof value.repeat !== 'undefined'){
                    effect[index].repeat =  value.repeat*1;
                }
            })
            const triggerElement = "triggerElement_" + Math.floor((Math.random() * 9999999) + 1);
            $(seft).next().addClass( triggerElement ).addClass('animated');
            var controller = new ScrollMagic.Controller();
            var setTween = gsap.timeline();
            $.each(effect,function(i,v){
                setTween.to("."+triggerElement,  v );
            })
            var scene = new ScrollMagic.Scene({
                triggerElement:"#"+seftID,
                triggerHook:control.wpmp_trigger_hook ? control.wpmp_trigger_hook.value:0,
                duration: control.wpmp_duration ? control.wpmp_duration.value : 0,
                offset:control.wpmp_offset? control.wpmp_offset.value :0,
                tweenChanges: typeof control.wpmp_tween_changes !== 'undefined',
            })
            .reverse( typeof control.wpmp_reverse !== 'undefined' )
            .setTween(setTween);
            if (typeof control.wpmp_debug !== 'undefined') {
                scene.addIndicators();
            }
            if (typeof control.wpmp_pin !== 'undefined') {
                scene.setPin("."+triggerElement,{pushFollowers: typeof control.wpmp_pushfollowers !== 'undefined'});
            }
            if (typeof control.wpmp_enable_class_toggle !== 'undefined') {
                var classCSS = control.wpmp_class_css.value;
                if(classCSS=='custom'){
                    classCSS =   typeof control.wpmp_custom_class !== 'undefined'? control.wpmp_custom_class.value :"";
                }
                scene.setClassToggle("."+triggerElement, classCSS);
            }
            scene.addTo(controller);

            // SVG
            if( $(seft).next().hasClass('drawsvg') || $(seft).next().find('.drawsvg').length >0){
                var shapes = "";
                $(seft).next().find('path,line,polyline,polygon,rect,ellipse,circle').each(function(i,v){
                    var randomID = "svgDraw"+Math.floor((Math.random() * 9999) + 1);
                    shapes += "."+randomID+",";
                    $(v).addClass(randomID);
                });
                if(shapes==null || !shapes) return;
                shapes = shapes.substring(0, shapes.length - 1);
                var setTweenDraw = gsap.timeline();
                setTweenDraw.fromTo(shapes, {drawSVG: (control.wpmp_draw_from? control.wpmp_draw_from.value :0) +"%"}, {duration: 1, drawSVG:(control.wpmp_draw_to? control.wpmp_draw_to.value :0) +"%", stagger: 1});
                var drawSVG = new ScrollMagic.Scene({
                    triggerElement:"#"+seftID,
                    triggerHook:control.wpmp_trigger_hook ? control.wpmp_trigger_hook.value:0,
                    duration: control.wpmp_duration ? control.wpmp_duration.value : 0,
                    offset:control.wpmp_offset? control.wpmp_offset.value :0,
                    tweenChanges: typeof control.wpmp_tween_changes !== 'undefined',
                })
                .reverse( typeof control.wpmp_reverse !== 'undefined' )
                .setTween(setTweenDraw);
                drawSVG.addTo(controller);

            }


            // imageSequence
            if( $(seft).next().hasClass('imageSequence') || $(seft).next().find('.imageSequence').length >0){
                var images = $(seft).next().find('.wpmp_image_sequence').attr('data-src').split(",");
                var repeat = $(seft).next().find('.wpmp_image_sequence').attr('wpmp_repeat_sequence_img') ? $(seft).next().find('.wpmp_image_sequence').attr('wpmp_repeat_sequence_img') : 0 ;
                var obj = {curImg: 0};
                var setTweenImageSequence = gsap.to(obj, 0.5,
                    {
                        curImg: images.length - 1,
                        roundProps: "curImg",
                        repeat: repeat,
                        immediateRender: true,
                        ease: Linear.easeNone,
                        onUpdate: function () {
                            $(seft).next().find('.wpmp_image_sequence').attr("src", images[obj.curImg]);
                        }
                    }
                );
                var imageSequence = new ScrollMagic.Scene({
                    triggerElement:"#"+seftID,
                    triggerHook:control.wpmp_trigger_hook ? control.wpmp_trigger_hook.value:0,
                    duration: control.wpmp_duration ? control.wpmp_duration.value : 0,
                    offset:control.wpmp_offset? control.wpmp_offset.value :0,
                    tweenChanges: typeof control.wpmp_tween_changes !== 'undefined',
                })
                .reverse( typeof control.wpmp_reverse !== 'undefined' )
                .setTween(setTweenImageSequence);
                imageSequence.addTo(controller);
            }

            // splitText
            if( $(seft).next().hasClass('splitText') || $(seft).next().find('.splitText').length >0){
                var splitTextEffect = JSON.parse(
                    $(seft)
                    .attr('split-text')
                    .replace( /,}/g, "}")
                    .replace( /'/g, '"')
                    .replace( /wpmp-splittext_/g, '')
                    .replace( /p-l/g, 'p l')
                    .replace( /p-c/g, 'p c')
                    .replace( /p-r/g, 'p r')
                    .replace( /r-l/g, 'r l')
                    .replace( /r-c/g, 'r c')
                    .replace( /r-r/g, 'r r')
                    .replace( /m-l/g, 'm l')
                    .replace( /m-c/g, 'm c')
                    .replace( /m-r/g, 'm r') );
                var setSplitText = gsap.timeline(),
                    mySplitText = new SplitText("."+triggerElement, {type:"words,chars"});
                    setSplitText.from( mySplitText.chars ,splitTextEffect, "+=0");

                var drawSVG = new ScrollMagic.Scene({
                    triggerElement:"#"+seftID,
                    triggerHook:control.wpmp_trigger_hook ? control.wpmp_trigger_hook.value:0,
                    duration: control.wpmp_duration ? control.wpmp_duration.value : 0,
                    offset:control.wpmp_offset? control.wpmp_offset.value :0,
                    tweenChanges: typeof control.wpmp_tween_changes !== 'undefined',
                })
                .reverse( typeof control.wpmp_reverse !== 'undefined' )
                .setTween(setSplitText);
                drawSVG.addTo(controller);
            }
        });
    })
})( jQuery );