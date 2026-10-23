You get the root of a binary tree. Find a path of connected nodes whose values are all distinct, and return the largest possible sum of its values. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## DFS with a value set

1. Build neighbor lists (parent and children).
2. dfs(u): add val[u] to the set; best = max over neighbors w not visited and val[w] not in the set of dfs(w), floored at 0; remove val[u]; return val[u] + best.
3. Return the max of dfs over all start nodes.

Assumed here: a path is any chain of adjacent nodes, a single node counts, values can be negative, and the tree is small enough for a search from every node.

Constructed checks (made-up trees, run in code): [1, 2, 3] → 6; [5, 5, 1] → 6; [2, −1, 3, 2] → 5.

Ignoring the distinct rule: [5, 5, 1] → 11 instead of 6.

Time: O(n²)  
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
