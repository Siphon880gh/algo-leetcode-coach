## Accumulate per cell

1. For each top-left (i, j): test the 12 adjacent pairs inside the window.
2. If all differ by at most threshold: avg = window sum / 9 (rounded down); add avg to S and 1 to C for all nine cells.
3. result[i][j] = S / C rounded down if C > 0, else image[i][j].

Examples → all 9s; rows of 25, 27, 27, 30; the image unchanged.

Average the rounded region averages, as the statement says, not the raw pixel sums.

Time: O(9 · 12 · m n)  
Space: O(m n)

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
