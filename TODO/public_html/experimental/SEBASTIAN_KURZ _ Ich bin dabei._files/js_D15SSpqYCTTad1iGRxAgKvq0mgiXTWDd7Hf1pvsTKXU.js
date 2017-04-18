/**
 * @todo
 */

Drupal.omega = Drupal.omega || {};

(function($) {
  /**
   * @todo
   */
  var current;
  var previous;
  
  /**
   * @todo
   */
  var setCurrentLayout = function (index) {
    index = parseInt(index);
    previous = current;
    current = Drupal.settings.omega.layouts.order.hasOwnProperty(index) ? Drupal.settings.omega.layouts.order[index] : 'mobile';

    if (previous != current) {      
      $('body').removeClass('responsive-layout-' + previous).addClass('responsive-layout-' + current);      
      $.event.trigger('responsivelayout', {from: previous, to: current});
    }
  };
  
  /**
   * @todo
   */
  Drupal.omega.getCurrentLayout = function () {
    return current;
  };
  
  /**
   * @todo
   */
  Drupal.omega.getPreviousLayout = function () {
    return previous;
  };
  
  /**
   * @todo
   */
  Drupal.omega.crappyBrowser = function () {
    return $.browser.msie && parseInt($.browser.version, 10) < 9;
  };
  
  /**
   * @todo
   */
  Drupal.omega.checkLayout = function (layout) {
    if (Drupal.settings.omega.layouts.queries.hasOwnProperty(layout) && Drupal.settings.omega.layouts.queries[layout]) {
      var output = Drupal.omega.checkQuery(Drupal.settings.omega.layouts.queries[layout]);
      
      if (!output && layout == Drupal.settings.omega.layouts.primary) {
        var dummy = $('<div id="omega-check-query"></div>').prependTo('body');       

        dummy.append('<style media="all">#omega-check-query { position: relative; z-index: -1; }</style>');
        dummy.append('<!--[if (lt IE 9)&(!IEMobile)]><style media="all">#omega-check-query { z-index: 100; }</style><![endif]-->');
        
        output = parseInt(dummy.css('z-index')) == 100;

        dummy.remove();
      }
      
      return output;
    }

    return false;
  };
  
  /**
   * @todo
   */
  Drupal.omega.checkQuery = function (query) {
    var dummy = $('<div id="omega-check-query"></div>').prependTo('body');       
    
    dummy.append('<style media="all">#omega-check-query { position: relative; z-index: -1; }</style>');
    dummy.append('<style media="' + query + '">#omega-check-query { z-index: 100; }</style>');

    var output = parseInt(dummy.css('z-index')) == 100;
    
    dummy.remove();

    return output;
  };
  
  /**
   * @todo
   */
  Drupal.behaviors.omegaMediaQueries = {
    attach: function (context) {
      $('body', context).once('omega-mediaqueries', function () {
        var primary = $.inArray(Drupal.settings.omega.layouts.primary, Drupal.settings.omega.layouts.order);
        var dummy = $('<div id="omega-media-query-dummy"></div>').prependTo('body');

        dummy.append('<style media="all">#omega-media-query-dummy { position: relative; z-index: -1; }</style>');
        dummy.append('<!--[if (lt IE 9)&(!IEMobile)]><style media="all">#omega-media-query-dummy { z-index: ' + primary + '; }</style><![endif]-->');

        for (var i in Drupal.settings.omega.layouts.order) {
          dummy.append('<style media="' + Drupal.settings.omega.layouts.queries[Drupal.settings.omega.layouts.order[i]] + '">#omega-media-query-dummy { z-index: ' + i + '; }</style>');
        }

        $(window).bind('resize.omegamediaqueries', function () {
          setCurrentLayout(dummy.css('z-index'));
        }).load(function () {
          $(this).trigger('resize.omegamediaqueries');
        });
      });
    }
  };
})(jQuery);;
jQuery(function() {
  var hideCounter, useHideCounter = true;
  
  function checkLabelStatus(event) {
    var value = jQuery(this).val();
    var id    = jQuery(this).attr('id');
    
    if(empty(value)) doLabelShow(id);
    if(!empty(value)) doLabelHide(id);

    if(useHideCounter) hideCounter = setInterval(function() {
      hideCounter++;
      if(hideCounter > 15) { useHideCounter = false; clearInterval(hideCounter); }
    }, 0);
  }
  
  function doLabelHide(id) {
    jQuery('label[for="'+id+'"]').hide();
  }
  function doLabelShow(id) {
    jQuery('label[for="'+id+'"]').fadeIn();
  }
  
  function empty(a){var b,c,d,e,f=[b,null,!1,0,"","0"];for(d=0,e=f.length;e>d;d++)if(a===f[d])return!0;if("object"==typeof a){for(c in a)return!1;return!0}return!1}
  
  try {
    jQuery('[type="email"], [type="search"], [type="tel"], [type="url"], [type="password"], [type="text"], textarea').on('change', checkLabelStatus).on('blur', checkLabelStatus).on('keyup', checkLabelStatus).trigger('blur');
  } catch(e) {}
});
jQuery(function() {
  
  function setupSignupCounterBar(index, counter) {
    var desired = jQuery(counter).data('desired'),
        current = jQuery(counter).data('current'),
        percent = Math.max(1, Math.ceil(current * 100 / desired));
    
    console.log(current, desired, percent + '%');
    jQuery('.counter-bar-inner', counter).delay(1000).stop().animate({width: percent+'%'}, function() {
      jQuery('.counter-bar-inner', counter).show().css({width: '0%'}).animate({width: percent+'%'}, 'slow');
    });
  }
  
//  jQuery('.counter-bar').each(setupSignupCounterBar);
});;
/** ----------------------------------------------------------------------
 *
 *    CB_Module_VideoLinks.js
 *
 * @Package Campaigning Bureau
 * @Version 0.9
 *
 *    jQuery Plugin that hooks on to selected elements and dynamically
 *    loads the vendor embed code to display the video.
 *
 *    Currently only supports YouTube.
 *
 *    Options:
 *        Options can be set by passing them to the plugin as an object.
 *        They can also be overridden by the custom data attribute
 *        data-cb-module-videolinks-opts
 *
 *        {open:}
 *        'inplace' (default) to embed the video exactly at the position
 *        of the first {posReference:} element inside the link
 *
 *        'popup' to open the video in a viewport centered popup hitting
 *        escape or clicking outside the video closes it a fullscreen element
 *        #fullScreenShade is added behind the video and can be styled to be
 *        used as e.g. a dimmer
 *
 *        {posReference:} 'img' (default) selector to identify the object
 *                        that will be used to position the video over
 *
 *        {popUpDim}    {width:660,height:400} (default) dimensions of the
 *                    video if opened as a popup as an object
 *
 *        {localOverride}    true (default) allows overriding of options via
 *                        a custom data attribute. false forces the plugin
 *                        to ignore local overrides
 *
 *        {onBeforeReplace} function (optional) will be called before the
 *           script replaces the image with the youtube embed.
 *           It will not be called when using 'popup'.
 *
 *    Usage Examples:
 *        jQuery("a[rel=video]").CB_VideoLinks({open:'popup'});
 *        Will open all a[rel=video] in a popup with default dimensions,
 *        except if the options are overridden by a JSON-formatted inline
 *        data attribute on any of the given links:
 *        <a … data-cb-module-videolinks-opts='{"open":"inplace"}'>
 *
 *    Version History
 *        0.9        first clean refactored version
 *
 * -------------------------------------------------------------------- */

