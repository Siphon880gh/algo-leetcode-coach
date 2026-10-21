## Removals reversed are insertions

1. All inactive; `best = 0`.
2. For `i = n − 1 … 0`: `ans[i] = best`; activate `j = removeQueries[i]` with sum `nums[j]`; union with active `j − 1` and `j + 1`; `best = max(best, sum of j’s set)`.
3. Return `ans`.

Examples → [14,7,2,2,0], [16,5,3,0]. Checked against recomputing every segment after each removal on 400 random cases.

After the i-th removal, the active elements are exactly those removed later, so the answer is recorded before adding query i. The best only grows when adding, so a running maximum works. Sums reach 10^14, so use 64-bit.

Time: O(n α(n))  
Space: O(n)

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
