## Count crossings per edge

1. Root the tree at 0 and compute subtree sizes, children first.
2. For each node `u ≠ 0`: `fuel += ceil(size[u] / seats)`.
3. Return `fuel`.

Examples → 3, 7, 0.

Representatives can gather on the way up, so each edge only needs enough cars for everyone below it. A path of 10^5 cities with one seat costs about 5 · 10^9 liters, so use 64-bit, and use an explicit stack or BFS order instead of deep recursion.

Time: O(n)  
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
