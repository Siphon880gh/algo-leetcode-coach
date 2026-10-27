Given an integer array nums, you must replace exactly one element with its square. Return the maximum possible sum of a non-empty subarray afterwards. For instance, [2,-1,-4,-3] → 17 (square −4 in [2,-1,-4]) and [3,-2,1] → 9 (just the squared 3). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two Kadane states

For each `x` (using the previous values):

1. `sq = max(sq + x, plain + x², x²)`.
2. `plain = max(plain + x, x)`.
3. `best = max(best, sq)`.

Constructed checks (verified by brute force): `[2,-1,-4,-3]` → 17, `[3,-2,1]` → 9, `[-5]` → 25, `[1,-1,1,1,-1,-1,1]` → 4.

Update `sq` before `plain` so it uses the previous plain value. The answer comes from `sq` only, because the square is mandatory.

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
