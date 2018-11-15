/**
 * Created by miaoyu on 2016/12/15 0015.
 */
const gulp = require('gulp');


// dev 开发环境任务
gulp.task('dev', () => gulp.start(require('./build/gulp.dev.js')));


// pro 开发环境任务
gulp.task('pro', () =>
    gulp.start(require('./build/gulp.pro.js'), () =>
        console.log('[gulp-task] ----- pro - success -----'.success)));