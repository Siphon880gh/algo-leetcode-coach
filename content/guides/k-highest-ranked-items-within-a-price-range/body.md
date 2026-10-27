## Rank by a tuple

1. BFS over non-wall cells from `start`, recording `dist`.
2. Collect `(dist, price, r, c)` for reached cells with `low ≤ price ≤ high`.
3. Sort and return the first `k` as `[r, c]`.

Examples → `[[0,1],[1,1],[2,1]]`, `[[2,1],[1,2]]`, `[[2,1],[2,0]]`.

Empty cells (value 1) are walkable but are not items unless 1 lies in the range; the start cell counts too if its price fits. A heap of size k would avoid sorting everything.

Time: O(m · n log(m · n))  
Space: O(m · n)

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
