/*
 ** !obj.hoge -> false -> さらに否定する -> true
 */
const obj = { hoge: 'hoge' }
function hasHoge() {
  return !!obj.hoge
}

console.log(hasHoge());