;
(function ($, doc, win) {
    "use strict";
    var name = "cb-module-videolinks";

    /* ----------------------------------------------------------------------
     *
     *	initialization
     *
     * -------------------------------------------------------------------- */
    function CB_VideoLinks(el, opts) {
        this.$el = $(el);

        // default options
        this.defaults = {
            open: 'inplace', posReference: 'img', popUpDim: {width: 660, height: 400}, localOverride: true, onBeforeReplace: undefined
        };

        // metadata stored in the element
        var meta = this.$el.data(name + '-opts');

        // merge options: meta overrides provided overrides default
        this.opts = $.extend(this.defaults, opts);
        if (this.opts.localOverride === true) {
            this.opts = $.extend(this.opts, meta);
        }

        this.$el.data(name, this);

        // launch
        this.init();
    }

    /* ----------------------------------------------------------------------
     *
     *	functions added via prototype
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.init = function () {
        // proxy to preserve context of "this"
        this.$el.on('click', jQuery.proxy( this.clickHandler, this ));
    };

    /* ----------------------------------------------------------------------
     *
     *	click event Handler
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.clickHandler = function (event) {
        var videoId;

        if (this.$el.attr('data-video-links') == 'replaced') return;

        event.preventDefault();
        event.stopPropagation();

        var href = this.$el.find(this.opts.posReference).first().closest('a').attr('href');

        if (href.indexOf('youtu.be') != -1) {
            videoId = href.split('.be/');
            videoId = videoId[1];
        } else {
            var morePars;
            videoId = href.substring(href.indexOf('v=') + 2);
            morePars = videoId.indexOf('&');
            if (morePars != -1) {
                videoId = videoId.substring(0, morePars);
            }
        }

        switch (this.opts.open) {
            case 'inplace':
                this.replaceWithVideo(videoId);
                break;
            case 'popup':
                this.openPopup(videoId);
                break;
        }
    };

    /* ----------------------------------------------------------------------
     *
     *	replace inline
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.replaceWithVideo = function (videoId) {

        if (typeof this.opts.onBeforeReplace === 'function') {
            this.opts.onBeforeReplace(this.$el);
        }
        var refObject = this.$el.find(this.opts.posReference).first();
        var theVideo = $('<div><iframe width="100%" height="100%" src="//www.youtube-nocookie.com/embed/' + videoId + '?rel=0&showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>');
        theVideo.css({
            'position': 'absolute',
            'left': refObject.position().left,
            'top': refObject.position().top,
            'width': refObject.width(),
            'height': refObject.height()
        });
        jQuery(refObject).parent().append(theVideo);
        this.$el.attr('data-video-links', 'replaced');
    };

    /* ----------------------------------------------------------------------
     *
     *	open in popup
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.openPopup = function (videoId) {
        var video = jQuery('<div><iframe width="100%" height="100%" src="//www.youtube-nocookie.com/embed/' + videoId + '?rel=0&showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe></div>');
        this.popUp = $('<div id="fullScreenShade" />');
        this.popUp.on('click', {belongsTo: this}, this.outsideVideoClickController);

        video.appendTo(this.popUp);
        this.popUp.appendTo($('body'));

        this.reCenter();
        jQuery(doc).on('keydown', {belongsTo: this}, this.outsideVideoClickController);
        jQuery(win).on('resize', {belongsTo: this}, this.windowResizeController);
    };

    /* ----------------------------------------------------------------------
     *
     *	resize and re-center
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.reCenter = function () {
        if (this.popUp) {
            this.popUp.css({'position': 'fixed', 'top': 0, 'left': 0, 'width': jQuery(win).width(), 'height': jQuery(win).height()});
            var video = this.popUp.find('div').first();
            video.css({
                'position': 'fixed', 'left': Math.max(0, ((jQuery(win).width() - this.opts.popUpDim.width) / 2)), 'top': Math.max(0, ((jQuery(win).height() - this.opts.popUpDim.height) / 2)), 'width': this.opts.popUpDim.width, 'height': this.opts.popUpDim.height, 'z-index': 10
            });
        }
    };

    /* ----------------------------------------------------------------------
     *
     *	close popup
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.closePopUp = function () {
        if (this.popUp) {
            this.popUp.remove();
            delete this.popUp;
        }
    };

    /* ----------------------------------------------------------------------
     *
     *	Controller for click events
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.outsideVideoClickController = function (e) {
        var parent = e.data.belongsTo;
        if (!e.keyCode || e.keyCode == 27) { // esc
            parent.closePopUp();
        }
    };

    /* ----------------------------------------------------------------------
     *
     *	Controller for click events
     *
     * -------------------------------------------------------------------- */
    CB_VideoLinks.prototype.windowResizeController = function (e) {
        var parent = e.data.belongsTo;
        parent.reCenter();
    };

    /* ----------------------------------------------------------------------
     *
     *	register as jQuery plugin
     *
     * -------------------------------------------------------------------- */
    $.fn.CB_VideoLinks = function (opts) {
        return this.each(function () {
            new CB_VideoLinks(this, opts);
        });
    };
})(jQuery, document, window);

