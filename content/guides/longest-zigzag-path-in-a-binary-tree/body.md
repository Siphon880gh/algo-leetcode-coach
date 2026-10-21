## Pass the direction

1. `dfs(node, wentLeft, len)`: update `best = max(best, len)`.
2. Left child: `dfs(left, true, wentLeft ? 1 : len + 1)`.
3. Right child: `dfs(right, false, wentLeft ? len + 1 : 1)`.
4. Start with both children of the root at length 1.

First example → 3. Second → 4. `[1]` → 0.

Do not count nodes; the length is the number of edges. Do not reset to 0 when the direction repeats; the new path already has one edge.

Time: O(n)  
Space: O(height)

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
