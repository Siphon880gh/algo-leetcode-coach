## Combine at the lowest common ancestor

1. Leaf: return `c[1] = 1` (distance from its parent).
2. Inner: `L = dfs(left)`, `R = dfs(right)`; add `L[i] · R[j]` for `i + j ≤ distance`.
3. Return `c[i + 1] = L[i] + R[i]` for `i + 1 ≤ distance`.

`[1,2,3,null,4]`, 3 → 1. `[1,2,3,4,5,6,7]`, 3 → 2. `[7,1,4,6,null,5,3,null,null,null,null,null,2]`, 3 → 1.

Do not pair leaves from the same side at this node; they are counted at a lower ancestor. Distance ≤ 10 keeps the arrays tiny.

Time: O(n · d²)  
Space: O(height · d)

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
