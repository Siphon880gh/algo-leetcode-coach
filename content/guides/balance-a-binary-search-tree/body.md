## Flatten and rebuild

1. `vals = inorder(root)`.
2. `build(lo, hi)`: if `lo > hi`, null; `mid = (lo + hi) / 2`; node `vals[mid]` with `build(lo, mid − 1)` and `build(mid + 1, hi)`.

`[1,null,2,null,3,null,4]` → a balanced tree such as `[2,1,3,null,null,null,4]`. `[2,1,3]` → unchanged. Any balanced answer is accepted.

Do not rotate node by node; rebuilding is simpler and linear. Do not lose the BST order; build from the sorted list.

Time: O(n)  
Space: O(n)

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
