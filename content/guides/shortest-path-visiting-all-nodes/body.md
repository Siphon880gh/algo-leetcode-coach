## Multi-source BFS on a bigger graph

With `n ≤ 12`, there are `n · 2ⁿ` states `(u, mask)`.

1. Enqueue `(i, 1 << i)` for every node `i` at distance 0, and mark them seen.
2. Pop `(u, mask)`. If `mask == (1 << n) − 1`, return its distance.
3. For each neighbor `v`, the next state is `(v, mask | 1 << v)`; enqueue it if unseen.

Edges may be revisited and nodes passed through again, which is why the mask is part of the state instead of a visited set over nodes.

Starting from all nodes at once handles "start anywhere" without running `n` separate searches.

Do not mark nodes as visited globally; walking back through a node is often necessary. Do not try all permutations of nodes; that is O(n!).

Time: O(2ⁿ · n²)  
Space: O(2ⁿ · n)

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
