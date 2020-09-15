/**************************************************************************************************/
function pad(num, size, prep) {
    prep = prep || '0';
    num = num + '';
    return num.length >= size ? num : new Array(size - num.length + 1).join(prep) + num;
}
/**************************************************************************************************/
function closeMegaSubmenu(o) {
    if (typeof o === 'undefined') {
//        $('.dropdown-item.submenu').removeClass('submenu');
    } else {
        $(o).parent().siblings().find('.submenu').removeClass('submenu');
    }
}

/**************************************************************************************************/
function animate() {
    var svg = $('svg.wave');
    if (svg.length > 0) {
        svg.each(function(i, e) {
            var curLines = $(e).find('g');
            if (curLines.length < 5) {
//                if ((t % 8) == 0) {
                    var group = document.createElementNS("http://www.w3.org/2000/svg", 'g');
                    var newLine = document.createElementNS("http://www.w3.org/2000/svg", 'path');
                    group.appendChild(newLine);
//                    group.setAttribute("transform", "translate(0 " + (curLines.length * 20) + ")");
                    $(e).append(group);
  //              }                
            }
        });
    }

    var points = xs.map(function(x) {
        var y = 30 + 20 * Math.sin((x + t) / 35);
        return [x, y];
    });

    var path = "M" + points.map(function(p) {
            return p[0] + "," + p[1];
        }).join(" L");

    var wave = svg.find('path');

    $(wave).each(function(i, p) {
        $(p).attr("d", path);
    });

    t -= 0.75;
    requestAnimationFrame(animate);
}
/**************************************************************************************************/

function img2svg(obj) {
    //  Replace all SVG images with inline SVG
    $(obj).each(function() {
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        $.get(imgURL, function(data) {
    //          Get the SVG tag, ignore the rest
            var $svg = $(data).find('svg');
    //         Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
    //         Add replaced image\'s classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }
    //         Remove any invalid XML tags as per http:validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
    //         Replace image with new SVG

            $img.replaceWith($svg);

            var $btn = $svg.parent();
            if ($btn.hasClass('btn-toShop')) {
                var iconBG = $btn.css('backgroundColor');
                $svg.find('.iconBG').attr("fill", iconBG);
            }
        });
    });
}

/**************************************************************************************************/

