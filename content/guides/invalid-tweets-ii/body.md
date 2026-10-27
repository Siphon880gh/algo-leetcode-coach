A table lists tweets and their text. Report the tweets that break any of the rules the statement gives on length, number of mentions and number of hashtags. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Three conditions joined by OR

This assumes each rule is a numeric limit and that @ and # mark mentions and hashtags; check the official statement for the limits.

Using the column names the statement gives:

1. Length: `LENGTH(text) > limit`.
2. Mentions: `LENGTH(text) - LENGTH(REPLACE(text, '@', ''))` over its limit; hashtags the same with `'#'`.
3. Combine with OR; order as asked.

Constructed check (run in SQLite, limits 20 characters, 2 mentions, 2 hashtags): six tweets → 2, 3 and 4.

AND instead of OR returns nothing on that check.

Time: O(total text)  
Space: O(1)

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
