## Odd counts as bits

1. `dfs(node, mask)`: `mask ^= 1 << node.val`.
2. At a leaf, count 1 if `mask & (mask − 1) == 0`.
3. Otherwise recurse into the children.

`[2,3,1,3,1,null,1]` → 2. `[2,1,1,1,3,null,null,null,null,null,1]` → 1. `[9]` → 1.

Do not store a count array per path; 9 bits are enough. Only check at leaves.

Time: O(n)  
Space: O(height)

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
