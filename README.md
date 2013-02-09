genesqr-5.0
===========

Basic web application that makes connections to the Foundation api that is hosted by iPlant Collaborative.
The web application allows authenticated users to launch a job, check the status of a job, and quit. 
This small code base will be use for iPlant Collaborative Developers to use a template to develop and launch their own foundation api web apps.

Setup
-------
To help setup some user specific details, use the ruby install script. It takes the url on which the box will be hosted, and the email address for when the application can submit to upon a job completion

For example:
'''ruby install.rb http://128.196.142.30 mail@example.com'''
