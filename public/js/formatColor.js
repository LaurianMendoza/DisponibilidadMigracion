//no le muevas si jala
function argbToRGB(color) {
    return '#'+ ('000000' + (color & 0xFFFFFF).toString(16)).slice(-6);
}
