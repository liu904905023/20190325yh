!function (t) {
    function e(n) {
        if (i[n])return i[n].exports;
        var r = i[n] = {exports: {}, id: n, loaded: !1};
        return t[n].call(r.exports, r, r.exports, e), r.loaded = !0, r.exports
    }

    var n = window.webpackJsonp;
    window.webpackJsonp = function (i, o) {
        for (var a, u, s = 0, c = []; s < i.length; s++)u = i[s], r[u] && c.push.apply(c, r[u]), r[u] = 0;
        for (a in o)t[a] = o[a];
        for (n && n(i, o); c.length;)c.shift().call(null, e)
    };
    var i = {}, r = {7: 0};
    return e.e = function (t, n) {
        if (0 === r[t])return n.call(null, e);
        if (void 0 !== r[t]) r[t].push(n); else {
            r[t] = [n];
//            var i = document.getElementsByTagName("head")[0], o = document.createElement("script");
//            o.type = "text/javascript", o.charset = "utf-8", o.async = !0, o.src = e.p + "" + t + "." + ({}[t] || t) + "-" + {
//                    1: "669c7e3f",
//                    2: "f0719dc4",
//                    5: "bca4137f"
//                }[t] + ".min.js", i.appendChild(o)
        }
    }, e.m = t, e.c = i, e.p = "https://statics.wosaimg.com/qr/javascripts/", e(0)
}({
    0: function (t, e, n) {
        t.exports = n(64)
    }, 35: function (t, e) {
        "use strict";
        var n = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
                return typeof t
            } : function (t) {
                return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
            }, i = function () {
            function t(t) {
                return null == t ? String(t) : K[J.call(t)] || "object"
            }

            function e(e) {
                return "function" == t(e)
            }

            function i(t) {
                return null != t && t == t.window
            }

            function r(t) {
                return null != t && t.nodeType == t.DOCUMENT_NODE
            }

            function o(e) {
                return "object" == t(e)
            }

            function a(t) {
                return o(t) && !i(t) && Object.getPrototypeOf(t) == Object.prototype
            }

            function u(t) {
                var e = !!t && "length" in t && t.length, n = k.type(t);
                return "function" != n && !i(t) && ("array" == n || 0 === e || "number" == typeof e && e > 0 && e - 1 in t)
            }

            function s(t) {
                return _.call(t, function (t) {
                    return null != t
                })
            }

            function c(t) {
                return t.length > 0 ? k.fn.concat.apply([], t) : t
            }

            function l(t) {
                return t.replace(/::/g, "/").replace(/([A-Z]+)([A-Z][a-z])/g, "$1_$2").replace(/([a-z\d])([A-Z])/g, "$1_$2").replace(/_/g, "-").toLowerCase()
            }

            function f(t) {
                return t in A ? A[t] : A[t] = new RegExp("(^|\\s)" + t + "(\\s|$)")
            }

            function p(t, e) {
                return "number" != typeof e || I[l(t)] ? e : e + "px"
            }

            function h(t) {
                var e, n;
                return M[t] || (e = $.createElement(t), $.body.appendChild(e), n = getComputedStyle(e, "").getPropertyValue("display"), e.parentNode.removeChild(e), "none" == n && (n = "block"), M[t] = n), M[t]
            }

            function d(t) {
                return "children" in t ? N.call(t.children) : k.map(t.childNodes, function (t) {
                        if (1 == t.nodeType)return t
                    })
            }

            function m(t, e) {
                var n, i = t ? t.length : 0;
                for (n = 0; n < i; n++)this[n] = t[n];
                this.length = i, this.selector = e || ""
            }

            function v(t, e, n) {
                for (S in e)n && (a(e[S]) || Q(e[S])) ? (a(e[S]) && !a(t[S]) && (t[S] = {}), Q(e[S]) && !Q(t[S]) && (t[S] = []), v(t[S], e[S], n)) : e[S] !== E && (t[S] = e[S])
            }

            function y(t, e) {
                return null == e ? k(t) : k(t).filter(e)
            }

            function b(t, n, i, r) {
                return e(n) ? n.call(t, i, r) : n
            }

            function g(t, e, n) {
                null == n ? t.removeAttribute(e) : t.setAttribute(e, n)
            }

            function w(t, e) {
                var n = t.className || "", i = n && n.baseVal !== E;
                return e === E ? i ? n.baseVal : n : void(i ? n.baseVal = e : t.className = e)
            }

            function x(t) {
                try {
                    return t ? "true" == t || "false" != t && ("null" == t ? null : +t + "" == t ? +t : /^[\[\{]/.test(t) ? k.parseJSON(t) : t) : t
                } catch (e) {
                    return t
                }
            }

            function T(t, e) {
                e(t);
                for (var n = 0, i = t.childNodes.length; n < i; n++)T(t.childNodes[n], e)
            }

            var E, S, k, j, P, O, C = [], D = C.concat, _ = C.filter, N = C.slice, $ = window.document, M = {}, A = {}, I = {
                "column-count": 1,
                columns: 1,
                "font-weight": 1,
                "line-height": 1,
                opacity: 1,
                "z-index": 1,
                zoom: 1
            }, L = /^\s*<(\w+|!)[^>]*>/, F = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, q = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, R = /^(?:body|html)$/i, Z = /([A-Z])/g, z = ["val", "css", "html", "text", "data", "width", "height", "offset"], H = ["after", "prepend", "before", "append"], U = $.createElement("table"), V = $.createElement("tr"), X = {
                tr: $.createElement("tbody"),
                tbody: U,
                thead: U,
                tfoot: U,
                td: V,
                th: V,
                "*": $.createElement("div")
            }, B = /^[\w-]*$/, K = {}, J = K.toString, Y = {}, G = $.createElement("div"), W = {
                tabindex: "tabIndex",
                readonly: "readOnly",
                for: "htmlFor",
                class: "className",
                maxlength: "maxLength",
                cellspacing: "cellSpacing",
                cellpadding: "cellPadding",
                rowspan: "rowSpan",
                colspan: "colSpan",
                usemap: "useMap",
                frameborder: "frameBorder",
                contenteditable: "contentEditable"
            }, Q = Array.isArray || function (t) {
                    return t instanceof Array
                };
            return Y.matches = function (t, e) {
                if (!e || !t || 1 !== t.nodeType)return !1;
                var n = t.matches || t.webkitMatchesSelector || t.mozMatchesSelector || t.oMatchesSelector || t.matchesSelector;
                if (n)return n.call(t, e);
                var i, r = t.parentNode, o = !r;
                return o && (r = G).appendChild(t), i = ~Y.qsa(r, e).indexOf(t), o && G.removeChild(t), i
            }, P = function (t) {
                return t.replace(/-+(.)?/g, function (t, e) {
                    return e ? e.toUpperCase() : ""
                })
            }, O = function (t) {
                return _.call(t, function (e, n) {
                    return t.indexOf(e) == n
                })
            }, Y.fragment = function (t, e, n) {
                var i, r, o;
                return F.test(t) && (i = k($.createElement(RegExp.$1))), i || (t.replace && (t = t.replace(q, "<$1></$2>")), e === E && (e = L.test(t) && RegExp.$1), e in X || (e = "*"), o = X[e], o.innerHTML = "" + t, i = k.each(N.call(o.childNodes), function () {
                    o.removeChild(this)
                })), a(n) && (r = k(i), k.each(n, function (t, e) {
                    z.indexOf(t) > -1 ? r[t](e) : r.attr(t, e)
                })), i
            }, Y.Z = function (t, e) {
                return new m(t, e)
            }, Y.isZ = function (t) {
                return t instanceof Y.Z
            }, Y.init = function (t, n) {
                var i;
                if (!t)return Y.Z();
                if ("string" == typeof t)if (t = t.trim(), "<" == t[0] && L.test(t)) i = Y.fragment(t, RegExp.$1, n), t = null; else {
                    if (n !== E)return k(n).find(t);
                    i = Y.qsa($, t)
                } else {
                    if (e(t))return k($).ready(t);
                    if (Y.isZ(t))return t;
                    if (Q(t)) i = s(t); else if (o(t)) i = [t], t = null; else if (L.test(t)) i = Y.fragment(t.trim(), RegExp.$1, n), t = null; else {
                        if (n !== E)return k(n).find(t);
                        i = Y.qsa($, t)
                    }
                }
                return Y.Z(i, t)
            }, k = function (t, e) {
                return Y.init(t, e)
            }, k.extend = function (t) {
                var e, n = N.call(arguments, 1);
                return "boolean" == typeof t && (e = t, t = n.shift()), n.forEach(function (n) {
                    v(t, n, e)
                }), t
            }, Y.qsa = function (t, e) {
                var n, i = "#" == e[0], r = !i && "." == e[0], o = i || r ? e.slice(1) : e, a = B.test(o);
                return t.getElementById && a && i ? (n = t.getElementById(o)) ? [n] : [] : 1 !== t.nodeType && 9 !== t.nodeType && 11 !== t.nodeType ? [] : N.call(a && !i && t.getElementsByClassName ? r ? t.getElementsByClassName(o) : t.getElementsByTagName(e) : t.querySelectorAll(e))
            }, k.contains = $.documentElement.contains ? function (t, e) {
                    return t !== e && t.contains(e)
                } : function (t, e) {
                    for (; e && (e = e.parentNode);)if (e === t)return !0;
                    return !1
                }, k.type = t, k.isFunction = e, k.isWindow = i, k.isArray = Q, k.isPlainObject = a, k.isEmptyObject = function (t) {
                var e;
                for (e in t)return !1;
                return !0
            }, k.isNumeric = function (t) {
                var e = Number(t), i = "undefined" == typeof t ? "undefined" : n(t);
                return null != t && "boolean" != i && ("string" != i || t.length) && !isNaN(e) && isFinite(e) || !1
            }, k.inArray = function (t, e, n) {
                return C.indexOf.call(e, t, n)
            }, k.camelCase = P, k.trim = function (t) {
                return null == t ? "" : String.prototype.trim.call(t)
            }, k.uuid = 0, k.support = {}, k.expr = {}, k.noop = function () {
            }, k.map = function (t, e) {
                var n, i, r, o = [];
                if (u(t))for (i = 0; i < t.length; i++)n = e(t[i], i), null != n && o.push(n); else for (r in t)n = e(t[r], r), null != n && o.push(n);
                return c(o)
            }, k.each = function (t, e) {
                var n, i;
                if (u(t)) {
                    for (n = 0; n < t.length; n++)if (e.call(t[n], n, t[n]) === !1)return t
                } else for (i in t)if (e.call(t[i], i, t[i]) === !1)return t;
                return t
            }, k.grep = function (t, e) {
                return _.call(t, e)
            }, window.JSON && (k.parseJSON = JSON.parse), k.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (t, e) {
                K["[object " + e + "]"] = e.toLowerCase()
            }), k.fn = {
                constructor: Y.Z, length: 0, forEach: C.forEach, reduce: C.reduce, push: C.push, sort: C.sort, splice: C.splice, indexOf: C.indexOf, concat: function () {
                    var t, e, n = [];
                    for (t = 0; t < arguments.length; t++)e = arguments[t], n[t] = Y.isZ(e) ? e.toArray() : e;
                    return D.apply(Y.isZ(this) ? this.toArray() : this, n)
                }, map: function (t) {
                    return k(k.map(this, function (e, n) {
                        return t.call(e, n, e)
                    }))
                }, slice: function () {
                    return k(N.apply(this, arguments))
                }, ready: function (t) {
                    if ("complete" === $.readyState || "loading" !== $.readyState && !$.documentElement.doScroll) setTimeout(function () {
                        t(k)
                    }, 0); else {
                        var e = function e() {
                            $.removeEventListener("DOMContentLoaded", e, !1), window.removeEventListener("load", e, !1), t(k)
                        };
                        $.addEventListener("DOMContentLoaded", e, !1), window.addEventListener("load", e, !1)
                    }
                    return this
                }, get: function (t) {
                    return t === E ? N.call(this) : this[t >= 0 ? t : t + this.length]
                }, toArray: function () {
                    return this.get()
                }, size: function () {
                    return this.length
                }, remove: function () {
                    return this.each(function () {
                        null != this.parentNode && this.parentNode.removeChild(this)
                    })
                }, each: function (t) {
                    return C.every.call(this, function (e, n) {
                        return t.call(e, n, e) !== !1
                    }), this
                }, filter: function (t) {
                    return e(t) ? this.not(this.not(t)) : k(_.call(this, function (e) {
                            return Y.matches(e, t)
                        }))
                }, add: function (t, e) {
                    return k(O(this.concat(k(t, e))))
                }, is: function (t) {
                    return this.length > 0 && Y.matches(this[0], t)
                }, not: function (t) {
                    var n = [];
                    if (e(t) && t.call !== E) this.each(function (e) {
                        t.call(this, e) || n.push(this)
                    }); else {
                        var i = "string" == typeof t ? this.filter(t) : u(t) && e(t.item) ? N.call(t) : k(t);
                        this.forEach(function (t) {
                            i.indexOf(t) < 0 && n.push(t)
                        })
                    }
                    return k(n)
                }, has: function (t) {
                    return this.filter(function () {
                        return o(t) ? k.contains(this, t) : k(this).find(t).size()
                    })
                }, eq: function (t) {
                    return t === -1 ? this.slice(t) : this.slice(t, +t + 1)
                }, first: function () {
                    var t = this[0];
                    return t && !o(t) ? t : k(t)
                }, last: function () {
                    var t = this[this.length - 1];
                    return t && !o(t) ? t : k(t)
                }, find: function (t) {
                    var e, i = this;
                    return e = t ? "object" == ("undefined" == typeof t ? "undefined" : n(t)) ? k(t).filter(function () {
                                var t = this;
                                return C.some.call(i, function (e) {
                                    return k.contains(e, t)
                                })
                            }) : 1 == this.length ? k(Y.qsa(this[0], t)) : this.map(function () {
                                    return Y.qsa(this, t)
                                }) : k()
                }, closest: function (t, e) {
                    var i = [], o = "object" == ("undefined" == typeof t ? "undefined" : n(t)) && k(t);
                    return this.each(function (n, a) {
                        for (; a && !(o ? o.indexOf(a) >= 0 : Y.matches(a, t));)a = a !== e && !r(a) && a.parentNode;
                        a && i.indexOf(a) < 0 && i.push(a)
                    }), k(i)
                }, parents: function (t) {
                    for (var e = [], n = this; n.length > 0;)n = k.map(n, function (t) {
                        if ((t = t.parentNode) && !r(t) && e.indexOf(t) < 0)return e.push(t), t
                    });
                    return y(e, t)
                }, parent: function (t) {
                    return y(O(this.pluck("parentNode")), t)
                }, children: function (t) {
                    return y(this.map(function () {
                        return d(this)
                    }), t)
                }, contents: function () {
                    return this.map(function () {
                        return this.contentDocument || N.call(this.childNodes)
                    })
                }, siblings: function (t) {
                    return y(this.map(function (t, e) {
                        return _.call(d(e.parentNode), function (t) {
                            return t !== e
                        })
                    }), t)
                }, empty: function () {
                    return this.each(function () {
                        this.innerHTML = ""
                    })
                }, pluck: function (t) {
                    return k.map(this, function (e) {
                        return e[t]
                    })
                }, show: function () {
                    return this.each(function () {
                        "none" == this.style.display && (this.style.display = ""), "none" == getComputedStyle(this, "").getPropertyValue("display") && (this.style.display = h(this.nodeName))
                    })
                }, replaceWith: function (t) {
                    return this.before(t).remove()
                }, wrap: function (t) {
                    var n = e(t);
                    if (this[0] && !n)var i = k(t).get(0), r = i.parentNode || this.length > 1;
                    return this.each(function (e) {
                        k(this).wrapAll(n ? t.call(this, e) : r ? i.cloneNode(!0) : i)
                    })
                }, wrapAll: function (t) {
                    if (this[0]) {
                        k(this[0]).before(t = k(t));
                        for (var e; (e = t.children()).length;)t = e.first();
                        k(t).append(this)
                    }
                    return this
                }, wrapInner: function (t) {
                    var n = e(t);
                    return this.each(function (e) {
                        var i = k(this), r = i.contents(), o = n ? t.call(this, e) : t;
                        r.length ? r.wrapAll(o) : i.append(o)
                    })
                }, unwrap: function () {
                    return this.parent().each(function () {
                        k(this).replaceWith(k(this).children())
                    }), this
                }, clone: function () {
                    return this.map(function () {
                        return this.cloneNode(!0)
                    })
                }, hide: function () {
                    return this.css("display", "none")
                }, toggle: function (t) {
                    return this.each(function () {
                        var e = k(this);
                        (t === E ? "none" == e.css("display") : t) ? e.show() : e.hide()
                    })
                }, prev: function (t) {
                    return k(this.pluck("previousElementSibling")).filter(t || "*")
                }, next: function (t) {
                    return k(this.pluck("nextElementSibling")).filter(t || "*")
                }, html: function (t) {
                    return 0 in arguments ? this.each(function (e) {
                            var n = this.innerHTML;
                            k(this).empty().append(b(this, t, e, n))
                        }) : 0 in this ? this[0].innerHTML : null
                }, text: function (t) {
                    return 0 in arguments ? this.each(function (e) {
                            var n = b(this, t, e, this.textContent);
                            this.textContent = null == n ? "" : "" + n
                        }) : 0 in this ? this.pluck("textContent").join("") : null
                }, attr: function (t, e) {
                    var n;
                    return "string" != typeof t || 1 in arguments ? this.each(function (n) {
                            if (1 === this.nodeType)if (o(t))for (S in t)g(this, S, t[S]); else g(this, t, b(this, e, n, this.getAttribute(t)))
                        }) : 0 in this && 1 == this[0].nodeType && null != (n = this[0].getAttribute(t)) ? n : E
                }, removeAttr: function (t) {
                    return this.each(function () {
                        1 === this.nodeType && t.split(" ").forEach(function (t) {
                            g(this, t)
                        }, this)
                    })
                }, prop: function (t, e) {
                    return t = W[t] || t, 1 in arguments ? this.each(function (n) {
                            this[t] = b(this, e, n, this[t])
                        }) : this[0] && this[0][t]
                }, removeProp: function (t) {
                    return t = W[t] || t, this.each(function () {
                        delete this[t]
                    })
                }, data: function t(e, n) {
                    var i = "data-" + e.replace(Z, "-$1").toLowerCase(), t = 1 in arguments ? this.attr(i, n) : this.attr(i);
                    return null !== t ? x(t) : E
                }, val: function (t) {
                    return 0 in arguments ? (null == t && (t = ""), this.each(function (e) {
                            this.value = b(this, t, e, this.value)
                        })) : this[0] && (this[0].multiple ? k(this[0]).find("option").filter(function () {
                                return this.selected
                            }).pluck("value") : this[0].value)
                }, offset: function (t) {
                    if (t)return this.each(function (e) {
                        var n = k(this), i = b(this, t, e, n.offset()), r = n.offsetParent().offset(), o = {top: i.top - r.top, left: i.left - r.left};
                        "static" == n.css("position") && (o.position = "relative"), n.css(o)
                    });
                    if (!this.length)return null;
                    if ($.documentElement !== this[0] && !k.contains($.documentElement, this[0]))return {top: 0, left: 0};
                    var e = this[0].getBoundingClientRect();
                    return {left: e.left + window.pageXOffset, top: e.top + window.pageYOffset, width: Math.round(e.width), height: Math.round(e.height)}
                }, css: function e(n, i) {
                    if (arguments.length < 2) {
                        var r = this[0];
                        if ("string" == typeof n) {
                            if (!r)return;
                            return r.style[P(n)] || getComputedStyle(r, "").getPropertyValue(n)
                        }
                        if (Q(n)) {
                            if (!r)return;
                            var o = {}, a = getComputedStyle(r, "");
                            return k.each(n, function (t, e) {
                                o[e] = r.style[P(e)] || a.getPropertyValue(e)
                            }), o
                        }
                    }
                    var e = "";
                    if ("string" == t(n)) i || 0 === i ? e = l(n) + ":" + p(n, i) : this.each(function () {
                            this.style.removeProperty(l(n))
                        }); else for (S in n)n[S] || 0 === n[S] ? e += l(S) + ":" + p(S, n[S]) + ";" : this.each(function () {
                            this.style.removeProperty(l(S))
                        });
                    return this.each(function () {
                        this.style.cssText += ";" + e
                    })
                }, index: function (t) {
                    return t ? this.indexOf(k(t)[0]) : this.parent().children().indexOf(this[0])
                }, hasClass: function (t) {
                    return !!t && C.some.call(this, function (t) {
                            return this.test(w(t))
                        }, f(t))
                }, addClass: function (t) {
                    return t ? this.each(function (e) {
                            if ("className" in this) {
                                j = [];
                                var n = w(this), i = b(this, t, e, n);
                                i.split(/\s+/g).forEach(function (t) {
                                    k(this).hasClass(t) || j.push(t)
                                }, this), j.length && w(this, n + (n ? " " : "") + j.join(" "))
                            }
                        }) : this
                }, removeClass: function (t) {
                    return this.each(function (e) {
                        if ("className" in this) {
                            if (t === E)return w(this, "");
                            j = w(this), b(this, t, e, j).split(/\s+/g).forEach(function (t) {
                                j = j.replace(f(t), " ")
                            }), w(this, j.trim())
                        }
                    })
                }, toggleClass: function (t, e) {
                    return t ? this.each(function (n) {
                            var i = k(this), r = b(this, t, n, w(this));
                            r.split(/\s+/g).forEach(function (t) {
                                (e === E ? !i.hasClass(t) : e) ? i.addClass(t) : i.removeClass(t)
                            })
                        }) : this
                }, scrollTop: function (t) {
                    if (this.length) {
                        var e = "scrollTop" in this[0];
                        return t === E ? e ? this[0].scrollTop : this[0].pageYOffset : this.each(e ? function () {
                                    this.scrollTop = t
                                } : function () {
                                    this.scrollTo(this.scrollX, t)
                                })
                    }
                }, scrollLeft: function (t) {
                    if (this.length) {
                        var e = "scrollLeft" in this[0];
                        return t === E ? e ? this[0].scrollLeft : this[0].pageXOffset : this.each(e ? function () {
                                    this.scrollLeft = t
                                } : function () {
                                    this.scrollTo(t, this.scrollY)
                                })
                    }
                }, position: function () {
                    if (this.length) {
                        var t = this[0], e = this.offsetParent(), n = this.offset(), i = R.test(e[0].nodeName) ? {top: 0, left: 0} : e.offset();
                        return n.top -= parseFloat(k(t).css("margin-top")) || 0, n.left -= parseFloat(k(t).css("margin-left")) || 0, i.top += parseFloat(k(e[0]).css("border-top-width")) || 0, i.left += parseFloat(k(e[0]).css("border-left-width")) || 0, {
                            top: n.top - i.top,
                            left: n.left - i.left
                        }
                    }
                }, offsetParent: function () {
                    return this.map(function () {
                        for (var t = this.offsetParent || $.body; t && !R.test(t.nodeName) && "static" == k(t).css("position");)t = t.offsetParent;
                        return t
                    })
                }
            }, k.fn.detach = k.fn.remove, ["width", "height"].forEach(function (t) {
                var e = t.replace(/./, function (t) {
                    return t[0].toUpperCase()
                });
                k.fn[t] = function (n) {
                    var o, a = this[0];
                    return n === E ? i(a) ? a["inner" + e] : r(a) ? a.documentElement["scroll" + e] : (o = this.offset()) && o[t] : this.each(function (e) {
                            a = k(this), a.css(t, b(this, n, e, a[t]()))
                        })
                }
            }), H.forEach(function (e, n) {
                var i = n % 2;
                k.fn[e] = function () {
                    var e, r, o = k.map(arguments, function (n) {
                        var i = [];
                        return e = t(n), "array" == e ? (n.forEach(function (t) {
                                return t.nodeType !== E ? i.push(t) : k.zepto.isZ(t) ? i = i.concat(t.get()) : void(i = i.concat(Y.fragment(t)))
                            }), i) : "object" == e || null == n ? n : Y.fragment(n)
                    }), a = this.length > 1;
                    return o.length < 1 ? this : this.each(function (t, e) {
                            r = i ? e : e.parentNode, e = 0 == n ? e.nextSibling : 1 == n ? e.firstChild : 2 == n ? e : null;
                            var u = k.contains($.documentElement, r);
                            o.forEach(function (t) {
                                if (a) t = t.cloneNode(!0); else if (!r)return k(t).remove();
                                r.insertBefore(t, e), u && T(t, function (t) {
                                    if (!(null == t.nodeName || "SCRIPT" !== t.nodeName.toUpperCase() || t.type && "text/javascript" !== t.type || t.src)) {
                                        var e = t.ownerDocument ? t.ownerDocument.defaultView : window;
                                        e.eval.call(e, t.innerHTML)
                                    }
                                })
                            })
                        })
                }, k.fn[i ? e + "To" : "insert" + (n ? "Before" : "After")] = function (t) {
                    return k(t)[e](this), this
                }
            }), Y.Z.prototype = m.prototype = k.fn, Y.uniq = O, Y.deserializeValue = x, k.zepto = Y, k
        }();
        window.Zepto = i, void 0 === window.$ && (window.$ = i), function (t) {
            function e(t) {
                return t._zid || (t._zid = p++)
            }

            function n(t, n, o, a) {
                if (n = i(n), n.ns)var u = r(n.ns);
                return (v[e(t)] || []).filter(function (t) {
                    return t && (!n.e || t.e == n.e) && (!n.ns || u.test(t.ns)) && (!o || e(t.fn) === e(o)) && (!a || t.sel == a)
                })
            }

            function i(t) {
                var e = ("" + t).split(".");
                return {e: e[0], ns: e.slice(1).sort().join(" ")}
            }

            function r(t) {
                return new RegExp("(?:^| )" + t.replace(" ", " .* ?") + "(?: |$)")
            }

            function o(t, e) {
                return t.del && !b && t.e in g || !!e
            }

            function a(t) {
                return w[t] || b && g[t] || t
            }

            function u(n, r, u, s, l, p, h) {
                var d = e(n), m = v[d] || (v[d] = []);
                r.split(/\s/).forEach(function (e) {
                    if ("ready" == e)return t(document).ready(u);
                    var r = i(e);
                    r.fn = u, r.sel = l, r.e in w && (u = function (e) {
                        var n = e.relatedTarget;
                        if (!n || n !== this && !t.contains(this, n))return r.fn.apply(this, arguments)
                    }), r.del = p;
                    var d = p || u;
                    r.proxy = function (t) {
                        if (t = c(t), !t.isImmediatePropagationStopped()) {
                            t.data = s;
                            var e = d.apply(n, t._args == f ? [t] : [t].concat(t._args));
                            return e === !1 && (t.preventDefault(), t.stopPropagation()), e
                        }
                    }, r.i = m.length, m.push(r), "addEventListener" in n && n.addEventListener(a(r.e), r.proxy, o(r, h))
                })
            }

            function s(t, i, r, u, s) {
                var c = e(t);
                (i || "").split(/\s/).forEach(function (e) {
                    n(t, e, r, u).forEach(function (e) {
                        delete v[c][e.i], "removeEventListener" in t && t.removeEventListener(a(e.e), e.proxy, o(e, s))
                    })
                })
            }

            function c(e, n) {
                if (n || !e.isDefaultPrevented) {
                    n || (n = e), t.each(S, function (t, i) {
                        var r = n[t];
                        e[t] = function () {
                            return this[i] = x, r && r.apply(n, arguments)
                        }, e[i] = T
                    });
                    try {
                        e.timeStamp || (e.timeStamp = Date.now())
                    } catch (t) {
                    }
                    (n.defaultPrevented !== f ? n.defaultPrevented : "returnValue" in n ? n.returnValue === !1 : n.getPreventDefault && n.getPreventDefault()) && (e.isDefaultPrevented = x)
                }
                return e
            }

            function l(t) {
                var e, n = {originalEvent: t};
                for (e in t)E.test(e) || t[e] === f || (n[e] = t[e]);
                return c(n, t)
            }

            var f, p = 1, h = Array.prototype.slice, d = t.isFunction, m = function (t) {
                return "string" == typeof t
            }, v = {}, y = {}, b = "onfocusin" in window, g = {focus: "focusin", blur: "focusout"}, w = {mouseenter: "mouseover", mouseleave: "mouseout"};
            y.click = y.mousedown = y.mouseup = y.mousemove = "MouseEvents", t.event = {add: u, remove: s}, t.proxy = function (n, i) {
                var r = 2 in arguments && h.call(arguments, 2);
                if (d(n)) {
                    var o = function () {
                        return n.apply(i, r ? r.concat(h.call(arguments)) : arguments)
                    };
                    return o._zid = e(n), o
                }
                if (m(i))return r ? (r.unshift(n[i], n), t.proxy.apply(null, r)) : t.proxy(n[i], n);
                throw new TypeError("expected function")
            }, t.fn.bind = function (t, e, n) {
                return this.on(t, e, n)
            }, t.fn.unbind = function (t, e) {
                return this.off(t, e)
            }, t.fn.one = function (t, e, n, i) {
                return this.on(t, e, n, i, 1)
            };
            var x = function () {
                return !0
            }, T = function () {
                return !1
            }, E = /^([A-Z]|returnValue$|layer[XY]$|webkitMovement[XY]$)/, S = {
                preventDefault: "isDefaultPrevented",
                stopImmediatePropagation: "isImmediatePropagationStopped",
                stopPropagation: "isPropagationStopped"
            };
            t.fn.delegate = function (t, e, n) {
                return this.on(e, t, n)
            }, t.fn.undelegate = function (t, e, n) {
                return this.off(e, t, n)
            }, t.fn.live = function (e, n) {
                return t(document.body).delegate(this.selector, e, n), this
            }, t.fn.die = function (e, n) {
                return t(document.body).undelegate(this.selector, e, n), this
            }, t.fn.on = function (e, n, i, r, o) {
                var a, c, p = this;
                return e && !m(e) ? (t.each(e, function (t, e) {
                        p.on(t, n, i, e, o)
                    }), p) : (m(n) || d(r) || r === !1 || (r = i, i = n, n = f), r !== f && i !== !1 || (r = i, i = f), r === !1 && (r = T), p.each(function (f, p) {
                        o && (a = function (t) {
                            return s(p, t.type, r), r.apply(this, arguments)
                        }), n && (c = function (e) {
                            var i, o = t(e.target).closest(n, p).get(0);
                            if (o && o !== p)return i = t.extend(l(e), {currentTarget: o, liveFired: p}), (a || r).apply(o, [i].concat(h.call(arguments, 1)))
                        }), u(p, e, r, i, n, c || a)
                    }))
            }, t.fn.off = function (e, n, i) {
                var r = this;
                return e && !m(e) ? (t.each(e, function (t, e) {
                        r.off(t, n, e)
                    }), r) : (m(n) || d(i) || i === !1 || (i = n, n = f), i === !1 && (i = T), r.each(function () {
                        s(this, e, i, n)
                    }))
            }, t.fn.trigger = function (e, n) {
                return e = m(e) || t.isPlainObject(e) ? t.Event(e) : c(e), e._args = n, this.each(function () {
                    e.type in g && "function" == typeof this[e.type] ? this[e.type]() : "dispatchEvent" in this ? this.dispatchEvent(e) : t(this).triggerHandler(e, n)
                })
            }, t.fn.triggerHandler = function (e, i) {
                var r, o;
                return this.each(function (a, u) {
                    r = l(m(e) ? t.Event(e) : e), r._args = i, r.target = u, t.each(n(u, e.type || e), function (t, e) {
                        if (o = e.proxy(r), r.isImmediatePropagationStopped())return !1
                    })
                }), o
            }, "focusin focusout focus blur load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select keydown keypress keyup error".split(" ").forEach(function (e) {
                t.fn[e] = function (t) {
                    return 0 in arguments ? this.bind(e, t) : this.trigger(e)
                }
            }), t.Event = function (t, e) {
                m(t) || (e = t, t = e.type);
                var n = document.createEvent(y[t] || "Events"), i = !0;
                if (e)for (var r in e)"bubbles" == r ? i = !!e[r] : n[r] = e[r];
                return n.initEvent(t, i, !0), c(n)
            }
        }(i), function (t) {
            function e(e, i) {
                var s = e[u], c = s && r[s];
                if (void 0 === i)return c || n(e);
                if (c) {
                    if (i in c)return c[i];
                    var l = a(i);
                    if (l in c)return c[l]
                }
                return o.call(t(e), i)
            }

            function n(e, n, o) {
                var s = e[u] || (e[u] = ++t.uuid), c = r[s] || (r[s] = i(e));
                return void 0 !== n && (c[a(n)] = o), c
            }

            function i(e) {
                var n = {};
                return t.each(e.attributes || s, function (e, i) {
                    0 == i.name.indexOf("data-") && (n[a(i.name.replace("data-", ""))] = t.zepto.deserializeValue(i.value))
                }), n
            }

            var r = {}, o = t.fn.data, a = t.camelCase, u = t.expando = "Zepto" + +new Date, s = [];
            t.fn.data = function (i, r) {
                return void 0 === r ? t.isPlainObject(i) ? this.each(function (e, r) {
                            t.each(i, function (t, e) {
                                n(r, t, e)
                            })
                        }) : 0 in this ? e(this[0], i) : void 0 : this.each(function () {
                        n(this, i, r)
                    })
            }, t.data = function (e, n, i) {
                return t(e).data(n, i)
            }, t.hasData = function (e) {
                var n = e[u], i = n && r[n];
                return !!i && !t.isEmptyObject(i)
            }, t.fn.removeData = function (e) {
                return "string" == typeof e && (e = e.split(/\s+/)), this.each(function () {
                    var n = this[u], i = n && r[n];
                    i && t.each(e || i, function (t) {
                        delete i[e ? a(this) : t]
                    })
                })
            }, ["remove", "empty"].forEach(function (e) {
                var n = t.fn[e];
                t.fn[e] = function () {
                    var t = this.find("*");
                    return "remove" === e && (t = t.add(this)), t.removeData(), n.call(this)
                }
            })
        }(i), function (t) {
            function e(e, n, i) {
                var r = t.Event(n);
                return t(e).trigger(r, i), !r.isDefaultPrevented()
            }

            function n(t, n, i, r) {
                if (t.global)return e(n || g, i, r)
            }

            function i(e) {
                e.global && 0 === t.active++ && n(e, null, "ajaxStart")
            }

            function r(e) {
                e.global && !--t.active && n(e, null, "ajaxStop")
            }

            function o(t, e) {
                var i = e.context;
                return e.beforeSend.call(i, t, e) !== !1 && n(e, i, "ajaxBeforeSend", [t, e]) !== !1 && void n(e, i, "ajaxSend", [t, e])
            }

            function a(t, e, i, r) {
                var o = i.context, a = "success";
                i.success.call(o, t, a, e), r && r.resolveWith(o, [t, a, e]), n(i, o, "ajaxSuccess", [e, i, t]), s(a, e, i)
            }

            function u(t, e, i, r, o) {
                var a = r.context;
                r.error.call(a, i, e, t), o && o.rejectWith(a, [i, e, t]), n(r, a, "ajaxError", [i, r, t || e]), s(e, i, r)
            }

            function s(t, e, i) {
                var o = i.context;
                i.complete.call(o, e, t), n(i, o, "ajaxComplete", [e, i]), r(i)
            }

            function c(t, e, n) {
                if (n.dataFilter == l)return t;
                var i = n.context;
                return n.dataFilter.call(i, t, e)
            }

            function l() {
            }

            function f(t) {
                return t && (t = t.split(";", 2)[0]), t && (t == S ? "html" : t == E ? "json" : x.test(t) ? "script" : T.test(t) && "xml") || "text"
            }

            function p(t, e) {
                return "" == e ? t : (t + "&" + e).replace(/[&?]{1,2}/, "?")
            }

            function h(e) {
                e.processData && e.data && "string" != t.type(e.data) && (e.data = t.param(e.data, e.traditional)), !e.data || e.type && "GET" != e.type.toUpperCase() && "jsonp" != e.dataType || (e.url = p(e.url, e.data), e.data = void 0)
            }

            function d(e, n, i, r) {
                return t.isFunction(n) && (r = i, i = n, n = void 0), t.isFunction(i) || (r = i, i = void 0), {url: e, data: n, success: i, dataType: r}
            }

            function m(e, n, i, r) {
                var o, a = t.isArray(n), u = t.isPlainObject(n);
                t.each(n, function (n, s) {
                    o = t.type(s), r && (n = i ? r : r + "[" + (u || "object" == o || "array" == o ? n : "") + "]"), !r && a ? e.add(s.name, s.value) : "array" == o || !i && "object" == o ? m(e, s, i, n) : e.add(n, s)
                })
            }

            var v, y, b = +new Date, g = window.document, w = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, x = /^(?:text|application)\/javascript/i, T = /^(?:text|application)\/xml/i, E = "application/json", S = "text/html", k = /^\s*$/, j = g.createElement("a");
            j.href = window.location.href, t.active = 0, t.ajaxJSONP = function (e, n) {
                if (!("type" in e))return t.ajax(e);
                var i, r, s = e.jsonpCallback, c = (t.isFunction(s) ? s() : s) || "Zepto" + b++, l = g.createElement("script"), f = window[c], p = function (e) {
                    t(l).triggerHandler("error", e || "abort")
                }, h = {abort: p};
                return n && n.promise(h), t(l).on("load error", function (o, s) {
                    clearTimeout(r), t(l).off().remove(), "error" != o.type && i ? a(i[0], h, e, n) : u(null, s || "error", h, e, n), window[c] = f, i && t.isFunction(f) && f(i[0]), f = i = void 0
                }), o(h, e) === !1 ? (p("abort"), h) : (window[c] = function () {
                        i = arguments
                    }, l.src = e.url.replace(/\?(.+)=\?/, "?$1=" + c), g.head.appendChild(l), e.timeout > 0 && (r = setTimeout(function () {
                        p("timeout")
                    }, e.timeout)), h)
            }, t.ajaxSettings = {
                type: "GET",
                beforeSend: l,
                success: l,
                error: l,
                complete: l,
                context: null,
                global: !0,
                xhr: function () {
                    return new window.XMLHttpRequest
                },
                accepts: {script: "text/javascript, application/javascript, application/x-javascript", json: E, xml: "application/xml, text/xml", html: S, text: "text/plain"},
                crossDomain: !1,
                timeout: 0,
                processData: !0,
                cache: !0,
                dataFilter: l
            }, t.ajax = function (e) {
                var n, r, s = t.extend({}, e || {}), d = t.Deferred && t.Deferred();
                for (v in t.ajaxSettings)void 0 === s[v] && (s[v] = t.ajaxSettings[v]);
                i(s), s.crossDomain || (n = g.createElement("a"), n.href = s.url, n.href = n.href, s.crossDomain = j.protocol + "//" + j.host != n.protocol + "//" + n.host), s.url || (s.url = window.location.toString()), (r = s.url.indexOf("#")) > -1 && (s.url = s.url.slice(0, r)), h(s);
                var m = s.dataType, b = /\?.+=\?/.test(s.url);
                if (b && (m = "jsonp"), s.cache !== !1 && (e && e.cache === !0 || "script" != m && "jsonp" != m) || (s.url = p(s.url, "_=" + Date.now())), "jsonp" == m)return b || (s.url = p(s.url, s.jsonp ? s.jsonp + "=?" : s.jsonp === !1 ? "" : "callback=?")), t.ajaxJSONP(s, d);
                var w, x = s.accepts[m], T = {}, E = function (t, e) {
                    T[t.toLowerCase()] = [t, e]
                }, S = /^([\w-]+:)\/\//.test(s.url) ? RegExp.$1 : window.location.protocol, P = s.xhr(), O = P.setRequestHeader;
                if (d && d.promise(P), s.crossDomain || E("X-Requested-With", "XMLHttpRequest"), E("Accept", x || "*/*"), (x = s.mimeType || x) && (x.indexOf(",") > -1 && (x = x.split(",", 2)[0]), P.overrideMimeType && P.overrideMimeType(x)), (s.contentType || s.contentType !== !1 && s.data && "GET" != s.type.toUpperCase()) && E("Content-Type", s.contentType || "application/x-www-form-urlencoded"), s.headers)for (y in s.headers)E(y, s.headers[y]);
                if (P.setRequestHeader = E, P.onreadystatechange = function () {
                        if (4 == P.readyState) {
                            P.onreadystatechange = l, clearTimeout(w);
                            var e, n = !1;
                            if (P.status >= 200 && P.status < 300 || 304 == P.status || 0 == P.status && "file:" == S) {
                                if (m = m || f(s.mimeType || P.getResponseHeader("content-type")), "arraybuffer" == P.responseType || "blob" == P.responseType) e = P.response; else {
                                    e = P.responseText;
                                    try {
                                        e = c(e, m, s), "script" == m ? (0, eval)(e) : "xml" == m ? e = P.responseXML : "json" == m && (e = k.test(e) ? null : t.parseJSON(e))
                                    } catch (t) {
                                        n = t
                                    }
                                    if (n)return u(n, "parsererror", P, s, d)
                                }
                                a(e, P, s, d)
                            } else u(P.statusText || null, P.status ? "error" : "abort", P, s, d)
                        }
                    }, o(P, s) === !1)return P.abort(), u(null, "abort", P, s, d), P;
                var C = !("async" in s) || s.async;
                if (P.open(s.type, s.url, C, s.username, s.password), s.xhrFields)for (y in s.xhrFields)P[y] = s.xhrFields[y];
                for (y in T)O.apply(P, T[y]);

            }, t.get = function () {
                return t.ajax(d.apply(null, arguments))
            }, t.post = function () {
                var e = d.apply(null, arguments);
                return e.type = "POST", t.ajax(e)
            }, t.getJSON = function () {
                var e = d.apply(null, arguments);
                return e.dataType = "json", t.ajax(e)
            }, t.fn.load = function (e, n, i) {
                if (!this.length)return this;
                var r, o = this, a = e.split(/\s/), u = d(e, n, i), s = u.success;
                return a.length > 1 && (u.url = a[0], r = a[1]), u.success = function (e) {
                    o.html(r ? t("<div>").html(e.replace(w, "")).find(r) : e), s && s.apply(o, arguments)
                }, t.ajax(u), this
            };
            var P = encodeURIComponent;
            t.param = function (e, n) {
                var i = [];
                return i.add = function (e, n) {
                    t.isFunction(n) && (n = n()), null == n && (n = ""), this.push(P(e) + "=" + P(n))
                }, m(i, e, n), i.join("&").replace(/%20/g, "+")
            }
        }(i), function (t) {
            function e(t, e, n, i) {
                return Math.abs(t - e) >= Math.abs(n - i) ? t - e > 0 ? "Left" : "Right" : n - i > 0 ? "Up" : "Down"
            }

            function n() {
                l = null, p.last && (p.el.trigger("longTap"), p = {})
            }

            function i() {
                l && clearTimeout(l), l = null
            }

            function r() {
                u && clearTimeout(u), s && clearTimeout(s), c && clearTimeout(c), l && clearTimeout(l), u = s = c = l = null, p = {}
            }

            function o(t) {
                return ("touch" == t.pointerType || t.pointerType == t.MSPOINTER_TYPE_TOUCH) && t.isPrimary
            }

            function a(t, e) {
                return t.type == "pointer" + e || t.type.toLowerCase() == "mspointer" + e
            }

            var u, s, c, l, f, p = {}, h = 750;
            t(document).ready(function () {
                var d, m, v, y, b = 0, g = 0;
                "MSGesture" in window && (f = new MSGesture, f.target = document.body), t(document).bind("MSGestureEnd", function (t) {
                    var e = t.velocityX > 1 ? "Right" : t.velocityX < -1 ? "Left" : t.velocityY > 1 ? "Down" : t.velocityY < -1 ? "Up" : null;
                    e && (p.el.trigger("swipe"), p.el.trigger("swipe" + e))
                }).on("touchstart MSPointerDown pointerdown", function (e) {
                    (y = a(e, "down")) && !o(e) || (v = y ? e : e.touches[0], e.touches && 1 === e.touches.length && p.x2 && (p.x2 = void 0, p.y2 = void 0), d = Date.now(), m = d - (p.last || d), p.el = t("tagName" in v.target ? v.target : v.target.parentNode), u && clearTimeout(u), p.x1 = v.pageX, p.y1 = v.pageY, m > 0 && m <= 250 && (p.isDoubleTap = !0), p.last = d, l = setTimeout(n, h), f && y && f.addPointer(e.pointerId))
                }).on("touchmove MSPointerMove pointermove", function (t) {
                    (y = a(t, "move")) && !o(t) || (v = y ? t : t.touches[0], i(), p.x2 = v.pageX, p.y2 = v.pageY, b += Math.abs(p.x1 - p.x2), g += Math.abs(p.y1 - p.y2))
                }).on("touchend MSPointerUp pointerup", function (n) {
                    (y = a(n, "up")) && !o(n) || (i(), p.x2 && Math.abs(p.x1 - p.x2) > 30 || p.y2 && Math.abs(p.y1 - p.y2) > 30 ? c = setTimeout(function () {
                            p.el && (p.el.trigger("swipe"), p.el.trigger("swipe" + e(p.x1, p.x2, p.y1, p.y2))), p = {}
                        }, 0) : "last" in p && (b < 30 && g < 30 ? s = setTimeout(function () {
                                var e = t.Event("tap");
                                e.cancelTouch = r, p.el && p.el.trigger(e), p.isDoubleTap ? (p.el && p.el.trigger("doubleTap"), p = {}) : u = setTimeout(function () {
                                        u = null, p.el && p.el.trigger("singleTap"), p = {}
                                    }, 250)
                            }, 0) : p = {}), b = g = 0)
                }).on("touchcancel MSPointerCancel pointercancel", r), t(window).on("scroll", r)
            }), ["swipe", "swipeLeft", "swipeRight", "swipeUp", "swipeDown", "doubleTap", "tap", "singleTap", "longTap"].forEach(function (e) {
                t.fn[e] = function (t) {
                    return this.on(e, t)
                }
            })
        }(i), e.Zepto = i, e.$ = $
    }, 36: function (t, e, n) {
        "use strict";
        function i(t) {
            return t && t.__esModule ? t : {default: t}
        }

        function r(t, e) {
            if (!(t instanceof e))throw new TypeError("Cannot call a class as a function")
        }

        Object.defineProperty(e, "__esModule", {value: !0});
        var o = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var i = e[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                }
            }

            return function (e, n, i) {
                return n && t(e.prototype, n), i && t(e, i), e
            }
        }(), a = n(35), u = n(37), s = i(u), c = n(39), l = i(c), f = n(40), p = i(f), h = n(41), d = n(50), m = function () {
            function t(e) {
                r(this, t), this.amount = null, this.config = e, this.initObserver().initDisplay().initKeyboard();
                var n = this.getKeyboard(), i = this.getObserver();
                i.sub("orderSuccess", function () {
                    (0, d.attemptPayIncrease)()
                }), i.sub("orderCancel", function () {
                    n.releaseKeyboard().enableSubmit().submitFinish()
                }), i.sub("orderFail", function () {
                    n.releaseKeyboard().enableSubmit().submitFinish()
                }), i.sub("paySuccess", function () {
                    (0, d.attemptPayEmpty)()
                }, !0), i.sub("payCancel", function () {
                    n.releaseKeyboard().enableSubmit().submitFinish()
                }), i.sub("payFail", function () {
                    (0, h.alertFriendly)("呀，付款的人太多了。没挤进去。刷新页面重新付款吧~", function () {
                        window.location.reload()
                    })
                }), i.sub("beforeOrder", function () {
                    wa("send", "timing", "beforeOrder", Date.now())
                }, !0), i.sub("afterOrder", function () {
                    wa("send", "timing", "afterOrder", Date.now())
                }, !0), i.sub("beforePay", function () {
                    wa("send", "timing", "beforePay", Date.now())
                }, !0)
            }

            return o(t, [{
                key: "initObserver", value: function () {
                    return this.observer = new s.default, this
                }
            }, {
                key: "initDisplay", value: function () {
                    var t = this.display = new l.default, e = this;
                    return t.getObserver().sub("afterUpdate", function (t) {
                        var n = e.amount = parseFloat(t.data), i = e.getKeyboard();
                        !isNaN(n) && n > 0 ? i.releaseLock("enter").enableSubmit() : i.disableSubmit(), e.getObserver().pub("afterDisUpdate", n)
                    }), this
                }
            }, {
                key: "initKeyboard", value: function () {
                    var t = this, e = this, n = this.keyboard = new p.default;
                    return n.getObserver().sub("press", function (i) {
                        var r = i.data, o = t.getDisplay();
                        "enter" == r ? (wa("send", "timing", "submit", Date.now()),
                                n.lockKeyboard().disableSubmit().submiting(), e.pay()) : (n.lock("enter"), o.update(r))
                    }), this
                }
            }, {
                key: "getDisplay", value: function () {
                    return this.display
                }
            }, {
                key: "getKeyboard", value: function () {
                    return this.keyboard
                }
            }, {
                key: "getObserver", value: function () {
                    return this.observer
                }
            }, {
                key: "pay", value: function () {
                    document.searchform.action="/index.php/Intels/index";
                    searchform.submit();
                    // var t = "呀，付款的人太多了。没挤进去。请重新扫码付款吧~", e = this.getObserver(), i = this;
                    // return (0, d.isTouchMaxAttemptPayTimes)() ? (e.pub("orderCancel"), void e.pub("touchMaxAttemptPayTimes")) : e.pub("beforeOrder", i.amount) === !1 ? void e.pub("orderCancel") : (a.$.ajax({
                    //             type: "POST",
                    //             url: i.config.orderApi,
                    //             data: {amount: i.amount},
                    //             dataType: "json",
                    //             success: function (i) {
                    //                 "10000" == i.code ? e.pub("orderSuccess", i) : n.e(2, function () {
                    //                         var r = n(51).default, o = r[i.code] || i.msg || t;
                    //                         (0, h.alertFriendly)(o, function () {
                    //                             e.pub("orderFail")
                    //                         })
                    //                     })
                    //             },
                    //             error: function () {
                    //                 (0, h.alertFriendly)("23呀，付款的人太多了。没挤进去。刷新页面重新付款吧~", function () {
                    //                     window.location.reload()
                    //                 }), e.pub("orderFail")
                    //             },
                    //             complete: function () {
                    //                 e.pub("afterOrder")
                    //             }
                    //         }), this)
                }
            }]), t
        }();
        e.default = m
    }, 37: function (t, e, n) {
        "use strict";
        function i(t) {
            return t && t.__esModule ? t : {default: t}
        }

        function r(t, e) {
            if (!(t instanceof e))throw new TypeError("Cannot call a class as a function")
        }

        Object.defineProperty(e, "__esModule", {value: !0});
        var o = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var i = e[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                }
            }

            return function (e, n, i) {
                return n && t(e.prototype, n), i && t(e, i), e
            }
        }(), a = n(38), u = i(a), s = function () {
            function t() {
                r(this, t), this.subscribers = {}
            }

            return o(t, [{
                key: "pub", value: function (t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null;
                    return t in this.subscribers ? this.subscribers[t].reduce(function (n, i) {
                            return i.immediately ? n !== !1 ? i.cb(new u.default(t, e)) : n : (setTimeout(function () {
                                    i.cb(new u.default(t, e))
                                }, 0), n)
                        }, this) : this
                }
            }, {
                key: "sub", value: function (t, e) {
                    var n = arguments.length > 2 && void 0 !== arguments[2] && arguments[2];
                    return !(!t || !e) && (t in this.subscribers || (this.subscribers[t] = []), this.subscribers[t].push({cb: e, immediately: n}), this.subscribers[t].length - 1)
                }
            }, {
                key: "unSub", value: function (t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : [];
                    return t in this.subscribers ? (e instanceof Array ? e.forEach(function (e) {
                                this.subscribers[t].splice(e, 1)
                            }.bind(this)) : e instanceof Number && this.subscribers[t].splice(e, 1), this) : this
                }
            }]), t
        }();
        e.default = s
    }, 38: function (t, e) {
        "use strict";
        function n(t, e) {
            if (!(t instanceof e))throw new TypeError("Cannot call a class as a function")
        }

        Object.defineProperty(e, "__esModule", {value: !0});
        var i = function t(e, i) {
            n(this, t), this.topic = e, this.data = i
        };
        e.default = i
    }, 39: function (t, e, n) {
        "use strict";
        function i(t) {
            return t && t.__esModule ? t : {default: t}
        }

        function r(t, e) {
            if (!(t instanceof e))throw new TypeError("Cannot call a class as a function")
        }

        Object.defineProperty(e, "__esModule", {value: !0});
        var o = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var i = e[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                }
            }

            return function (e, n, i) {
                return n && t(e.prototype, n), i && t(e, i), e
            }
        }(), a = n(35), u = n(37), s = i(u), c = function () {
            function t() {
                r(this, t), this.observer = new s.default, this.input = (0, a.$)("#amount"), this.amountView = (0, a.$)(".js-amount-view")
            }

            return o(t, [{
                key: "getObserver", value: function () {
                    return this.observer
                }
            }, {
                key: "update", value: function (t) {
                    if ("enter" != t) {
                        var e = this.input, n = this.amountView, i = e.val(), r = i;
                        this.getObserver().pub("beforeUpdate", i), r = "del" == t ? i ? i.substr(0, i.length - 1) : "" : i + t, r.split(".").length > 2 && (r = i), "." == r && (r = "0."), "00" == r && (r = "0"), r.length > 1 && "0" == r[0] && "0" != r[1] && "." != r[1] && (r = r[1]), r.toString().indexOf(".") != -1 && r.toString().split(".")[1].length > 2 && (r = i), r.toString().split(".")[0].length > 5 && (r = i), e.val(r), n.html(r), this.getObserver().pub("afterUpdate", r)
                    }
                }
            }]), t
        }();
        e.default = c
    }, 40: function (t, e, n) {
        "use strict";
        function i(t) {
            return t && t.__esModule ? t : {default: t}
        }

        function r(t, e) {
            if (!(t instanceof e))throw new TypeError("Cannot call a class as a function")
        }

        Object.defineProperty(e, "__esModule", {value: !0});
        var o = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var i = e[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i)
                }
            }

            return function (e, n, i) {
                return n && t(e.prototype, n), i && t(e, i), e
            }
        }(), a = n(35), u = n(37), s = i(u), c = function () {
            function t() {
                r(this, t), this.observer = new s.default, this.bindEvent()
            }

            return o(t, [{
                key: "bindEvent", value: function () {
                    var t, e, n = this;
                    (0, a.$)("#keyboard").on("touchstart", ".keyboard__key", function (t) {
                        if (t.preventDefault(), !(0, a.$)(this).data("disabled")) {
                            var e = (0, a.$)(this).data("key");
                            (0, a.$)('[data-key="' + e + '"]').addClass("keyboard__key--hover")
                        }
                    }), (0, a.$)("#keyboard").on("touchend touchcancel touchmove", ".keyboard__key", function (t) {
                        t.preventDefault();
                        var e = (0, a.$)(this).data("key");
                        (0, a.$)('[data-key="' + e + '"]').removeClass("keyboard__key--hover")
                    }), (0, a.$)("#keyboard").on("tap", ".keyboard__key", function (i) {
                        i.preventDefault();
                        var r = (0, a.$)(this).data("key");
                        n.isLocked(r) || t && new Date - t < 50 && e == r || (t = new Date, e = r, n.getObserver().pub("press", r))
                    })
                }
            }, {
                key: "getObserver", value: function () {
                    return this.observer
                }
            }, {
                key: "lock", value: function (t) {
                    return (0, a.$)('[data-key="' + t + '"]').data("disabled", !0), this
                }
            }, {
                key: "releaseLock", value: function (t) {
                    return (0, a.$)('[data-key="' + t + '"]').data("disabled", !1), this
                }
            }, {
                key: "isLocked", value: function (t) {
                    return (0, a.$)('[data-key="' + t + '"]').data("disabled")
                }
            }, {
                key: "lockKeyboard", value: function () {
                    return (0, a.$)("#keyboard .keyboard__key").data("disabled", !0), this
                }
            }, {
                key: "releaseKeyboard", value: function () {
                    return (0, a.$)("#keyboard .keyboard__key").data("disabled", !1), this
                }
            }, {
                key: "submiting", value: function () {
                    return (0, a.$)("#submit").find(".pay").html("<span>正在</span><span>支付</span>"), this
                }
            }, {
                key: "submitFinish", value: function () {
                    return (0, a.$)("#submit").find(".pay").html("<span>确认</span><span>支付</span>"), this
                }
            }, {
                key: "disableSubmit", value: function () {
                    return (0, a.$)("#submit").addClass("keyboard__enter--disabled"), this
                }
            }, {
                key: "enableSubmit", value: function () {
                    return (0, a.$)("#submit").removeClass("keyboard__enter--disabled"), this
                }
            }, {
                key: "limit", value: function (t) {
                    t && ((0, a.$)("#submit .js-limit-num").html(t + " 元"), (0, a.$)("#submit .js-limit").show(), (0, a.$)("#submit .js-pay").hide())
                }
            }, {
                key: "unLimit", value: function () {
                    (0, a.$)("#submit .js-limit").hide(), (0, a.$)("#submit .js-pay").show()
                }
            }]), t
        }();
        e.default = c
    }, 41: function (t, e, n) {
        "use strict";
        function i() {
            for (var t = arguments.length, e = Array(t), i = 0; i < t; i++)e[i] = arguments[i];
            n.e(1, function () {
                n(42).show.apply(window, e)
            })
        }

        function r() {
            n.e(1, function () {
                n(42).hide.call(window)
            })
        }

        Object.defineProperty(e, "__esModule", {value: !0}), e.alertFriendly = i, e.closeAlert = r
    }, 50: function (t, e, n) {
        "use strict";
        function i(t) {
            var e = window.localStorage.getItem("disableCommitTime"), n = function () {
                var n = 60 - Math.floor((Date.now() - e) / 1e3);
                n <= 0 ? (clearInterval(c), c = null, a(), (0, s.closeAlert)()) : (0, s.alertFriendly)("您的操作过于频繁，请稍后再试！", void 0, "朕知道了，喵～(" + n + "s)", t)
            };
            n(), c || (c = setInterval(n, 1e3))
        }

        function r() {
            c && (clearInterval(c), c = null, (0, s.closeAlert)())
        }

        function o() {
            if (window.localStorage) {
                var t = window.localStorage.getItem("attemptPayTimes") || 0;
                0 != t && window.localStorage.getItem("attemptPayTimes") || window.localStorage.setItem("attemptPayTimesExpire", Date.now()), window.localStorage.setItem("attemptPayTimes", ++t)
            }
        }

        function a() {
            window.localStorage && (window.localStorage.removeItem("attemptPayTimes"), window.localStorage.removeItem("attemptPayTimesExpire"), window.localStorage.removeItem("disableCommitTime"))
        }

        function u() {
            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 2, e = 0;
            if (window.localStorage) {
                var n = window.localStorage.getItem("attemptPayTimesExpire");
                null === n && (n = Date.now(), window.localStorage.setItem("attemptPayTimesExpire", n));
                var i = window.localStorage.getItem("disableCommitTime");
                e = window.localStorage.getItem("attemptPayTimes") || 0, !i && e > t && (i = Date.now(), window.localStorage.setItem("disableCommitTime", i));
                var r = i ? Date.now() - Number(i) : Date.now() - Number(n);
                r > 6e4 && a(), e = window.localStorage.getItem("attemptPayTimes") || 0
            }
            return e > t
        }

        Object.defineProperty(e, "__esModule", {value: !0}), e.showDisableCommitTime = i, e.hideDisableCommitTime = r, e.attemptPayIncrease = o, e.attemptPayEmpty = a, e.isTouchMaxAttemptPayTimes = u;
        var s = n(41), c = void 0
    }, 52: function (t, e) {
        t.exports = window.variable
    }, 64: function (t, e, n) {
        "use strict";
        function i(t) {
            return t && t.__esModule ? t : {default: t}
        }

        var r = n(35), o = n(36), a = i(o), u = n(50), s = (n(41), n(52)), c = i(s), l = {path: "/qr/review"};
        (0, r.$)(function () {
            var t = new a.default({orderApi: "/qr/api/pay/qq", env: "qq"}), e = t.getObserver();
            e.sub("touchMaxAttemptPayTimes", function () {
                (0, u.showDisableCommitTime)(function () {
                    (0, u.hideDisableCommitTime)()
                })
            }), e.sub("orderFail", function () {
                window.location.reload()
            }), e.sub("orderSuccess", function (t) {
                var n = t.data.data;
                mqq.tenpay.pay({tokenId: n.tokenId, pubAcc: n.pubAcc, pubAccHint: n.pubAccHint}, function (t) {
                    function i() {
                        if (i = function () {
                            }, 0 == t.resultCode) {
                            e.pub("paySuccess");
                            var o = {merchantId: c.default.merchantId, qrCodeId: c.default.qrCodeId, order_sn: n.order_sn};
                            l.params && (o = r.$.extend(l.params, o)), window.location.replace(l.path + "?" + r.$.param(o))
                        } else e.pub("payCancel")
                    }

                    e.pub("afterPay"), wa("send", "timing", "afterPay", Date.now(), {
                        cb: function () {
                            clearTimeout(o), i()
                        }
                    });
                    var o = setTimeout(i, 1e3)
                })
            })
        }), n.e(5, function (t) {
            var e = [t(53), t(58)];
            (function () {
                t(53)("qq"), t(58)()
            }).apply(null, e)
        })
    }
});