jQuery(document).ready(function($) {
	var listing_class 		= ".products";
	var item_class 			= ".products > .product";
	var pagination_class 	= "body.woocommerce-shop .woocommerce-pagination";
	var next_page_class 	= ".woocommerce-pagination a.next";
	var ajax_button_class 	= ".products_ajax_button";
	var ajax_loader_class 	= ".products_ajax_loader";
	var loadmore_text = nova_js_var.load_more_btn;

	var ajax_load_items = {

			init: function() {

					if (nova_js_var.shop_pagination_type == 'load_more_button' || nova_js_var.shop_pagination_type == 'infinite_scroll') {

						$(document).ready(function() {

								if ($(pagination_class).length) {

										$(pagination_class).before('<div class="'+ajax_button_class.replace('.', '')+'" data-processing="0"><span>'+loadmore_text+'</span></div>');

								}

						});

					}

					if (nova_js_var.shop_pagination_type == 'infinite_scroll') {

						var buffer_pixels = Math.abs(100);

						$(window).scroll(function() {

								if ($(listing_class).length) {

										var a = $(listing_class).offset().top + $(listing_class).outerHeight();
										var b = a - $(window).scrollTop();

										if ((b - buffer_pixels) < $(window).height()) {
												if ($(ajax_button_class).attr('data-processing') == 0) {
														$(ajax_button_class).trigger('click');
												}
										}

								}

						});

					}

			},

			onstart: function() {
			},

			onfinish: function() {

			},

			msieversion: function() {
					var ua = window.navigator.userAgent;
					var msie = ua.indexOf("MSIE ");

					if (msie > 0)
							return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));

					return false;
			},

	};
	// return false if novaapf_params variable is not found
	if (typeof novaapf_params === 'undefined') {
		return false;
	}

	// store widget ids those will be replaced with new data
	var widgets = {};

	$('.novaapf-ajax-term-filter').each(function(index) {
		var widget_id = $(this).attr('id');
		widgets[index] = widget_id;
	});

	// scripts to run before updating shop loop
	novaapfBeforeUpdate = function() {
		var overlay_color;

		if (novaapf_params.overlay_bg_color.length) {
			overlay_color = novaapf_params.overlay_bg_color;
		} else {
			overlay_color = '#fff';
		}

		var markup = '<div class="novaapf-before-update" style="background-color: ' + overlay_color + '"></div>',
			holder,
			top_scroll_offset = 0;

		if ($(novaapf_params.shop_loop_container.length)) {
			holder = novaapf_params.shop_loop_container;
		} else if ($(novaapf_params.not_found_container).length) {
			holder = novaapf_params.not_found_container;
		}

		if (holder.length) {
			// show loading image
			$(markup).prependTo(holder);

			// scroll to top
			if (typeof novaapf_params.scroll_to_top !== 'undefined' && novaapf_params.scroll_to_top == true) {
				var scroll_to_top_offset,
					top_scroll_offset;

				if (typeof novaapf_params.scroll_to_top_offset !== 'undefined' && novaapf_params.scroll_to_top_offset.length) {
					scroll_to_top_offset = parseInt(novaapf_params.scroll_to_top_offset);
				} else {
					scroll_to_top_offset = 100;
				}

				top_scroll_offset = $(holder).offset().top - scroll_to_top_offset;

				if (top_scroll_offset < 0) {
					top_scroll_offset = 0;
				}

				$('html, body').animate({scrollTop: top_scroll_offset}, 'slow');
			}
		}

	}

	// scripts to run after updating shop loop
	novaapfAfterUpdate = function() {
		// Compatibility with YITH Wishlist Pro
		setTimeout( function(){
			$(document).trigger( 'yith_infs_added_elem' );
		}, 1000 );
		ajax_load_items.init();
		if ( typeof $.fn.select2 === 'function' ) {

			$('.woocommerce-ordering .orderby').select2({
				minimumResultsForSearch: -1,
				placeholder: nova_js_var.select_placeholder,
				dropdownParent: $('.woocommerce-archive-header-inside'),
				allowClear: false,
				dropdownAutoWidth: true,
			})
		}
	}

	// load filtered products
	novaapfFilterProducts = function() {
		// run before update function: show a loading image and scroll to top
		novaapfBeforeUpdate();

		$.get(window.location.href, function(data) {
			var $data = jQuery(data),
				shop_loop = $data.find(novaapf_params.shop_loop_container),
				not_found = $data.find(novaapf_params.not_found_container);

			// replace widgets data with new data
			$.each(widgets, function(index, id) {
				var single_widget = $data.find('#' + id),
					single_widget_class = $(single_widget).attr('class');

				// update class
				$('#' + id).attr('class', single_widget_class);
				// update widget
				$('#' + id).html(single_widget.html());
			});

			// replace old shop loop with new one
			if (novaapf_params.shop_loop_container == novaapf_params.not_found_container) {
				$(novaapf_params.shop_loop_container).html(shop_loop.html());
			} else {
				if ($(novaapf_params.not_found_container).length) {
					if (shop_loop.length) {
						$(novaapf_params.not_found_container).html(shop_loop.html());
					} else if (not_found.length) {
						$(novaapf_params.not_found_container).html(not_found.html());
					}
				} else if ($(novaapf_params.shop_loop_container).length) {
					if (shop_loop.length) {
						$(novaapf_params.shop_loop_container).html(shop_loop.html());
					} else if (not_found.length) {
						$(novaapf_params.shop_loop_container).html(not_found.html());
					}
				}
			}

			// reinitialize ordering
			novaapfInitOrder();

			// reinitialize dropdown filter
			novaapfDropDownFilter();

			// after update
			novaapfAfterUpdate();

			// run scripts after shop loop undated
			if (typeof novaapf_params.custom_scripts !== 'undefined' && novaapf_params.custom_scripts.length > 0) {
				eval(novaapf_params.custom_scripts);
			}
		});
	}

	// URL Parser
	novaapfGetUrlVars = function(url) {
	    var vars = {}, hash;

	    if (typeof url == 'undefined') {
	    	url = window.location.href;
	    } else {
	    	url = url;
	    }

	    var hashes = url.slice(url.indexOf('?') + 1).split('&');
	    for (var i = 0; i < hashes.length; i++) {
	        hash = hashes[i].split('=');
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}

	// if current page is greater than 1 then we should set it to 1
	// everytime we add new query to url to prevent page not found error.
	novaapfFixPagination = function() {
		var url = window.location.href,
			params = novaapfGetUrlVars(url);

		if (current_page = parseInt(url.replace(/.+\/page\/([0-9]+)+/, "$1"))) {
			if (current_page > 1) {
				url = url.replace(/page\/([0-9]+)/, 'page/1');
			}
		}
		else if(typeof params['paged'] != 'undefined') {
			current_page = parseInt(params['paged']);
			if (current_page > 1) {
				url = url.replace('paged=' + current_page, 'paged=1');
			}
		}

		return url;
	}

	// update query string for categories, meta etc..
	novaapfUpdateQueryStringParameter = function(key, value, push_history, url) {
		if (typeof push_history === 'undefined') {
			push_history = true;
		}

		if (typeof url === 'undefined') {
			url = novaapfFixPagination();
		}

		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i"),
			separator = url.indexOf('?') !== -1 ? "&" : "?",
			url_with_query;

		if (url.match(re)) {
			url_with_query = url.replace(re, '$1' + key + "=" + value + '$2');
		}
		else {
			url_with_query = url + separator + key + "=" + value;
		}

		if (push_history === true) {
			return history.pushState({}, '', url_with_query);
		} else {
			return url_with_query;
		}
	}

	// remove parameter from url
	novaapfRemoveQueryStringParameter = function(filter_key, url) {
		if (typeof url === 'undefined') {
			url = novaapfFixPagination();
		}

		var params = novaapfGetUrlVars(url),
			count_params = Object.keys(params).length,
			start_position = url.indexOf('?'),
			param_position = url.indexOf(filter_key),
			clean_url,
			clean_query;

		if (count_params > 1) {
			if ((param_position - start_position) > 1) {
				clean_url = url.replace('&' + filter_key + '=' + params[filter_key], '');
			} else {
				clean_url = url.replace(filter_key + '=' + params[filter_key] + '&', '');
			}

			var params = clean_url.split('?');
			clean_query = '?' + params[1];
		} else {
			clean_query = url.replace('?' + filter_key + '=' + params[filter_key], '');
		}

		return clean_query;
	}

	// add filter if not exists else remove filter
	novaapfSingleFilter = function(filter_key, filter_val) {
		var params = novaapfGetUrlVars(),
			query;

		if (typeof params[filter_key] !== 'undefined' && params[filter_key] == filter_val) {
			query = novaapfRemoveQueryStringParameter(filter_key);
		} else {
			query = novaapfUpdateQueryStringParameter(filter_key, filter_val, false);
		}
		// update url
		history.pushState({}, '', query);

		// filter products
		novaapfFilterProducts();
	}

	// take the key and value and make query
	novaapfMakeParameters = function(filter_key, filter_val, url) {
		var params,
			next_vals,
			empty_val = false;

		if (typeof url !== 'undefined') {
			params = novaapfGetUrlVars(url);
		} else {
			params = novaapfGetUrlVars();
		}

		if (typeof params[filter_key] != 'undefined') {
			var prev_vals = params[filter_key],
				prev_vals_array = prev_vals.split(',');

			if (prev_vals.length > 0) {
				var found = jQuery.inArray(filter_val, prev_vals_array);

				if (found >= 0) {
				    // Element was found, remove it.
				    prev_vals_array.splice(found, 1);

				    if (prev_vals_array.length == 0) {
				    	empty_val = true;
				    }
				} else {
				    // Element was not found, add it.
				    prev_vals_array.push(filter_val);
				}

				if (prev_vals_array.length > 1) {
					next_vals = prev_vals_array.join(',');
				} else {
					next_vals = prev_vals_array;
				}
			} else {
				next_vals = filter_val;
			}
		} else {
			next_vals = filter_val;
		}

		// update url and query string
		if (empty_val == false) {
			novaapfUpdateQueryStringParameter(filter_key, next_vals);
		} else {
			var query = novaapfRemoveQueryStringParameter(filter_key);
			history.pushState({}, '', query);
		}

		// filter products
		novaapfFilterProducts();
	}

	// handle the filter request
	$('.novaapf-ajax-term-filter').not('.novaapf-price-filter-widget').on('click', 'li a', function(event) {
		event.preventDefault();
		var element = $(this),
			filter_key = element.attr('data-key'),
			filter_val = element.attr('data-value'),
			enable_multiple_filter = element.attr('data-multiple-filter');
		if (enable_multiple_filter == true) {
			novaapfMakeParameters(filter_key, filter_val);
		} else {
			novaapfSingleFilter(filter_key, filter_val);
		}

	});

	// handle the filter request for price filter display type list
	$('.novaapf-price-filter-widget.novaapf-ajax-term-filter').on('click', 'li a', function(event) {
		event.preventDefault();
		var element = $(this),
			filter_key_min = element.attr('data-key-min'),
			filter_val_min = element.attr('data-value-min'),
			filter_key_max = element.attr('data-key-max'),
			filter_val_max = element.attr('data-value-max'),
			query;

		if (element.parent().hasClass('chosen')) {
			query = novaapfRemoveQueryStringParameter(filter_key_min);
			query = novaapfRemoveQueryStringParameter(filter_key_max, query);

			if (query == '') {
				query = window.location.href.split('?')[0];
			}

			history.pushState({}, '', query);
		} else {
			query = novaapfUpdateQueryStringParameter(filter_key_min, filter_val_min, false);
			query = novaapfUpdateQueryStringParameter(filter_key_max, filter_val_max, true, query);
		}

		// filter products
		novaapfFilterProducts();
	});

	// handle the pagination request
	if (novaapf_params.pagination_container.length > 0) {
		var holder = novaapf_params.pagination_container + ' a';

		$(document).on('click', holder, function(event) {
			event.preventDefault();
			var location = $(this).attr('href');
			history.pushState({}, '', location);

			// filter products
			novaapfFilterProducts();
		});
	}

	// history back and forward request handling
	$(window).bind('popstate', function(event) {
		// filter products
		novaapfFilterProducts();
    });

    // ordering
    novaapfInitOrder = function() {
    	if (typeof novaapf_params.sorting_control !== 'undefined' && novaapf_params.sorting_control.length && novaapf_params.sorting_control == true) {
	    	$('.novaapf-before-products').find('.woocommerce-ordering').each(function(index) {
	    		$(this).on('submit', function(event) {
	    			event.preventDefault();
	    		});

	    		$(this).on('change', 'select.orderby', function(event) {
	    			event.preventDefault();

	    			var order = $(this).val(),
	    				filter_key = 'orderby';

	    			// change url
	    			novaapfUpdateQueryStringParameter(filter_key, order);

	    			// filter products
	    			novaapfFilterProducts();
	    		});
	    	});
    	}
    }

    // init ordering
    novaapfInitOrder();

    // remove active filters
    $(document).on('click', '.novaapf-active-filters a:not(.reset)', function(event) {
    	event.preventDefault();
    	var element = $(this),
    		filter_key = element.attr('data-key'),
    		filter_val = element.attr('data-value');
    	if (typeof filter_val === 'undefined') {
	    	var query = novaapfRemoveQueryStringParameter(filter_key);
	    	history.pushState({}, '', query);

	    	// price slider
	    	if ($('#novaapf-noui-slider').length && jQuery().noUiSlider) {
	    		var priceSlider = document.getElementById('novaapf-noui-slider'),
	    			min_val = parseInt($(priceSlider).attr('data-min')),
	    			max_val = parseInt($(priceSlider).attr('data-max'));

	    		if (min_val && max_val) {
			    	if (filter_key === 'min-price') {
			    		priceSlider.noUiSlider.set([min_val, null]);
			    	} else if (filter_key === 'max-price') {
			    		priceSlider.noUiSlider.set([null, max_val]);
			    	}
	    		}
	    	}

	    	// filter products
	    	novaapfFilterProducts();
    	} else {
    		novaapfMakeParameters(filter_key, filter_val);
    	}
    });

    // clear all filters
    $(document).on('click', '.novaapf-active-filters a.reset', function(event) {
    	event.preventDefault();
    	var location = $(this).attr('data-location');
    	history.pushState({}, '', location);

    	// filter products
    	novaapfFilterProducts();
    });

	// dispaly type dropdown
	function formatState(state) {
	    var depth = $(state.element).attr('data-depth'),
	    	$state = $('<span class="depth depth-' + depth + '">' + state.text + '</span>');

		return $state;
	}

	novaapfDropDownFilter = function() {
		if ($('.novaapf-select2-single').length) {
			$('.novaapf-select2-single').select2({
			    templateResult: formatState,
			    minimumResultsForSearch: Infinity,
			    allowClear: true
			});
		}

		if ($('.novaapf-select2-multiple').length) {
			$('.novaapf-select2-multiple').select2({
			    templateResult: formatState,
			});
		}

		$('.select2-dropdown').css('display', 'none');
	}

	// initialize dropdown filter
	novaapfDropDownFilter();

	$(document).on('change', '.novaapf-select2', function(event) {
		event.preventDefault();
		var filter_key = $(this).attr('name'),
			filter_val = $(this).val();

		if (!filter_val) {
			var query = novaapfRemoveQueryStringParameter(filter_key);
			history.pushState({}, '', query);
		} else {
			filter_val = filter_val.toString();
			novaapfUpdateQueryStringParameter(filter_key, filter_val);
		}

		// filter products
		novaapfFilterProducts();
	});
});
