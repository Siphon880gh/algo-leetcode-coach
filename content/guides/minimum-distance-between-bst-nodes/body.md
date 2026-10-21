## Sorted order for free

Inorder DFS with `prev = None` and `best = ∞`:

- Visit the left subtree.
- If `prev` is set, `best = min(best, node.val − prev)`. Then `prev = node.val`.
- Visit the right subtree.

Return `best`.

Only adjacent values in sorted order can be the closest pair, so one pass is enough. This is the same problem as 530 (Minimum Absolute Difference in BST).

Do not compare each node only with its children; the closest value can be far away in the tree (for example, a node and its inorder successor deep in the right subtree's left spine). Do not collect all pairs.

Time: O(n)  
Space: O(h)

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
