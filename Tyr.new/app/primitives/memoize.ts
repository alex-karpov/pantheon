// Taken from https://github.com/anywhichway/nano-memoize as is - DON'T TOUCH THIS TRASH. You've been warned.

let assign = Object.assign;
function vrgs(f: any) {
  let s = f + "",
    i = s.indexOf("...");
  return i >= 0 && (i < s.indexOf(")") || s.indexOf("arguments") >= 0);
}

export function memoize<T extends Function>(fn: T, o?: any): T {
  /*o = {
    serializer, // used to serialize arguments of single argument functions, multis are not serialized
    equals, // equality tester, will force use of slower multiarg approach even for single arg functions
    maxAge, // max cache age is ms, set > 0 && < Infinity if you want automatic clearing
    maxArgs, // max args to use for signature
    vargs = vrgs(fn) // set to true if function may have variable or beyond-signature arguments, default is best attempt at infering
    } = {}
  */
  o || (o = {});
  let vargs = o.vargs || vrgs(fn),
    s = Object.create(null), // single arg function key/value cache
    k: any[] = [], // multiple arg function arg key cache
    v: any[] = [], // multiple arg function result cache
    wm = new WeakMap(),
    d = function (key: any, c: any, k: any) {
      return setTimeout(function () {
        if (k) { // dealing with multi-arg function, c and k are Arrays
          c.splice(key, 1);
          k.splice(key, 1);
          return;
        } // dealing with single arg function, c is a WekMap or Object
        c instanceof WeakMap ? c.delete(key) : delete c[key];
      }, o.maxAge);
    },
    c: any = o.maxAge > 0 && o.maxAge < Infinity ? d : 0, // cache change timeout,
    eq = o.equals ? o.equals : function (a: any, b: any) {
      return a === b;
    },
    maxargs = o.maxArgs,
    srlz = o.serializer,
    f: any, // memoized function to return
    u: any; // flag indicating a unary arg function is in use for clear operation
  if (fn.length === 1 && !o.equals && !vargs) {
    // for single argument functions, just use a JS object key look-up
    f = (function (a: any) {
      // strings must be serialized because cache[1] should not equal or overwrite cache["1"] for value = 1 and value = "1"
      let t = typeof a;
      // set chng timeout only when new value computed, hits will not push out the tte, but it is arguable they should not
      if (!srlz && ((t === "object" && a) || t === "function")) {
        let r;
        // @ts-ignore
        return wm.get(a) || ((!c || c(a, wm)), wm.set(a, r = fn.call(this, a)), r);
      }
      let key = t === "number" || t === "boolean" || a == null ? a : t === "string" ? JSON.stringify(a) : srlz(a);
      // @ts-ignore
      return s[key] || ((!c || c(key, s)), s[key] = fn.call(this, a));
      // @ts-ignore
    }).bind(this);
    u = 1;
  } else {
    // for multiple arg functions, loop through a cache of all the args
    // looking at each arg separately so a test can abort as soon as possible
    f = (function () {
      let l = maxargs || arguments.length,
        i;
      for (i = k.length - 1; i >= 0; i--) { // an array of arrays of args, each array represents a call signature
        if (!maxargs && k[i].length !== l) continue; // cache miss if called with a different number of args
        for (let j = l - 1; j >= 0 && eq(k[i][j], arguments[j]); j--) {	// compare each arg
          if (j === 0) {
            return v[i];
          } // the args matched
        }
      }
      i = k.length - (i + 1);
      // set change timeout only when new value computed, hits will not push out the tte, but it is arguable they should not
      // @ts-ignore
      return (!c || c(i, v, k)), v[i] = fn.apply(this, k[i] = arguments);
      // @ts-ignore
    }).bind(this);
  }
  // reset all the caches
  f.clear = function () {
    wm = new WeakMap();
    s = Object.create(null);
    k = [];
    v = [];
  };
  f.keys = function () {
    return u ? null : k.slice();
  };
  f.values = function () {
    return u ? null : v.slice();
  };
  f.keyValues = function () {
    return u ? { primitives: assign({}, s), objects: wm } : null;
  };
  return f;
}
