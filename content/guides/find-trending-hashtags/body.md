A table lists tweets with a date and text. Within the period the statement gives, extract each tweet’s hashtag, count how often each hashtag appears, and report the most frequent ones (as many as the statement asks) with their counts. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## String extraction

This assumes one hashtag per tweet, as restated above; with several per tweet, split them first (for instance with a recursive CTE).

Using the column names the statement gives:

1. Keep rows in the period.
2. r = text from `#` on (`SUBSTR(tweet, INSTR(tweet, '#'))`); tag = r up to the first space, if any.
3. `GROUP BY` tag, `COUNT(*)`, ordered and limited as asked.

Constructed check (run in SQLite, February 2024, top 3): #Sunny 3, #Win 2, #Rainy 2; a March tweet is excluded.

Cut at the space: taking the rest of the text makes “#Sunny today” and “#Sunny vibes” different tags. Without the date filter, the March tweet pushes #Rainy to 3.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
