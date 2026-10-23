## Merge

1. For each timestamp t of either series in increasing order:
2. Move i while series1[i] is before t; same for j in series2.
3. Output [t, value at i (or 0) + value at j (or 0)].

Examples → [[1, 5], [2, 3], [4, 3], [5, 2]], [[1, 7], [2, 3], [3, 1]], [[1, 7], [10^9, 2]]. Sums reach 2 · 10^9, which fits in a signed 32-bit integer.

Carrying the previous value forward: example 1 → [[1, 3], [2, 5], [4, 3], [5, 3]].

Time: O(n1 + n2)  
Space: O(1) extra

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
