Given the root of a binary tree and a node u in it, return the node immediately to the right of u on the same level, or null if u is the rightmost node on its level. For instance, in [1,2,3,null,4,5,6] the node to the right of 4 is 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Level by level

1. Queue `[root]`.
2. For each level, loop `size` times: pop `x`; if `x is u`, return the next popped node in this level, or null when `x` was last.
3. Push children left then right.

Constructed check: `[1,2,3,null,4,5,6]`, `u = 4` → 5. `u = 3` → null. `u = 6` → null.

Compare node identity, not just value, when values can repeat. Do not look into the next level once the current one ends.

Time: O(n)  
Space: O(width)

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
