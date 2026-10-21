## 100 sorted buckets

1. `byH[h]` = sorted lengths of rectangles with height `h`.
2. For each point `(x, y)`: `Σ (size − lower_bound(byH[h], x))` over `h = y … 100`.

Examples → `[2,1]`, `[1,3]`.

Lengths reach 10^9 but heights only 100, so bucketing on the small side keeps each query at about 100 binary searches. Points on an edge count as contained.

Time: O(R log R + P · 100 · log R)  
Space: O(R)

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
