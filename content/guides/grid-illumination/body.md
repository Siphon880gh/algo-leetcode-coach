## Four maps and a set

Setup, for each distinct lamp `(r, c)` (duplicates count once): add it to `lamps` and increment `row[r]`, `col[c]`, `diag[r − c]`, `anti[r + c]`.

For each query `(r, c)`:

1. Answer 1 if any of `row[r]`, `col[c]`, `diag[r − c]`, `anti[r + c]` is positive, else 0.
2. For each of the 9 cells `(x, y)` with `|x − r| ≤ 1` and `|y − c| ≤ 1`: if `(x, y)` is in `lamps`, remove it and decrement its four counts.

The grid can be 10⁹ × 10⁹, so never allocate it.

Do not count duplicate lamps twice; turning one off would then leave a phantom count. Do not answer the query after switching lamps off; the order is check first, then turn off.

Time: O(L + 9Q)  
Space: O(L)

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
