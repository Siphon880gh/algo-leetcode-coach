## Gaps between merged intervals

1. For each axis: sort intervals (start, end) by start.
2. Keep mx = largest end so far; count starts with start ≥ mx, then mx = max(mx, end).
3. Answer true if either axis has at least 2 gaps.

Examples → true, true, false. Checked against trying every pair of cuts on random small grids.

Comparing with only the previous interval’s end: n = 6, rectangles [[0, 1, 6, 2], [1, 2, 2, 6], [2, 5, 3, 6], [4, 4, 6, 6]] → true instead of false.

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
