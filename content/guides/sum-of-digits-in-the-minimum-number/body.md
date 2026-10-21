Given an integer array `nums` (values 1 to 100), let `s` be the sum of the digits of its minimum element. Return 0 if `s` is odd, otherwise 1. `[34,23,1,24,75,33,54,8]` → 0 (minimum 1, digit sum 1). `[99,77,33,66,55]` → 1 (minimum 33, digit sum 6). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two small steps

1. `m = min(nums)`.
2. `s = 0`; while `m > 0`: `s += m % 10`, `m //= 10`.
3. Return `1 if s % 2 == 0 else 0`.

Do not sum the digits of every element; only the minimum matters. Watch the inverted output: an odd sum gives 0, an even sum gives 1.

Time: O(n)  
Space: O(1)

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
