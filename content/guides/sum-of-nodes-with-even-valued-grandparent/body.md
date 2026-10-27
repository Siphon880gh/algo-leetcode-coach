## Carry two ancestors

1. `dfs(node, parent, grand)`: if `node` is null, return 0.
2. `s = node.val` if `grand` exists and is even, else 0.
3. Return `s + dfs(left, node.val, parent) + dfs(right, node.val, parent)`.

`[6,7,8,2,7,1,3,9,null,1,4,null,null,null,5]` → 18. `[1]` → 0.

Do not treat a missing grandparent as 0, which is even; use a sentinel such as null or −1. Do not add the grandparent's value; add the grandchild's.

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
