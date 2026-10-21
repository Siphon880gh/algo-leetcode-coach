An arithmetic progression had one value removed, not the first or last. Given the remaining array, return the removed value. For instance, `[5,7,11,13]` gives 9 and `[15,13,12]` gives 14. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Find where the pattern breaks

1. `step = (arr[−1] − arr[0]) / n` (exact; n is the current length).
2. Binary search the smallest `i` with `arr[i] ≠ arr[0] + i · step`.
3. Return `arr[0] + i · step`.

If `step` is 0 (all equal), return `arr[0]`.

`[15,13,12]`: step −1, index 1 holds 13 instead of 14 → 14.

Do not take the step from the first two elements; the gap may be right there. Do not forget decreasing progressions; the formula handles negative steps.

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
