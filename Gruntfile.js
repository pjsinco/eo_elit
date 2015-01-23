module.exports = function(grunt) {

  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-contrib-compass");

  grunt.initConfig({

    compass: {
      dev: {
        options: {
          config: 'config.rb'
        }
      }
    },


    watch: {
      options: {
        livereload: true
      },
      
      sass: {
        files: ['sass/**/*.scss'],
        tasks: ['compass:dev'] 
      },

      php: {
        files: ['**/*.php'],
        options: {
          livereload: 35729
        }
      },
    
    } // watch

  }); // initConfig
  
  grunt.registerTask('compile-sass', ['compass:dev']);
  grunt.registerTask('default', ['watch']);

}; // exports

