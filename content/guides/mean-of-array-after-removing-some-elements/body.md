## Trim and average

1. Sort `arr`; `k = n / 20`.
2. Return `sum(arr[k : n − k]) / (n − 2k)`.

`[1, 2×18, 3]` → 2.00000. The 20-element example → 4.00000. The 40-element example → 4.77778.

Answers within 1e-5 are accepted. Do not remove only distinct values; remove positions.

Time: O(n log n)  
Space: O(1) extra (in-place sort)

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
