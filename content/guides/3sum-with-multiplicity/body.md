## Work on values, not indices

`c[v]` = how many times `v` appears. For `x` from 0 to 100, for `y` from `x` to 100, let `z = target − x − y`; require `y ≤ z ≤ 100`:

- `x == y == z`: `C(c[x], 3)`.
- `x == y < z`: `C(c[x], 2) · c[z]`.
- `x < y == z`: `c[x] · C(c[y], 2)`.
- `x < y < z`: `c[x] · c[y] · c[z]`.

Sum mod 10⁹ + 7.

Ordering the values `x ≤ y ≤ z` counts each index triple `i < j < k` once.

The sorted two-pointer method also works in O(n²), but it has to handle runs of equal values carefully.

Do not loop over index triples; that is O(n³) for n up to 3000. Do not use `c[x]³` for the all-equal case; the indices must differ.

Time: O(n + 101²)  
Space: O(101)

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
