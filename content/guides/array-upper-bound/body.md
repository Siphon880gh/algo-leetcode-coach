Add a method to every sorted array of numbers that returns the last index holding a given target, or −1 if the target is absent. The method name and limits are in the official statement. For instance, [3, 4, 5] with target 5 → 2, [1, 4, 5] with target 2 → −1, and [3, 4, 6, 6, 6, 6, 7] with target 6 → 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## First greater

1. `lo = 0`, `hi = n`; while `lo < hi`: `m = (lo + hi) >> 1`; if `this[m] ≤ t`, `lo = m + 1`, else `hi = m`.
2. Return `lo − 1` if `lo > 0` and `this[lo − 1] = t`, else −1.

Constructed checks (run in Node): the examples above → 2, −1, 5; 500 random sorted arrays match lastIndexOf.

indexOf finds the first copy: the third example → 2 instead of 5. lastIndexOf is right but O(n).

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
