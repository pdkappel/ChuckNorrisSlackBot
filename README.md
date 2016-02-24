### Chuck Norris SlackBot
Simple Slack Bot for [Slack.com](http://www.slack.com) that posts Chuck Norris facts at random in a selected channel.

Settings include how often Chuck should speak (silence him only if you dare) and in what channel.

#### Instructions ####

- Navigate to Integrations on your Slack team
- Find the Bot integration
- Name the new bot Chuck Norris and click "Add Bot Integration"
- Enter Chuck Norris as first and last name
- Copy the API token from Slack to the $slackToken variable and set a slack channel in the norris class (norris.class.php)
- Open goChuck.php and define the random number to match for Chuck to speak. Lower number = more facts.
- And lastly, set up cron to execute goChuck.php at a desied inteval (every 5 mins during office hours is recommended)

You can test the bot by disabling the rand() generator in goChuck.php and run the file in your browser or in terminal. 

Set $execLog to true to enable logging of responses from Slack to debug. exec.log must be writable.

Have fun!
