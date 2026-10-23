## Border coordinate

1. Position p: left edge y, top edge side + x, right edge 3 · side − y, bottom edge 4 · side − x.
2. Sort positions. Binary search d in [0, side].
3. Check d: for each start, jump to the first position ≥ last + d (binary search) until k points are picked; it works if the gap back round the end, start + 4 · side − last, is ≥ d.

Examples → 2, 1, 1. Checked against trying every subset of k points on 300 random small squares.

Skipping the wrap-around check: side = 4, points (4, 4), (2, 4), (2, 0), (0, 4), (0, 0), k = 4 → 4 instead of 2.

Time: O(n log n + n · k · log n · log side)  
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
