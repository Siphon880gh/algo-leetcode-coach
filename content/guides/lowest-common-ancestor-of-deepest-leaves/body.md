## Compare child heights

`dfs(node)` returns `(height, lca)`:

- Null: `(0, null)`.
- `(lh, la) = dfs(node.left)`, `(rh, ra) = dfs(node.right)`.
- If `lh == rh`: return `(lh + 1, node)`.
- If `lh > rh`: return `(lh + 1, la)`; else `(rh + 1, ra)`.

Answer: `dfs(root).lca`.

When both sides reach the same depth, the deepest leaves sit on both sides, so this node is their lowest common ancestor.

Do not find the deepest leaves first and then run a general LCA; one post-order pass does both. This is the same problem as Smallest Subtree with all the Deepest Nodes (865).

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
