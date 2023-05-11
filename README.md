Artisan Root CLI
----

🚀 A handy CLI tool that lets you run Laravel's `artisan` command from any subdirectory of your project.

No more `cd`-ing back and forth. Just type `artisan` and enjoy the magic.

Works on Windows and Linux. Easy to install and use.

## Description

If you are a Laravel developer, you know how often you need to run `artisan` commands to manage your project. Whether it's migrating your database, clearing your cache, or generating new files, `artisan` is your best friend.

However, sometimes you may find yourself in a subdirectory of your project, such as `app/Http/Controllers` or `resources/views`, and you need to run an `artisan` command.  To do that, you need to be in the project's root directory.  This is inconvenient as sometimes you'll need to run artisan from a different folder.

In cases like this, either:  
- You can `cd` back to the project root directory, run the command, and then `cd` back to where you were.
- You can type the full path to the `artisan` file in the project root directory, such as `../../artisan`.

Both options are boring and time-consuming.  Wouldn't it be nice if you could just type `artisan` from anywhere in your project and have it work as expected?

That's where Artisan Root CLI comes in. It's a simple CLI script that finds and executes the `artisan` file in the project root directory for you. No matter where you are in your project, you can run any `artisan` command with ease.

## Installation

To install simply download the script and place it in a folder that is in your system's PATH. Then, you can run any artisan command from any subdirectory of your Laravel project.

### Windows
Open a Terminal with Administrator privileges, then:

1. `mkdir C:\ProgramData\ArtisanRoot & cd C:\ProgramData\ArtisanRoot`
2. `git clone https://github.com/DRSDavidSoft/artisan-root.git .`
3. `systempropertiesadvanced.exe` → <kbd>Environment Variables...</kbd>
 - Under **System Variables**, select `Path` and click on <kbd>Edit...</kbd>
 - Click on <kbd>New</kbd> and enter: `C:\ProgramData\ArtisanRoot`
 - Click on <kbd>OK</kbd> three times to save the changes.

### Linux
Clone this repository to `/usr/local` and then create a symbolic link to the script in `/usr/local/bin`.

1. `sudo git clone https://github.com/DRSDavidSoft/artisan-root.git /usr/local/artisan-root`
2. `sudo ln -s /usr/local/artisan-root/artisan /usr/local/bin/artisan`

## Usage

To use Artisan Root CLI, simply type `artisan` followed by any arguments or options that you would normally pass to the Laravel's `artisan` command.

For example:

- To migrate your database: `artisan migrate`
- To clear your cache: `artisan cache:clear`
- To generate a new controller: `artisan make:controller PostController`

You can also use the `-h` or `--help` option to see all the available commands and options: `artisan -h`

<img src="docs/demo.png" width="340" height="140" />

If you run `artisan` in a folder that is not a Laravel project, the script will try to find the nearest parent folder that contains an `artisan` file. If it fails to find one, it will display an error message.

For example, if you run `artisan` in `/home/user/Documents`, but your Laravel project is in `/home/user/Projects/blog`, the script will look for an `artisan` file in these folders in order:

- /home/user/Documents
- /home/user
- /home
- /

If none of these folders contain an `artisan` file, the script will stop and show this message:

**Exception:** Can not find artisan in the current directory structure.

## Compatibility

Artisan Root CLI works with any version of Laravel or **PHP 8** that supports the `artisan` command.

It requires PHP 8 or higher to run, as it uses some PHP 8 features such as `str_starts_with`.

If you are using an older version of PHP, you can either upgrade your PHP version or modify the script to use alternative functions.

## Alternatives
- **[artisan-anywhere](https://github.com/antonioribeiro/artisan-anywhere)**: A bash version of the same tool, by @antonioribeiro
- [A small gist script](https://gist.github.com/jhoff/8fbe4116d74931751ecc9e8203dfb7c4?permalink_comment_id=4445619#gistcomment-4445619), by @sfinktah

## License
Artisan Root CLI is licensed under the GPL-3.0 license.

Copyright © 2022-2023 by David Refoua <David@Refoua.me>
