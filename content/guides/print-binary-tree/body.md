## Fixed grid, halving offsets

1. Find the height `h`, counted in edges (a single node has `h = 0`).
2. Make `h + 1` rows of `2^(h + 1) − 1` empty strings.
3. Put the root at `(0, (cols − 1) / 2)`. For a node at `(r, c)`, put the left child at `(r + 1, c − 2^(h − r − 1))` and the right child at `(r + 1, c + 2^(h − r − 1))`.

Each level halves the offset, so the subtrees never overlap and every column of the bottom row is reachable.

Do not count the height in nodes; with `h` as the number of nodes, the grid is twice as wide as it should be. Do not leave `null` in empty cells; they hold the empty string.

Time: O(h · 2^h) to build the grid  
Space: O(h · 2^h)

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
