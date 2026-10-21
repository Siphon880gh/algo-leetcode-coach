## Letter → row

Build a 26-entry table `row[c]` from the three row strings. For each word, lowercase it, read the row of the first letter, and keep the word if every letter has that row. Return kept words in input order, with their original case.

A set version: put each row in a set and test whether the set of the word's letters is a subset of one of them.

Single-Row Keyboard (1165) times typing on a custom layout. Detect Capital (520) is another per-word letter check.

Do not forget to lowercase before the lookup (`"A"` and `"a"` are on the same row). Do not return lowercased words — return them as given.

Time: O(total letters)  
Space: O(1) (26-entry table)

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
