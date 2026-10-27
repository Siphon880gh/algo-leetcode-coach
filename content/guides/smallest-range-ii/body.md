## Small ones up, big ones down

Sort `A`. In an optimal answer you can assume the smaller elements go up and the larger go down, so there is a split after index `i`.

`ans = A[−1] − A[0]` (everyone moves the same way).

For each `i` from 0 to `n − 2`:

- `high = max(A[i] + k, A[−1] − k)`
- `low = min(A[0] + k, A[i + 1] − k)`
- `ans = min(ans, high − low)`

Return `ans`.

Only four candidates can be extremes: the last raised element, the largest lowered element, the first raised element, and the first lowered element.

Do not use the Smallest Range I formula; here every element must move by exactly k. Do not try all 2ⁿ sign choices.

Time: O(n log n)  
Space: O(1) besides the sort

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