jQuery(function() { jQuery('a[rel="youtube"]').CB_VideoLinks({}); });;
jQuery.fn.outerHTML = function (a) {
    return a ? this.before(a).remove() : jQuery("<p>").append(this.eq(0).clone()).html()
};

/**
 * strings for the Pages + their Translation node,
 */
var nodePersonSelector = '#node-page-2, #node-page-638',
    pageTranslatedPersonSelector = 'page-node-638';


jQuery(function () {



    function urlencode(a) {
        return a = "" + (a + ""), encodeURIComponent(a).replace(/!/g, "%21").replace(/'/g, "%27").replace(/\(/g, "%28").replace(/\)/g, "%29").replace(/\*/g, "%2A").replace(/%20/g, "+")
    }

    //jQuery('.front #region-sidebar-second').css({top: '-'+(jQuery('.front #zone-preface-wrapper').outerHeight(true) - 50)+'px'});
    jQuery('.page-fotos #section-content #region-content li:even').addClass('even');
    jQuery('.page-fotos #section-content #region-content li:odd').addClass('odd');

    jQuery('.page-kampagne #section-content .cb-commitment > .block:first').addClass('first');
    jQuery('.page-kampagne #section-content .cb-commitment > .block:last').addClass('last');
    jQuery('.page-kampagne #section-content .cb-commitment > .block:even').addClass('even');
    jQuery('.page-kampagne #section-content .cb-commitment > .block:odd').addClass('odd');

    jQuery('.facebook_page #block-menu-menu-footer a').attr('target', '_blank');

    if (document.getElementById('ich-kann-preface-sujet') !== null) {
        jQuery(window).on('resize', function () {
            var body = document.getElementsByTagName('body')[0].offsetWidth;
            var element = jQuery('.container-24').width();
            var padding = (body - element) * .5 + 10;

            document.getElementById('ich-kann-preface-sujet').style.left = '-' + padding + 'px';
            document.getElementById('ich-kann-preface-sujet').style.right = '-' + padding + 'px';

            console.log(element, body, padding);
        });
        jQuery(window).resize();
    }

    /*
     * Style slide share */
    jQuery('#block-block-10').each(function (index, block) {
        var countImg = jQuery('.share-slider .inner img', block).length;
        var animate;
        jQuery('.share-slider .inner', block).width((270 * countImg) + 'px');

        jQuery('.prev').on('click', function (event) {
            moveSlider(event, this, 1);
        });
        jQuery('.next').on('click', function (event) {
            moveSlider(event, this, -1);
        });
        checkButtonDisable();

        function moveSlider(event, _this, direction) {
            event.preventDefault();
            if (animate || jQuery(_this).hasClass('disabled')) return;

            animate = true;
            jQuery('.share-slider .inner', block).animate({marginLeft: '+=' + (270 * direction) + 'px'}, function () {
                animate = false;
                checkButtonDisable();
            });
        }

        function checkButtonDisable() {
            var pos = Math.abs(parseInt(jQuery('.share-slider .inner', block).css('marginLeft')));
            if (pos < 270) {
                jQuery('.prev').addClass('disabled');
            } else {
                jQuery('.prev').removeClass('disabled');
            }
            if (pos >= (countImg - 1) * 270) {
                jQuery('.next').addClass('disabled');
            } else {
                jQuery('.next').removeClass('disabled');
            }
        }
    });

    /**
     *    Callback function to determine current share pic
     */
    function getCurrentSharePic() {
        var cont = jQuery('#block-block-10 .inner');
        return jQuery('img', cont)[Math.abs(parseInt(cont.css('marginLeft'))) / 270];
    }

    /**
     *    Callback function to indicate sharing success
     */
    function shareSuccess() {
        jQuery('#block-block-10 .share-ok').fadeIn().delay(3000).fadeOut();
    }

    // set up the facebook wallpost feature
    new CB_SocialPost({
        service: 'facebook',
        containerSelector: '#block-block-10 .block-inner .content',
        controlSelector: '.share-actions a.facebook',
        requireUserInput: true,
        currentItemCallback: getCurrentSharePic,
        successCallback: shareSuccess
    });

    // set up the twitter share feature
    new CB_SocialPost({
        service: 'twitter',
        containerSelector: '#block-block-10 .block-inner .content',
        controlSelector: '.share-actions a.twitter',
        requireUserInput: false,
        currentItemCallback: getCurrentSharePic,
        successCallback: shareSuccess
    });

    jQuery('form').on('submit', function (event) {
        var form = this;
        jQuery('input.required', form).each(function (index, item) {
            var value = jQuery(item).val();
            if (value == '') {
                jQuery(item).addClass('error');
                event.preventDefault();
            } else {
                jQuery(item).removeClass('error');
            }
        });
    });


    jQuery(nodePersonSelector).each(function (index, node) {
        function clickedSliderNavigation(event) {
            event.preventDefault();

            var img = jQuery('.timeline a.active img').attr('src');
            jQuery('.timeline a.active img').attr('src', img.replace('timeline-point-pin.png', 'timeline-point.png'));
            jQuery('.timeline a').removeClass('active');

            var id = jQuery(this).attr('href');
            var story = jQuery(id, node).index();

            jQuery('.story .inner', node).animate({marginLeft: '-' + (storiesWidth * story) + 'px'});
            jQuery(this).addClass('active');

            var img = jQuery('img', this).attr('src');
            jQuery('img', this).attr('src', img.replace('timeline-point.png', 'timeline-point-pin.png'));
            window.setTimeout(function () {
                jQuery('a[rel="youtube"] div', node).remove();
            }, 1);
        }

        jQuery('.timeline', node).on('click', 'a', clickedSliderNavigation);

        var stories = jQuery('article', node).length;
        var storiesWidth = 850; //parseInt(jQuery('article', node).outerWidth(true));
        jQuery('.story .inner', node).width((storiesWidth * stories) + 'px');

        jQuery('.story .inner', node).css({marginLeft: '-' + (storiesWidth * (stories - 1)) + 'px'});
    });

    jQuery('#messages').on('click', '.messages', function (event) {
        jQuery(this).remove();
    });
    jQuery('#messages').on('click', 'ul', function (event) {
        event.stopPropagation();
    })

    jQuery('a.share').on('click', function (event) {
        event.preventDefault();

        var width = 500;
        var height = 300;
        var left = (screen.width / 2) - (width / 2);
        var top = (screen.height / 2) - (height / 2);
        share = window.open(jQuery(this).attr('href'), 'Popupfenster', "width=" + width + ",height=" + height + ",resizable=yes,menubar=no,status=no,toolbar=no,dependent=yes,location=no,left=" + left + ",top=" + top);
        share.focus();
        return false;
    });

    jQuery('.block-help').on('click', 'dt', function (event) {
        jQuery(this).next('dd').slideToggle();
    });


    var teamKurzContainer = jQuery('.view-team-kurz'),
        teamKurzCache = {},
        teamKurzLoading = undefined;
    jQuery.get('team-kurz.json', function (data) {
        teamKurzCache = data;
    }, 'json');
    jQuery('.node.node-teaser', teamKurzContainer).each(function (index, item) {
        var link = jQuery('a', item).attr('href');
        jQuery('img', item).unwrap();
        jQuery(item).wrap('<a href="' + link + '"></a>');
    });
    jQuery(teamKurzContainer).on('click', 'td > a', function (event) {
        event.preventDefault();
        var _this = this,
            link = jQuery(_this).attr('href');

        if (typeof teamKurzLoading !== 'undefined') return;

        if (typeof teamKurzCache[link] === 'undefined') {
            jQuery('#team-kurz-full-node').css({opacity: .6}).show();
            teamKurzLoading = jQuery.get(link, function (data) {
                teamKurzCache[link] = jQuery('.node', data).outerHTML();
                jQuery('#team-kurz-full-node', teamKurzContainer).html(teamKurzCache[link]);
                teamKurzLoading = undefined;
                jQuery('#team-kurz-full-node').css({opacity: 1});

                /*var coords = {'doc': jQuery(window).scrollTop(), 'el': jQuery('#team-kurz-full-node').offset().top };
                 if ( coords.doc > coords.el ) jQuery('html, body').animate({scrollTop: 0}, 200);*/

            }, 'html');
        } else {
            var cache = jQuery(teamKurzCache[link]);
            jQuery('header, .contextual-links-wrapper', cache).remove();
            jQuery('#team-kurz-full-node', teamKurzContainer).show().html(jQuery(cache).outerHTML());
        }
        jQuery('html, body').animate({scrollTop: 0}, 'slow');
    });
    //jQuery('td:first > a', teamKurzContainer).click();
    jQuery('.view-team-kurz .view-content').wrap('<div class="view-content-wrapper"></div>');
});

/**
 *
 *     FACEBOOK POST TO WALL
 *
 *    options = {
 *		service: the service to use ('twitter' or 'facebook')
 *		containerSelector: element selector for the container
 *		controlSelector: selector for the element invoking the script on click
 *		currentItemCallback: function that returns the element to share
 *		successCallback: will be executed after the post has been successfully done
 *		requireUserInput: true if the user must provide an individual text part
 *	}
 */
CB_SocialPost = function (options) {
    this.$control = undefined;
    this.$container = undefined;
    this.$form = undefined;
    this.$label = undefined;
    this.$textarea = undefined;
    this.$button = undefined;
    this.service = undefined;
    this.currentImage = undefined;
    this.currentItemCallback = undefined;
    this.successCallback = undefined;
    this.labelText = 'Schreib\' etwas …';
    this.requireUserInput = false;

    this.init = function () {
        this.$container = jQuery(options.containerSelector);
        this.$control = jQuery(options.controlSelector, this.$container);
        this.currentItemCallback = options.currentItemCallback;
        this.successCallback = options.successCallback;
        this.$control.on('click', jQuery.proxy(this.controlClickHandler, this));
        this.requireUserInput = options.requireUserInput;
        this.service = options.service;
    }

    // on click do this
    this.controlClickHandler = function (event) {
        this.currentImage = this.currentItemCallback();

        if (this.requireUserInput) {
            this.showDialog();
        }
        else {
            switch (this.service) {
                case 'facebook':
                    this.startFacebookAuth();
                    break;

                case 'twitter':
                    this.showTwitterPopUp();
                    break;
            }
        }
    }

    // we need an input for the user to add his message
    this.assembleUserInput = function () {
        if (!(this.$form && this.$form.length)) {
            this.$form = jQuery('<form id="cbFacebookShareDialog">');
            this.$form.on('submit', jQuery.proxy(this.userInputClickHandler, this));
            this.$label = jQuery('<label for="cbFbUserMessage">' + this.labelText + '</label>');
            this.$textarea = jQuery('<textarea name="cbFbUserMessage" id="cbFbUserMessage"></textarea>');
            this.$button = jQuery('<button type="submit" class="blue" value="Posten!">Posten!</button>')
            this.$button.addClass('disabled');
            this.$textarea.on('focus blur', jQuery.proxy(this.userInputFocusHandler, this));
            this.$textarea.on('input propertychange', jQuery.proxy(this.userInputChangeHandler, this));

            this.$label.appendTo(this.$form);
            this.$textarea.appendTo(this.$form);
            this.$button.appendTo(this.$form);
            this.$form.css({ position: 'absolute', left: 0, top: 0, right: 0, bottom: 0 });
        }
    }


    // show a user dialog for the message
    this.showDialog = function () {
        this.assembleUserInput();
        this.toggleInput(this.requireUserInput);
        this.$form.appendTo(this.$container);
    }

    // show or hide the dialog inputs
    this.toggleInput = function (visible) {
        this.$label.toggle(visible);
        this.$textarea.toggle(visible);
        this.$button.toggle(visible);
    }

    // the input got fucus, we might wanna hide the label
    this.userInputFocusHandler = function (event) {
        // show on blur if textarea is empty, else: hide
        this.$label.toggle((event.type == 'blur' && this.$textarea.val() == '' ));

        if (event.type == 'focus') {
            this.$textarea.select();
        }
    }

    // the input got fucus, we might wanna hide the label
    this.userInputChangeHandler = function (event) {
        this.$button.toggleClass('disabled', ( this.$textarea.val() == '' ));
    }

    // the user submitted his message
    this.userInputClickHandler = function (event) {
        event.preventDefault();
        this.startFacebookAuth();
    }

    // now we need to log the user in
    this.showTwitterPopUp = function () {
        var width = 500;
        var height = 300;
        var left = (screen.width / 2) - (width / 2);
        var top = (screen.height / 2) - (height / 2);
        var status = jQuery(this.currentImage).data('share-text') + ': ' + jQuery(this.currentImage).data('share-path');
        share = window.open(
            '//twitter.com/home?status=' + encodeURIComponent(status),
            'Popupfenster', "width=" + width + ",height=" + height + ",resizable=yes,menubar=no,status=no,toolbar=no,dependent=yes,location=no,left=" + left + ",top=" + top);
        share.focus();
    }

    // now we need to log the user in
    this.startFacebookAuth = function () {
        // only if the user provided text
        if (!this.requireUserInput || this.$textarea.val()) {
            if (this.$form) this.$form.addClass('cbProcessing');
            FB.login(jQuery.proxy(this.authResponseListener, this), {scope: 'publish_stream'});
        }
    }

    // if we get authentication, let's post stuff
    this.authResponseListener = function (response) {
        if (!response.authResponse) {
            return;
        }
        var wallpost = {
            url: jQuery(this.currentImage).data('share-image'),
            message: //				jQuery(this.currentImage).data('share-text') + "\n\r\n\r" +
                jQuery(this.currentImage).data('share-path')
        }
        if (this.requireUserInput) {
            wallpost.message = this.$textarea.val() + "\n\r\n\r" + wallpost.message;
            this.toggleInput(false);
        }
        /**/
        /*
         console.log('posting now');
         this.postSuccessListener();
         /**/
        FB.api('/me/photos', 'post', wallpost, jQuery.proxy(this.postSuccessListener, this));
        /**/
    }

    // once the post-call has been completed, let's clean up
    this.postSuccessListener = function (response) {
        if (this.$form) this.$form.detach();

        if (response != 'error') {
            this.successCallback();
        }
    }

    // "constructor"
    this.init();
}

/* RESPONSIVE PERSON */
jQuery(function ($) {
    var person = new function () {
        this.isPerson = false;
        this.isResponsive = false;

        this.init = function () {
            this.shallIRespond();

            // resize check
            $(window).resize(jQuery.proxy(this.shallIRespond, this));
        }

        this.shallIRespond = function () {
            var responsiveNow = $('body').hasClass('cbResponsive');
            this.isPerson = $('body').hasClass('page-node-2') || $('body').hasClass(pageTranslatedPersonSelector);

            if (this.isPerson && ( this.isResponsive != responsiveNow )) {
                this.switchPersonOrder();
            }

            this.isResponsive = responsiveNow;
        }

        this.switchPersonOrder = function () {
            var $personContents = $('.story .inner');
            $personContents.children().each(function (index, item) {
                $personContents.prepend(item)
            });
        }

        this.init();
    };
});

/* RESPONSIVE */
// function($) = use the $ shortcut safely
jQuery(function ($) {
    // fetch the main menu
    var menu = new function () {
        this.$mainMenu = undefined;
        this.$menuButton = undefined;

        this.init = function () {
            this.$mainMenu = $('#region-menu');
            this.shallIRespond();
            // resize check
            $(window).resize(jQuery.proxy(this.shallIRespond, this));
        };

        this.shallIRespond = function (event) {
            if (!this.$menuButton) {
                this.initializeMenuButton();
            }
            // startup check
            if (this.$mainMenu.is(':hidden')) {
                this.$menuButton.insertBefore(this.$mainMenu);
                $('body').addClass('cbResponsive');
            } else {
                this.$menuButton.detach();
                $('body').removeClass('cbResponsive');
            }
        };

        this.initializeMenuButton = function () {
            this.$menuButton = $('<i id="cbResponsiveMenu">');
            this.$menuButton.on('click', jQuery.proxy(this.toggleMenu, this));
        };

        this.toggleMenu = function () {
            this.$mainMenu.toggle({ duration: 300 });
        };

        // "constructor"
        this.init();
    }
});;
