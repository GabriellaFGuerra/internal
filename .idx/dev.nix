# To learn more about how to use Nix to configure your environment
# see: https://developers.google.com/idx/guides/customize-idx-env
{pkgs}: {
  # Which nixpkgs channel to use.
  channel = "stable-23.11"; # or "unstable"
  # Use https://search.nixos.org/packages to find packages
  packages = [
    pkgs.php82
    pkgs.php82Packages.composer
    pkgs.nodejs_20
  ];
  # Sets environment variables in the workspace
  env = {};
  idx = {
    # Search for the extensions you want on https://open-vsx.org/ and use "publisher.id"
    extensions = [
      "amiralizadeh9480.laravel-extra-intellisense"
      "bmewburn.vscode-intelephense-client"
      "bradlc.vscode-tailwindcss"
      "christian-kohler.path-intellisense"
      "codingyu.laravel-goto-view"
      "EditorConfig.EditorConfig"
      "esbenp.prettier-vscode"
      "felixfbecker.php-debug"
      "formulahendry.auto-close-tag"
      "formulahendry.auto-rename-tag"
      "formulahendry.code-runner"
      "GitHub.github-vscode-theme"
      "HansUXdev.bootstrap5-snippets"
      "heybourn.headwind"
      "MehediDracula.php-namespace-resolver"
      "mikestead.dotenv"
      "mohamedbenhida.laravel-intellisense"
      "MrChetan.goto-laravel-components"
      "MrChetan.laravel"
      "MrChetan.laravel-goto-config"
      "MrChetan.phpstorm-parameter-hints-in-vscode"
      "mtxr.sqltools"
      "onecentlin.laravel-blade"
      "onecentlin.laravel5-snippets"
      "PKief.material-icon-theme"
      "rangav.vscode-thunder-client"
      "shufo.vscode-blade-formatter"
      "stef-k.laravel-goto-controller"
      "wongjn.php-sniffer"
      "xabikos.JavaScriptSnippets"
      "zhuangtongfa.material-theme"
      "porifa.laraphense"
    ];
    workspace = {
      # Runs when a workspace is first created with this `dev.nix` file
      onCreate = {
        # Example: install JS dependencies from NPM
        # npm-install = "npm install";
        # Open editors for the following files by default, if they exist:
      };
      # To run something each time the workspace is (re)started, use the `onStart` hook
    };
    # Enable previews and customize configuration
    previews = {
      enable = true;
      previews = {
        web = {
          command = ["php" "artisan" "serve" "--port" "$PORT" "--host" "0.0.0.0"];
          manager = "web";
        };
      };
    };
  };
}
