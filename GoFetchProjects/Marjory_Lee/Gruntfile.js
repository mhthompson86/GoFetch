/*
 * Generated on 2015-06-08
 * generator-assemble v0.5.0
 * https://github.com/assemble/generator-assemble
 *
 * Copyright (c) 2015 Hariadi Hinta
 * Licensed under the MIT license.
 */

'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// '<%= config.src %>/templates/pages/{,*/}*.hbs'
// use this if you want to match all subfolders:
// '<%= config.src %>/templates/pages/**/*.hbs'

module.exports = function(grunt) {

  require('time-grunt')(grunt);
  require('load-grunt-tasks')(grunt);

  // Project configuration.
  grunt.initConfig({

    config: {
      src: 'src',
      dist: 'dist'
    },

    watch: {
      assemble: {
        files: ['<%= config.src %>/{content,data,templates}/{,*/}*.{md,hbs,yml}'],
        tasks: ['assemble']
      },
      livereload: {
        options: {
          livereload: '<%= connect.options.livereload %>'
        },
        files: [
          '<%= config.dist %>/{,*/}*.html',
          '<%= config.dist %>/assets/{,*/}*.css',
          '<%= config.dist %>/assets/{,*/}*.js',
          '<%= config.dist %>/assets/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
        ]
      }
    },

    connect: {
      options: {
        port: 9000,
        livereload: 35729,
        // change this to '0.0.0.0' to access the server from outside
        hostname: 'localhost'
      },
      livereload: {
        options: {
          open: true,
          base: [
            '<%= config.dist %>'
          ]
        }
      }
    },

    assemble: {
      pages: {
        options: {
          flatten: true,
          assets: '<%= config.dist %>/assets',
          layout: '<%= config.src %>/templates/layouts/default.hbs',
          data: '<%= config.src %>/data/*.{json,yml}',
          partials: '<%= config.src %>/templates/partials/**/*.hbs',
          plugins: ['assemble-contrib-permalinks','assemble-contrib-sitemap'],
            collections: [
                {
                    title: 'pages',
                    sortorder: 'asc'
                }
            ],
            sitemap: {
                homepage: 'http://www.marjorylee.com',
                changefreq: 'weekly',
                priority: '1.0',
                exclude: [],
                relativedist: '/'
            }
        },
        files: {
          '<%= config.dist %>/': ['<%= config.src %>/templates/pages/**/*.hbs']
        }
      }
    },

    copy: {
      bootstrap: {
        expand: true,
        cwd: 'bower_components/bootstrap/dist/',
        src: '**',
        dest: '<%= config.dist %>/assets/'
      },
      css: {
        expand: true,
        cwd: 'src/assets/css/',
        src: '**',
        dest: '<%= config.dist %>/assets/css/'
      },
        js: {
            expand: true,
            cwd: 'src/assets/js/',
            src: '**',
            dest: '<%= config.dist %>/assets/js/'
        },
        images: {
            expand: true,
            cwd: 'src/assets/img/',
            src: '**',
            dest: '<%= config.dist %>/assets/img/'
        },
        fonts: {
            expand: true,
            cwd: 'src/assets/fonts/',
            src: '**',
            dest: '<%= config.dist %>/assets/fonts/'
        },
        resources: {
            expand: true,
            cwd: 'src/assets/resources/',
            src: '**',
            dest: '<%= config.dist %>/assets/resources/'
        },
        favicon: {
            src: 'src/favicon.ico',
            dest: '<%= config.dist %>/'
        }

    },

    // Before generating any new files,
    // remove any previously-created files.
    clean: ['<%= config.dist %>/**/*.{html,xml}']

  });

  grunt.loadNpmTasks('assemble');

  grunt.registerTask('server', [
    'build',
    'connect:livereload',
    'watch'
  ]);

  grunt.registerTask('build', [
    'clean',
    'copy',
    'assemble'
  ]);

  grunt.registerTask('default', [
    'build'
  ]);

};
