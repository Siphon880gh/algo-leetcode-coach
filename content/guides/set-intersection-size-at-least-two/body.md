## Greedy from the right end

Sort by `(end, −start)`. Track `a < b`, the two largest chosen points (start at −∞).

For each `[s, e]`:

- `s > b`: neither point is inside. Add `e − 1` and `e`; `ans += 2`; `a, b = e − 1, e`.
- `s > a` (only `b` inside): add `e`; `ans += 1`; `a, b = b, e`.
- Otherwise both are inside: nothing to add.

Points at the right end are best because later intervals end no earlier, so they are the most likely to contain them.

The tie order matters: among intervals with the same end, processing the one with the larger start (the shorter one) first ensures the case `b == e` cannot pick a duplicate point.

Do not pick points from the left end of intervals. Do not track only one point; each interval needs two.

Time: O(n log n)  
Space: O(1) beyond sorting

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
