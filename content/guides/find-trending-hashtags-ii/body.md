A table lists tweets with a date and text, and a tweet can carry more than one hashtag. Within the period the statement gives, count every hashtag occurrence and report the most frequent hashtags (as many as the statement asks) with their counts. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Recursive split

This assumes each hashtag runs from # to the next space or the end of the text; check the official statement.

Using the column names the statement gives:

1. Seed: tweets in the period, with a space appended to the text.
2. Step: tag = from the next `#` to the following space; rest = the text after that space. Stop when rest has no `#`.
3. `GROUP BY` tag, `COUNT(*)`, ordered and limited as asked.

Constructed check (run in SQLite, February 2024): #Sunny 3, #Win 2, then the single ones; #Win and #Win2 stay apart, and a March tweet is excluded.

Every hashtag counts: taking only the first per tweet drops #Sunny to 2 and #Win to 1.

Time: O(total text length + t log t) for t tags  
Space: O(t)

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
