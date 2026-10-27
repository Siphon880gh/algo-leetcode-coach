## Count, then spend k

1. Prime scores with a sieve.
2. `L[i]` = previous index with score ≥ score[i]; `R[i]` = next index with score > score[i]; `cnt = (i − L[i]) · (R[i] − i)`.
3. Visit values from largest down: `use = min(k, cnt)`; multiply by `value^use` (mod 10^9 + 7); `k −= use`.

Examples → 81, 4788. Checked against listing every subarray’s pick on 400 random arrays.

Ties go to the smaller index, so the two sides differ: strict on the left, not strict on the right. Treating both sides the same miscounts, for example [10, 7, 24, 1, 29, 27] with k = 5 → 13079232 instead of 19096587.

Time: O(n log n + V log log V)  
Space: O(n + V)

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
