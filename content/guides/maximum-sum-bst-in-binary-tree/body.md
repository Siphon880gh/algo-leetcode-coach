## (isBST, min, max, sum)

1. Null → `(true, +∞, −∞, 0)`.
2. For a node: if both children are BSTs and `L.max < val < R.min`, it is a BST with `min(L.min, val)`, `max(R.max, val)`, sum `L.sum + val + R.sum`; update `best`.
3. Otherwise return `(false, …)`.
4. `best` starts at 0.

First example → 20. `[4,3,null,1,2]` → 2. `[-4,-2,-5]` → 0.

Do not check only the direct children; the whole subtree must respect the bounds. Do not return a negative best; the empty BST gives 0.

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
