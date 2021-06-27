- Repo: git@bitbucket.org:midwestdigitalmarketing/wisconsin-farm-bureau-federation.git
- Staging: http://wfbf.mdmserver.us/


## Installing

The repository should exist at the *root* of your Wordpress install, but does NOT include core files. To install into an existing Wordpress install:

1: CD into the root of your existing Wordpress installation
2: Run the following command

```bash
git init
git remote add origin git@bitbucket.org:midwestdigitalmarketing/wisconsin-farm-bureau-federation.git
git fetch
git reset --hard origin/master
```
3: If you want to remove old files that didn't exist in the repository, run
```bash
git clean -f -d
```

## Configuring the Repository

```bash
git config merge.ours.driver true
```

If you want to make this a global change, so you no longer have to configure it for each specific repository:

```bash
git config --global merge.ours.driver true
```