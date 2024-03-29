* List all scenarios
* use climate to format output as much as possible
* write unit tests to test the data fetchers and benchmark runner objects
* document properly
* Make result dumping functions work for all scenarios not just the no eager scenario, rename methods and all associated files to reflect this


This repo is initially designed to work with versions of the ORM packages
above that are compatible with PHP 7.4. Moving forward, there will be branches 
in this repo corresponding to default PHP versions in Ubuntu LTS releases, e.g. 
a branch named **php-74** (which shipped with Ubuntu 20.04 LTS), another branch
named **php-81** (which shipped with Ubuntu 22.04 LTS) etc. 

> Once the php branches are setup, the master branch will always contain code 
designed to run with the PHP version that ships with the latest ubntu LTS version 
at any particular moment. This will allow for being able to run benchmarks for the 
latest version of each ORM compatible with the PHP version the checked out branch 
corresponds with.

Each test should be in its own php file so that a fresh php process is created to 
execute each test so a close to accurate memory usage value is reported. 
If you lump all the tests together in a single php script, the memory usage 
from earlier operations might clobber or inflate memory usage values for later operations.

Document PDO configuration instructions for each ORM vendor.


Running all benchmarks & Update results for website

reset \
&& ./run-no-eager-first-n-benchmarks.sh /home/rotimi/SoftwareProjects/benchmarkorms/benchmark-results/ \
&& ./run-no-eager-benchmarks.sh /home/rotimi/SoftwareProjects/benchmarkorms/benchmark-results/ \
&& ./run-eager-first-n-benchmarks.sh /home/rotimi/SoftwareProjects/benchmarkorms/benchmark-results/ \
&& ./run-eager-benchmarks.sh /home/rotimi/SoftwareProjects/benchmarkorms/benchmark-results/ \
&& ./build-gh-pages.sh




