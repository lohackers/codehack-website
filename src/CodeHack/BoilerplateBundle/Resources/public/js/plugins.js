// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}

// Place any jQuery/helper plugins in here.

window.Utils = {
  IS_IPAD: (navigator.userAgent.match(/iPad/i) != null) ? true : false,
  IS_IPHONE_OR_IPOD: ((navigator.userAgent.match(/iPhone/i) != null) || (navigator.userAgent.match(/iPod/i) != null)) ? true : false,
  IS_ANDROID: (navigator.userAgent.toLowerCase().indexOf("android") > -1) ? true : false,
  IS_IE: jQuery.browser.msie,
  CURRENT_DEVICE: undefined,
  CURRENT_ROTATION: 0,
  RE: {
    email : /^[\w-]+(\.[\w-]+)*@([a-z0-9-]+(\.[a-z0-9-]+)*?\.[a-z]{2,6}|(\d{1,3}\.){3}\d{1,3})(:\d{4})?$/,
    integer : /^[0-9]+$/,
    empty : /^$/,
    empty_or_blank : /^\s*$/
  }
};

Utils.setInputPlaceholder = function() {
  jQuery('input[placeholder]').each(function(){
    var me = jQuery(this);
    me.addClass('placeholder');
    var ph = me.attr('placeholder');
  
    if (Utils.IS_IE){ me.attr('value',ph) }

    
    me.focus(function(){
      me.removeClass('wrong');
      me.removeClass('placeholder');
      if (Utils.IS_IE && (me.val() == ph)){ me.val('') }
    }).blur(function(){
      if (me.val() == '' || me.val() == ph) {
        if (Utils.IS_IE) { me.attr('value', ph) }
        me.addClass('placeholder');
        me.removeClass('wrong');
      }
    });
  
  });
};