## Two phases

1. For each trip, find its path by DFS and add 1 to `cnt` of every node on it.
2. DFS from node 0: `full(u) = price[u] · cnt[u] + Σ min(full(v), half(v))`, `half(u) = price[u] / 2 · cnt[u] + Σ full(v)`.
3. Return `min(full(0), half(0))`.

Examples → 23, 1. Checked against trying every non-adjacent set on 300 random trees.

A node’s total cost is its price times its visit count, so halving decisions are independent except for the non-adjacency rule. n ≤ 50 and 100 trips keep phase 1 tiny.

Time: O(n · trips)  
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