var BrowserDetect = {
    init: function () {
        this.browser = this.searchString(this.dataBrowser) || "Other";
        this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
    },
    searchString: function (data) {
        for (var i = 0; i < data.length; i++) {
            var dataString = data[i].string;
            this.versionSearchString = data[i].subString;

            if (dataString.indexOf(data[i].subString) !== -1) {
                return data[i].identity;
            }
        }
    },
    searchVersion: function (dataString) {
        var index = dataString.indexOf(this.versionSearchString);
        if (index === -1) {
            return;
        }

        var rv = dataString.indexOf("rv:");
        if (this.versionSearchString === "Trident" && rv !== -1) {
            return parseFloat(dataString.substring(rv + 3));
        } else {
            return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
        }
    },

    dataBrowser: [
        {string: navigator.userAgent, subString: "Edge", identity: "Edge"},
        {string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
        {string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
        {string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
        {string: navigator.userAgent, subString: "Opera", identity: "Opera"},  
        {string: navigator.userAgent, subString: "OPR", identity: "Opera"},  
        {string: navigator.userAgent, subString: "Chrome", identity: "Chrome"}, 
        {string: navigator.userAgent, subString: "Safari", identity: "Safari"}       
    ]
};

BrowserDetect.init();

/**************************************************************************************************/

function showHandOnHome() {
    var isWidth = (window.innerWidth > 576),
        isHeight = (window.innerHeight > 576),
        hasClass = $('.home-header-hand').hasClass('open');

//    if (isWidth && isHeight && !hasClass) {
    if (!hasClass) {
        $('.home-header-hand').addClass('open');
    } else if ((!isWidth || !isHeight) && hasClass) {
//        $('.home-header-hand').removeClass('open');        
    }
}


/**************************************************************************************************/
function isCookieAccepted() {
    if (!hasCookie('cookiesaccepted')) {
        var CA = $('.cookie-accept');
        CA.css({'bottom': '0'});

        CA.find('button').click(function() {
            setCookie('cookiesaccepted', 'Cookies Accepted', 30);
            CA.css({'bottom': '-100%', 'transition-delay': '0s'});
            openModalBuchen();
        });
    }
}

/**************************************************************************************************/

function getScrollbarWidth() {
    return (window.innerWidth - $(document).width());
}

/**************************************************************************************************/

function is_touch_device() {
  var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
  var mq = function(query) {
    return window.matchMedia(query).matches;
  }

  if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
    return true;
  }

  // include the 'heartz' as a way to have a non matching MQ to help terminate the join
  // https://git.io/vznFH
  var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
  return mq(query);
}

/**************************************************************************************************/

function detectMouseWheelDirection(e) {
    var delta = null,
        direction = false;
    if (typeof e  === 'undefined') { // if the event is not provided, we get it from the window object
        e = window.event;
    }
    if (e.deltaY) {
        delta = e.deltaY;
    }
    if ( delta !== null ) {
        direction = delta > 0 ? 'up' : 'down';
    }
    return direction;
}

/**************************************************************************************************/

function replaceValidationUI(form) {

//    var form = $('.content-contact-form form');

    $(form).on('invalid', function(e) {
        e.preventDefault();
    });
    
    $(form).on('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
        }
    });

    $(form).find('button[type=submit]')
        .on('click', function(e) {
            e.preventDefault();
            var fieldError = [];
            $(form).find('input:not([type="hidden"]), textarea, select').each(function() {
                var field = $(this);
                if (!this.validity.valid) {
                    var uniqID = Math.random().toString(36).substr(2);
                    $(this)
                        .removeClass('ok-field')
                        .addClass('error-field')
                        .parent().find('label')
                        .removeClass('ok-label')
                        .addClass('error-label');
                    var tmpUniqID = $(this).data('uniqID');
                    var formMessage = getFieldError(field[0]);

                    if (typeof tmpUniqID === "undefined") {
                        $(this)
                            .data('uniqID', uniqID)
                            .parent()
                            .append('<div id=' + uniqID + ' class="error-message">' + formMessage + '</div>');
                        $('#' + uniqID).slideDown(400, 'linear');
                    } else {
                        $('#' + tmpUniqID).html(formMessage);
                    }
                    fieldError.push(this);
                } else {
                    $('#' +  $(this).data('uniqID')).slideUp(400, 'linear', function() {
                        $(this).remove();
                    });
                    $(this)
                        .removeClass('error-field')
                        .addClass('ok-field')
                        .removeData('uniqID')
                        .parent().find('label')
                        .removeClass('error-label')
                        .addClass('ok-label');
                }
            });
            if (fieldError.length == 0) {
                $(form).submit();
            } else {
                var coordinate = getCoordinates(form, fieldError[0]);
                $('html, body').stop().animate({scrollTop: coordinate.scroolTo}, 400);
                return false;
            }
        });
}

/**************************************************************************************************/

function getFieldError(field) {
    var errType = '';
    if (field.validity.valueMissing) {
        errType = 'valueMissing';
        var type = field.type;
        if (type == 'checkbox' || type == 'radio' || type == 'select-one' || type == 'file') {
            errType += '_' + type.replace('-', '_');
        }
    } else if (field.validity.typeMismatch) {
        errType = 'typeMismatch';
    } else if (field.validity.patternMismatch) {
        errType = 'patternMismatch';
    } else if (field.validity.tooLong) {
        errType = 'tooLong';
    } else if (field.validity.tooShort) {
        errType = 'tooShort';
    } else if (field.validity.rangeUnderflow) {
        errType = 'rangeUnderflow';
    } else if (field.validity.rangeOverflow) {
        errType = 'rangeOverflow';
    } else if (field.validity.stepMismatch) {
        errType = 'stepMismatch';
    } else if (field.validity.badInput) {
        errType = 'badInput';
    }

    var errMessage;
    if (typeof formValidate !== 'undefined') {
        errMessage = formValidate[errType];
    }
    if (typeof errMessage === 'undefined' || errMessage.length === 0) {
        errMessage = field.validationMessage;
    }

    return errMessage;
}

/**************************************************************************************************/

function getCoordinates(o, f) {

    o = (typeof f === "undefined" ? o : o.find(f));
    var spot = o.offset();

    spot.height = o.outerHeight();
    spot.width = o.outerWidth();
    spot.bottom = spot.top + spot.height;
    spot.right = spot.left + spot.width;

    spot.screenHeight = $(window).height();
    spot.fromScreenTop = Math.ceil((spot.screenHeight - spot.height) / 2);
    spot.scroolTo = spot.top - spot.fromScreenTop;

    return spot;
}

/**************************************************************************************************/

function whichPrefix() {
  var t,
      el = document.createElement("fakeelement");
  var animations = {
    "animation"      : "",
    "OAnimation"     : "o",
    "MozAnimation"   : "moz",
    "WebkitAnimation": "webkit",
    "MSAnimation"    : "MS"
  }
  for (t in animations){
    if (el.style[t] !== undefined){
      return animations[t];
    }
  }
}
var eventPrefix = whichPrefix();

