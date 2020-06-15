/*
 * MIT License
 *
 * Copyright (c) 2013-2020 Centre de Lectura de Reus
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

if (!Bdcdl) {
    var Bdcdl = {};
}

(function ($) {

    Bdcdl.changeSearchForm = function () {
        var advancedForm = $('#advanced-form');
        advancedForm.click(function (event) {
            event.stopPropagation();
        });
        
        // Afegim un div necessari per tal que es mostri correctament Bootstrap
        $('#search-form > input:first-child').before('<div class="form-group header-form-group"></div>');
        // Recopilem tots els elements que aniran al div
        var inputElements = $('#search-form > input');
        // Afegim els elements al div
        inputElements.appendTo('.header-form-group');
        // Afegim una classe que necessita Bootstrap
        $('.header-form-group > input:text').addClass('form-control form-control-custom');
        // Modifiquem el button amb classe Bootstrap
        var button = $('#submit_search');
        button.addClass('btn btn-default btn-custom btn-custom-light');
        button.html('<span class="glyphicon glyphicon-search dark-glyphicon" aria-hidden="true"></span>');
        // Afegim un glyphicon per cerca avançada
        button.before('<a href="#" id="advanced-search"><span class="glyphicon glyphicon-option-vertical light-glyphicon" aria-hidden="true"></span></a>');
        
        // Gestionem la cerca avançada
        $("#advanced-search").click(function (event) {
            event.preventDefault();
            event.stopPropagation();
            advancedForm.fadeToggle();
            $(document).click(function (event) {
                if (event.target.id === 'query') {
                    return;
                }
                advancedForm.fadeOut();
                $(this).unbind(event);
            });
        });
    };
    
    Bdcdl.audioTool = function () {
		$('a.audio-link').each(function () {
			var audioUrl = $( this ).attr('href');
			var elem = $( this );
			$(document).ajaxStop(function () {
				$('.spinner-border').hide();
			});
			$.ajax({
				url: audioUrl,
				type: 'HEAD',
				success: function () {
					elem.css('display', 'block');
					elem.wrap('<audio src="'+ audioUrl +'" class="omeka-media" width="200" height="20" controls=""></audio>');
				},
				error: function () {
					$('#audio-message').show();
					elem.css('display', 'none');
				}
			});
		});
    };
    
    Bdcdl.startCarousel = function () {
        $('.carousel-inner > div:first-child').addClass('active');
        $('.carousel').carousel({
            interval: 5000
        });
    };
	
	Bdcdl.cookieAlert = function () {
    	$("button#cookie-ok, button#cookie-close").click( function (e) {
    		e.preventDefault();
    		document.cookie = "cookiebox=closed; path=/";
    	});
    	
    	var cookieAlert = getCookie("cookiebox");
    	if (cookieAlert === "closed") {
    		$("div#cookie-box").css({"display":"none"});
    	}
    	
    	function getCookie(cname) {
    		var name = cname + "=";
    		var decodedCookie = decodeURIComponent(document.cookie);
    		var ca = decodedCookie.split(';');
    		for(var i = 0; i <ca.length; i++) {
        		var c = ca[i];
        		while (c.charAt(0) == ' ') {
            		c = c.substring(1);
        		}
        		if (c.indexOf(name) == 0) {
            		return c.substring(name.length, c.length);
        		}
    		}
    		return "";
		} 
    };

	Bdcdl.lazyImg = function () {
		let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
		let active = false;

		const lazyLoad = function() {
			if (active === false) {
				active = true;

				setTimeout(function() {
					lazyImages.forEach(function(lazyImage) {
						if ((lazyImage.getBoundingClientRect().top <= window.innerHeight &&
							lazyImage.getBoundingClientRect().bottom >= 0) &&
							getComputedStyle(lazyImage).display !== "none")
						{
							lazyImage.src = lazyImage.dataset.src;
							lazyImage.srcset = lazyImage.dataset.srcset;
							lazyImage.classList.remove("lazy");

							lazyImages = lazyImages.filter(function(image) {
								return image !== lazyImage;
							});

							if (lazyImages.length === 0) {
								main.removeEventListener("scroll", lazyLoad);
								window.removeEventListener("resize", lazyLoad);
								window.removeEventListener("orientationchange", lazyLoad);
							}
						}
					});
					active = false;
				},
					200
				);
			}
		};

		document.addEventListener("scroll", lazyLoad);
		window.addEventListener("resize", lazyLoad);
		window.addEventListener("orientationchange", lazyLoad);
		setTimeout(lazyLoad, 5000);
	};

	Bdcdl.changeInputPlaceholder = function () {
		$(":radio[name=query_type]").click(function (e) {
			var inputID = $(this).attr('id');
			var placeHolder = 'exemple: Fortuny';
			switch (inputID) {
				case 'query_type-keyword':
					placeHolder = 'exemple: Fortuny';
					break;
				case 'query_type-boolean':
					placeHolder = 'exemple: -"sala" +"fortuny"'
					break;
				case 'query_type-exact_match':
					placeHolder = 'exemple: Pere Anguera';
					break;
			}
			$(":text[name=query]").attr('placeholder', placeHolder);
		});
	};
})(jQuery);


