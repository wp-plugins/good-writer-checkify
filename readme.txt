=== Good Writer Checkify  ===
Contributors: pythoPhpSteve
Tags: quality blog, quality checklist, writer aid, checklist
Requires at least: 2.7
Tested up to: 4.1
Stable tag: 0.3.0

A Checklist tool that serves as your own "Blog Entry Coach"

== Description ==

It's easy to accumulate a lot of web bookmarks to Top-10 Blog Tips, or Books/Ebooks on how to engage a reader with your writing. 

However It's another story to actually implement these principles into your day to day blogging, ( especially when you get caught up taking time on the Non-Writing mechanics of how to SEO-ize your site, how to improve the look of your Theme, etc..)

I wrote Good Writer Checkify to provide for an in-your-face kind of reminder, as you write each post, to nudge you to improve the *Content* itself.  

The Key to using G.W.C is, you go back to all your saved web articles, books, ebooks, etc.. and pick 10 of the best blogging principles and insert them into this Plugin's settings, so that you can check them off as your write each blog entry.  Of course, you can just start fresh if you have no bookmarked articles and just Google for Writing/Blogging Tips.

Contact: The contact page for my plugins is: <a href="http://stevebailey.biz/blog/wp-attention-boxes" target="_blank">ContactForm</a>

== Installation ==

* The most modern way these days of course, is to go to your Plugins Page and click the Add New button, and then
search for "Good Writer Checkify"

OR use Zip-uploader

* You can use Zip-uploader feature if your version of Wordpress has it
1. Download the Plugin as Zip file, but DON'T extract the Zip File
2. In your Admin, Go to Plugins/ Add New / and then click Upload from the choices .. browse for the Zip that you downloaded
3. Click Activate

* OR do it the manual way:

1. Download and extract the Plugin zip file.
2. Upload the folder containing the Plugin files to your WordPress Plugins folder (usually ../wp-content/plugins/ folder).
3. Activate the Plugin via the 'Plugins' menu in WordPress.
4. Once activated you go to the Plugin options by clicking the 'Good Writer Checkfiy' link under the 'Settings' menu.
5. You then enter in up to 10 Reminder/Guidelines into the text inputs.

== Frequently Asked Questions ==

= I notice there are now 25 possible reminders. Can I go in and change the code to increase that even higher? =
Yes, now you can. But not through the wordpress admin.. you have to open a code file, though it's very, very minor. 
 Just go into the "includes" directory in the code for this plugin, and edit the file "good-writer-checkify-includes.inc" and simply replace the 25 you see in there with your desired number.

= Do the checkboxes get saved anywhere, or are they just there for the visual reminder purpose =
Yes, this is really the main benefit of Good Writer Checkify.  Each individual Blog entry gets its own separate checklist .. i.e. each Blog Entry remembers how many of the "check points" have been satisfied.

= So even if I have 2 or more un-published Drafts In-progress at the same time.. the checked Checkboxes remain unique to each post ? =
Yes

= Why is that the checkbox's sometimes don't seem to be saved when I click on Save Draft ?  =
  This plugin requires that you at least put something - even just a couple of characters as a beginning - in the Title box, before clicking Save Draft, so that it knows it's saving a unique blog entry.

= I'd like to just use the blog check-off items that I see in the screenshots =
Okay, just open the sample_blog_guidelines.txt file in the root of this plugin's directory.


== Screenshots ==

1. The Good Writer Checkify Meta-Box, sitting conveniently under the post editor prompt you in meeting all or most of the guidelines.

2. You can turn off the checkmarks if you'd rather just have the reminders there as a reference, and not to necessarily actively check off.


== Changelog ==
= 0.3.0 =
* Increase number of possible reminders to 25. Also give user the freedom to change that number
= 0.2.1 =
* Added Wordpress built in internationalization calls to support non-English languages 
= 0.2.0 =
* fixed css bug - previously, this plugin's CSS was creating an obnoxious blue background/white text in the corner of Wordpress's system settings pages
= 0.1.5 =
* fixed bug - before this fix, editing a post via Quick Edit wiped out the saved checkmarks

= 0.1 =
* initial version


== Upgrade Notice ==
Are you tired of only have 10 reminders at the max ? With 0.3.0 that has been increased to 25. (to make this even higher, please read the faq tab!)