## One postorder pass

`dfs(node)` returns 0 for null, else `s = node.val + dfs(left) + dfs(right)`. Increment `cnt[s]` and return `s`. Each node's sum is computed once, from its children's sums — no subtree is summed twice.

After the pass, `mx = max(cnt.values())` and return every `s` with `cnt[s] == mx`.

Do not recompute the sum of each subtree from scratch — that is O(n²) on a skewed tree. Do not return a single sum — ties must all be included.

Time: O(n)  
Space: O(n) for the counter and recursion

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
