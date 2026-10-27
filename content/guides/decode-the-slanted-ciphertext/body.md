## Undo the fill order

1. `cols = len(encodedText) / rows`; cell `(r, c)` is `encodedText[r · cols + c]`.
2. For each start column `j`: append cells `(0, j), (1, j + 1), …` while inside the grid.
3. Strip trailing spaces.

Examples → `cipher`, `i love leetcode`, `coding`. Checked by encoding random texts and decoding them back.

The original text was written down the diagonals, so reading them in order rebuilds it. Only trailing spaces are padding; the statement guarantees the text does not end with a space, while inner spaces are real.

Time: O(len)  
Space: O(len)

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
