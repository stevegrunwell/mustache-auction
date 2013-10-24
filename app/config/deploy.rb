# Capistrano deployment for Laravel applications

## basic setup stuff ##

# http://help.github.com/deploy-with-capistrano/
set :application, "Mustache Auction"
set :repository, "https://github.com/stevegrunwell/mustache-auction.git"
set :scm, "git"
default_run_options[:pty] = true

# use our keys, make sure we grab submodules, try to keep a remote cache
set :ssh_options, { :forward_agent => true }
set :deploy_via, :checkout
set :use_sudo, false
set :git_enable_submodules, false

set :branch, 'master'
set :branch, $1 if `git branch` =~ /\* (\S+)\s/m
set :user, "deploy"
set :web_user, "www-data"

## multi-stage deploy process ##

# `cap staging deploy`
task :staging do
  role :web, "movember.buckeyedev.com", :primary => true
  set :app_environment, "staging"
  set :keep_releases, 2
  set :deploy_to, "/var/www/vhosts/movember.buckeyeinteractive.com/httpdocs"
end

# `cap production deploy`
task :production do
  role :web, "movember.buckeyeinteractive.com"
  set :app_environment, "production"
  set :branch, "master"
  set :keep_releases, 5
  set :deploy_to, "/var/www/movember.buckeyeinteractive.com/httpdocs"
end

namespace :deploy do

  task :finalize_update, :except => { :no_release => true } do
    transaction do
      run "rm -rf #{release_path}/app/storage/logs"
      run "ln -s #{shared_path}/logs #{release_path}/app/storage/logs"
      run "chgrp -R #{web_user} #{release_path}/app/storage"
      run "chmod -R g+w #{release_path}/app/storage"
      run "rm -rf #{release_path}/app/storage/sessions"
      run "ln -s #{shared_path}/sessions #{release_path}/app/storage/sessions"
      run "ln -s #{shared_path}/config #{release_path}/app/config/#{app_environment}"
      run "cd #{release_path} && composer install --no-dev"

      # Prevent non-production environments from getting crawled
      unless app_environment == "production"
        run "ln -s #{shared_path}/robots.txt #{release_path}/robots.txt"
      end
    end
  end

  # Run Artisan migrations after the app has been deployed
  task :migrate do
    run "php #{current_path}/artisan --env=#{app_environment} migrate"
  end

  after "deploy", "deploy:migrate", "deploy:cleanup"

end