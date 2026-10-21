## Three rules

1. Click on `M`: change it to `X`, done.
2. Click on `E` with `c > 0` adjacent mines (8 directions, counting `M` and `X`): write `str(c)`, done.
3. Click on `E` with no adjacent mines: write `B`, then reveal every adjacent `E` with the same rules (recursion or a queue).

Mark a cell before expanding it (setting it to `B` or a digit does that), so the search never revisits it. Only `E` cells get expanded; digits stop the spread.

Number of Islands (200) is a similar flood fill but only in 4 directions, without numbering.

Do not expand from a numbered cell. Do not use 4 directions — neighbors include diagonals. Do not reveal mines while spreading; the spread never reaches an `M` because it only enters `E` cells.

Time: O(m n)  
Space: O(m n) for the recursion or queue

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
