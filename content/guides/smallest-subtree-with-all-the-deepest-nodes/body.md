## Compare the two sides

`dfs(node)` returns `(depth, lca)`:

- `None` → `(0, None)`.
- Otherwise get `(dl, a)` from the left and `(dr, b)` from the right.
  - `dl == dr` → `(dl + 1, node)`: the deepest nodes are on both sides, so `node` is their lowest common ancestor.
  - `dl > dr` → `(dl + 1, a)`.
  - `dl < dr` → `(dr + 1, b)`.

Return `dfs(root).lca`.

This is the same problem as LeetCode 1123, Lowest Common Ancestor of Deepest Leaves.

Do not compute depths with a separate function at every node; that is O(n²) on a skewed tree. Do not return the deepest leaf itself when there are several deepest leaves.

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
