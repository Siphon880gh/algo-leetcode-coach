Each worker has a skill level, and each task has a required skill and a profit. A worker can do at most one task, and only one whose requirement equals their skill. One extra worker can do any single task. Return the largest total profit. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Groups

This assumes, as restated, that each task is done at most once.

1. skill → profits, sorted in decreasing order.
2. Each worker takes the top remaining profit for their skill, if any.
3. Add the largest profit still unassigned (0 if none).

Constructed checks (run in code): workers = [1, 1, 2], tasks = [[1, 4], [1, 7], [2, 3], [3, 6]] → 20; workers = [5], tasks = [[2, 8]] → 8. Checked against trying every assignment on 200 random small cases.

Giving the extra worker the most profitable task first: workers = [1], tasks = [[1, 10], [1, 1], [2, 5]] → 11 instead of 15.

Time: O((n + m) log m)  
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
