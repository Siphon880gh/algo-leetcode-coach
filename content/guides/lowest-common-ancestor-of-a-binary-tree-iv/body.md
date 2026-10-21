Given a binary tree and an array of its nodes (all present and distinct), return the lowest common ancestor of all of them. For instance, in [3,5,1,6,2,0,8,null,null,7,4], LCA of {4, 7} is 2 and of {7, 6, 2, 4} is 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Generalised LCA

1. `targets = set(nodes)`.
2. `dfs(x)`: null → null; `x` in targets → `x`.
3. `l, r = dfs(x.left), dfs(x.right)`; both → `x`; else the non-null one.

Constructed check on `[3,5,1,6,2,0,8,null,null,7,4]`: {4, 7} → 2; {1} → 1; {7, 6, 2, 4} → 5.

Returning early at a target is safe here: every node is guaranteed present, and any target below it has that target as an ancestor. Do not pair-reduce with repeated two-node LCAs (O(k · n)).

Time: O(n)  
Space: O(h + k)

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
