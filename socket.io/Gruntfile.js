!(function () {
    'use strict';
    module.exports = function (grunt) {
         const sass = require('node-sass');
       
        grunt.initConfig({
            pkg: grunt.file.readJSON('package.json'),
            
            sass: {
                options: {
                    implementation: sass,
                    sourceMap: true,
                    outputStyle: 'compressed',                   
                },
                dist: {
                    files: {
                        'assets/lecture/css/custom.min.css': 'assets/lecture/scss/main.scss'  
                    }
                }

            },
           
            watch: {
                scripts: {
                    files: ['assets/lecture/scss/****/*.scss','assets/lecture/scss/***/*.scss','assets/lecture/scss/**/*.scss','assets/lecture/scss/*/*.scss','/assets/lecture/scss/**/*.scss', ['Gruntfile.js']],
                    tasks: ['sass']

                }
            }

        });
        // Load the plugin that provides the "uglify" task.

        grunt.loadNpmTasks('grunt-sass');           
        grunt.loadNpmTasks('grunt-contrib-watch');
        // Default task(s).
        grunt.registerTask('default', ['sass','watch']);
    };
})();