/**************************************************************************************************/

/*
    var anim = document.getElementById("anim"),

    PrefixedEvent(anim, "AnimationStart", AnimationListener);
    PrefixedEvent(anim, "AnimationIteration", AnimationListener);
    PrefixedEvent(anim, "AnimationEnd", AnimationListener);
*/

// apply prefixed event handlers
function PrefixedEvent(element, type, callback) {

    var pfx = eventPrefix;

    if (!pfx) type = type.toLowerCase();

//console.log(callback, typeof callback, type, element);

    element.on(
        pfx + type,
        function(event) {
            if (typeof callback === "function") {
                setTimeout(callback, 1);
            }
        }
    );
}

/**************************************************************************************************/

function whichAnimationEvent(){
  var t,
      el = document.createElement("fakeelement");

  var animations = {
    "animation"      : "animationend",
    "OAnimation"     : "oAnimationEnd",
    "MozAnimation"   : "animationend",
    "WebkitAnimation": "webkitAnimationEnd"
  }

  for (t in animations){
    if (el.style[t] !== undefined){
      return animations[t];
    }
  }
}

var animationEvent = whichAnimationEvent();

function whichTransitionEvent(){
  var t,
      el = document.createElement("fakeelement");

  var transitions = {
    "transition"      : "transitionend",
    "OTransition"     : "oTransitionEnd",
    "MozTransition"   : "transitionend",
    "WebkitTransition": "webkitTransitionEnd"
  }

  for (t in transitions){
    if (el.style[t] !== undefined){
      return transitions[t];
    }
  }
}

var transitionEvent = whichTransitionEvent();

/**************************************************************************************************/

function onAnimationEnd(o, callback) {
    $(o).one(
        animationEvent,
        function(event) {
            if (typeof callback === "function") {
                setTimeout(callback, 1);
            }
        }
    );
}

function onTransitionEnd(o, callback) {
    $(o).one(
        transitionEvent,
        function(event) {
            if (typeof callback === "function") {
                setTimeout(callback, 1);
            }
        }
    );
}

/**************************************************************************************************/

function pageOnBottom(mBottom) {
    mBottom = (typeof mBottom !== 'undefined') ? mBottom : pageFromBottom;
    return (($(window).scrollTop() + $(window).height()) > ($(document).height() - mBottom));
}
function pageOnTop(mTop) {
    mTop = (typeof mTop !== 'undefined') ? mTop : pageFromTop;
    return ($(window).scrollTop() <= mTop);
}
function pageGoTop(callback) {
    $('html, body').animate({scrollTop : 0}, 600, 'linear', function() {
        $('body').removeClass('on-bottom').addClass('on-top');
        if (typeof callback !== 'undefined') {
            callback();
        }       
    });
}
function pageGoBottom(callback) {
    $('html, body').animate({scrollTop: $(document).height()}, 600, 'linear', function() {
        $('body').addClass('on-bottom').removeClass('on-top');  
        if (typeof callback !== 'undefined') {
            callback();
        }
    });
}

function pageOnScroll(mDelimiter) {
        mDelimiter = (typeof mDelimiter !== 'undefined' ? mDelimiter : pageFromTop);
        if (pageOnTop(mDelimiter) == true) {
            $('body').removeClass('on-bottom').addClass('on-top');
        } else if (pageOnBottom(mDelimiter) == true) {
            $('body').addClass('on-bottom').removeClass('on-top');  
        } else {
            $('body').removeClass('on-bottom').removeClass('on-top');
        }
}

/**************************************************************************************************/

function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
    }));
}

function b64DecodeUnicode(str) {
    // Going backwards: from bytestream, to percent-encoding, to original string.
    return decodeURIComponent(atob(str).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
}

/**************************************************************************************************/

function setCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(nameEQ) == 0) {
            return c.substring(nameEQ.length, c.length);
        }
    }
    return "";
}

function hasCookie(name) {
    var ca = getCookie(name);
    return (ca != "");
}

function delCookie(name) {
    if (hasCookie(name)) {
        setCookie(name, "", -1);
    }
}

/**************************************************************************************************/

$.wait = function( callback, seconds){
   return window.setTimeout( callback, seconds * 1000 );
}

/**************************************************************************************************/

function equalHeights(className) {
    var height = 0;
    $(className).css('height', '');
    $(className).each(function() {
        height = (height < $(this).innerHeight() ? $(this).innerHeight() : height);
    });
    $(className).height(height);
}

/**************************************************************************************************/
