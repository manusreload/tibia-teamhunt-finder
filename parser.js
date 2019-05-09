
minimap_max_x = 132;
minimap_max_y = 129;

minimap_get_coords = function(url, varname) {
    url = decodeURI(url);
    if (typeof varname == 'undefined') { varname = 'coords'; }
    var pars = [], tmpp = url.split(varname + '='); tmpp.shift(); tmpp = tmpp.join('').split('&')[0];
    if (varname == 'coords') {
//0x.1x,2y.3y,4z,5zoom,6zoomm,7centermark
        if (tmpp === '' || (tmpp = tmpp.split(/[,-]/)).length < 3) { pars = [127, 128, 124, 128, 7, 1, 1, 1]; }
        else {
            pars[0] = parseInt(tmpp[0].split('.')[0] || 127, 10);
            pars[1] = parseInt(tmpp[0].split('.')[1] || 0, 10);
            pars[2] = parseInt(tmpp[1].split('.')[0] || 124, 10);
            pars[3] = parseInt(tmpp[1].split('.')[1] || 0, 10);
            pars[4] = parseInt(tmpp[2] || 7, 10);
            pars[5] = parseFloat(tmpp[3] || 1);
            pars[6] = parseFloat(tmpp[4] || 1);
            pars[7] = parseInt(tmpp[5] || 1, 10);
            pars[0] = (pars[0] > minimap_max_x || pars[0] < 124 ? 127 : pars[0]);
            pars[1] = (pars[1] > 255 || pars[1] < 0 ? 0 : pars[1]);
            pars[2] = (pars[2] > minimap_max_y || pars[2] < 121 ? 124 : pars[2]);
            pars[3] = (pars[3] > 255 || pars[3] < 0 ? 0 : pars[3]);
            pars[4] = (pars[4] > 15 || pars[4] < 0 ? 7 : pars[4]);
            pars[5] = (pars[5] > 8 || pars[5] < 1 ? 1 : pars[5]);
            pars[6] = (pars[6] > 8 || pars[6] < 0 ? 1 : pars[6]);
            pars[7] = (pars[7] > 1 || pars[7] < 0 ? 1 : pars[7]);
        }
    }
    else if (varname.indexOf('mark') === 0) {
//Default 0x.1x,2y.3y,4z,5icon,6link
        if (tmpp === '' || (tmpp = tmpp.split(/[,-]/)).length < 3) { pars = [127, 128, 124, 128, 7, 1, '']; }
        else {
            pars[0] = parseInt(tmpp[0].split('.')[0] || 127, 10);
            pars[1] = parseInt(tmpp[0].split('.')[1] || 0, 10);
            pars[2] = parseInt(tmpp[1].split('.')[0] || 124, 10);
            pars[3] = parseInt(tmpp[1].split('.')[1] || 0, 10);
            pars[4] = parseInt(tmpp[2] || 7, 10);
            pars[5] = parseInt(tmpp[3] || 1, 10);
            pars[6] = tmpp[4] || '';
            pars[0] = (pars[0] > minimap_max_x || pars[0] < 124 ? 127 : pars[0]);
            pars[1] = (pars[1] > 255 || pars[1] < 0 ? 0 : pars[1]);
            pars[2] = (pars[2] > minimap_max_y || pars[2] < 121 ? 124 : pars[2]);
            pars[3] = (pars[3] > 255 || pars[3] < 0 ? 0 : pars[3]);
            pars[4] = (pars[4] > 15 || pars[4] < 0 ? 7 : pars[4]);
            pars[5] = (pars[5] > 22 || pars[5] < 0 ? 1 : pars[5]);
        }
    }
    return pars;
};

let pars = (minimap_get_coords("https://tibia.fandom.com/wiki/Mapper?coords=126.63,126.21,8,2,1,1"));


// var tleft = Math.floor((((pars[0] - 124 - (1*(1/pars[5]))) * 256) + pars[1]) * pars[5], 10)+Math.floor(pars[5] / 2);
// var ttop = Math.floor((((pars[2] - 121- (0.75*(1/pars[5]))) * 256) + pars[3]) * pars[5], 10)+Math.floor(pars[5] / 2);
// console.log(tleft, ttop);

console.log(pars[0] * 256 + pars[1])
console.log(pars[2] * 256 + pars[3])