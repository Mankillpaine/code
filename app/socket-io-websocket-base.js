function getMsg(t){
	console.log(t);
    hjdate(t);
}

!function(e, t) {
    "function" == typeof define && define.amd ? define([], t) : "function" == typeof require && "object" == typeof module && module && module.exports ? module.exports = t() : (e.dcodeIO = e.dcodeIO || {}).Long = t()
}(this, function() {
    "use strict";
    var e = function(e, t, i) {
        this.low = 0 | e,
        this.high = 0 | t,
        this.unsigned = !!i
    }
    ;
    e.isLong = function(t) {
        return (t && t instanceof e) === !0
    }
    ;
    var t = {}
      , i = {};
    e.fromInt = function(r, n) {
        var o, s;
        return n ? (r >>>= 0,
        r >= 0 && 256 > r && (s = i[r]) ? s : (o = new e(r,0 > (0 | r) ? -1 : 0,!0),
        r >= 0 && 256 > r && (i[r] = o),
        o)) : (r = 0 | r,
        r >= -128 && 128 > r && (s = t[r]) ? s : (o = new e(r,0 > r ? -1 : 0,!1),
        r >= -128 && 128 > r && (t[r] = o),
        o))
    }
    ,
    e.fromNumber = function(t, i) {
        return i = !!i,
        isNaN(t) || !isFinite(t) ? e.ZERO : !i && -s >= t ? e.MIN_VALUE : !i && t + 1 >= s ? e.MAX_VALUE : i && t >= o ? e.MAX_UNSIGNED_VALUE : 0 > t ? e.fromNumber(-t, i).negate() : new e(t % n | 0,t / n | 0,i)
    }
    ,
    e.fromBits = function(t, i, r) {
        return new e(t,i,r)
    }
    ,
    e.fromString = function(t, i, r) {
        if (0 === t.length)
            throw Error("number format error: empty string");
        if ("NaN" === t || "Infinity" === t || "+Infinity" === t || "-Infinity" === t)
            return e.ZERO;
        if ("number" == typeof i && (r = i,
        i = !1),
        r = r || 10,
        2 > r || r > 36)
            throw Error("radix out of range: " + r);
        var n;
        if ((n = t.indexOf("-")) > 0)
            throw Error('number format error: interior "-" character: ' + t);
        if (0 === n)
            return e.fromString(t.substring(1), i, r).negate();
        for (var o = e.fromNumber(Math.pow(r, 8)), s = e.ZERO, a = 0; a < t.length; a += 8) {
            var l = Math.min(8, t.length - a)
              , f = parseInt(t.substring(a, a + l), r);
            if (8 > l) {
                var u = e.fromNumber(Math.pow(r, l));
                s = s.multiply(u).add(e.fromNumber(f))
            } else
                s = s.multiply(o),
                s = s.add(e.fromNumber(f))
        }
        return s.unsigned = i,
        s
    }
    ,
    e.fromValue = function(t) {
        return "number" == typeof t ? e.fromNumber(t) : "string" == typeof t ? e.fromString(t) : e.isLong(t) ? t : new e(t.low,t.high,t.unsigned)
    }
    ;
    var r = 1 << 24
      , n = 4294967296
      , o = 0x10000000000000000
      , s = o / 2
      , a = e.fromInt(r);
    return e.ZERO = e.fromInt(0),
    e.UZERO = e.fromInt(0, !0),
    e.ONE = e.fromInt(1),
    e.UONE = e.fromInt(1, !0),
    e.NEG_ONE = e.fromInt(-1),
    e.MAX_VALUE = e.fromBits(-1, 2147483647, !1),
    e.MAX_UNSIGNED_VALUE = e.fromBits(-1, -1, !0),
    e.MIN_VALUE = e.fromBits(0, -2147483648, !1),
    e.prototype.toInt = function() {
        return this.unsigned ? this.low >>> 0 : this.low
    }
    ,
    e.prototype.toNumber = function() {
        return this.unsigned ? (this.high >>> 0) * n + (this.low >>> 0) : this.high * n + (this.low >>> 0)
    }
    ,
    e.prototype.toString = function(t) {
        if (t = t || 10,
        2 > t || t > 36)
            throw RangeError("radix out of range: " + t);
        if (this.isZero())
            return "0";
        var i;
        if (this.isNegative()) {
            if (this.equals(e.MIN_VALUE)) {
                var r = e.fromNumber(t)
                  , n = this.div(r);
                return i = n.multiply(r).subtract(this),
                n.toString(t) + i.toInt().toString(t)
            }
            return "-" + this.negate().toString(t)
        }
        var o = e.fromNumber(Math.pow(t, 6), this.unsigned);
        i = this;
        for (var s = ""; ; ) {
            var a = i.div(o)
              , l = i.subtract(a.multiply(o)).toInt() >>> 0
              , f = l.toString(t);
            if (i = a,
            i.isZero())
                return f + s;
            for (; f.length < 6; )
                f = "0" + f;
            s = "" + f + s
        }
    }
    ,
    e.prototype.getHighBits = function() {
        return this.high
    }
    ,
    e.prototype.getHighBitsUnsigned = function() {
        return this.high >>> 0
    }
    ,
    e.prototype.getLowBits = function() {
        return this.low
    }
    ,
    e.prototype.getLowBitsUnsigned = function() {
        return this.low >>> 0
    }
    ,
    e.prototype.getNumBitsAbs = function() {
        if (this.isNegative())
            return this.equals(e.MIN_VALUE) ? 64 : this.negate().getNumBitsAbs();
        for (var t = 0 != this.high ? this.high : this.low, i = 31; i > 0 && 0 == (t & 1 << i); i--)
            ;
        return 0 != this.high ? i + 33 : i + 1
    }
    ,
    e.prototype.isZero = function() {
        return 0 === this.high && 0 === this.low
    }
    ,
    e.prototype.isNegative = function() {
        return !this.unsigned && this.high < 0
    }
    ,
    e.prototype.isPositive = function() {
        return this.unsigned || this.high >= 0
    }
    ,
    e.prototype.isOdd = function() {
        return 1 === (1 & this.low)
    }
    ,
    e.prototype.isEven = function() {
        return 0 === (1 & this.low)
    }
    ,
    e.prototype.equals = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        this.unsigned !== t.unsigned && this.high >>> 31 === 1 && t.high >>> 31 === 1 ? !1 : this.high === t.high && this.low === t.low
    }
    ,
    e.prototype.notEquals = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        !this.equals(t)
    }
    ,
    e.prototype.lessThan = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        this.compare(t) < 0
    }
    ,
    e.prototype.lessThanOrEqual = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        this.compare(t) <= 0
    }
    ,
    e.prototype.greaterThan = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        this.compare(t) > 0
    }
    ,
    e.prototype.greaterThanOrEqual = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        this.compare(t) >= 0
    }
    ,
    e.prototype.compare = function(e) {
        if (this.equals(e))
            return 0;
        var t = this.isNegative()
          , i = e.isNegative();
        return t && !i ? -1 : !t && i ? 1 : this.unsigned ? e.high >>> 0 > this.high >>> 0 || e.high === this.high && e.low >>> 0 > this.low >>> 0 ? -1 : 1 : this.subtract(e).isNegative() ? -1 : 1
    }
    ,
    e.prototype.negate = function() {
        return !this.unsigned && this.equals(e.MIN_VALUE) ? e.MIN_VALUE : this.not().add(e.ONE)
    }
    ,
    e.prototype.add = function(t) {
        e.isLong(t) || (t = e.fromValue(t));
        var i = this.high >>> 16
          , r = 65535 & this.high
          , n = this.low >>> 16
          , o = 65535 & this.low
          , s = t.high >>> 16
          , a = 65535 & t.high
          , l = t.low >>> 16
          , f = 65535 & t.low
          , u = 0
          , h = 0
          , p = 0
          , d = 0;
        return d += o + f,
        p += d >>> 16,
        d &= 65535,
        p += n + l,
        h += p >>> 16,
        p &= 65535,
        h += r + a,
        u += h >>> 16,
        h &= 65535,
        u += i + s,
        u &= 65535,
        e.fromBits(p << 16 | d, u << 16 | h, this.unsigned)
    }
    ,
    e.prototype.subtract = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        this.add(t.negate())
    }
    ,
    e.prototype.multiply = function(t) {
        if (this.isZero())
            return e.ZERO;
        if (e.isLong(t) || (t = e.fromValue(t)),
        t.isZero())
            return e.ZERO;
        if (this.equals(e.MIN_VALUE))
            return t.isOdd() ? e.MIN_VALUE : e.ZERO;
        if (t.equals(e.MIN_VALUE))
            return this.isOdd() ? e.MIN_VALUE : e.ZERO;
        if (this.isNegative())
            return t.isNegative() ? this.negate().multiply(t.negate()) : this.negate().multiply(t).negate();
        if (t.isNegative())
            return this.multiply(t.negate()).negate();
        if (this.lessThan(a) && t.lessThan(a))
            return e.fromNumber(this.toNumber() * t.toNumber(), this.unsigned);
        var i = this.high >>> 16
          , r = 65535 & this.high
          , n = this.low >>> 16
          , o = 65535 & this.low
          , s = t.high >>> 16
          , l = 65535 & t.high
          , f = t.low >>> 16
          , u = 65535 & t.low
          , h = 0
          , p = 0
          , d = 0
          , c = 0;
        return c += o * u,
        d += c >>> 16,
        c &= 65535,
        d += n * u,
        p += d >>> 16,
        d &= 65535,
        d += o * f,
        p += d >>> 16,
        d &= 65535,
        p += r * u,
        h += p >>> 16,
        p &= 65535,
        p += n * f,
        h += p >>> 16,
        p &= 65535,
        p += o * l,
        h += p >>> 16,
        p &= 65535,
        h += i * u + r * f + n * l + o * s,
        h &= 65535,
        e.fromBits(d << 16 | c, h << 16 | p, this.unsigned)
    }
    ,
    e.prototype.div = function(t) {
        if (e.isLong(t) || (t = e.fromValue(t)),
        t.isZero())
            throw new Error("division by zero");
        if (this.isZero())
            return this.unsigned ? e.UZERO : e.ZERO;
        var i, r, n;
        if (this.equals(e.MIN_VALUE)) {
            if (t.equals(e.ONE) || t.equals(e.NEG_ONE))
                return e.MIN_VALUE;
            if (t.equals(e.MIN_VALUE))
                return e.ONE;
            var o = this.shiftRight(1);
            return i = o.div(t).shiftLeft(1),
            i.equals(e.ZERO) ? t.isNegative() ? e.ONE : e.NEG_ONE : (r = this.subtract(t.multiply(i)),
            n = i.add(r.div(t)))
        }
        if (t.equals(e.MIN_VALUE))
            return this.unsigned ? e.UZERO : e.ZERO;
        if (this.isNegative())
            return t.isNegative() ? this.negate().div(t.negate()) : this.negate().div(t).negate();
        if (t.isNegative())
            return this.div(t.negate()).negate();
        for (n = e.ZERO,
        r = this; r.greaterThanOrEqual(t); ) {
            i = Math.max(1, Math.floor(r.toNumber() / t.toNumber()));
            for (var s = Math.ceil(Math.log(i) / Math.LN2), a = 48 >= s ? 1 : Math.pow(2, s - 48), l = e.fromNumber(i), f = l.multiply(t); f.isNegative() || f.greaterThan(r); )
                i -= a,
                l = e.fromNumber(i, this.unsigned),
                f = l.multiply(t);
            l.isZero() && (l = e.ONE),
            n = n.add(l),
            r = r.subtract(f)
        }
        return n
    }
    ,
    e.prototype.modulo = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        this.subtract(this.div(t).multiply(t))
    }
    ,
    e.prototype.not = function() {
        return e.fromBits(~this.low, ~this.high, this.unsigned)
    }
    ,
    e.prototype.and = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        e.fromBits(this.low & t.low, this.high & t.high, this.unsigned)
    }
    ,
    e.prototype.or = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        e.fromBits(this.low | t.low, this.high | t.high, this.unsigned)
    }
    ,
    e.prototype.xor = function(t) {
        return e.isLong(t) || (t = e.fromValue(t)),
        e.fromBits(this.low ^ t.low, this.high ^ t.high, this.unsigned)
    }
    ,
    e.prototype.shiftLeft = function(t) {
        return e.isLong(t) && (t = t.toInt()),
        0 === (t &= 63) ? this : 32 > t ? e.fromBits(this.low << t, this.high << t | this.low >>> 32 - t, this.unsigned) : e.fromBits(0, this.low << t - 32, this.unsigned)
    }
    ,
    e.prototype.shiftRight = function(t) {
        return e.isLong(t) && (t = t.toInt()),
        0 === (t &= 63) ? this : 32 > t ? e.fromBits(this.low >>> t | this.high << 32 - t, this.high >> t, this.unsigned) : e.fromBits(this.high >> t - 32, this.high >= 0 ? 0 : -1, this.unsigned)
    }
    ,
    e.prototype.shiftRightUnsigned = function(t) {
        if (e.isLong(t) && (t = t.toInt()),
        t &= 63,
        0 === t)
            return this;
        var i = this.high;
        if (32 > t) {
            var r = this.low;
            return e.fromBits(r >>> t | i << 32 - t, i >>> t, this.unsigned)
        }
        return 32 === t ? e.fromBits(i, 0, this.unsigned) : e.fromBits(i >>> t - 32, 0, this.unsigned)
    }
    ,
    e.prototype.toSigned = function() {
        return this.unsigned ? new e(this.low,this.high,!1) : this
    }
    ,
    e.prototype.toUnsigned = function() {
        return this.unsigned ? this : new e(this.low,this.high,!0)
    }
    ,
    e
}),
function(e, t) {
    "function" == typeof define && define.amd ? define(["Long"], t) : "function" == typeof require && "object" == typeof module && module && module.exports ? module.exports = function() {
        var e;
        try {
            e = require("long")
        } catch (i) {}
        return t(e)
    }() : (e.dcodeIO = e.dcodeIO || {}).ByteBuffer = t(e.dcodeIO.Long)
}(this, function(e) {
    "use strict";
    function t(e) {
        var t = 0;
        return function() {
            return t < e.length ? e.charCodeAt(t++) : null
        }
    }
    function i() {
        var e = []
          , t = [];
        return function() {
            return 0 === arguments.length ? t.join("") + l.apply(String, e) : (e.length + arguments.length > 1024 && (t.push(l.apply(String, e)),
            e.length = 0),
            void Array.prototype.push.apply(e, arguments))
        }
    }
    function r(e, t, i, r, n) {
        var o, s, a = 8 * n - r - 1, l = (1 << a) - 1, f = l >> 1, u = -7, h = i ? n - 1 : 0, p = i ? -1 : 1, d = e[t + h];
        for (h += p,
        o = d & (1 << -u) - 1,
        d >>= -u,
        u += a; u > 0; o = 256 * o + e[t + h],
        h += p,
        u -= 8)
            ;
        for (s = o & (1 << -u) - 1,
        o >>= -u,
        u += r; u > 0; s = 256 * s + e[t + h],
        h += p,
        u -= 8)
            ;
        if (0 === o)
            o = 1 - f;
        else {
            if (o === l)
                return s ? NaN : (d ? -1 : 1) * (1 / 0);
            s += Math.pow(2, r),
            o -= f
        }
        return (d ? -1 : 1) * s * Math.pow(2, o - r)
    }
    function n(e, t, i, r, n, o) {
        var s, a, l, f = 8 * o - n - 1, u = (1 << f) - 1, h = u >> 1, p = 23 === n ? Math.pow(2, -24) - Math.pow(2, -77) : 0, d = r ? 0 : o - 1, c = r ? 1 : -1, m = 0 > t || 0 === t && 0 > 1 / t ? 1 : 0;
        for (t = Math.abs(t),
        isNaN(t) || t === 1 / 0 ? (a = isNaN(t) ? 1 : 0,
        s = u) : (s = Math.floor(Math.log(t) / Math.LN2),
        t * (l = Math.pow(2, -s)) < 1 && (s--,
        l *= 2),
        t += s + h >= 1 ? p / l : p * Math.pow(2, 1 - h),
        t * l >= 2 && (s++,
        l /= 2),
        s + h >= u ? (a = 0,
        s = u) : s + h >= 1 ? (a = (t * l - 1) * Math.pow(2, n),
        s += h) : (a = t * Math.pow(2, h - 1) * Math.pow(2, n),
        s = 0)); n >= 8; e[i + d] = 255 & a,
        d += c,
        a /= 256,
        n -= 8)
            ;
        for (s = s << n | a,
        f += n; f > 0; e[i + d] = 255 & s,
        d += c,
        s /= 256,
        f -= 8)
            ;
        e[i + d - c] |= 128 * m
    }
    var o = function(e, t, i) {
        if ("undefined" == typeof e && (e = o.DEFAULT_CAPACITY),
        "undefined" == typeof t && (t = o.DEFAULT_ENDIAN),
        "undefined" == typeof i && (i = o.DEFAULT_NOASSERT),
        !i) {
            if (e = 0 | e,
            0 > e)
                throw RangeError("Illegal capacity");
            t = !!t,
            i = !!i
        }
        this.buffer = 0 === e ? a : new ArrayBuffer(e),
        this.view = 0 === e ? null : new Uint8Array(this.buffer),
        this.offset = 0,
        this.markedOffset = -1,
        this.limit = e,
        this.littleEndian = "undefined" != typeof t ? !!t : !1,
        this.noAssert = !!i
    }
    ;
    o.VERSION = "4.0.0",
    o.LITTLE_ENDIAN = !0,
    o.BIG_ENDIAN = !1,
    o.DEFAULT_CAPACITY = 16,
    o.DEFAULT_ENDIAN = o.BIG_ENDIAN,
    o.DEFAULT_NOASSERT = !1,
    o.Long = e || null ;
    var s = o.prototype;
    s.__isByteBuffer__,
    Object.defineProperty(s, "__isByteBuffer__", {
        value: !0,
        enumerable: !1,
        configurable: !1
    });
    var a = new ArrayBuffer(0)
      , l = String.fromCharCode;
    o.accessor = function() {
        return Uint8Array
    }
    ,
    o.allocate = function(e, t, i) {
        return new o(e,t,i)
    }
    ,
    o.concat = function(e, t, i, r) {
        "boolean" != typeof t && "string" == typeof t || (r = i,
        i = t,
        t = void 0);
        for (var n, s = 0, a = 0, l = e.length; l > a; ++a)
            o.isByteBuffer(e[a]) || (e[a] = o.wrap(e[a], t)),
            n = e[a].limit - e[a].offset,
            n > 0 && (s += n);
        if (0 === s)
            return new o(0,i,r);
        var f, u = new o(s,i,r);
        for (a = 0; l > a; )
            f = e[a++],
            n = f.limit - f.offset,
            0 >= n || (u.view.set(f.view.subarray(f.offset, f.limit), u.offset),
            u.offset += n);
        return u.limit = u.offset,
        u.offset = 0,
        u
    }
    ,
    o.isByteBuffer = function(e) {
        return (e && e.__isByteBuffer__) === !0
    }
    ,
    o.type = function() {
        return ArrayBuffer
    }
    ,
    o.wrap = function(e, t, i, r) {
        if ("string" != typeof t && (r = i,
        i = t,
        t = void 0),
        "string" == typeof e)
            switch ("undefined" == typeof t && (t = "utf8"),
            t) {
            case "base64":
                return o.fromBase64(e, i);
            case "hex":
                return o.fromHex(e, i);
            case "binary":
                return o.fromBinary(e, i);
            case "utf8":
                return o.fromUTF8(e, i);
            case "debug":
                return o.fromDebug(e, i);
            default:
                throw Error("Unsupported encoding: " + t)
            }
        if (null === e || "object" != typeof e)
            throw TypeError("Illegal buffer");
        var n;
        if (o.isByteBuffer(e))
            return n = s.clone.call(e),
            n.markedOffset = -1,
            n;
        if (e instanceof Uint8Array)
            n = new o(0,i,r),
            e.length > 0 && (n.buffer = e.buffer,
            n.offset = e.byteOffset,
            n.limit = e.byteOffset + e.byteLength,
            n.view = new Uint8Array(e.buffer));
        else if (e instanceof ArrayBuffer)
            n = new o(0,i,r),
            e.byteLength > 0 && (n.buffer = e,
            n.offset = 0,
            n.limit = e.byteLength,
            n.view = e.byteLength > 0 ? new Uint8Array(e) : null );
        else {
            if ("[object Array]" !== Object.prototype.toString.call(e))
                throw TypeError("Illegal buffer");
            n = new o(e.length,i,r),
            n.limit = e.length;
            for (var a = 0; a < e.length; ++a)
                n.view[a] = e[a]
        }
        return n
    }
    ,
    s.readBytes = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + e > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+" + e + ") <= " + this.buffer.byteLength)
        }
        var r = this.slice(t, t + e);
        return i && (this.offset += e),
        r
    }
    ,
    s.writeBytes = s.append,
    s.writeInt8 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e |= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 1;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 1,
        this.view[t] = e,
        i && (this.offset += 1),
        this
    }
    ,
    s.writeByte = s.writeInt8,
    s.readInt8 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 1 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+1) <= " + this.buffer.byteLength)
        }
        var i = this.view[e];
        return 128 === (128 & i) && (i = -(255 - i + 1)),
        t && (this.offset += 1),
        i
    }
    ,
    s.readByte = s.readInt8,
    s.writeUint8 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 1;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 1,
        this.view[t] = e,
        i && (this.offset += 1),
        this
    }
    ,
    s.writeUInt8 = s.writeUint8,
    s.readUint8 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 1 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+1) <= " + this.buffer.byteLength)
        }
        var i = this.view[e];
        return t && (this.offset += 1),
        i
    }
    ,
    s.readUInt8 = s.readUint8,
    s.writeInt16 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e |= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 2;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 2,
        this.littleEndian ? (this.view[t + 1] = (65280 & e) >>> 8,
        this.view[t] = 255 & e) : (this.view[t] = (65280 & e) >>> 8,
        this.view[t + 1] = 255 & e),
        i && (this.offset += 2),
        this
    }
    ,
    s.writeShort = s.writeInt16,
    s.readInt16 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 2 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+2) <= " + this.buffer.byteLength)
        }
        var i = 0;
        return this.littleEndian ? (i = this.view[e],
        i |= this.view[e + 1] << 8) : (i = this.view[e] << 8,
        i |= this.view[e + 1]),
        32768 === (32768 & i) && (i = -(65535 - i + 1)),
        t && (this.offset += 2),
        i
    }
    ,
    s.readShort = s.readInt16,
    s.writeUint16 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 2;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 2,
        this.littleEndian ? (this.view[t + 1] = (65280 & e) >>> 8,
        this.view[t] = 255 & e) : (this.view[t] = (65280 & e) >>> 8,
        this.view[t + 1] = 255 & e),
        i && (this.offset += 2),
        this
    }
    ,
    s.writeUInt16 = s.writeUint16,
    s.readUint16 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 2 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+2) <= " + this.buffer.byteLength)
        }
        var i = 0;
        return this.littleEndian ? (i = this.view[e],
        i |= this.view[e + 1] << 8) : (i = this.view[e] << 8,
        i |= this.view[e + 1]),
        t && (this.offset += 2),
        i
    }
    ,
    s.readUInt16 = s.readUint16,
    s.writeInt32 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e |= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 4;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 4,
        this.littleEndian ? (this.view[t + 3] = e >>> 24 & 255,
        this.view[t + 2] = e >>> 16 & 255,
        this.view[t + 1] = e >>> 8 & 255,
        this.view[t] = 255 & e) : (this.view[t] = e >>> 24 & 255,
        this.view[t + 1] = e >>> 16 & 255,
        this.view[t + 2] = e >>> 8 & 255,
        this.view[t + 3] = 255 & e),
        i && (this.offset += 4),
        this
    }
    ,
    s.writeInt = s.writeInt32,
    s.readInt32 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 4 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+4) <= " + this.buffer.byteLength)
        }
        var i = 0;
        return this.littleEndian ? (i = this.view[e + 2] << 16,
        i |= this.view[e + 1] << 8,
        i |= this.view[e],
        i += this.view[e + 3] << 24 >>> 0) : (i = this.view[e + 1] << 16,
        i |= this.view[e + 2] << 8,
        i |= this.view[e + 3],
        i += this.view[e] << 24 >>> 0),
        i |= 0,
        t && (this.offset += 4),
        i
    }
    ,
    s.readInt = s.readInt32,
    s.writeUint32 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 4;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 4,
        this.littleEndian ? (this.view[t + 3] = e >>> 24 & 255,
        this.view[t + 2] = e >>> 16 & 255,
        this.view[t + 1] = e >>> 8 & 255,
        this.view[t] = 255 & e) : (this.view[t] = e >>> 24 & 255,
        this.view[t + 1] = e >>> 16 & 255,
        this.view[t + 2] = e >>> 8 & 255,
        this.view[t + 3] = 255 & e),
        i && (this.offset += 4),
        this
    }
    ,
    s.writeUInt32 = s.writeUint32,
    s.readUint32 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 4 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+4) <= " + this.buffer.byteLength)
        }
        var i = 0;
        return this.littleEndian ? (i = this.view[e + 2] << 16,
        i |= this.view[e + 1] << 8,
        i |= this.view[e],
        i += this.view[e + 3] << 24 >>> 0) : (i = this.view[e + 1] << 16,
        i |= this.view[e + 2] << 8,
        i |= this.view[e + 3],
        i += this.view[e] << 24 >>> 0),
        t && (this.offset += 4),
        i
    }
    ,
    s.readUInt32 = s.readUint32,
    e && (s.writeInt64 = function(t, i) {
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("number" == typeof t)
                t = e.fromNumber(t);
            else if ("string" == typeof t)
                t = e.fromString(t);
            else if (!(t && t instanceof e))
                throw TypeError("Illegal value: " + t + " (not an integer or Long)");
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        "number" == typeof t ? t = e.fromNumber(t) : "string" == typeof t && (t = e.fromString(t)),
        i += 8;
        var n = this.buffer.byteLength;
        i > n && this.resize((n *= 2) > i ? n : i),
        i -= 8;
        var o = t.low
          , s = t.high;
        return this.littleEndian ? (this.view[i + 3] = o >>> 24 & 255,
        this.view[i + 2] = o >>> 16 & 255,
        this.view[i + 1] = o >>> 8 & 255,
        this.view[i] = 255 & o,
        i += 4,
        this.view[i + 3] = s >>> 24 & 255,
        this.view[i + 2] = s >>> 16 & 255,
        this.view[i + 1] = s >>> 8 & 255,
        this.view[i] = 255 & s) : (this.view[i] = s >>> 24 & 255,
        this.view[i + 1] = s >>> 16 & 255,
        this.view[i + 2] = s >>> 8 & 255,
        this.view[i + 3] = 255 & s,
        i += 4,
        this.view[i] = o >>> 24 & 255,
        this.view[i + 1] = o >>> 16 & 255,
        this.view[i + 2] = o >>> 8 & 255,
        this.view[i + 3] = 255 & o),
        r && (this.offset += 8),
        this
    }
    ,
    s.writeLong = s.writeInt64,
    s.readInt64 = function(t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 8 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+8) <= " + this.buffer.byteLength)
        }
        var r = 0
          , n = 0;
        this.littleEndian ? (r = this.view[t + 2] << 16,
        r |= this.view[t + 1] << 8,
        r |= this.view[t],
        r += this.view[t + 3] << 24 >>> 0,
        t += 4,
        n = this.view[t + 2] << 16,
        n |= this.view[t + 1] << 8,
        n |= this.view[t],
        n += this.view[t + 3] << 24 >>> 0) : (n = this.view[t + 1] << 16,
        n |= this.view[t + 2] << 8,
        n |= this.view[t + 3],
        n += this.view[t] << 24 >>> 0,
        t += 4,
        r = this.view[t + 1] << 16,
        r |= this.view[t + 2] << 8,
        r |= this.view[t + 3],
        r += this.view[t] << 24 >>> 0);
        var o = new e(r,n,!1);
        return i && (this.offset += 8),
        o
    }
    ,
    s.readLong = s.readInt64,
    s.writeUint64 = function(t, i) {
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("number" == typeof t)
                t = e.fromNumber(t);
            else if ("string" == typeof t)
                t = e.fromString(t);
            else if (!(t && t instanceof e))
                throw TypeError("Illegal value: " + t + " (not an integer or Long)");
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        "number" == typeof t ? t = e.fromNumber(t) : "string" == typeof t && (t = e.fromString(t)),
        i += 8;
        var n = this.buffer.byteLength;
        i > n && this.resize((n *= 2) > i ? n : i),
        i -= 8;
        var o = t.low
          , s = t.high;
        return this.littleEndian ? (this.view[i + 3] = o >>> 24 & 255,
        this.view[i + 2] = o >>> 16 & 255,
        this.view[i + 1] = o >>> 8 & 255,
        this.view[i] = 255 & o,
        i += 4,
        this.view[i + 3] = s >>> 24 & 255,
        this.view[i + 2] = s >>> 16 & 255,
        this.view[i + 1] = s >>> 8 & 255,
        this.view[i] = 255 & s) : (this.view[i] = s >>> 24 & 255,
        this.view[i + 1] = s >>> 16 & 255,
        this.view[i + 2] = s >>> 8 & 255,
        this.view[i + 3] = 255 & s,
        i += 4,
        this.view[i] = o >>> 24 & 255,
        this.view[i + 1] = o >>> 16 & 255,
        this.view[i + 2] = o >>> 8 & 255,
        this.view[i + 3] = 255 & o),
        r && (this.offset += 8),
        this
    }
    ,
    s.writeUInt64 = s.writeUint64,
    s.readUint64 = function(t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 8 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+8) <= " + this.buffer.byteLength)
        }
        var r = 0
          , n = 0;
        this.littleEndian ? (r = this.view[t + 2] << 16,
        r |= this.view[t + 1] << 8,
        r |= this.view[t],
        r += this.view[t + 3] << 24 >>> 0,
        t += 4,
        n = this.view[t + 2] << 16,
        n |= this.view[t + 1] << 8,
        n |= this.view[t],
        n += this.view[t + 3] << 24 >>> 0) : (n = this.view[t + 1] << 16,
        n |= this.view[t + 2] << 8,
        n |= this.view[t + 3],
        n += this.view[t] << 24 >>> 0,
        t += 4,
        r = this.view[t + 1] << 16,
        r |= this.view[t + 2] << 8,
        r |= this.view[t + 3],
        r += this.view[t] << 24 >>> 0);
        var o = new e(r,n,!0);
        return i && (this.offset += 8),
        o
    }
    ,
    s.readUInt64 = s.readUint64),
    s.writeFloat32 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e)
                throw TypeError("Illegal value: " + e + " (not a number)");
            if ("number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 4;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 4,
        n(this.view, e, t, this.littleEndian, 23, 4),
        i && (this.offset += 4),
        this
    }
    ,
    s.writeFloat = s.writeFloat32,
    s.readFloat32 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 4 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+4) <= " + this.buffer.byteLength)
        }
        var i = r(this.view, e, this.littleEndian, 23, 4);
        return t && (this.offset += 4),
        i
    }
    ,
    s.readFloat = s.readFloat32,
    s.writeFloat64 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e)
                throw TypeError("Illegal value: " + e + " (not a number)");
            if ("number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        t += 8;
        var r = this.buffer.byteLength;
        return t > r && this.resize((r *= 2) > t ? r : t),
        t -= 8,
        n(this.view, e, t, this.littleEndian, 52, 8),
        i && (this.offset += 8),
        this
    }
    ,
    s.writeDouble = s.writeFloat64,
    s.readFloat64 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 8 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+8) <= " + this.buffer.byteLength)
        }
        var i = r(this.view, e, this.littleEndian, 52, 8);
        return t && (this.offset += 8),
        i
    }
    ,
    s.readDouble = s.readFloat64,
    o.MAX_VARINT32_BYTES = 5,
    o.calculateVarint32 = function(e) {
        return e >>>= 0,
        128 > e ? 1 : 16384 > e ? 2 : 1 << 21 > e ? 3 : 1 << 28 > e ? 4 : 5
    }
    ,
    o.zigZagEncode32 = function(e) {
        return ((e |= 0) << 1 ^ e >> 31) >>> 0
    }
    ,
    o.zigZagDecode32 = function(e) {
        return e >>> 1 ^ -(1 & e) | 0
    }
    ,
    s.writeVarint32 = function(e, t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e |= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+0) <= " + this.buffer.byteLength)
        }
        var r, n = o.calculateVarint32(e);
        t += n;
        var s = this.buffer.byteLength;
        for (t > s && this.resize((s *= 2) > t ? s : t),
        t -= n,
        e >>>= 0; e >= 128; )
            r = 127 & e | 128,
            this.view[t++] = r,
            e >>>= 7;
        return this.view[t++] = e,
        i ? (this.offset = t,
        this) : n
    }
    ,
    s.writeVarint32ZigZag = function(e, t) {
        return this.writeVarint32(o.zigZagEncode32(e), t)
    }
    ,
    s.readVarint32 = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 1 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+1) <= " + this.buffer.byteLength)
        }
        var i, r = 0, n = 0;
        do {
            if (!this.noAssert && e > this.limit) {
                var o = Error("Truncated");
                throw o.truncated = !0,
                o
            }
            i = this.view[e++],
            5 > r && (n |= (127 & i) << 7 * r),
            ++r
        } while (0 !== (128 & i));return n |= 0,
        t ? (this.offset = e,
        n) : {
            value: n,
            length: r
        }
    }
    ,
    s.readVarint32ZigZag = function(e) {
        var t = this.readVarint32(e);
        return "object" == typeof t ? t.value = o.zigZagDecode32(t.value) : t = o.zigZagDecode32(t),
        t
    }
    ,
    e && (o.MAX_VARINT64_BYTES = 10,
    o.calculateVarint64 = function(t) {
        "number" == typeof t ? t = e.fromNumber(t) : "string" == typeof t && (t = e.fromString(t));
        var i = t.toInt() >>> 0
          , r = t.shiftRightUnsigned(28).toInt() >>> 0
          , n = t.shiftRightUnsigned(56).toInt() >>> 0;
        return 0 == n ? 0 == r ? 16384 > i ? 128 > i ? 1 : 2 : 1 << 21 > i ? 3 : 4 : 16384 > r ? 128 > r ? 5 : 6 : 1 << 21 > r ? 7 : 8 : 128 > n ? 9 : 10
    }
    ,
    o.zigZagEncode64 = function(t) {
        return "number" == typeof t ? t = e.fromNumber(t, !1) : "string" == typeof t ? t = e.fromString(t, !1) : t.unsigned !== !1 && (t = t.toSigned()),
        t.shiftLeft(1).xor(t.shiftRight(63)).toUnsigned()
    }
    ,
    o.zigZagDecode64 = function(t) {
        return "number" == typeof t ? t = e.fromNumber(t, !1) : "string" == typeof t ? t = e.fromString(t, !1) : t.unsigned !== !1 && (t = t.toSigned()),
        t.shiftRightUnsigned(1).xor(t.and(e.ONE).toSigned().negate()).toSigned()
    }
    ,
    s.writeVarint64 = function(t, i) {
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("number" == typeof t)
                t = e.fromNumber(t);
            else if ("string" == typeof t)
                t = e.fromString(t);
            else if (!(t && t instanceof e))
                throw TypeError("Illegal value: " + t + " (not an integer or Long)");
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        "number" == typeof t ? t = e.fromNumber(t, !1) : "string" == typeof t ? t = e.fromString(t, !1) : t.unsigned !== !1 && (t = t.toSigned());
        var n = o.calculateVarint64(t)
          , s = t.toInt() >>> 0
          , a = t.shiftRightUnsigned(28).toInt() >>> 0
          , l = t.shiftRightUnsigned(56).toInt() >>> 0;
        i += n;
        var f = this.buffer.byteLength;
        switch (i > f && this.resize((f *= 2) > i ? f : i),
        i -= n,
        n) {
        case 10:
            this.view[i + 9] = l >>> 7 & 1;
        case 9:
            this.view[i + 8] = 9 !== n ? 128 | l : 127 & l;
        case 8:
            this.view[i + 7] = 8 !== n ? a >>> 21 | 128 : a >>> 21 & 127;
        case 7:
            this.view[i + 6] = 7 !== n ? a >>> 14 | 128 : a >>> 14 & 127;
        case 6:
            this.view[i + 5] = 6 !== n ? a >>> 7 | 128 : a >>> 7 & 127;
        case 5:
            this.view[i + 4] = 5 !== n ? 128 | a : 127 & a;
        case 4:
            this.view[i + 3] = 4 !== n ? s >>> 21 | 128 : s >>> 21 & 127;
        case 3:
            this.view[i + 2] = 3 !== n ? s >>> 14 | 128 : s >>> 14 & 127;
        case 2:
            this.view[i + 1] = 2 !== n ? s >>> 7 | 128 : s >>> 7 & 127;
        case 1:
            this.view[i] = 1 !== n ? 128 | s : 127 & s
        }
        return r ? (this.offset += n,
        this) : n
    }
    ,
    s.writeVarint64ZigZag = function(e, t) {
        return this.writeVarint64(o.zigZagEncode64(e), t)
    }
    ,
    s.readVarint64 = function(t) {
        var i = "undefined" == typeof t;
        if (i && (t = this.offset),
        !this.noAssert) {
            if ("number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: " + t + " (not an integer)");
            if (t >>>= 0,
            0 > t || t + 1 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + t + " (+1) <= " + this.buffer.byteLength)
        }
        var r = t
          , n = 0
          , o = 0
          , s = 0
          , a = 0;
        if (a = this.view[t++],
        n = 127 & a,
        128 & a && (a = this.view[t++],
        n |= (127 & a) << 7,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        n |= (127 & a) << 14,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        n |= (127 & a) << 21,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        o = 127 & a,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        o |= (127 & a) << 7,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        o |= (127 & a) << 14,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        o |= (127 & a) << 21,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        s = 127 & a,
        (128 & a || this.noAssert && "undefined" == typeof a) && (a = this.view[t++],
        s |= (127 & a) << 7,
        128 & a || this.noAssert && "undefined" == typeof a))))))))))
            throw Error("Buffer overrun");
        var l = e.fromBits(n | o << 28, o >>> 4 | s << 24, !1);
        return i ? (this.offset = t,
        l) : {
            value: l,
            length: t - r
        }
    }
    ,
    s.readVarint64ZigZag = function(t) {
        var i = this.readVarint64(t);
        return i && i.value instanceof e ? i.value = o.zigZagDecode64(i.value) : i = o.zigZagDecode64(i),
        i
    }
    ),
    s.writeCString = function(e, i) {
        var r = "undefined" == typeof i;
        r && (i = this.offset);
        var n, o = e.length;
        if (!this.noAssert) {
            if ("string" != typeof e)
                throw TypeError("Illegal str: Not a string");
            for (n = 0; o > n; ++n)
                if (0 === e.charCodeAt(n))
                    throw RangeError("Illegal str: Contains NULL-characters");
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        o = u.calculateUTF16asUTF8(t(e))[1],
        i += o + 1;
        var s = this.buffer.byteLength;
        return i > s && this.resize((s *= 2) > i ? s : i),
        i -= o + 1,
        u.encodeUTF16toUTF8(t(e), function(e) {
            this.view[i++] = e
        }
        .bind(this)),
        this.view[i++] = 0,
        r ? (this.offset = i,
        this) : o
    }
    ,
    s.readCString = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 1 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+1) <= " + this.buffer.byteLength)
        }
        var r, n = e, o = -1;
        return u.decodeUTF8toUTF16(function() {
            if (0 === o)
                return null ;
            if (e >= this.limit)
                throw RangeError("Illegal range: Truncated data, " + e + " < " + this.limit);
            return o = this.view[e++],
            0 === o ? null : o
        }
        .bind(this), r = i(), !0),
        t ? (this.offset = e,
        r()) : {
            string: r(),
            length: e - n
        }
    }
    ,
    s.writeIString = function(e, i) {
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("string" != typeof e)
                throw TypeError("Illegal str: Not a string");
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        var n, o = i;
        n = u.calculateUTF16asUTF8(t(e), this.noAssert)[1],
        i += 4 + n;
        var s = this.buffer.byteLength;
        if (i > s && this.resize((s *= 2) > i ? s : i),
        i -= 4 + n,
        this.littleEndian ? (this.view[i + 3] = n >>> 24 & 255,
        this.view[i + 2] = n >>> 16 & 255,
        this.view[i + 1] = n >>> 8 & 255,
        this.view[i] = 255 & n) : (this.view[i] = n >>> 24 & 255,
        this.view[i + 1] = n >>> 16 & 255,
        this.view[i + 2] = n >>> 8 & 255,
        this.view[i + 3] = 255 & n),
        i += 4,
        u.encodeUTF16toUTF8(t(e), function(e) {
            this.view[i++] = e
        }
        .bind(this)),
        i !== o + 4 + n)
            throw RangeError("Illegal range: Truncated data, " + i + " == " + (i + 4 + n));
        return r ? (this.offset = i,
        this) : i - o
    }
    ,
    s.readIString = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 4 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+4) <= " + this.buffer.byteLength)
        }
        var r, n = 0, o = e;
        this.littleEndian ? (n = this.view[e + 2] << 16,
        n |= this.view[e + 1] << 8,
        n |= this.view[e],
        n += this.view[e + 3] << 24 >>> 0) : (n = this.view[e + 1] << 16,
        n |= this.view[e + 2] << 8,
        n |= this.view[e + 3],
        n += this.view[e] << 24 >>> 0),
        e += 4;
        var s, a = e + n;
        return u.decodeUTF8toUTF16(function() {
            return a > e ? this.view[e++] : null
        }
        .bind(this), s = i(), this.noAssert),
        r = s(),
        t ? (this.offset = e,
        r) : {
            string: r,
            length: e - o
        }
    }
    ,
    o.METRICS_CHARS = "c",
    o.METRICS_BYTES = "b",
    s.writeUTF8String = function(e, i) {
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        var n, o = i;
        n = u.calculateUTF16asUTF8(t(e))[1],
        i += n;
        var s = this.buffer.byteLength;
        return i > s && this.resize((s *= 2) > i ? s : i),
        i -= n,
        u.encodeUTF16toUTF8(t(e), function(e) {
            this.view[i++] = e
        }
        .bind(this)),
        r ? (this.offset = i,
        this) : i - o
    }
    ,
    s.writeString = s.writeUTF8String,
    o.calculateUTF8Chars = function(e) {
        return u.calculateUTF16asUTF8(t(e))[0]
    }
    ,
    o.calculateUTF8Bytes = function(e) {
        return u.calculateUTF16asUTF8(t(e))[1]
    }
    ,
    o.calculateString = o.calculateUTF8Bytes,
    s.readUTF8String = function(e, t, r) {
        "number" == typeof t && (r = t,
        t = void 0);
        var n = "undefined" == typeof r;
        if (n && (r = this.offset),
        "undefined" == typeof t && (t = o.METRICS_CHARS),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal length: " + e + " (not an integer)");
            if (e |= 0,
            "number" != typeof r || r % 1 !== 0)
                throw TypeError("Illegal offset: " + r + " (not an integer)");
            if (r >>>= 0,
            0 > r || r + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + r + " (+0) <= " + this.buffer.byteLength)
        }
        var s, a = 0, l = r;
        if (t === o.METRICS_CHARS) {
            if (s = i(),
            u.decodeUTF8(function() {
                return e > a && r < this.limit ? this.view[r++] : null
            }
            .bind(this), function(e) {
                ++a,
                u.UTF8toUTF16(e, s)
            }),
            a !== e)
                throw RangeError("Illegal range: Truncated data, " + a + " == " + e);
            return n ? (this.offset = r,
            s()) : {
                string: s(),
                length: r - l
            }
        }
        if (t === o.METRICS_BYTES) {
            if (!this.noAssert) {
                if ("number" != typeof r || r % 1 !== 0)
                    throw TypeError("Illegal offset: " + r + " (not an integer)");
                if (r >>>= 0,
                0 > r || r + e > this.buffer.byteLength)
                    throw RangeError("Illegal offset: 0 <= " + r + " (+" + e + ") <= " + this.buffer.byteLength)
            }
            var f = r + e;
            if (u.decodeUTF8toUTF16(function() {
                return f > r ? this.view[r++] : null
            }
            .bind(this), s = i(), this.noAssert),
            r !== f)
                throw RangeError("Illegal range: Truncated data, " + r + " == " + f);
            return n ? (this.offset = r,
            s()) : {
                string: s(),
                length: r - l
            }
        }
        throw TypeError("Unsupported metrics: " + t)
    }
    ,
    s.readString = s.readUTF8String,
    s.writeVString = function(e, i) {
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("string" != typeof e)
                throw TypeError("Illegal str: Not a string");
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        var n, s, a = i;
        n = u.calculateUTF16asUTF8(t(e), this.noAssert)[1],
        s = o.calculateVarint32(n),
        i += s + n;
        var l = this.buffer.byteLength;
        if (i > l && this.resize((l *= 2) > i ? l : i),
        i -= s + n,
        i += this.writeVarint32(n, i),
        u.encodeUTF16toUTF8(t(e), function(e) {
            this.view[i++] = e
        }
        .bind(this)),
        i !== a + n + s)
            throw RangeError("Illegal range: Truncated data, " + i + " == " + (i + n + s));
        return r ? (this.offset = i,
        this) : i - a
    }
    ,
    s.readVString = function(e) {
        var t = "undefined" == typeof e;
        if (t && (e = this.offset),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 1 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+1) <= " + this.buffer.byteLength)
        }
        var r, n = this.readVarint32(e), o = e;
        e += n.length,
        n = n.value;
        var s = e + n
          , a = i();
        return u.decodeUTF8toUTF16(function() {
            return s > e ? this.view[e++] : null
        }
        .bind(this), a, this.noAssert),
        r = a(),
        t ? (this.offset = e,
        r) : {
            string: r,
            length: e - o
        }
    }
    ,
    s.append = function(e, t, i) {
        "number" != typeof t && "string" == typeof t || (i = t,
        t = void 0);
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        e instanceof o || (e = o.wrap(e, t));
        var n = e.limit - e.offset;
        if (0 >= n)
            return this;
        i += n;
        var s = this.buffer.byteLength;
        return i > s && this.resize((s *= 2) > i ? s : i),
        i -= n,
        this.view.set(e.view.subarray(e.offset, e.limit), i),
        e.offset += n,
        r && (this.offset += n),
        this
    }
    ,
    s.appendTo = function(e, t) {
        return e.append(this, t),
        this
    }
    ,
    s.assert = function(e) {
        return this.noAssert = !e,
        this
    }
    ,
    s.capacity = function() {
        return this.buffer.byteLength
    }
    ,
    s.clear = function() {
        return this.offset = 0,
        this.limit = this.buffer.byteLength,
        this.markedOffset = -1,
        this
    }
    ,
    s.clone = function(e) {
        var t = new o(0,this.littleEndian,this.noAssert);
        return e ? (t.buffer = new ArrayBuffer(this.buffer.byteLength),
        t.view = new Uint8Array(t.buffer)) : (t.buffer = this.buffer,
        t.view = this.view),
        t.offset = this.offset,
        t.markedOffset = this.markedOffset,
        t.limit = this.limit,
        t
    }
    ,
    s.compact = function(e, t) {
        if ("undefined" == typeof e && (e = this.offset),
        "undefined" == typeof t && (t = this.limit),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        if (0 === e && t === this.buffer.byteLength)
            return this;
        var i = t - e;
        if (0 === i)
            return this.buffer = a,
            this.view = null ,
            this.markedOffset >= 0 && (this.markedOffset -= e),
            this.offset = 0,
            this.limit = 0,
            this;
        var r = new ArrayBuffer(i)
          , n = new Uint8Array(r);
        return n.set(this.view.subarray(e, t)),
        this.buffer = r,
        this.view = n,
        this.markedOffset >= 0 && (this.markedOffset -= e),
        this.offset = 0,
        this.limit = i,
        this
    }
    ,
    s.copy = function(e, t) {
        if ("undefined" == typeof e && (e = this.offset),
        "undefined" == typeof t && (t = this.limit),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        if (e === t)
            return new o(0,this.littleEndian,this.noAssert);
        var i = t - e
          , r = new o(i,this.littleEndian,this.noAssert);
        return r.offset = 0,
        r.limit = i,
        r.markedOffset >= 0 && (r.markedOffset -= e),
        this.copyTo(r, 0, e, t),
        r
    }
    ,
    s.copyTo = function(e, t, i, r) {
        var n, s;
        if (!this.noAssert && !o.isByteBuffer(e))
            throw TypeError("Illegal target: Not a ByteBuffer");
        if (t = (s = "undefined" == typeof t) ? e.offset : 0 | t,
        i = (n = "undefined" == typeof i) ? this.offset : 0 | i,
        r = "undefined" == typeof r ? this.limit : 0 | r,
        0 > t || t > e.buffer.byteLength)
            throw RangeError("Illegal target range: 0 <= " + t + " <= " + e.buffer.byteLength);
        if (0 > i || r > this.buffer.byteLength)
            throw RangeError("Illegal source range: 0 <= " + i + " <= " + this.buffer.byteLength);
        var a = r - i;
        return 0 === a ? e : (e.ensureCapacity(t + a),
        e.view.set(this.view.subarray(i, r), t),
        n && (this.offset += a),
        s && (e.offset += a),
        this)
    }
    ,
    s.ensureCapacity = function(e) {
        var t = this.buffer.byteLength;
        return e > t ? this.resize((t *= 2) > e ? t : e) : this
    }
    ,
    s.fill = function(e, t, i) {
        var r = "undefined" == typeof t;
        if (r && (t = this.offset),
        "string" == typeof e && e.length > 0 && (e = e.charCodeAt(0)),
        "undefined" == typeof t && (t = this.offset),
        "undefined" == typeof i && (i = this.limit),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal value: " + e + " (not an integer)");
            if (e |= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (t >>>= 0,
            "number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (i >>>= 0,
            0 > t || t > i || i > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + t + " <= " + i + " <= " + this.buffer.byteLength)
        }
        if (t >= i)
            return this;
        for (; i > t; )
            this.view[t++] = e;
        return r && (this.offset = t),
        this
    }
    ,
    s.flip = function() {
        return this.limit = this.offset,
        this.offset = 0,
        this
    }
    ,
    s.mark = function(e) {
        if (e = "undefined" == typeof e ? this.offset : e,
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal offset: " + e + " (not an integer)");
            if (e >>>= 0,
            0 > e || e + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + e + " (+0) <= " + this.buffer.byteLength)
        }
        return this.markedOffset = e,
        this
    }
    ,
    s.order = function(e) {
        if (!this.noAssert && "boolean" != typeof e)
            throw TypeError("Illegal littleEndian: Not a boolean");
        return this.littleEndian = !!e,
        this
    }
    ,
    s.LE = function(e) {
        return this.littleEndian = "undefined" != typeof e ? !!e : !0,
        this
    }
    ,
    s.BE = function(e) {
        return this.littleEndian = "undefined" != typeof e ? !e : !1,
        this
    }
    ,
    s.prepend = function(e, t, i) {
        "number" != typeof t && "string" == typeof t || (i = t,
        t = void 0);
        var r = "undefined" == typeof i;
        if (r && (i = this.offset),
        !this.noAssert) {
            if ("number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal offset: " + i + " (not an integer)");
            if (i >>>= 0,
            0 > i || i + 0 > this.buffer.byteLength)
                throw RangeError("Illegal offset: 0 <= " + i + " (+0) <= " + this.buffer.byteLength)
        }
        e instanceof o || (e = o.wrap(e, t));
        var n = e.limit - e.offset;
        if (0 >= n)
            return this;
        var s = n - i;
        if (s > 0) {
            var a = new ArrayBuffer(this.buffer.byteLength + s)
              , l = new Uint8Array(a);
            l.set(this.view.subarray(i, this.buffer.byteLength), n),
            this.buffer = a,
            this.view = l,
            this.offset += s,
            this.markedOffset >= 0 && (this.markedOffset += s),
            this.limit += s,
            i += s
        } else {
            new Uint8Array(this.buffer)
        }
        return this.view.set(e.view.subarray(e.offset, e.limit), i - n),
        e.offset = e.limit,
        r && (this.offset -= n),
        this
    }
    ,
    s.prependTo = function(e, t) {
        return e.prepend(this, t),
        this
    }
    ,
    s.printDebug = function(e) {
        "function" != typeof e && (e = console.log.bind(console)),
        e(this.toString() + "\n-------------------------------------------------------------------\n" + this.toDebug(!0))
    }
    ,
    s.remaining = function() {
        return this.limit - this.offset
    }
    ,
    s.reset = function() {
        return this.markedOffset >= 0 ? (this.offset = this.markedOffset,
        this.markedOffset = -1) : this.offset = 0,
        this
    }
    ,
    s.resize = function(e) {
        if (!this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal capacity: " + e + " (not an integer)");
            if (e |= 0,
            0 > e)
                throw RangeError("Illegal capacity: 0 <= " + e)
        }
        if (this.buffer.byteLength < e) {
            var t = new ArrayBuffer(e)
              , i = new Uint8Array(t);
            i.set(this.view),
            this.buffer = t,
            this.view = i
        }
        return this
    }
    ,
    s.reverse = function(e, t) {
        if ("undefined" == typeof e && (e = this.offset),
        "undefined" == typeof t && (t = this.limit),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        return e === t ? this : (Array.prototype.reverse.call(this.view.subarray(e, t)),
        this)
    }
    ,
    s.skip = function(e) {
        if (!this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal length: " + e + " (not an integer)");
            e |= 0
        }
        var t = this.offset + e;
        if (!this.noAssert && (0 > t || t > this.buffer.byteLength))
            throw RangeError("Illegal length: 0 <= " + this.offset + " + " + e + " <= " + this.buffer.byteLength);
        return this.offset = t,
        this
    }
    ,
    s.slice = function(e, t) {
        if ("undefined" == typeof e && (e = this.offset),
        "undefined" == typeof t && (t = this.limit),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        var i = this.clone();
        return i.offset = e,
        i.limit = t,
        i
    }
    ,
    s.toBuffer = function(e) {
        var t = this.offset
          , i = this.limit;
        if (!this.noAssert) {
            if ("number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal offset: Not an integer");
            if (t >>>= 0,
            "number" != typeof i || i % 1 !== 0)
                throw TypeError("Illegal limit: Not an integer");
            if (i >>>= 0,
            0 > t || t > i || i > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + t + " <= " + i + " <= " + this.buffer.byteLength)
        }
        if (!e && 0 === t && i === this.buffer.byteLength)
            return this.buffer;
        if (t === i)
            return a;
        var r = new ArrayBuffer(i - t);
        return new Uint8Array(r).set(new Uint8Array(this.buffer).subarray(t, i), 0),
        r
    }
    ,
    s.toArrayBuffer = s.toBuffer,
    s.toString = function(e, t, i) {
        if ("undefined" == typeof e)
            return "ByteBufferAB(offset=" + this.offset + ",markedOffset=" + this.markedOffset + ",limit=" + this.limit + ",capacity=" + this.capacity() + ")";
        switch ("number" == typeof e && (e = "utf8",
        t = e,
        i = t),
        e) {
        case "utf8":
            return this.toUTF8(t, i);
        case "base64":
            return this.toBase64(t, i);
        case "hex":
            return this.toHex(t, i);
        case "binary":
            return this.toBinary(t, i);
        case "debug":
            return this.toDebug();
        case "columns":
            return this.toColumns();
        default:
            throw Error("Unsupported encoding: " + e)
        }
    }
    ;
    var f = function() {
        for (var e = {}, t = [65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 43, 47], i = [], r = 0, n = t.length; n > r; ++r)
            i[t[r]] = r;
        return e.encode = function(e, i) {
            for (var r, n; null !== (r = e()); )
                i(t[r >> 2 & 63]),
                n = (3 & r) << 4,
                null !== (r = e()) ? (n |= r >> 4 & 15,
                i(t[63 & (n | r >> 4 & 15)]),
                n = (15 & r) << 2,
                null !== (r = e()) ? (i(t[63 & (n | r >> 6 & 3)]),
                i(t[63 & r])) : (i(t[63 & n]),
                i(61))) : (i(t[63 & n]),
                i(61),
                i(61))
        }
        ,
        e.decode = function(e, t) {
            function r(e) {
                throw Error("Illegal character code: " + e)
            }
            for (var n, o, s; null !== (n = e()); )
                if (o = i[n],
                "undefined" == typeof o && r(n),
                null !== (n = e()) && (s = i[n],
                "undefined" == typeof s && r(n),
                t(o << 2 >>> 0 | (48 & s) >> 4),
                null !== (n = e()))) {
                    if (o = i[n],
                    "undefined" == typeof o) {
                        if (61 === n)
                            break;
                        r(n)
                    }
                    if (t((15 & s) << 4 >>> 0 | (60 & o) >> 2),
                    null !== (n = e())) {
                        if (s = i[n],
                        "undefined" == typeof s) {
                            if (61 === n)
                                break;
                            r(n)
                        }
                        t((3 & o) << 6 >>> 0 | s)
                    }
                }
        }
        ,
        e.test = function(e) {
            return /^(?:[A-Za-z0-9+\/]{4})*(?:[A-Za-z0-9+\/]{2}==|[A-Za-z0-9+\/]{3}=)?$/.test(e)
        }
        ,
        e
    }();
    s.toBase64 = function(e, t) {
        if ("undefined" == typeof e && (e = this.offset),
        "undefined" == typeof t && (t = this.limit),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        var r;
        return f.encode(function() {
            return t > e ? this.view[e++] : null
        }
        .bind(this), r = i()),
        r()
    }
    ,
    o.fromBase64 = function(e, i, r) {
        if (!r) {
            if ("string" != typeof e)
                throw TypeError("Illegal str: Not a string");
            if (e.length % 4 !== 0)
                throw TypeError("Illegal str: Length not a multiple of 4")
        }
        var n = new o(e.length / 4 * 3,i,r)
          , s = 0;
        return f.decode(t(e), function(e) {
            n.view[s++] = e
        }),
        n.limit = s,
        n
    }
    ,
    o.btoa = function(e) {
        return o.fromBinary(e).toBase64()
    }
    ,
    o.atob = function(e) {
        return o.fromBase64(e).toBinary()
    }
    ,
    s.toBinary = function(e, t) {
        if (e = "undefined" == typeof e ? this.offset : e,
        t = "undefined" == typeof t ? this.limit : t,
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        if (e === t)
            return "";
        for (var i = [], r = []; t > e; )
            i.push(this.view[e++]),
            i.length >= 1024 && (r.push(String.fromCharCode.apply(String, i)),
            i = []);
        return r.join("") + String.fromCharCode.apply(String, i)
    }
    ,
    o.fromBinary = function(e, t, i) {
        if (!i && "string" != typeof e)
            throw TypeError("Illegal str: Not a string");
        for (var r, n = 0, s = e.length, a = new o(s,t,i); s > n; ) {
            if (r = e.charCodeAt(n),
            !i && r > 255)
                throw RangeError("Illegal charCode at " + n + ": 0 <= " + r + " <= 255");
            a.view[n++] = r
        }
        return a.limit = s,
        a
    }
    ,
    s.toDebug = function(e) {
        for (var t, i = -1, r = this.buffer.byteLength, n = "", o = "", s = ""; r > i; ) {
            if (-1 !== i && (t = this.view[i],
            n += 16 > t ? "0" + t.toString(16).toUpperCase() : t.toString(16).toUpperCase(),
            e && (o += t > 32 && 127 > t ? String.fromCharCode(t) : ".")),
            ++i,
            e && i > 0 && i % 16 === 0 && i !== r) {
                for (; n.length < 51; )
                    n += " ";
                s += n + o + "\n",
                n = o = ""
            }
            n += i === this.offset && i === this.limit ? i === this.markedOffset ? "!" : "|" : i === this.offset ? i === this.markedOffset ? "[" : "<" : i === this.limit ? i === this.markedOffset ? "]" : ">" : i === this.markedOffset ? "'" : e || 0 !== i && i !== r ? " " : ""
        }
        if (e && " " !== n) {
            for (; n.length < 51; )
                n += " ";
            s += n + o + "\n"
        }
        return e ? s : n
    }
    ,
    o.fromDebug = function(e, t, i) {
        for (var r, n, s = e.length, a = new o((s + 1) / 3 | 0,t,i), l = 0, f = 0, u = !1, h = !1, p = !1, d = !1, c = !1; s > l; ) {
            switch (r = e.charAt(l++)) {
            case "!":
                if (!i) {
                    if (h || p || d) {
                        c = !0;
                        break
                    }
                    h = p = d = !0
                }
                a.offset = a.markedOffset = a.limit = f,
                u = !1;
                break;
            case "|":
                if (!i) {
                    if (h || d) {
                        c = !0;
                        break
                    }
                    h = d = !0
                }
                a.offset = a.limit = f,
                u = !1;
                break;
            case "[":
                if (!i) {
                    if (h || p) {
                        c = !0;
                        break
                    }
                    h = p = !0
                }
                a.offset = a.markedOffset = f,
                u = !1;
                break;
            case "<":
                if (!i) {
                    if (h) {
                        c = !0;
                        break
                    }
                    h = !0
                }
                a.offset = f,
                u = !1;
                break;
            case "]":
                if (!i) {
                    if (d || p) {
                        c = !0;
                        break
                    }
                    d = p = !0
                }
                a.limit = a.markedOffset = f,
                u = !1;
                break;
            case ">":
                if (!i) {
                    if (d) {
                        c = !0;
                        break
                    }
                    d = !0
                }
                a.limit = f,
                u = !1;
                break;
            case "'":
                if (!i) {
                    if (p) {
                        c = !0;
                        break
                    }
                    p = !0
                }
                a.markedOffset = f,
                u = !1;
                break;
            case " ":
                u = !1;
                break;
            default:
                if (!i && u) {
                    c = !0;
                    break
                }
                if (n = parseInt(r + e.charAt(l++), 16),
                !i && (isNaN(n) || 0 > n || n > 255))
                    throw TypeError("Illegal str: Not a debug encoded string");
                a.view[f++] = n,
                u = !0
            }
            if (c)
                throw TypeError("Illegal str: Invalid symbol at " + l)
        }
        if (!i) {
            if (!h || !d)
                throw TypeError("Illegal str: Missing offset or limit");
            if (f < a.buffer.byteLength)
                throw TypeError("Illegal str: Not a debug encoded string (is it hex?) " + f + " < " + s)
        }
        return a
    }
    ,
    s.toHex = function(e, t) {
        if (e = "undefined" == typeof e ? this.offset : e,
        t = "undefined" == typeof t ? this.limit : t,
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        for (var i, r = new Array(t - e); t > e; )
            i = this.view[e++],
            16 > i ? r.push("0", i.toString(16)) : r.push(i.toString(16));
        return r.join("")
    }
    ,
    o.fromHex = function(e, t, i) {
        if (!i) {
            if ("string" != typeof e)
                throw TypeError("Illegal str: Not a string");
            if (e.length % 2 !== 0)
                throw TypeError("Illegal str: Length not a multiple of 2")
        }
        for (var r, n = e.length, s = new o(n / 2 | 0,t), a = 0, l = 0; n > a; a += 2) {
            if (r = parseInt(e.substring(a, a + 2), 16),
            !i && (!isFinite(r) || 0 > r || r > 255))
                throw TypeError("Illegal str: Contains non-hex characters");
            s.view[l++] = r
        }
        return s.limit = l,
        s
    }
    ;
    var u = function() {
        var e = {};
        return e.MAX_CODEPOINT = 1114111,
        e.encodeUTF8 = function(e, t) {
            var i = null ;
            for ("number" == typeof e && (i = e,
            e = function() {
                return null
            }
            ); null !== i || null !== (i = e()); )
                128 > i ? t(127 & i) : 2048 > i ? (t(i >> 6 & 31 | 192),
                t(63 & i | 128)) : 65536 > i ? (t(i >> 12 & 15 | 224),
                t(i >> 6 & 63 | 128),
                t(63 & i | 128)) : (t(i >> 18 & 7 | 240),
                t(i >> 12 & 63 | 128),
                t(i >> 6 & 63 | 128),
                t(63 & i | 128)),
                i = null
        }
        ,
        e.decodeUTF8 = function(e, t) {
            for (var i, r, n, o, s = function(e) {
                e = e.slice(0, e.indexOf(null ));
                var t = Error(e.toString());
                throw t.name = "TruncatedError",
                t.bytes = e,
                t
            }
            ; null !== (i = e()); )
                if (0 === (128 & i))
                    t(i);
                else if (192 === (224 & i))
                    null === (r = e()) && s([i, r]),
                    t((31 & i) << 6 | 63 & r);
                else if (224 === (240 & i))
                    (null === (r = e()) || null === (n = e())) && s([i, r, n]),
                    t((15 & i) << 12 | (63 & r) << 6 | 63 & n);
                else {
                    if (240 !== (248 & i))
                        throw RangeError("Illegal starting byte: " + i);
                    (null === (r = e()) || null === (n = e()) || null === (o = e())) && s([i, r, n, o]),
                    t((7 & i) << 18 | (63 & r) << 12 | (63 & n) << 6 | 63 & o)
                }
        }
        ,
        e.UTF16toUTF8 = function(e, t) {
            for (var i, r = null ; ; ) {
                if (null === (i = null !== r ? r : e()))
                    break;
                i >= 55296 && 57343 >= i && null !== (r = e()) && r >= 56320 && 57343 >= r ? (t(1024 * (i - 55296) + r - 56320 + 65536),
                r = null ) : t(i)
            }
            null !== r && t(r)
        }
        ,
        e.UTF8toUTF16 = function(e, t) {
            var i = null ;
            for ("number" == typeof e && (i = e,
            e = function() {
                return null
            }
            ); null !== i || null !== (i = e()); )
                65535 >= i ? t(i) : (i -= 65536,
                t((i >> 10) + 55296),
                t(i % 1024 + 56320)),
                i = null
        }
        ,
        e.encodeUTF16toUTF8 = function(t, i) {
            e.UTF16toUTF8(t, function(t) {
                e.encodeUTF8(t, i)
            })
        }
        ,
        e.decodeUTF8toUTF16 = function(t, i) {
            e.decodeUTF8(t, function(t) {
                e.UTF8toUTF16(t, i)
            })
        }
        ,
        e.calculateCodePoint = function(e) {
            return 128 > e ? 1 : 2048 > e ? 2 : 65536 > e ? 3 : 4
        }
        ,
        e.calculateUTF8 = function(e) {
            for (var t, i = 0; null !== (t = e()); )
                i += 128 > t ? 1 : 2048 > t ? 2 : 65536 > t ? 3 : 4;
            return i
        }
        ,
        e.calculateUTF16asUTF8 = function(t) {
            var i = 0
              , r = 0;
            return e.UTF16toUTF8(t, function(e) {
                ++i,
                r += 128 > e ? 1 : 2048 > e ? 2 : 65536 > e ? 3 : 4
            }),
            [i, r]
        }
        ,
        e
    }();
    return s.toUTF8 = function(e, t) {
        if ("undefined" == typeof e && (e = this.offset),
        "undefined" == typeof t && (t = this.limit),
        !this.noAssert) {
            if ("number" != typeof e || e % 1 !== 0)
                throw TypeError("Illegal begin: Not an integer");
            if (e >>>= 0,
            "number" != typeof t || t % 1 !== 0)
                throw TypeError("Illegal end: Not an integer");
            if (t >>>= 0,
            0 > e || e > t || t > this.buffer.byteLength)
                throw RangeError("Illegal range: 0 <= " + e + " <= " + t + " <= " + this.buffer.byteLength)
        }
        var r;
        try {
            u.decodeUTF8toUTF16(function() {
                return t > e ? this.view[e++] : null
            }
            .bind(this), r = i())
        } catch (n) {
            if (e !== t)
                throw RangeError("Illegal range: Truncated data, " + e + " != " + t)
        }
        return r()
    }
    ,
    o.fromUTF8 = function(e, i, r) {
        if (!r && "string" != typeof e)
            throw TypeError("Illegal str: Not a string");
        var n = new o(u.calculateUTF16asUTF8(t(e), !0)[1],i,r)
          , s = 0;
        return u.encodeUTF16toUTF8(t(e), function(e) {
            n.view[s++] = e
        }),
        n.limit = s,
        n
    }
    ,
    o
}),
function(e, t) {
    "function" == typeof define && define.amd ? define(["ByteBuffer"], t) : "function" == typeof require && "object" == typeof module && module && module.exports ? module.exports = t(require("bytebuffer")) : (e.dcodeIO = e.dcodeIO || {}).ProtoBuf = t(e.dcodeIO.ByteBuffer)
}(this, function(e) {
    "use strict";
    var t = {};
    return t.ByteBuffer = e,
    t.Long = e.Long || null ,
    t.VERSION = "4.0.0",
    t.WIRE_TYPES = {},
    t.WIRE_TYPES.VARINT = 0,
    t.WIRE_TYPES.BITS64 = 1,
    t.WIRE_TYPES.LDELIM = 2,
    t.WIRE_TYPES.STARTGROUP = 3,
    t.WIRE_TYPES.ENDGROUP = 4,
    t.WIRE_TYPES.BITS32 = 5,
    t.PACKABLE_WIRE_TYPES = [t.WIRE_TYPES.VARINT, t.WIRE_TYPES.BITS64, t.WIRE_TYPES.BITS32],
    t.TYPES = {
        int32: {
            name: "int32",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: 0
        },
        uint32: {
            name: "uint32",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: 0
        },
        sint32: {
            name: "sint32",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: 0
        },
        int64: {
            name: "int64",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: t.Long ? t.Long.ZERO : void 0
        },
        uint64: {
            name: "uint64",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: t.Long ? t.Long.UZERO : void 0
        },
        sint64: {
            name: "sint64",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: t.Long ? t.Long.ZERO : void 0
        },
        bool: {
            name: "bool",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: !1
        },
        "double": {
            name: "double",
            wireType: t.WIRE_TYPES.BITS64,
            defaultValue: 0
        },
        string: {
            name: "string",
            wireType: t.WIRE_TYPES.LDELIM,
            defaultValue: ""
        },
        bytes: {
            name: "bytes",
            wireType: t.WIRE_TYPES.LDELIM,
            defaultValue: null
        },
        fixed32: {
            name: "fixed32",
            wireType: t.WIRE_TYPES.BITS32,
            defaultValue: 0
        },
        sfixed32: {
            name: "sfixed32",
            wireType: t.WIRE_TYPES.BITS32,
            defaultValue: 0
        },
        fixed64: {
            name: "fixed64",
            wireType: t.WIRE_TYPES.BITS64,
            defaultValue: t.Long ? t.Long.UZERO : void 0
        },
        sfixed64: {
            name: "sfixed64",
            wireType: t.WIRE_TYPES.BITS64,
            defaultValue: t.Long ? t.Long.ZERO : void 0
        },
        "float": {
            name: "float",
            wireType: t.WIRE_TYPES.BITS32,
            defaultValue: 0
        },
        "enum": {
            name: "enum",
            wireType: t.WIRE_TYPES.VARINT,
            defaultValue: 0
        },
        message: {
            name: "message",
            wireType: t.WIRE_TYPES.LDELIM,
            defaultValue: null
        },
        group: {
            name: "group",
            wireType: t.WIRE_TYPES.STARTGROUP,
            defaultValue: null
        }
    },
    t.MAP_KEY_TYPES = [t.TYPES.int32, t.TYPES.sint32, t.TYPES.sfixed32, t.TYPES.uint32, t.TYPES.fixed32, t.TYPES.int64, t.TYPES.sint64, t.TYPES.sfixed64, t.TYPES.uint64, t.TYPES.fixed64, t.TYPES.bool, t.TYPES.string, t.TYPES.bytes],
    t.ID_MIN = 1,
    t.ID_MAX = 536870911,
    t.convertFieldsToCamelCase = !1,
    t.populateAccessors = !0,
    t.populateDefaults = !0,
    t.Util = function() {
        var e = {};
        return e.IS_NODE = !("object" != typeof process || process + "" != "[object process]"),
        e.XHR = function() {
            for (var e = [function() {
                return new XMLHttpRequest
            }
            , function() {
                return new ActiveXObject("Msxml2.XMLHTTP")
            }
            , function() {
                return new ActiveXObject("Msxml3.XMLHTTP")
            }
            , function() {
                return new ActiveXObject("Microsoft.XMLHTTP")
            }
            ], t = null , i = 0; i < e.length; i++) {
                try {
                    t = e[i]()
                } catch (r) {
                    continue
                }
                break
            }
            if (!t)
                throw Error("XMLHttpRequest is not supported");
            return t
        }
        ,
        e.fetch = function(t, i) {
            if (i && "function" != typeof i && (i = null ),
            e.IS_NODE)
                if (i)
                    require("fs").readFile(t, function(e, t) {
                        i(e ? null : "" + t)
                    });
                else
                    try {
                        return require("fs").readFileSync(t)
                    } catch (r) {
                        return null
                    }
            else {
                var n = e.XHR();
                if (n.open("GET", t, !!i),
                n.setRequestHeader("Accept", "text/plain"),
                "function" == typeof n.overrideMimeType && n.overrideMimeType("text/plain"),
                !i)
                    return n.send(null ),
                    200 == n.status || 0 == n.status && "string" == typeof n.responseText ? n.responseText : null ;
                if (n.onreadystatechange = function() {
                    4 == n.readyState && i(200 == n.status || 0 == n.status && "string" == typeof n.responseText ? n.responseText : null )
                }
                ,
                4 == n.readyState)
                    return;
                n.send(null )
            }
        }
        ,
        e.toCamelCase = function(e) {
            return e.replace(/_([a-zA-Z])/g, function(e, t) {
                return t.toUpperCase()
            })
        }
        ,
        e
    }(),
    t.Lang = {
        OPEN: "{",
        CLOSE: "}",
        OPTOPEN: "[",
        OPTCLOSE: "]",
        OPTEND: ",",
        EQUAL: "=",
        END: ";",
        COMMA: ",",
        STRINGOPEN: '"',
        STRINGCLOSE: '"',
        STRINGOPEN_SQ: "'",
        STRINGCLOSE_SQ: "'",
        COPTOPEN: "(",
        COPTCLOSE: ")",
        LT: "<",
        GT: ">",
        DELIM: /[\s\{\}=;\[\],'"\(\)<>]/g,
        RULE: /^(?:required|optional|repeated|map)$/,
        TYPE: /^(?:double|float|int32|uint32|sint32|int64|uint64|sint64|fixed32|sfixed32|fixed64|sfixed64|bool|string|bytes)$/,
        NAME: /^[a-zA-Z_][a-zA-Z_0-9]*$/,
        TYPEDEF: /^[a-zA-Z][a-zA-Z_0-9]*$/,
        TYPEREF: /^(?:\.?[a-zA-Z_][a-zA-Z_0-9]*)+$/,
        FQTYPEREF: /^(?:\.[a-zA-Z][a-zA-Z_0-9]*)+$/,
        NUMBER: /^-?(?:[1-9][0-9]*|0|0[xX][0-9a-fA-F]+|0[0-7]+|([0-9]*(\.[0-9]*)?([Ee][+-]?[0-9]+)?)|inf|nan)$/,
        NUMBER_DEC: /^(?:[1-9][0-9]*|0)$/,
        NUMBER_HEX: /^0[xX][0-9a-fA-F]+$/,
        NUMBER_OCT: /^0[0-7]+$/,
        NUMBER_FLT: /^([0-9]*(\.[0-9]*)?([Ee][+-]?[0-9]+)?|inf|nan)$/,
        ID: /^(?:[1-9][0-9]*|0|0[xX][0-9a-fA-F]+|0[0-7]+)$/,
        NEGID: /^\-?(?:[1-9][0-9]*|0|0[xX][0-9a-fA-F]+|0[0-7]+)$/,
        WHITESPACE: /\s/,
        STRING: /(?:"([^"\\]*(?:\\.[^"\\]*)*)")|(?:'([^'\\]*(?:\\.[^'\\]*)*)')/g,
        BOOL: /^(?:true|false)$/i
    },
    t.DotProto = function(e, t) {
        var i = {}
          , r = function(e) {
            this.source = "" + e,
            this.index = 0,
            this.line = 1,
            this.stack = [],
            this.readingString = !1,
            this.stringEndsWith = t.STRINGCLOSE
        }
          , n = r.prototype;
        n._readString = function() {
            t.STRING.lastIndex = this.index - 1;
            var e;
            if (null !== (e = t.STRING.exec(this.source))) {
                var i = "undefined" != typeof e[1] ? e[1] : e[2];
                return this.index = t.STRING.lastIndex,
                this.stack.push(this.stringEndsWith),
                i
            }
            throw Error("Unterminated string at line " + this.line + ", index " + this.index)
        }
        ,
        n.next = function() {
            if (this.stack.length > 0)
                return this.stack.shift();
            if (this.index >= this.source.length)
                return null ;
            if (this.readingString)
                return this.readingString = !1,
                this._readString();
            var e, i;
            do {
                for (e = !1; t.WHITESPACE.test(i = this.source.charAt(this.index)); )
                    if (this.index++,
                    "\n" === i && this.line++,
                    this.index === this.source.length)
                        return null ;
                if ("/" === this.source.charAt(this.index))
                    if ("/" === this.source.charAt(++this.index)) {
                        for (; "\n" !== this.source.charAt(this.index); )
                            if (this.index++,
                            this.index == this.source.length)
                                return null ;
                        this.index++,
                        this.line++,
                        e = !0
                    } else {
                        if ("*" !== this.source.charAt(this.index))
                            throw Error("Unterminated comment at line " + this.line + ": /" + this.source.charAt(this.index));
                        for (i = ""; i + (i = this.source.charAt(this.index)) !== "*/"; )
                            if (this.index++,
                            "\n" === i && this.line++,
                            this.index === this.source.length)
                                return null ;
                        this.index++,
                        e = !0
                    }
            } while (e);if (this.index === this.source.length)
                return null ;
            var r = this.index;
            t.DELIM.lastIndex = 0;
            var n = t.DELIM.test(this.source.charAt(r));
            if (n)
                ++r;
            else
                for (++r; r < this.source.length && !t.DELIM.test(this.source.charAt(r)); )
                    r++;
            var o = this.source.substring(this.index, this.index = r);
            return o === t.STRINGOPEN ? (this.readingString = !0,
            this.stringEndsWith = t.STRINGCLOSE) : o === t.STRINGOPEN_SQ && (this.readingString = !0,
            this.stringEndsWith = t.STRINGCLOSE_SQ),
            o
        }
        ,
        n.peek = function() {
            if (0 === this.stack.length) {
                var e = this.next();
                if (null === e)
                    return null ;
                this.stack.push(e)
            }
            return this.stack[0]
        }
        ,
        n.toString = function() {
            return "Tokenizer(" + this.index + "/" + this.source.length + " at line " + this.line + ")"
        }
        ,
        i.Tokenizer = r;
        var o = function(e) {
            this.tn = new r(e)
        }
          , s = o.prototype;
        return s.parse = function() {
            for (var e, t = {
                name: "[ROOT]",
                "package": null ,
                messages: [],
                enums: [],
                imports: [],
                options: {},
                services: []
            }, i = !0; e = this.tn.next(); )
                switch (e) {
                case "package":
                    if (!i || null !== t["package"])
                        throw Error("Unexpected package at line " + this.tn.line);
                    t["package"] = this._parsePackage(e);
                    break;
                case "import":
                    if (!i)
                        throw Error("Unexpected import at line " + this.tn.line);
                    t.imports.push(this._parseImport(e));
                    break;
                case "message":
                    this._parseMessage(t, null , e),
                    i = !1;
                    break;
                case "enum":
                    this._parseEnum(t, e),
                    i = !1;
                    break;
                case "option":
                    this._parseOption(t, e);
                    break;
                case "service":
                    this._parseService(t, e);
                    break;
                case "extend":
                    this._parseExtend(t, e);
                    break;
                case "syntax":
                    t.syntax = this._parseSyntax(t);
                    break;
                default:
                    throw Error("Unexpected token at line " + this.tn.line + ": " + e)
                }
            return delete t.name,
            t
        }
        ,
        s._parseNumber = function(e) {
            var i = 1;
            if ("-" == e.charAt(0) && (i = -1,
            e = e.substring(1)),
            t.NUMBER_DEC.test(e))
                return i * parseInt(e, 10);
            if (t.NUMBER_HEX.test(e))
                return i * parseInt(e.substring(2), 16);
            if (t.NUMBER_OCT.test(e))
                return i * parseInt(e.substring(1), 8);
            if (t.NUMBER_FLT.test(e))
                return "inf" === e ? i * (1 / 0) : "nan" === e ? NaN : i * parseFloat(e);
            throw Error("Illegal number at line " + this.tn.line + ": " + (0 > i ? "-" : "") + e)
        }
        ,
        s._parseString = function() {
            var e, i, r = "";
            do {
                if (i = this.tn.next(),
                r += this.tn.next(),
                e = this.tn.next(),
                e !== i)
                    throw Error("Illegal end of string at line " + this.tn.line + ": " + e);
                e = this.tn.peek()
            } while (e === t.STRINGOPEN || e === t.STRINGOPEN_SQ);return r
        }
        ,
        s._parseId = function(e, i) {
            var r = -1
              , n = 1;
            if ("-" == e.charAt(0) && (n = -1,
            e = e.substring(1)),
            t.NUMBER_DEC.test(e))
                r = parseInt(e);
            else if (t.NUMBER_HEX.test(e))
                r = parseInt(e.substring(2), 16);
            else {
                if (!t.NUMBER_OCT.test(e))
                    throw Error("Illegal id at line " + this.tn.line + ": " + (0 > n ? "-" : "") + e);
                r = parseInt(e.substring(1), 8)
            }
            if (r = n * r | 0,
            !i && 0 > r)
                throw Error("Illegal id at line " + this.tn.line + ": " + (0 > n ? "-" : "") + e);
            return r
        }
        ,
        s._parsePackage = function(e) {
            if (e = this.tn.next(),
            !t.TYPEREF.test(e))
                throw Error("Illegal package name at line " + this.tn.line + ": " + e);
            var i = e;
            if (e = this.tn.next(),
            e != t.END)
                throw Error("Illegal end of package at line " + this.tn.line + ": " + e);
            return i
        }
        ,
        s._parseImport = function(e) {
            if (e = this.tn.peek(),
            "public" === e && (this.tn.next(),
            e = this.tn.peek()),
            e !== t.STRINGOPEN && e !== t.STRINGOPEN_SQ)
                throw Error("Illegal start of import at line " + this.tn.line + ": " + e);
            var i = this._parseString();
            if (e = this.tn.next(),
            e !== t.END)
                throw Error("Illegal end of import at line " + this.tn.line + ": " + e);
            return i
        }
        ,
        s._parseOption = function(e, i) {
            i = this.tn.next();
            var r = !1;
            if (i == t.COPTOPEN && (r = !0,
            i = this.tn.next()),
            !t.TYPEREF.test(i) && !/google\.protobuf\./.test(i))
                throw Error("Illegal option name in message " + e.name + " at line " + this.tn.line + ": " + i);
            var n = i;
            if (i = this.tn.next(),
            r) {
                if (i !== t.COPTCLOSE)
                    throw Error("Illegal end in message " + e.name + ", option " + n + " at line " + this.tn.line + ": " + i);
                n = "(" + n + ")",
                i = this.tn.next(),
                t.FQTYPEREF.test(i) && (n += i,
                i = this.tn.next())
            }
            if (i !== t.EQUAL)
                throw Error("Illegal operator in message " + e.name + ", option " + n + " at line " + this.tn.line + ": " + i);
            var o;
            if (i = this.tn.peek(),
            i === t.STRINGOPEN || i === t.STRINGOPEN_SQ)
                o = this._parseString();
            else if (this.tn.next(),
            t.NUMBER.test(i))
                o = this._parseNumber(i, !0);
            else if (t.BOOL.test(i))
                o = "true" === i;
            else {
                if (!t.TYPEREF.test(i))
                    throw Error("Illegal option value in message " + e.name + ", option " + n + " at line " + this.tn.line + ": " + i);
                o = i
            }
            if (i = this.tn.next(),
            i !== t.END)
                throw Error("Illegal end of option in message " + e.name + ", option " + n + " at line " + this.tn.line + ": " + i);
            e.options[n] = o
        }
        ,
        s._parseIgnoredStatement = function(e, i) {
            for (var r; ; ) {
                if (r = this.tn.next(),
                null === r)
                    throw Error("Unexpected EOF in " + e.name + ", " + i + " at line " + this.tn.line);
                if (r === t.END)
                    break
            }
        }
        ,
        s._parseService = function(e, i) {
            if (i = this.tn.next(),
            !t.NAME.test(i))
                throw Error("Illegal service name at line " + this.tn.line + ": " + i);
            var r = i
              , n = {
                name: r,
                rpc: {},
                options: {}
            };
            if (i = this.tn.next(),
            i !== t.OPEN)
                throw Error("Illegal start of service " + r + " at line " + this.tn.line + ": " + i);
            do
                if (i = this.tn.next(),
                "option" === i)
                    this._parseOption(n, i);
                else if ("rpc" === i)
                    this._parseServiceRPC(n, i);
                else if (i !== t.CLOSE)
                    throw Error("Illegal type of service " + r + " at line " + this.tn.line + ": " + i);
            while (i !== t.CLOSE);e.services.push(n)
        }
        ,
        s._parseServiceRPC = function(e, i) {
            var r = i;
            if (i = this.tn.next(),
            !t.NAME.test(i))
                throw Error("Illegal method name in service " + e.name + " at line " + this.tn.line + ": " + i);
            var n = i
              , o = {
                request: null ,
                response: null ,
                request_stream: !1,
                response_stream: !1,
                options: {}
            };
            if (i = this.tn.next(),
            i !== t.COPTOPEN)
                throw Error("Illegal start of request type in service " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
            if (i = this.tn.next(),
            "stream" === i.toLowerCase() && (o.request_stream = !0,
            i = this.tn.next()),
            !t.TYPEREF.test(i))
                throw Error("Illegal request type in service " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
            if (o.request = i,
            i = this.tn.next(),
            i != t.COPTCLOSE)
                throw Error("Illegal end of request type in service " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
            if (i = this.tn.next(),
            "returns" !== i.toLowerCase())
                throw Error("Illegal delimiter in service " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
            if (i = this.tn.next(),
            i != t.COPTOPEN)
                throw Error("Illegal start of response type in service " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
            if (i = this.tn.next(),
            "stream" === i.toLowerCase() && (o.response_stream = !0,
            i = this.tn.next()),
            o.response = i,
            i = this.tn.next(),
            i !== t.COPTCLOSE)
                throw Error("Illegal end of response type in service " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
            if (i = this.tn.next(),
            i === t.OPEN) {
                do
                    if (i = this.tn.next(),
                    "option" === i)
                        this._parseOption(o, i);
                    else if (i !== t.CLOSE)
                        throw Error("Illegal start of option inservice " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
                while (i !== t.CLOSE);this.tn.peek() === t.END && this.tn.next()
            } else if (i !== t.END)
                throw Error("Illegal delimiter in service " + e.name + "#" + n + " at line " + this.tn.line + ": " + i);
            "undefined" == typeof e[r] && (e[r] = {}),
            e[r][n] = o
        }
        ,
        s._parseMessage = function(e, i, r) {
            var n = {}
              , o = "group" === r;
            if (r = this.tn.next(),
            !t.NAME.test(r))
                throw Error("Illegal " + (o ? "group" : "message") + " name" + (e ? " in message " + e.name : "") + " at line " + this.tn.line + ": " + r);
            if (n.name = r,
            o) {
                if (r = this.tn.next(),
                r !== t.EQUAL)
                    throw Error("Illegal id assignment after group " + n.name + " at line " + this.tn.line + ": " + r);
                r = this.tn.next();
                try {
                    i.id = this._parseId(r)
                } catch (s) {
                    throw Error("Illegal field id value for group " + n.name + "#" + i.name + " at line " + this.tn.line + ": " + r)
                }
                n.isGroup = !0
            }
            if (n.fields = [],
            n.enums = [],
            n.messages = [],
            n.options = {},
            n.oneofs = {},
            r = this.tn.next(),
            r === t.OPTOPEN && i && (this._parseFieldOptions(n, i, r),
            r = this.tn.next()),
            r !== t.OPEN)
                throw Error("Illegal start of " + (o ? "group" : "message") + " " + n.name + " at line " + this.tn.line + ": " + r);
            for (; ; ) {
                if (r = this.tn.next(),
                r === t.CLOSE) {
                    r = this.tn.peek(),
                    r === t.END && this.tn.next();
                    break
                }
                if (t.RULE.test(r))
                    this._parseMessageField(n, r);
                else if ("oneof" === r)
                    this._parseMessageOneOf(n, r);
                else if ("enum" === r)
                    this._parseEnum(n, r);
                else if ("message" === r)
                    this._parseMessage(n, null , r);
                else if ("option" === r)
                    this._parseOption(n, r);
                else if ("extensions" === r)
                    n.extensions = this._parseExtensions(n, r);
                else if ("extend" === r)
                    this._parseExtend(n, r);
                else {
                    if (!t.TYPEREF.test(r))
                        throw Error("Illegal token in message " + n.name + " at line " + this.tn.line + ": " + r);
                    this._parseMessageField(n, "optional", r)
                }
            }
            return e.messages.push(n),
            n
        }
        ,
        s._parseMessageField = function(e, i, r) {
            var n = {}
              , o = null ;
            if (n.rule = i,
            n.options = {},
            i = "undefined" != typeof r ? r : this.tn.next(),
            "map" === n.rule) {
                if (i !== t.LT)
                    throw Error("Illegal token in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (i = this.tn.next(),
                !t.TYPE.test(i) && !t.TYPEREF.test(i))
                    throw Error("Illegal token in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (n.keytype = i,
                i = this.tn.next(),
                i !== t.COMMA)
                    throw Error("Illegal token in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (i = this.tn.next(),
                !t.TYPE.test(i) && !t.TYPEREF.test(i))
                    throw Error("Illegal token in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (n.type = i,
                i = this.tn.next(),
                i !== t.GT)
                    throw Error("Illegal token in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (i = this.tn.next(),
                !t.NAME.test(i))
                    throw Error("Illegal token in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (n.name = i,
                i = this.tn.next(),
                i !== t.EQUAL)
                    throw Error("Illegal token in field " + e.name + "#" + n.name + " at line " + this.line + ": " + i);
                i = this.tn.next();
                try {
                    n.id = this._parseId(i)
                } catch (s) {
                    throw Error("Illegal field id in message " + e.name + "#" + n.name + " at line " + this.tn.line + ": " + i)
                }
                if (i = this.tn.next(),
                i === t.OPTOPEN && (this._parseFieldOptions(e, n, i),
                i = this.tn.next()),
                i !== t.END)
                    throw Error("Illegal delimiter in message " + e.name + "#" + n.name + " at line " + this.tn.line + ": " + i)
            } else if ("group" === i) {
                if (o = this._parseMessage(e, n, i),
                !/^[A-Z]/.test(o.name))
                    throw Error("Group names must start with a capital letter");
                n.type = o.name,
                n.name = o.name.toLowerCase(),
                i = this.tn.peek(),
                i === t.END && this.tn.next()
            } else {
                if (!t.TYPE.test(i) && !t.TYPEREF.test(i))
                    throw Error("Illegal field type in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (n.type = i,
                i = this.tn.next(),
                !t.NAME.test(i))
                    throw Error("Illegal field name in message " + e.name + " at line " + this.tn.line + ": " + i);
                if (n.name = i,
                i = this.tn.next(),
                i !== t.EQUAL)
                    throw Error("Illegal token in field " + e.name + "#" + n.name + " at line " + this.tn.line + ": " + i);
                i = this.tn.next();
                try {
                    n.id = this._parseId(i)
                } catch (s) {
                    throw Error("Illegal field id in message " + e.name + "#" + n.name + " at line " + this.tn.line + ": " + i)
                }
                if (i = this.tn.next(),
                i === t.OPTOPEN && (this._parseFieldOptions(e, n, i),
                i = this.tn.next()),
                i !== t.END)
                    throw Error("Illegal delimiter in message " + e.name + "#" + n.name + " at line " + this.tn.line + ": " + i)
            }
            return e.fields.push(n),
            n
        }
        ,
        s._parseMessageOneOf = function(e, i) {
            if (i = this.tn.next(),
            !t.NAME.test(i))
                throw Error("Illegal oneof name in message " + e.name + " at line " + this.tn.line + ": " + i);
            var r, n = i, o = [];
            if (i = this.tn.next(),
            i !== t.OPEN)
                throw Error("Illegal start of oneof " + n + " at line " + this.tn.line + ": " + i);
            for (; this.tn.peek() !== t.CLOSE; )
                r = this._parseMessageField(e, "optional"),
                r.oneof = n,
                o.push(r.id);
            this.tn.next(),
            e.oneofs[n] = o
        }
        ,
        s._parseFieldOptions = function(e, i, r) {
            for (var n = !0; ; ) {
                if (r = this.tn.next(),
                r === t.OPTCLOSE)
                    break;
                if (r === t.OPTEND) {
                    if (n)
                        throw Error("Illegal start of options in message " + e.name + "#" + i.name + " at line " + this.tn.line + ": " + r);
                    r = this.tn.next()
                }
                this._parseFieldOption(e, i, r),
                n = !1
            }
        }
        ,
        s._parseFieldOption = function(e, i, r) {
            var n = !1;
            if (r === t.COPTOPEN && (r = this.tn.next(),
            n = !0),
            !t.TYPEREF.test(r))
                throw Error("Illegal field option in " + e.name + "#" + i.name + " at line " + this.tn.line + ": " + r);
            var o = r;
            if (r = this.tn.next(),
            n) {
                if (r !== t.COPTCLOSE)
                    throw Error("Illegal delimiter in " + e.name + "#" + i.name + " at line " + this.tn.line + ": " + r);
                o = "(" + o + ")",
                r = this.tn.next(),
                t.FQTYPEREF.test(r) && (o += r,
                r = this.tn.next())
            }
            if (r !== t.EQUAL)
                throw Error("Illegal token in " + e.name + "#" + i.name + " at line " + this.tn.line + ": " + r);
            var s;
            if (r = this.tn.peek(),
            r === t.STRINGOPEN || r === t.STRINGOPEN_SQ)
                s = this._parseString();
            else if (t.NUMBER.test(r, !0))
                s = this._parseNumber(this.tn.next(), !0);
            else if (t.BOOL.test(r))
                s = "true" === this.tn.next().toLowerCase();
            else {
                if (!t.TYPEREF.test(r))
                    throw Error("Illegal value in message " + e.name + "#" + i.name + ", option " + o + " at line " + this.tn.line + ": " + r);
                s = this.tn.next()
            }
            i.options[o] = s
        }
        ,
        s._parseEnum = function(e, i) {
            var r = {};
            if (i = this.tn.next(),
            !t.NAME.test(i))
                throw Error("Illegal enum name in message " + e.name + " at line " + this.tn.line + ": " + i);
            if (r.name = i,
            i = this.tn.next(),
            i !== t.OPEN)
                throw Error("Illegal start of enum " + r.name + " at line " + this.tn.line + ": " + i);
            for (r.values = [],
            r.options = {}; ; ) {
                if (i = this.tn.next(),
                i === t.CLOSE) {
                    i = this.tn.peek(),
                    i === t.END && this.tn.next();
                    break
                }
                if ("option" == i)
                    this._parseOption(r, i);
                else {
                    if (!t.NAME.test(i))
                        throw Error("Illegal name in enum " + r.name + " at line " + this.tn.line + ": " + i);
                    this._parseEnumValue(r, i)
                }
            }
            e.enums.push(r)
        }
        ,
        s._parseEnumValue = function(e, i) {
            var r = {};
            if (r.name = i,
            i = this.tn.next(),
            i !== t.EQUAL)
                throw Error("Illegal token in enum " + e.name + " at line " + this.tn.line + ": " + i);
            i = this.tn.next();
            try {
                r.id = this._parseId(i, !0)
            } catch (n) {
                throw Error("Illegal id in enum " + e.name + " at line " + this.tn.line + ": " + i)
            }
            if (e.values.push(r),
            i = this.tn.next(),
            i === t.OPTOPEN) {
                var o = {
                    options: {}
                };
                this._parseFieldOptions(e, o, i),
                i = this.tn.next()
            }
            if (i !== t.END)
                throw Error("Illegal delimiter in enum " + e.name + " at line " + this.tn.line + ": " + i)
        }
        ,
        s._parseExtensions = function(i, r) {
            var n = [];
            if (r = this.tn.next(),
            "min" === r ? n.push(e.ID_MIN) : "max" === r ? n.push(e.ID_MAX) : n.push(this._parseNumber(r)),
            r = this.tn.next(),
            "to" !== r)
                throw Error("Illegal extensions delimiter in message " + i.name + " at line " + this.tn.line + ": " + r);
            if (r = this.tn.next(),
            "min" === r ? n.push(e.ID_MIN) : "max" === r ? n.push(e.ID_MAX) : n.push(this._parseNumber(r)),
            r = this.tn.next(),
            r !== t.END)
                throw Error("Illegal extensions delimiter in message " + i.name + " at line " + this.tn.line + ": " + r);
            return n
        }
        ,
        s._parseExtend = function(e, i) {
            if (i = this.tn.next(),
            !t.TYPEREF.test(i))
                throw Error("Illegal message name at line " + this.tn.line + ": " + i);
            var r = {};
            if (r.ref = i,
            r.fields = [],
            i = this.tn.next(),
            i !== t.OPEN)
                throw Error("Illegal start of extend " + r.name + " at line " + this.tn.line + ": " + i);
            for (; ; ) {
                if (i = this.tn.next(),
                i === t.CLOSE) {
                    i = this.tn.peek(),
                    i == t.END && this.tn.next();
                    break
                }
                if (t.RULE.test(i))
                    this._parseMessageField(r, i);
                else {
                    if (!t.TYPEREF.test(i))
                        throw Error("Illegal token in extend " + r.name + " at line " + this.tn.line + ": " + i);
                    this._parseMessageField(r, "optional", i)
                }
            }
            return e.messages.push(r),
            r
        }
        ,
        s._parseSyntax = function(e) {
            var i = this.tn.next();
            if (i !== t.EQUAL)
                throw Error("Illegal token at line " + this.tn.line + ": " + i);
            if (i = this.tn.peek(),
            i !== t.STRINGOPEN && i !== t.STRINGOPEN_SQ)
                throw Error("Illegal token at line " + this.tn.line + ": " + i);
            var r = this._parseString();
            if (i = this.tn.next(),
            i !== t.END)
                throw Error("Illegal token at line " + this.tn.line + ": " + i);
            return r
        }
        ,
        s.toString = function() {
            return "Parser"
        }
        ,
        i.Parser = o,
        i
    }(t, t.Lang),
    t.Reflect = function(t) {
        function i(i) {
            if ("string" == typeof i && (i = t.TYPES[i]),
            "undefined" == typeof i.defaultValue)
                throw Error("default value for type " + i.name + " is not supported");
            return i == t.TYPES.bytes ? new e(0) : i.defaultValue
        }
        function r(e, i) {
            if (e && "number" == typeof e.low && "number" == typeof e.high && "boolean" == typeof e.unsigned && e.low === e.low && e.high === e.high)
                return new t.Long(e.low,e.high,"undefined" == typeof i ? e.unsigned : i);
            if ("string" == typeof e)
                return t.Long.fromString(e, i || !1, 10);
            if ("number" == typeof e)
                return t.Long.fromNumber(e, i || !1);
            throw Error("not convertible to Long")
        }
        function n(e, i) {
            var r = i.readVarint32()
              , o = 7 & r
              , s = r >>> 3;
            switch (o) {
            case t.WIRE_TYPES.VARINT:
                do
                    r = i.readUint8();
                while (128 === (128 & r));break;
            case t.WIRE_TYPES.BITS64:
                i.offset += 8;
                break;
            case t.WIRE_TYPES.LDELIM:
                r = i.readVarint32(),
                i.offset += r;
                break;
            case t.WIRE_TYPES.STARTGROUP:
                n(s, i);
                break;
            case t.WIRE_TYPES.ENDGROUP:
                if (s === e)
                    return !1;
                throw Error("Illegal GROUPEND after unknown group: " + s + " (" + e + " expected)");
            case t.WIRE_TYPES.BITS32:
                i.offset += 4;
                break;
            default:
                throw Error("Illegal wire type in unknown group " + e + ": " + o)
            }
            return !0
        }
        var o = {}
          , s = function(e, t, i) {
            this.builder = e,
            this.parent = t,
            this.name = i,
            this.className
        }
          , a = s.prototype;
        a.fqn = function() {
            for (var e = this.name, t = this; ; ) {
                if (t = t.parent,
                null == t)
                    break;
                e = t.name + "." + e
            }
            return e
        }
        ,
        a.toString = function(e) {
            return (e ? this.className + " " : "") + this.fqn()
        }
        ,
        a.build = function() {
            throw Error(this.toString(!0) + " cannot be built directly")
        }
        ,
        o.T = s;
        var l = function(e, t, i, r, n) {
            s.call(this, e, t, i),
            this.className = "Namespace",
            this.children = [],
            this.options = r || {},
            this.syntax = n || "proto2"
        }
          , f = l.prototype = Object.create(s.prototype);
        f.getChildren = function(e) {
            if (e = e || null ,
            null == e)
                return this.children.slice();
            for (var t = [], i = 0, r = this.children.length; r > i; ++i)
                this.children[i]instanceof e && t.push(this.children[i]);
            return t
        }
        ,
        f.addChild = function(e) {
            var t;
            if (t = this.getChild(e.name))
                if (t instanceof p.Field && t.name !== t.originalName && null === this.getChild(t.originalName))
                    t.name = t.originalName;
                else {
                    if (!(e instanceof p.Field && e.name !== e.originalName && null === this.getChild(e.originalName)))
                        throw Error("Duplicate name in namespace " + this.toString(!0) + ": " + e.name);
                    e.name = e.originalName
                }
            this.children.push(e)
        }
        ,
        f.getChild = function(e) {
            for (var t = "number" == typeof e ? "id" : "name", i = 0, r = this.children.length; r > i; ++i)
                if (this.children[i][t] === e)
                    return this.children[i];
            return null
        }
        ,
        f.resolve = function(e, t) {
            var i = "string" == typeof e ? e.split(".") : e
              , r = this
              , n = 0;
            if ("" === i[n]) {
                for (; null !== r.parent; )
                    r = r.parent;
                n++
            }
            var s;
            do {
                do {
                    if (!(r instanceof o.Namespace)) {
                        r = null ;
                        break
                    }
                    if (s = r.getChild(i[n]),
                    !s || !(s instanceof o.T) || t && !(s instanceof o.Namespace)) {
                        r = null ;
                        break
                    }
                    r = s,
                    n++
                } while (n < i.length);if (null != r)
                    break;
                if (null !== this.parent)
                    return this.parent.resolve(e, t)
            } while (null != r);return r
        }
        ,
        f.qn = function(e) {
            var t = []
              , i = e;
            do
                t.unshift(i.name),
                i = i.parent;
            while (null !== i);for (var r = 1; r <= t.length; r++) {
                var n = t.slice(t.length - r);
                if (e === this.resolve(n, e instanceof o.Namespace))
                    return n.join(".")
            }
            return e.fqn()
        }
        ,
        f.build = function() {
            for (var e, t = {}, i = this.children, r = 0, n = i.length; n > r; ++r)
                e = i[r],
                e instanceof l && (t[e.name] = e.build());
            return Object.defineProperty && Object.defineProperty(t, "$options", {
                value: this.buildOpt()
            }),
            t
        }
        ,
        f.buildOpt = function() {
            for (var e = {}, t = Object.keys(this.options), i = 0, r = t.length; r > i; ++i) {
                var n = t[i]
                  , o = this.options[t[i]];
                e[n] = o
            }
            return e
        }
        ,
        f.getOption = function(e) {
            return "undefined" == typeof e ? this.options : "undefined" != typeof this.options[e] ? this.options[e] : null
        }
        ,
        o.Namespace = l;
        var u = function(e, i, r, n) {
            if (this.type = e,
            this.resolvedType = i,
            this.isMapKey = r,
            this.syntax = n,
            r && t.MAP_KEY_TYPES.indexOf(e) < 0)
                throw Error("Invalid map key type: " + e.name)
        }
          , h = u.prototype;
        h.defaultFieldValue = i,
        h.verifyValue = function(i) {
            var n = function(e, t) {
                throw Error("Illegal value for " + this.toString(!0) + " of type " + this.type.name + ": " + e + " (" + t + ")")
            }
            .bind(this);
            switch (this.type) {
            case t.TYPES.int32:
            case t.TYPES.sint32:
            case t.TYPES.sfixed32:
                return ("number" != typeof i || i === i && i % 1 !== 0) && n(typeof i, "not an integer"),
                i > 4294967295 ? 0 | i : i;
            case t.TYPES.uint32:
            case t.TYPES.fixed32:
                return ("number" != typeof i || i === i && i % 1 !== 0) && n(typeof i, "not an integer"),
                0 > i ? i >>> 0 : i;
            case t.TYPES.int64:
            case t.TYPES.sint64:
            case t.TYPES.sfixed64:
                if (t.Long)
                    try {
                        return r(i, !1)
                    } catch (o) {
                        n(typeof i, o.message)
                    }
                else
                    n(typeof i, "requires Long.js");
            case t.TYPES.uint64:
            case t.TYPES.fixed64:
                if (t.Long)
                    try {
                        return r(i, !0)
                    } catch (o) {
                        n(typeof i, o.message)
                    }
                else
                    n(typeof i, "requires Long.js");
            case t.TYPES.bool:
                return "boolean" != typeof i && n(typeof i, "not a boolean"),
                i;
            case t.TYPES["float"]:
            case t.TYPES["double"]:
                return "number" != typeof i && n(typeof i, "not a number"),
                i;
            case t.TYPES.string:
                return "string" == typeof i || i && i instanceof String || n(typeof i, "not a string"),
                "" + i;
            case t.TYPES.bytes:
                return e.isByteBuffer(i) ? i : e.wrap(i, "base64");
            case t.TYPES["enum"]:
                var s = this.resolvedType.getChildren(t.Reflect.Enum.Value);
                for (l = 0; l < s.length; l++) {
                    if (s[l].name == i)
                        return s[l].id;
                    if (s[l].id == i)
                        return s[l].id
                }
                if ("proto3" === this.syntax)
                    return ("number" != typeof i || i === i && i % 1 !== 0) && n(typeof i, "not an integer"),
                    (i > 4294967295 || 0 > i) && n(typeof i, "not in range for uint32"),
                    i;
                n(i, "not a valid enum value");
            case t.TYPES.group:
            case t.TYPES.message:
                if (i && "object" == typeof i || n(typeof i, "object expected"),
                i instanceof this.resolvedType.clazz)
                    return i;
                if (i instanceof t.Builder.Message) {
                    var a = {};
                    for (var l in i)
                        i.hasOwnProperty(l) && (a[l] = i[l]);
                    i = a
                }
                return new this.resolvedType.clazz(i)
            }
            throw Error("[INTERNAL] Illegal value for " + this.toString(!0) + ": " + i + " (undefined type " + this.type + ")")
        }
        ,
        h.calculateLength = function(i, r) {
            if (null === r)
                return 0;
            var n;
            switch (this.type) {
            case t.TYPES.int32:
                return 0 > r ? e.calculateVarint64(r) : e.calculateVarint32(r);
            case t.TYPES.uint32:
                return e.calculateVarint32(r);
            case t.TYPES.sint32:
                return e.calculateVarint32(e.zigZagEncode32(r));
            case t.TYPES.fixed32:
            case t.TYPES.sfixed32:
            case t.TYPES["float"]:
                return 4;
            case t.TYPES.int64:
            case t.TYPES.uint64:
                return e.calculateVarint64(r);
            case t.TYPES.sint64:
                return e.calculateVarint64(e.zigZagEncode64(r));
            case t.TYPES.fixed64:
            case t.TYPES.sfixed64:
                return 8;
            case t.TYPES.bool:
                return 1;
            case t.TYPES["enum"]:
                return e.calculateVarint32(r);
            case t.TYPES["double"]:
                return 8;
            case t.TYPES.string:
                return n = e.calculateUTF8Bytes(r),
                e.calculateVarint32(n) + n;
            case t.TYPES.bytes:
                if (r.remaining() < 0)
                    throw Error("Illegal value for " + this.toString(!0) + ": " + r.remaining() + " bytes remaining");
                return e.calculateVarint32(r.remaining()) + r.remaining();
            case t.TYPES.message:
                return n = this.resolvedType.calculate(r),
                e.calculateVarint32(n) + n;
            case t.TYPES.group:
                return n = this.resolvedType.calculate(r),
                n + e.calculateVarint32(i << 3 | t.WIRE_TYPES.ENDGROUP)
            }
            throw Error("[INTERNAL] Illegal value to encode in " + this.toString(!0) + ": " + r + " (unknown type)")
        }
        ,
        h.encodeValue = function(i, r, n) {
            if (null === r)
                return n;
            switch (this.type) {
            case t.TYPES.int32:
                0 > r ? n.writeVarint64(r) : n.writeVarint32(r);
                break;
            case t.TYPES.uint32:
                n.writeVarint32(r);
                break;
            case t.TYPES.sint32:
                n.writeVarint32ZigZag(r);
                break;
            case t.TYPES.fixed32:
                n.writeUint32(r);
                break;
            case t.TYPES.sfixed32:
                n.writeInt32(r);
                break;
            case t.TYPES.int64:
            case t.TYPES.uint64:
                n.writeVarint64(r);
                break;
            case t.TYPES.sint64:
                n.writeVarint64ZigZag(r);
                break;
            case t.TYPES.fixed64:
                n.writeUint64(r);
                break;
            case t.TYPES.sfixed64:
                n.writeInt64(r);
                break;
            case t.TYPES.bool:
                "string" == typeof r ? n.writeVarint32("false" === r.toLowerCase() ? 0 : !!r) : n.writeVarint32(r ? 1 : 0);
                break;
            case t.TYPES["enum"]:
                n.writeVarint32(r);
                break;
            case t.TYPES["float"]:
                n.writeFloat32(r);
                break;
            case t.TYPES["double"]:
                n.writeFloat64(r);
                break;
            case t.TYPES.string:
                n.writeVString(r);
                break;
            case t.TYPES.bytes:
                if (r.remaining() < 0)
                    throw Error("Illegal value for " + this.toString(!0) + ": " + r.remaining() + " bytes remaining");
                var o = r.offset;
                n.writeVarint32(r.remaining()),
                n.append(r),
                r.offset = o;
                break;
            case t.TYPES.message:
                var s = (new e).LE();
                this.resolvedType.encode(r, s),
                n.writeVarint32(s.offset),
                n.append(s.flip());
                break;
            case t.TYPES.group:
                this.resolvedType.encode(r, n),
                n.writeVarint32(i << 3 | t.WIRE_TYPES.ENDGROUP);
                break;
            default:
                throw Error("[INTERNAL] Illegal value to encode in " + this.toString(!0) + ": " + r + " (unknown type)")
            }
            return n
        }
        ,
        h.decode = function(e, i, r) {
            if (i != this.type.wireType)
                throw Error("Unexpected wire type for element");
            var n, o;
            switch (this.type) {
            case t.TYPES.int32:
                return 0 | e.readVarint32();
            case t.TYPES.uint32:
                return e.readVarint32() >>> 0;
            case t.TYPES.sint32:
                return 0 | e.readVarint32ZigZag();
            case t.TYPES.fixed32:
                return e.readUint32() >>> 0;
            case t.TYPES.sfixed32:
                return 0 | e.readInt32();
            case t.TYPES.int64:
                return e.readVarint64();
            case t.TYPES.uint64:
                return e.readVarint64().toUnsigned();
            case t.TYPES.sint64:
                return e.readVarint64ZigZag();
            case t.TYPES.fixed64:
                return e.readUint64();
            case t.TYPES.sfixed64:
                return e.readInt64();
            case t.TYPES.bool:
                return !!e.readVarint32();
            case t.TYPES["enum"]:
                return e.readVarint32();
            case t.TYPES["float"]:
                return e.readFloat();
            case t.TYPES["double"]:
                return e.readDouble();
            case t.TYPES.string:
                return e.readVString();
            case t.TYPES.bytes:
                if (o = e.readVarint32(),
                e.remaining() < o)
                    throw Error("Illegal number of bytes for " + this.toString(!0) + ": " + o + " required but got only " + e.remaining());
                return n = e.clone(),
                n.limit = n.offset + o,
                e.offset += o,
                n;
            case t.TYPES.message:
                return o = e.readVarint32(),
                this.resolvedType.decode(e, o);
            case t.TYPES.group:
                return this.resolvedType.decode(e, -1, r)
            }
            throw Error("[INTERNAL] Illegal decode type")
        }
        ,
        h.valueFromString = function(i) {
            if (!this.isMapKey)
                throw Error("valueFromString() called on non-map-key element");
            switch (this.type) {
            case t.TYPES.int32:
            case t.TYPES.sint32:
            case t.TYPES.sfixed32:
            case t.TYPES.uint32:
            case t.TYPES.fixed32:
                return this.verifyValue(parseInt(i));
            case t.TYPES.int64:
            case t.TYPES.sint64:
            case t.TYPES.sfixed64:
            case t.TYPES.uint64:
            case t.TYPES.fixed64:
                return this.verifyValue(i);
            case t.TYPES.bool:
                return "true" === i;
            case t.TYPES.string:
                return this.verifyValue(i);
            case t.TYPES.bytes:
                return e.fromBinary(i)
            }
        }
        ,
        h.valueToString = function(e) {
            if (!this.isMapKey)
                throw Error("valueToString() called on non-map-key element");
            return this.type === t.TYPES.bytes ? e.toString("binary") : e.toString()
        }
        ,
        o.Element = u;
        var p = function(e, i, r, n, o, s) {
            l.call(this, e, i, r, n, s),
            this.className = "Message",
            this.extensions = [t.ID_MIN, t.ID_MAX],
            this.clazz = null ,
            this.isGroup = !!o,
            this._fields = null ,
            this._fieldsById = null ,
            this._fieldsByName = null
        }
          , d = p.prototype = Object.create(l.prototype);
        d.build = function(i) {
            if (this.clazz && !i)
                return this.clazz;
            var r = function(t, i) {
                function r(i, n, o, s, a) {
                    var l = void 0;
                    if (null === i || "object" != typeof i) {
                        if (s == t.TYPES["enum"])
                            for (var f = a.getChildren(t.Reflect.Enum.Value), u = 0; u < f.length; u++)
                                if (f[u].id === i) {
                                    i = f[u].name;
                                    break
                                }
                        l = i
                    } else if (e.isByteBuffer(i))
                        l = n ? i.toBase64() : i.toBuffer();
                    else if (Array.isArray(i)) {
                        var h = i;
                        l = [];
                        for (var p = 0; p < h.length; p++)
                            l.push(r(h[p], n, o, s, a))
                    } else if (i instanceof t.Map) {
                        var d = i.entries();
                        l = {};
                        for (var c = d.next(); !c.done; c = d.next())
                            l[i.keyElem.valueToString(c.value[0])] = r(c.value[1], n, o, i.valueElem.type, i.valueElem.resolvedType)
                    } else if (i instanceof t.Long)
                        l = o ? i.toString() : new t.Long(i);
                    else {
                        l = {};
                        var m = i.$type
                          , g = void 0;
                        for (var u in i)
                            if (i.hasOwnProperty(u)) {
                                var y = i[u];
                                m && (g = m.getChild(u)),
                                l[u] = r(y, n, o, g.type, g.resolvedType)
                            }
                    }
                    return l
                }
                var n = i.getChildren(t.Reflect.Message.Field)
                  , o = i.getChildren(t.Reflect.Message.OneOf)
                  , s = function(r, a) {
                    t.Builder.Message.call(this);
                    for (var l = 0, f = o.length; f > l; ++l)
                        this[o[l].name] = null ;
                    for (l = 0,
                    f = n.length; f > l; ++l) {
                        var u = n[l];
                        this[u.name] = u.repeated ? [] : u.map ? new t.Map(u) : null ,
                        !u.required && "proto3" !== i.syntax || null === u.defaultValue || (this[u.name] = u.defaultValue)
                    }
                    if (arguments.length > 0) {
                        var h;
                        if (1 !== arguments.length || null === r || "object" != typeof r || !("function" != typeof r.encode || r instanceof s) || Array.isArray(r) || r instanceof t.Map || e.isByteBuffer(r) || r instanceof ArrayBuffer || t.Long && r instanceof t.Long)
                            for (l = 0,
                            f = arguments.length; f > l; ++l)
                                "undefined" != typeof (h = arguments[l]) && this.$set(n[l].name, h);
                        else
                            this.$set(r)
                    }
                }
                  , a = s.prototype = Object.create(t.Builder.Message.prototype);
                a.add = function(e, r, n) {
                    var o = i._fieldsByName[e];
                    if (!n) {
                        if (!o)
                            throw Error(this + "#" + e + " is undefined");
                        if (!(o instanceof t.Reflect.Message.Field))
                            throw Error(this + "#" + e + " is not a field: " + o.toString(!0));
                        if (!o.repeated)
                            throw Error(this + "#" + e + " is not a repeated field");
                        r = o.verifyValue(r, !0)
                    }
                    return null === this[e] && (this[e] = []),
                    this[e].push(r),
                    this
                }
                ,
                a.$add = a.add,
                a.set = function(e, r, n) {
                    if (e && "object" == typeof e) {
                        n = r;
                        for (var o in e)
                            e.hasOwnProperty(o) && "undefined" != typeof (r = e[o]) && this.$set(o, r, n);
                        return this
                    }
                    var s = i._fieldsByName[e];
                    if (n)
                        this[e] = r;
                    else {
                        if (!s)
                            throw Error(this + "#" + e + " is not a field: undefined");
                        if (!(s instanceof t.Reflect.Message.Field))
                            throw Error(this + "#" + e + " is not a field: " + s.toString(!0));
                        this[s.name] = r = s.verifyValue(r)
                    }
                    return s && s.oneof && (null !== r ? (null !== this[s.oneof.name] && (this[this[s.oneof.name]] = null ),
                    this[s.oneof.name] = s.name) : s.oneof.name === e && (this[s.oneof.name] = null )),
                    this
                }
                ,
                a.$set = a.set,
                a.get = function(e, r) {
                    if (r)
                        return this[e];
                    var n = i._fieldsByName[e];
                    if (!(n && n instanceof t.Reflect.Message.Field))
                        throw Error(this + "#" + e + " is not a field: undefined");
                    if (!(n instanceof t.Reflect.Message.Field))
                        throw Error(this + "#" + e + " is not a field: " + n.toString(!0));
                    return this[n.name]
                }
                ,
                a.$get = a.get;
                for (var l = 0; l < n.length; l++) {
                    var f = n[l];
                    f instanceof t.Reflect.Message.ExtensionField || i.builder.options.populateAccessors && function(e) {
                        var t = e.originalName.replace(/(_[a-zA-Z])/g, function(e) {
                            return e.toUpperCase().replace("_", "")
                        });
                        t = t.substring(0, 1).toUpperCase() + t.substring(1);
                        var r = e.originalName.replace(/([A-Z])/g, function(e) {
                            return "_" + e
                        })
                          , n = function(t, i) {
                            return this[e.name] = i ? t : e.verifyValue(t),
                            this
                        }
                          , o = function() {
                            return this[e.name]
                        }
                        ;
                        null === i.getChild("set" + t) && (a["set" + t] = n),
                        null === i.getChild("set_" + r) && (a["set_" + r] = n),
                        null === i.getChild("get" + t) && (a["get" + t] = o),
                        null === i.getChild("get_" + r) && (a["get_" + r] = o)
                    }(f)
                }
                a.encode = function(t, r) {
                    "boolean" == typeof t && (r = t,
                    t = void 0);
                    var n = !1;
                    t || (t = new e,
                    n = !0);
                    var o = t.littleEndian;
                    try {
                        return i.encode(this, t.LE(), r),
                        (n ? t.flip() : t).LE(o)
                    } catch (s) {
                        throw t.LE(o),
                        s
                    }
                }
                ,
                s.encode = function(e, t, i) {
                    return new s(e).encode(t, i)
                }
                ,
                a.calculate = function() {
                    return i.calculate(this)
                }
                ,
                a.encodeDelimited = function(t) {
                    var r = !1;
                    t || (t = new e,
                    r = !0);
                    var n = (new e).LE();
                    return i.encode(this, n).flip(),
                    t.writeVarint32(n.remaining()),
                    t.append(n),
                    r ? t.flip() : t
                }
                ,
                a.encodeAB = function() {
                    try {
                        return this.encode().toArrayBuffer()
                    } catch (e) {
                        throw e.encoded && (e.encoded = e.encoded.toArrayBuffer()),
                        e
                    }
                }
                ,
                a.toArrayBuffer = a.encodeAB,
                a.encodeNB = function() {
                    try {
                        return this.encode().toBuffer()
                    } catch (e) {
                        throw e.encoded && (e.encoded = e.encoded.toBuffer()),
                        e
                    }
                }
                ,
                a.toBuffer = a.encodeNB,
                a.encode64 = function() {
                    try {
                        return this.encode().toBase64()
                    } catch (e) {
                        throw e.encoded && (e.encoded = e.encoded.toBase64()),
                        e
                    }
                }
                ,
                a.toBase64 = a.encode64,
                a.encodeHex = function() {
                    try {
                        return this.encode().toHex()
                    } catch (e) {
                        throw e.encoded && (e.encoded = e.encoded.toHex()),
                        e
                    }
                }
                ,
                a.toHex = a.encodeHex,
                a.toRaw = function(e, i) {
                    return r(this, !!e, !!i, t.TYPES.message, this.$type)
                }
                ,
                a.encodeJSON = function() {
                    return JSON.stringify(r(this, !0, !0, t.TYPES.message, this.$type))
                }
                ,
                s.decode = function(t, r) {
                    "string" == typeof t && (t = e.wrap(t, r ? r : "base64")),
                    t = e.isByteBuffer(t) ? t : e.wrap(t);
                    var n = t.littleEndian;
                    try {
                        var o = i.decode(t.LE());
                        return t.LE(n),
                        o
                    } catch (s) {
                        throw t.LE(n),
                        s
                    }
                }
                ,
                s.decodeDelimited = function(t, r) {
                    if ("string" == typeof t && (t = e.wrap(t, r ? r : "base64")),
                    t = e.isByteBuffer(t) ? t : e.wrap(t),
                    t.remaining() < 1)
                        return null ;
                    var n = t.offset
                      , o = t.readVarint32();
                    if (t.remaining() < o)
                        return t.offset = n,
                        null ;
                    try {
                        var s = i.decode(t.slice(t.offset, t.offset + o).LE());
                        return t.offset += o,
                        s
                    } catch (a) {
                        throw t.offset += o,
                        a
                    }
                }
                ,
                s.decode64 = function(e) {
                    return s.decode(e, "base64")
                }
                ,
                s.decodeHex = function(e) {
                    return s.decode(e, "hex")
                }
                ,
                s.decodeJSON = function(e) {
                    return new s(JSON.parse(e))
                }
                ,
                a.toString = function() {
                    return i.toString()
                }
                ;
                return Object.defineProperty && (Object.defineProperty(s, "$options", {
                    value: i.buildOpt()
                }),
                Object.defineProperty(a, "$options", {
                    value: s.$options
                }),
                Object.defineProperty(s, "$type", {
                    value: i
                }),
                Object.defineProperty(a, "$type", {
                    value: i
                })),
                s
            }(t, this);
            this._fields = [],
            this._fieldsById = {},
            this._fieldsByName = {};
            for (var n, o = 0, s = this.children.length; s > o; o++)
                if (n = this.children[o],
                n instanceof E || n instanceof p || n instanceof T) {
                    if (r.hasOwnProperty(n.name))
                        throw Error("Illegal reflect child of " + this.toString(!0) + ": " + n.toString(!0) + " cannot override static property '" + n.name + "'");
                    r[n.name] = n.build()
                } else if (n instanceof p.Field)
                    n.build(),
                    this._fields.push(n),
                    this._fieldsById[n.id] = n,
                    this._fieldsByName[n.name] = n;
                else if (!(n instanceof p.OneOf || n instanceof b))
                    throw Error("Illegal reflect child of " + this.toString(!0) + ": " + this.children[o].toString(!0));
            return this.clazz = r
        }
        ,
        d.encode = function(e, t, i) {
            for (var r, n, o = null , s = 0, a = this._fields.length; a > s; ++s)
                r = this._fields[s],
                n = e[r.name],
                r.required && null === n ? null === o && (o = r) : r.encode(i ? n : r.verifyValue(n), t);
            if (null !== o) {
                var l = Error("Missing at least one required field for " + this.toString(!0) + ": " + o);
                throw l.encoded = t,
                l
            }
            return t
        }
        ,
        d.calculate = function(e) {
            for (var t, i, r = 0, n = 0, o = this._fields.length; o > n; ++n) {
                if (t = this._fields[n],
                i = e[t.name],
                t.required && null === i)
                    throw Error("Missing at least one required field for " + this.toString(!0) + ": " + t);
                r += t.calculate(i)
            }
            return r
        }
        ,
        d.decode = function(e, i, r) {
            i = "number" == typeof i ? i : -1;
            for (var o, s, a, l, f = e.offset, u = new this.clazz; e.offset < f + i || -1 === i && e.remaining() > 0; ) {
                if (o = e.readVarint32(),
                s = 7 & o,
                a = o >>> 3,
                s === t.WIRE_TYPES.ENDGROUP) {
                    if (a !== r)
                        throw Error("Illegal group end indicator for " + this.toString(!0) + ": " + a + " (" + (r ? r + " expected" : "not a group") + ")");
                    break
                }
                if (l = this._fieldsById[a])
                    if (l.repeated && !l.options.packed)
                        u[l.name].push(l.decode(s, e));
                    else if (l.map) {
                        var h = l.decode(s, e);
                        u[l.name].set(h[0], h[1])
                    } else
                        u[l.name] = l.decode(s, e),
                        l.oneof && (null !== this[l.oneof.name] && (this[this[l.oneof.name]] = null ),
                        u[l.oneof.name] = l.name);
                else
                    switch (s) {
                    case t.WIRE_TYPES.VARINT:
                        e.readVarint32();
                        break;
                    case t.WIRE_TYPES.BITS32:
                        e.offset += 4;
                        break;
                    case t.WIRE_TYPES.BITS64:
                        e.offset += 8;
                        break;
                    case t.WIRE_TYPES.LDELIM:
                        var p = e.readVarint32();
                        e.offset += p;
                        break;
                    case t.WIRE_TYPES.STARTGROUP:
                        for (; n(a, e); )
                            ;
                        break;
                    default:
                        throw Error("Illegal wire type for unknown field " + a + " in " + this.toString(!0) + "#decode: " + s)
                    }
            }
            for (var d = 0, c = this._fields.length; c > d; ++d)
                if (l = this._fields[d],
                null === u[l.name]) {
                    if (l.required) {
                        var m = Error("Missing at least one required field for " + this.toString(!0) + ": " + l.name);
                        throw m.decoded = u,
                        m
                    }
                    t.populateDefaults && null !== l.defaultValue && (u[l.name] = l.defaultValue)
                }
            return u
        }
        ,
        o.Message = p;
        var c = function(e, i, r, n, o, a, l, f, u, h) {
            s.call(this, e, i, a),
            this.className = "Message.Field",
            this.required = "required" === r,
            this.repeated = "repeated" === r,
            this.map = "map" === r,
            this.keyType = n || null ,
            this.type = o,
            this.resolvedType = null ,
            this.id = l,
            this.options = f || {},
            this.defaultValue = null ,
            this.oneof = u || null ,
            this.syntax = h || "proto2",
            this.originalName = this.name,
            this.element = null ,
            this.keyElement = null ,
            !this.builder.options.convertFieldsToCamelCase || this instanceof p.ExtensionField || (this.name = t.Util.toCamelCase(this.name))
        }
          , m = c.prototype = Object.create(s.prototype);
        m.build = function() {
            this.element = new u(this.type,this.resolvedType,!1,this.syntax),
            this.map && (this.keyElement = new u(this.keyType,void 0,!0,this.syntax)),
            this.defaultValue = "undefined" != typeof this.options["default"] ? this.verifyValue(this.options["default"]) : null ,
            "proto3" !== this.syntax || this.repeated || this.map || (this.defaultValue = this.element.defaultFieldValue(this.type))
        }
        ,
        m.verifyValue = function(e, i) {
            i = i || !1;
            var r = function(e, t) {
                throw Error("Illegal value for " + this.toString(!0) + " of type " + this.type.name + ": " + e + " (" + t + ")")
            }
            .bind(this);
            if (null === e)
                return this.required && r(typeof e, "required"),
                "proto3" === this.syntax && this.type !== t.TYPES.message && r(typeof e, "proto3 field without field presence cannot be null"),
                null ;
            var n;
            if (this.repeated && !i) {
                Array.isArray(e) || (e = [e]);
                var o = [];
                for (n = 0; n < e.length; n++)
                    o.push(this.element.verifyValue(e[n]));
                return o
            }
            return this.map && !i ? e instanceof t.Map ? e : (e instanceof Object || r(typeof e, "expected ProtoBuf.Map or raw object for map field"),
            new t.Map(this,e)) : (!this.repeated && Array.isArray(e) && r(typeof e, "no array expected"),
            this.element.verifyValue(e))
        }
        ,
        m.hasWirePresence = function(e) {
            if ("proto3" !== this.syntax)
                return null !== e;
            switch (this.type) {
            case t.TYPES.int32:
            case t.TYPES.sint32:
            case t.TYPES.sfixed32:
            case t.TYPES.uint32:
            case t.TYPES.fixed32:
                return 0 !== e;
            case t.TYPES.int64:
            case t.TYPES.sint64:
            case t.TYPES.sfixed64:
            case t.TYPES.uint64:
            case t.TYPES.fixed64:
                return 0 !== e.low || 0 !== e.high;
            case t.TYPES.bool:
                return e;
            case t.TYPES["float"]:
            case t.TYPES["double"]:
                return 0 !== e;
            case t.TYPES.string:
                return e.length > 0;
            case t.TYPES.bytes:
                return e.remaining() > 0;
            case t.TYPES["enum"]:
                return 0 !== e;
            case t.TYPES.message:
                return null !== e;
            default:
                return !0
            }
        }
        ,
        m.encode = function(i, r) {
            if (null === this.type || "object" != typeof this.type)
                throw Error("[INTERNAL] Unresolved type in " + this.toString(!0) + ": " + this.type);
            if (null === i || this.repeated && 0 == i.length)
                return r;
            try {
                if (this.repeated) {
                    var n;
                    if (this.options.packed && t.PACKABLE_WIRE_TYPES.indexOf(this.type.wireType) >= 0) {
                        r.writeVarint32(this.id << 3 | t.WIRE_TYPES.LDELIM),
                        r.ensureCapacity(r.offset += 1);
                        var o = r.offset;
                        for (n = 0; n < i.length; n++)
                            this.element.encodeValue(this.id, i[n], r);
                        var s = r.offset - o
                          , a = e.calculateVarint32(s);
                        if (a > 1) {
                            var l = r.slice(o, r.offset);
                            o += a - 1,
                            r.offset = o,
                            r.append(l)
                        }
                        r.writeVarint32(s, o - a)
                    } else
                        for (n = 0; n < i.length; n++)
                            r.writeVarint32(this.id << 3 | this.type.wireType),
                            this.element.encodeValue(this.id, i[n], r)
                } else
                    this.map ? i.forEach(function(i, n, o) {
                        var s = e.calculateVarint32(8 | this.keyType.wireType) + this.keyElement.calculateLength(1, n) + e.calculateVarint32(16 | this.type.wireType) + this.element.calculateLength(2, i);
                        r.writeVarint32(this.id << 3 | t.WIRE_TYPES.LDELIM),
                        r.writeVarint32(s),
                        r.writeVarint32(8 | this.keyType.wireType),
                        this.keyElement.encodeValue(1, n, r),
                        r.writeVarint32(16 | this.type.wireType),
                        this.element.encodeValue(2, i, r)
                    }, this) : this.hasWirePresence(i) && (r.writeVarint32(this.id << 3 | this.type.wireType),
                    this.element.encodeValue(this.id, i, r))
            } catch (f) {
                throw Error("Illegal value for " + this.toString(!0) + ": " + i + " (" + f + ")")
            }
            return r
        }
        ,
        m.calculate = function(i) {
            if (i = this.verifyValue(i),
            null === this.type || "object" != typeof this.type)
                throw Error("[INTERNAL] Unresolved type in " + this.toString(!0) + ": " + this.type);
            if (null === i || this.repeated && 0 == i.length)
                return 0;
            var r = 0;
            try {
                if (this.repeated) {
                    var n, o;
                    if (this.options.packed && t.PACKABLE_WIRE_TYPES.indexOf(this.type.wireType) >= 0) {
                        for (r += e.calculateVarint32(this.id << 3 | t.WIRE_TYPES.LDELIM),
                        o = 0,
                        n = 0; n < i.length; n++)
                            o += this.element.calculateLength(this.id, i[n]);
                        r += e.calculateVarint32(o),
                        r += o
                    } else
                        for (n = 0; n < i.length; n++)
                            r += e.calculateVarint32(this.id << 3 | this.type.wireType),
                            r += this.element.calculateLength(this.id, i[n])
                } else
                    this.map ? i.forEach(function(i, n, o) {
                        var s = e.calculateVarint32(8 | this.keyType.wireType) + this.keyElement.calculateLength(1, n) + e.calculateVarint32(16 | this.type.wireType) + this.element.calculateLength(2, i);
                        r += e.calculateVarint32(this.id << 3 | t.WIRE_TYPES.LDELIM),
                        r += e.calculateVarint32(s),
                        r += s
                    }, this) : this.hasWirePresence(i) && (r += e.calculateVarint32(this.id << 3 | this.type.wireType),
                    r += this.element.calculateLength(this.id, i))
            } catch (s) {
                throw Error("Illegal value for " + this.toString(!0) + ": " + i + " (" + s + ")")
            }
            return r
        }
        ,
        m.decode = function(e, i, r) {
            var n, o, s = !this.map && e == this.type.wireType || !r && this.repeated && this.options.packed && e == t.WIRE_TYPES.LDELIM || this.map && e == t.WIRE_TYPES.LDELIM;
            if (!s)
                throw Error("Illegal wire type for field " + this.toString(!0) + ": " + e + " (" + this.type.wireType + " expected)");
            if (e == t.WIRE_TYPES.LDELIM && this.repeated && this.options.packed && t.PACKABLE_WIRE_TYPES.indexOf(this.type.wireType) >= 0 && !r) {
                o = i.readVarint32(),
                o = i.offset + o;
                for (var a = []; i.offset < o; )
                    a.push(this.decode(this.type.wireType, i, !0));
                return a
            }
            if (this.map) {
                var l = this.keyElement.defaultFieldValue(this.keyType);
                if (n = this.element.defaultFieldValue(this.type),
                o = i.readVarint32(),
                i.remaining() < o)
                    throw Error("Illegal number of bytes for " + this.toString(!0) + ": " + o + " required but got only " + i.remaining());
                var f = i.clone();
                for (f.limit = f.offset + o,
                i.offset += o; f.remaining() > 0; ) {
                    var u = f.readVarint32();
                    e = 7 & u;
                    var h = u >>> 3;
                    if (1 === h)
                        l = this.keyElement.decode(f, e, h);
                    else {
                        if (2 !== h)
                            throw Error("Unexpected tag in map field key/value submessage");
                        n = this.element.decode(f, e, h)
                    }
                }
                return [l, n]
            }
            return this.element.decode(i, e, this.id)
        }
        ,
        o.Message.Field = c;
        var g = function(e, t, i, r, n, o, s) {
            c.call(this, e, t, i, null , r, n, o, s),
            this.extension
        }
        ;
        g.prototype = Object.create(c.prototype),
        o.Message.ExtensionField = g;
        var y = function(e, t, i) {
            s.call(this, e, t, i),
            this.fields = []
        }
        ;
        o.Message.OneOf = y;
        var E = function(e, t, i, r, n) {
            l.call(this, e, t, i, r, n),
            this.className = "Enum",
            this.object = null
        }
          , v = E.prototype = Object.create(l.prototype);
        v.build = function() {
            for (var e = {}, t = this.getChildren(E.Value), i = 0, r = t.length; r > i; ++i)
                e[t[i].name] = t[i].id;
            return Object.defineProperty && Object.defineProperty(e, "$options", {
                value: this.buildOpt()
            }),
            this.object = e
        }
        ,
        o.Enum = E;
        var w = function(e, t, i, r) {
            s.call(this, e, t, i),
            this.className = "Enum.Value",
            this.id = r
        }
        ;
        w.prototype = Object.create(s.prototype),
        o.Enum.Value = w;
        var b = function(e, t, i, r) {
            s.call(this, e, t, i),
            this.field = r
        }
        ;
        b.prototype = Object.create(s.prototype),
        o.Extension = b;
        var T = function(e, t, i, r) {
            l.call(this, e, t, i, r),
            this.className = "Service",
            this.clazz = null
        }
          , R = T.prototype = Object.create(l.prototype);
        R.build = function(i) {
            return this.clazz && !i ? this.clazz : this.clazz = function(t, i) {
                for (var r = function(e) {
                    t.Builder.Service.call(this),
                    this.rpcImpl = e || function(e, t, i) {
                        setTimeout(i.bind(this, Error("Not implemented, see: https://github.com/dcodeIO/ProtoBuf.js/wiki/Services")), 0)
                    }
                }
                , n = r.prototype = Object.create(t.Builder.Service.prototype), o = i.getChildren(t.Reflect.Service.RPCMethod), s = 0; s < o.length; s++)
                    !function(t) {
                        n[t.name] = function(r, n) {
                            try {
                                try {
                                    r = t.resolvedRequestType.clazz.decode(e.wrap(r))
                                } catch (o) {
                                    if (!(o instanceof TypeError))
                                        throw o
                                }
                                if (!(r && r instanceof t.resolvedRequestType.clazz))
                                    return void setTimeout(n.bind(this, Error("Illegal request type provided to service method " + i.name + "#" + t.name)), 0);
                                this.rpcImpl(t.fqn(), r, function(e, r) {
                                    if (e)
                                        return void n(e);
                                    try {
                                        r = t.resolvedResponseType.clazz.decode(r)
                                    } catch (o) {}
                                    return r && r instanceof t.resolvedResponseType.clazz ? void n(null , r) : void n(Error("Illegal response type received in service method " + i.name + "#" + t.name))
                                })
                            } catch (o) {
                                setTimeout(n.bind(this, o), 0)
                            }
                        }
                        ,
                        r[t.name] = function(e, i, n) {
                            new r(e)[t.name](i, n)
                        }
                        ,
                        Object.defineProperty && (Object.defineProperty(r[t.name], "$options", {
                            value: t.buildOpt()
                        }),
                        Object.defineProperty(n[t.name], "$options", {
                            value: r[t.name].$options
                        }))
                    }(o[s]);
                return Object.defineProperty && (Object.defineProperty(r, "$options", {
                    value: i.buildOpt()
                }),
                Object.defineProperty(n, "$options", {
                    value: r.$options
                }),
                Object.defineProperty(r, "$type", {
                    value: i
                }),
                Object.defineProperty(n, "$type", {
                    value: i
                })),
                r
            }(t, this)
        }
        ,
        o.Service = T;
        var I = function(e, t, i, r) {
            s.call(this, e, t, i),
            this.className = "Service.Method",
            this.options = r || {}
        }
          , _ = I.prototype = Object.create(s.prototype);
        _.buildOpt = f.buildOpt,
        o.Service.Method = I;
        var S = function(e, t, i, r, n, o, s, a) {
            I.call(this, e, t, i, a),
            this.className = "Service.RPCMethod",
            this.requestName = r,
            this.responseName = n,
            this.requestStream = o,
            this.responseStream = s,
            this.resolvedRequestType = null ,
            this.resolvedResponseType = null
        }
        ;
        return S.prototype = Object.create(I.prototype),
        o.Service.RPCMethod = S,
        o
    }(t),
    t.Builder = function(e, t, i) {
        function r(e, t) {
            t.syntax = e,
            t.messages && t.messages.forEach(function(t) {
                r(e, t)
            }),
            t.enums && t.enums.forEach(function(t) {
                r(e, t)
            })
        }
        var n = function(e) {
            this.ns = new i.Namespace(this,null ,""),
            this.ptr = this.ns,
            this.resolved = !1,
            this.result = null ,
            this.files = {},
            this.importRoot = null ,
            this.options = e || {}
        }
          , o = n.prototype;
        return o.reset = function() {
            this.ptr = this.ns
        }
        ,
        o.define = function(e) {
            if ("string" != typeof e || !t.TYPEREF.test(e))
                throw Error("Illegal package: " + e);
            var r, n, o = e.split(".");
            for (r = 0; r < o.length; r++)
                if (!t.NAME.test(o[r]))
                    throw Error("Illegal package: " + o[r]);
            for (r = 0; r < o.length; r++)
                n = this.ptr.getChild(o[r]),
                null === n && this.ptr.addChild(n = new i.Namespace(this,this.ptr,o[r])),
                this.ptr = n;
            return this
        }
        ,
        n.isValidMessage = function(e) {
            if ("string" != typeof e.name || !t.NAME.test(e.name))
                return !1;
            if ("undefined" != typeof e.values || "undefined" != typeof e.rpc)
                return !1;
            var i;
            if ("undefined" != typeof e.fields) {
                if (!Array.isArray(e.fields))
                    return !1;
                var r, o = [];
                for (i = 0; i < e.fields.length; i++) {
                    if (!n.isValidMessageField(e.fields[i]))
                        return !1;
                    if (r = parseInt(e.fields[i].id, 10),
                    o.indexOf(r) >= 0)
                        return !1;
                    o.push(r)
                }
                o = null
            }
            if ("undefined" != typeof e.enums) {
                if (!Array.isArray(e.enums))
                    return !1;
                for (i = 0; i < e.enums.length; i++)
                    if (!n.isValidEnum(e.enums[i]))
                        return !1
            }
            if ("undefined" != typeof e.messages) {
                if (!Array.isArray(e.messages))
                    return !1;
                for (i = 0; i < e.messages.length; i++)
                    if (!n.isValidMessage(e.messages[i]) && !n.isValidExtend(e.messages[i]))
                        return !1
            }
            if ("undefined" != typeof e.extensions && (!Array.isArray(e.extensions) || 2 !== e.extensions.length || "number" != typeof e.extensions[0] || "number" != typeof e.extensions[1]))
                return !1;
            if ("proto3" === e.syntax) {
                for (i = 0; i < e.fields.length; i++) {
                    var s = e.fields[i];
                    if ("required" === s.rule)
                        return !1;
                    if (s["default"])
                        return !1;
                    if (s.options)
                        for (var a = Object.keys(s.options), l = 0; l < a.length; l++)
                            if ("default" === a[l])
                                return !1
                }
                if (e.extensions)
                    return !1
            }
            return !0
        }
        ,
        n.isValidMessageField = function(e) {
            if ("string" != typeof e.rule || "string" != typeof e.name || "string" != typeof e.type || "undefined" == typeof e.id)
                return !1;
            if (!(t.RULE.test(e.rule) && t.NAME.test(e.name) && t.TYPEREF.test(e.type) && t.ID.test("" + e.id)))
                return !1;
            if ("undefined" != typeof e.options) {
                if ("object" != typeof e.options)
                    return !1;
                for (var i, r = Object.keys(e.options), n = 0; n < r.length; n++)
                    if ("string" != typeof (i = r[n]) || "string" != typeof e.options[i] && "number" != typeof e.options[i] && "boolean" != typeof e.options[i])
                        return !1
            }
            return !0
        }
        ,
        n.isValidEnum = function(e) {
            if ("string" != typeof e.name || !t.NAME.test(e.name))
                return !1;
            if ("undefined" == typeof e.values || !Array.isArray(e.values) || 0 == e.values.length)
                return !1;
            for (var i = 0; i < e.values.length; i++) {
                if ("object" != typeof e.values[i])
                    return !1;
                if ("string" != typeof e.values[i].name || "undefined" == typeof e.values[i].id)
                    return !1;
                if (!t.NAME.test(e.values[i].name) || !t.NEGID.test("" + e.values[i].id))
                    return !1
            }
            return "proto3" !== e.syntax || 0 === e.values[0].id
        }
        ,
        o.create = function(t) {
            if (!t)
                return this;
            if (Array.isArray(t)) {
                if (0 === t.length)
                    return this;
                t = t.slice()
            } else
                t = [t];
            var r = [];
            for (r.push(t); r.length > 0; ) {
                if (t = r.pop(),
                !Array.isArray(t))
                    throw Error("Not a valid namespace: " + JSON.stringify(t));
                for (; t.length > 0; ) {
                    var o = t.shift();
                    if (n.isValidMessage(o)) {
                        var s = new i.Message(this,this.ptr,o.name,o.options,o.isGroup,o.syntax)
                          , a = {};
                        if (o.oneofs)
                            for (var l = Object.keys(o.oneofs), f = 0, u = l.length; u > f; ++f)
                                s.addChild(a[l[f]] = new i.Message.OneOf(this,s,l[f]));
                        if (o.fields && o.fields.length > 0)
                            for (f = 0,
                            u = o.fields.length; u > f; ++f) {
                                var h = o.fields[f];
                                if (null !== s.getChild(h.id))
                                    throw Error("Duplicate field id in message " + s.name + ": " + h.id);
                                if (h.options)
                                    for (var p = Object.keys(h.options), d = 0, c = p.length; c > d; ++d) {
                                        if ("string" != typeof p[d])
                                            throw Error("Illegal field option name in message " + s.name + "#" + h.name + ": " + p[d]);
                                        if ("string" != typeof h.options[p[d]] && "number" != typeof h.options[p[d]] && "boolean" != typeof h.options[p[d]])
                                            throw Error("Illegal field option value in message " + s.name + "#" + h.name + "#" + p[d] + ": " + h.options[p[d]])
                                    }
                                var m = null ;
                                if ("string" == typeof h.oneof && (m = a[h.oneof],
                                "undefined" == typeof m))
                                    throw Error("Illegal oneof in message " + s.name + "#" + h.name + ": " + h.oneof);
                                h = new i.Message.Field(this,s,h.rule,h.keytype,h.type,h.name,h.id,h.options,m,o.syntax),
                                m && m.fields.push(h),
                                s.addChild(h)
                            }
                        var g = [];
                        if ("undefined" != typeof o.enums && o.enums.length > 0)
                            for (f = 0; f < o.enums.length; f++)
                                g.push(o.enums[f]);
                        if (o.messages && o.messages.length > 0)
                            for (f = 0; f < o.messages.length; f++)
                                g.push(o.messages[f]);
                        if (o.services && o.services.length > 0)
                            for (f = 0; f < o.services.length; f++)
                                g.push(o.services[f]);
                        if (o.extensions && (s.extensions = o.extensions,
                        s.extensions[0] < e.ID_MIN && (s.extensions[0] = e.ID_MIN),
                        s.extensions[1] > e.ID_MAX && (s.extensions[1] = e.ID_MAX)),
                        this.ptr.addChild(s),
                        g.length > 0) {
                            r.push(t),
                            t = g,
                            g = null ,
                            this.ptr = s,
                            s = null ;
                            continue
                        }
                        g = null ,
                        s = null
                    } else if (n.isValidEnum(o)) {
                        for (s = new i.Enum(this,this.ptr,o.name,o.options,o.syntax),
                        f = 0; f < o.values.length; f++)
                            s.addChild(new i.Enum.Value(this,s,o.values[f].name,o.values[f].id));
                        this.ptr.addChild(s),
                        s = null
                    } else if (n.isValidService(o)) {
                        s = new i.Service(this,this.ptr,o.name,o.options);
                        for (f in o.rpc)
                            o.rpc.hasOwnProperty(f) && s.addChild(new i.Service.RPCMethod(this,s,f,o.rpc[f].request,o.rpc[f].response,!!o.rpc[f].request_stream,!!o.rpc[f].response_stream,o.rpc[f].options));
                        this.ptr.addChild(s),
                        s = null
                    } else {
                        if (!n.isValidExtend(o))
                            throw Error("Not a valid definition: " + JSON.stringify(o));
                        if (s = this.ptr.resolve(o.ref, !0))
                            for (f = 0; f < o.fields.length; f++) {
                                if (null !== s.getChild(o.fields[f].id))
                                    throw Error("Duplicate extended field id in message " + s.name + ": " + o.fields[f].id);
                                if (o.fields[f].id < s.extensions[0] || o.fields[f].id > s.extensions[1])
                                    throw Error("Illegal extended field id in message " + s.name + ": " + o.fields[f].id + " (" + s.extensions.join(" to ") + " expected)");
                                var y = o.fields[f].name;
                                this.options.convertFieldsToCamelCase && (y = e.Util.toCamelCase(o.fields[f].name)),
                                h = new i.Message.ExtensionField(this,s,o.fields[f].rule,o.fields[f].type,this.ptr.fqn() + "." + y,o.fields[f].id,o.fields[f].options);
                                var E = new i.Extension(this,this.ptr,o.fields[f].name,h);
                                h.extension = E,
                                this.ptr.addChild(E),
                                s.addChild(h)
                            }
                        else if (!/\.?google\.protobuf\./.test(o.ref))
                            throw Error("Extended message " + o.ref + " is not defined")
                    }
                    o = null
                }
                t = null ,
                this.ptr = this.ptr.parent
            }
            return this.resolved = !1,
            this.result = null ,
            this
        }
        ,
        o["import"] = function(t, i) {
            if ("string" == typeof i) {
                if (e.Util.IS_NODE && (i = require("path").resolve(i)),
                this.files[i] === !0)
                    return this.reset(),
                    this;
                this.files[i] = !0
            } else if ("object" == typeof i) {
                var n = i.root;
                e.Util.IS_NODE && (n = require("path").resolve(n));
                var o = [n, i.file].join("/");
                if (this.files[o] === !0)
                    return this.reset(),
                    this;
                this.files[o] = !0
            }
            if (t.imports && t.imports.length > 0) {
                var s, a = "/", l = !1;
                "object" == typeof i ? (this.importRoot = i.root,
                l = !0,
                s = this.importRoot,
                i = i.file,
                (s.indexOf("\\") >= 0 || i.indexOf("\\") >= 0) && (a = "\\")) : "string" == typeof i ? this.importRoot ? s = this.importRoot : i.indexOf("/") >= 0 ? (s = i.replace(/\/[^\/]*$/, ""),
                "" === s && (s = "/")) : i.indexOf("\\") >= 0 ? (s = i.replace(/\\[^\\]*$/, ""),
                a = "\\") : s = "." : s = null ;
                for (var f = 0; f < t.imports.length; f++)
                    if ("string" == typeof t.imports[f]) {
                        if (!s)
                            throw Error("Cannot determine import root: File name is unknown");
                        var u = t.imports[f];
                        if ("google/protobuf/descriptor.proto" === u)
                            continue;if (u = s + a + u,
                        this.files[u] === !0)
                            continue;/\.proto$/i.test(u) && !e.DotProto && (u = u.replace(/\.proto$/, ".json"));
                        var h = e.Util.fetch(u);
                        if (null === h)
                            throw Error("Failed to import '" + u + "' in '" + i + "': File not found");
                        /\.json$/i.test(u) ? this["import"](JSON.parse(h + ""), u) : this["import"](new e.DotProto.Parser(h + "").parse(), u)
                    } else
                        i ? /\.(\w+)$/.test(i) ? this["import"](t.imports[f], i.replace(/^(.+)\.(\w+)$/, function(e, t, i) {
                            return t + "_import" + f + "." + i
                        })) : this["import"](t.imports[f], i + "_import" + f) : this["import"](t.imports[f]);
                l && (this.importRoot = null )
            }
            t["package"] && this.define(t["package"]),
            t.syntax && r(t.syntax, t);
            var p = this.ptr;
            return t.options && Object.keys(t.options).forEach(function(e) {
                p.options[e] = t.options[e]
            }),
            t.messages && (this.create(t.messages),
            this.ptr = p),
            t.enums && (this.create(t.enums),
            this.ptr = p),
            t.services && (this.create(t.services),
            this.ptr = p),
            t["extends"] && this.create(t["extends"]),
            this.reset(),
            this
        }
        ,
        n.isValidService = function(e) {
            return !("string" != typeof e.name || !t.NAME.test(e.name) || "object" != typeof e.rpc)
        }
        ,
        n.isValidExtend = function(e) {
            if ("string" != typeof e.ref || !t.TYPEREF.test(e.ref))
                return !1;
            var i;
            if ("undefined" != typeof e.fields) {
                if (!Array.isArray(e.fields))
                    return !1;
                var r, o = [];
                for (i = 0; i < e.fields.length; i++) {
                    if (!n.isValidMessageField(e.fields[i]))
                        return !1;
                    if (r = parseInt(e.id, 10),
                    o.indexOf(r) >= 0)
                        return !1;
                    o.push(r)
                }
                o = null
            }
            return !0
        }
        ,
        o.resolveAll = function() {
            var r;
            if (null != this.ptr && "object" != typeof this.ptr.type) {
                if (this.ptr instanceof i.Namespace)
                    for (var n = this.ptr.children, o = 0, s = n.length; s > o; ++o)
                        this.ptr = n[o],
                        this.resolveAll();
                else if (this.ptr instanceof i.Message.Field) {
                    if (t.TYPE.test(this.ptr.type))
                        this.ptr.type = e.TYPES[this.ptr.type];
                    else {
                        if (!t.TYPEREF.test(this.ptr.type))
                            throw Error("Illegal type reference in " + this.ptr.toString(!0) + ": " + this.ptr.type);
                        if (r = (this.ptr instanceof i.Message.ExtensionField ? this.ptr.extension.parent : this.ptr.parent).resolve(this.ptr.type, !0),
                        !r)
                            throw Error("Unresolvable type reference in " + this.ptr.toString(!0) + ": " + this.ptr.type);
                        if (this.ptr.resolvedType = r,
                        r instanceof i.Enum) {
                            if (this.ptr.type = e.TYPES["enum"],
                            "proto3" === this.ptr.syntax && "proto3" !== r.syntax)
                                throw Error("Proto3 message refers to proto2 enum; this is not allowed due to differing enum semantics in proto3")
                        } else {
                            if (!(r instanceof i.Message))
                                throw Error("Illegal type reference in " + this.ptr.toString(!0) + ": " + this.ptr.type);
                            this.ptr.type = r.isGroup ? e.TYPES.group : e.TYPES.message
                        }
                    }
                    if (this.ptr.map) {
                        if (!t.TYPE.test(this.ptr.keyType))
                            throw Error("Illegal key type for map field in " + this.ptr.toString(!0) + ": " + this.ptr.type);
                        this.ptr.keyType = e.TYPES[this.ptr.keyType]
                    }
                } else if (this.ptr instanceof e.Reflect.Enum.Value)
                    ;
                else if (this.ptr instanceof e.Reflect.Service.Method) {
                    if (!(this.ptr instanceof e.Reflect.Service.RPCMethod))
                        throw Error("Illegal service type in " + this.ptr.toString(!0));
                    if (r = this.ptr.parent.resolve(this.ptr.requestName, !0),
                    !(r && r instanceof e.Reflect.Message))
                        throw Error("Illegal type reference in " + this.ptr.toString(!0) + ": " + this.ptr.requestName);
                    if (this.ptr.resolvedRequestType = r,
                    r = this.ptr.parent.resolve(this.ptr.responseName, !0),
                    !(r && r instanceof e.Reflect.Message))
                        throw Error("Illegal type reference in " + this.ptr.toString(!0) + ": " + this.ptr.responseName);
                    this.ptr.resolvedResponseType = r
                } else if (!(this.ptr instanceof e.Reflect.Message.OneOf || this.ptr instanceof e.Reflect.Extension))
                    throw Error("Illegal object in namespace: " + typeof this.ptr + ":" + this.ptr);
                this.reset()
            }
        }
        ,
        o.build = function(e) {
            if (this.reset(),
            this.resolved || (this.resolveAll(),
            this.resolved = !0,
            this.result = null ),
            null === this.result && (this.result = this.ns.build()),
            e) {
                for (var t = "string" == typeof e ? e.split(".") : e, i = this.result, r = 0; r < t.length; r++) {
                    if (!i[t[r]]) {
                        i = null ;
                        break
                    }
                    i = i[t[r]]
                }
                return i
            }
            return this.result
        }
        ,
        o.lookup = function(e, t) {
            return e ? this.ns.resolve(e, t) : this.ns
        }
        ,
        o.toString = function() {
            return "Builder"
        }
        ,
        n.Message = function() {}
        ,
        n.Service = function() {}
        ,
        n
    }(t, t.Lang, t.Reflect),
    t.Map = function(e, t) {
        function i(e) {
            var t = 0;
            return {
                next: function() {
                    return t < e.length ? {
                        done: !1,
                        value: e[t++]
                    } : {
                        done: !0
                    }
                }
            }
        }
        var r = function(e, i) {
            if (!e.map)
                throw Error("field is not a map");
            if (this.field = e,
            this.keyElem = new t.Element(e.keyType,null ,!0,e.syntax),
            this.valueElem = new t.Element(e.type,e.resolvedType,!1,e.syntax),
            this.map = {},
            Object.defineProperty(this, "size", {
                get: function() {
                    return Object.keys(this.map).length
                }
            }),
            i)
                for (var r = Object.keys(i), n = 0; n < r.length; n++) {
                    var o = this.keyElem.valueFromString(r[n])
                      , s = this.valueElem.verifyValue(i[r[n]]);
                    this.map[this.keyElem.valueToString(o)] = {
                        key: o,
                        value: s
                    }
                }
        }
          , n = r.prototype;
        return n.clear = function() {
            this.map = {}
        }
        ,
        n["delete"] = function(e) {
            var t = this.keyElem.valueToString(this.keyElem.verifyValue(e))
              , i = t in this.map;
            return delete this.map[t],
            i
        }
        ,
        n.entries = function() {
            for (var e, t = [], r = Object.keys(this.map), n = 0; n < r.length; n++)
                t.push([(e = this.map[r[n]]).key, e.value]);
            return i(t)
        }
        ,
        n.keys = function() {
            for (var e = [], t = Object.keys(this.map), r = 0; r < t.length; r++)
                e.push(this.map[t[r]].key);
            return i(e)
        }
        ,
        n.values = function() {
            for (var e = [], t = Object.keys(this.map), r = 0; r < t.length; r++)
                e.push(this.map[t[r]].value);
            return i(e)
        }
        ,
        n.forEach = function(e, t) {
            for (var i, r = Object.keys(this.map), n = 0; n < r.length; n++)
                e.call(t, (i = this.map[r[n]]).value, i.key, this)
        }
        ,
        n.set = function(e, t) {
            var i = this.keyElem.verifyValue(e)
              , r = this.valueElem.verifyValue(t);
            return this.map[this.keyElem.valueToString(i)] = {
                key: i,
                value: r
            },
            this
        }
        ,
        n.get = function(e) {
            var t = this.keyElem.valueToString(this.keyElem.verifyValue(e));
            if (t in this.map)
                return this.map[t].value
        }
        ,
        n.has = function(e) {
            var t = this.keyElem.valueToString(this.keyElem.verifyValue(e));
            return t in this.map
        }
        ,
        r
    }(t, t.Reflect),
    t.loadProto = function(e, i, r) {
        return ("string" == typeof i || i && "string" == typeof i.file && "string" == typeof i.root) && (r = i,
        i = void 0),
        t.loadJson(new t.DotProto.Parser(e).parse(), i, r)
    }
    ,
    t.protoFromString = t.loadProto,
    t.loadProtoFile = function(e, i, r) {
        if (i && "object" == typeof i ? (r = i,
        i = null ) : i && "function" == typeof i || (i = null ),
        i)
            return t.Util.fetch("string" == typeof e ? e : e.root + "/" + e.file, function(n) {
                if (null === n)
                    return void i(Error("Failed to fetch file"));
                try {
                    i(null , t.loadProto(n, r, e))
                } catch (o) {
                    i(o)
                }
            });
        var n = t.Util.fetch("object" == typeof e ? e.root + "/" + e.file : e);
        return null === n ? null : t.loadProto(n, r, e)
    }
    ,
    t.protoFromFile = t.loadProtoFile,
    t.newBuilder = function(e) {
        return e = e || {},
        "undefined" == typeof e.convertFieldsToCamelCase && (e.convertFieldsToCamelCase = t.convertFieldsToCamelCase),
        "undefined" == typeof e.populateAccessors && (e.populateAccessors = t.populateAccessors),
        new t.Builder(e)
    }
    ,
    t.loadJson = function(e, i, r) {
        return ("string" == typeof i || i && "string" == typeof i.file && "string" == typeof i.root) && (r = i,
        i = null ),
        i && "object" == typeof i || (i = t.newBuilder()),
        "string" == typeof e && (e = JSON.parse(e)),
        i["import"](e, r),
        i.resolveAll(),
        i
    }
    ,
    t.loadJsonFile = function(e, i, r) {
        if (i && "object" == typeof i ? (r = i,
        i = null ) : i && "function" == typeof i || (i = null ),
        i)
            return t.Util.fetch("string" == typeof e ? e : e.root + "/" + e.file, function(n) {
                if (null === n)
                    return void i(Error("Failed to fetch file"));
                try {
                    i(null , t.loadJson(JSON.parse(n), r, e))
                } catch (o) {
                    i(o)
                }
            });
        var n = t.Util.fetch("object" == typeof e ? e.root + "/" + e.file : e);
        return null === n ? null : t.loadJson(JSON.parse(n), r, e)
    }
    ,
    t
}),
function(e) {
    "use strict";
    var t, i = e.Base64, r = "2.1.9";
    if ("undefined" != typeof module && module.exports)
        try {
            t = require("buffer").Buffer
        } catch (n) {}
    var o = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/"
      , s = function(e) {
        for (var t = {}, i = 0, r = e.length; r > i; i++)
            t[e.charAt(i)] = i;
        return t
    }(o)
      , a = String.fromCharCode
      , l = function(e) {
        if (e.length < 2) {
            var t = e.charCodeAt(0);
            return 128 > t ? e : 2048 > t ? a(192 | t >>> 6) + a(128 | 63 & t) : a(224 | t >>> 12 & 15) + a(128 | t >>> 6 & 63) + a(128 | 63 & t)
        }
        var t = 65536 + 1024 * (e.charCodeAt(0) - 55296) + (e.charCodeAt(1) - 56320);
        return a(240 | t >>> 18 & 7) + a(128 | t >>> 12 & 63) + a(128 | t >>> 6 & 63) + a(128 | 63 & t)
    }
      , f = /[\uD800-\uDBFF][\uDC00-\uDFFFF]|[^\x00-\x7F]/g
      , u = function(e) {
        return e.replace(f, l)
    }
      , h = function(e) {
        var t = [0, 2, 1][e.length % 3]
          , i = e.charCodeAt(0) << 16 | (e.length > 1 ? e.charCodeAt(1) : 0) << 8 | (e.length > 2 ? e.charCodeAt(2) : 0)
          , r = [o.charAt(i >>> 18), o.charAt(i >>> 12 & 63), t >= 2 ? "=" : o.charAt(i >>> 6 & 63), t >= 1 ? "=" : o.charAt(63 & i)];
        return r.join("")
    }
      , p = e.btoa ? function(t) {
        return e.btoa(t)
    }
    : function(e) {
        return e.replace(/[\s\S]{1,3}/g, h)
    }
      , d = t ? function(e) {
        return (e.constructor === t.constructor ? e : new t(e)).toString("base64")
    }
    : function(e) {
        return p(u(e))
    }
      , c = function(e, t) {
        return t ? d(String(e)).replace(/[+\/]/g, function(e) {
            return "+" == e ? "-" : "_"
        }).replace(/=/g, "") : d(String(e))
    }
      , m = function(e) {
        return c(e, !0)
    }
      , g = new RegExp(["[À-ß][-¿]", "[à-ï][-¿]{2}", "[ð-÷][-¿]{3}"].join("|"),"g")
      , y = function(e) {
        switch (e.length) {
        case 4:
            var t = (7 & e.charCodeAt(0)) << 18 | (63 & e.charCodeAt(1)) << 12 | (63 & e.charCodeAt(2)) << 6 | 63 & e.charCodeAt(3)
              , i = t - 65536;
            return a((i >>> 10) + 55296) + a((1023 & i) + 56320);
        case 3:
            return a((15 & e.charCodeAt(0)) << 12 | (63 & e.charCodeAt(1)) << 6 | 63 & e.charCodeAt(2));
        default:
            return a((31 & e.charCodeAt(0)) << 6 | 63 & e.charCodeAt(1))
        }
    }
      , E = function(e) {
        return e.replace(g, y)
    }
      , v = function(e) {
        var t = e.length
          , i = t % 4
          , r = (t > 0 ? s[e.charAt(0)] << 18 : 0) | (t > 1 ? s[e.charAt(1)] << 12 : 0) | (t > 2 ? s[e.charAt(2)] << 6 : 0) | (t > 3 ? s[e.charAt(3)] : 0)
          , n = [a(r >>> 16), a(r >>> 8 & 255), a(255 & r)];
        return n.length -= [0, 0, 2, 1][i],
        n.join("")
    }
      , w = e.atob ? function(t) {
        return e.atob(t)
    }
    : function(e) {
        return e.replace(/[\s\S]{1,4}/g, v)
    }
      , b = t ? function(e) {
        return (e.constructor === t.constructor ? e : new t(e,"base64")).toString()
    }
    : function(e) {
        return E(w(e))
    }
      , T = function(e) {
        return b(String(e).replace(/[-_]/g, function(e) {
            return "-" == e ? "+" : "/"
        }).replace(/[^A-Za-z0-9\+\/]/g, ""))
    }
      , R = function() {
        var t = e.Base64;
        return e.Base64 = i,
        t
    }
    ;
    if (e.Base64 = {
        VERSION: r,
        atob: w,
        btoa: p,
        fromBase64: T,
        toBase64: c,
        utob: u,
        encode: c,
        encodeURI: m,
        btou: E,
        decode: T,
        noConflict: R
    },
    "function" == typeof Object.defineProperty) {
        var I = function(e) {
            return {
                value: e,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }
        ;
        e.Base64.extendString = function() {
            Object.defineProperty(String.prototype, "fromBase64", I(function() {
                return T(this)
            })),
            Object.defineProperty(String.prototype, "toBase64", I(function(e) {
                return c(this, e)
            })),
            Object.defineProperty(String.prototype, "toBase64URI", I(function() {
                return c(this, !0)
            }))
        }
    }
    e.Meteor && (Base64 = e.Base64)
}(this);
var RC4 = function() {
    return {
        decode: function(e, t) {
            return this.encode(e, t)
        },
        encode: function(e, t) {
            var i, r, n, o, s, a = [], l = 0, f = [];
            for (e instanceof ArrayBuffer && (e = new Uint8Array(e)),
            o = e instanceof Uint8Array,
            s = o ? e.byteLength : e.length,
            i = 0; 256 > i; i++)
                a[i] = i;
            for (i = 0; 256 > i; i++)
                l = (l + a[i] + t.charCodeAt(i % t.length)) % 256,
                r = a[i],
                a[i] = a[l],
                a[l] = r;
            for (i = 0,
            l = 0,
            n = 0; s > n; n++)
                i = (i + 1) % 256,
                l = (l + a[i]) % 256,
                r = a[i],
                a[i] = a[l],
                a[l] = r,
                f[n] = (o ? e[n] : e.charCodeAt(n)) ^ a[(a[i] + a[l]) % 256],
                o || (f[n] = String.fromCharCode(f[n]));
            return o ? new Uint8Array(f) : f.join("")
        }
    }
}();
!function(e) {
    "use strict";
    function t(e, t) {
        var i = (65535 & e) + (65535 & t)
          , r = (e >> 16) + (t >> 16) + (i >> 16);
        return r << 16 | 65535 & i
    }
    function i(e, t) {
        return e << t | e >>> 32 - t
    }
    function r(e, r, n, o, s, a) {
        return t(i(t(t(r, e), t(o, a)), s), n)
    }
    function n(e, t, i, n, o, s, a) {
        return r(t & i | ~t & n, e, t, o, s, a)
    }
    function o(e, t, i, n, o, s, a) {
        return r(t & n | i & ~n, e, t, o, s, a)
    }
    function s(e, t, i, n, o, s, a) {
        return r(t ^ i ^ n, e, t, o, s, a)
    }
    function a(e, t, i, n, o, s, a) {
        return r(i ^ (t | ~n), e, t, o, s, a)
    }
    function l(e, i) {
        e[i >> 5] |= 128 << i % 32,
        e[(i + 64 >>> 9 << 4) + 14] = i;
        var r, l, f, u, h, p = 1732584193, d = -271733879, c = -1732584194, m = 271733878;
        for (r = 0; r < e.length; r += 16)
            l = p,
            f = d,
            u = c,
            h = m,
            p = n(p, d, c, m, e[r], 7, -680876936),
            m = n(m, p, d, c, e[r + 1], 12, -389564586),
            c = n(c, m, p, d, e[r + 2], 17, 606105819),
            d = n(d, c, m, p, e[r + 3], 22, -1044525330),
            p = n(p, d, c, m, e[r + 4], 7, -176418897),
            m = n(m, p, d, c, e[r + 5], 12, 1200080426),
            c = n(c, m, p, d, e[r + 6], 17, -1473231341),
            d = n(d, c, m, p, e[r + 7], 22, -45705983),
            p = n(p, d, c, m, e[r + 8], 7, 1770035416),
            m = n(m, p, d, c, e[r + 9], 12, -1958414417),
            c = n(c, m, p, d, e[r + 10], 17, -42063),
            d = n(d, c, m, p, e[r + 11], 22, -1990404162),
            p = n(p, d, c, m, e[r + 12], 7, 1804603682),
            m = n(m, p, d, c, e[r + 13], 12, -40341101),
            c = n(c, m, p, d, e[r + 14], 17, -1502002290),
            d = n(d, c, m, p, e[r + 15], 22, 1236535329),
            p = o(p, d, c, m, e[r + 1], 5, -165796510),
            m = o(m, p, d, c, e[r + 6], 9, -1069501632),
            c = o(c, m, p, d, e[r + 11], 14, 643717713),
            d = o(d, c, m, p, e[r], 20, -373897302),
            p = o(p, d, c, m, e[r + 5], 5, -701558691),
            m = o(m, p, d, c, e[r + 10], 9, 38016083),
            c = o(c, m, p, d, e[r + 15], 14, -660478335),
            d = o(d, c, m, p, e[r + 4], 20, -405537848),
            p = o(p, d, c, m, e[r + 9], 5, 568446438),
            m = o(m, p, d, c, e[r + 14], 9, -1019803690),
            c = o(c, m, p, d, e[r + 3], 14, -187363961),
            d = o(d, c, m, p, e[r + 8], 20, 1163531501),
            p = o(p, d, c, m, e[r + 13], 5, -1444681467),
            m = o(m, p, d, c, e[r + 2], 9, -51403784),
            c = o(c, m, p, d, e[r + 7], 14, 1735328473),
            d = o(d, c, m, p, e[r + 12], 20, -1926607734),
            p = s(p, d, c, m, e[r + 5], 4, -378558),
            m = s(m, p, d, c, e[r + 8], 11, -2022574463),
            c = s(c, m, p, d, e[r + 11], 16, 1839030562),
            d = s(d, c, m, p, e[r + 14], 23, -35309556),
            p = s(p, d, c, m, e[r + 1], 4, -1530992060),
            m = s(m, p, d, c, e[r + 4], 11, 1272893353),
            c = s(c, m, p, d, e[r + 7], 16, -155497632),
            d = s(d, c, m, p, e[r + 10], 23, -1094730640),
            p = s(p, d, c, m, e[r + 13], 4, 681279174),
            m = s(m, p, d, c, e[r], 11, -358537222),
            c = s(c, m, p, d, e[r + 3], 16, -722521979),
            d = s(d, c, m, p, e[r + 6], 23, 76029189),
            p = s(p, d, c, m, e[r + 9], 4, -640364487),
            m = s(m, p, d, c, e[r + 12], 11, -421815835),
            c = s(c, m, p, d, e[r + 15], 16, 530742520),
            d = s(d, c, m, p, e[r + 2], 23, -995338651),
            p = a(p, d, c, m, e[r], 6, -198630844),
            m = a(m, p, d, c, e[r + 7], 10, 1126891415),
            c = a(c, m, p, d, e[r + 14], 15, -1416354905),
            d = a(d, c, m, p, e[r + 5], 21, -57434055),
            p = a(p, d, c, m, e[r + 12], 6, 1700485571),
            m = a(m, p, d, c, e[r + 3], 10, -1894986606),
            c = a(c, m, p, d, e[r + 10], 15, -1051523),
            d = a(d, c, m, p, e[r + 1], 21, -2054922799),
            p = a(p, d, c, m, e[r + 8], 6, 1873313359),
            m = a(m, p, d, c, e[r + 15], 10, -30611744),
            c = a(c, m, p, d, e[r + 6], 15, -1560198380),
            d = a(d, c, m, p, e[r + 13], 21, 1309151649),
            p = a(p, d, c, m, e[r + 4], 6, -145523070),
            m = a(m, p, d, c, e[r + 11], 10, -1120210379),
            c = a(c, m, p, d, e[r + 2], 15, 718787259),
            d = a(d, c, m, p, e[r + 9], 21, -343485551),
            p = t(p, l),
            d = t(d, f),
            c = t(c, u),
            m = t(m, h);
        return [p, d, c, m]
    }
    function f(e) {
        var t, i = "";
        for (t = 0; t < 32 * e.length; t += 8)
            i += String.fromCharCode(e[t >> 5] >>> t % 32 & 255);
        return i
    }
    function u(e) {
        var t, i = [];
        for (i[(e.length >> 2) - 1] = void 0,
        t = 0; t < i.length; t += 1)
            i[t] = 0;
        for (t = 0; t < 8 * e.length; t += 8)
            i[t >> 5] |= (255 & e.charCodeAt(t / 8)) << t % 32;
        return i
    }
    function h(e) {
        return f(l(u(e), 8 * e.length))
    }
    function p(e, t) {
        var i, r, n = u(e), o = [], s = [];
        for (o[15] = s[15] = void 0,
        n.length > 16 && (n = l(n, 8 * e.length)),
        i = 0; 16 > i; i += 1)
            o[i] = 909522486 ^ n[i],
            s[i] = 1549556828 ^ n[i];
        return r = l(o.concat(u(t)), 512 + 8 * t.length),
        f(l(s.concat(r), 640))
    }
    function d(e) {
        var t, i, r = "0123456789abcdef", n = "";
        for (i = 0; i < e.length; i += 1)
            t = e.charCodeAt(i),
            n += r.charAt(t >>> 4 & 15) + r.charAt(15 & t);
        return n
    }
    function c(e) {
        return unescape(encodeURIComponent(e))
    }
    function m(e) {
        return h(c(e))
    }
    function g(e) {
        return d(m(e))
    }
    function y(e, t) {
        return p(c(e), c(t))
    }
    function E(e, t) {
        return d(y(e, t))
    }
    function v(e, t, i) {
        return t ? i ? y(t, e) : E(t, e) : i ? m(e) : g(e)
    }
    "function" == typeof define && define.amd ? define(function() {
        return v
    }) : e.md5 = v
}(this),
function() {
    "use strict";
    function e() {}
    function t(e, t) {
        for (var i = e.length; i--; )
            if (e[i].listener === t)
                return i;
        return -1
    }
    function i(e) {
        return function() {
            return this[e].apply(this, arguments)
        }
    }
    var r = e.prototype
      , n = this
      , o = n.EventEmitter;
    r.getListeners = function(e) {
        var t, i, r = this._getEvents();
        if (e instanceof RegExp) {
            t = {};
            for (i in r)
                r.hasOwnProperty(i) && e.test(i) && (t[i] = r[i])
        } else
            t = r[e] || (r[e] = []);
        return t
    }
    ,
    r.flattenListeners = function(e) {
        var t, i = [];
        for (t = 0; t < e.length; t += 1)
            i.push(e[t].listener);
        return i
    }
    ,
    r.getListenersAsObject = function(e) {
        var t, i = this.getListeners(e);
        return i instanceof Array && (t = {},
        t[e] = i),
        t || i
    }
    ,
    r.addListener = function(e, i) {
        var r, n = this.getListenersAsObject(e), o = "object" == typeof i;
        for (r in n)
            n.hasOwnProperty(r) && -1 === t(n[r], i) && n[r].push(o ? i : {
                listener: i,
                once: !1
            });
        return this
    }
    ,
    r.on = i("addListener"),
    r.addOnceListener = function(e, t) {
        return this.addListener(e, {
            listener: t,
            once: !0
        })
    }
    ,
    r.once = i("addOnceListener"),
    r.defineEvent = function(e) {
        return this.getListeners(e),
        this
    }
    ,
    r.defineEvents = function(e) {
        for (var t = 0; t < e.length; t += 1)
            this.defineEvent(e[t]);
        return this
    }
    ,
    r.removeListener = function(e, i) {
        var r, n, o = this.getListenersAsObject(e);
        for (n in o)
            o.hasOwnProperty(n) && (r = t(o[n], i),
            -1 !== r && o[n].splice(r, 1));
        return this
    }
    ,
    r.off = i("removeListener"),
    r.addListeners = function(e, t) {
        return this.manipulateListeners(!1, e, t)
    }
    ,
    r.removeListeners = function(e, t) {
        return this.manipulateListeners(!0, e, t)
    }
    ,
    r.manipulateListeners = function(e, t, i) {
        var r, n, o = e ? this.removeListener : this.addListener, s = e ? this.removeListeners : this.addListeners;
        if ("object" != typeof t || t instanceof RegExp)
            for (r = i.length; r--; )
                o.call(this, t, i[r]);
        else
            for (r in t)
                t.hasOwnProperty(r) && (n = t[r]) && ("function" == typeof n ? o.call(this, r, n) : s.call(this, r, n));
        return this
    }
    ,
    r.removeEvent = function(e) {
        var t, i = typeof e, r = this._getEvents();
        if ("string" === i)
            delete r[e];
        else if (e instanceof RegExp)
            for (t in r)
                r.hasOwnProperty(t) && e.test(t) && delete r[t];
        else
            delete this._events;
        return this
    }
    ,
    r.removeAllListeners = i("removeEvent"),
    r.emitEvent = function(e, t) {
        var i, r, n, o, s = this.getListenersAsObject(e);
        for (n in s)
            if (s.hasOwnProperty(n))
                for (r = s[n].length; r--; )
                    i = s[n][r],
                    i.once === !0 && this.removeListener(e, i.listener),
                    o = i.listener.apply(this, t || []),
                    o === this._getOnceReturnValue() && this.removeListener(e, i.listener);
        return this
    }
    ,
    r.trigger = i("emitEvent"),
    r.emit = function(e) {
        var t = Array.prototype.slice.call(arguments, 1);
        return this.emitEvent(e, t)
    }
    ,
    r.setOnceReturnValue = function(e) {
        return this._onceReturnValue = e,
        this
    }
    ,
    r._getOnceReturnValue = function() {
        return this.hasOwnProperty("_onceReturnValue") ? this._onceReturnValue : !0
    }
    ,
    r._getEvents = function() {
        return this._events || (this._events = {})
    }
    ,
    e.noConflict = function() {
        return n.EventEmitter = o,
        e
    }
    ,
    "function" == typeof define && define.amd ? define(function() {
        return e
    }) : "object" == typeof module && module.exports ? module.exports = e : n.EventEmitter = e
}
.call(this);
var _addressBookProtoBuilder = dcodeIO.ProtoBuf.newBuilder({})["import"]({
    "package": "qihoo.protocol.messages",
    options: {
        java_package: "com.qihoo.contact.cloud.protocol.messages",
        java_outer_classname: "CommunicationData"
    },
    messages: [{
        name: "Pair",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "key",
            id: 1
        }, {
            rule: "optional",
            type: "bytes",
            name: "value",
            id: 2
        }]
    }, {
        name: "Error",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "id",
            id: 1
        }, {
            rule: "optional",
            type: "bytes",
            name: "description",
            id: 2
        }]
    }, {
        name: "User",
        fields: [{
            rule: "required",
            type: "string",
            name: "userid",
            id: 1
        }, {
            rule: "repeated",
            type: "Pair",
            name: "property_pairs",
            id: 2
        }]
    }, {
        name: "Info",
        fields: [{
            rule: "repeated",
            type: "Pair",
            name: "property_pairs",
            id: 1
        }]
    }, {
        name: "RestoreSessionReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "session_id",
            id: 1
        }, {
            rule: "required",
            type: "uint32",
            name: "net_type",
            id: 2
        }]
    }, {
        name: "RestoreSessionResp",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "timestamp",
            id: 1
        }, {
            rule: "optional",
            type: "string",
            name: "client_login_ip",
            id: 2
        }, {
            rule: "optional",
            type: "string",
            name: "server_ip",
            id: 3
        }]
    }, {
        name: "LoginReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "mobile_type",
            id: 1
        }, {
            rule: "required",
            type: "uint32",
            name: "net_type",
            id: 2
        }, {
            rule: "required",
            type: "string",
            name: "server_ram",
            id: 3
        }, {
            rule: "optional",
            type: "bytes",
            name: "secret_ram",
            id: 4
        }, {
            rule: "optional",
            type: "uint32",
            name: "app_id",
            id: 5,
            options: {
                "default": 2e3
            }
        }, {
            rule: "optional",
            type: "uint32",
            name: "heart_feq",
            id: 6,
            options: {
                "default": 300
            }
        }, {
            rule: "optional",
            type: "string",
            name: "deviceid",
            id: 7,
            options: {
                "default": ""
            }
        }, {
            rule: "optional",
            type: "string",
            name: "platform",
            id: 8
        }, {
            rule: "optional",
            type: "string",
            name: "verf_code",
            id: 9
        }]
    }, {
        name: "LoginResp",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "timestamp",
            id: 1
        }, {
            rule: "required",
            type: "string",
            name: "session_id",
            id: 2
        }, {
            rule: "required",
            type: "string",
            name: "session_key",
            id: 3
        }, {
            rule: "optional",
            type: "string",
            name: "client_login_ip",
            id: 4
        }, {
            rule: "optional",
            type: "string",
            name: "serverip",
            id: 5
        }]
    }, {
        name: "ChatReq",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "body",
            id: 1
        }, {
            rule: "optional",
            type: "uint32",
            name: "body_id",
            id: 2
        }, {
            rule: "optional",
            type: "uint32",
            name: "more_flag",
            id: 3
        }, {
            rule: "required",
            type: "uint32",
            name: "body_type",
            id: 4
        }, {
            rule: "optional",
            type: "bool",
            name: "store",
            id: 5
        }, {
            rule: "optional",
            type: "bytes",
            name: "m_parameter",
            id: 6
        }, {
            rule: "optional",
            type: "uint32",
            name: "service_id",
            id: 7
        }, {
            rule: "optional",
            type: "bytes",
            name: "s_parameter",
            id: 8
        }, {
            rule: "optional",
            type: "string",
            name: "conv_id",
            id: 9
        }, {
            rule: "optional",
            type: "bool",
            name: "is_new_conv",
            id: 10,
            options: {
                "default": !1
            }
        }]
    }, {
        name: "ChatResp",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "result",
            id: 1
        }, {
            rule: "optional",
            type: "uint32",
            name: "body_id",
            id: 2
        }]
    }, {
        name: "QueryInfoReq",
        fields: [{
            rule: "required",
            type: "int64",
            name: "last_info_id",
            id: 1
        }, {
            rule: "optional",
            type: "string",
            name: "info_type",
            id: 2
        }]
    }, {
        name: "QueryInfoResp",
        fields: [{
            rule: "required",
            type: "int64",
            name: "last_info_id",
            id: 1
        }, {
            rule: "optional",
            type: "string",
            name: "info_type",
            id: 2
        }]
    }, {
        name: "GetInfoReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "info_type",
            id: 1
        }, {
            rule: "required",
            type: "int64",
            name: "get_info_id",
            id: 2
        }, {
            rule: "optional",
            type: "int32",
            name: "get_info_offset",
            id: 3
        }, {
            rule: "optional",
            type: "bytes",
            name: "s_parameter",
            id: 4
        }]
    }, {
        name: "GetInfoResp",
        fields: [{
            rule: "required",
            type: "string",
            name: "info_type",
            id: 1
        }, {
            rule: "repeated",
            type: "Info",
            name: "infos",
            id: 2
        }, {
            rule: "optional",
            type: "int64",
            name: "last_info_id",
            id: 3
        }, {
            rule: "optional",
            type: "bytes",
            name: "s_parameter",
            id: 4
        }]
    }, {
        name: "LogoutReq",
        fields: [{
            rule: "optional",
            type: "string",
            name: "reason",
            id: 1
        }]
    }, {
        name: "LogoutResp",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "result",
            id: 1
        }]
    }, {
        name: "QueryUserStatusReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "userid",
            id: 1
        }, {
            rule: "optional",
            type: "int32",
            name: "operate",
            id: 2
        }]
    }, {
        name: "QueryUserStatusResp",
        fields: [{
            rule: "required",
            type: "bool",
            name: "online",
            id: 1
        }]
    }, {
        name: "QueryUserRegReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "userid",
            id: 1
        }]
    }, {
        name: "QueryUserRegResp",
        fields: [{
            rule: "required",
            type: "bool",
            name: "result",
            id: 1
        }]
    }, {
        name: "InitLoginReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "client_ram",
            id: 1
        }]
    }, {
        name: "InitLoginResp",
        fields: [{
            rule: "required",
            type: "string",
            name: "client_ram",
            id: 1
        }, {
            rule: "required",
            type: "string",
            name: "server_ram",
            id: 2
        }]
    }, {
        name: "ExQueryUserStatusReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "userid",
            id: 1
        }]
    }, {
        name: "ExQueryUserStatusResp",
        fields: [{
            rule: "required",
            type: "int32",
            name: "status",
            id: 1
        }, {
            rule: "optional",
            type: "uint32",
            name: "app_id",
            id: 2
        }, {
            rule: "optional",
            type: "string",
            name: "mobile_type",
            id: 3
        }, {
            rule: "optional",
            type: "uint32",
            name: "client_ver",
            id: 4
        }]
    }, {
        name: "Service_Req",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "service_id",
            id: 1
        }, {
            rule: "required",
            type: "bytes",
            name: "request",
            id: 2
        }]
    }, {
        name: "Service_Resp",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "service_id",
            id: 1
        }, {
            rule: "required",
            type: "bytes",
            name: "response",
            id: 2
        }]
    }, {
        name: "ReqEQ1User",
        fields: [{
            rule: "required",
            type: "string",
            name: "userid",
            id: 1
        }, {
            rule: "required",
            type: "string",
            name: "user_type",
            id: 2
        }, {
            rule: "optional",
            type: "uint32",
            name: "app_id",
            id: 3
        }]
    }, {
        name: "RespEQ1User",
        fields: [{
            rule: "required",
            type: "string",
            name: "userid",
            id: 1
        }, {
            rule: "required",
            type: "string",
            name: "user_type",
            id: 2
        }, {
            rule: "required",
            type: "int32",
            name: "status",
            id: 3
        }, {
            rule: "optional",
            type: "string",
            name: "jid",
            id: 4
        }, {
            rule: "optional",
            type: "uint32",
            name: "app_id",
            id: 5
        }, {
            rule: "optional",
            type: "string",
            name: "platform",
            id: 6
        }, {
            rule: "optional",
            type: "string",
            name: "mobile_type",
            id: 7
        }, {
            rule: "optional",
            type: "uint32",
            name: "client_ver",
            id: 8
        }]
    }, {
        name: "Ex1QueryUserStatusReq",
        fields: [{
            rule: "repeated",
            type: "ReqEQ1User",
            name: "user_list",
            id: 1
        }]
    }, {
        name: "Ex1QueryUserStatusResp",
        fields: [{
            rule: "repeated",
            type: "RespEQ1User",
            name: "user_list",
            id: 1
        }]
    }, {
        name: "QueryPeerMsgMaxIdReq",
        fields: [{
            rule: "required",
            type: "int64",
            name: "last_info_id",
            id: 1
        }, {
            rule: "required",
            type: "int64",
            name: "unread_info_id",
            id: 2
        }]
    }, {
        name: "QueryPeerMsgMaxIdResp",
        fields: [{
            rule: "required",
            type: "int64",
            name: "last_info_id",
            id: 1
        }, {
            rule: "required",
            type: "int64",
            name: "unread_info_id",
            id: 2
        }]
    }, {
        name: "QueryConvSummaryReq",
        fields: [{
            rule: "required",
            type: "string",
            name: "conv_id",
            id: 1
        }]
    }, {
        name: "QueryConvSummaryResp",
        fields: [{
            rule: "required",
            type: "string",
            name: "conv_id",
            id: 1
        }, {
            rule: "required",
            type: "bytes",
            name: "content",
            id: 2
        }]
    }, {
        name: "Request",
        fields: [{
            rule: "optional",
            type: "RestoreSessionReq",
            name: "restore",
            id: 1
        }, {
            rule: "optional",
            type: "LoginReq",
            name: "login",
            id: 2
        }, {
            rule: "optional",
            type: "ChatReq",
            name: "chat",
            id: 3
        }, {
            rule: "optional",
            type: "QueryInfoReq",
            name: "query_info",
            id: 4
        }, {
            rule: "optional",
            type: "GetInfoReq",
            name: "get_info",
            id: 5
        }, {
            rule: "optional",
            type: "LogoutReq",
            name: "logout",
            id: 6
        }, {
            rule: "optional",
            type: "QueryUserStatusReq",
            name: "query_user",
            id: 7
        }, {
            rule: "optional",
            type: "QueryUserRegReq",
            name: "query_reg",
            id: 8
        }, {
            rule: "optional",
            type: "InitLoginReq",
            name: "init_login_req",
            id: 9
        }, {
            rule: "optional",
            type: "ExQueryUserStatusReq",
            name: "e_query_user",
            id: 10
        }, {
            rule: "optional",
            type: "Service_Req",
            name: "service_req",
            id: 11
        }, {
            rule: "optional",
            type: "Ex1QueryUserStatusReq",
            name: "e1_query_user",
            id: 12
        }, {
            rule: "optional",
            type: "QueryPeerMsgMaxIdReq",
            name: "query_peer_max_id",
            id: 13
        }, {
            rule: "optional",
            type: "QueryConvSummaryReq",
            name: "query_conv_summary",
            id: 14
        }]
    }, {
        name: "Response",
        fields: [{
            rule: "optional",
            type: "Error",
            name: "error",
            id: 1
        }, {
            rule: "optional",
            type: "RestoreSessionResp",
            name: "restore",
            id: 2
        }, {
            rule: "optional",
            type: "LoginResp",
            name: "login",
            id: 3
        }, {
            rule: "optional",
            type: "ChatResp",
            name: "chat",
            id: 4
        }, {
            rule: "optional",
            type: "QueryInfoResp",
            name: "query_info",
            id: 5
        }, {
            rule: "optional",
            type: "GetInfoResp",
            name: "get_info",
            id: 6
        }, {
            rule: "optional",
            type: "LogoutResp",
            name: "logout",
            id: 7
        }, {
            rule: "optional",
            type: "QueryUserStatusResp",
            name: "query_user",
            id: 8
        }, {
            rule: "optional",
            type: "QueryUserRegResp",
            name: "query_reg",
            id: 9
        }, {
            rule: "optional",
            type: "InitLoginResp",
            name: "init_login_resp",
            id: 10
        }, {
            rule: "optional",
            type: "ExQueryUserStatusResp",
            name: "e_query_user",
            id: 11
        }, {
            rule: "optional",
            type: "Service_Resp",
            name: "service_resp",
            id: 12
        }, {
            rule: "optional",
            type: "Ex1QueryUserStatusResp",
            name: "e1_query_user",
            id: 13
        }, {
            rule: "optional",
            type: "QueryPeerMsgMaxIdResp",
            name: "query_peer_max_id",
            id: 14
        }, {
            rule: "optional",
            type: "QueryConvSummaryResp",
            name: "query_conv_summary",
            id: 15
        }]
    }, {
        name: "NewMessageNotify",
        fields: [{
            rule: "required",
            type: "string",
            name: "info_type",
            id: 1
        }, {
            rule: "optional",
            type: "bytes",
            name: "info_content",
            id: 2
        }, {
            rule: "optional",
            type: "int64",
            name: "info_id",
            id: 3
        }, {
            rule: "optional",
            type: "uint32",
            name: "query_after_seconds",
            id: 4
        }]
    }, {
        name: "ReLoginNotify",
        fields: [{
            rule: "optional",
            type: "string",
            name: "new_ip",
            id: 1
        }]
    }, {
        name: "ReConnectNotify",
        fields: [{
            rule: "optional",
            type: "string",
            name: "ip",
            id: 1
        }, {
            rule: "optional",
            type: "uint32",
            name: "port",
            id: 2
        }]
    }, {
        name: "Notify",
        fields: [{
            rule: "optional",
            type: "NewMessageNotify",
            name: "newinfo_ntf",
            id: 1
        }, {
            rule: "optional",
            type: "ReLoginNotify",
            name: "relogin_ntf",
            id: 2
        }, {
            rule: "optional",
            type: "ReConnectNotify",
            name: "reconnect_ntf",
            id: 3
        }]
    }, {
        name: "Ack",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "result",
            id: 1
        }]
    }, {
        name: "RouteInfo",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "username",
            id: 1
        }, {
            rule: "required",
            type: "string",
            name: "msg_exchanger",
            id: 2
        }, {
            rule: "required",
            type: "string",
            name: "msg_router",
            id: 3
        }]
    }, {
        name: "Proxy",
        fields: [{
            rule: "required",
            type: "string",
            name: "sender",
            id: 1
        }, {
            rule: "repeated",
            type: "RouteInfo",
            name: "receiver",
            id: 2
        }]
    }, {
        name: "Message",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "msgid",
            id: 1
        }, {
            rule: "required",
            type: "uint64",
            name: "sn",
            id: 2
        }, {
            rule: "optional",
            type: "string",
            name: "sender",
            id: 3
        }, {
            rule: "optional",
            type: "string",
            name: "receiver",
            id: 4
        }, {
            rule: "optional",
            type: "string",
            name: "receiver_type",
            id: 5
        }, {
            rule: "optional",
            type: "Request",
            name: "req",
            id: 6
        }, {
            rule: "optional",
            type: "Response",
            name: "resp",
            id: 7
        }, {
            rule: "optional",
            type: "Notify",
            name: "notify",
            id: 8
        }, {
            rule: "optional",
            type: "Ack",
            name: "ack",
            id: 9
        }, {
            rule: "optional",
            type: "Proxy",
            name: "proxy_mesg",
            id: 10
        }, {
            rule: "optional",
            type: "uint64",
            name: "client_data",
            id: 11
        }, {
            rule: "optional",
            type: "string",
            name: "sender_type",
            id: 12
        }, {
            rule: "optional",
            type: "string",
            name: "sender_jid",
            id: 13
        }]
    }]
})
  , _chatroomProtoBuilder = dcodeIO.ProtoBuf.newBuilder({})["import"]({
    "package": "qihoo.protocol.chatroom",
    options: {
        java_package: "com.qihoo.contact.cloud.protocol.messages",
        java_outer_classname: "ChatRoom"
    },
    messages: [{
        name: "CRPair",
        fields: [{
            rule: "required",
            type: "string",
            name: "key",
            id: 1
        }, {
            rule: "optional",
            type: "bytes",
            name: "value",
            id: 2
        }]
    }, {
        name: "CRUser",
        fields: [{
            rule: "optional",
            type: "bytes",
            name: "userid",
            id: 1
        }, {
            rule: "optional",
            type: "string",
            name: "name",
            id: 2
        }, {
            rule: "repeated",
            type: "CRPair",
            name: "publicsetting",
            id: 3
        }, {
            rule: "repeated",
            type: "CRPair",
            name: "privatesetting",
            id: 4
        }, {
            rule: "optional",
            type: "int32",
            name: "status",
            id: 5
        }, {
            rule: "optional",
            type: "bytes",
            name: "userdata",
            id: 6
        }]
    }, {
        name: "ChatRoom",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "optional",
            type: "CRUser",
            name: "creater",
            id: 2
        }, {
            rule: "optional",
            type: "string",
            name: "name",
            id: 3
        }, {
            rule: "optional",
            type: "uint64",
            name: "version",
            id: 4
        }, {
            rule: "optional",
            type: "uint64",
            name: "maxmsgid",
            id: 5
        }, {
            rule: "optional",
            type: "uint64",
            name: "memcountlimit",
            id: 6
        }, {
            rule: "optional",
            type: "string",
            name: "roomtype",
            id: 7
        }, {
            rule: "repeated",
            type: "CRPair",
            name: "properties",
            id: 8
        }, {
            rule: "repeated",
            type: "CRUser",
            name: "members",
            id: 9
        }, {
            rule: "repeated",
            type: "bytes",
            name: "blacklist",
            id: 10
        }, {
            rule: "optional",
            type: "string",
            name: "gameid",
            id: 11
        }, {
            rule: "repeated",
            type: "CRUser",
            name: "tempmembers",
            id: 12
        }, {
            rule: "optional",
            type: "bytes",
            name: "partnerdata",
            id: 13
        }]
    }, {
        name: "CreateChatRoomRequest",
        fields: [{
            rule: "optional",
            type: "string",
            name: "gameid",
            id: 1
        }, {
            rule: "optional",
            type: "string",
            name: "roomname",
            id: 2
        }, {
            rule: "optional",
            type: "uint64",
            name: "memcountlimit",
            id: 3
        }, {
            rule: "optional",
            type: "string",
            name: "roomtype",
            id: 4
        }, {
            rule: "repeated",
            type: "CRUser",
            name: "members",
            id: 5
        }, {
            rule: "optional",
            type: "CRUser",
            name: "creater",
            id: 6
        }, {
            rule: "repeated",
            type: "CRPair",
            name: "properties",
            id: 7
        }]
    }, {
        name: "CreateChatRoomResponse",
        fields: [{
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "CreateMultiChatRoomRequest",
        fields: [{
            rule: "repeated",
            type: "CreateChatRoomRequest",
            name: "rooms",
            id: 1
        }, {
            rule: "optional",
            type: "CRUser",
            name: "creater",
            id: 2
        }]
    }, {
        name: "CreateMultiChatRoomResponse",
        fields: [{
            rule: "repeated",
            type: "ChatRoom",
            name: "rooms",
            id: 1
        }, {
            rule: "optional",
            type: "CRUser",
            name: "creater",
            id: 2
        }]
    }, {
        name: "GetChatRoomDetailRequest",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "optional",
            type: "int32",
            name: "index",
            id: 2
        }, {
            rule: "optional",
            type: "int32",
            name: "offset",
            id: 3
        }]
    }, {
        name: "GetChatRoomDetailResponse",
        fields: [{
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "ApplyJoinChatRoomRequest",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 2
        }, {
            rule: "optional",
            type: "int32",
            name: "userid_type",
            id: 3
        }, {
            rule: "optional",
            type: "bytes",
            name: "userdata",
            id: 4
        }]
    }, {
        name: "ApplyJoinChatRoomResponse",
        fields: [{
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "QuitChatRoomRequest",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 2
        }]
    }, {
        name: "QuitChatRoomResponse",
        fields: [{
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "QueryAllGameRoomRequest",
        fields: []
    }, {
        name: "QueryAllGameRoomResponse",
        fields: [{
            rule: "repeated",
            type: "CRPair",
            name: "maplist",
            id: 1
        }]
    }, {
        name: "QueryChatRoomIDRequest",
        fields: [{
            rule: "required",
            type: "string",
            name: "gameid",
            id: 1
        }]
    }, {
        name: "QueryChatRoomIDResponse",
        fields: [{
            rule: "optional",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "optional",
            type: "string",
            name: "gameid",
            id: 2
        }]
    }, {
        name: "UpdateRoomIDRequest",
        fields: [{
            rule: "required",
            type: "string",
            name: "gameid",
            id: 1
        }, {
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 2
        }]
    }, {
        name: "UpdateRoomIDResponse",
        fields: []
    }, {
        name: "UpdateChatRoomRequest",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "required",
            type: "ChatRoom",
            name: "room",
            id: 2
        }]
    }, {
        name: "UpdateChatRoomResponse",
        fields: [{
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "KickChatRoomMemberRequest",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "repeated",
            type: "CRUser",
            name: "members",
            id: 2
        }, {
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 3
        }]
    }, {
        name: "KickChatRoomMemberResponse",
        fields: [{
            rule: "optional",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "SyncRoomToDBRequest",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }]
    }, {
        name: "CreateChatRoomNotify",
        fields: [{
            rule: "required",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "MemberJoinChatRoomNotify",
        fields: [{
            rule: "required",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "MemberQuitChatRoomNotify",
        fields: [{
            rule: "required",
            type: "ChatRoom",
            name: "room",
            id: 1
        }]
    }, {
        name: "KickMemberNotify",
        fields: [{
            rule: "required",
            type: "ChatRoom",
            name: "room",
            id: 1
        }, {
            rule: "optional",
            type: "CRUser",
            name: "user",
            id: 2
        }]
    }, {
        name: "UpdateChatRoomNotify",
        fields: [{
            rule: "required",
            type: "ChatRoom",
            name: "room",
            id: 1
        }, {
            rule: "optional",
            type: "CRUser",
            name: "user",
            id: 2
        }]
    }, {
        name: "ChatRoomMessageRequest",
        fields: [{
            rule: "optional",
            type: "CRUser",
            name: "sender",
            id: 1
        }, {
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 2
        }, {
            rule: "required",
            type: "int32",
            name: "msgtype",
            id: 3
        }, {
            rule: "optional",
            type: "bytes",
            name: "msgcontent",
            id: 4
        }, {
            rule: "optional",
            type: "bytes",
            name: "clientparameter",
            id: 5
        }, {
            rule: "optional",
            type: "bytes",
            name: "clientcache",
            id: 6
        }, {
            rule: "optional",
            type: "CreateChatRoomNotify",
            name: "createnotify",
            id: 7
        }, {
            rule: "optional",
            type: "MemberJoinChatRoomNotify",
            name: "joinnotify",
            id: 8
        }, {
            rule: "optional",
            type: "MemberQuitChatRoomNotify",
            name: "quitnotify",
            id: 9
        }, {
            rule: "optional",
            type: "KickMemberNotify",
            name: "kicknotify",
            id: 10
        }, {
            rule: "optional",
            type: "UpdateChatRoomNotify",
            name: "updatenotify",
            id: 11
        }, {
            rule: "repeated",
            type: "CRPair",
            name: "propertylist",
            id: 12
        }]
    }, {
        name: "ChatRoomMessageResponse",
        fields: [{
            rule: "optional",
            type: "uint64",
            name: "msgid",
            id: 1
        }]
    }, {
        name: "ChatRoomNewMsg",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "optional",
            type: "CRUser",
            name: "sender",
            id: 2
        }, {
            rule: "optional",
            type: "int32",
            name: "msgtype",
            id: 3
        }, {
            rule: "optional",
            type: "bytes",
            name: "msgcontent",
            id: 4
        }, {
            rule: "optional",
            type: "int32",
            name: "regmemcount",
            id: 5
        }, {
            rule: "optional",
            type: "int32",
            name: "memcount",
            id: 6
        }]
    }, {
        name: "ChatRoomErrorMsg",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "required",
            type: "uint64",
            name: "clientsn",
            id: 2
        }, {
            rule: "optional",
            type: "int32",
            name: "errorcode",
            id: 3
        }]
    }, {
        name: "ChatRoomMNotify",
        fields: [{
            rule: "required",
            type: "int32",
            name: "type",
            id: 1
        }, {
            rule: "required",
            type: "bytes",
            name: "data",
            id: 2
        }, {
            rule: "optional",
            type: "int32",
            name: "regmemcount",
            id: 3
        }, {
            rule: "optional",
            type: "int32",
            name: "memcount",
            id: 4
        }]
    }, {
        name: "ChatRoomUpToServer",
        fields: [{
            rule: "required",
            type: "uint32",
            name: "payloadtype",
            id: 1
        }, {
            rule: "optional",
            type: "CreateChatRoomRequest",
            name: "createchatroomreq",
            id: 2
        }, {
            rule: "optional",
            type: "GetChatRoomDetailRequest",
            name: "getchatroominforeq",
            id: 3
        }, {
            rule: "optional",
            type: "ApplyJoinChatRoomRequest",
            name: "applyjoinchatroomreq",
            id: 4
        }, {
            rule: "optional",
            type: "QuitChatRoomRequest",
            name: "quitchatroomreq",
            id: 5
        }, {
            rule: "optional",
            type: "UpdateChatRoomRequest",
            name: "updatechatroomreq",
            id: 6
        }, {
            rule: "optional",
            type: "KickChatRoomMemberRequest",
            name: "kickmemberreq",
            id: 7
        }, {
            rule: "optional",
            type: "QueryChatRoomIDRequest",
            name: "querychatroomidreq",
            id: 8
        }, {
            rule: "optional",
            type: "UpdateRoomIDRequest",
            name: "updategameidreq",
            id: 9
        }, {
            rule: "optional",
            type: "QueryAllGameRoomRequest",
            name: "queryallgameroomreq",
            id: 10
        }, {
            rule: "optional",
            type: "ChatRoomMessageRequest",
            name: "chatroommessagereq",
            id: 11
        }, {
            rule: "optional",
            type: "CreateMultiChatRoomRequest",
            name: "createrooms",
            id: 12
        }, {
            rule: "optional",
            type: "SyncRoomToDBRequest",
            name: "syncroomtodba",
            id: 13
        }]
    }, {
        name: "ChatRoomDownToUser",
        fields: [{
            rule: "required",
            type: "int32",
            name: "result",
            id: 1
        }, {
            rule: "required",
            type: "uint32",
            name: "payloadtype",
            id: 2
        }, {
            rule: "optional",
            type: "CreateChatRoomResponse",
            name: "createchatroomresp",
            id: 3
        }, {
            rule: "optional",
            type: "GetChatRoomDetailResponse",
            name: "getchatroominforesp",
            id: 4
        }, {
            rule: "optional",
            type: "ApplyJoinChatRoomResponse",
            name: "applyjoinchatroomresp",
            id: 5
        }, {
            rule: "optional",
            type: "QuitChatRoomResponse",
            name: "quitchatroomresp",
            id: 6
        }, {
            rule: "optional",
            type: "UpdateChatRoomResponse",
            name: "updatechatroomresp",
            id: 7
        }, {
            rule: "optional",
            type: "KickChatRoomMemberResponse",
            name: "kickmemberresp",
            id: 8
        }, {
            rule: "optional",
            type: "QueryChatRoomIDResponse",
            name: "querychatroomidresp",
            id: 9
        }, {
            rule: "optional",
            type: "UpdateRoomIDResponse",
            name: "updategameidresp",
            id: 10
        }, {
            rule: "optional",
            type: "QueryAllGameRoomResponse",
            name: "queryallgameroomresp",
            id: 11
        }, {
            rule: "optional",
            type: "ChatRoomMessageResponse",
            name: "chatroommessageresp",
            id: 12
        }, {
            rule: "optional",
            type: "ChatRoomNewMsg",
            name: "newmsgnotify",
            id: 13
        }, {
            rule: "optional",
            type: "ChatRoomErrorMsg",
            name: "errormsgnotify",
            id: 14
        }, {
            rule: "optional",
            type: "CreateMultiChatRoomResponse",
            name: "createrooms",
            id: 15
        }, {
            rule: "optional",
            type: "MemberJoinChatRoomNotify",
            name: "memberjoinnotify",
            id: 16
        }, {
            rule: "optional",
            type: "MemberQuitChatRoomNotify",
            name: "memberquitnotify",
            id: 17
        }, {
            rule: "optional",
            type: "bytes",
            name: "reason",
            id: 100
        }, {
            rule: "repeated",
            type: "ChatRoomMNotify",
            name: "multinotify",
            id: 200
        }]
    }, {
        name: "ChatRoomPacket",
        fields: [{
            rule: "required",
            type: "bytes",
            name: "roomid",
            id: 1
        }, {
            rule: "optional",
            type: "ChatRoomUpToServer",
            name: "to_server_data",
            id: 2
        }, {
            rule: "optional",
            type: "ChatRoomDownToUser",
            name: "to_user_data",
            id: 3
        }, {
            rule: "optional",
            type: "string",
            name: "uuid",
            id: 4
        }, {
            rule: "optional",
            type: "uint64",
            name: "client_sn",
            id: 5
        }, {
            rule: "optional",
            type: "uint32",
            name: "appid",
            id: 6
        }]
    }]
});
!function(e) {
    function t(e, t) {
        if (e && t && "object" == typeof t) {
            var i, r, n;
            for (i in t)
                e[i] = t[i];
            if (h)
                for (r = h.length; r--; )
                    n = h[r],
                    t.hasOwnProperty(n) && (e[n] = t[n])
        }
        return e
    }
    function i(e, t, i) {
        var r = String(e);
        for (i = i || " "; r.length < t; )
            r = i + r;
        return r
    }
    function r(e, t) {
        for (var i = [], r = t ? c.slice(0, 10) : c, n = 0; e > n; n++)
            i.push(r.charAt(Math.floor(Math.random() * r.length)));
        return i.join("")
    }
    function n(e) {
        return parseInt(r(e, !0), 10)
    }
    function o(e) {
        var t = "Unknow";
        for (var i in S)
            if (S[i] == e) {
                t = i;
                break
            }
        return t + "[" + e + "]"
    }
    function s(e) {
        var t = "360tantan@1408$";
        return md5(e + t).substring(24)
    }
    var a = e.dcodeIO.ByteBuffer
      , l = e.RC4
      , f = e.Base64
      , u = e.navigator.userAgent.toLowerCase()
      , h = ["hasOwnProperty", "valueOf", "isPrototypeOf", "propertyIsEnumerable", "toLocaleString", "toString", "constructor"]
      , p = function() {}
      , d = 0
      , c = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
      , m = console && console.log ? function() {
        console.log.apply(console, arguments)
    }
    : p
      , g = {
        wp: function() {
            return -1 !== u.indexOf("windows phone ") ? /\bwindows phone (?:os )?([0-9.]+)/ : -1 !== u.indexOf("xblwp") ? /\bxblwp([0-9.]+)/ : -1 !== u.indexOf("zunewp") ? /\bzunewp([0-9.]+)/ : /\bwindows phone/
        }().test(u),
        ios: function() {
            return /\bcpu(?: iphone)? os /.test(u) ? /\bcpu(?: iphone)? os ([0-9._]+)/ : -1 !== u.indexOf("iph os ") ? /\biph os ([0-9_]+)/ : /\bios\b/
        }().test(u),
        android: function() {
            return -1 !== u.indexOf("android") ? /\bandroid[ \/-]?([0-9.x]+)?/ : -1 !== u.indexOf("adr") ? -1 !== u.indexOf("mqqbrowser") ? /\badr[ ]\(linux; u; ([0-9.]+)?/ : /\badr(?:[ ]([0-9.]+))?/ : /\bandroid/
        }().test(u)
    }
      , y = "w7h6VMOWbcKqCGA="
      , E = "wqh+VMKMO8KrCzE="
      , v = "w7kvUsOXOMO9DGc="
      , w = "w7IsVcKOPsO+Dmg="
      , b = "w7IiVcKMO8K+Dzg="
      , T = "w7I6VMOOOMO9DGc="
      , R = 1
      , I = "socket" + (R ? "" : y + E + v + w) + "io"
      , _ = function() {
        function e(e) {
            return l.decode(f.decode(e), I)
        }
        var t = e(y)
          , i = e(E)
          , r = e(v)
          , n = e(w)
          , o = e(b)
          , s = e(T);
        return t + i + r + n + (R ? "" : o + s)
    }()
      , S = {
        RestoreSessionReq: 1e5,
        LoginReq: 100001,
        ChatReq: 100002,
        QueryInfoReq: 100003,
        GetInfoReq: 100004,
        LogoutReq: 100005,
        QueryUserStatusReq: 100007,
        QueryUserRegReq: 100008,
        InitLoginReq: 100009,
        ExQueryUserStatusReq: 100010,
        Service_Req: 100011,
        Ex1QueryUserStatusReq: 100012,
        QueryPeerMsgMaxIdReq: 100013,
        QueryConvSummaryReq: 100014,
        UpdateSessionReq: 100015,
        RestoreSessionResp: 2e5,
        LoginResp: 200001,
        ChatResp: 200002,
        QueryInfoResp: 200003,
        GetInfoResp: 200004,
        LogoutResp: 200005,
        QueryUserStatusResp: 200007,
        QueryUserRegResp: 200008,
        InitLoginResp: 200009,
        ExQueryUserStatusResp: 200010,
        Service_Resp: 200011,
        Ex1QueryUserStatusResp: 200012,
        QueryPeerMsgMaxIdResp: 200013,
        QueryConvSummaryResp: 200014,
        UpdateSessionResp: 200015,
        NewMessageNotify: 3e5,
        ReLoginNotify: 300001,
        ReConnectNotify: 300002
    }
      , P = {
        ERR_CLIENT_VER_LOWER: 1e3,
        ERR_REQUEST_PACKET_SEQ: 1001,
        ERR_LOGIN_FAILED: 1002,
        ERROR_INVALID_SENDER: 1003,
        ERROR_HIGHER_FREQUENCY: 1004,
        ERROR_UNKNOW_CHAR_TYPE: 1005,
        ERROR_DB_EXCEPTION: 1006,
        ERROR_SES_EXCEPTION: 1007,
        ERROR_PASSWD_INVALID: 1008,
        ERROR_DB_INNER: 2e3,
        ERROR_SES_INNER: 2001,
        ERROR_NO_FOUND_USER: 3e3,
        ERROR_GROUP_USER_KICKED: 4e3,
        Socket_Error: 4294967040,
        Unable_To_Connect_Server: 4294967041
    }
      , L = {
        successful: 0,
        applyjoinchatroomresp: 102,
        quitchatroomresp: 103,
        newmsgnotify: 1e3,
        memberjoinnotify: 1001,
        memberquitnotify: 1002
    }
      , N = function() {
        this._init.apply(this, arguments)
    }
      , A = N.prototype;
    A.defaultConfig = {
        flag: "qh",
        protocolVersion: 1,
        clientVersion: 101,
        appId: 2080,
        defaultKey: _,
        reserved: "",
        senderType: "jid",
        wsServer: "ws://bridge.huajiao.com",
        timeout: 2e4
    },
    A._init = function(i) {
        var n = this;
        if (this.config = t(t({}, this.defaultConfig), i),
        !this.config.roomId)
            throw new Error("WebSocketIO初始化失败：缺少roomId");
        this.config.roomId = String(this.config.roomId),
        this.config.sender = String(this.config.userId) || String(this.config.sender),
        this.config.sender || (this.config.sender = r(11, !0) + Date.now()),
        this.config.password || (this.config.password = this.config.sender),
        e._addressBookProtoBuilder && e._chatroomProtoBuilder ? (this._addressBookProto = e._addressBookProtoBuilder,
        this._chatroomProto = e._chatroomProtoBuilder) : m("WebSocketIO初始化失败：缺少必要的proto文件"),
        this.ee = new EventEmitter;
        var o = EventEmitter.prototype;
        for (var s in o)
            o.hasOwnProperty(s) && !/^_/.test(s) && (this[s] = this._createEventHandle(s));
        this.connect(),
        e.onbeforeunload = function() {
            n.socket.onclose = function() {}
            ,
            n.close()
        }
    }
    ,
    A._createEventHandle = function(e) {
        var t = this.ee;
        return function() {
            t[e].apply(t, arguments)
        }
    }
    ,
    A._createSocketHandle = function(e) {
        var t = this;
        return function() {
            t["_handle" + e.charAt(0).toUpperCase() + e.slice(1)].apply(t, arguments)
        }
    }
    ,
    A._getProtoMessage = function(e, t) {
        this._protoMessageClasses = this._protoMessageClasses || {},
        this._protoMessageClasses[e] = this._protoMessageClasses[e] || {};
        var i = this._protoMessageClasses[e][t];
        return i || (i = this["_" + e + "Proto"].build(t),
        this._protoMessageClasses[e][t] = i),
        i
    }
    ,
    A._newAddressBookMessage = function(e, t) {
        var i = this._getProtoMessage("addressBook", "qihoo.protocol.messages." + e);
        return new i(t)
    }
    ,
    A._newChatroomMessage = function(e, t) {
        var i = this._getProtoMessage("chatroom", "qihoo.protocol.chatroom." + e);
        return new i(t)
    }
    ,
    A._newAddressBookRequestMessage = function(e, t, i) {
        var r = this.config;
        return this._sn = i || n(10),
        this._newAddressBookMessage("Message", {
            msgid: e,
            sn: this._sn,
            sender: r.sender,
            sender_type: r.senderType,
            req: this._newAddressBookMessage("Request", t)
        })
    }
    ,
    A._newChatroomRequestMessage = function(e) {
        var t = this.config
          , n = new a(t.roomId.length).writeString(t.roomId).flip().toArrayBuffer();
        return this._newChatroomMessage("ChatRoomPacket", {
            client_sn: this._sn,
            roomid: n,
            appid: t.appId,
            uuid: md5(r(10) + i(++d, 10, "0") + Date.now()),
            to_server_data: this._newChatroomMessage("ChatRoomUpToServer", e)
        })
    }
    ,
    A._parseAddressBookMessage = function(e) {
        return this._getProtoMessage("addressBook", "qihoo.protocol.messages.Message").decode(e)
    }
    ,
    A._parseChatroomMessage = function(e) {
        return this._getProtoMessage("chatroom", "qihoo.protocol.chatroom.ChatRoomPacket").decode(e)
    }
    ,
    A._handleOpen = function(e) {
        this.connectTryTimes = 0,
        this.connected = !0,
        this.handshake || this._sendHandshakePack()
    }
    ,
    A._handleClose = function(e) {
        this._clearStatus(),
        this.emit("close")
    }
    ,
    A._handleError = function(e) {
        this.connectTryTimes = 0 | this.connectTryTimes,
        this.connectTryTimes < 3 ? (++this.connectTryTimes,
        this.reconnect()) : this.emit("error")
    }
    ,
    A._handleMessage = function(e) {
        this.handshake ? this.session ? this._processMessagePack(e.data) : this._processLoginPack(e.data) : this._processHandShakePack(e.data)
    }
    ,
    A._sendHandshakePack = function() {
        var e = this.config
          , t = 0
          , i = new a(12);
        i.writeString(e.flag).writeInt8(e.protocolVersion << 4).writeInt8(e.clientVersion).writeInt16(e.appId).writeInt32(0).writeInt16(0),
        t += i.view.byteLength,
        t += 4;
        var n = this._newAddressBookRequestMessage(S.InitLoginReq, {
            init_login_req: this._newAddressBookMessage("InitLoginReq", {
                client_ram: r(10)
            })
        })
          , o = l.encode(new Uint8Array(n.toArrayBuffer()), e.defaultKey);
        t += o.byteLength,
        i.writeInt32(t).append(o).flip(),
        this._send(i.toArrayBuffer())
    }
    ,
    A._processHandShakePack = function(e) {
        var t, i = this.config, r = new a(6);
        r.append(e);
        try {
            var n = r.readString(2, a.METRICS_CHARS, 0).string;
            if (n !== i.flag)
                throw new Error("服务器响应标识（flag）有误");
            r = r.slice(6, r.view.byteLength);
            try {
                t = this._parseAddressBookMessage(l.decode(r.toArrayBuffer(), i.defaultKey).buffer)
            } catch (s) {
                throw new Error("解析消息体异常")
            }
            if (t.msgid !== S.InitLoginResp)
                throw new Error("响应msgid异常，msgid == " + t.msgid);
            if (!this._sn || !t.sn || !t.sn.equals(this._sn))
                throw new Error("sn验证失败, Message Type: " + o(t.msgid));
            this.handshake = !0,
            this.emit("handshake"),
            this._sendLoginPack(t.resp)
        } catch (s) {
            this.close(),
            m("WebSocketIO握手失败", s),
            this.emit("handshakefail")
        }
    }
    ,
    A._sendLoginPack = function(e) {
        var t = this.config
          , i = t.password
          , n = 4
          , o = new a(4)
          , f = e.init_login_resp.server_ram;
        try {
            var u = this._newAddressBookRequestMessage(S.LoginReq, {
                login: this._newAddressBookMessage("LoginReq", {
                    app_id: t.appId,
                    server_ram: f,
                    secret_ram: l.encode(new a(f.length + 8).writeString(f + r(8)).view, i),
                    verf_code: s(t.sender),
                    net_type: 4,
                    mobile_type: g.android ? "android" : g.ios ? "ios" : "pc"
                })
            })
              , h = l.encode(new Uint8Array(u.toArrayBuffer()), t.defaultKey);
            n += h.byteLength,
            o.writeInt32(n).append(h).flip(),
            this._send(o.toArrayBuffer())
        } catch (p) {
            this.close(),
            m("WebSocketIO登录失败：登录包发送失败", p)
        }
    }
    ,
    A._processLoginPack = function(e) {
        var t, i = this.config, r = i.password, n = new a(4);
        n.append(e);
        try {
            n = n.slice(4, n.view.byteLength);
            try {
                t = this._parseAddressBookMessage(l.decode(n.toArrayBuffer(), r).buffer)
            } catch (s) {
                try {
                    t = this._parseAddressBookMessage(l.decode(n.toArrayBuffer(), i.defaultKey).buffer)
                } catch (f) {
                    throw new Error("解析消息体异常")
                }
            }
            if (t.msgid !== S.LoginResp)
                throw new Error("响应msgid异常，msgid == " + t.msgid);
            if (!this._sn || !t.sn || !t.sn.equals(this._sn))
                throw new Error("sn验证失败, Message Type: " + o(t.msgid));
            t = t.resp,
            this._checkResponseError(t),
            this.session = t.login.session_key,
            this.emit("login"),
            this._sendJoinChatroomPack(),
            this._initHeartBeat()
        } catch (s) {
            this.close(),
            m("WebSocketIO登录失败", s),
            this.emit("loginfail")
        }
    }
    ,
    A._checkResponseError = function(e) {
        if (e.error) {
            var t;
            for (var i in P)
                if (P[i] == e.error.id) {
                    t = i;
                    break
                }
            throw new Error("Error " + (t ? t + "[" + e.error.id + "]" : "Code " + e.error.id))
        }
    }
    ,
    A._sendJoinChatroomPack = function() {
        var e = this
          , t = this.config
          , i = 4
          , r = new a(4)
          , n = new a(t.roomId.length).writeString(t.roomId).flip().toArrayBuffer();
        if (this.session)
            try {
                var o = this._newAddressBookRequestMessage(S.Service_Req, {
                    service_req: this._newAddressBookMessage("Service_Req", {
                        service_id: 10000006,
                        request: this._newChatroomRequestMessage({
                            payloadtype: 102,
                            applyjoinchatroomreq: this._newChatroomMessage("ApplyJoinChatRoomRequest", {
                                roomid: n,
                                room: this._newChatroomMessage("ChatRoom", {
                                    roomid: n
                                }),
                                userid_type: 0
                            })
                        }).toArrayBuffer()
                    })
                })
                  , s = l.encode(new Uint8Array(o.toArrayBuffer()), this.session);
                i += s.byteLength,
                r.writeInt32(i).append(s).flip(),
                this._send(r.toArrayBuffer()),
                this._joinChatroomTimeout = setTimeout(function() {
                    clearTimeout(e._joinChatroomTimeout),
                    e._joinChatroomTimeout = null ,
                    e.emit("joinchatroomfail"),
                    m("加入聊天室失败：响应超时")
                }, this.config.timeout)
            } catch (f) {
                this.emit("joinchatroomfail"),
                m("加入聊天室失败：加入聊天室包发送失败", f)
            }
    }
    ,
    A._sendQuitChatroomPack = function() {
        var e = this
          , t = this.config
          , i = 4
          , r = new a(4)
          , n = new a(t.roomId.length).writeString(t.roomId).flip().toArrayBuffer();
        if (this.session)
            try {
                var o = this._newAddressBookRequestMessage(S.Service_Req, {
                    service_req: this._newAddressBookMessage("Service_Req", {
                        service_id: 10000006,
                        request: this._newChatroomRequestMessage({
                            payloadtype: 103,
                            quitchatroomreq: this._newChatroomMessage("QuitChatRoomRequest", {
                                roomid: n,
                                room: this._newChatroomMessage("ChatRoom", {
                                    roomid: n
                                })
                            })
                        }).toArrayBuffer()
                    })
                })
                  , s = l.encode(new Uint8Array(o.toArrayBuffer()), this.session);
                i += s.byteLength,
                r.writeInt32(i).append(s).flip(),
                this._send(r.toArrayBuffer()),
                this._quitChatroomTimeout = setTimeout(function() {
                    clearTimeout(e._quitChatroomTimeout),
                    e._quitChatroomTimeout = null ,
                    e.emit("quitchatroomfail"),
                    m("退出聊天室失败：响应超时")
                }, this.config.timeout)
            } catch (f) {
                this.emit("quitchatroomfail"),
                m("退出聊天室失败：退出聊天室包发送失败", f)
            }
    }
    ,
    A._initHeartBeat = function() {
        var e = this;
        this._heartbeatTimer = setInterval(function() {
            e._sendHeartbeatPack()
        }, 6e4)
    }
    ,
    A._sendHeartbeatPack = function() {
        var e = this;
        this._send(new a(4).writeInt32(0).buffer),
        this._heartbeatTimeout = setTimeout(function() {
            clearTimeout(this._heartbeatTimeout),
            this._heartbeatTimeout = null ,
            e.reconnect()
        }, this.config.timeout)
    }
    ,
    A._processHeartbeatPack = function(e) {
        clearTimeout(this._heartbeatTimeout),
        this._heartbeatTimeout = null
    }
    ,
    A._processMessagePack = function(e) {
        var t;
        if (!this.session)
            return m("WebSocketIO处理消息失败：没有登录"),
            void this.reconnect();
        var i = new a(4);
        if (i.append(e),
        4 === i.view.byteLength && 0 === i.readInt32(0))
            return void this._processHeartbeatPack();
        try {
            i = i.slice(4, i.view.byteLength);
            try {
                t = this._parseAddressBookMessage(l.decode(i.toArrayBuffer(), this.session).buffer)
            } catch (r) {
                throw new Error("解析消息体异常")
            }
            var n = this._getMessageHandler(t.msgid);
            n && n.call(this, t)
        } catch (r) {
            m("WebSocketIO处理消息失败", r)
        }
    }
    ,
    A._getMessageHandler = function(e) {
        for (var t in S)
            if (S[t] == e)
                return this["_process" + t + "Message"]
    }
    ,
    A._processService_RespMessage = function(e) {
        if (!this._sn || !e.sn || !e.sn.equals(this._sn))
            throw new Error("sn验证失败, Message Type: " + o(e.msgid));
        var t = this._parseChatroomMessage(e.resp.service_resp.response)
          , i = t.to_user_data;
        if (i.payloadtype === L.applyjoinchatroomresp || i.applyjoinchatroomresp)
            if (clearTimeout(this._joinChatroomTimeout),
            this._joinChatroomTimeout = null ,
            i.result === L.successful) {
                var r = parseInt(i.applyjoinchatroomresp.room.properties[1].value.toUTF8(), 10)
                  , n = i.applyjoinchatroomresp.room.partnerdata && JSON.parse(i.applyjoinchatroomresp.room.partnerdata.toUTF8())
                  , s = i.applyjoinchatroomresp.room.partnerdata && JSON.parse(i.applyjoinchatroomresp.room.partnerdata.toUTF8())["extends"].watches;
                this.emit("joinchatroom", r, n.audiences, s)
            } else
                this.emit("joinchatroomfail");
        else
            (i.payloadtype === L.quitchatroomresp || i.quitchatroomresp) && (clearTimeout(this._quitChatroomTimeout),
            this._quitChatroomTimeout = null ,
            i.result === L.successful ? this.emit("quitchatroom") : this.emit("quitchatroomfail"))
    }
    ,
    A._processNewMessageNotifyMessage = function(e) {
        var t, i, r = this._parseChatroomMessage(e.notify.newinfo_ntf.info_content), n = r.to_user_data;
        try {
				  if (n && n.result === L.successful){
					  if (n.payloadtype === L.newmsgnotify && n.newmsgnotify){
						  0 === n.newmsgnotify.msgtype && (i = 0 | n.newmsgnotify.memcount,
						  t = n.newmsgnotify.msgcontent,
						  t = t && t.toUTF8(),
						  t = t && JSON.parse(t),
						  getMsg(t),
						  t && this.emit("message", t, i));
					  }else if (n.payloadtype === L.memberjoinnotify && n.memberjoinnotify) {
						  try {
							  i = parseInt(n.memberjoinnotify.room.properties[1].value.toUTF8(), 10),
							  t = n.memberjoinnotify.room.members[0].userdata,
							  t = t && t.toUTF8(),
							  t = t && JSON.parse(t)
						  } catch (o) {}
						  this.emit("memberjoin", t, i)
					  } else if (n.payloadtype === L.memberquitnotify && n.memberquitnotify) {
						  try {
							  i = parseInt(n.memberquitnotify.room.properties[0].value.toUTF8(), 10),
							  t = n.memberquitnotify.room.members[0].userid,
							  t = t && t.toUTF8()
						  } catch (o) {}
						  this.emit("memberquit", t, i)
				  	 }
				  }
        } catch (o) {}
    }
    ,
    A._send = function(e) {
        this.connected && this.socket && this.socket.send(e)
    }
    ,
    A.connect = function() {
        this.socket = new WebSocket(this.config.wsServer),
        this.socket.binaryType = "arraybuffer",
        this.socket.onopen = this._createSocketHandle("open"),
        this.socket.onmessage = this._createSocketHandle("message"),
        this.socket.onclose = this._createSocketHandle("close"),
        this.socket.onerror = this._createSocketHandle("error")
    }
    ,
    A.reconnect = function() {
        this.close(),
        this.connect()
    }
    ,
    A._clearStatus = function() {
        clearTimeout(this._heartbeatTimeout),
        clearInterval(this._heartbeatTimer),
        clearTimeout(this._joinChatroomTimeout),
        clearTimeout(this._quitChatroomTimeout),
        this.connected = !1,
        this.handshake = !1,
        this.session = null
    }
    ,
    A.close = function() {
        this._sendQuitChatroomPack(),
        this._clearStatus(),
        this.socket && (this.socket.close(),
        this.socket = null )
    }
    ,
    A.destroy = function() {
        this.destroyed || (this.destroyed = !0,
        this.close(),
        this.removeEvent(),
        this.emit("destroy"))
    }
    ,
    e.WebSocketIO = N
}(window);