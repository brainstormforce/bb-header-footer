module.exports = function( grunt ) {

	'use strict';

	// Project configuration
	grunt.initConfig( {

		pkg: grunt.file.readJSON( 'package.json' ),

		addtextdomain: {
			options: {
				textdomain: 'bb-header-footer',
			},
			update_all_domains: {
				options: {
					updateDomains: true
				},
				src: [ '*.php', '**/*.php', '!\.git/**/*', '!bin/**/*', '!node_modules/**/*', '!tests/**/*' ]
			}
		},

		zip: {
		      'location/to/zip/files.zip': ['file/to/zip.js', 'another/file.css']
		    },
		      copy: {
		          main: {
		              options: {
		                  mode: true
		              },
		              src: [
		                  '**',
		                  '*.zip',
		                  '!node_modules/**',
		                  '!build/**',
		                  '!css/sourcemap/**',
		                  '!.git/**',
		                  '!bin/**',
		                  '!.gitlab-ci.yml',
		                  '!bin/**',
		                  '!tests/**',
		                  '!phpunit.xml.dist',
		                  '!*.sh',
		                  '!*.map',
		                  '!Gruntfile.js',
		                  '!package.json',
		                  '!.gitignore',
		                  '!phpunit.xml',
		                  '!README.md',
		                  '!sass/**',
		                  '!codesniffer.ruleset.xml',
		                  '!vendor/**',
		                  '!composer.json',
		                  '!composer.lock',
		                  '!package-lock.json',
		                  '!phpcs.xml.dist',
		              ],
		              dest: 'bb-header-footer/'
		          }
		      },
		      compress: {
		          main: {
		              options: {
		                  archive: 'bb-header-footer.zip',
		                  mode: 'zip'
		              },
		              files: [
		                  {
		                      src: [
		                          './bb-header-footer/**'
		                      ]

		                  }
		              ]
		          }
		      },

		      clean: {
		          main: ['bb-header-footer'],
		          zip: ['bb-header-footer.zip'],
		      },


		wp_readme_to_markdown: {
			your_target: {
				files: {
					'README.md': 'readme.txt'
				}
			},
		},

		makepot: {
			target: {
				options: {
					domainPath: '/languages',
					exclude: [ '\.git/*', 'bin/*', 'node_modules/*', 'tests/*' ],
					mainFile: 'bb-header-footer.php',
					potFilename: 'bb-header-footer.pot',
					potHeaders: {
						poedit: true,
						'x-poedit-keywordslist': true
					},
					type: 'wp-plugin',
					updateTimestamp: true
				}
			}
		},
	} );

	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' )
	grunt.loadNpmTasks( 'grunt-zip' );

	grunt.registerTask( 'release', ['clean:zip', 'copy', 'compress', 'clean:main'] );
	grunt.registerTask( 'i18n', ['addtextdomain', 'makepot'] );
	grunt.registerTask( 'readme', ['wp_readme_to_markdown'] );

	grunt.util.linefeed = '\n';

};
