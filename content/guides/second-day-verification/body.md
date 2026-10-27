One table records each sign-up: an email, the user it belongs to and the sign-up time. Another records text messages sent to those emails: the action the user took and when. Return the users who verified on the second day, as the statement defines it. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Date join

This assumes the second day means the calendar day right after the sign-up date, and that a verification is a text row with the confirming action; check the official statement for the exact value and the ordering.

Using the column names the statement gives:

1. Join texts to sign-ups on the email.
2. Keep rows with the confirming action and `DATE(action_time) = DATE(signup_time, '+1 day')` (use your engine’s date arithmetic).
3. Return the users, ordered as asked.

Constructed check (run in SQLite): user 1 signs up at 10:00 and verifies at 09:00 the next day; user 2 verifies the same day; user 3 gets a non-confirming text the next day and verifies two days later → user 1.

Comparing a 24-hour window instead of dates also returns user 2.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
