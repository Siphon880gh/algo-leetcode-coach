## Greedy bits

1. forbid = 0.
2. For b = 16 … 0: t = forbid | 2^b. If every row has v with v & t = 0, forbid = t.
3. Return (2^17 − 1) & ~forbid.

Each bit kept is forced by the higher choices, so the result is the minimum.

Examples → 3, 5, 7. Checked against every selection on 2,000 random grids.

OR of each row’s minimum: example 2 → 7 instead of 5.

Time: O(17 · m · n)  
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
