A binary tree has exactly one defective node whose right child pointer wrongly points to another node on the same level to its right. Remove the defective node and everything below it (not the node it points to) and return the root. For instance, if in [1,2,3] node 2's right pointer points to 3, the result is [1,null,3]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Seen-to-the-right test

1. Queue of `(node, parent)`; process each level, pushing right child before left.
2. For node `x`: if `x.right` is in `seen`, `x` is defective: set `parent.left` or `parent.right` (whichever is `x`) to null; return root.
3. Otherwise add `x` to `seen` and enqueue children.

Constructed check: `[1,2,3]` with `2.right → 3` → `[1,null,3]`.

Right-to-left order guarantees the wrongly pointed-to node is seen first. DFS visiting right before left also works.

Time: O(n)  
Space: O(n)

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
