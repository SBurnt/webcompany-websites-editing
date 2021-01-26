!(function (e, t) {
  "use strict";
  "object" == typeof module && "object" == typeof module.exports
    ? (module.exports = e.document
        ? t(e, !0)
        : function (e) {
            if (!e.document) throw new Error("jQuery requires a window with a document");
            return t(e);
          })
    : t(e);
})("undefined" != typeof window ? window : this, function (e, t) {
  "use strict";
  function n(e, t) {
    t = t || te;
    var n = t.createElement("script");
    (n.text = e), t.head.appendChild(n).parentNode.removeChild(n);
  }
  function i(e) {
    var t = !!e && "length" in e && e.length,
      n = he.type(e);
    return (
      "function" !== n && !he.isWindow(e) && ("array" === n || 0 === t || ("number" == typeof t && t > 0 && t - 1 in e))
    );
  }
  function r(e, t, n) {
    return he.isFunction(t)
      ? he.grep(e, function (e, i) {
          return !!t.call(e, i, e) !== n;
        })
      : t.nodeType
      ? he.grep(e, function (e) {
          return (e === t) !== n;
        })
      : "string" != typeof t
      ? he.grep(e, function (e) {
          return ae.call(t, e) > -1 !== n;
        })
      : Ee.test(t)
      ? he.filter(t, e, n)
      : ((t = he.filter(t, e)),
        he.grep(e, function (e) {
          return ae.call(t, e) > -1 !== n && 1 === e.nodeType;
        }));
  }
  function o(e, t) {
    for (; (e = e[t]) && 1 !== e.nodeType; );
    return e;
  }
  function a(e) {
    var t = {};
    return (
      he.each(e.match(je) || [], function (e, n) {
        t[n] = !0;
      }),
      t
    );
  }
  function s(e) {
    return e;
  }
  function l(e) {
    throw e;
  }
  function u(e, t, n) {
    var i;
    try {
      e && he.isFunction((i = e.promise))
        ? i.call(e).done(t).fail(n)
        : e && he.isFunction((i = e.then))
        ? i.call(e, t, n)
        : t.call(void 0, e);
    } catch (e) {
      n.call(void 0, e);
    }
  }
  function c() {
    te.removeEventListener("DOMContentLoaded", c), e.removeEventListener("load", c), he.ready();
  }
  function f() {
    this.expando = he.expando + f.uid++;
  }
  function d(e) {
    return (
      "true" === e || ("false" !== e && ("null" === e ? null : e === +e + "" ? +e : Fe.test(e) ? JSON.parse(e) : e))
    );
  }
  function p(e, t, n) {
    var i;
    if (void 0 === n && 1 === e.nodeType)
      if (((i = "data-" + t.replace(Re, "-$&").toLowerCase()), (n = e.getAttribute(i)), "string" == typeof n)) {
        try {
          n = d(n);
        } catch (e) {}
        Ie.set(e, t, n);
      } else n = void 0;
    return n;
  }
  function h(e, t, n, i) {
    var r,
      o = 1,
      a = 20,
      s = i
        ? function () {
            return i.cur();
          }
        : function () {
            return he.css(e, t, "");
          },
      l = s(),
      u = (n && n[3]) || (he.cssNumber[t] ? "" : "px"),
      c = (he.cssNumber[t] || ("px" !== u && +l)) && ze.exec(he.css(e, t));
    if (c && c[3] !== u) {
      (u = u || c[3]), (n = n || []), (c = +l || 1);
      do (o = o || ".5"), (c /= o), he.style(e, t, c + u);
      while (o !== (o = s() / l) && 1 !== o && --a);
    }
    return (
      n &&
        ((c = +c || +l || 0),
        (r = n[1] ? c + (n[1] + 1) * n[2] : +n[2]),
        i && ((i.unit = u), (i.start = c), (i.end = r))),
      r
    );
  }
  function m(e) {
    var t,
      n = e.ownerDocument,
      i = e.nodeName,
      r = We[i];
    return r
      ? r
      : ((t = n.body.appendChild(n.createElement(i))),
        (r = he.css(t, "display")),
        t.parentNode.removeChild(t),
        "none" === r && (r = "block"),
        (We[i] = r),
        r);
  }
  function g(e, t) {
    for (var n, i, r = [], o = 0, a = e.length; o < a; o++)
      (i = e[o]),
        i.style &&
          ((n = i.style.display),
          t
            ? ("none" === n && ((r[o] = Oe.get(i, "display") || null), r[o] || (i.style.display = "")),
              "" === i.style.display && He(i) && (r[o] = m(i)))
            : "none" !== n && ((r[o] = "none"), Oe.set(i, "display", n)));
    for (o = 0; o < a; o++) null != r[o] && (e[o].style.display = r[o]);
    return e;
  }
  function v(e, t) {
    var n;
    return (
      (n =
        "undefined" != typeof e.getElementsByTagName
          ? e.getElementsByTagName(t || "*")
          : "undefined" != typeof e.querySelectorAll
          ? e.querySelectorAll(t || "*")
          : []),
      void 0 === t || (t && he.nodeName(e, t)) ? he.merge([e], n) : n
    );
  }
  function y(e, t) {
    for (var n = 0, i = e.length; n < i; n++) Oe.set(e[n], "globalEval", !t || Oe.get(t[n], "globalEval"));
  }
  function x(e, t, n, i, r) {
    for (var o, a, s, l, u, c, f = t.createDocumentFragment(), d = [], p = 0, h = e.length; p < h; p++)
      if (((o = e[p]), o || 0 === o))
        if ("object" === he.type(o)) he.merge(d, o.nodeType ? [o] : o);
        else if (Xe.test(o)) {
          for (
            a = a || f.appendChild(t.createElement("div")),
              s = ($e.exec(o) || ["", ""])[1].toLowerCase(),
              l = Ke[s] || Ke._default,
              a.innerHTML = l[1] + he.htmlPrefilter(o) + l[2],
              c = l[0];
            c--;

          )
            a = a.lastChild;
          he.merge(d, a.childNodes), (a = f.firstChild), (a.textContent = "");
        } else d.push(t.createTextNode(o));
    for (f.textContent = "", p = 0; (o = d[p++]); )
      if (i && he.inArray(o, i) > -1) r && r.push(o);
      else if (((u = he.contains(o.ownerDocument, o)), (a = v(f.appendChild(o), "script")), u && y(a), n))
        for (c = 0; (o = a[c++]); ) Ve.test(o.type || "") && n.push(o);
    return f;
  }
  function b() {
    return !0;
  }
  function k() {
    return !1;
  }
  function w() {
    try {
      return te.activeElement;
    } catch (e) {}
  }
  function S(e, t, n, i, r, o) {
    var a, s;
    if ("object" == typeof t) {
      "string" != typeof n && ((i = i || n), (n = void 0));
      for (s in t) S(e, s, n, i, t[s], o);
      return e;
    }
    if (
      (null == i && null == r
        ? ((r = n), (i = n = void 0))
        : null == r && ("string" == typeof n ? ((r = i), (i = void 0)) : ((r = i), (i = n), (n = void 0))),
      r === !1)
    )
      r = k;
    else if (!r) return e;
    return (
      1 === o &&
        ((a = r),
        (r = function (e) {
          return he().off(e), a.apply(this, arguments);
        }),
        (r.guid = a.guid || (a.guid = he.guid++))),
      e.each(function () {
        he.event.add(this, t, r, i, n);
      })
    );
  }
  function E(e, t) {
    return he.nodeName(e, "table") && he.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr")
      ? e.getElementsByTagName("tbody")[0] || e
      : e;
  }
  function C(e) {
    return (e.type = (null !== e.getAttribute("type")) + "/" + e.type), e;
  }
  function P(e) {
    var t = it.exec(e.type);
    return t ? (e.type = t[1]) : e.removeAttribute("type"), e;
  }
  function A(e, t) {
    var n, i, r, o, a, s, l, u;
    if (1 === t.nodeType) {
      if (Oe.hasData(e) && ((o = Oe.access(e)), (a = Oe.set(t, o)), (u = o.events))) {
        delete a.handle, (a.events = {});
        for (r in u) for (n = 0, i = u[r].length; n < i; n++) he.event.add(t, r, u[r][n]);
      }
      Ie.hasData(e) && ((s = Ie.access(e)), (l = he.extend({}, s)), Ie.set(t, l));
    }
  }
  function D(e, t) {
    var n = t.nodeName.toLowerCase();
    "input" === n && Ge.test(e.type)
      ? (t.checked = e.checked)
      : ("input" !== n && "textarea" !== n) || (t.defaultValue = e.defaultValue);
  }
  function T(e, t, i, r) {
    t = re.apply([], t);
    var o,
      a,
      s,
      l,
      u,
      c,
      f = 0,
      d = e.length,
      p = d - 1,
      h = t[0],
      m = he.isFunction(h);
    if (m || (d > 1 && "string" == typeof h && !de.checkClone && nt.test(h)))
      return e.each(function (n) {
        var o = e.eq(n);
        m && (t[0] = h.call(this, n, o.html())), T(o, t, i, r);
      });
    if (
      d &&
      ((o = x(t, e[0].ownerDocument, !1, e, r)), (a = o.firstChild), 1 === o.childNodes.length && (o = a), a || r)
    ) {
      for (s = he.map(v(o, "script"), C), l = s.length; f < d; f++)
        (u = o), f !== p && ((u = he.clone(u, !0, !0)), l && he.merge(s, v(u, "script"))), i.call(e[f], u, f);
      if (l)
        for (c = s[s.length - 1].ownerDocument, he.map(s, P), f = 0; f < l; f++)
          (u = s[f]),
            Ve.test(u.type || "") &&
              !Oe.access(u, "globalEval") &&
              he.contains(c, u) &&
              (u.src ? he._evalUrl && he._evalUrl(u.src) : n(u.textContent.replace(rt, ""), c));
    }
    return e;
  }
  function j(e, t, n) {
    for (var i, r = t ? he.filter(t, e) : e, o = 0; null != (i = r[o]); o++)
      n || 1 !== i.nodeType || he.cleanData(v(i)),
        i.parentNode && (n && he.contains(i.ownerDocument, i) && y(v(i, "script")), i.parentNode.removeChild(i));
    return e;
  }
  function N(e, t, n) {
    var i,
      r,
      o,
      a,
      s = e.style;
    return (
      (n = n || st(e)),
      n &&
        ((a = n.getPropertyValue(t) || n[t]),
        "" !== a || he.contains(e.ownerDocument, e) || (a = he.style(e, t)),
        !de.pixelMarginRight() &&
          at.test(a) &&
          ot.test(t) &&
          ((i = s.width),
          (r = s.minWidth),
          (o = s.maxWidth),
          (s.minWidth = s.maxWidth = s.width = a),
          (a = n.width),
          (s.width = i),
          (s.minWidth = r),
          (s.maxWidth = o))),
      void 0 !== a ? a + "" : a
    );
  }
  function _(e, t) {
    return {
      get: function () {
        return e() ? void delete this.get : (this.get = t).apply(this, arguments);
      },
    };
  }
  function L(e) {
    if (e in dt) return e;
    for (var t = e[0].toUpperCase() + e.slice(1), n = ft.length; n--; ) if (((e = ft[n] + t), e in dt)) return e;
  }
  function M(e, t, n) {
    var i = ze.exec(t);
    return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : t;
  }
  function O(e, t, n, i, r) {
    var o,
      a = 0;
    for (o = n === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0; o < 4; o += 2)
      "margin" === n && (a += he.css(e, n + Be[o], !0, r)),
        i
          ? ("content" === n && (a -= he.css(e, "padding" + Be[o], !0, r)),
            "margin" !== n && (a -= he.css(e, "border" + Be[o] + "Width", !0, r)))
          : ((a += he.css(e, "padding" + Be[o], !0, r)),
            "padding" !== n && (a += he.css(e, "border" + Be[o] + "Width", !0, r)));
    return a;
  }
  function I(e, t, n) {
    var i,
      r = !0,
      o = st(e),
      a = "border-box" === he.css(e, "boxSizing", !1, o);
    if ((e.getClientRects().length && (i = e.getBoundingClientRect()[t]), i <= 0 || null == i)) {
      if (((i = N(e, t, o)), (i < 0 || null == i) && (i = e.style[t]), at.test(i))) return i;
      (r = a && (de.boxSizingReliable() || i === e.style[t])), (i = parseFloat(i) || 0);
    }
    return i + O(e, t, n || (a ? "border" : "content"), r, o) + "px";
  }
  function F(e, t, n, i, r) {
    return new F.prototype.init(e, t, n, i, r);
  }
  function R() {
    ht && (e.requestAnimationFrame(R), he.fx.tick());
  }
  function q() {
    return (
      e.setTimeout(function () {
        pt = void 0;
      }),
      (pt = he.now())
    );
  }
  function z(e, t) {
    var n,
      i = 0,
      r = { height: e };
    for (t = t ? 1 : 0; i < 4; i += 2 - t) (n = Be[i]), (r["margin" + n] = r["padding" + n] = e);
    return t && (r.opacity = r.width = e), r;
  }
  function B(e, t, n) {
    for (var i, r = (W.tweeners[t] || []).concat(W.tweeners["*"]), o = 0, a = r.length; o < a; o++)
      if ((i = r[o].call(n, t, e))) return i;
  }
  function H(e, t, n) {
    var i,
      r,
      o,
      a,
      s,
      l,
      u,
      c,
      f = "width" in t || "height" in t,
      d = this,
      p = {},
      h = e.style,
      m = e.nodeType && He(e),
      v = Oe.get(e, "fxshow");
    n.queue ||
      ((a = he._queueHooks(e, "fx")),
      null == a.unqueued &&
        ((a.unqueued = 0),
        (s = a.empty.fire),
        (a.empty.fire = function () {
          a.unqueued || s();
        })),
      a.unqueued++,
      d.always(function () {
        d.always(function () {
          a.unqueued--, he.queue(e, "fx").length || a.empty.fire();
        });
      }));
    for (i in t)
      if (((r = t[i]), mt.test(r))) {
        if ((delete t[i], (o = o || "toggle" === r), r === (m ? "hide" : "show"))) {
          if ("show" !== r || !v || void 0 === v[i]) continue;
          m = !0;
        }
        p[i] = (v && v[i]) || he.style(e, i);
      }
    if (((l = !he.isEmptyObject(t)), l || !he.isEmptyObject(p))) {
      f &&
        1 === e.nodeType &&
        ((n.overflow = [h.overflow, h.overflowX, h.overflowY]),
        (u = v && v.display),
        null == u && (u = Oe.get(e, "display")),
        (c = he.css(e, "display")),
        "none" === c && (u ? (c = u) : (g([e], !0), (u = e.style.display || u), (c = he.css(e, "display")), g([e]))),
        ("inline" === c || ("inline-block" === c && null != u)) &&
          "none" === he.css(e, "float") &&
          (l ||
            (d.done(function () {
              h.display = u;
            }),
            null == u && ((c = h.display), (u = "none" === c ? "" : c))),
          (h.display = "inline-block"))),
        n.overflow &&
          ((h.overflow = "hidden"),
          d.always(function () {
            (h.overflow = n.overflow[0]), (h.overflowX = n.overflow[1]), (h.overflowY = n.overflow[2]);
          })),
        (l = !1);
      for (i in p)
        l ||
          (v ? "hidden" in v && (m = v.hidden) : (v = Oe.access(e, "fxshow", { display: u })),
          o && (v.hidden = !m),
          m && g([e], !0),
          d.done(function () {
            m || g([e]), Oe.remove(e, "fxshow");
            for (i in p) he.style(e, i, p[i]);
          })),
          (l = B(m ? v[i] : 0, i, d)),
          i in v || ((v[i] = l.start), m && ((l.end = l.start), (l.start = 0)));
    }
  }
  function U(e, t) {
    var n, i, r, o, a;
    for (n in e)
      if (
        ((i = he.camelCase(n)),
        (r = t[i]),
        (o = e[n]),
        he.isArray(o) && ((r = o[1]), (o = e[n] = o[0])),
        n !== i && ((e[i] = o), delete e[n]),
        (a = he.cssHooks[i]),
        a && "expand" in a)
      ) {
        (o = a.expand(o)), delete e[i];
        for (n in o) n in e || ((e[n] = o[n]), (t[n] = r));
      } else t[i] = r;
  }
  function W(e, t, n) {
    var i,
      r,
      o = 0,
      a = W.prefilters.length,
      s = he.Deferred().always(function () {
        delete l.elem;
      }),
      l = function () {
        if (r) return !1;
        for (
          var t = pt || q(),
            n = Math.max(0, u.startTime + u.duration - t),
            i = n / u.duration || 0,
            o = 1 - i,
            a = 0,
            l = u.tweens.length;
          a < l;
          a++
        )
          u.tweens[a].run(o);
        return s.notifyWith(e, [u, o, n]), o < 1 && l ? n : (s.resolveWith(e, [u]), !1);
      },
      u = s.promise({
        elem: e,
        props: he.extend({}, t),
        opts: he.extend(!0, { specialEasing: {}, easing: he.easing._default }, n),
        originalProperties: t,
        originalOptions: n,
        startTime: pt || q(),
        duration: n.duration,
        tweens: [],
        createTween: function (t, n) {
          var i = he.Tween(e, u.opts, t, n, u.opts.specialEasing[t] || u.opts.easing);
          return u.tweens.push(i), i;
        },
        stop: function (t) {
          var n = 0,
            i = t ? u.tweens.length : 0;
          if (r) return this;
          for (r = !0; n < i; n++) u.tweens[n].run(1);
          return t ? (s.notifyWith(e, [u, 1, 0]), s.resolveWith(e, [u, t])) : s.rejectWith(e, [u, t]), this;
        },
      }),
      c = u.props;
    for (U(c, u.opts.specialEasing); o < a; o++)
      if ((i = W.prefilters[o].call(u, e, c, u.opts)))
        return he.isFunction(i.stop) && (he._queueHooks(u.elem, u.opts.queue).stop = he.proxy(i.stop, i)), i;
    return (
      he.map(c, B, u),
      he.isFunction(u.opts.start) && u.opts.start.call(e, u),
      he.fx.timer(he.extend(l, { elem: e, anim: u, queue: u.opts.queue })),
      u.progress(u.opts.progress).done(u.opts.done, u.opts.complete).fail(u.opts.fail).always(u.opts.always)
    );
  }
  function G(e) {
    var t = e.match(je) || [];
    return t.join(" ");
  }
  function $(e) {
    return (e.getAttribute && e.getAttribute("class")) || "";
  }
  function V(e, t, n, i) {
    var r;
    if (he.isArray(t))
      he.each(t, function (t, r) {
        n || Pt.test(e) ? i(e, r) : V(e + "[" + ("object" == typeof r && null != r ? t : "") + "]", r, n, i);
      });
    else if (n || "object" !== he.type(t)) i(e, t);
    else for (r in t) V(e + "[" + r + "]", t[r], n, i);
  }
  function K(e) {
    return function (t, n) {
      "string" != typeof t && ((n = t), (t = "*"));
      var i,
        r = 0,
        o = t.toLowerCase().match(je) || [];
      if (he.isFunction(n))
        for (; (i = o[r++]); )
          "+" === i[0] ? ((i = i.slice(1) || "*"), (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n);
    };
  }
  function X(e, t, n, i) {
    function r(s) {
      var l;
      return (
        (o[s] = !0),
        he.each(e[s] || [], function (e, s) {
          var u = s(t, n, i);
          return "string" != typeof u || a || o[u] ? (a ? !(l = u) : void 0) : (t.dataTypes.unshift(u), r(u), !1);
        }),
        l
      );
    }
    var o = {},
      a = e === Rt;
    return r(t.dataTypes[0]) || (!o["*"] && r("*"));
  }
  function Q(e, t) {
    var n,
      i,
      r = he.ajaxSettings.flatOptions || {};
    for (n in t) void 0 !== t[n] && ((r[n] ? e : i || (i = {}))[n] = t[n]);
    return i && he.extend(!0, e, i), e;
  }
  function Y(e, t, n) {
    for (var i, r, o, a, s = e.contents, l = e.dataTypes; "*" === l[0]; )
      l.shift(), void 0 === i && (i = e.mimeType || t.getResponseHeader("Content-Type"));
    if (i)
      for (r in s)
        if (s[r] && s[r].test(i)) {
          l.unshift(r);
          break;
        }
    if (l[0] in n) o = l[0];
    else {
      for (r in n) {
        if (!l[0] || e.converters[r + " " + l[0]]) {
          o = r;
          break;
        }
        a || (a = r);
      }
      o = o || a;
    }
    if (o) return o !== l[0] && l.unshift(o), n[o];
  }
  function J(e, t, n, i) {
    var r,
      o,
      a,
      s,
      l,
      u = {},
      c = e.dataTypes.slice();
    if (c[1]) for (a in e.converters) u[a.toLowerCase()] = e.converters[a];
    for (o = c.shift(); o; )
      if (
        (e.responseFields[o] && (n[e.responseFields[o]] = t),
        !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)),
        (l = o),
        (o = c.shift()))
      )
        if ("*" === o) o = l;
        else if ("*" !== l && l !== o) {
          if (((a = u[l + " " + o] || u["* " + o]), !a))
            for (r in u)
              if (((s = r.split(" ")), s[1] === o && (a = u[l + " " + s[0]] || u["* " + s[0]]))) {
                a === !0 ? (a = u[r]) : u[r] !== !0 && ((o = s[0]), c.unshift(s[1]));
                break;
              }
          if (a !== !0)
            if (a && e.throws) t = a(t);
            else
              try {
                t = a(t);
              } catch (e) {
                return { state: "parsererror", error: a ? e : "No conversion from " + l + " to " + o };
              }
        }
    return { state: "success", data: t };
  }
  function Z(e) {
    return he.isWindow(e) ? e : 9 === e.nodeType && e.defaultView;
  }
  var ee = [],
    te = e.document,
    ne = Object.getPrototypeOf,
    ie = ee.slice,
    re = ee.concat,
    oe = ee.push,
    ae = ee.indexOf,
    se = {},
    le = se.toString,
    ue = se.hasOwnProperty,
    ce = ue.toString,
    fe = ce.call(Object),
    de = {},
    pe = "3.1.1",
    he = function (e, t) {
      return new he.fn.init(e, t);
    },
    me = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
    ge = /^-ms-/,
    ve = /-([a-z])/g,
    ye = function (e, t) {
      return t.toUpperCase();
    };
  (he.fn = he.prototype = {
    jquery: pe,
    constructor: he,
    length: 0,
    toArray: function () {
      return ie.call(this);
    },
    get: function (e) {
      return null == e ? ie.call(this) : e < 0 ? this[e + this.length] : this[e];
    },
    pushStack: function (e) {
      var t = he.merge(this.constructor(), e);
      return (t.prevObject = this), t;
    },
    each: function (e) {
      return he.each(this, e);
    },
    map: function (e) {
      return this.pushStack(
        he.map(this, function (t, n) {
          return e.call(t, n, t);
        })
      );
    },
    slice: function () {
      return this.pushStack(ie.apply(this, arguments));
    },
    first: function () {
      return this.eq(0);
    },
    last: function () {
      return this.eq(-1);
    },
    eq: function (e) {
      var t = this.length,
        n = +e + (e < 0 ? t : 0);
      return this.pushStack(n >= 0 && n < t ? [this[n]] : []);
    },
    end: function () {
      return this.prevObject || this.constructor();
    },
    push: oe,
    sort: ee.sort,
    splice: ee.splice,
  }),
    (he.extend = he.fn.extend = function () {
      var e,
        t,
        n,
        i,
        r,
        o,
        a = arguments[0] || {},
        s = 1,
        l = arguments.length,
        u = !1;
      for (
        "boolean" == typeof a && ((u = a), (a = arguments[s] || {}), s++),
          "object" == typeof a || he.isFunction(a) || (a = {}),
          s === l && ((a = this), s--);
        s < l;
        s++
      )
        if (null != (e = arguments[s]))
          for (t in e)
            (n = a[t]),
              (i = e[t]),
              a !== i &&
                (u && i && (he.isPlainObject(i) || (r = he.isArray(i)))
                  ? (r ? ((r = !1), (o = n && he.isArray(n) ? n : [])) : (o = n && he.isPlainObject(n) ? n : {}),
                    (a[t] = he.extend(u, o, i)))
                  : void 0 !== i && (a[t] = i));
      return a;
    }),
    he.extend({
      expando: "jQuery" + (pe + Math.random()).replace(/\D/g, ""),
      isReady: !0,
      error: function (e) {
        throw new Error(e);
      },
      noop: function () {},
      isFunction: function (e) {
        return "function" === he.type(e);
      },
      isArray: Array.isArray,
      isWindow: function (e) {
        return null != e && e === e.window;
      },
      isNumeric: function (e) {
        var t = he.type(e);
        return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e));
      },
      isPlainObject: function (e) {
        var t, n;
        return !(
          !e ||
          "[object Object]" !== le.call(e) ||
          ((t = ne(e)) &&
            ((n = ue.call(t, "constructor") && t.constructor), "function" != typeof n || ce.call(n) !== fe))
        );
      },
      isEmptyObject: function (e) {
        var t;
        for (t in e) return !1;
        return !0;
      },
      type: function (e) {
        return null == e
          ? e + ""
          : "object" == typeof e || "function" == typeof e
          ? se[le.call(e)] || "object"
          : typeof e;
      },
      globalEval: function (e) {
        n(e);
      },
      camelCase: function (e) {
        return e.replace(ge, "ms-").replace(ve, ye);
      },
      nodeName: function (e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase();
      },
      each: function (e, t) {
        var n,
          r = 0;
        if (i(e)) for (n = e.length; r < n && t.call(e[r], r, e[r]) !== !1; r++);
        else for (r in e) if (t.call(e[r], r, e[r]) === !1) break;
        return e;
      },
      trim: function (e) {
        return null == e ? "" : (e + "").replace(me, "");
      },
      makeArray: function (e, t) {
        var n = t || [];
        return null != e && (i(Object(e)) ? he.merge(n, "string" == typeof e ? [e] : e) : oe.call(n, e)), n;
      },
      inArray: function (e, t, n) {
        return null == t ? -1 : ae.call(t, e, n);
      },
      merge: function (e, t) {
        for (var n = +t.length, i = 0, r = e.length; i < n; i++) e[r++] = t[i];
        return (e.length = r), e;
      },
      grep: function (e, t, n) {
        for (var i, r = [], o = 0, a = e.length, s = !n; o < a; o++) (i = !t(e[o], o)), i !== s && r.push(e[o]);
        return r;
      },
      map: function (e, t, n) {
        var r,
          o,
          a = 0,
          s = [];
        if (i(e)) for (r = e.length; a < r; a++) (o = t(e[a], a, n)), null != o && s.push(o);
        else for (a in e) (o = t(e[a], a, n)), null != o && s.push(o);
        return re.apply([], s);
      },
      guid: 1,
      proxy: function (e, t) {
        var n, i, r;
        if (("string" == typeof t && ((n = e[t]), (t = e), (e = n)), he.isFunction(e)))
          return (
            (i = ie.call(arguments, 2)),
            (r = function () {
              return e.apply(t || this, i.concat(ie.call(arguments)));
            }),
            (r.guid = e.guid = e.guid || he.guid++),
            r
          );
      },
      now: Date.now,
      support: de,
    }),
    "function" == typeof Symbol && (he.fn[Symbol.iterator] = ee[Symbol.iterator]),
    he.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
      se["[object " + t + "]"] = t.toLowerCase();
    });
  var xe = (function (e) {
    function t(e, t, n, i) {
      var r,
        o,
        a,
        s,
        l,
        u,
        c,
        d = t && t.ownerDocument,
        h = t ? t.nodeType : 9;
      if (((n = n || []), "string" != typeof e || !e || (1 !== h && 9 !== h && 11 !== h))) return n;
      if (!i && ((t ? t.ownerDocument || t : B) !== L && _(t), (t = t || L), O)) {
        if (11 !== h && (l = ve.exec(e)))
          if ((r = l[1])) {
            if (9 === h) {
              if (!(a = t.getElementById(r))) return n;
              if (a.id === r) return n.push(a), n;
            } else if (d && (a = d.getElementById(r)) && q(t, a) && a.id === r) return n.push(a), n;
          } else {
            if (l[2]) return J.apply(n, t.getElementsByTagName(e)), n;
            if ((r = l[3]) && w.getElementsByClassName && t.getElementsByClassName)
              return J.apply(n, t.getElementsByClassName(r)), n;
          }
        if (w.qsa && !$[e + " "] && (!I || !I.test(e))) {
          if (1 !== h) (d = t), (c = e);
          else if ("object" !== t.nodeName.toLowerCase()) {
            for (
              (s = t.getAttribute("id")) ? (s = s.replace(ke, we)) : t.setAttribute("id", (s = z)),
                u = P(e),
                o = u.length;
              o--;

            )
              u[o] = "#" + s + " " + p(u[o]);
            (c = u.join(",")), (d = (ye.test(e) && f(t.parentNode)) || t);
          }
          if (c)
            try {
              return J.apply(n, d.querySelectorAll(c)), n;
            } catch (e) {
            } finally {
              s === z && t.removeAttribute("id");
            }
        }
      }
      return D(e.replace(se, "$1"), t, n, i);
    }
    function n() {
      function e(n, i) {
        return t.push(n + " ") > S.cacheLength && delete e[t.shift()], (e[n + " "] = i);
      }
      var t = [];
      return e;
    }
    function i(e) {
      return (e[z] = !0), e;
    }
    function r(e) {
      var t = L.createElement("fieldset");
      try {
        return !!e(t);
      } catch (e) {
        return !1;
      } finally {
        t.parentNode && t.parentNode.removeChild(t), (t = null);
      }
    }
    function o(e, t) {
      for (var n = e.split("|"), i = n.length; i--; ) S.attrHandle[n[i]] = t;
    }
    function a(e, t) {
      var n = t && e,
        i = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
      if (i) return i;
      if (n) for (; (n = n.nextSibling); ) if (n === t) return -1;
      return e ? 1 : -1;
    }
    function s(e) {
      return function (t) {
        var n = t.nodeName.toLowerCase();
        return "input" === n && t.type === e;
      };
    }
    function l(e) {
      return function (t) {
        var n = t.nodeName.toLowerCase();
        return ("input" === n || "button" === n) && t.type === e;
      };
    }
    function u(e) {
      return function (t) {
        return "form" in t
          ? t.parentNode && t.disabled === !1
            ? "label" in t
              ? "label" in t.parentNode
                ? t.parentNode.disabled === e
                : t.disabled === e
              : t.isDisabled === e || (t.isDisabled !== !e && Ee(t) === e)
            : t.disabled === e
          : "label" in t && t.disabled === e;
      };
    }
    function c(e) {
      return i(function (t) {
        return (
          (t = +t),
          i(function (n, i) {
            for (var r, o = e([], n.length, t), a = o.length; a--; ) n[(r = o[a])] && (n[r] = !(i[r] = n[r]));
          })
        );
      });
    }
    function f(e) {
      return e && "undefined" != typeof e.getElementsByTagName && e;
    }
    function d() {}
    function p(e) {
      for (var t = 0, n = e.length, i = ""; t < n; t++) i += e[t].value;
      return i;
    }
    function h(e, t, n) {
      var i = t.dir,
        r = t.next,
        o = r || i,
        a = n && "parentNode" === o,
        s = U++;
      return t.first
        ? function (t, n, r) {
            for (; (t = t[i]); ) if (1 === t.nodeType || a) return e(t, n, r);
            return !1;
          }
        : function (t, n, l) {
            var u,
              c,
              f,
              d = [H, s];
            if (l) {
              for (; (t = t[i]); ) if ((1 === t.nodeType || a) && e(t, n, l)) return !0;
            } else
              for (; (t = t[i]); )
                if (1 === t.nodeType || a)
                  if (
                    ((f = t[z] || (t[z] = {})),
                    (c = f[t.uniqueID] || (f[t.uniqueID] = {})),
                    r && r === t.nodeName.toLowerCase())
                  )
                    t = t[i] || t;
                  else {
                    if ((u = c[o]) && u[0] === H && u[1] === s) return (d[2] = u[2]);
                    if (((c[o] = d), (d[2] = e(t, n, l)))) return !0;
                  }
            return !1;
          };
    }
    function m(e) {
      return e.length > 1
        ? function (t, n, i) {
            for (var r = e.length; r--; ) if (!e[r](t, n, i)) return !1;
            return !0;
          }
        : e[0];
    }
    function g(e, n, i) {
      for (var r = 0, o = n.length; r < o; r++) t(e, n[r], i);
      return i;
    }
    function v(e, t, n, i, r) {
      for (var o, a = [], s = 0, l = e.length, u = null != t; s < l; s++)
        (o = e[s]) && ((n && !n(o, i, r)) || (a.push(o), u && t.push(s)));
      return a;
    }
    function y(e, t, n, r, o, a) {
      return (
        r && !r[z] && (r = y(r)),
        o && !o[z] && (o = y(o, a)),
        i(function (i, a, s, l) {
          var u,
            c,
            f,
            d = [],
            p = [],
            h = a.length,
            m = i || g(t || "*", s.nodeType ? [s] : s, []),
            y = !e || (!i && t) ? m : v(m, d, e, s, l),
            x = n ? (o || (i ? e : h || r) ? [] : a) : y;
          if ((n && n(y, x, s, l), r))
            for (u = v(x, p), r(u, [], s, l), c = u.length; c--; ) (f = u[c]) && (x[p[c]] = !(y[p[c]] = f));
          if (i) {
            if (o || e) {
              if (o) {
                for (u = [], c = x.length; c--; ) (f = x[c]) && u.push((y[c] = f));
                o(null, (x = []), u, l);
              }
              for (c = x.length; c--; ) (f = x[c]) && (u = o ? ee(i, f) : d[c]) > -1 && (i[u] = !(a[u] = f));
            }
          } else (x = v(x === a ? x.splice(h, x.length) : x)), o ? o(null, a, x, l) : J.apply(a, x);
        })
      );
    }
    function x(e) {
      for (
        var t,
          n,
          i,
          r = e.length,
          o = S.relative[e[0].type],
          a = o || S.relative[" "],
          s = o ? 1 : 0,
          l = h(
            function (e) {
              return e === t;
            },
            a,
            !0
          ),
          u = h(
            function (e) {
              return ee(t, e) > -1;
            },
            a,
            !0
          ),
          c = [
            function (e, n, i) {
              var r = (!o && (i || n !== T)) || ((t = n).nodeType ? l(e, n, i) : u(e, n, i));
              return (t = null), r;
            },
          ];
        s < r;
        s++
      )
        if ((n = S.relative[e[s].type])) c = [h(m(c), n)];
        else {
          if (((n = S.filter[e[s].type].apply(null, e[s].matches)), n[z])) {
            for (i = ++s; i < r && !S.relative[e[i].type]; i++);
            return y(
              s > 1 && m(c),
              s > 1 && p(e.slice(0, s - 1).concat({ value: " " === e[s - 2].type ? "*" : "" })).replace(se, "$1"),
              n,
              s < i && x(e.slice(s, i)),
              i < r && x((e = e.slice(i))),
              i < r && p(e)
            );
          }
          c.push(n);
        }
      return m(c);
    }
    function b(e, n) {
      var r = n.length > 0,
        o = e.length > 0,
        a = function (i, a, s, l, u) {
          var c,
            f,
            d,
            p = 0,
            h = "0",
            m = i && [],
            g = [],
            y = T,
            x = i || (o && S.find.TAG("*", u)),
            b = (H += null == y ? 1 : Math.random() || 0.1),
            k = x.length;
          for (u && (T = a === L || a || u); h !== k && null != (c = x[h]); h++) {
            if (o && c) {
              for (f = 0, a || c.ownerDocument === L || (_(c), (s = !O)); (d = e[f++]); )
                if (d(c, a || L, s)) {
                  l.push(c);
                  break;
                }
              u && (H = b);
            }
            r && ((c = !d && c) && p--, i && m.push(c));
          }
          if (((p += h), r && h !== p)) {
            for (f = 0; (d = n[f++]); ) d(m, g, a, s);
            if (i) {
              if (p > 0) for (; h--; ) m[h] || g[h] || (g[h] = Q.call(l));
              g = v(g);
            }
            J.apply(l, g), u && !i && g.length > 0 && p + n.length > 1 && t.uniqueSort(l);
          }
          return u && ((H = b), (T = y)), m;
        };
      return r ? i(a) : a;
    }
    var k,
      w,
      S,
      E,
      C,
      P,
      A,
      D,
      T,
      j,
      N,
      _,
      L,
      M,
      O,
      I,
      F,
      R,
      q,
      z = "sizzle" + 1 * new Date(),
      B = e.document,
      H = 0,
      U = 0,
      W = n(),
      G = n(),
      $ = n(),
      V = function (e, t) {
        return e === t && (N = !0), 0;
      },
      K = {}.hasOwnProperty,
      X = [],
      Q = X.pop,
      Y = X.push,
      J = X.push,
      Z = X.slice,
      ee = function (e, t) {
        for (var n = 0, i = e.length; n < i; n++) if (e[n] === t) return n;
        return -1;
      },
      te =
        "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
      ne = "[\\x20\\t\\r\\n\\f]",
      ie = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
      re =
        "\\[" +
        ne +
        "*(" +
        ie +
        ")(?:" +
        ne +
        "*([*^$|!~]?=)" +
        ne +
        "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" +
        ie +
        "))|)" +
        ne +
        "*\\]",
      oe =
        ":(" +
        ie +
        ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" +
        re +
        ")*)|.*)\\)|)",
      ae = new RegExp(ne + "+", "g"),
      se = new RegExp("^" + ne + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ne + "+$", "g"),
      le = new RegExp("^" + ne + "*," + ne + "*"),
      ue = new RegExp("^" + ne + "*([>+~]|" + ne + ")" + ne + "*"),
      ce = new RegExp("=" + ne + "*([^\\]'\"]*?)" + ne + "*\\]", "g"),
      fe = new RegExp(oe),
      de = new RegExp("^" + ie + "$"),
      pe = {
        ID: new RegExp("^#(" + ie + ")"),
        CLASS: new RegExp("^\\.(" + ie + ")"),
        TAG: new RegExp("^(" + ie + "|[*])"),
        ATTR: new RegExp("^" + re),
        PSEUDO: new RegExp("^" + oe),
        CHILD: new RegExp(
          "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" +
            ne +
            "*(even|odd|(([+-]|)(\\d*)n|)" +
            ne +
            "*(?:([+-]|)" +
            ne +
            "*(\\d+)|))" +
            ne +
            "*\\)|)",
          "i"
        ),
        bool: new RegExp("^(?:" + te + ")$", "i"),
        needsContext: new RegExp(
          "^" +
            ne +
            "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
            ne +
            "*((?:-\\d)?\\d*)" +
            ne +
            "*\\)|)(?=[^-]|$)",
          "i"
        ),
      },
      he = /^(?:input|select|textarea|button)$/i,
      me = /^h\d$/i,
      ge = /^[^{]+\{\s*\[native \w/,
      ve = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
      ye = /[+~]/,
      xe = new RegExp("\\\\([\\da-f]{1,6}" + ne + "?|(" + ne + ")|.)", "ig"),
      be = function (e, t, n) {
        var i = "0x" + t - 65536;
        return i !== i || n
          ? t
          : i < 0
          ? String.fromCharCode(i + 65536)
          : String.fromCharCode((i >> 10) | 55296, (1023 & i) | 56320);
      },
      ke = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
      we = function (e, t) {
        return t
          ? "\0" === e
            ? "�"
            : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " "
          : "\\" + e;
      },
      Se = function () {
        _();
      },
      Ee = h(
        function (e) {
          return e.disabled === !0 && ("form" in e || "label" in e);
        },
        { dir: "parentNode", next: "legend" }
      );
    try {
      J.apply((X = Z.call(B.childNodes)), B.childNodes), X[B.childNodes.length].nodeType;
    } catch (e) {
      J = {
        apply: X.length
          ? function (e, t) {
              Y.apply(e, Z.call(t));
            }
          : function (e, t) {
              for (var n = e.length, i = 0; (e[n++] = t[i++]); );
              e.length = n - 1;
            },
      };
    }
    (w = t.support = {}),
      (C = t.isXML = function (e) {
        var t = e && (e.ownerDocument || e).documentElement;
        return !!t && "HTML" !== t.nodeName;
      }),
      (_ = t.setDocument = function (e) {
        var t,
          n,
          i = e ? e.ownerDocument || e : B;
        return i !== L && 9 === i.nodeType && i.documentElement
          ? ((L = i),
            (M = L.documentElement),
            (O = !C(L)),
            B !== L &&
              (n = L.defaultView) &&
              n.top !== n &&
              (n.addEventListener
                ? n.addEventListener("unload", Se, !1)
                : n.attachEvent && n.attachEvent("onunload", Se)),
            (w.attributes = r(function (e) {
              return (e.className = "i"), !e.getAttribute("className");
            })),
            (w.getElementsByTagName = r(function (e) {
              return e.appendChild(L.createComment("")), !e.getElementsByTagName("*").length;
            })),
            (w.getElementsByClassName = ge.test(L.getElementsByClassName)),
            (w.getById = r(function (e) {
              return (M.appendChild(e).id = z), !L.getElementsByName || !L.getElementsByName(z).length;
            })),
            w.getById
              ? ((S.filter.ID = function (e) {
                  var t = e.replace(xe, be);
                  return function (e) {
                    return e.getAttribute("id") === t;
                  };
                }),
                (S.find.ID = function (e, t) {
                  if ("undefined" != typeof t.getElementById && O) {
                    var n = t.getElementById(e);
                    return n ? [n] : [];
                  }
                }))
              : ((S.filter.ID = function (e) {
                  var t = e.replace(xe, be);
                  return function (e) {
                    var n = "undefined" != typeof e.getAttributeNode && e.getAttributeNode("id");
                    return n && n.value === t;
                  };
                }),
                (S.find.ID = function (e, t) {
                  if ("undefined" != typeof t.getElementById && O) {
                    var n,
                      i,
                      r,
                      o = t.getElementById(e);
                    if (o) {
                      if (((n = o.getAttributeNode("id")), n && n.value === e)) return [o];
                      for (r = t.getElementsByName(e), i = 0; (o = r[i++]); )
                        if (((n = o.getAttributeNode("id")), n && n.value === e)) return [o];
                    }
                    return [];
                  }
                })),
            (S.find.TAG = w.getElementsByTagName
              ? function (e, t) {
                  return "undefined" != typeof t.getElementsByTagName
                    ? t.getElementsByTagName(e)
                    : w.qsa
                    ? t.querySelectorAll(e)
                    : void 0;
                }
              : function (e, t) {
                  var n,
                    i = [],
                    r = 0,
                    o = t.getElementsByTagName(e);
                  if ("*" === e) {
                    for (; (n = o[r++]); ) 1 === n.nodeType && i.push(n);
                    return i;
                  }
                  return o;
                }),
            (S.find.CLASS =
              w.getElementsByClassName &&
              function (e, t) {
                if ("undefined" != typeof t.getElementsByClassName && O) return t.getElementsByClassName(e);
              }),
            (F = []),
            (I = []),
            (w.qsa = ge.test(L.querySelectorAll)) &&
              (r(function (e) {
                (M.appendChild(e).innerHTML =
                  "<a id='" +
                  z +
                  "'></a><select id='" +
                  z +
                  "-\r\\' msallowcapture=''><option selected=''></option></select>"),
                  e.querySelectorAll("[msallowcapture^='']").length && I.push("[*^$]=" + ne + "*(?:''|\"\")"),
                  e.querySelectorAll("[selected]").length || I.push("\\[" + ne + "*(?:value|" + te + ")"),
                  e.querySelectorAll("[id~=" + z + "-]").length || I.push("~="),
                  e.querySelectorAll(":checked").length || I.push(":checked"),
                  e.querySelectorAll("a#" + z + "+*").length || I.push(".#.+[+~]");
              }),
              r(function (e) {
                e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                var t = L.createElement("input");
                t.setAttribute("type", "hidden"),
                  e.appendChild(t).setAttribute("name", "D"),
                  e.querySelectorAll("[name=d]").length && I.push("name" + ne + "*[*^$|!~]?="),
                  2 !== e.querySelectorAll(":enabled").length && I.push(":enabled", ":disabled"),
                  (M.appendChild(e).disabled = !0),
                  2 !== e.querySelectorAll(":disabled").length && I.push(":enabled", ":disabled"),
                  e.querySelectorAll("*,:x"),
                  I.push(",.*:");
              })),
            (w.matchesSelector = ge.test(
              (R =
                M.matches ||
                M.webkitMatchesSelector ||
                M.mozMatchesSelector ||
                M.oMatchesSelector ||
                M.msMatchesSelector)
            )) &&
              r(function (e) {
                (w.disconnectedMatch = R.call(e, "*")), R.call(e, "[s!='']:x"), F.push("!=", oe);
              }),
            (I = I.length && new RegExp(I.join("|"))),
            (F = F.length && new RegExp(F.join("|"))),
            (t = ge.test(M.compareDocumentPosition)),
            (q =
              t || ge.test(M.contains)
                ? function (e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e,
                      i = t && t.parentNode;
                    return (
                      e === i ||
                      !(
                        !i ||
                        1 !== i.nodeType ||
                        !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i))
                      )
                    );
                  }
                : function (e, t) {
                    if (t) for (; (t = t.parentNode); ) if (t === e) return !0;
                    return !1;
                  }),
            (V = t
              ? function (e, t) {
                  if (e === t) return (N = !0), 0;
                  var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                  return n
                    ? n
                    : ((n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1),
                      1 & n || (!w.sortDetached && t.compareDocumentPosition(e) === n)
                        ? e === L || (e.ownerDocument === B && q(B, e))
                          ? -1
                          : t === L || (t.ownerDocument === B && q(B, t))
                          ? 1
                          : j
                          ? ee(j, e) - ee(j, t)
                          : 0
                        : 4 & n
                        ? -1
                        : 1);
                }
              : function (e, t) {
                  if (e === t) return (N = !0), 0;
                  var n,
                    i = 0,
                    r = e.parentNode,
                    o = t.parentNode,
                    s = [e],
                    l = [t];
                  if (!r || !o) return e === L ? -1 : t === L ? 1 : r ? -1 : o ? 1 : j ? ee(j, e) - ee(j, t) : 0;
                  if (r === o) return a(e, t);
                  for (n = e; (n = n.parentNode); ) s.unshift(n);
                  for (n = t; (n = n.parentNode); ) l.unshift(n);
                  for (; s[i] === l[i]; ) i++;
                  return i ? a(s[i], l[i]) : s[i] === B ? -1 : l[i] === B ? 1 : 0;
                }),
            L)
          : L;
      }),
      (t.matches = function (e, n) {
        return t(e, null, null, n);
      }),
      (t.matchesSelector = function (e, n) {
        if (
          ((e.ownerDocument || e) !== L && _(e),
          (n = n.replace(ce, "='$1']")),
          w.matchesSelector && O && !$[n + " "] && (!F || !F.test(n)) && (!I || !I.test(n)))
        )
          try {
            var i = R.call(e, n);
            if (i || w.disconnectedMatch || (e.document && 11 !== e.document.nodeType)) return i;
          } catch (e) {}
        return t(n, L, null, [e]).length > 0;
      }),
      (t.contains = function (e, t) {
        return (e.ownerDocument || e) !== L && _(e), q(e, t);
      }),
      (t.attr = function (e, t) {
        (e.ownerDocument || e) !== L && _(e);
        var n = S.attrHandle[t.toLowerCase()],
          i = n && K.call(S.attrHandle, t.toLowerCase()) ? n(e, t, !O) : void 0;
        return void 0 !== i
          ? i
          : w.attributes || !O
          ? e.getAttribute(t)
          : (i = e.getAttributeNode(t)) && i.specified
          ? i.value
          : null;
      }),
      (t.escape = function (e) {
        return (e + "").replace(ke, we);
      }),
      (t.error = function (e) {
        throw new Error("Syntax error, unrecognized expression: " + e);
      }),
      (t.uniqueSort = function (e) {
        var t,
          n = [],
          i = 0,
          r = 0;
        if (((N = !w.detectDuplicates), (j = !w.sortStable && e.slice(0)), e.sort(V), N)) {
          for (; (t = e[r++]); ) t === e[r] && (i = n.push(r));
          for (; i--; ) e.splice(n[i], 1);
        }
        return (j = null), e;
      }),
      (E = t.getText = function (e) {
        var t,
          n = "",
          i = 0,
          r = e.nodeType;
        if (r) {
          if (1 === r || 9 === r || 11 === r) {
            if ("string" == typeof e.textContent) return e.textContent;
            for (e = e.firstChild; e; e = e.nextSibling) n += E(e);
          } else if (3 === r || 4 === r) return e.nodeValue;
        } else for (; (t = e[i++]); ) n += E(t);
        return n;
      }),
      (S = t.selectors = {
        cacheLength: 50,
        createPseudo: i,
        match: pe,
        attrHandle: {},
        find: {},
        relative: {
          ">": { dir: "parentNode", first: !0 },
          " ": { dir: "parentNode" },
          "+": { dir: "previousSibling", first: !0 },
          "~": { dir: "previousSibling" },
        },
        preFilter: {
          ATTR: function (e) {
            return (
              (e[1] = e[1].replace(xe, be)),
              (e[3] = (e[3] || e[4] || e[5] || "").replace(xe, be)),
              "~=" === e[2] && (e[3] = " " + e[3] + " "),
              e.slice(0, 4)
            );
          },
          CHILD: function (e) {
            return (
              (e[1] = e[1].toLowerCase()),
              "nth" === e[1].slice(0, 3)
                ? (e[3] || t.error(e[0]),
                  (e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3]))),
                  (e[5] = +(e[7] + e[8] || "odd" === e[3])))
                : e[3] && t.error(e[0]),
              e
            );
          },
          PSEUDO: function (e) {
            var t,
              n = !e[6] && e[2];
            return pe.CHILD.test(e[0])
              ? null
              : (e[3]
                  ? (e[2] = e[4] || e[5] || "")
                  : n &&
                    fe.test(n) &&
                    (t = P(n, !0)) &&
                    (t = n.indexOf(")", n.length - t) - n.length) &&
                    ((e[0] = e[0].slice(0, t)), (e[2] = n.slice(0, t))),
                e.slice(0, 3));
          },
        },
        filter: {
          TAG: function (e) {
            var t = e.replace(xe, be).toLowerCase();
            return "*" === e
              ? function () {
                  return !0;
                }
              : function (e) {
                  return e.nodeName && e.nodeName.toLowerCase() === t;
                };
          },
          CLASS: function (e) {
            var t = W[e + " "];
            return (
              t ||
              ((t = new RegExp("(^|" + ne + ")" + e + "(" + ne + "|$)")) &&
                W(e, function (e) {
                  return t.test(
                    ("string" == typeof e.className && e.className) ||
                      ("undefined" != typeof e.getAttribute && e.getAttribute("class")) ||
                      ""
                  );
                }))
            );
          },
          ATTR: function (e, n, i) {
            return function (r) {
              var o = t.attr(r, e);
              return null == o
                ? "!=" === n
                : !n ||
                    ((o += ""),
                    "=" === n
                      ? o === i
                      : "!=" === n
                      ? o !== i
                      : "^=" === n
                      ? i && 0 === o.indexOf(i)
                      : "*=" === n
                      ? i && o.indexOf(i) > -1
                      : "$=" === n
                      ? i && o.slice(-i.length) === i
                      : "~=" === n
                      ? (" " + o.replace(ae, " ") + " ").indexOf(i) > -1
                      : "|=" === n && (o === i || o.slice(0, i.length + 1) === i + "-"));
            };
          },
          CHILD: function (e, t, n, i, r) {
            var o = "nth" !== e.slice(0, 3),
              a = "last" !== e.slice(-4),
              s = "of-type" === t;
            return 1 === i && 0 === r
              ? function (e) {
                  return !!e.parentNode;
                }
              : function (t, n, l) {
                  var u,
                    c,
                    f,
                    d,
                    p,
                    h,
                    m = o !== a ? "nextSibling" : "previousSibling",
                    g = t.parentNode,
                    v = s && t.nodeName.toLowerCase(),
                    y = !l && !s,
                    x = !1;
                  if (g) {
                    if (o) {
                      for (; m; ) {
                        for (d = t; (d = d[m]); ) if (s ? d.nodeName.toLowerCase() === v : 1 === d.nodeType) return !1;
                        h = m = "only" === e && !h && "nextSibling";
                      }
                      return !0;
                    }
                    if (((h = [a ? g.firstChild : g.lastChild]), a && y)) {
                      for (
                        d = g,
                          f = d[z] || (d[z] = {}),
                          c = f[d.uniqueID] || (f[d.uniqueID] = {}),
                          u = c[e] || [],
                          p = u[0] === H && u[1],
                          x = p && u[2],
                          d = p && g.childNodes[p];
                        (d = (++p && d && d[m]) || (x = p = 0) || h.pop());

                      )
                        if (1 === d.nodeType && ++x && d === t) {
                          c[e] = [H, p, x];
                          break;
                        }
                    } else if (
                      (y &&
                        ((d = t),
                        (f = d[z] || (d[z] = {})),
                        (c = f[d.uniqueID] || (f[d.uniqueID] = {})),
                        (u = c[e] || []),
                        (p = u[0] === H && u[1]),
                        (x = p)),
                      x === !1)
                    )
                      for (
                        ;
                        (d = (++p && d && d[m]) || (x = p = 0) || h.pop()) &&
                        ((s ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) ||
                          !++x ||
                          (y &&
                            ((f = d[z] || (d[z] = {})), (c = f[d.uniqueID] || (f[d.uniqueID] = {})), (c[e] = [H, x])),
                          d !== t));

                      );
                    return (x -= r), x === i || (x % i === 0 && x / i >= 0);
                  }
                };
          },
          PSEUDO: function (e, n) {
            var r,
              o = S.pseudos[e] || S.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
            return o[z]
              ? o(n)
              : o.length > 1
              ? ((r = [e, e, "", n]),
                S.setFilters.hasOwnProperty(e.toLowerCase())
                  ? i(function (e, t) {
                      for (var i, r = o(e, n), a = r.length; a--; ) (i = ee(e, r[a])), (e[i] = !(t[i] = r[a]));
                    })
                  : function (e) {
                      return o(e, 0, r);
                    })
              : o;
          },
        },
        pseudos: {
          not: i(function (e) {
            var t = [],
              n = [],
              r = A(e.replace(se, "$1"));
            return r[z]
              ? i(function (e, t, n, i) {
                  for (var o, a = r(e, null, i, []), s = e.length; s--; ) (o = a[s]) && (e[s] = !(t[s] = o));
                })
              : function (e, i, o) {
                  return (t[0] = e), r(t, null, o, n), (t[0] = null), !n.pop();
                };
          }),
          has: i(function (e) {
            return function (n) {
              return t(e, n).length > 0;
            };
          }),
          contains: i(function (e) {
            return (
              (e = e.replace(xe, be)),
              function (t) {
                return (t.textContent || t.innerText || E(t)).indexOf(e) > -1;
              }
            );
          }),
          lang: i(function (e) {
            return (
              de.test(e || "") || t.error("unsupported lang: " + e),
              (e = e.replace(xe, be).toLowerCase()),
              function (t) {
                var n;
                do
                  if ((n = O ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")))
                    return (n = n.toLowerCase()), n === e || 0 === n.indexOf(e + "-");
                while ((t = t.parentNode) && 1 === t.nodeType);
                return !1;
              }
            );
          }),
          target: function (t) {
            var n = e.location && e.location.hash;
            return n && n.slice(1) === t.id;
          },
          root: function (e) {
            return e === M;
          },
          focus: function (e) {
            return e === L.activeElement && (!L.hasFocus || L.hasFocus()) && !!(e.type || e.href || ~e.tabIndex);
          },
          enabled: u(!1),
          disabled: u(!0),
          checked: function (e) {
            var t = e.nodeName.toLowerCase();
            return ("input" === t && !!e.checked) || ("option" === t && !!e.selected);
          },
          selected: function (e) {
            return e.parentNode && e.parentNode.selectedIndex, e.selected === !0;
          },
          empty: function (e) {
            for (e = e.firstChild; e; e = e.nextSibling) if (e.nodeType < 6) return !1;
            return !0;
          },
          parent: function (e) {
            return !S.pseudos.empty(e);
          },
          header: function (e) {
            return me.test(e.nodeName);
          },
          input: function (e) {
            return he.test(e.nodeName);
          },
          button: function (e) {
            var t = e.nodeName.toLowerCase();
            return ("input" === t && "button" === e.type) || "button" === t;
          },
          text: function (e) {
            var t;
            return (
              "input" === e.nodeName.toLowerCase() &&
              "text" === e.type &&
              (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
            );
          },
          first: c(function () {
            return [0];
          }),
          last: c(function (e, t) {
            return [t - 1];
          }),
          eq: c(function (e, t, n) {
            return [n < 0 ? n + t : n];
          }),
          even: c(function (e, t) {
            for (var n = 0; n < t; n += 2) e.push(n);
            return e;
          }),
          odd: c(function (e, t) {
            for (var n = 1; n < t; n += 2) e.push(n);
            return e;
          }),
          lt: c(function (e, t, n) {
            for (var i = n < 0 ? n + t : n; --i >= 0; ) e.push(i);
            return e;
          }),
          gt: c(function (e, t, n) {
            for (var i = n < 0 ? n + t : n; ++i < t; ) e.push(i);
            return e;
          }),
        },
      }),
      (S.pseudos.nth = S.pseudos.eq);
    for (k in { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }) S.pseudos[k] = s(k);
    for (k in { submit: !0, reset: !0 }) S.pseudos[k] = l(k);
    return (
      (d.prototype = S.filters = S.pseudos),
      (S.setFilters = new d()),
      (P = t.tokenize = function (e, n) {
        var i,
          r,
          o,
          a,
          s,
          l,
          u,
          c = G[e + " "];
        if (c) return n ? 0 : c.slice(0);
        for (s = e, l = [], u = S.preFilter; s; ) {
          (i && !(r = le.exec(s))) || (r && (s = s.slice(r[0].length) || s), l.push((o = []))),
            (i = !1),
            (r = ue.exec(s)) &&
              ((i = r.shift()), o.push({ value: i, type: r[0].replace(se, " ") }), (s = s.slice(i.length)));
          for (a in S.filter)
            !(r = pe[a].exec(s)) ||
              (u[a] && !(r = u[a](r))) ||
              ((i = r.shift()), o.push({ value: i, type: a, matches: r }), (s = s.slice(i.length)));
          if (!i) break;
        }
        return n ? s.length : s ? t.error(e) : G(e, l).slice(0);
      }),
      (A = t.compile = function (e, t) {
        var n,
          i = [],
          r = [],
          o = $[e + " "];
        if (!o) {
          for (t || (t = P(e)), n = t.length; n--; ) (o = x(t[n])), o[z] ? i.push(o) : r.push(o);
          (o = $(e, b(r, i))), (o.selector = e);
        }
        return o;
      }),
      (D = t.select = function (e, t, n, i) {
        var r,
          o,
          a,
          s,
          l,
          u = "function" == typeof e && e,
          c = !i && P((e = u.selector || e));
        if (((n = n || []), 1 === c.length)) {
          if (
            ((o = c[0] = c[0].slice(0)),
            o.length > 2 && "ID" === (a = o[0]).type && 9 === t.nodeType && O && S.relative[o[1].type])
          ) {
            if (((t = (S.find.ID(a.matches[0].replace(xe, be), t) || [])[0]), !t)) return n;
            u && (t = t.parentNode), (e = e.slice(o.shift().value.length));
          }
          for (r = pe.needsContext.test(e) ? 0 : o.length; r-- && ((a = o[r]), !S.relative[(s = a.type)]); )
            if (
              (l = S.find[s]) &&
              (i = l(a.matches[0].replace(xe, be), (ye.test(o[0].type) && f(t.parentNode)) || t))
            ) {
              if ((o.splice(r, 1), (e = i.length && p(o)), !e)) return J.apply(n, i), n;
              break;
            }
        }
        return (u || A(e, c))(i, t, !O, n, !t || (ye.test(e) && f(t.parentNode)) || t), n;
      }),
      (w.sortStable = z.split("").sort(V).join("") === z),
      (w.detectDuplicates = !!N),
      _(),
      (w.sortDetached = r(function (e) {
        return 1 & e.compareDocumentPosition(L.createElement("fieldset"));
      })),
      r(function (e) {
        return (e.innerHTML = "<a href='#'></a>"), "#" === e.firstChild.getAttribute("href");
      }) ||
        o("type|href|height|width", function (e, t, n) {
          if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2);
        }),
      (w.attributes &&
        r(function (e) {
          return (
            (e.innerHTML = "<input/>"),
            e.firstChild.setAttribute("value", ""),
            "" === e.firstChild.getAttribute("value")
          );
        })) ||
        o("value", function (e, t, n) {
          if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue;
        }),
      r(function (e) {
        return null == e.getAttribute("disabled");
      }) ||
        o(te, function (e, t, n) {
          var i;
          if (!n) return e[t] === !0 ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null;
        }),
      t
    );
  })(e);
  (he.find = xe),
    (he.expr = xe.selectors),
    (he.expr[":"] = he.expr.pseudos),
    (he.uniqueSort = he.unique = xe.uniqueSort),
    (he.text = xe.getText),
    (he.isXMLDoc = xe.isXML),
    (he.contains = xe.contains),
    (he.escapeSelector = xe.escape);
  var be = function (e, t, n) {
      for (var i = [], r = void 0 !== n; (e = e[t]) && 9 !== e.nodeType; )
        if (1 === e.nodeType) {
          if (r && he(e).is(n)) break;
          i.push(e);
        }
      return i;
    },
    ke = function (e, t) {
      for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
      return n;
    },
    we = he.expr.match.needsContext,
    Se = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i,
    Ee = /^.[^:#\[\.,]*$/;
  (he.filter = function (e, t, n) {
    var i = t[0];
    return (
      n && (e = ":not(" + e + ")"),
      1 === t.length && 1 === i.nodeType
        ? he.find.matchesSelector(i, e)
          ? [i]
          : []
        : he.find.matches(
            e,
            he.grep(t, function (e) {
              return 1 === e.nodeType;
            })
          )
    );
  }),
    he.fn.extend({
      find: function (e) {
        var t,
          n,
          i = this.length,
          r = this;
        if ("string" != typeof e)
          return this.pushStack(
            he(e).filter(function () {
              for (t = 0; t < i; t++) if (he.contains(r[t], this)) return !0;
            })
          );
        for (n = this.pushStack([]), t = 0; t < i; t++) he.find(e, r[t], n);
        return i > 1 ? he.uniqueSort(n) : n;
      },
      filter: function (e) {
        return this.pushStack(r(this, e || [], !1));
      },
      not: function (e) {
        return this.pushStack(r(this, e || [], !0));
      },
      is: function (e) {
        return !!r(this, "string" == typeof e && we.test(e) ? he(e) : e || [], !1).length;
      },
    });
  var Ce,
    Pe = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,
    Ae = (he.fn.init = function (e, t, n) {
      var i, r;
      if (!e) return this;
      if (((n = n || Ce), "string" == typeof e)) {
        if (
          ((i = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : Pe.exec(e)),
          !i || (!i[1] && t))
        )
          return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
        if (i[1]) {
          if (
            ((t = t instanceof he ? t[0] : t),
            he.merge(this, he.parseHTML(i[1], t && t.nodeType ? t.ownerDocument || t : te, !0)),
            Se.test(i[1]) && he.isPlainObject(t))
          )
            for (i in t) he.isFunction(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
          return this;
        }
        return (r = te.getElementById(i[2])), r && ((this[0] = r), (this.length = 1)), this;
      }
      return e.nodeType
        ? ((this[0] = e), (this.length = 1), this)
        : he.isFunction(e)
        ? void 0 !== n.ready
          ? n.ready(e)
          : e(he)
        : he.makeArray(e, this);
    });
  (Ae.prototype = he.fn), (Ce = he(te));
  var De = /^(?:parents|prev(?:Until|All))/,
    Te = { children: !0, contents: !0, next: !0, prev: !0 };
  he.fn.extend({
    has: function (e) {
      var t = he(e, this),
        n = t.length;
      return this.filter(function () {
        for (var e = 0; e < n; e++) if (he.contains(this, t[e])) return !0;
      });
    },
    closest: function (e, t) {
      var n,
        i = 0,
        r = this.length,
        o = [],
        a = "string" != typeof e && he(e);
      if (!we.test(e))
        for (; i < r; i++)
          for (n = this[i]; n && n !== t; n = n.parentNode)
            if (n.nodeType < 11 && (a ? a.index(n) > -1 : 1 === n.nodeType && he.find.matchesSelector(n, e))) {
              o.push(n);
              break;
            }
      return this.pushStack(o.length > 1 ? he.uniqueSort(o) : o);
    },
    index: function (e) {
      return e
        ? "string" == typeof e
          ? ae.call(he(e), this[0])
          : ae.call(this, e.jquery ? e[0] : e)
        : this[0] && this[0].parentNode
        ? this.first().prevAll().length
        : -1;
    },
    add: function (e, t) {
      return this.pushStack(he.uniqueSort(he.merge(this.get(), he(e, t))));
    },
    addBack: function (e) {
      return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
    },
  }),
    he.each(
      {
        parent: function (e) {
          var t = e.parentNode;
          return t && 11 !== t.nodeType ? t : null;
        },
        parents: function (e) {
          return be(e, "parentNode");
        },
        parentsUntil: function (e, t, n) {
          return be(e, "parentNode", n);
        },
        next: function (e) {
          return o(e, "nextSibling");
        },
        prev: function (e) {
          return o(e, "previousSibling");
        },
        nextAll: function (e) {
          return be(e, "nextSibling");
        },
        prevAll: function (e) {
          return be(e, "previousSibling");
        },
        nextUntil: function (e, t, n) {
          return be(e, "nextSibling", n);
        },
        prevUntil: function (e, t, n) {
          return be(e, "previousSibling", n);
        },
        siblings: function (e) {
          return ke((e.parentNode || {}).firstChild, e);
        },
        children: function (e) {
          return ke(e.firstChild);
        },
        contents: function (e) {
          return e.contentDocument || he.merge([], e.childNodes);
        },
      },
      function (e, t) {
        he.fn[e] = function (n, i) {
          var r = he.map(this, t, n);
          return (
            "Until" !== e.slice(-5) && (i = n),
            i && "string" == typeof i && (r = he.filter(i, r)),
            this.length > 1 && (Te[e] || he.uniqueSort(r), De.test(e) && r.reverse()),
            this.pushStack(r)
          );
        };
      }
    );
  var je = /[^\x20\t\r\n\f]+/g;
  (he.Callbacks = function (e) {
    e = "string" == typeof e ? a(e) : he.extend({}, e);
    var t,
      n,
      i,
      r,
      o = [],
      s = [],
      l = -1,
      u = function () {
        for (r = e.once, i = t = !0; s.length; l = -1)
          for (n = s.shift(); ++l < o.length; )
            o[l].apply(n[0], n[1]) === !1 && e.stopOnFalse && ((l = o.length), (n = !1));
        e.memory || (n = !1), (t = !1), r && (o = n ? [] : "");
      },
      c = {
        add: function () {
          return (
            o &&
              (n && !t && ((l = o.length - 1), s.push(n)),
              (function t(n) {
                he.each(n, function (n, i) {
                  he.isFunction(i)
                    ? (e.unique && c.has(i)) || o.push(i)
                    : i && i.length && "string" !== he.type(i) && t(i);
                });
              })(arguments),
              n && !t && u()),
            this
          );
        },
        remove: function () {
          return (
            he.each(arguments, function (e, t) {
              for (var n; (n = he.inArray(t, o, n)) > -1; ) o.splice(n, 1), n <= l && l--;
            }),
            this
          );
        },
        has: function (e) {
          return e ? he.inArray(e, o) > -1 : o.length > 0;
        },
        empty: function () {
          return o && (o = []), this;
        },
        disable: function () {
          return (r = s = []), (o = n = ""), this;
        },
        disabled: function () {
          return !o;
        },
        lock: function () {
          return (r = s = []), n || t || (o = n = ""), this;
        },
        locked: function () {
          return !!r;
        },
        fireWith: function (e, n) {
          return r || ((n = n || []), (n = [e, n.slice ? n.slice() : n]), s.push(n), t || u()), this;
        },
        fire: function () {
          return c.fireWith(this, arguments), this;
        },
        fired: function () {
          return !!i;
        },
      };
    return c;
  }),
    he.extend({
      Deferred: function (t) {
        var n = [
            ["notify", "progress", he.Callbacks("memory"), he.Callbacks("memory"), 2],
            ["resolve", "done", he.Callbacks("once memory"), he.Callbacks("once memory"), 0, "resolved"],
            ["reject", "fail", he.Callbacks("once memory"), he.Callbacks("once memory"), 1, "rejected"],
          ],
          i = "pending",
          r = {
            state: function () {
              return i;
            },
            always: function () {
              return o.done(arguments).fail(arguments), this;
            },
            catch: function (e) {
              return r.then(null, e);
            },
            pipe: function () {
              var e = arguments;
              return he
                .Deferred(function (t) {
                  he.each(n, function (n, i) {
                    var r = he.isFunction(e[i[4]]) && e[i[4]];
                    o[i[1]](function () {
                      var e = r && r.apply(this, arguments);
                      e && he.isFunction(e.promise)
                        ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject)
                        : t[i[0] + "With"](this, r ? [e] : arguments);
                    });
                  }),
                    (e = null);
                })
                .promise();
            },
            then: function (t, i, r) {
              function o(t, n, i, r) {
                return function () {
                  var u = this,
                    c = arguments,
                    f = function () {
                      var e, f;
                      if (!(t < a)) {
                        if (((e = i.apply(u, c)), e === n.promise())) throw new TypeError("Thenable self-resolution");
                        (f = e && ("object" == typeof e || "function" == typeof e) && e.then),
                          he.isFunction(f)
                            ? r
                              ? f.call(e, o(a, n, s, r), o(a, n, l, r))
                              : (a++, f.call(e, o(a, n, s, r), o(a, n, l, r), o(a, n, s, n.notifyWith)))
                            : (i !== s && ((u = void 0), (c = [e])), (r || n.resolveWith)(u, c));
                      }
                    },
                    d = r
                      ? f
                      : function () {
                          try {
                            f();
                          } catch (e) {
                            he.Deferred.exceptionHook && he.Deferred.exceptionHook(e, d.stackTrace),
                              t + 1 >= a && (i !== l && ((u = void 0), (c = [e])), n.rejectWith(u, c));
                          }
                        };
                  t ? d() : (he.Deferred.getStackHook && (d.stackTrace = he.Deferred.getStackHook()), e.setTimeout(d));
                };
              }
              var a = 0;
              return he
                .Deferred(function (e) {
                  n[0][3].add(o(0, e, he.isFunction(r) ? r : s, e.notifyWith)),
                    n[1][3].add(o(0, e, he.isFunction(t) ? t : s)),
                    n[2][3].add(o(0, e, he.isFunction(i) ? i : l));
                })
                .promise();
            },
            promise: function (e) {
              return null != e ? he.extend(e, r) : r;
            },
          },
          o = {};
        return (
          he.each(n, function (e, t) {
            var a = t[2],
              s = t[5];
            (r[t[1]] = a.add),
              s &&
                a.add(
                  function () {
                    i = s;
                  },
                  n[3 - e][2].disable,
                  n[0][2].lock
                ),
              a.add(t[3].fire),
              (o[t[0]] = function () {
                return o[t[0] + "With"](this === o ? void 0 : this, arguments), this;
              }),
              (o[t[0] + "With"] = a.fireWith);
          }),
          r.promise(o),
          t && t.call(o, o),
          o
        );
      },
      when: function (e) {
        var t = arguments.length,
          n = t,
          i = Array(n),
          r = ie.call(arguments),
          o = he.Deferred(),
          a = function (e) {
            return function (n) {
              (i[e] = this), (r[e] = arguments.length > 1 ? ie.call(arguments) : n), --t || o.resolveWith(i, r);
            };
          };
        if (
          t <= 1 &&
          (u(e, o.done(a(n)).resolve, o.reject), "pending" === o.state() || he.isFunction(r[n] && r[n].then))
        )
          return o.then();
        for (; n--; ) u(r[n], a(n), o.reject);
        return o.promise();
      },
    });
  var Ne = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
  (he.Deferred.exceptionHook = function (t, n) {
    e.console &&
      e.console.warn &&
      t &&
      Ne.test(t.name) &&
      e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, n);
  }),
    (he.readyException = function (t) {
      e.setTimeout(function () {
        throw t;
      });
    });
  var _e = he.Deferred();
  (he.fn.ready = function (e) {
    return (
      _e.then(e).catch(function (e) {
        he.readyException(e);
      }),
      this
    );
  }),
    he.extend({
      isReady: !1,
      readyWait: 1,
      holdReady: function (e) {
        e ? he.readyWait++ : he.ready(!0);
      },
      ready: function (e) {
        (e === !0 ? --he.readyWait : he.isReady) ||
          ((he.isReady = !0), (e !== !0 && --he.readyWait > 0) || _e.resolveWith(te, [he]));
      },
    }),
    (he.ready.then = _e.then),
    "complete" === te.readyState || ("loading" !== te.readyState && !te.documentElement.doScroll)
      ? e.setTimeout(he.ready)
      : (te.addEventListener("DOMContentLoaded", c), e.addEventListener("load", c));
  var Le = function (e, t, n, i, r, o, a) {
      var s = 0,
        l = e.length,
        u = null == n;
      if ("object" === he.type(n)) {
        r = !0;
        for (s in n) Le(e, t, s, n[s], !0, o, a);
      } else if (
        void 0 !== i &&
        ((r = !0),
        he.isFunction(i) || (a = !0),
        u &&
          (a
            ? (t.call(e, i), (t = null))
            : ((u = t),
              (t = function (e, t, n) {
                return u.call(he(e), n);
              }))),
        t)
      )
        for (; s < l; s++) t(e[s], n, a ? i : i.call(e[s], s, t(e[s], n)));
      return r ? e : u ? t.call(e) : l ? t(e[0], n) : o;
    },
    Me = function (e) {
      return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType;
    };
  (f.uid = 1),
    (f.prototype = {
      cache: function (e) {
        var t = e[this.expando];
        return (
          t ||
            ((t = {}),
            Me(e) &&
              (e.nodeType
                ? (e[this.expando] = t)
                : Object.defineProperty(e, this.expando, { value: t, configurable: !0 }))),
          t
        );
      },
      set: function (e, t, n) {
        var i,
          r = this.cache(e);
        if ("string" == typeof t) r[he.camelCase(t)] = n;
        else for (i in t) r[he.camelCase(i)] = t[i];
        return r;
      },
      get: function (e, t) {
        return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][he.camelCase(t)];
      },
      access: function (e, t, n) {
        return void 0 === t || (t && "string" == typeof t && void 0 === n)
          ? this.get(e, t)
          : (this.set(e, t, n), void 0 !== n ? n : t);
      },
      remove: function (e, t) {
        var n,
          i = e[this.expando];
        if (void 0 !== i) {
          if (void 0 !== t) {
            he.isArray(t) ? (t = t.map(he.camelCase)) : ((t = he.camelCase(t)), (t = t in i ? [t] : t.match(je) || [])),
              (n = t.length);
            for (; n--; ) delete i[t[n]];
          }
          (void 0 === t || he.isEmptyObject(i)) && (e.nodeType ? (e[this.expando] = void 0) : delete e[this.expando]);
        }
      },
      hasData: function (e) {
        var t = e[this.expando];
        return void 0 !== t && !he.isEmptyObject(t);
      },
    });
  var Oe = new f(),
    Ie = new f(),
    Fe = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
    Re = /[A-Z]/g;
  he.extend({
    hasData: function (e) {
      return Ie.hasData(e) || Oe.hasData(e);
    },
    data: function (e, t, n) {
      return Ie.access(e, t, n);
    },
    removeData: function (e, t) {
      Ie.remove(e, t);
    },
    _data: function (e, t, n) {
      return Oe.access(e, t, n);
    },
    _removeData: function (e, t) {
      Oe.remove(e, t);
    },
  }),
    he.fn.extend({
      data: function (e, t) {
        var n,
          i,
          r,
          o = this[0],
          a = o && o.attributes;
        if (void 0 === e) {
          if (this.length && ((r = Ie.get(o)), 1 === o.nodeType && !Oe.get(o, "hasDataAttrs"))) {
            for (n = a.length; n--; )
              a[n] && ((i = a[n].name), 0 === i.indexOf("data-") && ((i = he.camelCase(i.slice(5))), p(o, i, r[i])));
            Oe.set(o, "hasDataAttrs", !0);
          }
          return r;
        }
        return "object" == typeof e
          ? this.each(function () {
              Ie.set(this, e);
            })
          : Le(
              this,
              function (t) {
                var n;
                if (o && void 0 === t) {
                  if (((n = Ie.get(o, e)), void 0 !== n)) return n;
                  if (((n = p(o, e)), void 0 !== n)) return n;
                } else
                  this.each(function () {
                    Ie.set(this, e, t);
                  });
              },
              null,
              t,
              arguments.length > 1,
              null,
              !0
            );
      },
      removeData: function (e) {
        return this.each(function () {
          Ie.remove(this, e);
        });
      },
    }),
    he.extend({
      queue: function (e, t, n) {
        var i;
        if (e)
          return (
            (t = (t || "fx") + "queue"),
            (i = Oe.get(e, t)),
            n && (!i || he.isArray(n) ? (i = Oe.access(e, t, he.makeArray(n))) : i.push(n)),
            i || []
          );
      },
      dequeue: function (e, t) {
        t = t || "fx";
        var n = he.queue(e, t),
          i = n.length,
          r = n.shift(),
          o = he._queueHooks(e, t),
          a = function () {
            he.dequeue(e, t);
          };
        "inprogress" === r && ((r = n.shift()), i--),
          r && ("fx" === t && n.unshift("inprogress"), delete o.stop, r.call(e, a, o)),
          !i && o && o.empty.fire();
      },
      _queueHooks: function (e, t) {
        var n = t + "queueHooks";
        return (
          Oe.get(e, n) ||
          Oe.access(e, n, {
            empty: he.Callbacks("once memory").add(function () {
              Oe.remove(e, [t + "queue", n]);
            }),
          })
        );
      },
    }),
    he.fn.extend({
      queue: function (e, t) {
        var n = 2;
        return (
          "string" != typeof e && ((t = e), (e = "fx"), n--),
          arguments.length < n
            ? he.queue(this[0], e)
            : void 0 === t
            ? this
            : this.each(function () {
                var n = he.queue(this, e, t);
                he._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && he.dequeue(this, e);
              })
        );
      },
      dequeue: function (e) {
        return this.each(function () {
          he.dequeue(this, e);
        });
      },
      clearQueue: function (e) {
        return this.queue(e || "fx", []);
      },
      promise: function (e, t) {
        var n,
          i = 1,
          r = he.Deferred(),
          o = this,
          a = this.length,
          s = function () {
            --i || r.resolveWith(o, [o]);
          };
        for ("string" != typeof e && ((t = e), (e = void 0)), e = e || "fx"; a--; )
          (n = Oe.get(o[a], e + "queueHooks")), n && n.empty && (i++, n.empty.add(s));
        return s(), r.promise(t);
      },
    });
  var qe = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
    ze = new RegExp("^(?:([+-])=|)(" + qe + ")([a-z%]*)$", "i"),
    Be = ["Top", "Right", "Bottom", "Left"],
    He = function (e, t) {
      return (
        (e = t || e),
        "none" === e.style.display ||
          ("" === e.style.display && he.contains(e.ownerDocument, e) && "none" === he.css(e, "display"))
      );
    },
    Ue = function (e, t, n, i) {
      var r,
        o,
        a = {};
      for (o in t) (a[o] = e.style[o]), (e.style[o] = t[o]);
      r = n.apply(e, i || []);
      for (o in t) e.style[o] = a[o];
      return r;
    },
    We = {};
  he.fn.extend({
    show: function () {
      return g(this, !0);
    },
    hide: function () {
      return g(this);
    },
    toggle: function (e) {
      return "boolean" == typeof e
        ? e
          ? this.show()
          : this.hide()
        : this.each(function () {
            He(this) ? he(this).show() : he(this).hide();
          });
    },
  });
  var Ge = /^(?:checkbox|radio)$/i,
    $e = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i,
    Ve = /^$|\/(?:java|ecma)script/i,
    Ke = {
      option: [1, "<select multiple='multiple'>", "</select>"],
      thead: [1, "<table>", "</table>"],
      col: [2, "<table><colgroup>", "</colgroup></table>"],
      tr: [2, "<table><tbody>", "</tbody></table>"],
      td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
      _default: [0, "", ""],
    };
  (Ke.optgroup = Ke.option), (Ke.tbody = Ke.tfoot = Ke.colgroup = Ke.caption = Ke.thead), (Ke.th = Ke.td);
  var Xe = /<|&#?\w+;/;
  !(function () {
    var e = te.createDocumentFragment(),
      t = e.appendChild(te.createElement("div")),
      n = te.createElement("input");
    n.setAttribute("type", "radio"),
      n.setAttribute("checked", "checked"),
      n.setAttribute("name", "t"),
      t.appendChild(n),
      (de.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked),
      (t.innerHTML = "<textarea>x</textarea>"),
      (de.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue);
  })();
  var Qe = te.documentElement,
    Ye = /^key/,
    Je = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
    Ze = /^([^.]*)(?:\.(.+)|)/;
  (he.event = {
    global: {},
    add: function (e, t, n, i, r) {
      var o,
        a,
        s,
        l,
        u,
        c,
        f,
        d,
        p,
        h,
        m,
        g = Oe.get(e);
      if (g)
        for (
          n.handler && ((o = n), (n = o.handler), (r = o.selector)),
            r && he.find.matchesSelector(Qe, r),
            n.guid || (n.guid = he.guid++),
            (l = g.events) || (l = g.events = {}),
            (a = g.handle) ||
              (a = g.handle = function (t) {
                return "undefined" != typeof he && he.event.triggered !== t.type
                  ? he.event.dispatch.apply(e, arguments)
                  : void 0;
              }),
            t = (t || "").match(je) || [""],
            u = t.length;
          u--;

        )
          (s = Ze.exec(t[u]) || []),
            (p = m = s[1]),
            (h = (s[2] || "").split(".").sort()),
            p &&
              ((f = he.event.special[p] || {}),
              (p = (r ? f.delegateType : f.bindType) || p),
              (f = he.event.special[p] || {}),
              (c = he.extend(
                {
                  type: p,
                  origType: m,
                  data: i,
                  handler: n,
                  guid: n.guid,
                  selector: r,
                  needsContext: r && he.expr.match.needsContext.test(r),
                  namespace: h.join("."),
                },
                o
              )),
              (d = l[p]) ||
                ((d = l[p] = []),
                (d.delegateCount = 0),
                (f.setup && f.setup.call(e, i, h, a) !== !1) || (e.addEventListener && e.addEventListener(p, a))),
              f.add && (f.add.call(e, c), c.handler.guid || (c.handler.guid = n.guid)),
              r ? d.splice(d.delegateCount++, 0, c) : d.push(c),
              (he.event.global[p] = !0));
    },
    remove: function (e, t, n, i, r) {
      var o,
        a,
        s,
        l,
        u,
        c,
        f,
        d,
        p,
        h,
        m,
        g = Oe.hasData(e) && Oe.get(e);
      if (g && (l = g.events)) {
        for (t = (t || "").match(je) || [""], u = t.length; u--; )
          if (((s = Ze.exec(t[u]) || []), (p = m = s[1]), (h = (s[2] || "").split(".").sort()), p)) {
            for (
              f = he.event.special[p] || {},
                p = (i ? f.delegateType : f.bindType) || p,
                d = l[p] || [],
                s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"),
                a = o = d.length;
              o--;

            )
              (c = d[o]),
                (!r && m !== c.origType) ||
                  (n && n.guid !== c.guid) ||
                  (s && !s.test(c.namespace)) ||
                  (i && i !== c.selector && ("**" !== i || !c.selector)) ||
                  (d.splice(o, 1), c.selector && d.delegateCount--, f.remove && f.remove.call(e, c));
            a &&
              !d.length &&
              ((f.teardown && f.teardown.call(e, h, g.handle) !== !1) || he.removeEvent(e, p, g.handle), delete l[p]);
          } else for (p in l) he.event.remove(e, p + t[u], n, i, !0);
        he.isEmptyObject(l) && Oe.remove(e, "handle events");
      }
    },
    dispatch: function (e) {
      var t,
        n,
        i,
        r,
        o,
        a,
        s = he.event.fix(e),
        l = new Array(arguments.length),
        u = (Oe.get(this, "events") || {})[s.type] || [],
        c = he.event.special[s.type] || {};
      for (l[0] = s, t = 1; t < arguments.length; t++) l[t] = arguments[t];
      if (((s.delegateTarget = this), !c.preDispatch || c.preDispatch.call(this, s) !== !1)) {
        for (a = he.event.handlers.call(this, s, u), t = 0; (r = a[t++]) && !s.isPropagationStopped(); )
          for (s.currentTarget = r.elem, n = 0; (o = r.handlers[n++]) && !s.isImmediatePropagationStopped(); )
            (s.rnamespace && !s.rnamespace.test(o.namespace)) ||
              ((s.handleObj = o),
              (s.data = o.data),
              (i = ((he.event.special[o.origType] || {}).handle || o.handler).apply(r.elem, l)),
              void 0 !== i && (s.result = i) === !1 && (s.preventDefault(), s.stopPropagation()));
        return c.postDispatch && c.postDispatch.call(this, s), s.result;
      }
    },
    handlers: function (e, t) {
      var n,
        i,
        r,
        o,
        a,
        s = [],
        l = t.delegateCount,
        u = e.target;
      if (l && u.nodeType && !("click" === e.type && e.button >= 1))
        for (; u !== this; u = u.parentNode || this)
          if (1 === u.nodeType && ("click" !== e.type || u.disabled !== !0)) {
            for (o = [], a = {}, n = 0; n < l; n++)
              (i = t[n]),
                (r = i.selector + " "),
                void 0 === a[r] &&
                  (a[r] = i.needsContext ? he(r, this).index(u) > -1 : he.find(r, this, null, [u]).length),
                a[r] && o.push(i);
            o.length && s.push({ elem: u, handlers: o });
          }
      return (u = this), l < t.length && s.push({ elem: u, handlers: t.slice(l) }), s;
    },
    addProp: function (e, t) {
      Object.defineProperty(he.Event.prototype, e, {
        enumerable: !0,
        configurable: !0,
        get: he.isFunction(t)
          ? function () {
              if (this.originalEvent) return t(this.originalEvent);
            }
          : function () {
              if (this.originalEvent) return this.originalEvent[e];
            },
        set: function (t) {
          Object.defineProperty(this, e, { enumerable: !0, configurable: !0, writable: !0, value: t });
        },
      });
    },
    fix: function (e) {
      return e[he.expando] ? e : new he.Event(e);
    },
    special: {
      load: { noBubble: !0 },
      focus: {
        trigger: function () {
          if (this !== w() && this.focus) return this.focus(), !1;
        },
        delegateType: "focusin",
      },
      blur: {
        trigger: function () {
          if (this === w() && this.blur) return this.blur(), !1;
        },
        delegateType: "focusout",
      },
      click: {
        trigger: function () {
          if ("checkbox" === this.type && this.click && he.nodeName(this, "input")) return this.click(), !1;
        },
        _default: function (e) {
          return he.nodeName(e.target, "a");
        },
      },
      beforeunload: {
        postDispatch: function (e) {
          void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result);
        },
      },
    },
  }),
    (he.removeEvent = function (e, t, n) {
      e.removeEventListener && e.removeEventListener(t, n);
    }),
    (he.Event = function (e, t) {
      return this instanceof he.Event
        ? (e && e.type
            ? ((this.originalEvent = e),
              (this.type = e.type),
              (this.isDefaultPrevented =
                e.defaultPrevented || (void 0 === e.defaultPrevented && e.returnValue === !1) ? b : k),
              (this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target),
              (this.currentTarget = e.currentTarget),
              (this.relatedTarget = e.relatedTarget))
            : (this.type = e),
          t && he.extend(this, t),
          (this.timeStamp = (e && e.timeStamp) || he.now()),
          void (this[he.expando] = !0))
        : new he.Event(e, t);
    }),
    (he.Event.prototype = {
      constructor: he.Event,
      isDefaultPrevented: k,
      isPropagationStopped: k,
      isImmediatePropagationStopped: k,
      isSimulated: !1,
      preventDefault: function () {
        var e = this.originalEvent;
        (this.isDefaultPrevented = b), e && !this.isSimulated && e.preventDefault();
      },
      stopPropagation: function () {
        var e = this.originalEvent;
        (this.isPropagationStopped = b), e && !this.isSimulated && e.stopPropagation();
      },
      stopImmediatePropagation: function () {
        var e = this.originalEvent;
        (this.isImmediatePropagationStopped = b),
          e && !this.isSimulated && e.stopImmediatePropagation(),
          this.stopPropagation();
      },
    }),
    he.each(
      {
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function (e) {
          var t = e.button;
          return null == e.which && Ye.test(e.type)
            ? null != e.charCode
              ? e.charCode
              : e.keyCode
            : !e.which && void 0 !== t && Je.test(e.type)
            ? 1 & t
              ? 1
              : 2 & t
              ? 3
              : 4 & t
              ? 2
              : 0
            : e.which;
        },
      },
      he.event.addProp
    ),
    he.each(
      { mouseenter: "mouseover", mouseleave: "mouseout", pointerenter: "pointerover", pointerleave: "pointerout" },
      function (e, t) {
        he.event.special[e] = {
          delegateType: t,
          bindType: t,
          handle: function (e) {
            var n,
              i = this,
              r = e.relatedTarget,
              o = e.handleObj;
            return (
              (r && (r === i || he.contains(i, r))) ||
                ((e.type = o.origType), (n = o.handler.apply(this, arguments)), (e.type = t)),
              n
            );
          },
        };
      }
    ),
    he.fn.extend({
      on: function (e, t, n, i) {
        return S(this, e, t, n, i);
      },
      one: function (e, t, n, i) {
        return S(this, e, t, n, i, 1);
      },
      off: function (e, t, n) {
        var i, r;
        if (e && e.preventDefault && e.handleObj)
          return (
            (i = e.handleObj),
            he(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler),
            this
          );
        if ("object" == typeof e) {
          for (r in e) this.off(r, t, e[r]);
          return this;
        }
        return (
          (t !== !1 && "function" != typeof t) || ((n = t), (t = void 0)),
          n === !1 && (n = k),
          this.each(function () {
            he.event.remove(this, e, n, t);
          })
        );
      },
    });
  var et = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
    tt = /<script|<style|<link/i,
    nt = /checked\s*(?:[^=]|=\s*.checked.)/i,
    it = /^true\/(.*)/,
    rt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
  he.extend({
    htmlPrefilter: function (e) {
      return e.replace(et, "<$1></$2>");
    },
    clone: function (e, t, n) {
      var i,
        r,
        o,
        a,
        s = e.cloneNode(!0),
        l = he.contains(e.ownerDocument, e);
      if (!(de.noCloneChecked || (1 !== e.nodeType && 11 !== e.nodeType) || he.isXMLDoc(e)))
        for (a = v(s), o = v(e), i = 0, r = o.length; i < r; i++) D(o[i], a[i]);
      if (t)
        if (n) for (o = o || v(e), a = a || v(s), i = 0, r = o.length; i < r; i++) A(o[i], a[i]);
        else A(e, s);
      return (a = v(s, "script")), a.length > 0 && y(a, !l && v(e, "script")), s;
    },
    cleanData: function (e) {
      for (var t, n, i, r = he.event.special, o = 0; void 0 !== (n = e[o]); o++)
        if (Me(n)) {
          if ((t = n[Oe.expando])) {
            if (t.events) for (i in t.events) r[i] ? he.event.remove(n, i) : he.removeEvent(n, i, t.handle);
            n[Oe.expando] = void 0;
          }
          n[Ie.expando] && (n[Ie.expando] = void 0);
        }
    },
  }),
    he.fn.extend({
      detach: function (e) {
        return j(this, e, !0);
      },
      remove: function (e) {
        return j(this, e);
      },
      text: function (e) {
        return Le(
          this,
          function (e) {
            return void 0 === e
              ? he.text(this)
              : this.empty().each(function () {
                  (1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType) || (this.textContent = e);
                });
          },
          null,
          e,
          arguments.length
        );
      },
      append: function () {
        return T(this, arguments, function (e) {
          if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
            var t = E(this, e);
            t.appendChild(e);
          }
        });
      },
      prepend: function () {
        return T(this, arguments, function (e) {
          if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
            var t = E(this, e);
            t.insertBefore(e, t.firstChild);
          }
        });
      },
      before: function () {
        return T(this, arguments, function (e) {
          this.parentNode && this.parentNode.insertBefore(e, this);
        });
      },
      after: function () {
        return T(this, arguments, function (e) {
          this.parentNode && this.parentNode.insertBefore(e, this.nextSibling);
        });
      },
      empty: function () {
        for (var e, t = 0; null != (e = this[t]); t++)
          1 === e.nodeType && (he.cleanData(v(e, !1)), (e.textContent = ""));
        return this;
      },
      clone: function (e, t) {
        return (
          (e = null != e && e),
          (t = null == t ? e : t),
          this.map(function () {
            return he.clone(this, e, t);
          })
        );
      },
      html: function (e) {
        return Le(
          this,
          function (e) {
            var t = this[0] || {},
              n = 0,
              i = this.length;
            if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
            if ("string" == typeof e && !tt.test(e) && !Ke[($e.exec(e) || ["", ""])[1].toLowerCase()]) {
              e = he.htmlPrefilter(e);
              try {
                for (; n < i; n++) (t = this[n] || {}), 1 === t.nodeType && (he.cleanData(v(t, !1)), (t.innerHTML = e));
                t = 0;
              } catch (e) {}
            }
            t && this.empty().append(e);
          },
          null,
          e,
          arguments.length
        );
      },
      replaceWith: function () {
        var e = [];
        return T(
          this,
          arguments,
          function (t) {
            var n = this.parentNode;
            he.inArray(this, e) < 0 && (he.cleanData(v(this)), n && n.replaceChild(t, this));
          },
          e
        );
      },
    }),
    he.each(
      {
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith",
      },
      function (e, t) {
        he.fn[e] = function (e) {
          for (var n, i = [], r = he(e), o = r.length - 1, a = 0; a <= o; a++)
            (n = a === o ? this : this.clone(!0)), he(r[a])[t](n), oe.apply(i, n.get());
          return this.pushStack(i);
        };
      }
    );
  var ot = /^margin/,
    at = new RegExp("^(" + qe + ")(?!px)[a-z%]+$", "i"),
    st = function (t) {
      var n = t.ownerDocument.defaultView;
      return (n && n.opener) || (n = e), n.getComputedStyle(t);
    };
  !(function () {
    function t() {
      if (s) {
        (s.style.cssText =
          "box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%"),
          (s.innerHTML = ""),
          Qe.appendChild(a);
        var t = e.getComputedStyle(s);
        (n = "1%" !== t.top),
          (o = "2px" === t.marginLeft),
          (i = "4px" === t.width),
          (s.style.marginRight = "50%"),
          (r = "4px" === t.marginRight),
          Qe.removeChild(a),
          (s = null);
      }
    }
    var n,
      i,
      r,
      o,
      a = te.createElement("div"),
      s = te.createElement("div");
    s.style &&
      ((s.style.backgroundClip = "content-box"),
      (s.cloneNode(!0).style.backgroundClip = ""),
      (de.clearCloneStyle = "content-box" === s.style.backgroundClip),
      (a.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute"),
      a.appendChild(s),
      he.extend(de, {
        pixelPosition: function () {
          return t(), n;
        },
        boxSizingReliable: function () {
          return t(), i;
        },
        pixelMarginRight: function () {
          return t(), r;
        },
        reliableMarginLeft: function () {
          return t(), o;
        },
      }));
  })();
  var lt = /^(none|table(?!-c[ea]).+)/,
    ut = { position: "absolute", visibility: "hidden", display: "block" },
    ct = { letterSpacing: "0", fontWeight: "400" },
    ft = ["Webkit", "Moz", "ms"],
    dt = te.createElement("div").style;
  he.extend({
    cssHooks: {
      opacity: {
        get: function (e, t) {
          if (t) {
            var n = N(e, "opacity");
            return "" === n ? "1" : n;
          }
        },
      },
    },
    cssNumber: {
      animationIterationCount: !0,
      columnCount: !0,
      fillOpacity: !0,
      flexGrow: !0,
      flexShrink: !0,
      fontWeight: !0,
      lineHeight: !0,
      opacity: !0,
      order: !0,
      orphans: !0,
      widows: !0,
      zIndex: !0,
      zoom: !0,
    },
    cssProps: { float: "cssFloat" },
    style: function (e, t, n, i) {
      if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
        var r,
          o,
          a,
          s = he.camelCase(t),
          l = e.style;
        return (
          (t = he.cssProps[s] || (he.cssProps[s] = L(s) || s)),
          (a = he.cssHooks[t] || he.cssHooks[s]),
          void 0 === n
            ? a && "get" in a && void 0 !== (r = a.get(e, !1, i))
              ? r
              : l[t]
            : ((o = typeof n),
              "string" === o && (r = ze.exec(n)) && r[1] && ((n = h(e, t, r)), (o = "number")),
              void (
                null != n &&
                n === n &&
                ("number" === o && (n += (r && r[3]) || (he.cssNumber[s] ? "" : "px")),
                de.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (l[t] = "inherit"),
                (a && "set" in a && void 0 === (n = a.set(e, n, i))) || (l[t] = n))
              ))
        );
      }
    },
    css: function (e, t, n, i) {
      var r,
        o,
        a,
        s = he.camelCase(t);
      return (
        (t = he.cssProps[s] || (he.cssProps[s] = L(s) || s)),
        (a = he.cssHooks[t] || he.cssHooks[s]),
        a && "get" in a && (r = a.get(e, !0, n)),
        void 0 === r && (r = N(e, t, i)),
        "normal" === r && t in ct && (r = ct[t]),
        "" === n || n ? ((o = parseFloat(r)), n === !0 || isFinite(o) ? o || 0 : r) : r
      );
    },
  }),
    he.each(["height", "width"], function (e, t) {
      he.cssHooks[t] = {
        get: function (e, n, i) {
          if (n)
            return !lt.test(he.css(e, "display")) || (e.getClientRects().length && e.getBoundingClientRect().width)
              ? I(e, t, i)
              : Ue(e, ut, function () {
                  return I(e, t, i);
                });
        },
        set: function (e, n, i) {
          var r,
            o = i && st(e),
            a = i && O(e, t, i, "border-box" === he.css(e, "boxSizing", !1, o), o);
          return a && (r = ze.exec(n)) && "px" !== (r[3] || "px") && ((e.style[t] = n), (n = he.css(e, t))), M(e, n, a);
        },
      };
    }),
    (he.cssHooks.marginLeft = _(de.reliableMarginLeft, function (e, t) {
      if (t)
        return (
          (parseFloat(N(e, "marginLeft")) ||
            e.getBoundingClientRect().left -
              Ue(e, { marginLeft: 0 }, function () {
                return e.getBoundingClientRect().left;
              })) + "px"
        );
    })),
    he.each({ margin: "", padding: "", border: "Width" }, function (e, t) {
      (he.cssHooks[e + t] = {
        expand: function (n) {
          for (var i = 0, r = {}, o = "string" == typeof n ? n.split(" ") : [n]; i < 4; i++)
            r[e + Be[i] + t] = o[i] || o[i - 2] || o[0];
          return r;
        },
      }),
        ot.test(e) || (he.cssHooks[e + t].set = M);
    }),
    he.fn.extend({
      css: function (e, t) {
        return Le(
          this,
          function (e, t, n) {
            var i,
              r,
              o = {},
              a = 0;
            if (he.isArray(t)) {
              for (i = st(e), r = t.length; a < r; a++) o[t[a]] = he.css(e, t[a], !1, i);
              return o;
            }
            return void 0 !== n ? he.style(e, t, n) : he.css(e, t);
          },
          e,
          t,
          arguments.length > 1
        );
      },
    }),
    (he.Tween = F),
    (F.prototype = {
      constructor: F,
      init: function (e, t, n, i, r, o) {
        (this.elem = e),
          (this.prop = n),
          (this.easing = r || he.easing._default),
          (this.options = t),
          (this.start = this.now = this.cur()),
          (this.end = i),
          (this.unit = o || (he.cssNumber[n] ? "" : "px"));
      },
      cur: function () {
        var e = F.propHooks[this.prop];
        return e && e.get ? e.get(this) : F.propHooks._default.get(this);
      },
      run: function (e) {
        var t,
          n = F.propHooks[this.prop];
        return (
          this.options.duration
            ? (this.pos = t = he.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration))
            : (this.pos = t = e),
          (this.now = (this.end - this.start) * t + this.start),
          this.options.step && this.options.step.call(this.elem, this.now, this),
          n && n.set ? n.set(this) : F.propHooks._default.set(this),
          this
        );
      },
    }),
    (F.prototype.init.prototype = F.prototype),
    (F.propHooks = {
      _default: {
        get: function (e) {
          var t;
          return 1 !== e.elem.nodeType || (null != e.elem[e.prop] && null == e.elem.style[e.prop])
            ? e.elem[e.prop]
            : ((t = he.css(e.elem, e.prop, "")), t && "auto" !== t ? t : 0);
        },
        set: function (e) {
          he.fx.step[e.prop]
            ? he.fx.step[e.prop](e)
            : 1 !== e.elem.nodeType || (null == e.elem.style[he.cssProps[e.prop]] && !he.cssHooks[e.prop])
            ? (e.elem[e.prop] = e.now)
            : he.style(e.elem, e.prop, e.now + e.unit);
        },
      },
    }),
    (F.propHooks.scrollTop = F.propHooks.scrollLeft = {
      set: function (e) {
        e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now);
      },
    }),
    (he.easing = {
      linear: function (e) {
        return e;
      },
      swing: function (e) {
        return 0.5 - Math.cos(e * Math.PI) / 2;
      },
      _default: "swing",
    }),
    (he.fx = F.prototype.init),
    (he.fx.step = {});
  var pt,
    ht,
    mt = /^(?:toggle|show|hide)$/,
    gt = /queueHooks$/;
  (he.Animation = he.extend(W, {
    tweeners: {
      "*": [
        function (e, t) {
          var n = this.createTween(e, t);
          return h(n.elem, e, ze.exec(t), n), n;
        },
      ],
    },
    tweener: function (e, t) {
      he.isFunction(e) ? ((t = e), (e = ["*"])) : (e = e.match(je));
      for (var n, i = 0, r = e.length; i < r; i++)
        (n = e[i]), (W.tweeners[n] = W.tweeners[n] || []), W.tweeners[n].unshift(t);
    },
    prefilters: [H],
    prefilter: function (e, t) {
      t ? W.prefilters.unshift(e) : W.prefilters.push(e);
    },
  })),
    (he.speed = function (e, t, n) {
      var i =
        e && "object" == typeof e
          ? he.extend({}, e)
          : {
              complete: n || (!n && t) || (he.isFunction(e) && e),
              duration: e,
              easing: (n && t) || (t && !he.isFunction(t) && t),
            };
      return (
        he.fx.off || te.hidden
          ? (i.duration = 0)
          : "number" != typeof i.duration &&
            (i.duration in he.fx.speeds
              ? (i.duration = he.fx.speeds[i.duration])
              : (i.duration = he.fx.speeds._default)),
        (null != i.queue && i.queue !== !0) || (i.queue = "fx"),
        (i.old = i.complete),
        (i.complete = function () {
          he.isFunction(i.old) && i.old.call(this), i.queue && he.dequeue(this, i.queue);
        }),
        i
      );
    }),
    he.fn.extend({
      fadeTo: function (e, t, n, i) {
        return this.filter(He).css("opacity", 0).show().end().animate({ opacity: t }, e, n, i);
      },
      animate: function (e, t, n, i) {
        var r = he.isEmptyObject(e),
          o = he.speed(t, n, i),
          a = function () {
            var t = W(this, he.extend({}, e), o);
            (r || Oe.get(this, "finish")) && t.stop(!0);
          };
        return (a.finish = a), r || o.queue === !1 ? this.each(a) : this.queue(o.queue, a);
      },
      stop: function (e, t, n) {
        var i = function (e) {
          var t = e.stop;
          delete e.stop, t(n);
        };
        return (
          "string" != typeof e && ((n = t), (t = e), (e = void 0)),
          t && e !== !1 && this.queue(e || "fx", []),
          this.each(function () {
            var t = !0,
              r = null != e && e + "queueHooks",
              o = he.timers,
              a = Oe.get(this);
            if (r) a[r] && a[r].stop && i(a[r]);
            else for (r in a) a[r] && a[r].stop && gt.test(r) && i(a[r]);
            for (r = o.length; r--; )
              o[r].elem !== this || (null != e && o[r].queue !== e) || (o[r].anim.stop(n), (t = !1), o.splice(r, 1));
            (!t && n) || he.dequeue(this, e);
          })
        );
      },
      finish: function (e) {
        return (
          e !== !1 && (e = e || "fx"),
          this.each(function () {
            var t,
              n = Oe.get(this),
              i = n[e + "queue"],
              r = n[e + "queueHooks"],
              o = he.timers,
              a = i ? i.length : 0;
            for (n.finish = !0, he.queue(this, e, []), r && r.stop && r.stop.call(this, !0), t = o.length; t--; )
              o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
            for (t = 0; t < a; t++) i[t] && i[t].finish && i[t].finish.call(this);
            delete n.finish;
          })
        );
      },
    }),
    he.each(["toggle", "show", "hide"], function (e, t) {
      var n = he.fn[t];
      he.fn[t] = function (e, i, r) {
        return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(z(t, !0), e, i, r);
      };
    }),
    he.each(
      {
        slideDown: z("show"),
        slideUp: z("hide"),
        slideToggle: z("toggle"),
        fadeIn: { opacity: "show" },
        fadeOut: { opacity: "hide" },
        fadeToggle: { opacity: "toggle" },
      },
      function (e, t) {
        he.fn[e] = function (e, n, i) {
          return this.animate(t, e, n, i);
        };
      }
    ),
    (he.timers = []),
    (he.fx.tick = function () {
      var e,
        t = 0,
        n = he.timers;
      for (pt = he.now(); t < n.length; t++) (e = n[t]), e() || n[t] !== e || n.splice(t--, 1);
      n.length || he.fx.stop(), (pt = void 0);
    }),
    (he.fx.timer = function (e) {
      he.timers.push(e), e() ? he.fx.start() : he.timers.pop();
    }),
    (he.fx.interval = 13),
    (he.fx.start = function () {
      ht || (ht = e.requestAnimationFrame ? e.requestAnimationFrame(R) : e.setInterval(he.fx.tick, he.fx.interval));
    }),
    (he.fx.stop = function () {
      e.cancelAnimationFrame ? e.cancelAnimationFrame(ht) : e.clearInterval(ht), (ht = null);
    }),
    (he.fx.speeds = { slow: 600, fast: 200, _default: 400 }),
    (he.fn.delay = function (t, n) {
      return (
        (t = he.fx ? he.fx.speeds[t] || t : t),
        (n = n || "fx"),
        this.queue(n, function (n, i) {
          var r = e.setTimeout(n, t);
          i.stop = function () {
            e.clearTimeout(r);
          };
        })
      );
    }),
    (function () {
      var e = te.createElement("input"),
        t = te.createElement("select"),
        n = t.appendChild(te.createElement("option"));
      (e.type = "checkbox"),
        (de.checkOn = "" !== e.value),
        (de.optSelected = n.selected),
        (e = te.createElement("input")),
        (e.value = "t"),
        (e.type = "radio"),
        (de.radioValue = "t" === e.value);
    })();
  var vt,
    yt = he.expr.attrHandle;
  he.fn.extend({
    attr: function (e, t) {
      return Le(this, he.attr, e, t, arguments.length > 1);
    },
    removeAttr: function (e) {
      return this.each(function () {
        he.removeAttr(this, e);
      });
    },
  }),
    he.extend({
      attr: function (e, t, n) {
        var i,
          r,
          o = e.nodeType;
        if (3 !== o && 8 !== o && 2 !== o)
          return "undefined" == typeof e.getAttribute
            ? he.prop(e, t, n)
            : ((1 === o && he.isXMLDoc(e)) ||
                (r = he.attrHooks[t.toLowerCase()] || (he.expr.match.bool.test(t) ? vt : void 0)),
              void 0 !== n
                ? null === n
                  ? void he.removeAttr(e, t)
                  : r && "set" in r && void 0 !== (i = r.set(e, n, t))
                  ? i
                  : (e.setAttribute(t, n + ""), n)
                : r && "get" in r && null !== (i = r.get(e, t))
                ? i
                : ((i = he.find.attr(e, t)), null == i ? void 0 : i));
      },
      attrHooks: {
        type: {
          set: function (e, t) {
            if (!de.radioValue && "radio" === t && he.nodeName(e, "input")) {
              var n = e.value;
              return e.setAttribute("type", t), n && (e.value = n), t;
            }
          },
        },
      },
      removeAttr: function (e, t) {
        var n,
          i = 0,
          r = t && t.match(je);
        if (r && 1 === e.nodeType) for (; (n = r[i++]); ) e.removeAttribute(n);
      },
    }),
    (vt = {
      set: function (e, t, n) {
        return t === !1 ? he.removeAttr(e, n) : e.setAttribute(n, n), n;
      },
    }),
    he.each(he.expr.match.bool.source.match(/\w+/g), function (e, t) {
      var n = yt[t] || he.find.attr;
      yt[t] = function (e, t, i) {
        var r,
          o,
          a = t.toLowerCase();
        return i || ((o = yt[a]), (yt[a] = r), (r = null != n(e, t, i) ? a : null), (yt[a] = o)), r;
      };
    });
  var xt = /^(?:input|select|textarea|button)$/i,
    bt = /^(?:a|area)$/i;
  he.fn.extend({
    prop: function (e, t) {
      return Le(this, he.prop, e, t, arguments.length > 1);
    },
    removeProp: function (e) {
      return this.each(function () {
        delete this[he.propFix[e] || e];
      });
    },
  }),
    he.extend({
      prop: function (e, t, n) {
        var i,
          r,
          o = e.nodeType;
        if (3 !== o && 8 !== o && 2 !== o)
          return (
            (1 === o && he.isXMLDoc(e)) || ((t = he.propFix[t] || t), (r = he.propHooks[t])),
            void 0 !== n
              ? r && "set" in r && void 0 !== (i = r.set(e, n, t))
                ? i
                : (e[t] = n)
              : r && "get" in r && null !== (i = r.get(e, t))
              ? i
              : e[t]
          );
      },
      propHooks: {
        tabIndex: {
          get: function (e) {
            var t = he.find.attr(e, "tabindex");
            return t ? parseInt(t, 10) : xt.test(e.nodeName) || (bt.test(e.nodeName) && e.href) ? 0 : -1;
          },
        },
      },
      propFix: { for: "htmlFor", class: "className" },
    }),
    de.optSelected ||
      (he.propHooks.selected = {
        get: function (e) {
          var t = e.parentNode;
          return t && t.parentNode && t.parentNode.selectedIndex, null;
        },
        set: function (e) {
          var t = e.parentNode;
          t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex);
        },
      }),
    he.each(
      [
        "tabIndex",
        "readOnly",
        "maxLength",
        "cellSpacing",
        "cellPadding",
        "rowSpan",
        "colSpan",
        "useMap",
        "frameBorder",
        "contentEditable",
      ],
      function () {
        he.propFix[this.toLowerCase()] = this;
      }
    ),
    he.fn.extend({
      addClass: function (e) {
        var t,
          n,
          i,
          r,
          o,
          a,
          s,
          l = 0;
        if (he.isFunction(e))
          return this.each(function (t) {
            he(this).addClass(e.call(this, t, $(this)));
          });
        if ("string" == typeof e && e)
          for (t = e.match(je) || []; (n = this[l++]); )
            if (((r = $(n)), (i = 1 === n.nodeType && " " + G(r) + " "))) {
              for (a = 0; (o = t[a++]); ) i.indexOf(" " + o + " ") < 0 && (i += o + " ");
              (s = G(i)), r !== s && n.setAttribute("class", s);
            }
        return this;
      },
      removeClass: function (e) {
        var t,
          n,
          i,
          r,
          o,
          a,
          s,
          l = 0;
        if (he.isFunction(e))
          return this.each(function (t) {
            he(this).removeClass(e.call(this, t, $(this)));
          });
        if (!arguments.length) return this.attr("class", "");
        if ("string" == typeof e && e)
          for (t = e.match(je) || []; (n = this[l++]); )
            if (((r = $(n)), (i = 1 === n.nodeType && " " + G(r) + " "))) {
              for (a = 0; (o = t[a++]); ) for (; i.indexOf(" " + o + " ") > -1; ) i = i.replace(" " + o + " ", " ");
              (s = G(i)), r !== s && n.setAttribute("class", s);
            }
        return this;
      },
      toggleClass: function (e, t) {
        var n = typeof e;
        return "boolean" == typeof t && "string" === n
          ? t
            ? this.addClass(e)
            : this.removeClass(e)
          : he.isFunction(e)
          ? this.each(function (n) {
              he(this).toggleClass(e.call(this, n, $(this), t), t);
            })
          : this.each(function () {
              var t, i, r, o;
              if ("string" === n)
                for (i = 0, r = he(this), o = e.match(je) || []; (t = o[i++]); )
                  r.hasClass(t) ? r.removeClass(t) : r.addClass(t);
              else
                (void 0 !== e && "boolean" !== n) ||
                  ((t = $(this)),
                  t && Oe.set(this, "__className__", t),
                  this.setAttribute &&
                    this.setAttribute("class", t || e === !1 ? "" : Oe.get(this, "__className__") || ""));
            });
      },
      hasClass: function (e) {
        var t,
          n,
          i = 0;
        for (t = " " + e + " "; (n = this[i++]); )
          if (1 === n.nodeType && (" " + G($(n)) + " ").indexOf(t) > -1) return !0;
        return !1;
      },
    });
  var kt = /\r/g;
  he.fn.extend({
    val: function (e) {
      var t,
        n,
        i,
        r = this[0];
      return arguments.length
        ? ((i = he.isFunction(e)),
          this.each(function (n) {
            var r;
            1 === this.nodeType &&
              ((r = i ? e.call(this, n, he(this).val()) : e),
              null == r
                ? (r = "")
                : "number" == typeof r
                ? (r += "")
                : he.isArray(r) &&
                  (r = he.map(r, function (e) {
                    return null == e ? "" : e + "";
                  })),
              (t = he.valHooks[this.type] || he.valHooks[this.nodeName.toLowerCase()]),
              (t && "set" in t && void 0 !== t.set(this, r, "value")) || (this.value = r));
          }))
        : r
        ? ((t = he.valHooks[r.type] || he.valHooks[r.nodeName.toLowerCase()]),
          t && "get" in t && void 0 !== (n = t.get(r, "value"))
            ? n
            : ((n = r.value), "string" == typeof n ? n.replace(kt, "") : null == n ? "" : n))
        : void 0;
    },
  }),
    he.extend({
      valHooks: {
        option: {
          get: function (e) {
            var t = he.find.attr(e, "value");
            return null != t ? t : G(he.text(e));
          },
        },
        select: {
          get: function (e) {
            var t,
              n,
              i,
              r = e.options,
              o = e.selectedIndex,
              a = "select-one" === e.type,
              s = a ? null : [],
              l = a ? o + 1 : r.length;
            for (i = o < 0 ? l : a ? o : 0; i < l; i++)
              if (
                ((n = r[i]),
                (n.selected || i === o) &&
                  !n.disabled &&
                  (!n.parentNode.disabled || !he.nodeName(n.parentNode, "optgroup")))
              ) {
                if (((t = he(n).val()), a)) return t;
                s.push(t);
              }
            return s;
          },
          set: function (e, t) {
            for (var n, i, r = e.options, o = he.makeArray(t), a = r.length; a--; )
              (i = r[a]), (i.selected = he.inArray(he.valHooks.option.get(i), o) > -1) && (n = !0);
            return n || (e.selectedIndex = -1), o;
          },
        },
      },
    }),
    he.each(["radio", "checkbox"], function () {
      (he.valHooks[this] = {
        set: function (e, t) {
          if (he.isArray(t)) return (e.checked = he.inArray(he(e).val(), t) > -1);
        },
      }),
        de.checkOn ||
          (he.valHooks[this].get = function (e) {
            return null === e.getAttribute("value") ? "on" : e.value;
          });
    });
  var wt = /^(?:focusinfocus|focusoutblur)$/;
  he.extend(he.event, {
    trigger: function (t, n, i, r) {
      var o,
        a,
        s,
        l,
        u,
        c,
        f,
        d = [i || te],
        p = ue.call(t, "type") ? t.type : t,
        h = ue.call(t, "namespace") ? t.namespace.split(".") : [];
      if (
        ((a = s = i = i || te),
        3 !== i.nodeType &&
          8 !== i.nodeType &&
          !wt.test(p + he.event.triggered) &&
          (p.indexOf(".") > -1 && ((h = p.split(".")), (p = h.shift()), h.sort()),
          (u = p.indexOf(":") < 0 && "on" + p),
          (t = t[he.expando] ? t : new he.Event(p, "object" == typeof t && t)),
          (t.isTrigger = r ? 2 : 3),
          (t.namespace = h.join(".")),
          (t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null),
          (t.result = void 0),
          t.target || (t.target = i),
          (n = null == n ? [t] : he.makeArray(n, [t])),
          (f = he.event.special[p] || {}),
          r || !f.trigger || f.trigger.apply(i, n) !== !1))
      ) {
        if (!r && !f.noBubble && !he.isWindow(i)) {
          for (l = f.delegateType || p, wt.test(l + p) || (a = a.parentNode); a; a = a.parentNode) d.push(a), (s = a);
          s === (i.ownerDocument || te) && d.push(s.defaultView || s.parentWindow || e);
        }
        for (o = 0; (a = d[o++]) && !t.isPropagationStopped(); )
          (t.type = o > 1 ? l : f.bindType || p),
            (c = (Oe.get(a, "events") || {})[t.type] && Oe.get(a, "handle")),
            c && c.apply(a, n),
            (c = u && a[u]),
            c && c.apply && Me(a) && ((t.result = c.apply(a, n)), t.result === !1 && t.preventDefault());
        return (
          (t.type = p),
          r ||
            t.isDefaultPrevented() ||
            (f._default && f._default.apply(d.pop(), n) !== !1) ||
            !Me(i) ||
            (u &&
              he.isFunction(i[p]) &&
              !he.isWindow(i) &&
              ((s = i[u]),
              s && (i[u] = null),
              (he.event.triggered = p),
              i[p](),
              (he.event.triggered = void 0),
              s && (i[u] = s))),
          t.result
        );
      }
    },
    simulate: function (e, t, n) {
      var i = he.extend(new he.Event(), n, { type: e, isSimulated: !0 });
      he.event.trigger(i, null, t);
    },
  }),
    he.fn.extend({
      trigger: function (e, t) {
        return this.each(function () {
          he.event.trigger(e, t, this);
        });
      },
      triggerHandler: function (e, t) {
        var n = this[0];
        if (n) return he.event.trigger(e, t, n, !0);
      },
    }),
    he.each(
      "blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(
        " "
      ),
      function (e, t) {
        he.fn[t] = function (e, n) {
          return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t);
        };
      }
    ),
    he.fn.extend({
      hover: function (e, t) {
        return this.mouseenter(e).mouseleave(t || e);
      },
    }),
    (de.focusin = "onfocusin" in e),
    de.focusin ||
      he.each({ focus: "focusin", blur: "focusout" }, function (e, t) {
        var n = function (e) {
          he.event.simulate(t, e.target, he.event.fix(e));
        };
        he.event.special[t] = {
          setup: function () {
            var i = this.ownerDocument || this,
              r = Oe.access(i, t);
            r || i.addEventListener(e, n, !0), Oe.access(i, t, (r || 0) + 1);
          },
          teardown: function () {
            var i = this.ownerDocument || this,
              r = Oe.access(i, t) - 1;
            r ? Oe.access(i, t, r) : (i.removeEventListener(e, n, !0), Oe.remove(i, t));
          },
        };
      });
  var St = e.location,
    Et = he.now(),
    Ct = /\?/;
  he.parseXML = function (t) {
    var n;
    if (!t || "string" != typeof t) return null;
    try {
      n = new e.DOMParser().parseFromString(t, "text/xml");
    } catch (e) {
      n = void 0;
    }
    return (n && !n.getElementsByTagName("parsererror").length) || he.error("Invalid XML: " + t), n;
  };
  var Pt = /\[\]$/,
    At = /\r?\n/g,
    Dt = /^(?:submit|button|image|reset|file)$/i,
    Tt = /^(?:input|select|textarea|keygen)/i;
  (he.param = function (e, t) {
    var n,
      i = [],
      r = function (e, t) {
        var n = he.isFunction(t) ? t() : t;
        i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n);
      };
    if (he.isArray(e) || (e.jquery && !he.isPlainObject(e)))
      he.each(e, function () {
        r(this.name, this.value);
      });
    else for (n in e) V(n, e[n], t, r);
    return i.join("&");
  }),
    he.fn.extend({
      serialize: function () {
        return he.param(this.serializeArray());
      },
      serializeArray: function () {
        return this.map(function () {
          var e = he.prop(this, "elements");
          return e ? he.makeArray(e) : this;
        })
          .filter(function () {
            var e = this.type;
            return (
              this.name &&
              !he(this).is(":disabled") &&
              Tt.test(this.nodeName) &&
              !Dt.test(e) &&
              (this.checked || !Ge.test(e))
            );
          })
          .map(function (e, t) {
            var n = he(this).val();
            return null == n
              ? null
              : he.isArray(n)
              ? he.map(n, function (e) {
                  return { name: t.name, value: e.replace(At, "\r\n") };
                })
              : { name: t.name, value: n.replace(At, "\r\n") };
          })
          .get();
      },
    });
  var jt = /%20/g,
    Nt = /#.*$/,
    _t = /([?&])_=[^&]*/,
    Lt = /^(.*?):[ \t]*([^\r\n]*)$/gm,
    Mt = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
    Ot = /^(?:GET|HEAD)$/,
    It = /^\/\//,
    Ft = {},
    Rt = {},
    qt = "*/".concat("*"),
    zt = te.createElement("a");
  (zt.href = St.href),
    he.extend({
      active: 0,
      lastModified: {},
      etag: {},
      ajaxSettings: {
        url: St.href,
        type: "GET",
        isLocal: Mt.test(St.protocol),
        global: !0,
        processData: !0,
        async: !0,
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        accepts: {
          "*": qt,
          text: "text/plain",
          html: "text/html",
          xml: "application/xml, text/xml",
          json: "application/json, text/javascript",
        },
        contents: { xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/ },
        responseFields: { xml: "responseXML", text: "responseText", json: "responseJSON" },
        converters: { "* text": String, "text html": !0, "text json": JSON.parse, "text xml": he.parseXML },
        flatOptions: { url: !0, context: !0 },
      },
      ajaxSetup: function (e, t) {
        return t ? Q(Q(e, he.ajaxSettings), t) : Q(he.ajaxSettings, e);
      },
      ajaxPrefilter: K(Ft),
      ajaxTransport: K(Rt),
      ajax: function (t, n) {
        function i(t, n, i, s) {
          var u,
            d,
            p,
            b,
            k,
            w = n;
          c ||
            ((c = !0),
            l && e.clearTimeout(l),
            (r = void 0),
            (a = s || ""),
            (S.readyState = t > 0 ? 4 : 0),
            (u = (t >= 200 && t < 300) || 304 === t),
            i && (b = Y(h, S, i)),
            (b = J(h, b, S, u)),
            u
              ? (h.ifModified &&
                  ((k = S.getResponseHeader("Last-Modified")),
                  k && (he.lastModified[o] = k),
                  (k = S.getResponseHeader("etag")),
                  k && (he.etag[o] = k)),
                204 === t || "HEAD" === h.type
                  ? (w = "nocontent")
                  : 304 === t
                  ? (w = "notmodified")
                  : ((w = b.state), (d = b.data), (p = b.error), (u = !p)))
              : ((p = w), (!t && w) || ((w = "error"), t < 0 && (t = 0))),
            (S.status = t),
            (S.statusText = (n || w) + ""),
            u ? v.resolveWith(m, [d, w, S]) : v.rejectWith(m, [S, w, p]),
            S.statusCode(x),
            (x = void 0),
            f && g.trigger(u ? "ajaxSuccess" : "ajaxError", [S, h, u ? d : p]),
            y.fireWith(m, [S, w]),
            f && (g.trigger("ajaxComplete", [S, h]), --he.active || he.event.trigger("ajaxStop")));
        }
        "object" == typeof t && ((n = t), (t = void 0)), (n = n || {});
        var r,
          o,
          a,
          s,
          l,
          u,
          c,
          f,
          d,
          p,
          h = he.ajaxSetup({}, n),
          m = h.context || h,
          g = h.context && (m.nodeType || m.jquery) ? he(m) : he.event,
          v = he.Deferred(),
          y = he.Callbacks("once memory"),
          x = h.statusCode || {},
          b = {},
          k = {},
          w = "canceled",
          S = {
            readyState: 0,
            getResponseHeader: function (e) {
              var t;
              if (c) {
                if (!s) for (s = {}; (t = Lt.exec(a)); ) s[t[1].toLowerCase()] = t[2];
                t = s[e.toLowerCase()];
              }
              return null == t ? null : t;
            },
            getAllResponseHeaders: function () {
              return c ? a : null;
            },
            setRequestHeader: function (e, t) {
              return null == c && ((e = k[e.toLowerCase()] = k[e.toLowerCase()] || e), (b[e] = t)), this;
            },
            overrideMimeType: function (e) {
              return null == c && (h.mimeType = e), this;
            },
            statusCode: function (e) {
              var t;
              if (e)
                if (c) S.always(e[S.status]);
                else for (t in e) x[t] = [x[t], e[t]];
              return this;
            },
            abort: function (e) {
              var t = e || w;
              return r && r.abort(t), i(0, t), this;
            },
          };
        if (
          (v.promise(S),
          (h.url = ((t || h.url || St.href) + "").replace(It, St.protocol + "//")),
          (h.type = n.method || n.type || h.method || h.type),
          (h.dataTypes = (h.dataType || "*").toLowerCase().match(je) || [""]),
          null == h.crossDomain)
        ) {
          u = te.createElement("a");
          try {
            (u.href = h.url),
              (u.href = u.href),
              (h.crossDomain = zt.protocol + "//" + zt.host != u.protocol + "//" + u.host);
          } catch (e) {
            h.crossDomain = !0;
          }
        }
        if (
          (h.data && h.processData && "string" != typeof h.data && (h.data = he.param(h.data, h.traditional)),
          X(Ft, h, n, S),
          c)
        )
          return S;
        (f = he.event && h.global),
          f && 0 === he.active++ && he.event.trigger("ajaxStart"),
          (h.type = h.type.toUpperCase()),
          (h.hasContent = !Ot.test(h.type)),
          (o = h.url.replace(Nt, "")),
          h.hasContent
            ? h.data &&
              h.processData &&
              0 === (h.contentType || "").indexOf("application/x-www-form-urlencoded") &&
              (h.data = h.data.replace(jt, "+"))
            : ((p = h.url.slice(o.length)),
              h.data && ((o += (Ct.test(o) ? "&" : "?") + h.data), delete h.data),
              h.cache === !1 && ((o = o.replace(_t, "$1")), (p = (Ct.test(o) ? "&" : "?") + "_=" + Et++ + p)),
              (h.url = o + p)),
          h.ifModified &&
            (he.lastModified[o] && S.setRequestHeader("If-Modified-Since", he.lastModified[o]),
            he.etag[o] && S.setRequestHeader("If-None-Match", he.etag[o])),
          ((h.data && h.hasContent && h.contentType !== !1) || n.contentType) &&
            S.setRequestHeader("Content-Type", h.contentType),
          S.setRequestHeader(
            "Accept",
            h.dataTypes[0] && h.accepts[h.dataTypes[0]]
              ? h.accepts[h.dataTypes[0]] + ("*" !== h.dataTypes[0] ? ", " + qt + "; q=0.01" : "")
              : h.accepts["*"]
          );
        for (d in h.headers) S.setRequestHeader(d, h.headers[d]);
        if (h.beforeSend && (h.beforeSend.call(m, S, h) === !1 || c)) return S.abort();
        if (((w = "abort"), y.add(h.complete), S.done(h.success), S.fail(h.error), (r = X(Rt, h, n, S)))) {
          if (((S.readyState = 1), f && g.trigger("ajaxSend", [S, h]), c)) return S;
          h.async &&
            h.timeout > 0 &&
            (l = e.setTimeout(function () {
              S.abort("timeout");
            }, h.timeout));
          try {
            (c = !1), r.send(b, i);
          } catch (e) {
            if (c) throw e;
            i(-1, e);
          }
        } else i(-1, "No Transport");
        return S;
      },
      getJSON: function (e, t, n) {
        return he.get(e, t, n, "json");
      },
      getScript: function (e, t) {
        return he.get(e, void 0, t, "script");
      },
    }),
    he.each(["get", "post"], function (e, t) {
      he[t] = function (e, n, i, r) {
        return (
          he.isFunction(n) && ((r = r || i), (i = n), (n = void 0)),
          he.ajax(he.extend({ url: e, type: t, dataType: r, data: n, success: i }, he.isPlainObject(e) && e))
        );
      };
    }),
    (he._evalUrl = function (e) {
      return he.ajax({ url: e, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, throws: !0 });
    }),
    he.fn.extend({
      wrapAll: function (e) {
        var t;
        return (
          this[0] &&
            (he.isFunction(e) && (e = e.call(this[0])),
            (t = he(e, this[0].ownerDocument).eq(0).clone(!0)),
            this[0].parentNode && t.insertBefore(this[0]),
            t
              .map(function () {
                for (var e = this; e.firstElementChild; ) e = e.firstElementChild;
                return e;
              })
              .append(this)),
          this
        );
      },
      wrapInner: function (e) {
        return he.isFunction(e)
          ? this.each(function (t) {
              he(this).wrapInner(e.call(this, t));
            })
          : this.each(function () {
              var t = he(this),
                n = t.contents();
              n.length ? n.wrapAll(e) : t.append(e);
            });
      },
      wrap: function (e) {
        var t = he.isFunction(e);
        return this.each(function (n) {
          he(this).wrapAll(t ? e.call(this, n) : e);
        });
      },
      unwrap: function (e) {
        return (
          this.parent(e)
            .not("body")
            .each(function () {
              he(this).replaceWith(this.childNodes);
            }),
          this
        );
      },
    }),
    (he.expr.pseudos.hidden = function (e) {
      return !he.expr.pseudos.visible(e);
    }),
    (he.expr.pseudos.visible = function (e) {
      return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length);
    }),
    (he.ajaxSettings.xhr = function () {
      try {
        return new e.XMLHttpRequest();
      } catch (e) {}
    });
  var Bt = { 0: 200, 1223: 204 },
    Ht = he.ajaxSettings.xhr();
  (de.cors = !!Ht && "withCredentials" in Ht),
    (de.ajax = Ht = !!Ht),
    he.ajaxTransport(function (t) {
      var n, i;
      if (de.cors || (Ht && !t.crossDomain))
        return {
          send: function (r, o) {
            var a,
              s = t.xhr();
            if ((s.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields))
              for (a in t.xhrFields) s[a] = t.xhrFields[a];
            t.mimeType && s.overrideMimeType && s.overrideMimeType(t.mimeType),
              t.crossDomain || r["X-Requested-With"] || (r["X-Requested-With"] = "XMLHttpRequest");
            for (a in r) s.setRequestHeader(a, r[a]);
            (n = function (e) {
              return function () {
                n &&
                  ((n = i = s.onload = s.onerror = s.onabort = s.onreadystatechange = null),
                  "abort" === e
                    ? s.abort()
                    : "error" === e
                    ? "number" != typeof s.status
                      ? o(0, "error")
                      : o(s.status, s.statusText)
                    : o(
                        Bt[s.status] || s.status,
                        s.statusText,
                        "text" !== (s.responseType || "text") || "string" != typeof s.responseText
                          ? { binary: s.response }
                          : { text: s.responseText },
                        s.getAllResponseHeaders()
                      ));
              };
            }),
              (s.onload = n()),
              (i = s.onerror = n("error")),
              void 0 !== s.onabort
                ? (s.onabort = i)
                : (s.onreadystatechange = function () {
                    4 === s.readyState &&
                      e.setTimeout(function () {
                        n && i();
                      });
                  }),
              (n = n("abort"));
            try {
              s.send((t.hasContent && t.data) || null);
            } catch (e) {
              if (n) throw e;
            }
          },
          abort: function () {
            n && n();
          },
        };
    }),
    he.ajaxPrefilter(function (e) {
      e.crossDomain && (e.contents.script = !1);
    }),
    he.ajaxSetup({
      accepts: { script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript" },
      contents: { script: /\b(?:java|ecma)script\b/ },
      converters: {
        "text script": function (e) {
          return he.globalEval(e), e;
        },
      },
    }),
    he.ajaxPrefilter("script", function (e) {
      void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET");
    }),
    he.ajaxTransport("script", function (e) {
      if (e.crossDomain) {
        var t, n;
        return {
          send: function (i, r) {
            (t = he("<script>")
              .prop({ charset: e.scriptCharset, src: e.url })
              .on(
                "load error",
                (n = function (e) {
                  t.remove(), (n = null), e && r("error" === e.type ? 404 : 200, e.type);
                })
              )),
              te.head.appendChild(t[0]);
          },
          abort: function () {
            n && n();
          },
        };
      }
    });
  var Ut = [],
    Wt = /(=)\?(?=&|$)|\?\?/;
  he.ajaxSetup({
    jsonp: "callback",
    jsonpCallback: function () {
      var e = Ut.pop() || he.expando + "_" + Et++;
      return (this[e] = !0), e;
    },
  }),
    he.ajaxPrefilter("json jsonp", function (t, n, i) {
      var r,
        o,
        a,
        s =
          t.jsonp !== !1 &&
          (Wt.test(t.url)
            ? "url"
            : "string" == typeof t.data &&
              0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") &&
              Wt.test(t.data) &&
              "data");
      if (s || "jsonp" === t.dataTypes[0])
        return (
          (r = t.jsonpCallback = he.isFunction(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback),
          s
            ? (t[s] = t[s].replace(Wt, "$1" + r))
            : t.jsonp !== !1 && (t.url += (Ct.test(t.url) ? "&" : "?") + t.jsonp + "=" + r),
          (t.converters["script json"] = function () {
            return a || he.error(r + " was not called"), a[0];
          }),
          (t.dataTypes[0] = "json"),
          (o = e[r]),
          (e[r] = function () {
            a = arguments;
          }),
          i.always(function () {
            void 0 === o ? he(e).removeProp(r) : (e[r] = o),
              t[r] && ((t.jsonpCallback = n.jsonpCallback), Ut.push(r)),
              a && he.isFunction(o) && o(a[0]),
              (a = o = void 0);
          }),
          "script"
        );
    }),
    (de.createHTMLDocument = (function () {
      var e = te.implementation.createHTMLDocument("").body;
      return (e.innerHTML = "<form></form><form></form>"), 2 === e.childNodes.length;
    })()),
    (he.parseHTML = function (e, t, n) {
      if ("string" != typeof e) return [];
      "boolean" == typeof t && ((n = t), (t = !1));
      var i, r, o;
      return (
        t ||
          (de.createHTMLDocument
            ? ((t = te.implementation.createHTMLDocument("")),
              (i = t.createElement("base")),
              (i.href = te.location.href),
              t.head.appendChild(i))
            : (t = te)),
        (r = Se.exec(e)),
        (o = !n && []),
        r ? [t.createElement(r[1])] : ((r = x([e], t, o)), o && o.length && he(o).remove(), he.merge([], r.childNodes))
      );
    }),
    (he.fn.load = function (e, t, n) {
      var i,
        r,
        o,
        a = this,
        s = e.indexOf(" ");
      return (
        s > -1 && ((i = G(e.slice(s))), (e = e.slice(0, s))),
        he.isFunction(t) ? ((n = t), (t = void 0)) : t && "object" == typeof t && (r = "POST"),
        a.length > 0 &&
          he
            .ajax({ url: e, type: r || "GET", dataType: "html", data: t })
            .done(function (e) {
              (o = arguments), a.html(i ? he("<div>").append(he.parseHTML(e)).find(i) : e);
            })
            .always(
              n &&
                function (e, t) {
                  a.each(function () {
                    n.apply(this, o || [e.responseText, t, e]);
                  });
                }
            ),
        this
      );
    }),
    he.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
      he.fn[t] = function (e) {
        return this.on(t, e);
      };
    }),
    (he.expr.pseudos.animated = function (e) {
      return he.grep(he.timers, function (t) {
        return e === t.elem;
      }).length;
    }),
    (he.offset = {
      setOffset: function (e, t, n) {
        var i,
          r,
          o,
          a,
          s,
          l,
          u,
          c = he.css(e, "position"),
          f = he(e),
          d = {};
        "static" === c && (e.style.position = "relative"),
          (s = f.offset()),
          (o = he.css(e, "top")),
          (l = he.css(e, "left")),
          (u = ("absolute" === c || "fixed" === c) && (o + l).indexOf("auto") > -1),
          u ? ((i = f.position()), (a = i.top), (r = i.left)) : ((a = parseFloat(o) || 0), (r = parseFloat(l) || 0)),
          he.isFunction(t) && (t = t.call(e, n, he.extend({}, s))),
          null != t.top && (d.top = t.top - s.top + a),
          null != t.left && (d.left = t.left - s.left + r),
          "using" in t ? t.using.call(e, d) : f.css(d);
      },
    }),
    he.fn.extend({
      offset: function (e) {
        if (arguments.length)
          return void 0 === e
            ? this
            : this.each(function (t) {
                he.offset.setOffset(this, e, t);
              });
        var t,
          n,
          i,
          r,
          o = this[0];
        return o
          ? o.getClientRects().length
            ? ((i = o.getBoundingClientRect()),
              i.width || i.height
                ? ((r = o.ownerDocument),
                  (n = Z(r)),
                  (t = r.documentElement),
                  { top: i.top + n.pageYOffset - t.clientTop, left: i.left + n.pageXOffset - t.clientLeft })
                : i)
            : { top: 0, left: 0 }
          : void 0;
      },
      position: function () {
        if (this[0]) {
          var e,
            t,
            n = this[0],
            i = { top: 0, left: 0 };
          return (
            "fixed" === he.css(n, "position")
              ? (t = n.getBoundingClientRect())
              : ((e = this.offsetParent()),
                (t = this.offset()),
                he.nodeName(e[0], "html") || (i = e.offset()),
                (i = {
                  top: i.top + he.css(e[0], "borderTopWidth", !0),
                  left: i.left + he.css(e[0], "borderLeftWidth", !0),
                })),
            { top: t.top - i.top - he.css(n, "marginTop", !0), left: t.left - i.left - he.css(n, "marginLeft", !0) }
          );
        }
      },
      offsetParent: function () {
        return this.map(function () {
          for (var e = this.offsetParent; e && "static" === he.css(e, "position"); ) e = e.offsetParent;
          return e || Qe;
        });
      },
    }),
    he.each({ scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function (e, t) {
      var n = "pageYOffset" === t;
      he.fn[e] = function (i) {
        return Le(
          this,
          function (e, i, r) {
            var o = Z(e);
            return void 0 === r
              ? o
                ? o[t]
                : e[i]
              : void (o ? o.scrollTo(n ? o.pageXOffset : r, n ? r : o.pageYOffset) : (e[i] = r));
          },
          e,
          i,
          arguments.length
        );
      };
    }),
    he.each(["top", "left"], function (e, t) {
      he.cssHooks[t] = _(de.pixelPosition, function (e, n) {
        if (n) return (n = N(e, t)), at.test(n) ? he(e).position()[t] + "px" : n;
      });
    }),
    he.each({ Height: "height", Width: "width" }, function (e, t) {
      he.each({ padding: "inner" + e, content: t, "": "outer" + e }, function (n, i) {
        he.fn[i] = function (r, o) {
          var a = arguments.length && (n || "boolean" != typeof r),
            s = n || (r === !0 || o === !0 ? "margin" : "border");
          return Le(
            this,
            function (t, n, r) {
              var o;
              return he.isWindow(t)
                ? 0 === i.indexOf("outer")
                  ? t["inner" + e]
                  : t.document.documentElement["client" + e]
                : 9 === t.nodeType
                ? ((o = t.documentElement),
                  Math.max(
                    t.body["scroll" + e],
                    o["scroll" + e],
                    t.body["offset" + e],
                    o["offset" + e],
                    o["client" + e]
                  ))
                : void 0 === r
                ? he.css(t, n, s)
                : he.style(t, n, r, s);
            },
            t,
            a ? r : void 0,
            a
          );
        };
      });
    }),
    he.fn.extend({
      bind: function (e, t, n) {
        return this.on(e, null, t, n);
      },
      unbind: function (e, t) {
        return this.off(e, null, t);
      },
      delegate: function (e, t, n, i) {
        return this.on(t, e, n, i);
      },
      undelegate: function (e, t, n) {
        return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n);
      },
    }),
    (he.parseJSON = JSON.parse),
    "function" == typeof define &&
      define.amd &&
      define("jquery", [], function () {
        return he;
      });
  var Gt = e.jQuery,
    $t = e.$;
  return (
    (he.noConflict = function (t) {
      return e.$ === he && (e.$ = $t), t && e.jQuery === he && (e.jQuery = Gt), he;
    }),
    t || (e.jQuery = e.$ = he),
    he
  );
}),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("jquery-bridget/jquery-bridget", ["jquery"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("jquery")))
      : (e.jQueryBridget = t(e, e.jQuery));
  })(window, function (e, t) {
    "use strict";
    function n(n, o, s) {
      function l(e, t, i) {
        var r,
          o = "$()." + n + '("' + t + '")';
        return (
          e.each(function (e, l) {
            var u = s.data(l, n);
            if (!u) return void a(n + " not initialized. Cannot call methods, i.e. " + o);
            var c = u[t];
            if (!c || "_" == t.charAt(0)) return void a(o + " is not a valid method");
            var f = c.apply(u, i);
            r = void 0 === r ? f : r;
          }),
          void 0 !== r ? r : e
        );
      }
      function u(e, t) {
        e.each(function (e, i) {
          var r = s.data(i, n);
          r ? (r.option(t), r._init()) : ((r = new o(i, t)), s.data(i, n, r));
        });
      }
      (s = s || t || e.jQuery),
        s &&
          (o.prototype.option ||
            (o.prototype.option = function (e) {
              s.isPlainObject(e) && (this.options = s.extend(!0, this.options, e));
            }),
          (s.fn[n] = function (e) {
            if ("string" == typeof e) {
              var t = r.call(arguments, 1);
              return l(this, e, t);
            }
            return u(this, e), this;
          }),
          i(s));
    }
    function i(e) {
      !e || (e && e.bridget) || (e.bridget = n);
    }
    var r = Array.prototype.slice,
      o = e.console,
      a =
        "undefined" == typeof o
          ? function () {}
          : function (e) {
              o.error(e);
            };
    return i(t || e.jQuery), n;
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("ev-emitter/ev-emitter", t)
      : "object" == typeof module && module.exports
      ? (module.exports = t())
      : (e.EvEmitter = t());
  })("undefined" != typeof window ? window : this, function () {
    function e() {}
    var t = e.prototype;
    return (
      (t.on = function (e, t) {
        if (e && t) {
          var n = (this._events = this._events || {}),
            i = (n[e] = n[e] || []);
          return i.indexOf(t) == -1 && i.push(t), this;
        }
      }),
      (t.once = function (e, t) {
        if (e && t) {
          this.on(e, t);
          var n = (this._onceEvents = this._onceEvents || {}),
            i = (n[e] = n[e] || {});
          return (i[t] = !0), this;
        }
      }),
      (t.off = function (e, t) {
        var n = this._events && this._events[e];
        if (n && n.length) {
          var i = n.indexOf(t);
          return i != -1 && n.splice(i, 1), this;
        }
      }),
      (t.emitEvent = function (e, t) {
        var n = this._events && this._events[e];
        if (n && n.length) {
          var i = 0,
            r = n[i];
          t = t || [];
          for (var o = this._onceEvents && this._onceEvents[e]; r; ) {
            var a = o && o[r];
            a && (this.off(e, r), delete o[r]), r.apply(this, t), (i += a ? 0 : 1), (r = n[i]);
          }
          return this;
        }
      }),
      e
    );
  }),
  (function (e, t) {
    "use strict";
    "function" == typeof define && define.amd
      ? define("get-size/get-size", [], function () {
          return t();
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t())
      : (e.getSize = t());
  })(window, function () {
    "use strict";
    function e(e) {
      var t = parseFloat(e),
        n = e.indexOf("%") == -1 && !isNaN(t);
      return n && t;
    }
    function t() {}
    function n() {
      for (
        var e = { width: 0, height: 0, innerWidth: 0, innerHeight: 0, outerWidth: 0, outerHeight: 0 }, t = 0;
        t < u;
        t++
      ) {
        var n = l[t];
        e[n] = 0;
      }
      return e;
    }
    function i(e) {
      var t = getComputedStyle(e);
      return (
        t ||
          s(
            "Style returned " +
              t +
              ". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"
          ),
        t
      );
    }
    function r() {
      if (!c) {
        c = !0;
        var t = document.createElement("div");
        (t.style.width = "200px"),
          (t.style.padding = "1px 2px 3px 4px"),
          (t.style.borderStyle = "solid"),
          (t.style.borderWidth = "1px 2px 3px 4px"),
          (t.style.boxSizing = "border-box");
        var n = document.body || document.documentElement;
        n.appendChild(t);
        var r = i(t);
        (o.isBoxSizeOuter = a = 200 == e(r.width)), n.removeChild(t);
      }
    }
    function o(t) {
      if ((r(), "string" == typeof t && (t = document.querySelector(t)), t && "object" == typeof t && t.nodeType)) {
        var o = i(t);
        if ("none" == o.display) return n();
        var s = {};
        (s.width = t.offsetWidth), (s.height = t.offsetHeight);
        for (var c = (s.isBorderBox = "border-box" == o.boxSizing), f = 0; f < u; f++) {
          var d = l[f],
            p = o[d],
            h = parseFloat(p);
          s[d] = isNaN(h) ? 0 : h;
        }
        var m = s.paddingLeft + s.paddingRight,
          g = s.paddingTop + s.paddingBottom,
          v = s.marginLeft + s.marginRight,
          y = s.marginTop + s.marginBottom,
          x = s.borderLeftWidth + s.borderRightWidth,
          b = s.borderTopWidth + s.borderBottomWidth,
          k = c && a,
          w = e(o.width);
        w !== !1 && (s.width = w + (k ? 0 : m + x));
        var S = e(o.height);
        return (
          S !== !1 && (s.height = S + (k ? 0 : g + b)),
          (s.innerWidth = s.width - (m + x)),
          (s.innerHeight = s.height - (g + b)),
          (s.outerWidth = s.width + v),
          (s.outerHeight = s.height + y),
          s
        );
      }
    }
    var a,
      s =
        "undefined" == typeof console
          ? t
          : function (e) {
              console.error(e);
            },
      l = [
        "paddingLeft",
        "paddingRight",
        "paddingTop",
        "paddingBottom",
        "marginLeft",
        "marginRight",
        "marginTop",
        "marginBottom",
        "borderLeftWidth",
        "borderRightWidth",
        "borderTopWidth",
        "borderBottomWidth",
      ],
      u = l.length,
      c = !1;
    return o;
  }),
  (function (e, t) {
    "use strict";
    "function" == typeof define && define.amd
      ? define("desandro-matches-selector/matches-selector", t)
      : "object" == typeof module && module.exports
      ? (module.exports = t())
      : (e.matchesSelector = t());
  })(window, function () {
    "use strict";
    var e = (function () {
      var e = window.Element.prototype;
      if (e.matches) return "matches";
      if (e.matchesSelector) return "matchesSelector";
      for (var t = ["webkit", "moz", "ms", "o"], n = 0; n < t.length; n++) {
        var i = t[n],
          r = i + "MatchesSelector";
        if (e[r]) return r;
      }
    })();
    return function (t, n) {
      return t[e](n);
    };
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("fizzy-ui-utils/utils", ["desandro-matches-selector/matches-selector"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("desandro-matches-selector")))
      : (e.fizzyUIUtils = t(e, e.matchesSelector));
  })(window, function (e, t) {
    var n = {};
    (n.extend = function (e, t) {
      for (var n in t) e[n] = t[n];
      return e;
    }),
      (n.modulo = function (e, t) {
        return ((e % t) + t) % t;
      }),
      (n.makeArray = function (e) {
        var t = [];
        if (Array.isArray(e)) t = e;
        else if (e && "object" == typeof e && "number" == typeof e.length)
          for (var n = 0; n < e.length; n++) t.push(e[n]);
        else t.push(e);
        return t;
      }),
      (n.removeFrom = function (e, t) {
        var n = e.indexOf(t);
        n != -1 && e.splice(n, 1);
      }),
      (n.getParent = function (e, n) {
        for (; e.parentNode && e != document.body; ) if (((e = e.parentNode), t(e, n))) return e;
      }),
      (n.getQueryElement = function (e) {
        return "string" == typeof e ? document.querySelector(e) : e;
      }),
      (n.handleEvent = function (e) {
        var t = "on" + e.type;
        this[t] && this[t](e);
      }),
      (n.filterFindElements = function (e, i) {
        e = n.makeArray(e);
        var r = [];
        return (
          e.forEach(function (e) {
            if (e instanceof HTMLElement) {
              if (!i) return void r.push(e);
              t(e, i) && r.push(e);
              for (var n = e.querySelectorAll(i), o = 0; o < n.length; o++) r.push(n[o]);
            }
          }),
          r
        );
      }),
      (n.debounceMethod = function (e, t, n) {
        var i = e.prototype[t],
          r = t + "Timeout";
        e.prototype[t] = function () {
          var e = this[r];
          e && clearTimeout(e);
          var t = arguments,
            o = this;
          this[r] = setTimeout(function () {
            i.apply(o, t), delete o[r];
          }, n || 100);
        };
      }),
      (n.docReady = function (e) {
        var t = document.readyState;
        "complete" == t || "interactive" == t ? setTimeout(e) : document.addEventListener("DOMContentLoaded", e);
      }),
      (n.toDashed = function (e) {
        return e
          .replace(/(.)([A-Z])/g, function (e, t, n) {
            return t + "-" + n;
          })
          .toLowerCase();
      });
    var i = e.console;
    return (
      (n.htmlInit = function (t, r) {
        n.docReady(function () {
          var o = n.toDashed(r),
            a = "data-" + o,
            s = document.querySelectorAll("[" + a + "]"),
            l = document.querySelectorAll(".js-" + o),
            u = n.makeArray(s).concat(n.makeArray(l)),
            c = a + "-options",
            f = e.jQuery;
          u.forEach(function (e) {
            var n,
              o = e.getAttribute(a) || e.getAttribute(c);
            try {
              n = o && JSON.parse(o);
            } catch (t) {
              return void (i && i.error("Error parsing " + a + " on " + e.className + ": " + t));
            }
            var s = new t(e, n);
            f && f.data(e, r, s);
          });
        });
      }),
      n
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/cell", ["get-size/get-size"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("get-size")))
      : ((e.Flickity = e.Flickity || {}), (e.Flickity.Cell = t(e, e.getSize)));
  })(window, function (e, t) {
    function n(e, t) {
      (this.element = e), (this.parent = t), this.create();
    }
    var i = n.prototype;
    return (
      (i.create = function () {
        (this.element.style.position = "absolute"), (this.x = 0), (this.shift = 0);
      }),
      (i.destroy = function () {
        this.element.style.position = "";
        var e = this.parent.originSide;
        this.element.style[e] = "";
      }),
      (i.getSize = function () {
        this.size = t(this.element);
      }),
      (i.setPosition = function (e) {
        (this.x = e), this.updateTarget(), this.renderPosition(e);
      }),
      (i.updateTarget = i.setDefaultTarget = function () {
        var e = "left" == this.parent.originSide ? "marginLeft" : "marginRight";
        this.target = this.x + this.size[e] + this.size.width * this.parent.cellAlign;
      }),
      (i.renderPosition = function (e) {
        var t = this.parent.originSide;
        this.element.style[t] = this.parent.getPositionValue(e);
      }),
      (i.wrapShift = function (e) {
        (this.shift = e), this.renderPosition(this.x + this.parent.slideableWidth * e);
      }),
      (i.remove = function () {
        this.element.parentNode.removeChild(this.element);
      }),
      n
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/slide", t)
      : "object" == typeof module && module.exports
      ? (module.exports = t())
      : ((e.Flickity = e.Flickity || {}), (e.Flickity.Slide = t()));
  })(window, function () {
    "use strict";
    function e(e) {
      (this.parent = e),
        (this.isOriginLeft = "left" == e.originSide),
        (this.cells = []),
        (this.outerWidth = 0),
        (this.height = 0);
    }
    var t = e.prototype;
    return (
      (t.addCell = function (e) {
        if (
          (this.cells.push(e),
          (this.outerWidth += e.size.outerWidth),
          (this.height = Math.max(e.size.outerHeight, this.height)),
          1 == this.cells.length)
        ) {
          this.x = e.x;
          var t = this.isOriginLeft ? "marginLeft" : "marginRight";
          this.firstMargin = e.size[t];
        }
      }),
      (t.updateTarget = function () {
        var e = this.isOriginLeft ? "marginRight" : "marginLeft",
          t = this.getLastCell(),
          n = t ? t.size[e] : 0,
          i = this.outerWidth - (this.firstMargin + n);
        this.target = this.x + this.firstMargin + i * this.parent.cellAlign;
      }),
      (t.getLastCell = function () {
        return this.cells[this.cells.length - 1];
      }),
      (t.select = function () {
        this.changeSelectedClass("add");
      }),
      (t.unselect = function () {
        this.changeSelectedClass("remove");
      }),
      (t.changeSelectedClass = function (e) {
        this.cells.forEach(function (t) {
          t.element.classList[e]("is-selected");
        });
      }),
      (t.getCellElements = function () {
        return this.cells.map(function (e) {
          return e.element;
        });
      }),
      e
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/animate", ["fizzy-ui-utils/utils"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("fizzy-ui-utils")))
      : ((e.Flickity = e.Flickity || {}), (e.Flickity.animatePrototype = t(e, e.fizzyUIUtils)));
  })(window, function (e, t) {
    var n = e.requestAnimationFrame || e.webkitRequestAnimationFrame,
      i = 0;
    n ||
      (n = function (e) {
        var t = new Date().getTime(),
          n = Math.max(0, 16 - (t - i)),
          r = setTimeout(e, n);
        return (i = t + n), r;
      });
    var r = {};
    (r.startAnimation = function () {
      this.isAnimating || ((this.isAnimating = !0), (this.restingFrames = 0), this.animate());
    }),
      (r.animate = function () {
        this.applyDragForce(), this.applySelectedAttraction();
        var e = this.x;
        if ((this.integratePhysics(), this.positionSlider(), this.settle(e), this.isAnimating)) {
          var t = this;
          n(function () {
            t.animate();
          });
        }
      });
    var o = (function () {
      var e = document.documentElement.style;
      return "string" == typeof e.transform ? "transform" : "WebkitTransform";
    })();
    return (
      (r.positionSlider = function () {
        var e = this.x;
        this.options.wrapAround &&
          this.cells.length > 1 &&
          ((e = t.modulo(e, this.slideableWidth)), (e -= this.slideableWidth), this.shiftWrapCells(e)),
          (e += this.cursorPosition),
          (e = this.options.rightToLeft && o ? -e : e);
        var n = this.getPositionValue(e);
        this.slider.style[o] = this.isAnimating ? "translate3d(" + n + ",0,0)" : "translateX(" + n + ")";
        var i = this.slides[0];
        if (i) {
          var r = -this.x - i.target,
            a = r / this.slidesWidth;
          this.dispatchEvent("scroll", null, [a, r]);
        }
      }),
      (r.positionSliderAtSelected = function () {
        this.cells.length && ((this.x = -this.selectedSlide.target), this.positionSlider());
      }),
      (r.getPositionValue = function (e) {
        return this.options.percentPosition
          ? 0.01 * Math.round((e / this.size.innerWidth) * 1e4) + "%"
          : Math.round(e) + "px";
      }),
      (r.settle = function (e) {
        this.isPointerDown || Math.round(100 * this.x) != Math.round(100 * e) || this.restingFrames++,
          this.restingFrames > 2 &&
            ((this.isAnimating = !1), delete this.isFreeScrolling, this.positionSlider(), this.dispatchEvent("settle"));
      }),
      (r.shiftWrapCells = function (e) {
        var t = this.cursorPosition + e;
        this._shiftCells(this.beforeShiftCells, t, -1);
        var n = this.size.innerWidth - (e + this.slideableWidth + this.cursorPosition);
        this._shiftCells(this.afterShiftCells, n, 1);
      }),
      (r._shiftCells = function (e, t, n) {
        for (var i = 0; i < e.length; i++) {
          var r = e[i],
            o = t > 0 ? n : 0;
          r.wrapShift(o), (t -= r.size.outerWidth);
        }
      }),
      (r._unshiftCells = function (e) {
        if (e && e.length) for (var t = 0; t < e.length; t++) e[t].wrapShift(0);
      }),
      (r.integratePhysics = function () {
        (this.x += this.velocity), (this.velocity *= this.getFrictionFactor());
      }),
      (r.applyForce = function (e) {
        this.velocity += e;
      }),
      (r.getFrictionFactor = function () {
        return 1 - this.options[this.isFreeScrolling ? "freeScrollFriction" : "friction"];
      }),
      (r.getRestingPosition = function () {
        return this.x + this.velocity / (1 - this.getFrictionFactor());
      }),
      (r.applyDragForce = function () {
        if (this.isPointerDown) {
          var e = this.dragX - this.x,
            t = e - this.velocity;
          this.applyForce(t);
        }
      }),
      (r.applySelectedAttraction = function () {
        if (!this.isPointerDown && !this.isFreeScrolling && this.cells.length) {
          var e = this.selectedSlide.target * -1 - this.x,
            t = e * this.options.selectedAttraction;
          this.applyForce(t);
        }
      }),
      r
    );
  }),
  (function (e, t) {
    if ("function" == typeof define && define.amd)
      define("flickity/js/flickity", [
        "ev-emitter/ev-emitter",
        "get-size/get-size",
        "fizzy-ui-utils/utils",
        "./cell",
        "./slide",
        "./animate",
      ], function (n, i, r, o, a, s) {
        return t(e, n, i, r, o, a, s);
      });
    else if ("object" == typeof module && module.exports)
      module.exports = t(
        e,
        require("ev-emitter"),
        require("get-size"),
        require("fizzy-ui-utils"),
        require("./cell"),
        require("./slide"),
        require("./animate")
      );
    else {
      var n = e.Flickity;
      e.Flickity = t(e, e.EvEmitter, e.getSize, e.fizzyUIUtils, n.Cell, n.Slide, n.animatePrototype);
    }
  })(window, function (e, t, n, i, r, o, a) {
    function s(e, t) {
      for (e = i.makeArray(e); e.length; ) t.appendChild(e.shift());
    }
    function l(e, t) {
      var n = i.getQueryElement(e);
      if (!n) return void (f && f.error("Bad element for Flickity: " + (n || e)));
      if (((this.element = n), this.element.flickityGUID)) {
        var r = p[this.element.flickityGUID];
        return r.option(t), r;
      }
      u && (this.$element = u(this.element)),
        (this.options = i.extend({}, this.constructor.defaults)),
        this.option(t),
        this._create();
    }
    var u = e.jQuery,
      c = e.getComputedStyle,
      f = e.console,
      d = 0,
      p = {};
    (l.defaults = {
      accessibility: !0,
      cellAlign: "center",
      freeScrollFriction: 0.075,
      friction: 0.28,
      namespaceJQueryEvents: !0,
      percentPosition: !0,
      resize: !0,
      selectedAttraction: 0.025,
      setGallerySize: !0,
    }),
      (l.createMethods = []);
    var h = l.prototype;
    i.extend(h, t.prototype),
      (h._create = function () {
        var t = (this.guid = ++d);
        (this.element.flickityGUID = t),
          (p[t] = this),
          (this.selectedIndex = 0),
          (this.restingFrames = 0),
          (this.x = 0),
          (this.velocity = 0),
          (this.originSide = this.options.rightToLeft ? "right" : "left"),
          (this.viewport = document.createElement("div")),
          (this.viewport.className = "flickity-viewport"),
          this._createSlider(),
          (this.options.resize || this.options.watchCSS) && e.addEventListener("resize", this),
          l.createMethods.forEach(function (e) {
            this[e]();
          }, this),
          this.options.watchCSS ? this.watchCSS() : this.activate();
      }),
      (h.option = function (e) {
        i.extend(this.options, e);
      }),
      (h.activate = function () {
        if (!this.isActive) {
          (this.isActive = !0),
            this.element.classList.add("flickity-enabled"),
            this.options.rightToLeft && this.element.classList.add("flickity-rtl"),
            this.getSize();
          var e = this._filterFindCellElements(this.element.children);
          s(e, this.slider),
            this.viewport.appendChild(this.slider),
            this.element.appendChild(this.viewport),
            this.reloadCells(),
            this.options.accessibility && ((this.element.tabIndex = 0), this.element.addEventListener("keydown", this)),
            this.emitEvent("activate");
          var t,
            n = this.options.initialIndex;
          (t = this.isInitActivated ? this.selectedIndex : void 0 !== n && this.cells[n] ? n : 0),
            this.select(t, !1, !0),
            (this.isInitActivated = !0);
        }
      }),
      (h._createSlider = function () {
        var e = document.createElement("div");
        (e.className = "flickity-slider"), (e.style[this.originSide] = 0), (this.slider = e);
      }),
      (h._filterFindCellElements = function (e) {
        return i.filterFindElements(e, this.options.cellSelector);
      }),
      (h.reloadCells = function () {
        (this.cells = this._makeCells(this.slider.children)),
          this.positionCells(),
          this._getWrapShiftCells(),
          this.setGallerySize();
      }),
      (h._makeCells = function (e) {
        var t = this._filterFindCellElements(e),
          n = t.map(function (e) {
            return new r(e, this);
          }, this);
        return n;
      }),
      (h.getLastCell = function () {
        return this.cells[this.cells.length - 1];
      }),
      (h.getLastSlide = function () {
        return this.slides[this.slides.length - 1];
      }),
      (h.positionCells = function () {
        this._sizeCells(this.cells), this._positionCells(0);
      }),
      (h._positionCells = function (e) {
        (e = e || 0), (this.maxCellHeight = e ? this.maxCellHeight || 0 : 0);
        var t = 0;
        if (e > 0) {
          var n = this.cells[e - 1];
          t = n.x + n.size.outerWidth;
        }
        for (var i = this.cells.length, r = e; r < i; r++) {
          var o = this.cells[r];
          o.setPosition(t),
            (t += o.size.outerWidth),
            (this.maxCellHeight = Math.max(o.size.outerHeight, this.maxCellHeight));
        }
        (this.slideableWidth = t),
          this.updateSlides(),
          this._containSlides(),
          (this.slidesWidth = i ? this.getLastSlide().target - this.slides[0].target : 0);
      }),
      (h._sizeCells = function (e) {
        e.forEach(function (e) {
          e.getSize();
        });
      }),
      (h.updateSlides = function () {
        if (((this.slides = []), this.cells.length)) {
          var e = new o(this);
          this.slides.push(e);
          var t = "left" == this.originSide,
            n = t ? "marginRight" : "marginLeft",
            i = this._getCanCellFit();
          this.cells.forEach(function (t, r) {
            if (!e.cells.length) return void e.addCell(t);
            var a = e.outerWidth - e.firstMargin + (t.size.outerWidth - t.size[n]);
            i.call(this, r, a)
              ? e.addCell(t)
              : (e.updateTarget(), (e = new o(this)), this.slides.push(e), e.addCell(t));
          }, this),
            e.updateTarget(),
            this.updateSelectedSlide();
        }
      }),
      (h._getCanCellFit = function () {
        var e = this.options.groupCells;
        if (!e)
          return function () {
            return !1;
          };
        if ("number" == typeof e) {
          var t = parseInt(e, 10);
          return function (e) {
            return e % t !== 0;
          };
        }
        var n = "string" == typeof e && e.match(/^(\d+)%$/),
          i = n ? parseInt(n[1], 10) / 100 : 1;
        return function (e, t) {
          return t <= (this.size.innerWidth + 1) * i;
        };
      }),
      (h._init = h.reposition = function () {
        this.positionCells(), this.positionSliderAtSelected();
      }),
      (h.getSize = function () {
        (this.size = n(this.element)),
          this.setCellAlign(),
          (this.cursorPosition = this.size.innerWidth * this.cellAlign);
      });
    var m = { center: { left: 0.5, right: 0.5 }, left: { left: 0, right: 1 }, right: { right: 0, left: 1 } };
    return (
      (h.setCellAlign = function () {
        var e = m[this.options.cellAlign];
        this.cellAlign = e ? e[this.originSide] : this.options.cellAlign;
      }),
      (h.setGallerySize = function () {
        if (this.options.setGallerySize) {
          var e = this.options.adaptiveHeight && this.selectedSlide ? this.selectedSlide.height : this.maxCellHeight;
          this.viewport.style.height = e + "px";
        }
      }),
      (h._getWrapShiftCells = function () {
        if (this.options.wrapAround) {
          this._unshiftCells(this.beforeShiftCells), this._unshiftCells(this.afterShiftCells);
          var e = this.cursorPosition,
            t = this.cells.length - 1;
          (this.beforeShiftCells = this._getGapCells(e, t, -1)),
            (e = this.size.innerWidth - this.cursorPosition),
            (this.afterShiftCells = this._getGapCells(e, 0, 1));
        }
      }),
      (h._getGapCells = function (e, t, n) {
        for (var i = []; e > 0; ) {
          var r = this.cells[t];
          if (!r) break;
          i.push(r), (t += n), (e -= r.size.outerWidth);
        }
        return i;
      }),
      (h._containSlides = function () {
        if (this.options.contain && !this.options.wrapAround && this.cells.length) {
          var e = this.options.rightToLeft,
            t = e ? "marginRight" : "marginLeft",
            n = e ? "marginLeft" : "marginRight",
            i = this.slideableWidth - this.getLastCell().size[n],
            r = i < this.size.innerWidth,
            o = this.cursorPosition + this.cells[0].size[t],
            a = i - this.size.innerWidth * (1 - this.cellAlign);
          this.slides.forEach(function (e) {
            r
              ? (e.target = i * this.cellAlign)
              : ((e.target = Math.max(e.target, o)), (e.target = Math.min(e.target, a)));
          }, this);
        }
      }),
      (h.dispatchEvent = function (e, t, n) {
        var i = t ? [t].concat(n) : n;
        if ((this.emitEvent(e, i), u && this.$element)) {
          e += this.options.namespaceJQueryEvents ? ".flickity" : "";
          var r = e;
          if (t) {
            var o = u.Event(t);
            (o.type = e), (r = o);
          }
          this.$element.trigger(r, n);
        }
      }),
      (h.select = function (e, t, n) {
        this.isActive &&
          ((e = parseInt(e, 10)),
          this._wrapSelect(e),
          (this.options.wrapAround || t) && (e = i.modulo(e, this.slides.length)),
          this.slides[e] &&
            ((this.selectedIndex = e),
            this.updateSelectedSlide(),
            n ? this.positionSliderAtSelected() : this.startAnimation(),
            this.options.adaptiveHeight && this.setGallerySize(),
            this.dispatchEvent("select"),
            this.dispatchEvent("cellSelect")));
      }),
      (h._wrapSelect = function (e) {
        var t = this.slides.length,
          n = this.options.wrapAround && t > 1;
        if (!n) return e;
        var r = i.modulo(e, t),
          o = Math.abs(r - this.selectedIndex),
          a = Math.abs(r + t - this.selectedIndex),
          s = Math.abs(r - t - this.selectedIndex);
        !this.isDragSelect && a < o ? (e += t) : !this.isDragSelect && s < o && (e -= t),
          e < 0 ? (this.x -= this.slideableWidth) : e >= t && (this.x += this.slideableWidth);
      }),
      (h.previous = function (e, t) {
        this.select(this.selectedIndex - 1, e, t);
      }),
      (h.next = function (e, t) {
        this.select(this.selectedIndex + 1, e, t);
      }),
      (h.updateSelectedSlide = function () {
        var e = this.slides[this.selectedIndex];
        e &&
          (this.unselectSelectedSlide(),
          (this.selectedSlide = e),
          e.select(),
          (this.selectedCells = e.cells),
          (this.selectedElements = e.getCellElements()),
          (this.selectedCell = e.cells[0]),
          (this.selectedElement = this.selectedElements[0]));
      }),
      (h.unselectSelectedSlide = function () {
        this.selectedSlide && this.selectedSlide.unselect();
      }),
      (h.selectCell = function (e, t, n) {
        var i;
        "number" == typeof e
          ? (i = this.cells[e])
          : ("string" == typeof e && (e = this.element.querySelector(e)), (i = this.getCell(e)));
        for (var r = 0; i && r < this.slides.length; r++) {
          var o = this.slides[r],
            a = o.cells.indexOf(i);
          if (a != -1) return void this.select(r, t, n);
        }
      }),
      (h.getCell = function (e) {
        for (var t = 0; t < this.cells.length; t++) {
          var n = this.cells[t];
          if (n.element == e) return n;
        }
      }),
      (h.getCells = function (e) {
        e = i.makeArray(e);
        var t = [];
        return (
          e.forEach(function (e) {
            var n = this.getCell(e);
            n && t.push(n);
          }, this),
          t
        );
      }),
      (h.getCellElements = function () {
        return this.cells.map(function (e) {
          return e.element;
        });
      }),
      (h.getParentCell = function (e) {
        var t = this.getCell(e);
        return t ? t : ((e = i.getParent(e, ".flickity-slider > *")), this.getCell(e));
      }),
      (h.getAdjacentCellElements = function (e, t) {
        if (!e) return this.selectedSlide.getCellElements();
        t = void 0 === t ? this.selectedIndex : t;
        var n = this.slides.length;
        if (1 + 2 * e >= n) return this.getCellElements();
        for (var r = [], o = t - e; o <= t + e; o++) {
          var a = this.options.wrapAround ? i.modulo(o, n) : o,
            s = this.slides[a];
          s && (r = r.concat(s.getCellElements()));
        }
        return r;
      }),
      (h.uiChange = function () {
        this.emitEvent("uiChange");
      }),
      (h.childUIPointerDown = function (e) {
        this.emitEvent("childUIPointerDown", [e]);
      }),
      (h.onresize = function () {
        this.watchCSS(), this.resize();
      }),
      i.debounceMethod(l, "onresize", 150),
      (h.resize = function () {
        if (this.isActive) {
          this.getSize(),
            this.options.wrapAround && (this.x = i.modulo(this.x, this.slideableWidth)),
            this.positionCells(),
            this._getWrapShiftCells(),
            this.setGallerySize(),
            this.emitEvent("resize");
          var e = this.selectedElements && this.selectedElements[0];
          this.selectCell(e, !1, !0);
        }
      }),
      (h.watchCSS = function () {
        var e = this.options.watchCSS;
        if (e) {
          var t = c(this.element, ":after").content;
          t.indexOf("flickity") != -1 ? this.activate() : this.deactivate();
        }
      }),
      (h.onkeydown = function (e) {
        if (this.options.accessibility && (!document.activeElement || document.activeElement == this.element))
          if (37 == e.keyCode) {
            var t = this.options.rightToLeft ? "next" : "previous";
            this.uiChange(), this[t]();
          } else if (39 == e.keyCode) {
            var n = this.options.rightToLeft ? "previous" : "next";
            this.uiChange(), this[n]();
          }
      }),
      (h.deactivate = function () {
        this.isActive &&
          (this.element.classList.remove("flickity-enabled"),
          this.element.classList.remove("flickity-rtl"),
          this.cells.forEach(function (e) {
            e.destroy();
          }),
          this.unselectSelectedSlide(),
          this.element.removeChild(this.viewport),
          s(this.slider.children, this.element),
          this.options.accessibility &&
            (this.element.removeAttribute("tabIndex"), this.element.removeEventListener("keydown", this)),
          (this.isActive = !1),
          this.emitEvent("deactivate"));
      }),
      (h.destroy = function () {
        this.deactivate(),
          e.removeEventListener("resize", this),
          this.emitEvent("destroy"),
          u && this.$element && u.removeData(this.element, "flickity"),
          delete this.element.flickityGUID,
          delete p[this.guid];
      }),
      i.extend(h, a),
      (l.data = function (e) {
        e = i.getQueryElement(e);
        var t = e && e.flickityGUID;
        return t && p[t];
      }),
      i.htmlInit(l, "flickity"),
      u && u.bridget && u.bridget("flickity", l),
      (l.setJQuery = function (e) {
        u = e;
      }),
      (l.Cell = r),
      l
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("unipointer/unipointer", ["ev-emitter/ev-emitter"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("ev-emitter")))
      : (e.Unipointer = t(e, e.EvEmitter));
  })(window, function (e, t) {
    function n() {}
    function i() {}
    var r = (i.prototype = Object.create(t.prototype));
    (r.bindStartEvent = function (e) {
      this._bindStartEvent(e, !0);
    }),
      (r.unbindStartEvent = function (e) {
        this._bindStartEvent(e, !1);
      }),
      (r._bindStartEvent = function (t, n) {
        n = void 0 === n || !!n;
        var i = n ? "addEventListener" : "removeEventListener";
        e.PointerEvent ? t[i]("pointerdown", this) : (t[i]("mousedown", this), t[i]("touchstart", this));
      }),
      (r.handleEvent = function (e) {
        var t = "on" + e.type;
        this[t] && this[t](e);
      }),
      (r.getTouch = function (e) {
        for (var t = 0; t < e.length; t++) {
          var n = e[t];
          if (n.identifier == this.pointerIdentifier) return n;
        }
      }),
      (r.onmousedown = function (e) {
        var t = e.button;
        (t && 0 !== t && 1 !== t) || this._pointerDown(e, e);
      }),
      (r.ontouchstart = function (e) {
        this._pointerDown(e, e.changedTouches[0]);
      }),
      (r.onpointerdown = function (e) {
        this._pointerDown(e, e);
      }),
      (r._pointerDown = function (e, t) {
        this.isPointerDown ||
          ((this.isPointerDown = !0),
          (this.pointerIdentifier = void 0 !== t.pointerId ? t.pointerId : t.identifier),
          this.pointerDown(e, t));
      }),
      (r.pointerDown = function (e, t) {
        this._bindPostStartEvents(e), this.emitEvent("pointerDown", [e, t]);
      });
    var o = {
      mousedown: ["mousemove", "mouseup"],
      touchstart: ["touchmove", "touchend", "touchcancel"],
      pointerdown: ["pointermove", "pointerup", "pointercancel"],
    };
    return (
      (r._bindPostStartEvents = function (t) {
        if (t) {
          var n = o[t.type];
          n.forEach(function (t) {
            e.addEventListener(t, this);
          }, this),
            (this._boundPointerEvents = n);
        }
      }),
      (r._unbindPostStartEvents = function () {
        this._boundPointerEvents &&
          (this._boundPointerEvents.forEach(function (t) {
            e.removeEventListener(t, this);
          }, this),
          delete this._boundPointerEvents);
      }),
      (r.onmousemove = function (e) {
        this._pointerMove(e, e);
      }),
      (r.onpointermove = function (e) {
        e.pointerId == this.pointerIdentifier && this._pointerMove(e, e);
      }),
      (r.ontouchmove = function (e) {
        var t = this.getTouch(e.changedTouches);
        t && this._pointerMove(e, t);
      }),
      (r._pointerMove = function (e, t) {
        this.pointerMove(e, t);
      }),
      (r.pointerMove = function (e, t) {
        this.emitEvent("pointerMove", [e, t]);
      }),
      (r.onmouseup = function (e) {
        this._pointerUp(e, e);
      }),
      (r.onpointerup = function (e) {
        e.pointerId == this.pointerIdentifier && this._pointerUp(e, e);
      }),
      (r.ontouchend = function (e) {
        var t = this.getTouch(e.changedTouches);
        t && this._pointerUp(e, t);
      }),
      (r._pointerUp = function (e, t) {
        this._pointerDone(), this.pointerUp(e, t);
      }),
      (r.pointerUp = function (e, t) {
        this.emitEvent("pointerUp", [e, t]);
      }),
      (r._pointerDone = function () {
        (this.isPointerDown = !1), delete this.pointerIdentifier, this._unbindPostStartEvents(), this.pointerDone();
      }),
      (r.pointerDone = n),
      (r.onpointercancel = function (e) {
        e.pointerId == this.pointerIdentifier && this._pointerCancel(e, e);
      }),
      (r.ontouchcancel = function (e) {
        var t = this.getTouch(e.changedTouches);
        t && this._pointerCancel(e, t);
      }),
      (r._pointerCancel = function (e, t) {
        this._pointerDone(), this.pointerCancel(e, t);
      }),
      (r.pointerCancel = function (e, t) {
        this.emitEvent("pointerCancel", [e, t]);
      }),
      (i.getPointerPoint = function (e) {
        return { x: e.pageX, y: e.pageY };
      }),
      i
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("unidragger/unidragger", ["unipointer/unipointer"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("unipointer")))
      : (e.Unidragger = t(e, e.Unipointer));
  })(window, function (e, t) {
    function n() {}
    var i = (n.prototype = Object.create(t.prototype));
    (i.bindHandles = function () {
      this._bindHandles(!0);
    }),
      (i.unbindHandles = function () {
        this._bindHandles(!1);
      });
    e.navigator;
    return (
      (i._bindHandles = function (e) {
        e = void 0 === e || !!e;
        for (
          var t = e ? "none" : "", n = e ? "addEventListener" : "removeEventListener", i = 0;
          i < this.handles.length;
          i++
        ) {
          var r = this.handles[i];
          this._bindStartEvent(r, e), (r.style.touchAction = t), r[n]("click", this);
        }
      }),
      (i.pointerDown = function (e, t) {
        if ("INPUT" == e.target.nodeName && "range" == e.target.type)
          return (this.isPointerDown = !1), void delete this.pointerIdentifier;
        this._dragPointerDown(e, t);
        var n = document.activeElement;
        n && n.blur && n.blur(), this._bindPostStartEvents(e), this.emitEvent("pointerDown", [e, t]);
      }),
      (i._dragPointerDown = function (e, n) {
        this.pointerDownPoint = t.getPointerPoint(n);
        var i = this.canPreventDefaultOnPointerDown(e, n);
        i && e.preventDefault();
      }),
      (i.canPreventDefaultOnPointerDown = function (e) {
        return "SELECT" != e.target.nodeName;
      }),
      (i.pointerMove = function (e, t) {
        var n = this._dragPointerMove(e, t);
        this.emitEvent("pointerMove", [e, t, n]), this._dragMove(e, t, n);
      }),
      (i._dragPointerMove = function (e, n) {
        var i = t.getPointerPoint(n),
          r = { x: i.x - this.pointerDownPoint.x, y: i.y - this.pointerDownPoint.y };
        return !this.isDragging && this.hasDragStarted(r) && this._dragStart(e, n), r;
      }),
      (i.hasDragStarted = function (e) {
        return Math.abs(e.x) > 3 || Math.abs(e.y) > 3;
      }),
      (i.pointerUp = function (e, t) {
        this.emitEvent("pointerUp", [e, t]), this._dragPointerUp(e, t);
      }),
      (i._dragPointerUp = function (e, t) {
        this.isDragging ? this._dragEnd(e, t) : this._staticClick(e, t);
      }),
      (i._dragStart = function (e, n) {
        (this.isDragging = !0),
          (this.dragStartPoint = t.getPointerPoint(n)),
          (this.isPreventingClicks = !0),
          this.dragStart(e, n);
      }),
      (i.dragStart = function (e, t) {
        this.emitEvent("dragStart", [e, t]);
      }),
      (i._dragMove = function (e, t, n) {
        this.isDragging && this.dragMove(e, t, n);
      }),
      (i.dragMove = function (e, t, n) {
        e.preventDefault(), this.emitEvent("dragMove", [e, t, n]);
      }),
      (i._dragEnd = function (e, t) {
        (this.isDragging = !1),
          setTimeout(
            function () {
              delete this.isPreventingClicks;
            }.bind(this)
          ),
          this.dragEnd(e, t);
      }),
      (i.dragEnd = function (e, t) {
        this.emitEvent("dragEnd", [e, t]);
      }),
      (i.onclick = function (e) {
        this.isPreventingClicks && e.preventDefault();
      }),
      (i._staticClick = function (e, t) {
        if (!this.isIgnoringMouseUp || "mouseup" != e.type) {
          var n = e.target.nodeName;
          ("INPUT" != n && "TEXTAREA" != n) || e.target.focus(),
            this.staticClick(e, t),
            "mouseup" != e.type &&
              ((this.isIgnoringMouseUp = !0),
              setTimeout(
                function () {
                  delete this.isIgnoringMouseUp;
                }.bind(this),
                400
              ));
        }
      }),
      (i.staticClick = function (e, t) {
        this.emitEvent("staticClick", [e, t]);
      }),
      (n.getPointerPoint = t.getPointerPoint),
      n
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/drag", ["./flickity", "unidragger/unidragger", "fizzy-ui-utils/utils"], function (n, i, r) {
          return t(e, n, i, r);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("./flickity"), require("unidragger"), require("fizzy-ui-utils")))
      : (e.Flickity = t(e, e.Flickity, e.Unidragger, e.fizzyUIUtils));
  })(window, function (e, t, n, i) {
    function r() {
      return { x: e.pageXOffset, y: e.pageYOffset };
    }
    i.extend(t.defaults, { draggable: !0, dragThreshold: 3 }), t.createMethods.push("_createDrag");
    var o = t.prototype;
    i.extend(o, n.prototype);
    var a = "createTouch" in document,
      s = !1;
    (o._createDrag = function () {
      this.on("activate", this.bindDrag),
        this.on("uiChange", this._uiChangeDrag),
        this.on("childUIPointerDown", this._childUIPointerDownDrag),
        this.on("deactivate", this.unbindDrag),
        a && !s && (e.addEventListener("touchmove", function () {}), (s = !0));
    }),
      (o.bindDrag = function () {
        this.options.draggable &&
          !this.isDragBound &&
          (this.element.classList.add("is-draggable"),
          (this.handles = [this.viewport]),
          this.bindHandles(),
          (this.isDragBound = !0));
      }),
      (o.unbindDrag = function () {
        this.isDragBound &&
          (this.element.classList.remove("is-draggable"), this.unbindHandles(), delete this.isDragBound);
      }),
      (o._uiChangeDrag = function () {
        delete this.isFreeScrolling;
      }),
      (o._childUIPointerDownDrag = function (e) {
        e.preventDefault(), this.pointerDownFocus(e);
      });
    var l = { TEXTAREA: !0, INPUT: !0, OPTION: !0 },
      u = { radio: !0, checkbox: !0, button: !0, submit: !0, image: !0, file: !0 };
    o.pointerDown = function (t, n) {
      var i = l[t.target.nodeName] && !u[t.target.type];
      if (i) return (this.isPointerDown = !1), void delete this.pointerIdentifier;
      this._dragPointerDown(t, n);
      var o = document.activeElement;
      o && o.blur && o != this.element && o != document.body && o.blur(),
        this.pointerDownFocus(t),
        (this.dragX = this.x),
        this.viewport.classList.add("is-pointer-down"),
        this._bindPostStartEvents(t),
        (this.pointerDownScroll = r()),
        e.addEventListener("scroll", this),
        this.dispatchEvent("pointerDown", t, [n]);
    };
    var c = { touchstart: !0, MSPointerDown: !0 },
      f = { INPUT: !0, SELECT: !0 };
    return (
      (o.pointerDownFocus = function (t) {
        if (this.options.accessibility && !c[t.type] && !f[t.target.nodeName]) {
          var n = e.pageYOffset;
          this.element.focus(), e.pageYOffset != n && e.scrollTo(e.pageXOffset, n);
        }
      }),
      (o.canPreventDefaultOnPointerDown = function (e) {
        var t = "touchstart" == e.type,
          n = e.target.nodeName;
        return !t && "SELECT" != n;
      }),
      (o.hasDragStarted = function (e) {
        return Math.abs(e.x) > this.options.dragThreshold;
      }),
      (o.pointerUp = function (e, t) {
        delete this.isTouchScrolling,
          this.viewport.classList.remove("is-pointer-down"),
          this.dispatchEvent("pointerUp", e, [t]),
          this._dragPointerUp(e, t);
      }),
      (o.pointerDone = function () {
        e.removeEventListener("scroll", this), delete this.pointerDownScroll;
      }),
      (o.dragStart = function (t, n) {
        (this.dragStartPosition = this.x),
          this.startAnimation(),
          e.removeEventListener("scroll", this),
          this.dispatchEvent("dragStart", t, [n]);
      }),
      (o.pointerMove = function (e, t) {
        var n = this._dragPointerMove(e, t);
        this.dispatchEvent("pointerMove", e, [t, n]), this._dragMove(e, t, n);
      }),
      (o.dragMove = function (e, t, n) {
        e.preventDefault(), (this.previousDragX = this.dragX);
        var i = this.options.rightToLeft ? -1 : 1,
          r = this.dragStartPosition + n.x * i;
        if (!this.options.wrapAround && this.slides.length) {
          var o = Math.max(-this.slides[0].target, this.dragStartPosition);
          r = r > o ? 0.5 * (r + o) : r;
          var a = Math.min(-this.getLastSlide().target, this.dragStartPosition);
          r = r < a ? 0.5 * (r + a) : r;
        }
        (this.dragX = r), (this.dragMoveTime = new Date()), this.dispatchEvent("dragMove", e, [t, n]);
      }),
      (o.dragEnd = function (e, t) {
        this.options.freeScroll && (this.isFreeScrolling = !0);
        var n = this.dragEndRestingSelect();
        if (this.options.freeScroll && !this.options.wrapAround) {
          var i = this.getRestingPosition();
          this.isFreeScrolling = -i > this.slides[0].target && -i < this.getLastSlide().target;
        } else this.options.freeScroll || n != this.selectedIndex || (n += this.dragEndBoostSelect());
        delete this.previousDragX,
          (this.isDragSelect = this.options.wrapAround),
          this.select(n),
          delete this.isDragSelect,
          this.dispatchEvent("dragEnd", e, [t]);
      }),
      (o.dragEndRestingSelect = function () {
        var e = this.getRestingPosition(),
          t = Math.abs(this.getSlideDistance(-e, this.selectedIndex)),
          n = this._getClosestResting(e, t, 1),
          i = this._getClosestResting(e, t, -1),
          r = n.distance < i.distance ? n.index : i.index;
        return r;
      }),
      (o._getClosestResting = function (e, t, n) {
        for (
          var i = this.selectedIndex,
            r = 1 / 0,
            o =
              this.options.contain && !this.options.wrapAround
                ? function (e, t) {
                    return e <= t;
                  }
                : function (e, t) {
                    return e < t;
                  };
          o(t, r) && ((i += n), (r = t), (t = this.getSlideDistance(-e, i)), null !== t);

        )
          t = Math.abs(t);
        return { distance: r, index: i - n };
      }),
      (o.getSlideDistance = function (e, t) {
        var n = this.slides.length,
          r = this.options.wrapAround && n > 1,
          o = r ? i.modulo(t, n) : t,
          a = this.slides[o];
        if (!a) return null;
        var s = r ? this.slideableWidth * Math.floor(t / n) : 0;
        return e - (a.target + s);
      }),
      (o.dragEndBoostSelect = function () {
        if (void 0 === this.previousDragX || !this.dragMoveTime || new Date() - this.dragMoveTime > 100) return 0;
        var e = this.getSlideDistance(-this.dragX, this.selectedIndex),
          t = this.previousDragX - this.dragX;
        return e > 0 && t > 0 ? 1 : e < 0 && t < 0 ? -1 : 0;
      }),
      (o.staticClick = function (e, t) {
        var n = this.getParentCell(e.target),
          i = n && n.element,
          r = n && this.cells.indexOf(n);
        this.dispatchEvent("staticClick", e, [t, i, r]);
      }),
      (o.onscroll = function () {
        var e = r(),
          t = this.pointerDownScroll.x - e.x,
          n = this.pointerDownScroll.y - e.y;
        (Math.abs(t) > 3 || Math.abs(n) > 3) && this._pointerDone();
      }),
      t
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("tap-listener/tap-listener", ["unipointer/unipointer"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("unipointer")))
      : (e.TapListener = t(e, e.Unipointer));
  })(window, function (e, t) {
    function n(e) {
      this.bindTap(e);
    }
    var i = (n.prototype = Object.create(t.prototype));
    return (
      (i.bindTap = function (e) {
        e && (this.unbindTap(), (this.tapElement = e), this._bindStartEvent(e, !0));
      }),
      (i.unbindTap = function () {
        this.tapElement && (this._bindStartEvent(this.tapElement, !0), delete this.tapElement);
      }),
      (i.pointerUp = function (n, i) {
        if (!this.isIgnoringMouseUp || "mouseup" != n.type) {
          var r = t.getPointerPoint(i),
            o = this.tapElement.getBoundingClientRect(),
            a = e.pageXOffset,
            s = e.pageYOffset,
            l = r.x >= o.left + a && r.x <= o.right + a && r.y >= o.top + s && r.y <= o.bottom + s;
          if ((l && this.emitEvent("tap", [n, i]), "mouseup" != n.type)) {
            this.isIgnoringMouseUp = !0;
            var u = this;
            setTimeout(function () {
              delete u.isIgnoringMouseUp;
            }, 400);
          }
        }
      }),
      (i.destroy = function () {
        this.pointerDone(), this.unbindTap();
      }),
      n
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/prev-next-button", [
          "./flickity",
          "tap-listener/tap-listener",
          "fizzy-ui-utils/utils",
        ], function (n, i, r) {
          return t(e, n, i, r);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("./flickity"), require("tap-listener"), require("fizzy-ui-utils")))
      : t(e, e.Flickity, e.TapListener, e.fizzyUIUtils);
  })(window, function (e, t, n, i) {
    "use strict";
    function r(e, t) {
      (this.direction = e), (this.parent = t), this._create();
    }
    function o(e) {
      return "string" == typeof e
        ? e
        : "M " +
            e.x0 +
            ",50 L " +
            e.x1 +
            "," +
            (e.y1 + 50) +
            " L " +
            e.x2 +
            "," +
            (e.y2 + 50) +
            " L " +
            e.x3 +
            ",50  L " +
            e.x2 +
            "," +
            (50 - e.y2) +
            " L " +
            e.x1 +
            "," +
            (50 - e.y1) +
            " Z";
    }
    var a = "http://www.w3.org/2000/svg";
    (r.prototype = new n()),
      (r.prototype._create = function () {
        (this.isEnabled = !0), (this.isPrevious = this.direction == -1);
        var e = this.parent.options.rightToLeft ? 1 : -1;
        this.isLeft = this.direction == e;
        var t = (this.element = document.createElement("button"));
        (t.className = "flickity-prev-next-button"),
          (t.className += this.isPrevious ? " previous" : " next"),
          t.setAttribute("type", "button"),
          this.disable(),
          t.setAttribute("aria-label", this.isPrevious ? "previous" : "next");
        var n = this.createSVG();
        t.appendChild(n),
          this.on("tap", this.onTap),
          this.parent.on("select", this.update.bind(this)),
          this.on("pointerDown", this.parent.childUIPointerDown.bind(this.parent));
      }),
      (r.prototype.activate = function () {
        this.bindTap(this.element),
          this.element.addEventListener("click", this),
          this.parent.element.appendChild(this.element);
      }),
      (r.prototype.deactivate = function () {
        this.parent.element.removeChild(this.element),
          n.prototype.destroy.call(this),
          this.element.removeEventListener("click", this);
      }),
      (r.prototype.createSVG = function () {
        var e = document.createElementNS(a, "svg");
        e.setAttribute("viewBox", "0 0 100 100");
        var t = document.createElementNS(a, "path"),
          n = o(this.parent.options.arrowShape);
        return (
          t.setAttribute("d", n),
          t.setAttribute("class", "arrow"),
          this.isLeft || t.setAttribute("transform", "translate(100, 100) rotate(180) "),
          e.appendChild(t),
          e
        );
      }),
      (r.prototype.onTap = function () {
        if (this.isEnabled) {
          this.parent.uiChange();
          var e = this.isPrevious ? "previous" : "next";
          this.parent[e]();
        }
      }),
      (r.prototype.handleEvent = i.handleEvent),
      (r.prototype.onclick = function () {
        var e = document.activeElement;
        e && e == this.element && this.onTap();
      }),
      (r.prototype.enable = function () {
        this.isEnabled || ((this.element.disabled = !1), (this.isEnabled = !0));
      }),
      (r.prototype.disable = function () {
        this.isEnabled && ((this.element.disabled = !0), (this.isEnabled = !1));
      }),
      (r.prototype.update = function () {
        var e = this.parent.slides;
        if (this.parent.options.wrapAround && e.length > 1) return void this.enable();
        var t = e.length ? e.length - 1 : 0,
          n = this.isPrevious ? 0 : t,
          i = this.parent.selectedIndex == n ? "disable" : "enable";
        this[i]();
      }),
      (r.prototype.destroy = function () {
        this.deactivate();
      }),
      i.extend(t.defaults, { prevNextButtons: !0, arrowShape: { x0: 10, x1: 60, y1: 50, x2: 70, y2: 40, x3: 30 } }),
      t.createMethods.push("_createPrevNextButtons");
    var s = t.prototype;
    return (
      (s._createPrevNextButtons = function () {
        this.options.prevNextButtons &&
          ((this.prevButton = new r(-1, this)),
          (this.nextButton = new r(1, this)),
          this.on("activate", this.activatePrevNextButtons));
      }),
      (s.activatePrevNextButtons = function () {
        this.prevButton.activate(), this.nextButton.activate(), this.on("deactivate", this.deactivatePrevNextButtons);
      }),
      (s.deactivatePrevNextButtons = function () {
        this.prevButton.deactivate(),
          this.nextButton.deactivate(),
          this.off("deactivate", this.deactivatePrevNextButtons);
      }),
      (t.PrevNextButton = r),
      t
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/page-dots", ["./flickity", "tap-listener/tap-listener", "fizzy-ui-utils/utils"], function (
          n,
          i,
          r
        ) {
          return t(e, n, i, r);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("./flickity"), require("tap-listener"), require("fizzy-ui-utils")))
      : t(e, e.Flickity, e.TapListener, e.fizzyUIUtils);
  })(window, function (e, t, n, i) {
    function r(e) {
      (this.parent = e), this._create();
    }
    (r.prototype = new n()),
      (r.prototype._create = function () {
        (this.holder = document.createElement("ol")),
          (this.holder.className = "flickity-page-dots"),
          (this.dots = []),
          this.on("tap", this.onTap),
          this.on("pointerDown", this.parent.childUIPointerDown.bind(this.parent));
      }),
      (r.prototype.activate = function () {
        this.setDots(), this.bindTap(this.holder), this.parent.element.appendChild(this.holder);
      }),
      (r.prototype.deactivate = function () {
        this.parent.element.removeChild(this.holder), n.prototype.destroy.call(this);
      }),
      (r.prototype.setDots = function () {
        var e = this.parent.slides.length - this.dots.length;
        e > 0 ? this.addDots(e) : e < 0 && this.removeDots(-e);
      }),
      (r.prototype.addDots = function (e) {
        for (var t = document.createDocumentFragment(), n = []; e; ) {
          var i = document.createElement("li");
          (i.className = "dot"), t.appendChild(i), n.push(i), e--;
        }
        this.holder.appendChild(t), (this.dots = this.dots.concat(n));
      }),
      (r.prototype.removeDots = function (e) {
        var t = this.dots.splice(this.dots.length - e, e);
        t.forEach(function (e) {
          this.holder.removeChild(e);
        }, this);
      }),
      (r.prototype.updateSelected = function () {
        this.selectedDot && (this.selectedDot.className = "dot"),
          this.dots.length &&
            ((this.selectedDot = this.dots[this.parent.selectedIndex]),
            (this.selectedDot.className = "dot is-selected"));
      }),
      (r.prototype.onTap = function (e) {
        var t = e.target;
        if ("LI" == t.nodeName) {
          this.parent.uiChange();
          var n = this.dots.indexOf(t);
          this.parent.select(n);
        }
      }),
      (r.prototype.destroy = function () {
        this.deactivate();
      }),
      (t.PageDots = r),
      i.extend(t.defaults, { pageDots: !0 }),
      t.createMethods.push("_createPageDots");
    var o = t.prototype;
    return (
      (o._createPageDots = function () {
        this.options.pageDots &&
          ((this.pageDots = new r(this)),
          this.on("activate", this.activatePageDots),
          this.on("select", this.updateSelectedPageDots),
          this.on("cellChange", this.updatePageDots),
          this.on("resize", this.updatePageDots),
          this.on("deactivate", this.deactivatePageDots));
      }),
      (o.activatePageDots = function () {
        this.pageDots.activate();
      }),
      (o.updateSelectedPageDots = function () {
        this.pageDots.updateSelected();
      }),
      (o.updatePageDots = function () {
        this.pageDots.setDots();
      }),
      (o.deactivatePageDots = function () {
        this.pageDots.deactivate();
      }),
      (t.PageDots = r),
      t
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/player", ["ev-emitter/ev-emitter", "fizzy-ui-utils/utils", "./flickity"], function (
          e,
          n,
          i
        ) {
          return t(e, n, i);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(require("ev-emitter"), require("fizzy-ui-utils"), require("./flickity")))
      : t(e.EvEmitter, e.fizzyUIUtils, e.Flickity);
  })(window, function (e, t, n) {
    function i(e) {
      (this.parent = e),
        (this.state = "stopped"),
        o &&
          ((this.onVisibilityChange = function () {
            this.visibilityChange();
          }.bind(this)),
          (this.onVisibilityPlay = function () {
            this.visibilityPlay();
          }.bind(this)));
    }
    var r, o;
    "hidden" in document
      ? ((r = "hidden"), (o = "visibilitychange"))
      : "webkitHidden" in document && ((r = "webkitHidden"), (o = "webkitvisibilitychange")),
      (i.prototype = Object.create(e.prototype)),
      (i.prototype.play = function () {
        if ("playing" != this.state) {
          var e = document[r];
          if (o && e) return void document.addEventListener(o, this.onVisibilityPlay);
          (this.state = "playing"), o && document.addEventListener(o, this.onVisibilityChange), this.tick();
        }
      }),
      (i.prototype.tick = function () {
        if ("playing" == this.state) {
          var e = this.parent.options.autoPlay;
          e = "number" == typeof e ? e : 3e3;
          var t = this;
          this.clear(),
            (this.timeout = setTimeout(function () {
              t.parent.next(!0), t.tick();
            }, e));
        }
      }),
      (i.prototype.stop = function () {
        (this.state = "stopped"), this.clear(), o && document.removeEventListener(o, this.onVisibilityChange);
      }),
      (i.prototype.clear = function () {
        clearTimeout(this.timeout);
      }),
      (i.prototype.pause = function () {
        "playing" == this.state && ((this.state = "paused"), this.clear());
      }),
      (i.prototype.unpause = function () {
        "paused" == this.state && this.play();
      }),
      (i.prototype.visibilityChange = function () {
        var e = document[r];
        this[e ? "pause" : "unpause"]();
      }),
      (i.prototype.visibilityPlay = function () {
        this.play(), document.removeEventListener(o, this.onVisibilityPlay);
      }),
      t.extend(n.defaults, { pauseAutoPlayOnHover: !0 }),
      n.createMethods.push("_createPlayer");
    var a = n.prototype;
    return (
      (a._createPlayer = function () {
        (this.player = new i(this)),
          this.on("activate", this.activatePlayer),
          this.on("uiChange", this.stopPlayer),
          this.on("pointerDown", this.stopPlayer),
          this.on("deactivate", this.deactivatePlayer);
      }),
      (a.activatePlayer = function () {
        this.options.autoPlay && (this.player.play(), this.element.addEventListener("mouseenter", this));
      }),
      (a.playPlayer = function () {
        this.player.play();
      }),
      (a.stopPlayer = function () {
        this.player.stop();
      }),
      (a.pausePlayer = function () {
        this.player.pause();
      }),
      (a.unpausePlayer = function () {
        this.player.unpause();
      }),
      (a.deactivatePlayer = function () {
        this.player.stop(), this.element.removeEventListener("mouseenter", this);
      }),
      (a.onmouseenter = function () {
        this.options.pauseAutoPlayOnHover && (this.player.pause(), this.element.addEventListener("mouseleave", this));
      }),
      (a.onmouseleave = function () {
        this.player.unpause(), this.element.removeEventListener("mouseleave", this);
      }),
      (n.Player = i),
      n
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/add-remove-cell", ["./flickity", "fizzy-ui-utils/utils"], function (n, i) {
          return t(e, n, i);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("./flickity"), require("fizzy-ui-utils")))
      : t(e, e.Flickity, e.fizzyUIUtils);
  })(window, function (e, t, n) {
    function i(e) {
      var t = document.createDocumentFragment();
      return (
        e.forEach(function (e) {
          t.appendChild(e.element);
        }),
        t
      );
    }
    var r = t.prototype;
    return (
      (r.insert = function (e, t) {
        var n = this._makeCells(e);
        if (n && n.length) {
          var r = this.cells.length;
          t = void 0 === t ? r : t;
          var o = i(n),
            a = t == r;
          if (a) this.slider.appendChild(o);
          else {
            var s = this.cells[t].element;
            this.slider.insertBefore(o, s);
          }
          if (0 === t) this.cells = n.concat(this.cells);
          else if (a) this.cells = this.cells.concat(n);
          else {
            var l = this.cells.splice(t, r - t);
            this.cells = this.cells.concat(n).concat(l);
          }
          this._sizeCells(n);
          var u = t > this.selectedIndex ? 0 : n.length;
          this._cellAddedRemoved(t, u);
        }
      }),
      (r.append = function (e) {
        this.insert(e, this.cells.length);
      }),
      (r.prepend = function (e) {
        this.insert(e, 0);
      }),
      (r.remove = function (e) {
        var t,
          i,
          r = this.getCells(e),
          o = 0,
          a = r.length;
        for (t = 0; t < a; t++) {
          i = r[t];
          var s = this.cells.indexOf(i) < this.selectedIndex;
          o -= s ? 1 : 0;
        }
        for (t = 0; t < a; t++) (i = r[t]), i.remove(), n.removeFrom(this.cells, i);
        r.length && this._cellAddedRemoved(0, o);
      }),
      (r._cellAddedRemoved = function (e, t) {
        (t = t || 0),
          (this.selectedIndex += t),
          (this.selectedIndex = Math.max(0, Math.min(this.slides.length - 1, this.selectedIndex))),
          this.cellChange(e, !0),
          this.emitEvent("cellAddedRemoved", [e, t]);
      }),
      (r.cellSizeChange = function (e) {
        var t = this.getCell(e);
        if (t) {
          t.getSize();
          var n = this.cells.indexOf(t);
          this.cellChange(n);
        }
      }),
      (r.cellChange = function (e, t) {
        var n = this.slideableWidth;
        if (
          (this._positionCells(e),
          this._getWrapShiftCells(),
          this.setGallerySize(),
          this.emitEvent("cellChange", [e]),
          this.options.freeScroll)
        ) {
          var i = n - this.slideableWidth;
          (this.x += i * this.cellAlign), this.positionSlider();
        } else t && this.positionSliderAtSelected(), this.select(this.selectedIndex);
      }),
      t
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/lazyload", ["./flickity", "fizzy-ui-utils/utils"], function (n, i) {
          return t(e, n, i);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("./flickity"), require("fizzy-ui-utils")))
      : t(e, e.Flickity, e.fizzyUIUtils);
  })(window, function (e, t, n) {
    "use strict";
    function i(e) {
      if ("IMG" == e.nodeName && e.getAttribute("data-flickity-lazyload")) return [e];
      var t = e.querySelectorAll("img[data-flickity-lazyload]");
      return n.makeArray(t);
    }
    function r(e, t) {
      (this.img = e), (this.flickity = t), this.load();
    }
    t.createMethods.push("_createLazyload");
    var o = t.prototype;
    return (
      (o._createLazyload = function () {
        this.on("select", this.lazyLoad);
      }),
      (o.lazyLoad = function () {
        var e = this.options.lazyLoad;
        if (e) {
          var t = "number" == typeof e ? e : 0,
            n = this.getAdjacentCellElements(t),
            o = [];
          n.forEach(function (e) {
            var t = i(e);
            o = o.concat(t);
          }),
            o.forEach(function (e) {
              new r(e, this);
            }, this);
        }
      }),
      (r.prototype.handleEvent = n.handleEvent),
      (r.prototype.load = function () {
        this.img.addEventListener("load", this),
          this.img.addEventListener("error", this),
          (this.img.src = this.img.getAttribute("data-flickity-lazyload")),
          this.img.removeAttribute("data-flickity-lazyload");
      }),
      (r.prototype.onload = function (e) {
        this.complete(e, "flickity-lazyloaded");
      }),
      (r.prototype.onerror = function (e) {
        this.complete(e, "flickity-lazyerror");
      }),
      (r.prototype.complete = function (e, t) {
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this);
        var n = this.flickity.getParentCell(this.img),
          i = n && n.element;
        this.flickity.cellSizeChange(i), this.img.classList.add(t), this.flickity.dispatchEvent("lazyLoad", e, i);
      }),
      (t.LazyLoader = r),
      t
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity/js/index", [
          "./flickity",
          "./drag",
          "./prev-next-button",
          "./page-dots",
          "./player",
          "./add-remove-cell",
          "./lazyload",
        ], t)
      : "object" == typeof module &&
        module.exports &&
        (module.exports = t(
          require("./flickity"),
          require("./drag"),
          require("./prev-next-button"),
          require("./page-dots"),
          require("./player"),
          require("./add-remove-cell"),
          require("./lazyload")
        ));
  })(window, function (e) {
    return e;
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define("flickity-as-nav-for/as-nav-for", ["flickity/js/index", "fizzy-ui-utils/utils"], t)
      : "object" == typeof module && module.exports
      ? (module.exports = t(require("flickity"), require("fizzy-ui-utils")))
      : (e.Flickity = t(e.Flickity, e.fizzyUIUtils));
  })(window, function (e, t) {
    function n(e, t, n) {
      return (t - e) * n + e;
    }
    e.createMethods.push("_createAsNavFor");
    var i = e.prototype;
    return (
      (i._createAsNavFor = function () {
        this.on("activate", this.activateAsNavFor),
          this.on("deactivate", this.deactivateAsNavFor),
          this.on("destroy", this.destroyAsNavFor);
        var e = this.options.asNavFor;
        if (e) {
          var t = this;
          setTimeout(function () {
            t.setNavCompanion(e);
          });
        }
      }),
      (i.setNavCompanion = function (n) {
        n = t.getQueryElement(n);
        var i = e.data(n);
        if (i && i != this) {
          this.navCompanion = i;
          var r = this;
          (this.onNavCompanionSelect = function () {
            r.navCompanionSelect();
          }),
            i.on("select", this.onNavCompanionSelect),
            this.on("staticClick", this.onNavStaticClick),
            this.navCompanionSelect(!0);
        }
      }),
      (i.navCompanionSelect = function (e) {
        if (this.navCompanion) {
          var t = this.navCompanion.selectedCells[0],
            i = this.navCompanion.cells.indexOf(t),
            r = i + this.navCompanion.selectedCells.length - 1,
            o = Math.floor(n(i, r, this.navCompanion.cellAlign));
          if ((this.selectCell(o, !1, e), this.removeNavSelectedElements(), !(o >= this.cells.length))) {
            var a = this.cells.slice(i, r + 1);
            (this.navSelectedElements = a.map(function (e) {
              return e.element;
            })),
              this.changeNavSelectedClass("add");
          }
        }
      }),
      (i.changeNavSelectedClass = function (e) {
        this.navSelectedElements.forEach(function (t) {
          t.classList[e]("is-nav-selected");
        });
      }),
      (i.activateAsNavFor = function () {
        this.navCompanionSelect(!0);
      }),
      (i.removeNavSelectedElements = function () {
        this.navSelectedElements && (this.changeNavSelectedClass("remove"), delete this.navSelectedElements);
      }),
      (i.onNavStaticClick = function (e, t, n, i) {
        "number" == typeof i && this.navCompanion.selectCell(i);
      }),
      (i.deactivateAsNavFor = function () {
        this.removeNavSelectedElements();
      }),
      (i.destroyAsNavFor = function () {
        this.navCompanion &&
          (this.navCompanion.off("select", this.onNavCompanionSelect),
          this.off("staticClick", this.onNavStaticClick),
          delete this.navCompanion);
      }),
      e
    );
  }),
  (function (e, t) {
    "use strict";
    "function" == typeof define && define.amd
      ? define("imagesloaded/imagesloaded", ["ev-emitter/ev-emitter"], function (n) {
          return t(e, n);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("ev-emitter")))
      : (e.imagesLoaded = t(e, e.EvEmitter));
  })("undefined" != typeof window ? window : this, function (e, t) {
    function n(e, t) {
      for (var n in t) e[n] = t[n];
      return e;
    }
    function i(e) {
      var t = [];
      if (Array.isArray(e)) t = e;
      else if ("number" == typeof e.length) for (var n = 0; n < e.length; n++) t.push(e[n]);
      else t.push(e);
      return t;
    }
    function r(e, t, o) {
      return this instanceof r
        ? ("string" == typeof e && (e = document.querySelectorAll(e)),
          (this.elements = i(e)),
          (this.options = n({}, this.options)),
          "function" == typeof t ? (o = t) : n(this.options, t),
          o && this.on("always", o),
          this.getImages(),
          s && (this.jqDeferred = new s.Deferred()),
          void setTimeout(
            function () {
              this.check();
            }.bind(this)
          ))
        : new r(e, t, o);
    }
    function o(e) {
      this.img = e;
    }
    function a(e, t) {
      (this.url = e), (this.element = t), (this.img = new Image());
    }
    var s = e.jQuery,
      l = e.console;
    (r.prototype = Object.create(t.prototype)),
      (r.prototype.options = {}),
      (r.prototype.getImages = function () {
        (this.images = []), this.elements.forEach(this.addElementImages, this);
      }),
      (r.prototype.addElementImages = function (e) {
        "IMG" == e.nodeName && this.addImage(e), this.options.background === !0 && this.addElementBackgroundImages(e);
        var t = e.nodeType;
        if (t && u[t]) {
          for (var n = e.querySelectorAll("img"), i = 0; i < n.length; i++) {
            var r = n[i];
            this.addImage(r);
          }
          if ("string" == typeof this.options.background) {
            var o = e.querySelectorAll(this.options.background);
            for (i = 0; i < o.length; i++) {
              var a = o[i];
              this.addElementBackgroundImages(a);
            }
          }
        }
      });
    var u = { 1: !0, 9: !0, 11: !0 };
    return (
      (r.prototype.addElementBackgroundImages = function (e) {
        var t = getComputedStyle(e);
        if (t)
          for (var n = /url\((['"])?(.*?)\1\)/gi, i = n.exec(t.backgroundImage); null !== i; ) {
            var r = i && i[2];
            r && this.addBackground(r, e), (i = n.exec(t.backgroundImage));
          }
      }),
      (r.prototype.addImage = function (e) {
        var t = new o(e);
        this.images.push(t);
      }),
      (r.prototype.addBackground = function (e, t) {
        var n = new a(e, t);
        this.images.push(n);
      }),
      (r.prototype.check = function () {
        function e(e, n, i) {
          setTimeout(function () {
            t.progress(e, n, i);
          });
        }
        var t = this;
        return (
          (this.progressedCount = 0),
          (this.hasAnyBroken = !1),
          this.images.length
            ? void this.images.forEach(function (t) {
                t.once("progress", e), t.check();
              })
            : void this.complete()
        );
      }),
      (r.prototype.progress = function (e, t, n) {
        this.progressedCount++,
          (this.hasAnyBroken = this.hasAnyBroken || !e.isLoaded),
          this.emitEvent("progress", [this, e, t]),
          this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, e),
          this.progressedCount == this.images.length && this.complete(),
          this.options.debug && l && l.log("progress: " + n, e, t);
      }),
      (r.prototype.complete = function () {
        var e = this.hasAnyBroken ? "fail" : "done";
        if (((this.isComplete = !0), this.emitEvent(e, [this]), this.emitEvent("always", [this]), this.jqDeferred)) {
          var t = this.hasAnyBroken ? "reject" : "resolve";
          this.jqDeferred[t](this);
        }
      }),
      (o.prototype = Object.create(t.prototype)),
      (o.prototype.check = function () {
        var e = this.getIsImageComplete();
        return e
          ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth")
          : ((this.proxyImage = new Image()),
            this.proxyImage.addEventListener("load", this),
            this.proxyImage.addEventListener("error", this),
            this.img.addEventListener("load", this),
            this.img.addEventListener("error", this),
            void (this.proxyImage.src = this.img.src));
      }),
      (o.prototype.getIsImageComplete = function () {
        return this.img.complete && void 0 !== this.img.naturalWidth;
      }),
      (o.prototype.confirm = function (e, t) {
        (this.isLoaded = e), this.emitEvent("progress", [this, this.img, t]);
      }),
      (o.prototype.handleEvent = function (e) {
        var t = "on" + e.type;
        this[t] && this[t](e);
      }),
      (o.prototype.onload = function () {
        this.confirm(!0, "onload"), this.unbindEvents();
      }),
      (o.prototype.onerror = function () {
        this.confirm(!1, "onerror"), this.unbindEvents();
      }),
      (o.prototype.unbindEvents = function () {
        this.proxyImage.removeEventListener("load", this),
          this.proxyImage.removeEventListener("error", this),
          this.img.removeEventListener("load", this),
          this.img.removeEventListener("error", this);
      }),
      (a.prototype = Object.create(o.prototype)),
      (a.prototype.check = function () {
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), (this.img.src = this.url);
        var e = this.getIsImageComplete();
        e && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents());
      }),
      (a.prototype.unbindEvents = function () {
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this);
      }),
      (a.prototype.confirm = function (e, t) {
        (this.isLoaded = e), this.emitEvent("progress", [this, this.element, t]);
      }),
      (r.makeJQueryPlugin = function (t) {
        (t = t || e.jQuery),
          t &&
            ((s = t),
            (s.fn.imagesLoaded = function (e, t) {
              var n = new r(this, e, t);
              return n.jqDeferred.promise(s(this));
            }));
      }),
      r.makeJQueryPlugin(),
      r
    );
  }),
  (function (e, t) {
    "function" == typeof define && define.amd
      ? define(["flickity/js/index", "imagesloaded/imagesloaded"], function (n, i) {
          return t(e, n, i);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("flickity"), require("imagesloaded")))
      : (e.Flickity = t(e, e.Flickity, e.imagesLoaded));
  })(window, function (e, t, n) {
    "use strict";
    t.createMethods.push("_createImagesLoaded");
    var i = t.prototype;
    return (
      (i._createImagesLoaded = function () {
        this.on("activate", this.imagesLoaded);
      }),
      (i.imagesLoaded = function () {
        function e(e, n) {
          var i = t.getParentCell(n.img);
          t.cellSizeChange(i && i.element), t.options.freeScroll || t.positionSliderAtSelected();
        }
        if (this.options.imagesLoaded) {
          var t = this;
          n(this.slider).on("progress", e);
        }
      }),
      t
    );
  }),
  !(function (e, t) {
    "object" == typeof exports && "object" == typeof module
      ? (module.exports = t())
      : "function" == typeof define && define.amd
      ? define([], t)
      : "object" == typeof exports
      ? (exports.inView = t())
      : (e.inView = t());
  })(this, function () {
    return (function (e) {
      function t(i) {
        if (n[i]) return n[i].exports;
        var r = (n[i] = { exports: {}, id: i, loaded: !1 });
        return e[i].call(r.exports, r, r.exports, t), (r.loaded = !0), r.exports;
      }
      var n = {};
      return (t.m = e), (t.c = n), (t.p = ""), t(0);
    })([
      function (e, t, n) {
        "use strict";
        function i(e) {
          return e && e.__esModule ? e : { default: e };
        }
        var r = n(2),
          o = i(r);
        e.exports = o.default;
      },
      function (e, t) {
        function n(e) {
          var t = typeof e;
          return null != e && ("object" == t || "function" == t);
        }
        e.exports = n;
      },
      function (e, t, n) {
        "use strict";
        function i(e) {
          return e && e.__esModule ? e : { default: e };
        }
        Object.defineProperty(t, "__esModule", { value: !0 });
        var r = n(9),
          o = i(r),
          a = n(3),
          s = i(a),
          l = n(4),
          u = function () {
            if ("undefined" != typeof window) {
              var e = 100,
                t = ["scroll", "resize", "load"],
                n = { history: [] },
                i = { offset: {}, threshold: 0, test: l.inViewport },
                r = (0, o.default)(function () {
                  n.history.forEach(function (e) {
                    n[e].check();
                  });
                }, e);
              t.forEach(function (e) {
                return addEventListener(e, r);
              }),
                window.MutationObserver &&
                  addEventListener("DOMContentLoaded", function () {
                    new MutationObserver(r).observe(document.body, { attributes: !0, childList: !0, subtree: !0 });
                  });
              var a = function (e) {
                if ("string" == typeof e) {
                  var t = [].slice.call(document.querySelectorAll(e));
                  return (
                    n.history.indexOf(e) > -1
                      ? (n[e].elements = t)
                      : ((n[e] = (0, s.default)(t, i)), n.history.push(e)),
                    n[e]
                  );
                }
              };
              return (
                (a.offset = function (e) {
                  if (void 0 === e) return i.offset;
                  var t = function (e) {
                    return "number" == typeof e;
                  };
                  return (
                    ["top", "right", "bottom", "left"].forEach(
                      t(e)
                        ? function (t) {
                            return (i.offset[t] = e);
                          }
                        : function (n) {
                            return t(e[n]) ? (i.offset[n] = e[n]) : null;
                          }
                    ),
                    i.offset
                  );
                }),
                (a.threshold = function (e) {
                  return "number" == typeof e && e >= 0 && e <= 1 ? (i.threshold = e) : i.threshold;
                }),
                (a.test = function (e) {
                  return "function" == typeof e ? (i.test = e) : i.test;
                }),
                (a.is = function (e) {
                  return i.test(e, i);
                }),
                a.offset(0),
                a
              );
            }
          };
        t.default = u();
      },
      function (e, t) {
        "use strict";
        function n(e, t) {
          if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
        }
        Object.defineProperty(t, "__esModule", { value: !0 });
        var i = (function () {
            function e(e, t) {
              for (var n = 0; n < t.length; n++) {
                var i = t[n];
                (i.enumerable = i.enumerable || !1),
                  (i.configurable = !0),
                  "value" in i && (i.writable = !0),
                  Object.defineProperty(e, i.key, i);
              }
            }
            return function (t, n, i) {
              return n && e(t.prototype, n), i && e(t, i), t;
            };
          })(),
          r = (function () {
            function e(t, i) {
              n(this, e),
                (this.options = i),
                (this.elements = t),
                (this.current = []),
                (this.handlers = { enter: [], exit: [] }),
                (this.singles = { enter: [], exit: [] });
            }
            return (
              i(e, [
                {
                  key: "check",
                  value: function () {
                    var e = this;
                    return (
                      this.elements.forEach(function (t) {
                        var n = e.options.test(t, e.options),
                          i = e.current.indexOf(t),
                          r = i > -1,
                          o = n && !r,
                          a = !n && r;
                        o && (e.current.push(t), e.emit("enter", t)), a && (e.current.splice(i, 1), e.emit("exit", t));
                      }),
                      this
                    );
                  },
                },
                {
                  key: "on",
                  value: function (e, t) {
                    return this.handlers[e].push(t), this;
                  },
                },
                {
                  key: "once",
                  value: function (e, t) {
                    return this.singles[e].unshift(t), this;
                  },
                },
                {
                  key: "emit",
                  value: function (e, t) {
                    for (; this.singles[e].length; ) this.singles[e].pop()(t);
                    for (var n = this.handlers[e].length; --n > -1; ) this.handlers[e][n](t);
                    return this;
                  },
                },
              ]),
              e
            );
          })();
        t.default = function (e, t) {
          return new r(e, t);
        };
      },
      function (e, t) {
        "use strict";
        function n(e, t) {
          var n = e.getBoundingClientRect(),
            i = n.top,
            r = n.right,
            o = n.bottom,
            a = n.left,
            s = n.width,
            l = n.height,
            u = { t: o, r: window.innerWidth - a, b: window.innerHeight - i, l: r },
            c = { x: t.threshold * s, y: t.threshold * l };
          return (
            u.t > t.offset.top + c.y &&
            u.r > t.offset.right + c.x &&
            u.b > t.offset.bottom + c.y &&
            u.l > t.offset.left + c.x
          );
        }
        Object.defineProperty(t, "__esModule", { value: !0 }), (t.inViewport = n);
      },
      function (e, t) {
        (function (t) {
          var n = "object" == typeof t && t && t.Object === Object && t;
          e.exports = n;
        }.call(
          t,
          (function () {
            return this;
          })()
        ));
      },
      function (e, t, n) {
        var i = n(5),
          r = "object" == typeof self && self && self.Object === Object && self,
          o = i || r || Function("return this")();
        e.exports = o;
      },
      function (e, t, n) {
        function i(e, t, n) {
          function i(t) {
            var n = y,
              i = x;
            return (y = x = void 0), (E = t), (k = e.apply(i, n));
          }
          function c(e) {
            return (E = e), (w = setTimeout(p, t)), C ? i(e) : k;
          }
          function f(e) {
            var n = e - S,
              i = e - E,
              r = t - n;
            return P ? u(r, b - i) : r;
          }
          function d(e) {
            var n = e - S,
              i = e - E;
            return void 0 === S || n >= t || n < 0 || (P && i >= b);
          }
          function p() {
            var e = o();
            return d(e) ? h(e) : void (w = setTimeout(p, f(e)));
          }
          function h(e) {
            return (w = void 0), A && y ? i(e) : ((y = x = void 0), k);
          }
          function m() {
            void 0 !== w && clearTimeout(w), (E = 0), (y = S = x = w = void 0);
          }
          function g() {
            return void 0 === w ? k : h(o());
          }
          function v() {
            var e = o(),
              n = d(e);
            if (((y = arguments), (x = this), (S = e), n)) {
              if (void 0 === w) return c(S);
              if (P) return (w = setTimeout(p, t)), i(S);
            }
            return void 0 === w && (w = setTimeout(p, t)), k;
          }
          var y,
            x,
            b,
            k,
            w,
            S,
            E = 0,
            C = !1,
            P = !1,
            A = !0;
          if ("function" != typeof e) throw new TypeError(s);
          return (
            (t = a(t) || 0),
            r(n) &&
              ((C = !!n.leading),
              (P = "maxWait" in n),
              (b = P ? l(a(n.maxWait) || 0, t) : b),
              (A = "trailing" in n ? !!n.trailing : A)),
            (v.cancel = m),
            (v.flush = g),
            v
          );
        }
        var r = n(1),
          o = n(8),
          a = n(10),
          s = "Expected a function",
          l = Math.max,
          u = Math.min;
        e.exports = i;
      },
      function (e, t, n) {
        var i = n(6),
          r = function () {
            return i.Date.now();
          };
        e.exports = r;
      },
      function (e, t, n) {
        function i(e, t, n) {
          var i = !0,
            s = !0;
          if ("function" != typeof e) throw new TypeError(a);
          return (
            o(n) && ((i = "leading" in n ? !!n.leading : i), (s = "trailing" in n ? !!n.trailing : s)),
            r(e, t, { leading: i, maxWait: t, trailing: s })
          );
        }
        var r = n(7),
          o = n(1),
          a = "Expected a function";
        e.exports = i;
      },
      function (e, t) {
        function n(e) {
          return e;
        }
        e.exports = n;
      },
    ]);
  }),
  !(function (e) {
    function t(i) {
      if (n[i]) return n[i].exports;
      var r = (n[i] = { i: i, l: !1, exports: {} });
      return e[i].call(r.exports, r, r.exports, t), (r.l = !0), r.exports;
    }
    var n = {};
    (t.m = e),
      (t.c = n),
      (t.i = function (e) {
        return e;
      }),
      (t.d = function (e, n, i) {
        t.o(e, n) || Object.defineProperty(e, n, { configurable: !1, enumerable: !0, get: i });
      }),
      (t.n = function (e) {
        var n =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return t.d(n, "a", n), n;
      }),
      (t.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
      }),
      (t.p = ""),
      t((t.s = 9));
  })([
    function (e, t, n) {
      "use strict";
      var i, r, o;
      "function" == typeof Symbol && Symbol.iterator,
        !(function (a) {
          (r = [n(2)]), (i = a), void 0 !== (o = "function" == typeof i ? i.apply(t, r) : i) && (e.exports = o);
        })(function (e) {
          return e;
        });
    },
    function (e, t, n) {
      "use strict";
      var i,
        r,
        o,
        a =
          "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
            ? function (e) {
                return typeof e;
              }
            : function (e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype
                  ? "symbol"
                  : typeof e;
              };
      !(function (a) {
        (r = [n(0), n(11), n(10)]),
          (i = a),
          void 0 !== (o = "function" == typeof i ? i.apply(t, r) : i) && (e.exports = o);
      })(function (e, t, n, i) {
        function r(t, n, a) {
          return this instanceof r
            ? ((this.el = i),
              (this.events = {}),
              (this.maskset = i),
              (this.refreshValue = !1),
              !0 !== a &&
                (e.isPlainObject(t) ? (n = t) : ((n = n || {}), (n.alias = t)),
                (this.opts = e.extend(!0, {}, this.defaults, n)),
                (this.noMasksCache = n && n.definitions !== i),
                (this.userOptions = n || {}),
                (this.isRTL = this.opts.numericInput),
                o(this.opts.alias, n, this.opts)),
              void 0)
            : new r(t, n, a);
        }
        function o(t, n, a) {
          var s = r.prototype.aliases[t];
          return s
            ? (s.alias && o(s.alias, i, a), e.extend(!0, a, s), e.extend(!0, a, n), !0)
            : (null === a.mask && (a.mask = t), !1);
        }
        function s(t, n) {
          function o(t, o, a) {
            var s = !1;
            if (
              ((null !== t && "" !== t) ||
                ((s = null !== a.regex),
                s ? ((t = a.regex), (t = t.replace(/^(\^)(.*)(\$)$/, "$2"))) : ((s = !0), (t = ".*"))),
              1 === t.length && !1 === a.greedy && 0 !== a.repeat && (a.placeholder = ""),
              a.repeat > 0 || "*" === a.repeat || "+" === a.repeat)
            ) {
              var l = "*" === a.repeat ? 0 : "+" === a.repeat ? 1 : a.repeat;
              t =
                a.groupmarker.start +
                t +
                a.groupmarker.end +
                a.quantifiermarker.start +
                l +
                "," +
                a.repeat +
                a.quantifiermarker.end;
            }
            var u,
              c = s ? "regex_" + a.regex : a.numericInput ? t.split("").reverse().join("") : t;
            return (
              r.prototype.masksCache[c] === i || !0 === n
                ? ((u = {
                    mask: t,
                    maskToken: r.prototype.analyseMask(t, s, a),
                    validPositions: {},
                    _buffer: i,
                    buffer: i,
                    tests: {},
                    metadata: o,
                    maskLength: i,
                  }),
                  !0 !== n && ((r.prototype.masksCache[c] = u), (u = e.extend(!0, {}, r.prototype.masksCache[c]))))
                : (u = e.extend(!0, {}, r.prototype.masksCache[c])),
              u
            );
          }
          if ((e.isFunction(t.mask) && (t.mask = t.mask(t)), e.isArray(t.mask))) {
            if (t.mask.length > 1) {
              t.keepStatic = null === t.keepStatic || t.keepStatic;
              var a = t.groupmarker.start;
              return (
                e.each(t.numericInput ? t.mask.reverse() : t.mask, function (n, r) {
                  a.length > 1 && (a += t.groupmarker.end + t.alternatormarker + t.groupmarker.start),
                    (a += r.mask === i || e.isFunction(r.mask) ? r : r.mask);
                }),
                (a += t.groupmarker.end),
                o(a, t.mask, t)
              );
            }
            t.mask = t.mask.pop();
          }
          return t.mask && t.mask.mask !== i && !e.isFunction(t.mask.mask)
            ? o(t.mask.mask, t.mask, t)
            : o(t.mask, t.mask, t);
        }
        function l(o, s, u) {
          function h(e, t, n) {
            t = t || 0;
            var r,
              o,
              a,
              s = [],
              l = 0,
              c = v();
            do
              !0 === e && m().validPositions[l]
                ? ((a = m().validPositions[l]),
                  (o = a.match),
                  (r = a.locator.slice()),
                  s.push(!0 === n ? a.input : !1 === n ? o.nativeDef : O(l, o)))
                : ((a = b(l, r, l - 1)),
                  (o = a.match),
                  (r = a.locator.slice()),
                  (!1 === u.jitMasking ||
                    l < c ||
                    ("number" == typeof u.jitMasking && isFinite(u.jitMasking) && u.jitMasking > l)) &&
                    s.push(!1 === n ? o.nativeDef : O(l, o))),
                l++;
            while (((V === i || l < V) && (null !== o.fn || "" !== o.def)) || t > l);
            return "" === s[s.length - 1] && s.pop(), (m().maskLength = l + 1), s;
          }
          function m() {
            return s;
          }
          function g(e) {
            var t = m();
            (t.buffer = i), !0 !== e && ((t.validPositions = {}), (t.p = 0));
          }
          function v(e, t, n) {
            var r = -1,
              o = -1,
              a = n || m().validPositions;
            e === i && (e = -1);
            for (var s in a) {
              var l = parseInt(s);
              a[l] && (t || !0 !== a[l].generatedInput) && (l <= e && (r = l), l >= e && (o = l));
            }
            return (-1 !== r && e - r > 1) || o < e ? r : o;
          }
          function y(t, n, r, o) {
            var a,
              s = t,
              l = e.extend(!0, {}, m().validPositions),
              c = !1;
            for (m().p = t, a = n - 1; a >= s; a--)
              m().validPositions[a] !== i &&
                ((!0 !== r &&
                  ((!m().validPositions[a].match.optionality &&
                    (function (e) {
                      var t = m().validPositions[e];
                      if (t !== i && null === t.match.fn) {
                        var n = m().validPositions[e - 1],
                          r = m().validPositions[e + 1];
                        return n !== i && r !== i;
                      }
                      return !1;
                    })(a)) ||
                    !1 === u.canClearPosition(m(), a, v(i, !0), o, u))) ||
                  delete m().validPositions[a]);
            for (g(!0), a = s + 1; a <= v(); ) {
              for (; m().validPositions[s] !== i; ) s++;
              if ((a < s && (a = s + 1), m().validPositions[a] === i && j(a))) a++;
              else {
                var f = b(a);
                !1 === c && l[s] && l[s].match.def === f.match.def
                  ? ((m().validPositions[s] = e.extend(!0, {}, l[s])),
                    (m().validPositions[s].input = f.input),
                    delete m().validPositions[a],
                    a++)
                  : w(s, f.match.def)
                  ? !1 !== T(s, f.input || O(a), !0) && (delete m().validPositions[a], a++, (c = !0))
                  : j(a) || (a++, s--),
                  s++;
              }
            }
            g(!0);
          }
          function x(e, t) {
            for (
              var n,
                r = e,
                o = v(),
                a = m().validPositions[o] || S(0)[0],
                s = a.alternation !== i ? a.locator[a.alternation].toString().split(",") : [],
                l = 0;
              l < r.length &&
              ((n = r[l]),
              !(
                n.match &&
                ((u.greedy && !0 !== n.match.optionalQuantifier) ||
                  ((!1 === n.match.optionality || !1 === n.match.newBlockMarker) &&
                    !0 !== n.match.optionalQuantifier)) &&
                (a.alternation === i ||
                  a.alternation !== n.alternation ||
                  (n.locator[a.alternation] !== i && D(n.locator[a.alternation].toString().split(","), s)))
              ) ||
                (!0 === t && (null !== n.match.fn || /[0-9a-bA-Z]/.test(n.match.def))));
              l++
            );
            return n;
          }
          function b(e, t, n) {
            return m().validPositions[e] || x(S(e, t ? t.slice() : t, n));
          }
          function k(e) {
            return m().validPositions[e] ? m().validPositions[e] : S(e)[0];
          }
          function w(e, t) {
            for (var n = !1, i = S(e), r = 0; r < i.length; r++)
              if (i[r].match && i[r].match.def === t) {
                n = !0;
                break;
              }
            return n;
          }
          function S(t, n, r) {
            function o(n, r, a, l) {
              function f(a, l, g) {
                function v(t, n) {
                  var i = 0 === e.inArray(t, n.matches);
                  return (
                    i ||
                      e.each(n.matches, function (e, r) {
                        if (!0 === r.isQuantifier && (i = v(t, n.matches[e - 1]))) return !1;
                      }),
                    i
                  );
                }
                function y(t, n, r) {
                  var o, a;
                  if (m().validPositions[t - 1] && r && m().tests[t])
                    for (var s = m().validPositions[t - 1].locator, l = m().tests[t][0].locator, u = 0; u < r; u++)
                      if (s[u] !== l[u]) return s.slice(r + 1);
                  return (
                    (m().tests[t] || m().validPositions[t]) &&
                      e.each(m().tests[t] || [m().validPositions[t]], function (e, t) {
                        var s = r !== i ? r : t.alternation,
                          l = t.locator[s] !== i ? t.locator[s].toString().indexOf(n) : -1;
                        (a === i || l < a) && -1 !== l && ((o = t), (a = l));
                      }),
                    o ? o.locator.slice((r !== i ? r : o.alternation) + 1) : r !== i ? y(t, n) : i
                  );
                }
                if (c > 1e4)
                  throw (
                    "Inputmask: There is probably an error in your mask definition or in the code. Create an issue on github with an example of the mask you are using. " +
                    m().mask
                  );
                if (c === t && a.matches === i) return d.push({ match: a, locator: l.reverse(), cd: h }), !0;
                if (a.matches !== i) {
                  if (a.isGroup && g !== a) {
                    if ((a = f(n.matches[e.inArray(a, n.matches) + 1], l))) return !0;
                  } else if (a.isOptional) {
                    var x = a;
                    if ((a = o(a, r, l, g))) {
                      if (((s = d[d.length - 1].match), !v(s, x))) return !0;
                      (p = !0), (c = t);
                    }
                  } else if (a.isAlternator) {
                    var b,
                      k = a,
                      w = [],
                      S = d.slice(),
                      E = l.length,
                      C = r.length > 0 ? r.shift() : -1;
                    if (-1 === C || "string" == typeof C) {
                      var P,
                        A = c,
                        D = r.slice(),
                        T = [];
                      if ("string" == typeof C) T = C.split(",");
                      else for (P = 0; P < k.matches.length; P++) T.push(P);
                      for (var j = 0; j < T.length; j++) {
                        if (
                          ((P = parseInt(T[j])),
                          (d = []),
                          (r = y(c, P, E) || D.slice()),
                          !0 !== (a = f(k.matches[P] || n.matches[P], [P].concat(l), g) || a) &&
                            a !== i &&
                            T[T.length - 1] < k.matches.length)
                        ) {
                          var N = e.inArray(a, n.matches) + 1;
                          n.matches.length > N &&
                            (a = f(n.matches[N], [N].concat(l.slice(1, l.length)), g)) &&
                            (T.push(N.toString()),
                            e.each(d, function (e, t) {
                              t.alternation = l.length - 1;
                            }));
                        }
                        (b = d.slice()), (c = A), (d = []);
                        for (var _ = 0; _ < b.length; _++) {
                          var L = b[_],
                            M = !1;
                          L.alternation = L.alternation || E;
                          for (var O = 0; O < w.length; O++) {
                            var I = w[O];
                            if ("string" != typeof C || -1 !== e.inArray(L.locator[L.alternation].toString(), T)) {
                              if (
                                (function (e, t) {
                                  return (
                                    e.match.nativeDef === t.match.nativeDef ||
                                    e.match.def === t.match.nativeDef ||
                                    e.match.nativeDef === t.match.def
                                  );
                                })(L, I)
                              ) {
                                (M = !0),
                                  L.alternation === I.alternation &&
                                    -1 === I.locator[I.alternation].toString().indexOf(L.locator[L.alternation]) &&
                                    ((I.locator[I.alternation] =
                                      I.locator[I.alternation] + "," + L.locator[L.alternation]),
                                    (I.alternation = L.alternation)),
                                  L.match.nativeDef === I.match.def &&
                                    ((L.locator[L.alternation] = I.locator[I.alternation]),
                                    w.splice(w.indexOf(I), 1, L));
                                break;
                              }
                              if (L.match.def === I.match.def) {
                                M = !1;
                                break;
                              }
                              if (
                                (function (e, n) {
                                  return (
                                    null === e.match.fn &&
                                    null !== n.match.fn &&
                                    n.match.fn.test(e.match.def, m(), t, !1, u, !1)
                                  );
                                })(L, I) ||
                                (function (e, n) {
                                  return (
                                    null !== e.match.fn &&
                                    null !== n.match.fn &&
                                    n.match.fn.test(e.match.def.replace(/[\[\]]/g, ""), m(), t, !1, u, !1)
                                  );
                                })(L, I)
                              ) {
                                L.alternation === I.alternation &&
                                  -1 ===
                                    L.locator[L.alternation]
                                      .toString()
                                      .indexOf(I.locator[I.alternation].toString().split("")[0]) &&
                                  ((L.na = L.na || L.locator[L.alternation].toString()),
                                  -1 === L.na.indexOf(L.locator[L.alternation].toString().split("")[0]) &&
                                    (L.na = L.na + "," + L.locator[I.alternation].toString().split("")[0]),
                                  (M = !0),
                                  (L.locator[L.alternation] =
                                    I.locator[I.alternation].toString().split("")[0] + "," + L.locator[L.alternation]),
                                  w.splice(w.indexOf(I), 0, L));
                                break;
                              }
                            }
                          }
                          M || w.push(L);
                        }
                      }
                      "string" == typeof C &&
                        (w = e.map(w, function (t, n) {
                          if (isFinite(n)) {
                            var r = t.alternation,
                              o = t.locator[r].toString().split(",");
                            (t.locator[r] = i), (t.alternation = i);
                            for (var a = 0; a < o.length; a++)
                              -1 !== e.inArray(o[a], T) &&
                                (t.locator[r] !== i
                                  ? ((t.locator[r] += ","), (t.locator[r] += o[a]))
                                  : (t.locator[r] = parseInt(o[a])),
                                (t.alternation = r));
                            if (t.locator[r] !== i) return t;
                          }
                        })),
                        (d = S.concat(w)),
                        (c = t),
                        (p = d.length > 0),
                        (a = w.length > 0),
                        (r = D.slice());
                    } else a = f(k.matches[C] || n.matches[C], [C].concat(l), g);
                    if (a) return !0;
                  } else if (a.isQuantifier && g !== n.matches[e.inArray(a, n.matches) - 1])
                    for (
                      var F = a, R = r.length > 0 ? r.shift() : 0;
                      R < (isNaN(F.quantifier.max) ? R + 1 : F.quantifier.max) && c <= t;
                      R++
                    ) {
                      var q = n.matches[e.inArray(F, n.matches) - 1];
                      if ((a = f(q, [R].concat(l), q))) {
                        if (((s = d[d.length - 1].match), (s.optionalQuantifier = R > F.quantifier.min - 1), v(s, q))) {
                          if (R > F.quantifier.min - 1) {
                            (p = !0), (c = t);
                            break;
                          }
                          return !0;
                        }
                        return !0;
                      }
                    }
                  else if ((a = o(a, r, l, g))) return !0;
                } else c++;
              }
              for (var g = r.length > 0 ? r.shift() : 0; g < n.matches.length; g++)
                if (!0 !== n.matches[g].isQuantifier) {
                  var v = f(n.matches[g], [g].concat(a), l);
                  if (v && c === t) return v;
                  if (c > t) break;
                }
            }
            function a(e) {
              if (
                u.keepStatic &&
                t > 0 &&
                e.length > 1 + ("" === e[e.length - 1].match.def ? 1 : 0) &&
                !0 !== e[0].match.optionality &&
                !0 !== e[0].match.optionalQuantifier &&
                null === e[0].match.fn &&
                !/[0-9a-bA-Z]/.test(e[0].match.def)
              ) {
                if (m().validPositions[t - 1] === i) return [x(e)];
                if (m().validPositions[t - 1].alternation === e[0].alternation) return [x(e)];
                if (m().validPositions[t - 1]) return [x(e)];
              }
              return e;
            }
            var s,
              l = m().maskToken,
              c = n ? r : 0,
              f = n ? n.slice() : [0],
              d = [],
              p = !1,
              h = n ? n.join("") : "";
            if (t > -1) {
              if (n === i) {
                for (var g, v = t - 1; (g = m().validPositions[v] || m().tests[v]) === i && v > -1; ) v--;
                g !== i &&
                  v > -1 &&
                  ((f = (function (t) {
                    var n = [];
                    return (
                      e.isArray(t) || (t = [t]),
                      t.length > 0 &&
                        (t[0].alternation === i
                          ? ((n = x(t.slice()).locator.slice()), 0 === n.length && (n = t[0].locator.slice()))
                          : e.each(t, function (e, t) {
                              if ("" !== t.def)
                                if (0 === n.length) n = t.locator.slice();
                                else
                                  for (var i = 0; i < n.length; i++)
                                    t.locator[i] &&
                                      -1 === n[i].toString().indexOf(t.locator[i]) &&
                                      (n[i] += "," + t.locator[i]);
                            })),
                      n
                    );
                  })(g)),
                  (h = f.join("")),
                  (c = v));
              }
              if (m().tests[t] && m().tests[t][0].cd === h) return a(m().tests[t]);
              for (var y = f.shift(); y < l.length && !((o(l[y], f, [y]) && c === t) || c > t); y++);
            }
            return (
              (0 === d.length || p) &&
                d.push({
                  match: { fn: null, cardinality: 0, optionality: !0, casing: null, def: "", placeholder: "" },
                  locator: [],
                  cd: h,
                }),
              n !== i && m().tests[t] ? a(e.extend(!0, [], d)) : ((m().tests[t] = e.extend(!0, [], d)), a(m().tests[t]))
            );
          }
          function E() {
            return (
              m()._buffer === i && ((m()._buffer = h(!1, 1)), m().buffer === i && (m().buffer = m()._buffer.slice())),
              m()._buffer
            );
          }
          function C(e) {
            return (m().buffer !== i && !0 !== e) || (m().buffer = h(!0, v(), !0)), m().buffer;
          }
          function P(e, t, n) {
            var r, o;
            if (!0 === e) g(), (e = 0), (t = n.length);
            else for (r = e; r < t; r++) delete m().validPositions[r];
            for (o = e, r = e; r < t; r++)
              if ((g(!0), n[r] !== u.skipOptionalPartCharacter)) {
                var a = T(o, n[r], !0, !0);
                !1 !== a && (g(!0), (o = a.caret !== i ? a.caret : a.pos + 1));
              }
          }
          function A(t, n, i) {
            switch (u.casing || n.casing) {
              case "upper":
                t = t.toUpperCase();
                break;
              case "lower":
                t = t.toLowerCase();
                break;
              case "title":
                var o = m().validPositions[i - 1];
                t =
                  0 === i || (o && o.input === String.fromCharCode(r.keyCode.SPACE))
                    ? t.toUpperCase()
                    : t.toLowerCase();
                break;
              default:
                if (e.isFunction(u.casing)) {
                  var a = Array.prototype.slice.call(arguments);
                  a.push(m().validPositions), (t = u.casing.apply(this, a));
                }
            }
            return t;
          }
          function D(t, n, r) {
            for (
              var o, a = u.greedy ? n : n.slice(0, 1), s = !1, l = r !== i ? r.split(",") : [], c = 0;
              c < l.length;
              c++
            )
              -1 !== (o = t.indexOf(l[c])) && t.splice(o, 1);
            for (var f = 0; f < t.length; f++)
              if (-1 !== e.inArray(t[f], a)) {
                s = !0;
                break;
              }
            return s;
          }
          function T(t, n, o, a, s, l) {
            function c(e) {
              var t = Y ? e.begin - e.end > 1 || e.begin - e.end == 1 : e.end - e.begin > 1 || e.end - e.begin == 1;
              return t && 0 === e.begin && e.end === m().maskLength ? "full" : t;
            }
            function f(n, r, o) {
              var s = !1;
              return (
                e.each(S(n), function (l, f) {
                  for (var p = f.match, h = r ? 1 : 0, x = "", b = p.cardinality; b > h; b--) x += L(n - (b - 1));
                  if (
                    (r && (x += r),
                    C(!0),
                    !1 !==
                      (s =
                        null != p.fn
                          ? p.fn.test(x, m(), n, o, u, c(t))
                          : (r === p.def || r === u.skipOptionalPartCharacter) &&
                            "" !== p.def && { c: O(n, p, !0) || p.def, pos: n }))
                  ) {
                    var k = s.c !== i ? s.c : r;
                    k = k === u.skipOptionalPartCharacter && null === p.fn ? O(n, p, !0) || p.def : k;
                    var w = n,
                      S = C();
                    if (
                      (s.remove !== i &&
                        (e.isArray(s.remove) || (s.remove = [s.remove]),
                        e.each(
                          s.remove.sort(function (e, t) {
                            return t - e;
                          }),
                          function (e, t) {
                            y(t, t + 1, !0);
                          }
                        )),
                      s.insert !== i &&
                        (e.isArray(s.insert) || (s.insert = [s.insert]),
                        e.each(
                          s.insert.sort(function (e, t) {
                            return e - t;
                          }),
                          function (e, t) {
                            T(t.pos, t.c, !0, a);
                          }
                        )),
                      s.refreshFromBuffer)
                    ) {
                      var E = s.refreshFromBuffer;
                      if ((P(!0 === E ? E : E.start, E.end, S), s.pos === i && s.c === i)) return (s.pos = v()), !1;
                      if ((w = s.pos !== i ? s.pos : n) !== n) return (s = e.extend(s, T(w, k, !0, a))), !1;
                    } else if (!0 !== s && s.pos !== i && s.pos !== n && ((w = s.pos), P(n, w, C().slice()), w !== n))
                      return (s = e.extend(s, T(w, k, !0))), !1;
                    return (
                      (!0 === s || s.pos !== i || s.c !== i) &&
                      (l > 0 && g(!0), d(w, e.extend({}, f, { input: A(k, p, w) }), a, c(t)) || (s = !1), !1)
                    );
                  }
                }),
                s
              );
            }
            function d(t, n, r, o) {
              if (o || (u.insertMode && m().validPositions[t] !== i && r === i)) {
                var a,
                  s = e.extend(!0, {}, m().validPositions),
                  l = v(i, !0);
                for (a = t; a <= l; a++) delete m().validPositions[a];
                m().validPositions[t] = e.extend(!0, {}, n);
                var c,
                  f = !0,
                  d = m().validPositions,
                  h = !1,
                  y = m().maskLength;
                for (a = c = t; a <= l; a++) {
                  var x = s[a];
                  if (x !== i)
                    for (
                      var b = c;
                      b < m().maskLength &&
                      ((null === x.match.fn &&
                        d[a] &&
                        (!0 === d[a].match.optionalQuantifier || !0 === d[a].match.optionality)) ||
                        null != x.match.fn);

                    ) {
                      if ((b++, !1 === h && s[b] && s[b].match.def === x.match.def))
                        (m().validPositions[b] = e.extend(!0, {}, s[b])),
                          (m().validPositions[b].input = x.input),
                          p(b),
                          (c = b),
                          (f = !0);
                      else if (w(b, x.match.def)) {
                        var k = T(b, x.input, !0, !0);
                        (f = !1 !== k), (c = k.caret || k.insert ? v() : b), (h = !0);
                      } else if (!(f = !0 === x.generatedInput) && b >= m().maskLength - 1) break;
                      if ((m().maskLength < y && (m().maskLength = y), f)) break;
                    }
                  if (!f) break;
                }
                if (!f) return (m().validPositions = e.extend(!0, {}, s)), g(!0), !1;
              } else m().validPositions[t] = e.extend(!0, {}, n);
              return g(!0), !0;
            }
            function p(t) {
              for (var n = t - 1; n > -1 && !m().validPositions[n]; n--);
              var r, o;
              for (n++; n < t; n++)
                m().validPositions[n] === i &&
                  (!1 === u.jitMasking || u.jitMasking > n) &&
                  ((o = S(n, b(n - 1).locator, n - 1).slice()),
                  "" === o[o.length - 1].match.def && o.pop(),
                  (r = x(o)) &&
                    (r.match.def === u.radixPointDefinitionSymbol ||
                      !j(n, !0) ||
                      (e.inArray(u.radixPoint, C()) < n && r.match.fn && r.match.fn.test(O(n), m(), n, !1, u))) &&
                    !1 !==
                      (k = f(
                        n,
                        O(n, r.match, !0) || (null == r.match.fn ? r.match.def : "" !== O(n) ? O(n) : C()[n]),
                        !0
                      )) &&
                    (m().validPositions[k.pos || n].generatedInput = !0));
            }
            o = !0 === o;
            var h = t;
            t.begin !== i && (h = Y && !c(t) ? t.end : t.begin);
            var k = !0,
              E = e.extend(!0, {}, m().validPositions);
            if (
              (e.isFunction(u.preValidation) && !o && !0 !== a && !0 !== l && (k = u.preValidation(C(), h, n, c(t), u)),
              !0 === k)
            ) {
              if (
                (p(h),
                c(t) && (H(i, r.keyCode.DELETE, t, !0, !0), (h = m().p)),
                h < m().maskLength &&
                  (V === i || h < V) &&
                  ((k = f(h, n, o)), (!o || !0 === a) && !1 === k && !0 !== l))
              ) {
                var _ = m().validPositions[h];
                if (!_ || null !== _.match.fn || (_.match.def !== n && n !== u.skipOptionalPartCharacter)) {
                  if ((u.insertMode || m().validPositions[N(h)] === i) && !j(h, !0))
                    for (var M = h + 1, I = N(h); M <= I; M++)
                      if (!1 !== (k = f(M, n, o))) {
                        !(function (t, n) {
                          var r = m().validPositions[n];
                          if (r)
                            for (var o = r.locator, a = o.length, s = t; s < n; s++)
                              if (m().validPositions[s] === i && !j(s, !0)) {
                                var l = S(s).slice(),
                                  u = x(l, !0),
                                  c = -1;
                                "" === l[l.length - 1].match.def && l.pop(),
                                  e.each(l, function (e, t) {
                                    for (var n = 0; n < a; n++) {
                                      if (
                                        t.locator[n] === i ||
                                        !D(t.locator[n].toString().split(","), o[n].toString().split(","), t.na)
                                      ) {
                                        var r = o[n],
                                          s = u.locator[n],
                                          l = t.locator[n];
                                        r - s > Math.abs(r - l) && (u = t);
                                        break;
                                      }
                                      c < n && ((c = n), (u = t));
                                    }
                                  }),
                                  (u = e.extend({}, u, { input: O(s, u.match, !0) || u.match.def })),
                                  (u.generatedInput = !0),
                                  d(s, u, !0),
                                  (m().validPositions[n] = i),
                                  f(n, r.input, !0);
                              }
                        })(h, k.pos !== i ? k.pos : M),
                          (h = M);
                        break;
                      }
                } else k = { caret: N(h) };
              }
              !1 === k &&
                u.keepStatic &&
                !o &&
                !0 !== s &&
                (k = (function (t, n, r) {
                  var o,
                    s,
                    l,
                    c,
                    f,
                    d,
                    p,
                    h,
                    y = e.extend(!0, {}, m().validPositions),
                    x = !1,
                    b = v();
                  for (c = m().validPositions[b]; b >= 0; b--)
                    if ((l = m().validPositions[b]) && l.alternation !== i) {
                      if (
                        ((o = b),
                        (s = m().validPositions[o].alternation),
                        c.locator[l.alternation] !== l.locator[l.alternation])
                      )
                        break;
                      c = l;
                    }
                  if (s !== i) {
                    h = parseInt(o);
                    var k = c.locator[c.alternation || s] !== i ? c.locator[c.alternation || s] : p[0];
                    k.length > 0 && (k = k.split(",")[0]);
                    var w = m().validPositions[h],
                      E = m().validPositions[h - 1];
                    e.each(S(h, E ? E.locator : i, h - 1), function (o, l) {
                      p = l.locator[s] ? l.locator[s].toString().split(",") : [];
                      for (var c = 0; c < p.length; c++) {
                        var b = [],
                          S = 0,
                          E = 0,
                          C = !1;
                        if (
                          k < p[c] &&
                          (l.na === i || -1 === e.inArray(p[c], l.na.split(",")) || -1 === e.inArray(k.toString(), p))
                        ) {
                          m().validPositions[h] = e.extend(!0, {}, l);
                          var P = m().validPositions[h].locator;
                          for (
                            m().validPositions[h].locator[s] = parseInt(p[c]),
                              null == l.match.fn
                                ? (w.input !== l.match.def && ((C = !0), !0 !== w.generatedInput && b.push(w.input)),
                                  E++,
                                  (m().validPositions[h].generatedInput = !/[0-9a-bA-Z]/.test(l.match.def)),
                                  (m().validPositions[h].input = l.match.def))
                                : (m().validPositions[h].input = w.input),
                              f = h + 1;
                            f < v(i, !0) + 1;
                            f++
                          )
                            (d = m().validPositions[f]),
                              d && !0 !== d.generatedInput && /[0-9a-bA-Z]/.test(d.input)
                                ? b.push(d.input)
                                : f < t && S++,
                              delete m().validPositions[f];
                          for (C && b[0] === l.match.def && b.shift(), g(!0), x = !0; b.length > 0; ) {
                            var A = b.shift();
                            if (A !== u.skipOptionalPartCharacter && !(x = T(v(i, !0) + 1, A, !1, a, !0))) break;
                          }
                          if (x) {
                            m().validPositions[h].locator = P;
                            var D = v(t) + 1;
                            for (f = h + 1; f < v() + 1; f++)
                              ((d = m().validPositions[f]) === i || null == d.match.fn) && f < t + (E - S) && E++;
                            (t += E - S), (x = T(t > D ? D : t, n, r, a, !0));
                          }
                          if (x) return !1;
                          g(), (m().validPositions = e.extend(!0, {}, y));
                        }
                      }
                    });
                  }
                  return x;
                })(h, n, o)),
                !0 === k && (k = { pos: h });
            }
            if (e.isFunction(u.postValidation) && !1 !== k && !o && !0 !== a && !0 !== l) {
              var F = u.postValidation(C(!0), k, u);
              if (F.refreshFromBuffer && F.buffer) {
                var R = F.refreshFromBuffer;
                P(!0 === R ? R : R.start, R.end, F.buffer);
              }
              k = !0 === F ? k : F;
            }
            return (
              k && k.pos === i && (k.pos = h),
              (!1 !== k && !0 !== l) || (g(!0), (m().validPositions = e.extend(!0, {}, E))),
              k
            );
          }
          function j(e, t) {
            var n = b(e).match;
            if (("" === n.def && (n = k(e).match), null != n.fn)) return n.fn;
            if (!0 !== t && e > -1) {
              var i = S(e);
              return i.length > 1 + ("" === i[i.length - 1].match.def ? 1 : 0);
            }
            return !1;
          }
          function N(e, t) {
            var n = m().maskLength;
            if (e >= n) return n;
            var i = e;
            for (
              S(n + 1).length > 1 && (h(!0, n + 1, !0), (n = m().maskLength));
              ++i < n && ((!0 === t && (!0 !== k(i).match.newBlockMarker || !j(i))) || (!0 !== t && !j(i)));

            );
            return i;
          }
          function _(e, t) {
            var n,
              i = e;
            if (i <= 0) return 0;
            for (
              ;
              --i > 0 &&
              ((!0 === t && !0 !== k(i).match.newBlockMarker) ||
                (!0 !== t && !j(i) && ((n = S(i)), n.length < 2 || (2 === n.length && "" === n[1].match.def))));

            );
            return i;
          }
          function L(e) {
            return m().validPositions[e] === i ? O(e) : m().validPositions[e].input;
          }
          function M(t, n, r, o, a) {
            if (o && e.isFunction(u.onBeforeWrite)) {
              var s = u.onBeforeWrite.call(X, o, n, r, u);
              if (s) {
                if (s.refreshFromBuffer) {
                  var l = s.refreshFromBuffer;
                  P(!0 === l ? l : l.start, l.end, s.buffer || n), (n = C(!0));
                }
                r !== i && (r = s.caret !== i ? s.caret : r);
              }
            }
            t !== i &&
              (t.inputmask._valueSet(n.join("")),
              r === i || (o !== i && "blur" === o.type)
                ? W(t, r, 0 === n.length)
                : p && o && "input" === o.type
                ? setTimeout(function () {
                    R(t, r);
                  }, 0)
                : R(t, r),
              !0 === a && ((Z = !0), e(t).trigger("input")));
          }
          function O(t, n, r) {
            if (((n = n || k(t).match), n.placeholder !== i || !0 === r))
              return e.isFunction(n.placeholder) ? n.placeholder(u) : n.placeholder;
            if (null === n.fn) {
              if (t > -1 && m().validPositions[t] === i) {
                var o,
                  a = S(t),
                  s = [];
                if (a.length > 1 + ("" === a[a.length - 1].match.def ? 1 : 0))
                  for (var l = 0; l < a.length; l++)
                    if (
                      !0 !== a[l].match.optionality &&
                      !0 !== a[l].match.optionalQuantifier &&
                      (null === a[l].match.fn || o === i || !1 !== a[l].match.fn.test(o.match.def, m(), t, !0, u)) &&
                      (s.push(a[l]),
                      null === a[l].match.fn && (o = a[l]),
                      s.length > 1 && /[0-9a-bA-Z]/.test(s[0].match.def))
                    )
                      return u.placeholder.charAt(t % u.placeholder.length);
              }
              return n.def;
            }
            return u.placeholder.charAt(t % u.placeholder.length);
          }
          function I(t, o, a, s, l) {
            function c(e, t) {
              return (
                -1 !== E().slice(e, N(e)).join("").indexOf(t) &&
                !j(e) &&
                k(e).match.nativeDef === t.charAt(t.length - 1)
              );
            }
            var f = s.slice(),
              d = "",
              p = -1,
              h = i;
            if ((g(), a || !0 === u.autoUnmask)) p = N(p);
            else {
              var y = E().slice(0, N(-1)).join(""),
                x = f.join("").match(new RegExp("^" + r.escapeRegex(y), "g"));
              x && x.length > 0 && (f.splice(0, x.length * y.length), (p = N(p)));
            }
            if (
              (-1 === p ? ((m().p = N(p)), (p = 0)) : (m().p = p),
              e.each(f, function (n, r) {
                if (r !== i)
                  if (m().validPositions[n] === i && f[n] === O(n) && j(n, !0) && !1 === T(n, f[n], !0, i, i, !0))
                    m().p++;
                  else {
                    var o = new e.Event("_checkval");
                    (o.which = r.charCodeAt(0)), (d += r);
                    var s = v(i, !0),
                      l = m().validPositions[s],
                      y = b(s + 1, l ? l.locator.slice() : i, s);
                    if (!c(p, d) || a || u.autoUnmask) {
                      var x = a ? n : null == y.match.fn && y.match.optionality && s + 1 < m().p ? s + 1 : m().p;
                      (h = ie.keypressEvent.call(t, o, !0, !1, a, x)), (p = x + 1), (d = "");
                    } else h = ie.keypressEvent.call(t, o, !0, !1, !0, s + 1);
                    if (!1 !== h && !a && e.isFunction(u.onBeforeWrite)) {
                      var k = h;
                      if (
                        ((h = u.onBeforeWrite.call(X, o, C(), h.forwardPosition, u)),
                        (h = e.extend(k, h)) && h.refreshFromBuffer)
                      ) {
                        var w = h.refreshFromBuffer;
                        P(!0 === w ? w : w.start, w.end, h.buffer),
                          g(!0),
                          h.caret && ((m().p = h.caret), (h.forwardPosition = h.caret));
                      }
                    }
                  }
              }),
              o)
            ) {
              var w = i;
              n.activeElement === t && h && (w = u.numericInput ? _(h.forwardPosition) : h.forwardPosition),
                M(t, C(), w, l || new e.Event("checkval"), l && "input" === l.type);
            }
          }
          function F(t) {
            if (t) {
              if (t.inputmask === i) return t.value;
              t.inputmask && t.inputmask.refreshValue && ie.setValueEvent.call(t);
            }
            var n = [],
              r = m().validPositions;
            for (var o in r) r[o].match && null != r[o].match.fn && n.push(r[o].input);
            var a = 0 === n.length ? "" : (Y ? n.reverse() : n).join("");
            if (e.isFunction(u.onUnMask)) {
              var s = (Y ? C().slice().reverse() : C()).join("");
              a = u.onUnMask.call(X, s, a, u);
            }
            return a;
          }
          function R(e, r, o, a) {
            function s(e) {
              return (
                !0 === a ||
                  !Y ||
                  "number" != typeof e ||
                  (u.greedy && "" === u.placeholder) ||
                  (e = C().join("").length - e),
                e
              );
            }
            var l;
            if (r === i)
              return (
                e.setSelectionRange
                  ? ((r = e.selectionStart), (o = e.selectionEnd))
                  : t.getSelection
                  ? ((l = t.getSelection().getRangeAt(0)),
                    (l.commonAncestorContainer.parentNode !== e && l.commonAncestorContainer !== e) ||
                      ((r = l.startOffset), (o = l.endOffset)))
                  : n.selection &&
                    n.selection.createRange &&
                    ((l = n.selection.createRange()),
                    (r = 0 - l.duplicate().moveStart("character", -e.inputmask._valueGet().length)),
                    (o = r + l.text.length)),
                { begin: s(r), end: s(o) }
              );
            if ((r.begin !== i && ((o = r.end), (r = r.begin)), "number" == typeof r)) {
              (r = s(r)), (o = s(o)), (o = "number" == typeof o ? o : r);
              var f =
                parseInt(
                  ((e.ownerDocument.defaultView || t).getComputedStyle
                    ? (e.ownerDocument.defaultView || t).getComputedStyle(e, null)
                    : e.currentStyle
                  ).fontSize
                ) * o;
              if (
                ((e.scrollLeft = f > e.scrollWidth ? f : 0),
                c || !1 !== u.insertMode || r !== o || o++,
                e.setSelectionRange)
              )
                (e.selectionStart = r), (e.selectionEnd = o);
              else if (t.getSelection) {
                if (((l = n.createRange()), e.firstChild === i || null === e.firstChild)) {
                  var d = n.createTextNode("");
                  e.appendChild(d);
                }
                l.setStart(e.firstChild, r < e.inputmask._valueGet().length ? r : e.inputmask._valueGet().length),
                  l.setEnd(e.firstChild, o < e.inputmask._valueGet().length ? o : e.inputmask._valueGet().length),
                  l.collapse(!0);
                var p = t.getSelection();
                p.removeAllRanges(), p.addRange(l);
              } else
                e.createTextRange &&
                  ((l = e.createTextRange()),
                  l.collapse(!0),
                  l.moveEnd("character", o),
                  l.moveStart("character", r),
                  l.select());
              W(e, { begin: r, end: o });
            }
          }
          function q(t) {
            var n,
              r,
              o = C(),
              a = o.length,
              s = v(),
              l = {},
              u = m().validPositions[s],
              c = u !== i ? u.locator.slice() : i;
            for (n = s + 1; n < o.length; n++)
              (r = b(n, c, n - 1)), (c = r.locator.slice()), (l[n] = e.extend(!0, {}, r));
            var f = u && u.alternation !== i ? u.locator[u.alternation] : i;
            for (
              n = a - 1;
              n > s &&
              ((r = l[n]),
              (r.match.optionality ||
                (r.match.optionalQuantifier && r.match.newBlockMarker) ||
                (f &&
                  ((f !== l[n].locator[u.alternation] && null != r.match.fn) ||
                    (null === r.match.fn &&
                      r.locator[u.alternation] &&
                      D(r.locator[u.alternation].toString().split(","), f.toString().split(",")) &&
                      "" !== S(n)[0].def)))) &&
                o[n] === O(n, r.match));
              n--
            )
              a--;
            return t ? { l: a, def: l[a] ? l[a].match : i } : a;
          }
          function z(e) {
            for (
              var t, n = q(), r = e.length, o = m().validPositions[v()];
              n < r &&
              !j(n, !0) &&
              (t = o !== i ? b(n, o.locator.slice(""), o) : k(n)) &&
              !0 !== t.match.optionality &&
              ((!0 !== t.match.optionalQuantifier && !0 !== t.match.newBlockMarker) ||
                (n + 1 === r && "" === (o !== i ? b(n + 1, o.locator.slice(""), o) : k(n + 1)).match.def));

            )
              n++;
            for (
              ;
              (t = m().validPositions[n - 1]) && t && t.match.optionality && t.input === u.skipOptionalPartCharacter;

            )
              n--;
            return e.splice(n), e;
          }
          function B(t) {
            if (e.isFunction(u.isComplete)) return u.isComplete(t, u);
            if ("*" === u.repeat) return i;
            var n = !1,
              r = q(!0),
              o = _(r.l);
            if (r.def === i || r.def.newBlockMarker || r.def.optionality || r.def.optionalQuantifier) {
              n = !0;
              for (var a = 0; a <= o; a++) {
                var s = b(a).match;
                if (
                  (null !== s.fn &&
                    m().validPositions[a] === i &&
                    !0 !== s.optionality &&
                    !0 !== s.optionalQuantifier) ||
                  (null === s.fn && t[a] !== O(a, s))
                ) {
                  n = !1;
                  break;
                }
              }
            }
            return n;
          }
          function H(t, n, o, a, s) {
            if (
              (u.numericInput || Y) &&
              (n === r.keyCode.BACKSPACE ? (n = r.keyCode.DELETE) : n === r.keyCode.DELETE && (n = r.keyCode.BACKSPACE),
              Y)
            ) {
              var l = o.end;
              (o.end = o.begin), (o.begin = l);
            }
            n === r.keyCode.BACKSPACE && (o.end - o.begin < 1 || !1 === u.insertMode)
              ? ((o.begin = _(o.begin)),
                m().validPositions[o.begin] !== i &&
                  m().validPositions[o.begin].input === u.groupSeparator &&
                  o.begin--)
              : n === r.keyCode.DELETE &&
                o.begin === o.end &&
                ((o.end =
                  j(o.end, !0) && m().validPositions[o.end] && m().validPositions[o.end].input !== u.radixPoint
                    ? o.end + 1
                    : N(o.end) + 1),
                m().validPositions[o.begin] !== i && m().validPositions[o.begin].input === u.groupSeparator && o.end++),
              y(o.begin, o.end, !1, a),
              !0 !== a &&
                (function () {
                  if (u.keepStatic) {
                    for (
                      var n = [], r = v(-1, !0), o = e.extend(!0, {}, m().validPositions), a = m().validPositions[r];
                      r >= 0;
                      r--
                    ) {
                      var s = m().validPositions[r];
                      if (s) {
                        if (
                          (!0 !== s.generatedInput && /[0-9a-bA-Z]/.test(s.input) && n.push(s.input),
                          delete m().validPositions[r],
                          s.alternation !== i && s.locator[s.alternation] !== a.locator[s.alternation])
                        )
                          break;
                        a = s;
                      }
                    }
                    if (r > -1)
                      for (m().p = N(v(-1, !0)); n.length > 0; ) {
                        var l = new e.Event("keypress");
                        (l.which = n.pop().charCodeAt(0)), ie.keypressEvent.call(t, l, !0, !1, !1, m().p);
                      }
                    else m().validPositions = e.extend(!0, {}, o);
                  }
                })();
            var c = v(o.begin, !0);
            if (c < o.begin) m().p = N(c);
            else if (!0 !== a && ((m().p = o.begin), !0 !== s))
              for (; m().p < c && m().validPositions[m().p] === i; ) m().p++;
          }
          function U(i) {
            function r(e) {
              var t,
                r = n.createElement("span");
              for (var a in o) isNaN(a) && -1 !== a.indexOf("font") && (r.style[a] = o[a]);
              (r.style.textTransform = o.textTransform),
                (r.style.letterSpacing = o.letterSpacing),
                (r.style.position = "absolute"),
                (r.style.height = "auto"),
                (r.style.width = "auto"),
                (r.style.visibility = "hidden"),
                (r.style.whiteSpace = "nowrap"),
                n.body.appendChild(r);
              var s,
                l = i.inputmask._valueGet(),
                u = 0;
              for (t = 0, s = l.length; t <= s; t++) {
                if (((r.innerHTML += l.charAt(t) || "_"), r.offsetWidth >= e)) {
                  var c = e - u,
                    f = r.offsetWidth - e;
                  (r.innerHTML = l.charAt(t)), (c -= r.offsetWidth / 3), (t = c < f ? t - 1 : t);
                  break;
                }
                u = r.offsetWidth;
              }
              return n.body.removeChild(r), t;
            }
            var o = (i.ownerDocument.defaultView || t).getComputedStyle(i, null),
              a = n.createElement("div");
            (a.style.width = o.width),
              (a.style.textAlign = o.textAlign),
              (K = n.createElement("div")),
              (K.className = "im-colormask"),
              i.parentNode.insertBefore(K, i),
              i.parentNode.removeChild(i),
              K.appendChild(a),
              K.appendChild(i),
              (i.style.left = a.offsetLeft + "px"),
              e(i).on("click", function (e) {
                return R(i, r(e.clientX)), ie.clickEvent.call(i, [e]);
              }),
              e(i).on("keydown", function (e) {
                e.shiftKey ||
                  !1 === u.insertMode ||
                  setTimeout(function () {
                    W(i);
                  }, 0);
              });
          }
          function W(e, t, r) {
            function o() {
              d || (null !== s.fn && l.input !== i)
                ? d && ((null !== s.fn && l.input !== i) || "" === s.def) && ((d = !1), (f += "</span>"))
                : ((d = !0), (f += "<span class='im-static'>"));
            }
            function a(i) {
              (!0 !== i && p !== t.begin) ||
                n.activeElement !== e ||
                (f += "<span class='im-caret' style='border-right-width: 1px;border-right-style: solid;'></span>");
            }
            var s,
              l,
              c,
              f = "",
              d = !1,
              p = 0;
            if (K !== i) {
              var h = C();
              if ((t === i ? (t = R(e)) : t.begin === i && (t = { begin: t, end: t }), !0 !== r)) {
                var g = v();
                do
                  a(),
                    m().validPositions[p]
                      ? ((l = m().validPositions[p]), (s = l.match), (c = l.locator.slice()), o(), (f += h[p]))
                      : ((l = b(p, c, p - 1)),
                        (s = l.match),
                        (c = l.locator.slice()),
                        (!1 === u.jitMasking ||
                          p < g ||
                          ("number" == typeof u.jitMasking && isFinite(u.jitMasking) && u.jitMasking > p)) &&
                          (o(), (f += O(p, s)))),
                    p++;
                while (((V === i || p < V) && (null !== s.fn || "" !== s.def)) || g > p || d);
                -1 === f.indexOf("im-caret") && a(!0), d && o();
              }
              var y = K.getElementsByTagName("div")[0];
              (y.innerHTML = f), e.inputmask.positionColorMask(e, y);
            }
          }
          (s = s || this.maskset), (u = u || this.opts);
          var G,
            $,
            V,
            K,
            X = this,
            Q = this.el,
            Y = this.isRTL,
            J = !1,
            Z = !1,
            ee = !1,
            te = !1,
            ne = {
              on: function (t, n, o) {
                var a = function (t) {
                  if (this.inputmask === i && "FORM" !== this.nodeName) {
                    var n = e.data(this, "_inputmask_opts");
                    n ? new r(n).mask(this) : ne.off(this);
                  } else {
                    if (
                      "setvalue" === t.type ||
                      "FORM" === this.nodeName ||
                      !(
                        this.disabled ||
                        (this.readOnly &&
                          !(
                            ("keydown" === t.type && t.ctrlKey && 67 === t.keyCode) ||
                            (!1 === u.tabThrough && t.keyCode === r.keyCode.TAB)
                          ))
                      )
                    ) {
                      switch (t.type) {
                        case "input":
                          if (!0 === Z) return (Z = !1), t.preventDefault();
                          break;
                        case "keydown":
                          (J = !1), (Z = !1);
                          break;
                        case "keypress":
                          if (!0 === J) return t.preventDefault();
                          J = !0;
                          break;
                        case "click":
                          if (f || d) {
                            var a = this,
                              s = arguments;
                            return (
                              setTimeout(function () {
                                o.apply(a, s);
                              }, 0),
                              !1
                            );
                          }
                      }
                      var l = o.apply(this, arguments);
                      return !1 === l && (t.preventDefault(), t.stopPropagation()), l;
                    }
                    t.preventDefault();
                  }
                };
                (t.inputmask.events[n] = t.inputmask.events[n] || []),
                  t.inputmask.events[n].push(a),
                  -1 !== e.inArray(n, ["submit", "reset"]) ? null !== t.form && e(t.form).on(n, a) : e(t).on(n, a);
              },
              off: function (t, n) {
                if (t.inputmask && t.inputmask.events) {
                  var i;
                  n ? ((i = []), (i[n] = t.inputmask.events[n])) : (i = t.inputmask.events),
                    e.each(i, function (n, i) {
                      for (; i.length > 0; ) {
                        var r = i.pop();
                        -1 !== e.inArray(n, ["submit", "reset"])
                          ? null !== t.form && e(t.form).off(n, r)
                          : e(t).off(n, r);
                      }
                      delete t.inputmask.events[n];
                    });
                }
              },
            },
            ie = {
              keydownEvent: function (t) {
                var i = this,
                  o = e(i),
                  a = t.keyCode,
                  s = R(i);
                if (
                  a === r.keyCode.BACKSPACE ||
                  a === r.keyCode.DELETE ||
                  (d && a === r.keyCode.BACKSPACE_SAFARI) ||
                  (t.ctrlKey &&
                    a === r.keyCode.X &&
                    !(function (e) {
                      var t = n.createElement("input"),
                        i = "on" + e,
                        r = i in t;
                      return r || (t.setAttribute(i, "return;"), (r = "function" == typeof t[i])), (t = null), r;
                    })("cut"))
                )
                  t.preventDefault(),
                    H(i, a, s),
                    M(i, C(!0), m().p, t, i.inputmask._valueGet() !== C().join("")),
                    i.inputmask._valueGet() === E().join("")
                      ? o.trigger("cleared")
                      : !0 === B(C()) && o.trigger("complete");
                else if (a === r.keyCode.END || a === r.keyCode.PAGE_DOWN) {
                  t.preventDefault();
                  var l = N(v());
                  u.insertMode || l !== m().maskLength || t.shiftKey || l--, R(i, t.shiftKey ? s.begin : l, l, !0);
                } else
                  (a === r.keyCode.HOME && !t.shiftKey) || a === r.keyCode.PAGE_UP
                    ? (t.preventDefault(), R(i, 0, t.shiftKey ? s.begin : 0, !0))
                    : ((u.undoOnEscape && a === r.keyCode.ESCAPE) || (90 === a && t.ctrlKey)) && !0 !== t.altKey
                    ? (I(i, !0, !1, G.split("")), o.trigger("click"))
                    : a !== r.keyCode.INSERT || t.shiftKey || t.ctrlKey
                    ? !0 === u.tabThrough && a === r.keyCode.TAB
                      ? (!0 === t.shiftKey
                          ? (null === k(s.begin).match.fn && (s.begin = N(s.begin)),
                            (s.end = _(s.begin, !0)),
                            (s.begin = _(s.end, !0)))
                          : ((s.begin = N(s.begin, !0)), (s.end = N(s.begin, !0)), s.end < m().maskLength && s.end--),
                        s.begin < m().maskLength && (t.preventDefault(), R(i, s.begin, s.end)))
                      : t.shiftKey ||
                        (!1 === u.insertMode &&
                          (a === r.keyCode.RIGHT
                            ? setTimeout(function () {
                                var e = R(i);
                                R(i, e.begin);
                              }, 0)
                            : a === r.keyCode.LEFT &&
                              setTimeout(function () {
                                var e = R(i);
                                R(i, Y ? e.begin + 1 : e.begin - 1);
                              }, 0)))
                    : ((u.insertMode = !u.insertMode),
                      R(i, u.insertMode || s.begin !== m().maskLength ? s.begin : s.begin - 1));
                u.onKeyDown.call(this, t, C(), R(i).begin, u), (ee = -1 !== e.inArray(a, u.ignorables));
              },
              keypressEvent: function (t, n, o, a, s) {
                var l = this,
                  c = e(l),
                  f = t.which || t.charCode || t.keyCode;
                if (!(!0 === n || (t.ctrlKey && t.altKey)) && (t.ctrlKey || t.metaKey || ee))
                  return (
                    f === r.keyCode.ENTER &&
                      G !== C().join("") &&
                      ((G = C().join("")),
                      setTimeout(function () {
                        c.trigger("change");
                      }, 0)),
                    !0
                  );
                if (f) {
                  46 === f && !1 === t.shiftKey && "" !== u.radixPoint && (f = u.radixPoint.charCodeAt(0));
                  var d,
                    p = n ? { begin: s, end: s } : R(l),
                    h = String.fromCharCode(f);
                  m().writeOutBuffer = !0;
                  var v = T(p, h, a);
                  if (
                    (!1 !== v && (g(!0), (d = v.caret !== i ? v.caret : n ? v.pos + 1 : N(v.pos)), (m().p = d)),
                    !1 !== o &&
                      (setTimeout(function () {
                        u.onKeyValidation.call(l, f, v, u);
                      }, 0),
                      m().writeOutBuffer && !1 !== v))
                  ) {
                    var y = C();
                    M(l, y, u.numericInput && v.caret === i ? _(d) : d, t, !0 !== n),
                      !0 !== n &&
                        setTimeout(function () {
                          !0 === B(y) && c.trigger("complete");
                        }, 0);
                  }
                  if ((t.preventDefault(), n)) return !1 !== v && (v.forwardPosition = d), v;
                }
              },
              pasteEvent: function (n) {
                var i,
                  r = this,
                  o = n.originalEvent || n,
                  a = e(r),
                  s = r.inputmask._valueGet(!0),
                  l = R(r);
                Y && ((i = l.end), (l.end = l.begin), (l.begin = i));
                var c = s.substr(0, l.begin),
                  f = s.substr(l.end, s.length);
                if (
                  (c === (Y ? E().reverse() : E()).slice(0, l.begin).join("") && (c = ""),
                  f === (Y ? E().reverse() : E()).slice(l.end).join("") && (f = ""),
                  Y && ((i = c), (c = f), (f = i)),
                  t.clipboardData && t.clipboardData.getData)
                )
                  s = c + t.clipboardData.getData("Text") + f;
                else {
                  if (!o.clipboardData || !o.clipboardData.getData) return !0;
                  s = c + o.clipboardData.getData("text/plain") + f;
                }
                var d = s;
                if (e.isFunction(u.onBeforePaste)) {
                  if (!1 === (d = u.onBeforePaste.call(X, s, u))) return n.preventDefault();
                  d || (d = s);
                }
                return (
                  I(r, !1, !1, Y ? d.split("").reverse() : d.toString().split("")),
                  M(r, C(), N(v()), n, G !== C().join("")),
                  !0 === B(C()) && a.trigger("complete"),
                  n.preventDefault()
                );
              },
              inputFallBackEvent: function (t) {
                var n = this,
                  i = n.inputmask._valueGet();
                if (C().join("") !== i) {
                  var o = R(n);
                  if (
                    ((i = (function (e, t, n) {
                      return (
                        "." === t.charAt(n.begin - 1) &&
                          "" !== u.radixPoint &&
                          ((t = t.split("")), (t[n.begin - 1] = u.radixPoint.charAt(0)), (t = t.join(""))),
                        t
                      );
                    })(n, i, o)),
                    (i = (function (e, t, n) {
                      if (f) {
                        var i = t.replace(C().join(""), "");
                        if (1 === i.length) {
                          var r = t.split("");
                          r.splice(n.begin, 0, i), (t = r.join(""));
                        }
                      }
                      return t;
                    })(n, i, o)),
                    o.begin > i.length && (R(n, i.length), (o = R(n))),
                    C().join("") !== i)
                  ) {
                    var a = C().join(""),
                      s = i.length > a.length ? -1 : 0,
                      l = i.substr(0, o.begin),
                      c = i.substr(o.begin),
                      d = a.substr(0, o.begin + s),
                      p = a.substr(o.begin + s),
                      h = o,
                      m = "",
                      g = !1;
                    if (l !== d) {
                      for (
                        var v = (g = l.length >= d.length) ? l.length : d.length, y = 0;
                        l.charAt(y) === d.charAt(y) && y < v;
                        y++
                      );
                      g && (0 === s && (h.begin = y), (m += l.slice(y, h.end)));
                    }
                    if (
                      (c !== p &&
                        (c.length > p.length
                          ? (m += c.slice(0, 1))
                          : c.length < p.length &&
                            ((h.end += p.length - c.length),
                            g ||
                              "" === u.radixPoint ||
                              "" !== c ||
                              l.charAt(h.begin + s - 1) !== u.radixPoint ||
                              (h.begin--, (m = u.radixPoint)))),
                      M(n, C(), { begin: h.begin + s, end: h.end + s }),
                      m.length > 0)
                    )
                      e.each(m.split(""), function (t, i) {
                        var r = new e.Event("keypress");
                        (r.which = i.charCodeAt(0)), (ee = !1), ie.keypressEvent.call(n, r);
                      });
                    else {
                      h.begin === h.end - 1 &&
                        ((h.begin = _(h.begin + 1)), h.begin === h.end - 1 ? R(n, h.begin) : R(n, h.begin, h.end));
                      var x = new e.Event("keydown");
                      (x.keyCode = r.keyCode.DELETE), ie.keydownEvent.call(n, x);
                    }
                    t.preventDefault();
                  }
                }
              },
              setValueEvent: function (t) {
                this.inputmask.refreshValue = !1;
                var n = this,
                  i = n.inputmask._valueGet(!0);
                e.isFunction(u.onBeforeMask) && (i = u.onBeforeMask.call(X, i, u) || i),
                  (i = i.split("")),
                  I(n, !0, !1, Y ? i.reverse() : i),
                  (G = C().join("")),
                  (u.clearMaskOnLostFocus || u.clearIncomplete) &&
                    n.inputmask._valueGet() === E().join("") &&
                    n.inputmask._valueSet("");
              },
              focusEvent: function (e) {
                var t = this,
                  n = t.inputmask._valueGet();
                u.showMaskOnFocus &&
                  (!u.showMaskOnHover || (u.showMaskOnHover && "" === n)) &&
                  (t.inputmask._valueGet() !== C().join("") ? M(t, C(), N(v())) : !1 === te && R(t, N(v()))),
                  !0 === u.positionCaretOnTab &&
                    !1 === te &&
                    "" !== n &&
                    (M(t, C(), R(t)), ie.clickEvent.apply(t, [e, !0])),
                  (G = C().join(""));
              },
              mouseleaveEvent: function (e) {
                var t = this;
                if (((te = !1), u.clearMaskOnLostFocus && n.activeElement !== t)) {
                  var i = C().slice(),
                    r = t.inputmask._valueGet();
                  r !== t.getAttribute("placeholder") &&
                    "" !== r &&
                    (-1 === v() && r === E().join("") ? (i = []) : z(i), M(t, i));
                }
              },
              clickEvent: function (t, r) {
                function o(t) {
                  if ("" !== u.radixPoint) {
                    var n = m().validPositions;
                    if (n[t] === i || n[t].input === O(t)) {
                      if (t < N(-1)) return !0;
                      var r = e.inArray(u.radixPoint, C());
                      if (-1 !== r) {
                        for (var o in n) if (r < o && n[o].input !== O(o)) return !1;
                        return !0;
                      }
                    }
                  }
                  return !1;
                }
                var a = this;
                setTimeout(function () {
                  if (n.activeElement === a) {
                    var e = R(a);
                    if ((r && (Y ? (e.end = e.begin) : (e.begin = e.end)), e.begin === e.end))
                      switch (u.positionCaretOnClick) {
                        case "none":
                          break;
                        case "radixFocus":
                          if (o(e.begin)) {
                            var t = C().join("").indexOf(u.radixPoint);
                            R(a, u.numericInput ? N(t) : t);
                            break;
                          }
                        default:
                          var s = e.begin,
                            l = v(s, !0),
                            c = N(l);
                          if (s < c) R(a, j(s, !0) || j(s - 1, !0) ? s : N(s));
                          else {
                            var f = m().validPositions[l],
                              d = b(c, f ? f.match.locator : i, f),
                              p = O(c, d.match);
                            if (
                              ("" !== p &&
                                C()[c] !== p &&
                                !0 !== d.match.optionalQuantifier &&
                                !0 !== d.match.newBlockMarker) ||
                              (!j(c, !0) && d.match.def === p)
                            ) {
                              var h = N(c);
                              (s >= h || s === c) && (c = h);
                            }
                            R(a, c);
                          }
                      }
                  }
                }, 0);
              },
              dblclickEvent: function (e) {
                var t = this;
                setTimeout(function () {
                  R(t, 0, N(v()));
                }, 0);
              },
              cutEvent: function (i) {
                var o = this,
                  a = e(o),
                  s = R(o),
                  l = i.originalEvent || i,
                  u = t.clipboardData || l.clipboardData,
                  c = Y ? C().slice(s.end, s.begin) : C().slice(s.begin, s.end);
                u.setData("text", Y ? c.reverse().join("") : c.join("")),
                  n.execCommand && n.execCommand("copy"),
                  H(o, r.keyCode.DELETE, s),
                  M(o, C(), m().p, i, G !== C().join("")),
                  o.inputmask._valueGet() === E().join("") && a.trigger("cleared");
              },
              blurEvent: function (t) {
                var n = e(this),
                  r = this;
                if (r.inputmask) {
                  var o = r.inputmask._valueGet(),
                    a = C().slice();
                  "" !== o &&
                    (u.clearMaskOnLostFocus && (-1 === v() && o === E().join("") ? (a = []) : z(a)),
                    !1 === B(a) &&
                      (setTimeout(function () {
                        n.trigger("incomplete");
                      }, 0),
                      u.clearIncomplete && (g(), (a = u.clearMaskOnLostFocus ? [] : E().slice()))),
                    M(r, a, i, t)),
                    G !== C().join("") && ((G = a.join("")), n.trigger("change"));
                }
              },
              mouseenterEvent: function (e) {
                var t = this;
                (te = !0),
                  n.activeElement !== t && u.showMaskOnHover && t.inputmask._valueGet() !== C().join("") && M(t, C());
              },
              submitEvent: function (e) {
                G !== C().join("") && $.trigger("change"),
                  u.clearMaskOnLostFocus &&
                    -1 === v() &&
                    Q.inputmask._valueGet &&
                    Q.inputmask._valueGet() === E().join("") &&
                    Q.inputmask._valueSet(""),
                  u.removeMaskOnSubmit &&
                    (Q.inputmask._valueSet(Q.inputmask.unmaskedvalue(), !0),
                    setTimeout(function () {
                      M(Q, C());
                    }, 0));
              },
              resetEvent: function (e) {
                (Q.inputmask.refreshValue = !0),
                  setTimeout(function () {
                    $.trigger("setvalue");
                  }, 0);
              },
            };
          r.prototype.positionColorMask = function (e, t) {
            e.style.left = t.offsetLeft + "px";
          };
          var re;
          if (o !== i)
            switch (o.action) {
              case "isComplete":
                return (Q = o.el), B(C());
              case "unmaskedvalue":
                return (
                  (Q !== i && o.value === i) ||
                    ((re = o.value),
                    (re = (e.isFunction(u.onBeforeMask) ? u.onBeforeMask.call(X, re, u) || re : re).split("")),
                    I(i, !1, !1, Y ? re.reverse() : re),
                    e.isFunction(u.onBeforeWrite) && u.onBeforeWrite.call(X, i, C(), 0, u)),
                  F(Q)
                );
              case "mask":
                !(function (t) {
                  ne.off(t);
                  var r = (function (t, r) {
                    var o = t.getAttribute("type"),
                      s =
                        ("INPUT" === t.tagName && -1 !== e.inArray(o, r.supportsInputType)) ||
                        t.isContentEditable ||
                        "TEXTAREA" === t.tagName;
                    if (!s)
                      if ("INPUT" === t.tagName) {
                        var l = n.createElement("input");
                        l.setAttribute("type", o), (s = "text" === l.type), (l = null);
                      } else s = "partial";
                    return (
                      !1 !== s
                        ? (function (t) {
                            function o() {
                              return this.inputmask
                                ? this.inputmask.opts.autoUnmask
                                  ? this.inputmask.unmaskedvalue()
                                  : -1 !== v() || !0 !== r.nullable
                                  ? n.activeElement === this && r.clearMaskOnLostFocus
                                    ? (Y ? z(C().slice()).reverse() : z(C().slice())).join("")
                                    : l.call(this)
                                  : ""
                                : l.call(this);
                            }
                            function s(t) {
                              u.call(this, t), this.inputmask && e(this).trigger("setvalue");
                            }
                            var l, u;
                            if (!t.inputmask.__valueGet) {
                              if (!0 !== r.noValuePatching) {
                                if (Object.getOwnPropertyDescriptor) {
                                  "function" != typeof Object.getPrototypeOf &&
                                    (Object.getPrototypeOf =
                                      "object" === a("test".__proto__)
                                        ? function (e) {
                                            return e.__proto__;
                                          }
                                        : function (e) {
                                            return e.constructor.prototype;
                                          });
                                  var c = Object.getPrototypeOf
                                    ? Object.getOwnPropertyDescriptor(Object.getPrototypeOf(t), "value")
                                    : i;
                                  c && c.get && c.set
                                    ? ((l = c.get),
                                      (u = c.set),
                                      Object.defineProperty(t, "value", { get: o, set: s, configurable: !0 }))
                                    : "INPUT" !== t.tagName &&
                                      ((l = function () {
                                        return this.textContent;
                                      }),
                                      (u = function (e) {
                                        this.textContent = e;
                                      }),
                                      Object.defineProperty(t, "value", { get: o, set: s, configurable: !0 }));
                                } else
                                  n.__lookupGetter__ &&
                                    t.__lookupGetter__("value") &&
                                    ((l = t.__lookupGetter__("value")),
                                    (u = t.__lookupSetter__("value")),
                                    t.__defineGetter__("value", o),
                                    t.__defineSetter__("value", s));
                                (t.inputmask.__valueGet = l), (t.inputmask.__valueSet = u);
                              }
                              (t.inputmask._valueGet = function (e) {
                                return Y && !0 !== e ? l.call(this.el).split("").reverse().join("") : l.call(this.el);
                              }),
                                (t.inputmask._valueSet = function (e, t) {
                                  u.call(
                                    this.el,
                                    null === e || e === i ? "" : !0 !== t && Y ? e.split("").reverse().join("") : e
                                  );
                                }),
                                l === i &&
                                  ((l = function () {
                                    return this.value;
                                  }),
                                  (u = function (e) {
                                    this.value = e;
                                  }),
                                  (function (t) {
                                    if (e.valHooks && (e.valHooks[t] === i || !0 !== e.valHooks[t].inputmaskpatch)) {
                                      var n =
                                          e.valHooks[t] && e.valHooks[t].get
                                            ? e.valHooks[t].get
                                            : function (e) {
                                                return e.value;
                                              },
                                        o =
                                          e.valHooks[t] && e.valHooks[t].set
                                            ? e.valHooks[t].set
                                            : function (e, t) {
                                                return (e.value = t), e;
                                              };
                                      e.valHooks[t] = {
                                        get: function (e) {
                                          if (e.inputmask) {
                                            if (e.inputmask.opts.autoUnmask) return e.inputmask.unmaskedvalue();
                                            var t = n(e);
                                            return -1 !== v(i, i, e.inputmask.maskset.validPositions) ||
                                              !0 !== r.nullable
                                              ? t
                                              : "";
                                          }
                                          return n(e);
                                        },
                                        set: function (t, n) {
                                          var i,
                                            r = e(t);
                                          return (i = o(t, n)), t.inputmask && r.trigger("setvalue"), i;
                                        },
                                        inputmaskpatch: !0,
                                      };
                                    }
                                  })(t.type),
                                  (function (t) {
                                    ne.on(t, "mouseenter", function (t) {
                                      var n = e(this);
                                      this.inputmask._valueGet() !== C().join("") && n.trigger("setvalue");
                                    });
                                  })(t));
                            }
                          })(t)
                        : (t.inputmask = i),
                      s
                    );
                  })(t, u);
                  if (
                    !1 !== r &&
                    ((Q = t),
                    ($ = e(Q)),
                    (V = Q !== i ? Q.maxLength : i),
                    -1 === V && (V = i),
                    !0 === u.colorMask && U(Q),
                    p &&
                      (Q.hasOwnProperty("inputmode") &&
                        ((Q.inputmode = u.inputmode), Q.setAttribute("inputmode", u.inputmode)),
                      "rtfm" === u.androidHack && (!0 !== u.colorMask && U(Q), (Q.type = "password"))),
                    !0 === r &&
                      (ne.on(Q, "submit", ie.submitEvent),
                      ne.on(Q, "reset", ie.resetEvent),
                      ne.on(Q, "mouseenter", ie.mouseenterEvent),
                      ne.on(Q, "blur", ie.blurEvent),
                      ne.on(Q, "focus", ie.focusEvent),
                      ne.on(Q, "mouseleave", ie.mouseleaveEvent),
                      !0 !== u.colorMask && ne.on(Q, "click", ie.clickEvent),
                      ne.on(Q, "dblclick", ie.dblclickEvent),
                      ne.on(Q, "paste", ie.pasteEvent),
                      ne.on(Q, "dragdrop", ie.pasteEvent),
                      ne.on(Q, "drop", ie.pasteEvent),
                      ne.on(Q, "cut", ie.cutEvent),
                      ne.on(Q, "complete", u.oncomplete),
                      ne.on(Q, "incomplete", u.onincomplete),
                      ne.on(Q, "cleared", u.oncleared),
                      p || !0 === u.inputEventOnly
                        ? Q.removeAttribute("maxLength")
                        : (ne.on(Q, "keydown", ie.keydownEvent), ne.on(Q, "keypress", ie.keypressEvent)),
                      ne.on(Q, "compositionstart", e.noop),
                      ne.on(Q, "compositionupdate", e.noop),
                      ne.on(Q, "compositionend", e.noop),
                      ne.on(Q, "keyup", e.noop),
                      ne.on(Q, "input", ie.inputFallBackEvent),
                      ne.on(Q, "beforeinput", e.noop)),
                    ne.on(Q, "setvalue", ie.setValueEvent),
                    (G = E().join("")),
                    "" !== Q.inputmask._valueGet(!0) || !1 === u.clearMaskOnLostFocus || n.activeElement === Q)
                  ) {
                    var o = e.isFunction(u.onBeforeMask)
                      ? u.onBeforeMask.call(X, Q.inputmask._valueGet(!0), u) || Q.inputmask._valueGet(!0)
                      : Q.inputmask._valueGet(!0);
                    "" !== o && I(Q, !0, !1, Y ? o.split("").reverse() : o.split(""));
                    var s = C().slice();
                    (G = s.join("")),
                      !1 === B(s) && u.clearIncomplete && g(),
                      u.clearMaskOnLostFocus && n.activeElement !== Q && (-1 === v() ? (s = []) : z(s)),
                      M(Q, s),
                      n.activeElement === Q && R(Q, N(v()));
                  }
                })(Q);
                break;
              case "format":
                return (
                  (re = (e.isFunction(u.onBeforeMask) ? u.onBeforeMask.call(X, o.value, u) || o.value : o.value).split(
                    ""
                  )),
                  I(i, !0, !1, Y ? re.reverse() : re),
                  o.metadata
                    ? {
                        value: Y ? C().slice().reverse().join("") : C().join(""),
                        metadata: l.call(this, { action: "getmetadata" }, s, u),
                      }
                    : Y
                    ? C().slice().reverse().join("")
                    : C().join("")
                );
              case "isValid":
                o.value ? ((re = o.value.split("")), I(i, !0, !0, Y ? re.reverse() : re)) : (o.value = C().join(""));
                for (var oe = C(), ae = q(), se = oe.length - 1; se > ae && !j(se); se--);
                return oe.splice(ae, se + 1 - ae), B(oe) && o.value === C().join("");
              case "getemptymask":
                return E().join("");
              case "remove":
                return (
                  Q &&
                    Q.inputmask &&
                    (($ = e(Q)),
                    Q.inputmask._valueSet(u.autoUnmask ? F(Q) : Q.inputmask._valueGet(!0)),
                    ne.off(Q),
                    Object.getOwnPropertyDescriptor && Object.getPrototypeOf
                      ? Object.getOwnPropertyDescriptor(Object.getPrototypeOf(Q), "value") &&
                        Q.inputmask.__valueGet &&
                        Object.defineProperty(Q, "value", {
                          get: Q.inputmask.__valueGet,
                          set: Q.inputmask.__valueSet,
                          configurable: !0,
                        })
                      : n.__lookupGetter__ &&
                        Q.__lookupGetter__("value") &&
                        Q.inputmask.__valueGet &&
                        (Q.__defineGetter__("value", Q.inputmask.__valueGet),
                        Q.__defineSetter__("value", Q.inputmask.__valueSet)),
                    (Q.inputmask = i)),
                  Q
                );
              case "getmetadata":
                if (e.isArray(s.metadata)) {
                  var le = h(!0, 0, !1).join("");
                  return (
                    e.each(s.metadata, function (e, t) {
                      if (t.mask === le) return (le = t), !1;
                    }),
                    le
                  );
                }
                return s.metadata;
            }
        }
        var u = navigator.userAgent,
          c = /mobile/i.test(u),
          f = /iemobile/i.test(u),
          d = /iphone/i.test(u) && !f,
          p = /android/i.test(u) && !f;
        return (
          (r.prototype = {
            dataAttribute: "data-inputmask",
            defaults: {
              placeholder: "_",
              optionalmarker: { start: "[", end: "]" },
              quantifiermarker: { start: "{", end: "}" },
              groupmarker: { start: "(", end: ")" },
              alternatormarker: "|",
              escapeChar: "\\",
              mask: null,
              regex: null,
              oncomplete: e.noop,
              onincomplete: e.noop,
              oncleared: e.noop,
              repeat: 0,
              greedy: !0,
              autoUnmask: !1,
              removeMaskOnSubmit: !1,
              clearMaskOnLostFocus: !0,
              insertMode: !0,
              clearIncomplete: !1,
              alias: null,
              onKeyDown: e.noop,
              onBeforeMask: null,
              onBeforePaste: function (t, n) {
                return e.isFunction(n.onBeforeMask) ? n.onBeforeMask.call(this, t, n) : t;
              },
              onBeforeWrite: null,
              onUnMask: null,
              showMaskOnFocus: !0,
              showMaskOnHover: !0,
              onKeyValidation: e.noop,
              skipOptionalPartCharacter: " ",
              numericInput: !1,
              rightAlign: !1,
              undoOnEscape: !0,
              radixPoint: "",
              radixPointDefinitionSymbol: i,
              groupSeparator: "",
              keepStatic: null,
              positionCaretOnTab: !0,
              tabThrough: !1,
              supportsInputType: ["text", "tel", "password"],
              ignorables: [
                8,
                9,
                13,
                19,
                27,
                33,
                34,
                35,
                36,
                37,
                38,
                39,
                40,
                45,
                46,
                93,
                112,
                113,
                114,
                115,
                116,
                117,
                118,
                119,
                120,
                121,
                122,
                123,
                0,
                229,
              ],
              isComplete: null,
              canClearPosition: e.noop,
              preValidation: null,
              postValidation: null,
              staticDefinitionSymbol: i,
              jitMasking: !1,
              nullable: !0,
              inputEventOnly: !1,
              noValuePatching: !1,
              positionCaretOnClick: "lvp",
              casing: null,
              inputmode: "verbatim",
              colorMask: !1,
              androidHack: !1,
              importDataAttributes: !0,
            },
            definitions: {
              9: { validator: "[0-9１-９]", cardinality: 1, definitionSymbol: "*" },
              a: { validator: "[A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1, definitionSymbol: "*" },
              "*": { validator: "[0-9１-９A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1 },
            },
            aliases: {},
            masksCache: {},
            mask: function (a) {
              function u(n, r, a, s) {
                if (!0 === r.importDataAttributes) {
                  var l,
                    u,
                    c,
                    f,
                    d = function (e, r) {
                      null !== (r = r !== i ? r : n.getAttribute(s + "-" + e)) &&
                        ("string" == typeof r &&
                          (0 === e.indexOf("on") ? (r = t[r]) : "false" === r ? (r = !1) : "true" === r && (r = !0)),
                        (a[e] = r));
                    },
                    p = n.getAttribute(s);
                  if (
                    (p && "" !== p && ((p = p.replace(new RegExp("'", "g"), '"')), (u = JSON.parse("{" + p + "}"))), u)
                  ) {
                    c = i;
                    for (f in u)
                      if ("alias" === f.toLowerCase()) {
                        c = u[f];
                        break;
                      }
                  }
                  d("alias", c), a.alias && o(a.alias, a, r);
                  for (l in r) {
                    if (u) {
                      c = i;
                      for (f in u)
                        if (f.toLowerCase() === l.toLowerCase()) {
                          c = u[f];
                          break;
                        }
                    }
                    d(l, c);
                  }
                }
                return (
                  e.extend(!0, r, a),
                  ("rtl" === n.dir || r.rightAlign) && (n.style.textAlign = "right"),
                  ("rtl" === n.dir || r.numericInput) && ((n.dir = "ltr"), n.removeAttribute("dir"), (r.isRTL = !0)),
                  r
                );
              }
              var c = this;
              return (
                "string" == typeof a && (a = n.getElementById(a) || n.querySelectorAll(a)),
                (a = a.nodeName ? [a] : a),
                e.each(a, function (t, n) {
                  var o = e.extend(!0, {}, c.opts);
                  u(n, o, e.extend(!0, {}, c.userOptions), c.dataAttribute);
                  var a = s(o, c.noMasksCache);
                  a !== i &&
                    (n.inputmask !== i && ((n.inputmask.opts.autoUnmask = !0), n.inputmask.remove()),
                    (n.inputmask = new r(i, i, !0)),
                    (n.inputmask.opts = o),
                    (n.inputmask.noMasksCache = c.noMasksCache),
                    (n.inputmask.userOptions = e.extend(!0, {}, c.userOptions)),
                    (n.inputmask.isRTL = o.isRTL || o.numericInput),
                    (n.inputmask.el = n),
                    (n.inputmask.maskset = a),
                    e.data(n, "_inputmask_opts", o),
                    l.call(n.inputmask, { action: "mask" }));
                }),
                a && a[0] ? a[0].inputmask || this : this
              );
            },
            option: function (t, n) {
              return "string" == typeof t
                ? this.opts[t]
                : "object" === (void 0 === t ? "undefined" : a(t))
                ? (e.extend(this.userOptions, t), this.el && !0 !== n && this.mask(this.el), this)
                : void 0;
            },
            unmaskedvalue: function (e) {
              return (
                (this.maskset = this.maskset || s(this.opts, this.noMasksCache)),
                l.call(this, { action: "unmaskedvalue", value: e })
              );
            },
            remove: function () {
              return l.call(this, { action: "remove" });
            },
            getemptymask: function () {
              return (
                (this.maskset = this.maskset || s(this.opts, this.noMasksCache)),
                l.call(this, { action: "getemptymask" })
              );
            },
            hasMaskedValue: function () {
              return !this.opts.autoUnmask;
            },
            isComplete: function () {
              return (
                (this.maskset = this.maskset || s(this.opts, this.noMasksCache)), l.call(this, { action: "isComplete" })
              );
            },
            getmetadata: function () {
              return (
                (this.maskset = this.maskset || s(this.opts, this.noMasksCache)),
                l.call(this, { action: "getmetadata" })
              );
            },
            isValid: function (e) {
              return (
                (this.maskset = this.maskset || s(this.opts, this.noMasksCache)),
                l.call(this, { action: "isValid", value: e })
              );
            },
            format: function (e, t) {
              return (
                (this.maskset = this.maskset || s(this.opts, this.noMasksCache)),
                l.call(this, { action: "format", value: e, metadata: t })
              );
            },
            analyseMask: function (t, n, o) {
              function a(e, t, n, i) {
                (this.matches = []),
                  (this.openGroup = e || !1),
                  (this.alternatorGroup = !1),
                  (this.isGroup = e || !1),
                  (this.isOptional = t || !1),
                  (this.isQuantifier = n || !1),
                  (this.isAlternator = i || !1),
                  (this.quantifier = { min: 1, max: 1 });
              }
              function s(t, a, s) {
                s = s !== i ? s : t.matches.length;
                var l = t.matches[s - 1];
                if (n)
                  0 === a.indexOf("[") || (b && /\\d|\\s|\\w]/i.test(a)) || "." === a
                    ? t.matches.splice(s++, 0, {
                        fn: new RegExp(a, o.casing ? "i" : ""),
                        cardinality: 1,
                        optionality: t.isOptional,
                        newBlockMarker: l === i || l.def !== a,
                        casing: null,
                        def: a,
                        placeholder: i,
                        nativeDef: a,
                      })
                    : (b && (a = a[a.length - 1]),
                      e.each(a.split(""), function (e, n) {
                        (l = t.matches[s - 1]),
                          t.matches.splice(s++, 0, {
                            fn: null,
                            cardinality: 0,
                            optionality: t.isOptional,
                            newBlockMarker: l === i || (l.def !== n && null !== l.fn),
                            casing: null,
                            def: o.staticDefinitionSymbol || n,
                            placeholder: o.staticDefinitionSymbol !== i ? n : i,
                            nativeDef: n,
                          });
                      })),
                    (b = !1);
                else {
                  var u = (o.definitions ? o.definitions[a] : i) || r.prototype.definitions[a];
                  if (u && !b) {
                    for (var c = u.prevalidator, f = c ? c.length : 0, d = 1; d < u.cardinality; d++) {
                      var p = f >= d ? c[d - 1] : [],
                        h = p.validator,
                        m = p.cardinality;
                      t.matches.splice(s++, 0, {
                        fn: h
                          ? "string" == typeof h
                            ? new RegExp(h, o.casing ? "i" : "")
                            : new (function () {
                                this.test = h;
                              })()
                          : new RegExp("."),
                        cardinality: m || 1,
                        optionality: t.isOptional,
                        newBlockMarker: l === i || l.def !== (u.definitionSymbol || a),
                        casing: u.casing,
                        def: u.definitionSymbol || a,
                        placeholder: u.placeholder,
                        nativeDef: a,
                      }),
                        (l = t.matches[s - 1]);
                    }
                    t.matches.splice(s++, 0, {
                      fn: u.validator
                        ? "string" == typeof u.validator
                          ? new RegExp(u.validator, o.casing ? "i" : "")
                          : new (function () {
                              this.test = u.validator;
                            })()
                        : new RegExp("."),
                      cardinality: u.cardinality,
                      optionality: t.isOptional,
                      newBlockMarker: l === i || l.def !== (u.definitionSymbol || a),
                      casing: u.casing,
                      def: u.definitionSymbol || a,
                      placeholder: u.placeholder,
                      nativeDef: a,
                    });
                  } else
                    t.matches.splice(s++, 0, {
                      fn: null,
                      cardinality: 0,
                      optionality: t.isOptional,
                      newBlockMarker: l === i || (l.def !== a && null !== l.fn),
                      casing: null,
                      def: o.staticDefinitionSymbol || a,
                      placeholder: o.staticDefinitionSymbol !== i ? a : i,
                      nativeDef: a,
                    }),
                      (b = !1);
                }
              }
              function l(t) {
                t &&
                  t.matches &&
                  e.each(t.matches, function (e, r) {
                    var a = t.matches[e + 1];
                    (a === i || a.matches === i || !1 === a.isQuantifier) &&
                      r &&
                      r.isGroup &&
                      ((r.isGroup = !1),
                      n || (s(r, o.groupmarker.start, 0), !0 !== r.openGroup && s(r, o.groupmarker.end))),
                      l(r);
                  });
              }
              function u() {
                if (w.length > 0) {
                  if (((h = w[w.length - 1]), s(h, d), h.isAlternator)) {
                    m = w.pop();
                    for (var e = 0; e < m.matches.length; e++) m.matches[e].isGroup = !1;
                    w.length > 0 ? ((h = w[w.length - 1]), h.matches.push(m)) : k.matches.push(m);
                  }
                } else s(k, d);
              }
              function c(e) {
                e.matches = e.matches.reverse();
                for (var t in e.matches)
                  if (e.matches.hasOwnProperty(t)) {
                    var n = parseInt(t);
                    if (e.matches[t].isQuantifier && e.matches[n + 1] && e.matches[n + 1].isGroup) {
                      var r = e.matches[t];
                      e.matches.splice(t, 1), e.matches.splice(n + 1, 0, r);
                    }
                    e.matches[t].matches !== i
                      ? (e.matches[t] = c(e.matches[t]))
                      : (e.matches[t] = (function (e) {
                          return (
                            e === o.optionalmarker.start
                              ? (e = o.optionalmarker.end)
                              : e === o.optionalmarker.end
                              ? (e = o.optionalmarker.start)
                              : e === o.groupmarker.start
                              ? (e = o.groupmarker.end)
                              : e === o.groupmarker.end && (e = o.groupmarker.start),
                            e
                          );
                        })(e.matches[t]));
                  }
                return e;
              }
              var f,
                d,
                p,
                h,
                m,
                g,
                v,
                y = /(?:[?*+]|\{[0-9\+\*]+(?:,[0-9\+\*]*)?\})|[^.?*+^${[]()|\\]+|./g,
                x = /\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,
                b = !1,
                k = new a(),
                w = [],
                S = [];
              for (n && ((o.optionalmarker.start = i), (o.optionalmarker.end = i)); (f = n ? x.exec(t) : y.exec(t)); ) {
                if (((d = f[0]), n))
                  switch (d.charAt(0)) {
                    case "?":
                      d = "{0,1}";
                      break;
                    case "+":
                    case "*":
                      d = "{" + d + "}";
                  }
                if (b) u();
                else
                  switch (d.charAt(0)) {
                    case o.escapeChar:
                      (b = !0), n && u();
                      break;
                    case o.optionalmarker.end:
                    case o.groupmarker.end:
                      if (((p = w.pop()), (p.openGroup = !1), p !== i))
                        if (w.length > 0) {
                          if (((h = w[w.length - 1]), h.matches.push(p), h.isAlternator)) {
                            m = w.pop();
                            for (var E = 0; E < m.matches.length; E++)
                              (m.matches[E].isGroup = !1), (m.matches[E].alternatorGroup = !1);
                            w.length > 0 ? ((h = w[w.length - 1]), h.matches.push(m)) : k.matches.push(m);
                          }
                        } else k.matches.push(p);
                      else u();
                      break;
                    case o.optionalmarker.start:
                      w.push(new a(!1, !0));
                      break;
                    case o.groupmarker.start:
                      w.push(new a(!0));
                      break;
                    case o.quantifiermarker.start:
                      var C = new a(!1, !1, !0);
                      d = d.replace(/[{}]/g, "");
                      var P = d.split(","),
                        A = isNaN(P[0]) ? P[0] : parseInt(P[0]),
                        D = 1 === P.length ? A : isNaN(P[1]) ? P[1] : parseInt(P[1]);
                      if (
                        (("*" !== D && "+" !== D) || (A = "*" === D ? 0 : 1),
                        (C.quantifier = { min: A, max: D }),
                        w.length > 0)
                      ) {
                        var T = w[w.length - 1].matches;
                        (f = T.pop()), f.isGroup || ((v = new a(!0)), v.matches.push(f), (f = v)), T.push(f), T.push(C);
                      } else
                        (f = k.matches.pop()),
                          f.isGroup ||
                            (n && null === f.fn && "." === f.def && (f.fn = new RegExp(f.def, o.casing ? "i" : "")),
                            (v = new a(!0)),
                            v.matches.push(f),
                            (f = v)),
                          k.matches.push(f),
                          k.matches.push(C);
                      break;
                    case o.alternatormarker:
                      if (w.length > 0) {
                        h = w[w.length - 1];
                        var j = h.matches[h.matches.length - 1];
                        g =
                          h.openGroup && (j.matches === i || (!1 === j.isGroup && !1 === j.isAlternator))
                            ? w.pop()
                            : h.matches.pop();
                      } else g = k.matches.pop();
                      if (g.isAlternator) w.push(g);
                      else if (
                        (g.alternatorGroup ? ((m = w.pop()), (g.alternatorGroup = !1)) : (m = new a(!1, !1, !1, !0)),
                        m.matches.push(g),
                        w.push(m),
                        g.openGroup)
                      ) {
                        g.openGroup = !1;
                        var N = new a(!0);
                        (N.alternatorGroup = !0), w.push(N);
                      }
                      break;
                    default:
                      u();
                  }
              }
              for (; w.length > 0; ) (p = w.pop()), k.matches.push(p);
              return k.matches.length > 0 && (l(k), S.push(k)), (o.numericInput || o.isRTL) && c(S[0]), S;
            },
          }),
          (r.extendDefaults = function (t) {
            e.extend(!0, r.prototype.defaults, t);
          }),
          (r.extendDefinitions = function (t) {
            e.extend(!0, r.prototype.definitions, t);
          }),
          (r.extendAliases = function (t) {
            e.extend(!0, r.prototype.aliases, t);
          }),
          (r.format = function (e, t, n) {
            return r(t).format(e, n);
          }),
          (r.unmask = function (e, t) {
            return r(t).unmaskedvalue(e);
          }),
          (r.isValid = function (e, t) {
            return r(t).isValid(e);
          }),
          (r.remove = function (t) {
            e.each(t, function (e, t) {
              t.inputmask && t.inputmask.remove();
            });
          }),
          (r.escapeRegex = function (e) {
            var t = ["/", ".", "*", "+", "?", "|", "(", ")", "[", "]", "{", "}", "\\", "$", "^"];
            return e.replace(new RegExp("(\\" + t.join("|\\") + ")", "gim"), "\\$1");
          }),
          (r.keyCode = {
            ALT: 18,
            BACKSPACE: 8,
            BACKSPACE_SAFARI: 127,
            CAPS_LOCK: 20,
            COMMA: 188,
            COMMAND: 91,
            COMMAND_LEFT: 91,
            COMMAND_RIGHT: 93,
            CONTROL: 17,
            DELETE: 46,
            DOWN: 40,
            END: 35,
            ENTER: 13,
            ESCAPE: 27,
            HOME: 36,
            INSERT: 45,
            LEFT: 37,
            MENU: 93,
            NUMPAD_ADD: 107,
            NUMPAD_DECIMAL: 110,
            NUMPAD_DIVIDE: 111,
            NUMPAD_ENTER: 108,
            NUMPAD_MULTIPLY: 106,
            NUMPAD_SUBTRACT: 109,
            PAGE_DOWN: 34,
            PAGE_UP: 33,
            PERIOD: 190,
            RIGHT: 39,
            SHIFT: 16,
            SPACE: 32,
            TAB: 9,
            UP: 38,
            WINDOWS: 91,
            X: 88,
          }),
          r
        );
      });
    },
    function (e, t) {
      e.exports = jQuery;
    },
    function (e, t, n) {
      "use strict";
      var i, r, o;
      "function" == typeof Symbol && Symbol.iterator,
        !(function (a) {
          (r = [n(0), n(1)]), (i = a), void 0 !== (o = "function" == typeof i ? i.apply(t, r) : i) && (e.exports = o);
        })(function (e, t) {
          function n(e) {
            return isNaN(e) || 29 === new Date(e, 2, 0).getDate();
          }
          return (
            t.extendAliases({
              "dd/mm/yyyy": {
                mask: "1/2/y",
                placeholder: "dd/mm/yyyy",
                regex: {
                  val1pre: new RegExp("[0-3]"),
                  val1: new RegExp("0[1-9]|[12][0-9]|3[01]"),
                  val2pre: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp("((0[1-9]|[12][0-9]|3[01])" + n + "[01])");
                  },
                  val2: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp(
                      "((0[1-9]|[12][0-9])" +
                        n +
                        "(0[1-9]|1[012]))|(30" +
                        n +
                        "(0[13-9]|1[012]))|(31" +
                        n +
                        "(0[13578]|1[02]))"
                    );
                  },
                },
                leapday: "29/02/",
                separator: "/",
                yearrange: { minyear: 1900, maxyear: 2099 },
                isInYearRange: function (e, t, n) {
                  if (isNaN(e)) return !1;
                  var i = parseInt(e.concat(t.toString().slice(e.length))),
                    r = parseInt(e.concat(n.toString().slice(e.length)));
                  return (!isNaN(i) && t <= i && i <= n) || (!isNaN(r) && t <= r && r <= n);
                },
                determinebaseyear: function (e, t, n) {
                  var i = new Date().getFullYear();
                  if (e > i) return e;
                  if (t < i) {
                    for (var r = t.toString().slice(0, 2), o = t.toString().slice(2, 4); t < r + n; ) r--;
                    var a = r + o;
                    return e > a ? e : a;
                  }
                  if (e <= i && i <= t) {
                    for (var s = i.toString().slice(0, 2); t < s + n; ) s--;
                    var l = s + n;
                    return l < e ? e : l;
                  }
                  return i;
                },
                onKeyDown: function (n, i, r, o) {
                  var a = e(this);
                  if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
                    var s = new Date();
                    a.val(s.getDate().toString() + (s.getMonth() + 1).toString() + s.getFullYear().toString()),
                      a.trigger("setvalue");
                  }
                },
                getFrontValue: function (e, t, n) {
                  for (var i = 0, r = 0, o = 0; o < e.length && "2" !== e.charAt(o); o++) {
                    var a = n.definitions[e.charAt(o)];
                    a ? ((i += r), (r = a.cardinality)) : r++;
                  }
                  return t.join("").substr(i, r);
                },
                postValidation: function (e, t, i) {
                  var r,
                    o,
                    a = e.join("");
                  return (
                    0 === i.mask.indexOf("y")
                      ? ((o = a.substr(0, 4)), (r = a.substring(4, 10)))
                      : ((o = a.substring(6, 10)), (r = a.substr(0, 6))),
                    t && (r !== i.leapday || n(o))
                  );
                },
                definitions: {
                  1: {
                    validator: function (e, t, n, i, r) {
                      if ("3" == e.charAt(0) && new RegExp("[2-9]").test(e.charAt(1)))
                        return (e = "30"), (t.buffer[n] = "0"), n++, { pos: n };
                      var o = r.regex.val1.test(e);
                      return i ||
                        o ||
                        (e.charAt(1) !== r.separator && -1 === "-./".indexOf(e.charAt(1))) ||
                        !(o = r.regex.val1.test("0" + e.charAt(0)))
                        ? o
                        : ((t.buffer[n - 1] = "0"),
                          { refreshFromBuffer: { start: n - 1, end: n }, pos: n, c: e.charAt(0) });
                    },
                    cardinality: 2,
                    prevalidator: [
                      {
                        validator: function (e, t, n, i, r) {
                          var o = e;
                          isNaN(t.buffer[n + 1]) || (o += t.buffer[n + 1]);
                          var a = 1 === o.length ? r.regex.val1pre.test(o) : r.regex.val1.test(o);
                          if (!i && !a) {
                            if ((a = r.regex.val1.test(e + "0")))
                              return (t.buffer[n] = e), (t.buffer[++n] = "0"), { pos: n, c: "0" };
                            if ((a = r.regex.val1.test("0" + e))) return (t.buffer[n] = "0"), n++, { pos: n };
                          }
                          return a;
                        },
                        cardinality: 1,
                      },
                    ],
                  },
                  2: {
                    validator: function (e, t, n, i, r) {
                      var o = r.getFrontValue(t.mask, t.buffer, r);
                      if (
                        (-1 !== o.indexOf(r.placeholder[0]) && (o = "01" + r.separator),
                        "1" == e.charAt(0) && new RegExp("[3-9]").test(e.charAt(1)))
                      )
                        return (e = "10"), (t.buffer[n] = "0"), n++, { pos: n };
                      var a = r.regex.val2(r.separator).test(o + e);
                      return i ||
                        a ||
                        (e.charAt(1) !== r.separator && -1 === "-./".indexOf(e.charAt(1))) ||
                        !(a = r.regex.val2(r.separator).test(o + "0" + e.charAt(0)))
                        ? a
                        : ((t.buffer[n - 1] = "0"),
                          { refreshFromBuffer: { start: n - 1, end: n }, pos: n, c: e.charAt(0) });
                    },
                    cardinality: 2,
                    prevalidator: [
                      {
                        validator: function (e, t, n, i, r) {
                          isNaN(t.buffer[n + 1]) || (e += t.buffer[n + 1]);
                          var o = r.getFrontValue(t.mask, t.buffer, r);
                          -1 !== o.indexOf(r.placeholder[0]) && (o = "01" + r.separator);
                          var a =
                            1 === e.length
                              ? r.regex.val2pre(r.separator).test(o + e)
                              : r.regex.val2(r.separator).test(o + e);
                          return i || a || !(a = r.regex.val2(r.separator).test(o + "0" + e))
                            ? a
                            : ((t.buffer[n] = "0"), n++, { pos: n });
                        },
                        cardinality: 1,
                      },
                    ],
                  },
                  y: {
                    validator: function (e, t, n, i, r) {
                      return r.isInYearRange(e, r.yearrange.minyear, r.yearrange.maxyear);
                    },
                    cardinality: 4,
                    prevalidator: [
                      {
                        validator: function (e, t, n, i, r) {
                          var o = r.isInYearRange(e, r.yearrange.minyear, r.yearrange.maxyear);
                          if (!i && !o) {
                            var a = r
                              .determinebaseyear(r.yearrange.minyear, r.yearrange.maxyear, e + "0")
                              .toString()
                              .slice(0, 1);
                            if ((o = r.isInYearRange(a + e, r.yearrange.minyear, r.yearrange.maxyear)))
                              return (t.buffer[n++] = a.charAt(0)), { pos: n };
                            if (
                              ((a = r
                                .determinebaseyear(r.yearrange.minyear, r.yearrange.maxyear, e + "0")
                                .toString()
                                .slice(0, 2)),
                              (o = r.isInYearRange(a + e, r.yearrange.minyear, r.yearrange.maxyear)))
                            )
                              return (t.buffer[n++] = a.charAt(0)), (t.buffer[n++] = a.charAt(1)), { pos: n };
                          }
                          return o;
                        },
                        cardinality: 1,
                      },
                      {
                        validator: function (e, t, n, i, r) {
                          var o = r.isInYearRange(e, r.yearrange.minyear, r.yearrange.maxyear);
                          if (!i && !o) {
                            var a = r
                              .determinebaseyear(r.yearrange.minyear, r.yearrange.maxyear, e)
                              .toString()
                              .slice(0, 2);
                            if ((o = r.isInYearRange(e[0] + a[1] + e[1], r.yearrange.minyear, r.yearrange.maxyear)))
                              return (t.buffer[n++] = a.charAt(1)), { pos: n };
                            if (
                              ((a = r
                                .determinebaseyear(r.yearrange.minyear, r.yearrange.maxyear, e)
                                .toString()
                                .slice(0, 2)),
                              (o = r.isInYearRange(a + e, r.yearrange.minyear, r.yearrange.maxyear)))
                            )
                              return (
                                (t.buffer[n - 1] = a.charAt(0)),
                                (t.buffer[n++] = a.charAt(1)),
                                (t.buffer[n++] = e.charAt(0)),
                                { refreshFromBuffer: { start: n - 3, end: n }, pos: n }
                              );
                          }
                          return o;
                        },
                        cardinality: 2,
                      },
                      {
                        validator: function (e, t, n, i, r) {
                          return r.isInYearRange(e, r.yearrange.minyear, r.yearrange.maxyear);
                        },
                        cardinality: 3,
                      },
                    ],
                  },
                },
                insertMode: !1,
                autoUnmask: !1,
              },
              "mm/dd/yyyy": {
                placeholder: "mm/dd/yyyy",
                alias: "dd/mm/yyyy",
                regex: {
                  val2pre: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp("((0[13-9]|1[012])" + n + "[0-3])|(02" + n + "[0-2])");
                  },
                  val2: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp(
                      "((0[1-9]|1[012])" +
                        n +
                        "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" +
                        n +
                        "30)|((0[13578]|1[02])" +
                        n +
                        "31)"
                    );
                  },
                  val1pre: new RegExp("[01]"),
                  val1: new RegExp("0[1-9]|1[012]"),
                },
                leapday: "02/29/",
                onKeyDown: function (n, i, r, o) {
                  var a = e(this);
                  if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
                    var s = new Date();
                    a.val((s.getMonth() + 1).toString() + s.getDate().toString() + s.getFullYear().toString()),
                      a.trigger("setvalue");
                  }
                },
              },
              "yyyy/mm/dd": {
                mask: "y/1/2",
                placeholder: "yyyy/mm/dd",
                alias: "mm/dd/yyyy",
                leapday: "/02/29",
                onKeyDown: function (n, i, r, o) {
                  var a = e(this);
                  if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
                    var s = new Date();
                    a.val(s.getFullYear().toString() + (s.getMonth() + 1).toString() + s.getDate().toString()),
                      a.trigger("setvalue");
                  }
                },
              },
              "dd.mm.yyyy": {
                mask: "1.2.y",
                placeholder: "dd.mm.yyyy",
                leapday: "29.02.",
                separator: ".",
                alias: "dd/mm/yyyy",
              },
              "dd-mm-yyyy": {
                mask: "1-2-y",
                placeholder: "dd-mm-yyyy",
                leapday: "29-02-",
                separator: "-",
                alias: "dd/mm/yyyy",
              },
              "mm.dd.yyyy": {
                mask: "1.2.y",
                placeholder: "mm.dd.yyyy",
                leapday: "02.29.",
                separator: ".",
                alias: "mm/dd/yyyy",
              },
              "mm-dd-yyyy": {
                mask: "1-2-y",
                placeholder: "mm-dd-yyyy",
                leapday: "02-29-",
                separator: "-",
                alias: "mm/dd/yyyy",
              },
              "yyyy.mm.dd": {
                mask: "y.1.2",
                placeholder: "yyyy.mm.dd",
                leapday: ".02.29",
                separator: ".",
                alias: "yyyy/mm/dd",
              },
              "yyyy-mm-dd": {
                mask: "y-1-2",
                placeholder: "yyyy-mm-dd",
                leapday: "-02-29",
                separator: "-",
                alias: "yyyy/mm/dd",
              },
              datetime: {
                mask: "1/2/y h:s",
                placeholder: "dd/mm/yyyy hh:mm",
                alias: "dd/mm/yyyy",
                regex: {
                  hrspre: new RegExp("[012]"),
                  hrs24: new RegExp("2[0-4]|1[3-9]"),
                  hrs: new RegExp("[01][0-9]|2[0-4]"),
                  ampm: new RegExp("^[a|p|A|P][m|M]"),
                  mspre: new RegExp("[0-5]"),
                  ms: new RegExp("[0-5][0-9]"),
                },
                timeseparator: ":",
                hourFormat: "24",
                definitions: {
                  h: {
                    validator: function (e, t, n, i, r) {
                      if ("24" === r.hourFormat && 24 === parseInt(e, 10))
                        return (
                          (t.buffer[n - 1] = "0"),
                          (t.buffer[n] = "0"),
                          { refreshFromBuffer: { start: n - 1, end: n }, c: "0" }
                        );
                      var o = r.regex.hrs.test(e);
                      if (
                        !i &&
                        !o &&
                        (e.charAt(1) === r.timeseparator || -1 !== "-.:".indexOf(e.charAt(1))) &&
                        (o = r.regex.hrs.test("0" + e.charAt(0)))
                      )
                        return (
                          (t.buffer[n - 1] = "0"),
                          (t.buffer[n] = e.charAt(0)),
                          n++,
                          { refreshFromBuffer: { start: n - 2, end: n }, pos: n, c: r.timeseparator }
                        );
                      if (o && "24" !== r.hourFormat && r.regex.hrs24.test(e)) {
                        var a = parseInt(e, 10);
                        return (
                          24 === a
                            ? ((t.buffer[n + 5] = "a"), (t.buffer[n + 6] = "m"))
                            : ((t.buffer[n + 5] = "p"), (t.buffer[n + 6] = "m")),
                          (a -= 12),
                          a < 10
                            ? ((t.buffer[n] = a.toString()), (t.buffer[n - 1] = "0"))
                            : ((t.buffer[n] = a.toString().charAt(1)), (t.buffer[n - 1] = a.toString().charAt(0))),
                          { refreshFromBuffer: { start: n - 1, end: n + 6 }, c: t.buffer[n] }
                        );
                      }
                      return o;
                    },
                    cardinality: 2,
                    prevalidator: [
                      {
                        validator: function (e, t, n, i, r) {
                          var o = r.regex.hrspre.test(e);
                          return i || o || !(o = r.regex.hrs.test("0" + e))
                            ? o
                            : ((t.buffer[n] = "0"), n++, { pos: n });
                        },
                        cardinality: 1,
                      },
                    ],
                  },
                  s: {
                    validator: "[0-5][0-9]",
                    cardinality: 2,
                    prevalidator: [
                      {
                        validator: function (e, t, n, i, r) {
                          var o = r.regex.mspre.test(e);
                          return i || o || !(o = r.regex.ms.test("0" + e)) ? o : ((t.buffer[n] = "0"), n++, { pos: n });
                        },
                        cardinality: 1,
                      },
                    ],
                  },
                  t: {
                    validator: function (e, t, n, i, r) {
                      return r.regex.ampm.test(e + "m");
                    },
                    casing: "lower",
                    cardinality: 1,
                  },
                },
                insertMode: !1,
                autoUnmask: !1,
              },
              datetime12: {
                mask: "1/2/y h:s t\\m",
                placeholder: "dd/mm/yyyy hh:mm xm",
                alias: "datetime",
                hourFormat: "12",
              },
              "mm/dd/yyyy hh:mm xm": {
                mask: "1/2/y h:s t\\m",
                placeholder: "mm/dd/yyyy hh:mm xm",
                alias: "datetime12",
                regex: {
                  val2pre: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp("((0[13-9]|1[012])" + n + "[0-3])|(02" + n + "[0-2])");
                  },
                  val2: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp(
                      "((0[1-9]|1[012])" +
                        n +
                        "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" +
                        n +
                        "30)|((0[13578]|1[02])" +
                        n +
                        "31)"
                    );
                  },
                  val1pre: new RegExp("[01]"),
                  val1: new RegExp("0[1-9]|1[012]"),
                },
                leapday: "02/29/",
                onKeyDown: function (n, i, r, o) {
                  var a = e(this);
                  if (n.ctrlKey && n.keyCode === t.keyCode.RIGHT) {
                    var s = new Date();
                    a.val((s.getMonth() + 1).toString() + s.getDate().toString() + s.getFullYear().toString()),
                      a.trigger("setvalue");
                  }
                },
              },
              "hh:mm t": { mask: "h:s t\\m", placeholder: "hh:mm xm", alias: "datetime", hourFormat: "12" },
              "h:s t": { mask: "h:s t\\m", placeholder: "hh:mm xm", alias: "datetime", hourFormat: "12" },
              "hh:mm:ss": { mask: "h:s:s", placeholder: "hh:mm:ss", alias: "datetime", autoUnmask: !1 },
              "hh:mm": { mask: "h:s", placeholder: "hh:mm", alias: "datetime", autoUnmask: !1 },
              date: { alias: "dd/mm/yyyy" },
              "mm/yyyy": {
                mask: "1/y",
                placeholder: "mm/yyyy",
                leapday: "donotuse",
                separator: "/",
                alias: "mm/dd/yyyy",
              },
              shamsi: {
                regex: {
                  val2pre: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp("((0[1-9]|1[012])" + n + "[0-3])");
                  },
                  val2: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp(
                      "((0[1-9]|1[012])" + n + "(0[1-9]|[12][0-9]))|((0[1-9]|1[012])" + n + "30)|((0[1-6])" + n + "31)"
                    );
                  },
                  val1pre: new RegExp("[01]"),
                  val1: new RegExp("0[1-9]|1[012]"),
                },
                yearrange: { minyear: 1300, maxyear: 1499 },
                mask: "y/1/2",
                leapday: "/12/30",
                placeholder: "yyyy/mm/dd",
                alias: "mm/dd/yyyy",
                clearIncomplete: !0,
              },
              "yyyy-mm-dd hh:mm:ss": {
                mask: "y-1-2 h:s:s",
                placeholder: "yyyy-mm-dd hh:mm:ss",
                alias: "datetime",
                separator: "-",
                leapday: "-02-29",
                regex: {
                  val2pre: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp("((0[13-9]|1[012])" + n + "[0-3])|(02" + n + "[0-2])");
                  },
                  val2: function (e) {
                    var n = t.escapeRegex.call(this, e);
                    return new RegExp(
                      "((0[1-9]|1[012])" +
                        n +
                        "(0[1-9]|[12][0-9]))|((0[13-9]|1[012])" +
                        n +
                        "30)|((0[13578]|1[02])" +
                        n +
                        "31)"
                    );
                  },
                  val1pre: new RegExp("[01]"),
                  val1: new RegExp("0[1-9]|1[012]"),
                },
                onKeyDown: function (e, t, n, i) {},
              },
            }),
            t
          );
        });
    },
    function (e, t, n) {
      "use strict";
      var i, r, o;
      "function" == typeof Symbol && Symbol.iterator,
        !(function (a) {
          (r = [n(0), n(1)]), (i = a), void 0 !== (o = "function" == typeof i ? i.apply(t, r) : i) && (e.exports = o);
        })(function (e, t) {
          return (
            t.extendDefinitions({
              A: { validator: "[A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1, casing: "upper" },
              "&": { validator: "[0-9A-Za-zА-яЁёÀ-ÿµ]", cardinality: 1, casing: "upper" },
              "#": { validator: "[0-9A-Fa-f]", cardinality: 1, casing: "upper" },
            }),
            t.extendAliases({
              url: {
                definitions: { i: { validator: ".", cardinality: 1 } },
                mask: "(\\http://)|(\\http\\s://)|(ftp://)|(ftp\\s://)i{+}",
                insertMode: !1,
                autoUnmask: !1,
                inputmode: "url",
              },
              ip: {
                mask: "i[i[i]].i[i[i]].i[i[i]].i[i[i]]",
                definitions: {
                  i: {
                    validator: function (e, t, n, i, r) {
                      return (
                        n - 1 > -1 && "." !== t.buffer[n - 1]
                          ? ((e = t.buffer[n - 1] + e),
                            (e = n - 2 > -1 && "." !== t.buffer[n - 2] ? t.buffer[n - 2] + e : "0" + e))
                          : (e = "00" + e),
                        new RegExp("25[0-5]|2[0-4][0-9]|[01][0-9][0-9]").test(e)
                      );
                    },
                    cardinality: 1,
                  },
                },
                onUnMask: function (e, t, n) {
                  return e;
                },
                inputmode: "numeric",
              },
              email: {
                mask: "*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]@-{1,63}.-{1,63}[.-{1,63}][.-{1,63}]",
                greedy: !1,
                onBeforePaste: function (e, t) {
                  return (e = e.toLowerCase()), e.replace("mailto:", "");
                },
                definitions: {
                  "*": { validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]", cardinality: 1, casing: "lower" },
                  "-": { validator: "[0-9A-Za-z-]", cardinality: 1, casing: "lower" },
                },
                onUnMask: function (e, t, n) {
                  return e;
                },
                inputmode: "email",
              },
              mac: { mask: "##:##:##:##:##:##" },
              vin: {
                mask: "V{13}9{4}",
                definitions: { V: { validator: "[A-HJ-NPR-Za-hj-npr-z\\d]", cardinality: 1, casing: "upper" } },
                clearIncomplete: !0,
                autoUnmask: !0,
              },
            }),
            t
          );
        });
    },
    function (e, t, n) {
      "use strict";
      var i, r, o;
      "function" == typeof Symbol && Symbol.iterator,
        !(function (a) {
          (r = [n(0), n(1)]), (i = a), void 0 !== (o = "function" == typeof i ? i.apply(t, r) : i) && (e.exports = o);
        })(function (e, t, n) {
          function i(e, n) {
            for (var i = "", r = 0; r < e.length; r++)
              i +=
                t.prototype.definitions[e.charAt(r)] ||
                n.definitions[e.charAt(r)] ||
                n.optionalmarker.start === e.charAt(r) ||
                n.optionalmarker.end === e.charAt(r) ||
                n.quantifiermarker.start === e.charAt(r) ||
                n.quantifiermarker.end === e.charAt(r) ||
                n.groupmarker.start === e.charAt(r) ||
                n.groupmarker.end === e.charAt(r) ||
                n.alternatormarker === e.charAt(r)
                  ? "\\" + e.charAt(r)
                  : e.charAt(r);
            return i;
          }
          return (
            t.extendAliases({
              numeric: {
                mask: function (e) {
                  if (
                    (0 !== e.repeat && isNaN(e.integerDigits) && (e.integerDigits = e.repeat),
                    (e.repeat = 0),
                    e.groupSeparator === e.radixPoint &&
                      e.digits &&
                      "0" !== e.digits &&
                      ("." === e.radixPoint
                        ? (e.groupSeparator = ",")
                        : "," === e.radixPoint
                        ? (e.groupSeparator = ".")
                        : (e.groupSeparator = "")),
                    " " === e.groupSeparator && (e.skipOptionalPartCharacter = n),
                    (e.autoGroup = e.autoGroup && "" !== e.groupSeparator),
                    e.autoGroup &&
                      ("string" == typeof e.groupSize && isFinite(e.groupSize) && (e.groupSize = parseInt(e.groupSize)),
                      isFinite(e.integerDigits)))
                  ) {
                    var t = Math.floor(e.integerDigits / e.groupSize),
                      r = e.integerDigits % e.groupSize;
                    (e.integerDigits = parseInt(e.integerDigits) + (0 === r ? t - 1 : t)),
                      e.integerDigits < 1 && (e.integerDigits = "*");
                  }
                  e.placeholder.length > 1 && (e.placeholder = e.placeholder.charAt(0)),
                    "radixFocus" === e.positionCaretOnClick &&
                      "" === e.placeholder &&
                      !1 === e.integerOptional &&
                      (e.positionCaretOnClick = "lvp"),
                    (e.definitions[";"] = e.definitions["~"]),
                    (e.definitions[";"].definitionSymbol = "~"),
                    !0 === e.numericInput &&
                      ((e.positionCaretOnClick =
                        "radixFocus" === e.positionCaretOnClick ? "lvp" : e.positionCaretOnClick),
                      (e.digitsOptional = !1),
                      isNaN(e.digits) && (e.digits = 2),
                      (e.decimalProtect = !1));
                  var o = "[+]";
                  if (
                    ((o += i(e.prefix, e)),
                    (o += !0 === e.integerOptional ? "~{1," + e.integerDigits + "}" : "~{" + e.integerDigits + "}"),
                    e.digits !== n)
                  ) {
                    e.radixPointDefinitionSymbol = e.decimalProtect ? ":" : e.radixPoint;
                    var a = e.digits.toString().split(",");
                    isFinite(a[0] && a[1] && isFinite(a[1]))
                      ? (o += e.radixPointDefinitionSymbol + ";{" + e.digits + "}")
                      : (isNaN(e.digits) || parseInt(e.digits) > 0) &&
                        (o += e.digitsOptional
                          ? "[" + e.radixPointDefinitionSymbol + ";{1," + e.digits + "}]"
                          : e.radixPointDefinitionSymbol + ";{" + e.digits + "}");
                  }
                  return (o += i(e.suffix, e)), (o += "[-]"), (e.greedy = !1), o;
                },
                placeholder: "",
                greedy: !1,
                digits: "*",
                digitsOptional: !0,
                enforceDigitsOnBlur: !1,
                radixPoint: ".",
                positionCaretOnClick: "radixFocus",
                groupSize: 3,
                groupSeparator: "",
                autoGroup: !1,
                allowMinus: !0,
                negationSymbol: { front: "-", back: "" },
                integerDigits: "+",
                integerOptional: !0,
                prefix: "",
                suffix: "",
                rightAlign: !0,
                decimalProtect: !0,
                min: null,
                max: null,
                step: 1,
                insertMode: !0,
                autoUnmask: !1,
                unmaskAsNumber: !1,
                inputmode: "numeric",
                preValidation: function (t, i, r, o, a) {
                  if ("-" === r || r === a.negationSymbol.front)
                    return (
                      !0 === a.allowMinus &&
                      ((a.isNegative = a.isNegative === n || !a.isNegative),
                      "" === t.join("") || { caret: i, dopost: !0 })
                    );
                  if (!1 === o && r === a.radixPoint && a.digits !== n && (isNaN(a.digits) || parseInt(a.digits) > 0)) {
                    var s = e.inArray(a.radixPoint, t);
                    if (-1 !== s) return !0 === a.numericInput ? i === s : { caret: s + 1 };
                  }
                  return !0;
                },
                postValidation: function (i, r, o) {
                  var a = o.suffix.split(""),
                    s = o.prefix.split("");
                  if (r.pos === n && r.caret !== n && !0 !== r.dopost) return r;
                  var l = r.caret !== n ? r.caret : r.pos,
                    u = i.slice();
                  o.numericInput && ((l = u.length - l - 1), (u = u.reverse()));
                  var c = u[l];
                  if (
                    (c === o.groupSeparator && ((l += 1), (c = u[l])),
                    l === u.length - o.suffix.length - 1 && c === o.radixPoint)
                  )
                    return r;
                  c !== n &&
                    c !== o.radixPoint &&
                    c !== o.negationSymbol.front &&
                    c !== o.negationSymbol.back &&
                    ((u[l] = "?"),
                    o.prefix.length > 0 &&
                    l >= (!1 === o.isNegative ? 1 : 0) &&
                    l < o.prefix.length - 1 + (!1 === o.isNegative ? 1 : 0)
                      ? (s[l - (!1 === o.isNegative ? 1 : 0)] = "?")
                      : o.suffix.length > 0 &&
                        l >= u.length - o.suffix.length - (!1 === o.isNegative ? 1 : 0) &&
                        (a[l - (u.length - o.suffix.length - (!1 === o.isNegative ? 1 : 0))] = "?")),
                    (s = s.join("")),
                    (a = a.join(""));
                  var f = u.join("").replace(s, "");
                  if (
                    ((f = f.replace(a, "")),
                    (f = f.replace(new RegExp(t.escapeRegex(o.groupSeparator), "g"), "")),
                    (f = f.replace(new RegExp("[-" + t.escapeRegex(o.negationSymbol.front) + "]", "g"), "")),
                    (f = f.replace(new RegExp(t.escapeRegex(o.negationSymbol.back) + "$"), "")),
                    isNaN(o.placeholder) && (f = f.replace(new RegExp(t.escapeRegex(o.placeholder), "g"), "")),
                    f.length > 1 &&
                      1 !== f.indexOf(o.radixPoint) &&
                      ("0" === c && (f = f.replace(/^\?/g, "")), (f = f.replace(/^0/g, ""))),
                    f.charAt(0) === o.radixPoint && "" !== o.radixPoint && !0 !== o.numericInput && (f = "0" + f),
                    "" !== f)
                  ) {
                    if (
                      ((f = f.split("")),
                      (!o.digitsOptional || (o.enforceDigitsOnBlur && "blur" === r.event)) && isFinite(o.digits))
                    ) {
                      var d = e.inArray(o.radixPoint, f),
                        p = e.inArray(o.radixPoint, u);
                      -1 === d && (f.push(o.radixPoint), (d = f.length - 1));
                      for (var h = 1; h <= o.digits; h++)
                        (o.digitsOptional && (!o.enforceDigitsOnBlur || "blur" !== r.event)) ||
                        (f[d + h] !== n && f[d + h] !== o.placeholder.charAt(0))
                          ? -1 !== p && u[p + h] !== n && (f[d + h] = f[d + h] || u[p + h])
                          : (f[d + h] = r.placeholder || o.placeholder.charAt(0));
                    }
                    if (
                      !0 !== o.autoGroup ||
                      "" === o.groupSeparator ||
                      (c === o.radixPoint && r.pos === n && !r.dopost)
                    )
                      f = f.join("");
                    else {
                      var m = f[f.length - 1] === o.radixPoint && r.c === o.radixPoint;
                      (f = t(
                        (function (e, t) {
                          var n = "";
                          if (((n += "(" + t.groupSeparator + "*{" + t.groupSize + "}){*}"), "" !== t.radixPoint)) {
                            var i = e.join("").split(t.radixPoint);
                            i[1] && (n += t.radixPoint + "*{" + i[1].match(/^\d*\??\d*/)[0].length + "}");
                          }
                          return n;
                        })(f, o),
                        {
                          numericInput: !0,
                          jitMasking: !0,
                          definitions: { "*": { validator: "[0-9?]", cardinality: 1 } },
                        }
                      ).format(f.join(""))),
                        m && (f += o.radixPoint),
                        f.charAt(0) === o.groupSeparator && f.substr(1);
                    }
                  }
                  if (
                    (o.isNegative && "blur" === r.event && (o.isNegative = "0" !== f),
                    (f = s + f),
                    (f += a),
                    o.isNegative && ((f = o.negationSymbol.front + f), (f += o.negationSymbol.back)),
                    (f = f.split("")),
                    c !== n)
                  )
                    if (c !== o.radixPoint && c !== o.negationSymbol.front && c !== o.negationSymbol.back)
                      (l = e.inArray("?", f)), l > -1 ? (f[l] = c) : (l = r.caret || 0);
                    else if (c === o.radixPoint || c === o.negationSymbol.front || c === o.negationSymbol.back) {
                      var g = e.inArray(c, f);
                      -1 !== g && (l = g);
                    }
                  o.numericInput && ((l = f.length - l - 1), (f = f.reverse()));
                  var v = {
                    caret: c === n || r.pos !== n ? l + (o.numericInput ? -1 : 1) : l,
                    buffer: f,
                    refreshFromBuffer: r.dopost || i.join("") !== f.join(""),
                  };
                  return v.refreshFromBuffer ? v : r;
                },
                onBeforeWrite: function (i, r, o, a) {
                  if (i)
                    switch (i.type) {
                      case "keydown":
                        return a.postValidation(r, { caret: o, dopost: !0 }, a);
                      case "blur":
                      case "checkval":
                        var s;
                        if (
                          ((function (e) {
                            e.parseMinMaxOptions === n &&
                              (null !== e.min &&
                                ((e.min = e.min
                                  .toString()
                                  .replace(new RegExp(t.escapeRegex(e.groupSeparator), "g"), "")),
                                "," === e.radixPoint && (e.min = e.min.replace(e.radixPoint, ".")),
                                (e.min = isFinite(e.min) ? parseFloat(e.min) : NaN),
                                isNaN(e.min) && (e.min = Number.MIN_VALUE)),
                              null !== e.max &&
                                ((e.max = e.max
                                  .toString()
                                  .replace(new RegExp(t.escapeRegex(e.groupSeparator), "g"), "")),
                                "," === e.radixPoint && (e.max = e.max.replace(e.radixPoint, ".")),
                                (e.max = isFinite(e.max) ? parseFloat(e.max) : NaN),
                                isNaN(e.max) && (e.max = Number.MAX_VALUE)),
                              (e.parseMinMaxOptions = "done"));
                          })(a),
                          null !== a.min || null !== a.max)
                        ) {
                          if (
                            ((s = a.onUnMask(r.join(""), n, e.extend({}, a, { unmaskAsNumber: !0 }))),
                            null !== a.min && s < a.min)
                          )
                            return (
                              (a.isNegative = a.min < 0),
                              a.postValidation(
                                a.min.toString().replace(".", a.radixPoint).split(""),
                                { caret: o, dopost: !0, placeholder: "0" },
                                a
                              )
                            );
                          if (null !== a.max && s > a.max)
                            return (
                              (a.isNegative = a.max < 0),
                              a.postValidation(
                                a.max.toString().replace(".", a.radixPoint).split(""),
                                { caret: o, dopost: !0, placeholder: "0" },
                                a
                              )
                            );
                        }
                        return a.postValidation(r, { caret: o, placeholder: "0", event: "blur" }, a);
                      case "_checkval":
                        return { caret: o };
                    }
                },
                regex: {
                  integerPart: function (e, n) {
                    return n
                      ? new RegExp("[" + t.escapeRegex(e.negationSymbol.front) + "+]?")
                      : new RegExp("[" + t.escapeRegex(e.negationSymbol.front) + "+]?\\d+");
                  },
                  integerNPart: function (e) {
                    return new RegExp(
                      "[\\d" + t.escapeRegex(e.groupSeparator) + t.escapeRegex(e.placeholder.charAt(0)) + "]+"
                    );
                  },
                },
                definitions: {
                  "~": {
                    validator: function (e, i, r, o, a, s) {
                      var l = o
                        ? new RegExp("[0-9" + t.escapeRegex(a.groupSeparator) + "]").test(e)
                        : new RegExp("[0-9]").test(e);
                      if (!0 === l) {
                        if (
                          !0 !== a.numericInput &&
                          i.validPositions[r] !== n &&
                          "~" === i.validPositions[r].match.def &&
                          !s
                        ) {
                          var u = i.buffer.join("");
                          (u = u.replace(new RegExp("[-" + t.escapeRegex(a.negationSymbol.front) + "]", "g"), "")),
                            (u = u.replace(new RegExp(t.escapeRegex(a.negationSymbol.back) + "$"), ""));
                          var c = u.split(a.radixPoint);
                          c.length > 1 && (c[1] = c[1].replace(/0/g, a.placeholder.charAt(0))),
                            "0" === c[0] && (c[0] = c[0].replace(/0/g, a.placeholder.charAt(0))),
                            (u = c[0] + a.radixPoint + c[1] || "");
                          var f = i._buffer.join("");
                          for (u === a.radixPoint && (u = f); null === u.match(t.escapeRegex(f) + "$"); )
                            f = f.slice(1);
                          (u = u.replace(f, "")),
                            (u = u.split("")),
                            (l = u[r] === n ? { pos: r, remove: r } : { pos: r });
                        }
                      } else
                        o ||
                          e !== a.radixPoint ||
                          i.validPositions[r - 1] !== n ||
                          ((i.buffer[r] = "0"), (l = { pos: r + 1 }));
                      return l;
                    },
                    cardinality: 1,
                  },
                  "+": {
                    validator: function (e, t, n, i, r) {
                      return r.allowMinus && ("-" === e || e === r.negationSymbol.front);
                    },
                    cardinality: 1,
                    placeholder: "",
                  },
                  "-": {
                    validator: function (e, t, n, i, r) {
                      return r.allowMinus && e === r.negationSymbol.back;
                    },
                    cardinality: 1,
                    placeholder: "",
                  },
                  ":": {
                    validator: function (e, n, i, r, o) {
                      var a = "[" + t.escapeRegex(o.radixPoint) + "]",
                        s = new RegExp(a).test(e);
                      return (
                        s &&
                          n.validPositions[i] &&
                          n.validPositions[i].match.placeholder === o.radixPoint &&
                          (s = { caret: i + 1 }),
                        s
                      );
                    },
                    cardinality: 1,
                    placeholder: function (e) {
                      return e.radixPoint;
                    },
                  },
                },
                onUnMask: function (e, n, i) {
                  if ("" === n && !0 === i.nullable) return n;
                  var r = e.replace(i.prefix, "");
                  return (
                    (r = r.replace(i.suffix, "")),
                    (r = r.replace(new RegExp(t.escapeRegex(i.groupSeparator), "g"), "")),
                    "" !== i.placeholder.charAt(0) && (r = r.replace(new RegExp(i.placeholder.charAt(0), "g"), "0")),
                    i.unmaskAsNumber
                      ? ("" !== i.radixPoint &&
                          -1 !== r.indexOf(i.radixPoint) &&
                          (r = r.replace(t.escapeRegex.call(this, i.radixPoint), ".")),
                        (r = r.replace(new RegExp("^" + t.escapeRegex(i.negationSymbol.front)), "-")),
                        (r = r.replace(new RegExp(t.escapeRegex(i.negationSymbol.back) + "$"), "")),
                        Number(r))
                      : r
                  );
                },
                isComplete: function (e, n) {
                  var i = e.join("");
                  if (e.slice().join("") !== i) return !1;
                  var r = i.replace(n.prefix, "");
                  return (
                    (r = r.replace(n.suffix, "")),
                    (r = r.replace(new RegExp(t.escapeRegex(n.groupSeparator), "g"), "")),
                    "," === n.radixPoint && (r = r.replace(t.escapeRegex(n.radixPoint), ".")),
                    isFinite(r)
                  );
                },
                onBeforeMask: function (e, i) {
                  if (
                    ((i.isNegative = n),
                    (e =
                      e.toString().charAt(e.length - 1) === i.radixPoint
                        ? e.toString().substr(0, e.length - 1)
                        : e.toString()),
                    "" !== i.radixPoint && isFinite(e))
                  ) {
                    var r = e.split("."),
                      o = "" !== i.groupSeparator ? parseInt(i.groupSize) : 0;
                    2 === r.length &&
                      (r[0].length > o || r[1].length > o || (r[0].length <= o && r[1].length < o)) &&
                      (e = e.replace(".", i.radixPoint));
                  }
                  var a = e.match(/,/g),
                    s = e.match(/\./g);
                  if (
                    (s && a
                      ? s.length > a.length
                        ? ((e = e.replace(/\./g, "")), (e = e.replace(",", i.radixPoint)))
                        : a.length > s.length
                        ? ((e = e.replace(/,/g, "")), (e = e.replace(".", i.radixPoint)))
                        : (e = e.indexOf(".") < e.indexOf(",") ? e.replace(/\./g, "") : e.replace(/,/g, ""))
                      : (e = e.replace(new RegExp(t.escapeRegex(i.groupSeparator), "g"), "")),
                    0 === i.digits &&
                      (-1 !== e.indexOf(".")
                        ? (e = e.substring(0, e.indexOf(".")))
                        : -1 !== e.indexOf(",") && (e = e.substring(0, e.indexOf(",")))),
                    "" !== i.radixPoint && isFinite(i.digits) && -1 !== e.indexOf(i.radixPoint))
                  ) {
                    var l = e.split(i.radixPoint),
                      u = l[1].match(new RegExp("\\d*"))[0];
                    if (parseInt(i.digits) < u.toString().length) {
                      var c = Math.pow(10, parseInt(i.digits));
                      (e = e.replace(t.escapeRegex(i.radixPoint), ".")),
                        (e = Math.round(parseFloat(e) * c) / c),
                        (e = e.toString().replace(".", i.radixPoint));
                    }
                  }
                  return e;
                },
                canClearPosition: function (e, t, n, i, r) {
                  var o = e.validPositions[t],
                    a =
                      o.input !== r.radixPoint ||
                      (null !== e.validPositions[t].match.fn && !1 === r.decimalProtect) ||
                      (o.input === r.radixPoint &&
                        e.validPositions[t + 1] &&
                        null === e.validPositions[t + 1].match.fn) ||
                      isFinite(o.input) ||
                      t === n ||
                      o.input === r.groupSeparator ||
                      o.input === r.negationSymbol.front ||
                      o.input === r.negationSymbol.back;
                  return !a || ("+" !== o.match.nativeDef && "-" !== o.match.nativeDef) || (r.isNegative = !1), a;
                },
                onKeyDown: function (n, i, r, o) {
                  var a = e(this);
                  if (n.ctrlKey)
                    switch (n.keyCode) {
                      case t.keyCode.UP:
                        a.val(parseFloat(this.inputmask.unmaskedvalue()) + parseInt(o.step)), a.trigger("setvalue");
                        break;
                      case t.keyCode.DOWN:
                        a.val(parseFloat(this.inputmask.unmaskedvalue()) - parseInt(o.step)), a.trigger("setvalue");
                    }
                },
              },
              currency: {
                prefix: "$ ",
                groupSeparator: ",",
                alias: "numeric",
                placeholder: "0",
                autoGroup: !0,
                digits: 2,
                digitsOptional: !1,
                clearMaskOnLostFocus: !1,
              },
              decimal: { alias: "numeric" },
              integer: { alias: "numeric", digits: 0, radixPoint: "" },
              percentage: {
                alias: "numeric",
                digits: 2,
                digitsOptional: !0,
                radixPoint: ".",
                placeholder: "0",
                autoGroup: !1,
                min: 0,
                max: 100,
                suffix: " %",
                allowMinus: !1,
              },
            }),
            t
          );
        });
    },
    function (e, t, n) {
      "use strict";
      var i, r, o;
      "function" == typeof Symbol && Symbol.iterator,
        !(function (a) {
          (r = [n(0), n(1)]), (i = a), void 0 !== (o = "function" == typeof i ? i.apply(t, r) : i) && (e.exports = o);
        })(function (e, t) {
          function n(e, t) {
            var n = (e.mask || e)
                .replace(/#/g, "9")
                .replace(/\)/, "9")
                .replace(/[+()#-]/g, ""),
              i = (t.mask || t)
                .replace(/#/g, "9")
                .replace(/\)/, "9")
                .replace(/[+()#-]/g, ""),
              r = (e.mask || e).split("#")[0],
              o = (t.mask || t).split("#")[0];
            return 0 === o.indexOf(r) ? -1 : 0 === r.indexOf(o) ? 1 : n.localeCompare(i);
          }
          var i = t.prototype.analyseMask;
          return (
            (t.prototype.analyseMask = function (t, n, r) {
              function o(e, n, i) {
                (n = n || ""), (i = i || s), "" !== n && (i[n] = {});
                for (var r = "", a = i[n] || i, l = e.length - 1; l >= 0; l--)
                  (t = e[l].mask || e[l]),
                    (r = t.substr(0, 1)),
                    (a[r] = a[r] || []),
                    a[r].unshift(t.substr(1)),
                    e.splice(l, 1);
                for (var u in a) a[u].length > 500 && o(a[u].slice(), u, a);
              }
              function a(t) {
                var n = "",
                  i = [];
                for (var o in t)
                  e.isArray(t[o])
                    ? 1 === t[o].length
                      ? i.push(o + t[o])
                      : i.push(
                          o +
                            r.groupmarker.start +
                            t[o].join(r.groupmarker.end + r.alternatormarker + r.groupmarker.start) +
                            r.groupmarker.end
                        )
                    : i.push(o + a(t[o]));
                return (n +=
                  1 === i.length
                    ? i[0]
                    : r.groupmarker.start +
                      i.join(r.groupmarker.end + r.alternatormarker + r.groupmarker.start) +
                      r.groupmarker.end);
              }
              var s = {};
              return (
                r.phoneCodes &&
                  (r.phoneCodes &&
                    r.phoneCodes.length > 1e3 &&
                    ((t = t.substr(1, t.length - 2)),
                    o(t.split(r.groupmarker.end + r.alternatormarker + r.groupmarker.start)),
                    (t = a(s))),
                  (t = t.replace(/9/g, "\\9"))),
                i.call(this, t, n, r)
              );
            }),
            t.extendAliases({
              abstractphone: {
                groupmarker: { start: "<", end: ">" },
                countrycode: "",
                phoneCodes: [],
                mask: function (e) {
                  return (e.definitions = { "#": t.prototype.definitions[9] }), e.phoneCodes.sort(n);
                },
                keepStatic: !0,
                onBeforeMask: function (e, t) {
                  var n = e.replace(/^0{1,2}/, "").replace(/[\s]/g, "");
                  return (
                    (n.indexOf(t.countrycode) > 1 || -1 === n.indexOf(t.countrycode)) && (n = "+" + t.countrycode + n),
                    n
                  );
                },
                onUnMask: function (e, t, n) {
                  return e.replace(/[()#-]/g, "");
                },
                inputmode: "tel",
              },
            }),
            t
          );
        });
    },
    function (e, t, n) {
      "use strict";
      var i,
        r,
        o,
        a =
          "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
            ? function (e) {
                return typeof e;
              }
            : function (e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype
                  ? "symbol"
                  : typeof e;
              };
      !(function (a) {
        (r = [n(2), n(1)]), (i = a), void 0 !== (o = "function" == typeof i ? i.apply(t, r) : i) && (e.exports = o);
      })(function (e, t) {
        return (
          void 0 === e.fn.inputmask &&
            (e.fn.inputmask = function (n, i) {
              var r,
                o = this[0];
              if ((void 0 === i && (i = {}), "string" == typeof n))
                switch (n) {
                  case "unmaskedvalue":
                    return o && o.inputmask ? o.inputmask.unmaskedvalue() : e(o).val();
                  case "remove":
                    return this.each(function () {
                      this.inputmask && this.inputmask.remove();
                    });
                  case "getemptymask":
                    return o && o.inputmask ? o.inputmask.getemptymask() : "";
                  case "hasMaskedValue":
                    return !(!o || !o.inputmask) && o.inputmask.hasMaskedValue();
                  case "isComplete":
                    return !o || !o.inputmask || o.inputmask.isComplete();
                  case "getmetadata":
                    return o && o.inputmask ? o.inputmask.getmetadata() : void 0;
                  case "setvalue":
                    e(o).val(i), o && void 0 === o.inputmask && e(o).triggerHandler("setvalue");
                    break;
                  case "option":
                    if ("string" != typeof i)
                      return this.each(function () {
                        if (void 0 !== this.inputmask) return this.inputmask.option(i);
                      });
                    if (o && void 0 !== o.inputmask) return o.inputmask.option(i);
                    break;
                  default:
                    return (
                      (i.alias = n),
                      (r = new t(i)),
                      this.each(function () {
                        r.mask(this);
                      })
                    );
                }
              else {
                if ("object" == (void 0 === n ? "undefined" : a(n)))
                  return (
                    (r = new t(n)),
                    void 0 === n.mask && void 0 === n.alias
                      ? this.each(function () {
                          return void 0 !== this.inputmask ? this.inputmask.option(n) : void r.mask(this);
                        })
                      : this.each(function () {
                          r.mask(this);
                        })
                  );
                if (void 0 === n)
                  return this.each(function () {
                    (r = new t(i)), r.mask(this);
                  });
              }
            }),
          e.fn.inputmask
        );
      });
    },
    function (e, t, n) {
      var i = n(12);
      "string" == typeof i && (i = [[e.i, i, ""]]), n(14)(i, {}), i.locals && (e.exports = i.locals);
    },
    function (e, t, n) {
      "use strict";
      function i(e) {
        return e && e.__esModule ? e : { default: e };
      }
      n(8), n(3), n(4), n(5), n(6);
      var r = n(1),
        o = i(r),
        a = n(0),
        s = i(a),
        l = n(2),
        u = i(l);
      s.default === u.default && n(7), (window.Inputmask = o.default);
    },
    function (e, t, n) {
      "use strict";
      var i;
      "function" == typeof Symbol && Symbol.iterator,
        void 0 !==
          (i = function () {
            return document;
          }.call(t, n, t, e)) && (e.exports = i);
    },
    function (e, t, n) {
      "use strict";
      var i;
      "function" == typeof Symbol && Symbol.iterator,
        void 0 !==
          (i = function () {
            return window;
          }.call(t, n, t, e)) && (e.exports = i);
    },
    function (e, t, n) {
      (t = e.exports = n(13)(void 0)),
        t.push([
          e.i,
          "span.im-caret {\r\n    -webkit-animation: 1s blink step-end infinite;\r\n    animation: 1s blink step-end infinite;\r\n}\r\n\r\n@keyframes blink {\r\n    from, to {\r\n        border-right-color: black;\r\n    }\r\n    50% {\r\n        border-right-color: transparent;\r\n    }\r\n}\r\n\r\n@-webkit-keyframes blink {\r\n    from, to {\r\n        border-right-color: black;\r\n    }\r\n    50% {\r\n        border-right-color: transparent;\r\n    }\r\n}\r\n\r\nspan.im-static {\r\n    color: grey;\r\n}\r\n\r\ndiv.im-colormask {\r\n    display: inline-block;\r\n    border-style: inset;\r\n    border-width: 2px;\r\n    -webkit-appearance: textfield;\r\n    -moz-appearance: textfield;\r\n    appearance: textfield;\r\n}\r\n\r\ndiv.im-colormask > input {\r\n    position: absolute;\r\n    display: inline-block;\r\n    background-color: transparent;\r\n    color: transparent;\r\n    -webkit-appearance: caret;\r\n    -moz-appearance: caret;\r\n    appearance: caret;\r\n    border-style: none;\r\n    left: 0; /*calculated*/\r\n}\r\n\r\ndiv.im-colormask > input:focus {\r\n    outline: none;\r\n}\r\n\r\ndiv.im-colormask > div {\r\n    color: black;\r\n    display: inline-block;\r\n    width: 100px; /*calculated*/\r\n}",
          "",
        ]);
    },
    function (e, t) {
      function n(e, t) {
        var n = e[1] || "",
          r = e[3];
        if (!r) return n;
        if (t && "function" == typeof btoa) {
          var o = i(r);
          return [n]
            .concat(
              r.sources.map(function (e) {
                return "/*# sourceURL=" + r.sourceRoot + e + " */";
              })
            )
            .concat([o])
            .join("\n");
        }
        return [n].join("\n");
      }
      function i(e) {
        return (
          "/*# sourceMappingURL=data:application/json;charset=utf-8;base64," +
          btoa(unescape(encodeURIComponent(JSON.stringify(e)))) +
          " */"
        );
      }
      e.exports = function (e) {
        var t = [];
        return (
          (t.toString = function () {
            return this.map(function (t) {
              var i = n(t, e);
              return t[2] ? "@media " + t[2] + "{" + i + "}" : i;
            }).join("");
          }),
          (t.i = function (e, n) {
            "string" == typeof e && (e = [[null, e, ""]]);
            for (var i = {}, r = 0; r < this.length; r++) {
              var o = this[r][0];
              "number" == typeof o && (i[o] = !0);
            }
            for (r = 0; r < e.length; r++) {
              var a = e[r];
              ("number" == typeof a[0] && i[a[0]]) ||
                (n && !a[2] ? (a[2] = n) : n && (a[2] = "(" + a[2] + ") and (" + n + ")"), t.push(a));
            }
          }),
          t
        );
      };
    },
    function (e, t, n) {
      function i(e, t) {
        for (var n = 0; n < e.length; n++) {
          var i = e[n],
            r = h[i.id];
          if (r) {
            r.refs++;
            for (var o = 0; o < r.parts.length; o++) r.parts[o](i.parts[o]);
            for (; o < i.parts.length; o++) r.parts.push(c(i.parts[o], t));
          } else {
            for (var a = [], o = 0; o < i.parts.length; o++) a.push(c(i.parts[o], t));
            h[i.id] = { id: i.id, refs: 1, parts: a };
          }
        }
      }
      function r(e) {
        for (var t = [], n = {}, i = 0; i < e.length; i++) {
          var r = e[i],
            o = r[0],
            a = r[1],
            s = r[2],
            l = r[3],
            u = { css: a, media: s, sourceMap: l };
          n[o] ? n[o].parts.push(u) : t.push((n[o] = { id: o, parts: [u] }));
        }
        return t;
      }
      function o(e, t) {
        var n = g(e.insertInto);
        if (!n)
          throw new Error(
            "Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid."
          );
        var i = x[x.length - 1];
        if ("top" === e.insertAt)
          i ? (i.nextSibling ? n.insertBefore(t, i.nextSibling) : n.appendChild(t)) : n.insertBefore(t, n.firstChild),
            x.push(t);
        else {
          if ("bottom" !== e.insertAt)
            throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
          n.appendChild(t);
        }
      }
      function a(e) {
        e.parentNode.removeChild(e);
        var t = x.indexOf(e);
        t >= 0 && x.splice(t, 1);
      }
      function s(e) {
        var t = document.createElement("style");
        return (e.attrs.type = "text/css"), u(t, e.attrs), o(e, t), t;
      }
      function l(e) {
        var t = document.createElement("link");
        return (e.attrs.type = "text/css"), (e.attrs.rel = "stylesheet"), u(t, e.attrs), o(e, t), t;
      }
      function u(e, t) {
        Object.keys(t).forEach(function (n) {
          e.setAttribute(n, t[n]);
        });
      }
      function c(e, t) {
        var n, i, r;
        if (t.singleton) {
          var o = y++;
          (n = v || (v = s(t))), (i = f.bind(null, n, o, !1)), (r = f.bind(null, n, o, !0));
        } else
          e.sourceMap &&
          "function" == typeof URL &&
          "function" == typeof URL.createObjectURL &&
          "function" == typeof URL.revokeObjectURL &&
          "function" == typeof Blob &&
          "function" == typeof btoa
            ? ((n = l(t)),
              (i = p.bind(null, n, t)),
              (r = function () {
                a(n), n.href && URL.revokeObjectURL(n.href);
              }))
            : ((n = s(t)),
              (i = d.bind(null, n)),
              (r = function () {
                a(n);
              }));
        return (
          i(e),
          function (t) {
            if (t) {
              if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;
              i((e = t));
            } else r();
          }
        );
      }
      function f(e, t, n, i) {
        var r = n ? "" : i.css;
        if (e.styleSheet) e.styleSheet.cssText = k(t, r);
        else {
          var o = document.createTextNode(r),
            a = e.childNodes;
          a[t] && e.removeChild(a[t]), a.length ? e.insertBefore(o, a[t]) : e.appendChild(o);
        }
      }
      function d(e, t) {
        var n = t.css,
          i = t.media;
        if ((i && e.setAttribute("media", i), e.styleSheet)) e.styleSheet.cssText = n;
        else {
          for (; e.firstChild; ) e.removeChild(e.firstChild);
          e.appendChild(document.createTextNode(n));
        }
      }
      function p(e, t, n) {
        var i = n.css,
          r = n.sourceMap,
          o = void 0 === t.convertToAbsoluteUrls && r;
        (t.convertToAbsoluteUrls || o) && (i = b(i)),
          r &&
            (i +=
              "\n/*# sourceMappingURL=data:application/json;base64," +
              btoa(unescape(encodeURIComponent(JSON.stringify(r)))) +
              " */");
        var a = new Blob([i], { type: "text/css" }),
          s = e.href;
        (e.href = URL.createObjectURL(a)), s && URL.revokeObjectURL(s);
      }
      var h = {},
        m = (function (e) {
          var t;
          return function () {
            return void 0 === t && (t = e.apply(this, arguments)), t;
          };
        })(function () {
          return window && document && document.all && !window.atob;
        }),
        g = (function (e) {
          var t = {};
          return function (n) {
            return void 0 === t[n] && (t[n] = e.call(this, n)), t[n];
          };
        })(function (e) {
          return document.querySelector(e);
        }),
        v = null,
        y = 0,
        x = [],
        b = n(15);
      e.exports = function (e, t) {
        if ("undefined" != typeof DEBUG && DEBUG && "object" != typeof document)
          throw new Error("The style-loader cannot be used in a non-browser environment");
        (t = t || {}),
          (t.attrs = "object" == typeof t.attrs ? t.attrs : {}),
          void 0 === t.singleton && (t.singleton = m()),
          void 0 === t.insertInto && (t.insertInto = "head"),
          void 0 === t.insertAt && (t.insertAt = "bottom");
        var n = r(e);
        return (
          i(n, t),
          function (e) {
            for (var o = [], a = 0; a < n.length; a++) {
              var s = n[a],
                l = h[s.id];
              l.refs--, o.push(l);
            }
            e && i(r(e), t);
            for (var a = 0; a < o.length; a++) {
              var l = o[a];
              if (0 === l.refs) {
                for (var u = 0; u < l.parts.length; u++) l.parts[u]();
                delete h[l.id];
              }
            }
          }
        );
      };
      var k = (function () {
        var e = [];
        return function (t, n) {
          return (e[t] = n), e.filter(Boolean).join("\n");
        };
      })();
    },
    function (e, t) {
      e.exports = function (e) {
        var t = "undefined" != typeof window && window.location;
        if (!t) throw new Error("fixUrls requires window.location");
        if (!e || "string" != typeof e) return e;
        var n = t.protocol + "//" + t.host,
          i = n + t.pathname.replace(/\/[^\/]*$/, "/");
        return e.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function (e, t) {
          var r = t
            .trim()
            .replace(/^"(.*)"$/, function (e, t) {
              return t;
            })
            .replace(/^'(.*)'$/, function (e, t) {
              return t;
            });
          if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/)/i.test(r)) return e;
          var o;
          return (
            (o = 0 === r.indexOf("//") ? r : 0 === r.indexOf("/") ? n + r : i + r.replace(/^\.\//, "")),
            "url(" + JSON.stringify(o) + ")"
          );
        });
      };
    },
  ]);
