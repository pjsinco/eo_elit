module.exports = function(grunt) {

  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-contrib-compass");
  grunt.loadNpmTasks("grunt-autoprefixer");
  grunt.loadNpmTasks("grunt-contrib-concat");
  grunt.loadNpmTasks("grunt-contrib-uglify");

  grunt.initConfig({

    pkg: grunt.file.readJSON('./package.json'),

    autoprefixer: {
      css: {
        src: './**/*.css'
      }
    },

    compass: {
      dev: {
        options: {
          config: 'config.rb'
        }
      }
    },

    concat: {
      dist: {
        src: ['./js/vendor/**/*.js', './js/main.js'],
        dest: './<% pkg.name %>.js',
      },
      options: {
        separator: ';',
      },
    },

    uglify: {
      dist: {
        files: {
          './dist/the-do.min.js': ['<%= concat.dist.dest %>'],
        },
      },
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
      },
    },

    watch: {
      options: {
        livereload: true
      },
      
      sass: {
        files: ['sass/**/*.scss'],
        tasks: ['compass:dev', 'autoprefixer:css'] 
      },

      php: {
        files: ['**/*.php'],
        options: {
          livereload: 35729
        }
      },

      js: {
        files: ['./js/**/*.js'],
        tasks: ['concat', 'uglify'],
      },

    } // watch

  }); // initConfig
  
  grunt.registerTask('compile-sass', ['compass:dev']);
  grunt.registerTask('default', ['watch']);

}; // exports

