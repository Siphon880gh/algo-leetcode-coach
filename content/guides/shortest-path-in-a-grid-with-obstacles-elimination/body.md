## Add a dimension

1. Start `(0, 0, k)` at distance 0.
2. For each neighbour: `nk = left − grid[x][y]`; if `nk ≥ 0` and `(x, y, nk)` is unseen, enqueue it.
3. Return the distance on reaching `(m − 1, n − 1)`, or −1.

A shortcut: if `k ≥ m + n − 2`, the Manhattan path works, so return `m + n − 2`.

First example, `k = 1` → 6. Second → −1.

Do not mark cells visited without the removal count; a cell reached with more removals left is a different state. Do not use DFS; it does not find the shortest path.

Time: O(m · n · k)  
Space: O(m · n · k)

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
