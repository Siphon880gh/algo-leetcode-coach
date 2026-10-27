## Two cases

Run one pass that tracks both Kadane values:

- `curMax = max(x, curMax + x)`, `best = max(best, curMax)`.
- `curMin = min(x, curMin + x)`, `worst = min(worst, curMin)`.
- `total += x`.

Answer:

- If `best < 0`, every number is negative: return `best`.
- Otherwise return `max(best, total − worst)`.

A wrapping subarray leaves out a contiguous middle part, so it is largest when that middle part is the minimum subarray.

The all-negative check matters: then `total − worst` is 0, an empty subarray, which is not allowed.

Do not concatenate the array to itself and run Kadane without limiting the length to `n`. Do not drop the all-negative check.

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
