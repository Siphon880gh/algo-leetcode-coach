## Sorted sweep

1. Sort indices by `(nums[i], i)`; `marked` all false; `score = 0`.
2. For each `i` in that order: if unmarked, `score += nums[i]` and mark `i − 1`, `i`, `i + 1`.
3. Return `score`.

Examples → 7, 5. Checked against the step-by-step simulation on 300 random arrays.

Marking never unmarks, so an element skipped now is never chosen later, and the sorted order matches the rule exactly. The score can reach about 5 · 10^10, so use 64-bit.

Time: O(n log n)  
Space: O(n)

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
