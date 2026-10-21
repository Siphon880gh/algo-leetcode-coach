## One path matters

1. `ans = [1] * n`. If no node has value 1, return it.
2. `x` = node with value 1, `m = 1`, `seen` = empty, `visited` = empty.
3. While `x != −1`: DFS the subtree of `x`, skipping visited nodes, adding values to `seen`; `while m in seen: m += 1`; `ans[x] = m`; `x = parents[x]`.

Examples → `[5,1,1,1]`, `[7,1,1,4,2,1]`, `[1,1,1,1,1,1,1]`. Checked against per-subtree brute force on random trees.

Subtrees without value 1 miss 1. Along the path, subtrees grow, so `m` never decreases, and each node is added once: O(n + V) total. Use iterative DFS for deep trees.

Time: O(n + max value)  
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
