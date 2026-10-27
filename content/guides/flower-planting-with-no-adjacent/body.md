## Degree 3, four colors

1. Build the adjacency list from `paths`.
2. For each garden `g` from 1 to `n`: collect the types of already planted neighbours and give `g` the smallest type from 1 to 4 not among them.

Return the types.

At most three neighbours can block at most three types, so a free one always exists, and no backtracking is needed.

Do not run a general graph-coloring search; the degree bound makes greedy safe. Do not forget that paths are undirected; add both directions.

Time: O(n + paths)  
Space: O(n + paths)

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
