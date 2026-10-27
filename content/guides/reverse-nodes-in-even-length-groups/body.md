## Group by group

1. `prev` = node before the group, `g = 1`.
2. Count `len = min(g, nodes left)`.
3. If `len` is even, reverse those `len` nodes between `prev` and the node after them; the old first node becomes the new `prev`. Otherwise advance `prev` by `len`.
4. `g += 1` and repeat while nodes remain.

Examples → `[5,6,2,3,9,1,4,8,3,7]`, `[1,0,1,6]`, `[1,0,1,5,6]`.

The parity check uses the real length, not `g`: in Example 3 the last group should have 3 nodes but has 2, so it is reversed.

Time: O(n)  
Space: O(1)

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
