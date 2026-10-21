## Children first

1. `prune(node)`: if null, return null.
2. `node.left = prune(node.left)`, `node.right = prune(node.right)`.
3. If both children are null and `node.val == target`, return null; else return `node`.

`[1,2,3,2,null,2,4]`, 2 → `[1,null,3,null,4]`. `[1,3,3,3,2]`, 3 → `[1,3,null,null,2]`. `[1,2,null,2,null,2]`, 2 → `[1]`.

Do not check the leaf condition before pruning the children; a parent may become a leaf only afterwards. Do not delete inner nodes with the target value; only leaves go.

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
