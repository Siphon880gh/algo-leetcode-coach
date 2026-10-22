## Rotations

1. `mn = nums`, `best = sum(nums)`.
2. For k = 1 … n − 1: `mn[i] = min(mn[i], nums[(i − k) mod n])`; `best = min(best, k · x + sum(mn))`.
3. Return best.

Examples → 13, 6. Checked against Dijkstra over (rotation, bought set) on 300 random small arrays.

More than n − 1 rotations never helps, since every price is already in each window. k · x + sum can reach about 2 · 10^12, so use 64-bit.

Time: O(n²)  
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
