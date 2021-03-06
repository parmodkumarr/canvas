/*!
 * chartjs-plugin-zoom
 * http://chartjs.org/
 * Version: 0.6.5
 *
 * Copyright 2016 Evert Timberg
 * Released under the MIT license
 * https://github.com/chartjs/chartjs-plugin-zoom/blob/master/LICENSE.md
 */
! function() {
    function e(t, o, n) {
        function a(r, l) {
            if (!o[r]) {
                if (!t[r]) {
                    var m = "function" == typeof require && require;
                    if (!l && m) return m(r, !0);
                    if (i) return i(r, !0);
                    var s = new Error("Cannot find module '" + r + "'");
                    throw s.code = "MODULE_NOT_FOUND", s
                }
                var u = o[r] = {
                    exports: {}
                };
                t[r][0].call(u.exports, function(e) {
                    var o = t[r][1][e];
                    return a(o || e)
                }, u, u.exports, e, t, o, n)
            }
            return o[r].exports
        }
        for (var i = "function" == typeof require && require, r = 0; r < n.length; r++) a(n[r]);
        return a
    }
    return e
}()({
    1: [function(e, t, o) {}, {}],
    2: [function(e, t, o) {
        function n(e, t) {
            return void 0 === e || "string" == typeof e && e.indexOf(t) !== -1
        }

        function a(e, t) {
            if (e.scaleAxes && e.rangeMax && !z.isNullOrUndef(e.rangeMax[e.scaleAxes])) {
                var o = e.rangeMax[e.scaleAxes];
                t > o && (t = o)
            }
            return t
        }

        function i(e, t) {
            if (e.scaleAxes && e.rangeMin && !z.isNullOrUndef(e.rangeMin[e.scaleAxes])) {
                var o = e.rangeMin[e.scaleAxes];
                t < o && (t = o)
            }
            return t
        }

        function r(e, t, o, n) {
            var r = e.chart.data.labels,
                l = e.minIndex,
                m = r.length - 1,
                s = e.maxIndex,
                u = n.sensitivity,
                c = e.isHorizontal() ? e.left + e.width / 2 : e.top + e.height / 2,
                d = e.isHorizontal() ? o.x : o.y;
            y.zoomCumulativeDelta = t > 1 ? y.zoomCumulativeDelta + 1 : y.zoomCumulativeDelta - 1, Math.abs(y.zoomCumulativeDelta) > u && (y.zoomCumulativeDelta < 0 ? (d >= c ? l <= 0 ? s = Math.min(m, s + 1) : l = Math.max(0, l - 1) : d < c && (s >= m ? l = Math.max(0, l - 1) : s = Math.min(m, s + 1)), y.zoomCumulativeDelta = 0) : y.zoomCumulativeDelta > 0 && (d >= c ? l = l < s ? l = Math.min(s, l + 1) : l : d < c && (s = s > l ? s = Math.max(l, s - 1) : s), y.zoomCumulativeDelta = 0), e.options.ticks.min = i(n, r[l]), e.options.ticks.max = a(n, r[s]))
        }

        function l(e, t, o, n) {
            var r, l, m = e.options;
            e.isHorizontal() ? (r = e.right - e.left, l = (o.x - e.left) / r) : (r = e.bottom - e.top, l = (o.y - e.top) / r);
            var s = 1 - l,
                u = r * (t - 1),
                c = u * l,
                d = u * s,
                p = e.getValueForPixel(e.getPixelForValue(e.min) + c),
                f = e.getValueForPixel(e.getPixelForValue(e.max) - d),
                v = f.diff(p),
                x = i(n, v) != v,
                g = a(n, v) != v;
            x || g || (m.time.min = p, m.time.max = f)
        }

        function m(e, t, o, n) {
            var r = e.max - e.min,
                l = r * (t - 1),
                m = e.isHorizontal() ? o.x : o.y,
                s = (e.getValueForPixel(m) - e.min) / r,
                u = 1 - s,
                c = l * s,
                d = l * u;
            e.options.ticks.min = i(n, e.min + c), e.options.ticks.max = a(n, e.max - d)
        }

        function s(e, t, o, n) {
            var a = D[e.options.type];
            a && a(e, t, o, n)
        }

        function u(e, t, o, a) {
            var i = e.chartArea;
            o || (o = {
                x: (i.left + i.right) / 2,
                y: (i.top + i.bottom) / 2
            });
            var r = e.options.zoom;
            if (r && z.getValueOrDefault(r.enabled, _.zoom.enabled)) {
                var l = z.getValueOrDefault(e.options.zoom.mode, _.zoom.mode);
                r.sensitivity = z.getValueOrDefault(e.options.zoom.sensitivity, _.zoom.sensitivity);
                var m;
                m = "xy" == l && void 0 !== a ? a : "xy", z.each(e.scales, function(e, a) {
                    e.isHorizontal() && n(l, "x") && n(m, "x") ? (r.scaleAxes = "x", s(e, t, o, r)) : !e.isHorizontal() && n(l, "y") && n(m, "y") && (r.scaleAxes = "y", s(e, t, o, r))
                }), e.update(0)
            }
        }

        function c(e, t, o) {
            var n, r = e.chart.data.labels,
                l = r.length - 1,
                m = Math.max(e.ticks.length - (e.options.gridLines.offsetGridLines ? 0 : 1), 1),
                s = o.speed,
                u = e.minIndex,
                c = Math.round(e.width / (m * s));
            y.panCumulativeDelta += t, u = y.panCumulativeDelta > c ? Math.max(0, u - 1) : y.panCumulativeDelta < -c ? Math.min(l - m + 1, u + 1) : u, y.panCumulativeDelta = u !== e.minIndex ? 0 : y.panCumulativeDelta, n = Math.min(l, u + m - 1), e.options.ticks.min = i(o, r[u]), e.options.ticks.max = a(o, r[n])
        }

        function d(e, t, o) {
            var n = e.options,
                r = a(o, e.getValueForPixel(e.getPixelForValue(e.max) - t)),
                l = i(o, e.getValueForPixel(e.getPixelForValue(e.min) - t)),
                m = t < 0 ? r - e.max : l - e.min;
            n.time.max = e.max + m, n.time.min = e.min + m
        }

        function p(e, t, o) {
            var n = e.options.ticks,
                r = e.start,
                l = e.end;
            n.reverse ? (n.max = e.getValueForPixel(e.getPixelForValue(r) - t), n.min = e.getValueForPixel(e.getPixelForValue(l) - t)) : (n.min = e.getValueForPixel(e.getPixelForValue(r) - t), n.max = e.getValueForPixel(e.getPixelForValue(l) - t)), n.min = i(o, n.min), n.max = a(o, n.max)
        }

        function f(e, t, o) {
            var n = F[e.options.type];
            n && n(e, t, o)
        }

        function v(e, t, o) {
            var a = e.options.pan;
            if (a && z.getValueOrDefault(a.enabled, _.pan.enabled)) {
                var i = z.getValueOrDefault(e.options.pan.mode, _.pan.mode);
                a.speed = z.getValueOrDefault(e.options.pan.speed, _.pan.speed), z.each(e.scales, function(e, r) {
                    e.isHorizontal() && n(i, "x") && 0 !== t ? (a.scaleAxes = "x", f(e, t, a)) : !e.isHorizontal() && n(i, "y") && 0 !== o && (a.scaleAxes = "y", f(e, o, a))
                }), e.update(0)
            }
        }

        function x(e) {
            var t = e.scales;
            for (var o in t) {
                var n = t[o];
                if (!n.isHorizontal()) return n
            }
        }
        var g = e("hammerjs");
        g = "function" == typeof g ? g : window.Hammer;
        var h = e("chart.js");
        h = "function" == typeof h ? h : window.Chart;
        var z = h.helpers,
            y = h.Zoom = h.Zoom || {},
            D = y.zoomFunctions = y.zoomFunctions || {},
            F = y.panFunctions = y.panFunctions || {},
            _ = y.defaults = {
                pan: {
                    enabled: !0,
                    mode: "xy",
                    speed: 20,
                    threshold: 10
                },
                zoom: {
                    enabled: !0,
                    mode: "xy",
                    sensitivity: 3
                }
            };
        y.zoomFunctions.category = r, y.zoomFunctions.time = l, y.zoomFunctions.linear = m, y.zoomFunctions.logarithmic = m, y.panFunctions.category = c, y.panFunctions.time = d, y.panFunctions.linear = p, y.panFunctions.logarithmic = p, y.panCumulativeDelta = 0, y.zoomCumulativeDelta = 0;
        var M = {
            afterInit: function(e) {
                z.each(e.scales, function(e) {
                    e.originalOptions = z.clone(e.options)
                }), e.resetZoom = function() {
                    z.each(e.scales, function(e, t) {
                        var o = e.options.time,
                            n = e.options.ticks;
                        o && (o.min = e.originalOptions.time.min, o.max = e.originalOptions.time.max), n && (n.min = e.originalOptions.ticks.min, n.max = e.originalOptions.ticks.max)
                    }), z.each(e.data.datasets, function(e, t) {
                        e._meta = null
                    }), e.update()
                }
            },
            beforeInit: function(e) {
                e.zoom = {};
                var t = e.zoom.node = e.chart.ctx.canvas,
                    o = e.options,
                    n = z.getValueOrDefault(o.pan ? o.pan.threshold : void 0, y.defaults.pan.threshold);
                if (o.zoom && o.zoom.enabled && (o.zoom.drag ? (o.zoom.mode = "x", e.zoom._mouseDownHandler = function(t) {
                        e.zoom._dragZoomStart = t
                    }, t.addEventListener("mousedown", e.zoom._mouseDownHandler), e.zoom._mouseMoveHandler = function(t) {
                        e.zoom._dragZoomStart && (e.zoom._dragZoomEnd = t, e.update(0))
                    }, t.addEventListener("mousemove", e.zoom._mouseMoveHandler), e.zoom._mouseUpHandler = function(t) {
                        if (e.zoom._dragZoomStart) {
                            var o = e.chartArea,
                                n = x(e),
                                a = e.zoom._dragZoomStart,
                                i = a.target.getBoundingClientRect().left,
                                r = Math.min(a.clientX, t.clientX) - i,
                                l = Math.max(a.clientX, t.clientX) - i,
                                m = l - r,
                                s = o.right - o.left,
                                c = 1 + (s - m) / s;
                            e.zoom._dragZoomStart = null, e.zoom._dragZoomEnd = null, m > 0 && u(e, c, {
                                x: m / 2 + r,
                                y: (n.bottom - n.top) / 2
                            })
                        }
                    }, t.addEventListener("mouseup", e.zoom._mouseUpHandler)) : (e.zoom._wheelHandler = function(t) {
                        var o = t.target.getBoundingClientRect(),
                            n = t.clientX - o.left,
                            a = t.clientY - o.top,
                            i = {
                                x: n,
                                y: a
                            };
                        t.deltaY < 0 ? u(e, 1.1, i) : u(e, .909, i), t.preventDefault()
                    }, t.addEventListener("wheel", e.zoom._wheelHandler)), g)) {
                    var a = new g.Manager(t);
                    a.add(new g.Pinch), a.add(new g.Pan({
                        threshold: n
                    }));
                    var i, r = function(t) {
                        var o, n = 1 / i * t.scale,
                            a = t.target.getBoundingClientRect(),
                            r = t.center.x - a.left,
                            l = t.center.y - a.top,
                            m = {
                                x: r,
                                y: l
                            },
                            s = Math.abs(t.pointers[0].clientX - t.pointers[1].clientX),
                            c = Math.abs(t.pointers[0].clientY - t.pointers[1].clientY),
                            d = s / c;
                        o = d > .3 && d < 1.7 ? "xy" : s > c ? "x" : "y", u(e, n, m, o), i = t.scale
                    };
                    a.on("pinchstart", function(e) {
                        i = 1
                    }), a.on("pinch", r), a.on("pinchend", function(e) {
                        r(e), i = null, y.zoomCumulativeDelta = 0
                    });
                    var l = null,
                        m = null,
                        s = !1,
                        c = function(t) {
                            if (null !== l && null !== m) {
                                s = !0;
                                var o = t.deltaX - l,
                                    n = t.deltaY - m;
                                l = t.deltaX, m = t.deltaY, v(e, o, n)
                            }
                        };
                    a.on("panstart", function(e) {
                        l = 0, m = 0, c(e)
                    }), a.on("panmove", c), a.on("panend", function(e) {
                        l = null, m = null, y.panCumulativeDelta = 0, setTimeout(function() {
                            s = !1
                        }, 500)
                    }), e.zoom._ghostClickHandler = function(e) {
                        s && (e.stopImmediatePropagation(), e.preventDefault())
                    }, t.addEventListener("click", e.zoom._ghostClickHandler), e._mc = a
                }
            },
            beforeDatasetsDraw: function(e) {
                var t = e.chart.ctx,
                    o = e.chartArea;
                if (t.save(), t.beginPath(), e.zoom._dragZoomEnd) {
                    var n = x(e),
                        a = e.zoom._dragZoomStart,
                        i = e.zoom._dragZoomEnd,
                        r = a.target.getBoundingClientRect().left,
                        l = Math.min(a.clientX, i.clientX) - r,
                        m = Math.max(a.clientX, i.clientX) - r,
                        s = m - l;
                    t.fillStyle = "rgba(225,225,225,0.3)", t.lineWidth = 5, t.fillRect(l, n.top, s, n.bottom - n.top)
                }
                t.rect(o.left, o.top, o.right - o.left, o.bottom - o.top), t.clip()
            },
            afterDatasetsDraw: function(e) {
                e.chart.ctx.restore()
            },
            destroy: function(e) {
                if (e.zoom) {
                    var t = e.options,
                        o = e.zoom.node;
                    t.zoom && t.zoom.drag ? (o.removeEventListener("mousedown", e.zoom._mouseDownHandler), o.removeEventListener("mousemove", e.zoom._mouseMoveHandler), o.removeEventListener("mouseup", e.zoom._mouseUpHandler)) : o.removeEventListener("wheel", e.zoom._wheelHandler), g && o.removeEventListener("click", e.zoom._ghostClickHandler), delete e.zoom;
                    var n = e._mc;
                    n && (n.remove("pinchstart"), n.remove("pinch"), n.remove("pinchend"), n.remove("panstart"), n.remove("pan"), n.remove("panend"))
                }
            }
        };
        t.exports = M, h.pluginService.register(M)
    }, {
        "chart.js": 1,
        hammerjs: 1
    }]
}, {}, [2]);