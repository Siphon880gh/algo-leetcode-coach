## Weighted interval scheduling

1. Sort jobs by `end`. `ends = [0]`, `best = [0]`.
2. For each job `(s, e, p)`: `k` = last index with `ends[k] ≤ s` (`bisect_right(ends, s) − 1`); `v = max(best[−1], best[k] + p)`; append `e` and `v`.
3. Return `best[−1]`.

A job may start exactly when another ends, hence `≤`.

`[1,2,3,3]`, `[3,4,5,6]`, `[50,10,40,70]` → 120. Second example → 150.

Do not pick jobs greedily by profit or by end time; neither is optimal with weights. Do not scan back linearly for the previous job; that is O(n²) for 5 · 10⁴ jobs.

Time: O(n log n)  
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
