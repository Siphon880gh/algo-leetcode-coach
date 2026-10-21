## Level snapshot

Start with `q = [root]`. While `q` is not empty:

1. `size = len(q)`, `total = 0`.
2. Pop `size` nodes, add their values to `total`, and push their children.
3. Append `total / size`.

Recording the size before popping is what separates one level from the next.

DFS works too: keep `sum[depth]` and `count[depth]`, then divide at the end.

Do not use 32-bit sums; values up to `2³¹ − 1` on a wide level overflow. Do not use integer division; the averages are floating point.

Time: O(n)  
Space: O(width)

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
