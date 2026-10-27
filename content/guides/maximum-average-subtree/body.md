Given the root of a binary tree, return the largest average of node values over all subtrees, where a subtree is a node together with all of its descendants. For instance, a root 5 with children 6 and 1 has subtree averages 4, 6, and 1, so the answer is 6. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Children report sum and size

`dfs(node)` returns `(sum, count)`:

- Null: `(0, 0)`.
- Otherwise combine: `s = node.val + ls + rs`, `c = 1 + lc + rc`; update `best = max(best, s / c)`; return `(s, c)`.

Answer: `best` after `dfs(root)`.

Do not recompute each subtree's sum from scratch; that is O(n²) on a skewed tree. Do not compare integer-divided averages; use floating division (or compare `s1 · c2` with `s2 · c1`).

Time: O(n)  
Space: O(h)

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
