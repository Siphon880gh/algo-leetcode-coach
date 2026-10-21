## Best job so far

1. Sort `(difficulty, profit)` pairs by difficulty. Sort `worker`.
2. `j = 0`, `best = 0`. For each ability `w` in ascending order:
   - While `j < len(jobs)` and `jobs[j].difficulty ≤ w`: `best = max(best, jobs[j].profit)`, `j += 1`.
   - Add `best`.

Jobs can be done by several workers, so each worker simply takes the most profitable job within their ability.

Harder jobs can pay less, which is why you track the running maximum and not the last job reached.

Do not assign each job to only one worker. Do not take the hardest job a worker can do; take the most profitable one.

Time: O(n log n + m log m)  
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
