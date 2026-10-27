## Heap of speeds

1. Sort `(efficiency, speed)` descending by efficiency.
2. For each: push speed, add to `sum`; if the heap exceeds `k`, pop the smallest and subtract it.
3. `best = max(best, sum · efficiency)`.
4. Return `best mod (10⁹ + 7)`.

Example with k = 2 → 60, k = 3 → 68, k = 4 → 72.

Do not take the modulo before comparing; compare raw products. Do not require exactly k members; "at most k" lets smaller teams win.

Time: O(n log n)  
Space: O(k)

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
