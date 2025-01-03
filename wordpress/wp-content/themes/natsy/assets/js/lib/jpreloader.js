/*
 * jPreLoader - jQuery plugin
 * Create a Loading Screen to preload images and content for you website
 *
 * Name:			jPreLoader.js
 * Author:		Kenny Ooi - http://www.inwebson.com
 * Date:			July 11, 2012
 * Version:		2.1
 * Example:		http://www.inwebson.com/demo/jpreloader-v2/
 *
 */

(function ($) {
    var items = new Array(),
        errors = new Array(),
        onComplete = function () {
        },
        current = -1;

    var jpreOptions = {
        splashVPos: '35%',
        loaderVPos: '75%',
        splashID: '#jpreContent',
        showSplash: true,
        showPercentage: true,
        autoClose: true,
        closeBtnText: 'Start!',
        onetimeLoad: false,
        debugMode: false,
        splashFunction: function () {
        }
    }

    //cookie
    var getCookie = function () {
        if (jpreOptions.onetimeLoad) {
            var cookies = document.cookie.split('; ');
            for (var i = 0, parts; (parts = cookies[i] && cookies[i].split('=')); i++) {
                if ((parts.shift()) === "jpreLoader") {
                    return (parts.join('='));
                }
            }
            return false;
        } else {
            return false;
        }

    }
    var setCookie = function (expires) {
        if (jpreOptions.onetimeLoad) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + expires);
            var c_value = ((expires == null) ? "" : "expires=" + exdate.toUTCString());
            document.cookie = "jpreLoader=loaded; " + c_value;
        }
    }

    //get all images from css and <img> tag
    var getImages = function (element) {
        $(element).find('*:not(script)').each(function () {
            var url = "";

            if ($(this).css('background-image').indexOf('none') == -1 && $(this).css('background-image').indexOf('-gradient') == -1) {
                url = $(this).css('background-image');
                if (url.indexOf('url') != -1) {
                    var temp = url.match(/url\((.*?)\)/);
                    url = temp[1].replace(/\"/g, '');
                }
            } else if ($(this).get(0).nodeName.toLowerCase() == 'img' && typeof($(this).attr('src')) != 'undefined') {
                url = $(this).attr('src');
            }

            if (url.length > 0) {
                items.push(url);
            }
        });
    }

    var getVideos = function (element) {
        $(element).find('video').each(function (num, el) {
            el.load();
            el.onloadeddata = function () {
                completeLoading();
            };
        });
    };

    var getIframes = function (element) {
        $(element).find('iframe').each(function (num, el) {
            $(el).ready(function () {
                completeLoading();
            });
        });
    };

    var per = 0, curPer = 0,
        ticks = 5;

    var changePercentage = function () {
        if (curPer < per) {
            curPer += parseInt((per - curPer) / ticks);
            curPer = Math.min(curPer, 100);
            ticks--;
        }
        $('.preloader .percentage').text(curPer);
        $('#circle').circleProgress('value', curPer / 100);
        if (curPer < 100) {
            setTimeout(function () {
                changePercentage();
            }, 100);
        }
    };

    //create preloaded image
    var preloading = function () {
        completeLoading();
        for (var i = 0; i < items.length; i++) {
            if (loadImg(items[i])){
                loadImg(items[i]);
            };
        }
        if(nova_js_var.topbar_progress != 1) {
            changePercentage();
        }
    }
    var loadImg = function (url) {
        var imgLoad = new Image();
        $(imgLoad)
            .load(function () {
                completeLoading();
            })
            .error(function () {
                errors.push($(this).attr('src'));
                completeLoading();
            })
            .attr('src', url);
    };

    //update progress bar once image loaded
    var completeLoading = function () {
        current++;
        // var length = items.length + $('video').length + $('iframe').length;
        var length = items.length;
        if (length == 0) {
            current++;
        }

        per = Math.round((current / length) * 100);
        // $('.preloader .line .inner').stop().animate({
        //     width: per + '%'
        // }, 500, 'linear');

        if (jpreOptions.showPercentage) {
            //     $('.preloader .percentage').text(per);
            ticks = 7;
        }

        //if all images loaded
        if (current >= length) {
            current = length;
            setCookie();	//create cookie

            if (jpreOptions.showPercentage) {
                per = 100;
                // $('.preloader .percentage').text("100");
            }

            //fire debug mode
            if (jpreOptions.debugMode) {
                var error = debug();
            }

            //max progress bar
            // $(jBar).stop().animate({
            // 	width: '100%'
            // }, 500, 'linear', function() {
            // });
            loadComplete();

        }
    }

    var loadComplete = function () {
        onComplete();	//callback function
    };

    //debug mode
    var debug = function () {
        if (errors.length > 0) {
            var str = 'ERROR - IMAGE FILES MISSING!!!\n\r'
            str += errors.length + ' image files cound not be found. \n\r';
            str += 'Please check your image paths and filenames:\n\r';
            for (var i = 0; i < errors.length; i++) {
                str += '- ' + errors[i] + '\n\r';
            }
            return true;
        } else {
            return false;
        }
    }

    $.fn.jpreLoader = function (options, callback) {
        if (options) {
            $.extend(jpreOptions, options);
        }
        if (typeof callback == 'function') {
            onComplete = callback;
        }

        //show preloader once JS loaded
        $('body').css({
            'display': 'block'
        });

        return this.each(function () {
            if (!(getCookie())) {
                getImages(this);
                // getVideos(this);
                // getIframes(this);

                preloading();
            }
            else {	//onetime load / cookie is set
                $(jpreOptions.splashID).remove();
                onComplete();
            }
        });
    };

})(jQuery);