Given a sorted array `nums` and a `target`, return whether `target` appears more than `n / 2` times. For instance, `[2,4,5,5,5,5,5,6,6]` with target 5 gives true (5 of 9), and `[10,100,101,101]` with target 101 gives false (2 of 4 is not more than half). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Jump half the array

1. `i` = first index with `nums[i] ≥ target` (lower bound).
2. Return `i + n // 2 < n` and `nums[i + n // 2] == target`.

A run of more than `n / 2` equal values starting at `i` must reach index `i + n // 2`.

Do not count with a linear scan; the array is sorted, so O(log n) is possible. Do not use `≥ n / 2`; the count must be strictly more than half.

Time: O(log n)  
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
