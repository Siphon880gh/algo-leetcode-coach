## Shrink the list

`solve(nums)`:

- One number left: return `|nums[0] − 24| < 1e-6`.
- Otherwise, for every ordered pair `i ≠ j`, build the rest of the list without them, plus one result from `a + b`, `a − b`, `a · b`, `a / b` (skip when `b ≈ 0`). Return true if any recursive call succeeds.

Combining a pair in every way also covers every possible parenthesization, so you never have to build expression trees.

The search is tiny: 4 cards give at most 12 · 6 · 2 · 4³ ≈ 9,000 leaves.

Do not use integer division; `[1,5,5,5]` needs `5 · (5 − 1/5)`, which passes through a fraction. Do not compare floats with `==`.

Time: O(1) (bounded by 4 cards)  
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
