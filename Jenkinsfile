node {
    stage "SCM"
    git "git@github.com:Brunty/many-cages.git"
    sh "echo copied from SCM"
    stage "Composer install"
    sh "composer install --prefer-dist --no"
    stage "Unit Tests"
    sh "cp stubs/cages.json storage/app/"
}

parallel (
  phpunit: { node {
    sh "cp phpunit.xml.dist phpunit.xml"
    sh "vendor/bin/phpunit"

 }},
  phpspec: { node {
    sh "cp phpspec.yml.dist phpspec.yml"
    sh "vendor/bin/phpspec run"
 }},
  behat: { node {
    sh "vendor/bin/behat"
  }}
)
