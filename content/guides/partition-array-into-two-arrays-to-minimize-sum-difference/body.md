## Size-indexed subset sums

1. `L`, `R` = the two halves; `A[k]`, `B[k]` = sums of size-`k` subsets of each.
2. Sort every `B[k]`. For each `k` and `s ∈ A[k]`, binary search `B[n − k]` near `T/2 − s` (T = total); check both neighbours; `best = min |T − 2(s + t)|`.
3. Return `best`.

Examples → 2, 72, 0. Checked against all n-element choices on random arrays.

`2^15` subsets per half replace `C(30, 15) ≈ 1.5 · 10^8` direct choices. The size index is essential: both arrays must have exactly n elements.

Time: O(2^n · n)  
Space: O(2^n)

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
