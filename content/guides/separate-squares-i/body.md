## Events by height

1. Events: +l at y, −l at y + l; total = Σ l².
2. Sweep sorted event heights with rate = current sum; cur = area so far.
3. In the first strip with rate > 0 where cur + rate · height ≥ total / 2, answer y + (total / 2 − cur) / rate. Binary search on y also works.

Examples → 1, 7 / 6. Checked with exact fractions on 300 random cases: half the area lies below, and none slightly lower works.

Adding l² per unit of height instead of l: example 2 → 1.1 instead of 7 / 6.

Time: O(n log n)  
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
