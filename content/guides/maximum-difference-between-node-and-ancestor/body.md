## Extremes on the path

`dfs(node, lo, hi)`:

- If `node` is null, return `hi − lo`.
- `lo = min(lo, node.val)`, `hi = max(hi, node.val)`.
- Return `max(dfs(node.left, lo, hi), dfs(node.right, lo, hi))`.

Answer: `dfs(root, root.val, root.val)`.

Every ancestor–descendant pair lies on some root-to-leaf path, and the path's max − min covers its best pair.

Do not compare each node with every ancestor; that is O(n · h). Do not compute subtree min and max and forget to pair them with the node itself; carrying the path extremes avoids that.

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
