module.exports = function( grunt ) {

	'use strict';
	var banner = '/**\n * <%= pkg.homepage %>\n * Copyright (c) <%= grunt.template.today("yyyy") %>\n * This file is generated automatically. Do not edit.\n */\n';
	// Project configuration
	grunt.initConfig( {

		pkg: grunt.file.readJSON( 'package.json' ),

		addtextdomain: {
			options: {
				textdomain: 'bb-header-footer',
			},
			target: {
				files: {
					src: [ '*.php', '**/*.php', '!node_modules/**', '!php-tests/**', '!bin/**' ]
				}
			}
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

       copy: {
            main: {
                options: {
                    mode: true
                },
                src: [
                    '**',
                    '!node_modules/**',
                    '!.git/**',
                    '!*.sh',
                    '!.gitlab-ci.yml',
                    '!.gitignore',
                    '!.gitattributes',
                    '!Gruntfile.js',
                    'npm-debug.log',
                    '!package.json',
                    '!bin/**',
                    '!tests/**',
                    '!phpunit.xml.dist',
                    '!bb-header-footer.zip'
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
            main: ["bb-header-footer"],
            zip: ["bb-header-footer.zip"]
        }

	} );

    grunt.loadNpmTasks('grunt-wp-i18n');
    grunt.loadNpmTasks('grunt-wp-readme-to-markdown');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('release', ['clean:zip', 'copy', 'compress', 'clean:main']);
    grunt.registerTask('i18n', ['addtextdomain', 'makepot']);
    grunt.registerTask('readme', ['wp_readme_to_markdown']);

	grunt.util.linefeed = '\n';

};
