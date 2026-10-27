## Fastest vs slowest pace

1. `P[i]` = candies of types `< i`.
2. Slowest: by the end of day `d` you have eaten at least `d + 1` candies.
3. Fastest: at most `(d + 1) · cap` candies.
4. True iff `d + 1 ≤ P[t + 1]` and `(d + 1) · cap > P[t]`.

Example 1 → `[true,false,true]`. Example 2 → `[false,true,true,false,false]`.

Use 64-bit arithmetic: `(d + 1) · cap` can reach about 10^18. Do not compare with `≥ P[t]`; you need to have started on type t, which means passing P[t].

Time: O(n + q)  
Space: O(n)

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
