## Decide after the children

`prune(node)`:

- null → null.
- `node.left = prune(node.left)`, `node.right = prune(node.right)`.
- If `node.val == 0` and both children are null, return null. Otherwise return `node`.

Return `prune(root)`; the root itself may be removed.

Postorder is necessary: a node becomes removable only after its subtrees have been pruned.

Do not prune top-down; a 0 node with a 1 deep below must stay. Do not forget to reassign the children; pruning returns the new subtree.

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
