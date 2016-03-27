$(function() {
	var a = jQuery;
	a.fn.lazyload = function(d) {
		var b = {
			threshold: 0,
			failurelimit: 0,
			event: "scroll",
			effect: "show",
			container: window
		};
		d && a.extend(b, d);
		var e = this;
		"scroll" == b.event && a(b.container).bind("scroll", function() {
			var c = 0;
			e.each(function() {
				if (!a.belowthefold(this, b) && !a.rightoffold(this, b)) a(this).trigger("appear");
				else if (c++ > b.failurelimit) return !1
			});
			var d = a.grep(e, function(a) {
				return !a.loaded
			});
			e = a(d)
		});
		return this.each(function() {
			var c = this;
			a(c).attr("original", a(c).attr("src"));
			"scroll" != b.event || a.belowthefold(c, b) || a.rightoffold(c, b) ? (b.placeholder ? a(c).attr("src", b.placeholder) : a(c).removeAttr("src"), c.loaded = !1) : c.loaded = !0;
			a(c).one("appear", function() {
				this.loaded || a("<img />").bind("load", function() {
					a(c).hide().attr("src", a(c).attr("original"))[b.effect](b.effectspeed);
					c.loaded = true
				}).attr("src", a(c).attr("original"))
			});
			"scroll" != b.event && a(c).bind(b.event, function() {
				c.loaded || a(c).trigger("appear")
			})
		})
	};
	a.belowthefold = function(d, b) {
		return (void 0 === b.container || b.container === window ? a(window).height() + a(window).scrollTop() : a(b.container).offset().top + a(b.container).height()) <= a(d).offset().top - b.threshold
	};
	a.rightoffold = function(d, b) {
		return (void 0 === b.container || b.container === window ? a(window).width() + a(window).scrollLeft() : a(b.container).offset().left + a(b.container).width()) <= a(d).offset().left - b.threshold
	};
	a.extend(a.expr[":"], {
		"below-the-fold": "$.belowthefold(a, {threshold : 0, container: window})",
		"above-the-fold": "!$.belowthefold(a, {threshold : 0, container: window})",
		"right-of-fold": "$.rightoffold(a, {threshold : 0, container: window})",
		"left-of-fold": "!$.rightoffold(a, {threshold : 0, container: window})"
	})
});