## Fill the lowest gap

1. `h[j]` = filled height of column `j`; `best = n · m`.
2. `go(count)`: if `count ≥ best`, return. Find the lowest `h` and its leftmost column `i`; if it equals `n`, set `best = count`.
3. Find the largest square at `i`: extend right while the columns have the same height and the size fits under `n`.
4. For each size from largest to 1: raise those columns by the size, `go(count + 1)`, lower them back.

`2 × 3` → 3. `5 × 8` → 5. `11 × 13` → 6.

Greedy (always the biggest square) fails on `11 × 13`, which needs 6 but greedy gives 8.

Do not fill cells in arbitrary order; the lowest-leftmost rule keeps the search small. Do not skip the pruning; it is what makes 13 × 13 fast.

Time: exponential, fast for n, m ≤ 13  
Space: O(m)

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
