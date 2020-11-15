module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            css: {
                files: ['resources/sass/*'],
                tasks: ['sass']
            },
            js: {
                files: ['resources/js/*'],
                tasks: ['concat']
            }
        },

        sass: {
            dist: {
                options: {
                    style: 'expanded',
                    sourcemap: 'none'
                },
                files: {
                    'public/css/style.css': 'resources/sass/app.scss',
                }
            }
        },

        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: [
                    'node_modules/inputmask/dist/jquery.inputmask.bundle.js',
                    'node_modules/cropper/dist/cropper.js',
                    'node_modules/swiper/js/swiper.js',
                    'node_modules/axios/dist/axios.js',
                    'resources/js/components.js',
                    'resources/js/prototype.js',
                    'resources/js/input-image.js',
                    'resources/js/image-profile.js',
                    'resources/js/float-btn.js',
                    'resources/js/range.js',
                    'resources/js/input-number.js',
                ],
                dest: 'public/js/app.js',
            },
        },
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', ['watch', 'concat']);

};