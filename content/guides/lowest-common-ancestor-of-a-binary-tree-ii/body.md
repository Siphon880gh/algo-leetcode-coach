Given a binary tree and two nodes p and q, return their lowest common ancestor, or null if either node is not in the tree. For instance, in [3,5,1,6,2,0,8], LCA(5, 1) = 3, while LCA(5, 10) is null when 10 is absent. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Full traversal with a found counter

1. `dfs(node)`: recurse left and right first.
2. If `node` is `p` or `q`, `found += 1` and return `node`.
3. If both sides returned non-null, return `node`; else return the non-null side.
4. Answer `res if found == 2 else null`.

Constructed check: `[3,5,1,6,2,0,8]`: (5, 1) → 3; (5, 4) with 4 absent → null; (5, 6) → 5.

Do not short-circuit at p before visiting its subtree; q might be below it, and you must still confirm q exists.

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
