## Split the array

1. `L` = all subset sums of the first half; `R` = sorted subset sums of the second half.
2. For each `x` in `L`: find the first `R[i] ≥ goal − x`; check `R[i]` and `R[i − 1]`.
3. Track `min |x + R[j] − goal|`; return 0 early if it hits 0.

`[5,-7,3,5], 6` → 0. `[7,-9,15,-2], -5` → 1. `[1,2,3], -7` → 7 (the empty subsequence gives 0).

Build subset sums iteratively (`s += [y + x for y in s]`); recursion over 2^20 states is slow in Python. Do not drop the empty subset; it is allowed.

Time: O(2^(n/2) · n)  
Space: O(2^(n/2))

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
