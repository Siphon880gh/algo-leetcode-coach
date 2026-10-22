A table stores files with their text content. For each of two given words, count how many files contain that word as a whole word, and return one row per word. The two words, what counts as a whole word, and the output names are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One row per word

Using the column names the statement gives:

1. For each word: `SELECT word, SUM(content LIKE pattern)` over the files, where pattern encodes the statement’s whole-word rule, such as `'% word %'` when words are separated by spaces.
2. `UNION ALL` the two rows.

Constructed check (run in SQLite): files a cat sat, cats sit, my dog ran and the cat and dog run, with words cat and dog → 2 and 2.

A loose `'%word%'` also matches longer words: cats counts, so cat → 3 instead of 2.

Time: O(total text)  
Space: O(1)

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
