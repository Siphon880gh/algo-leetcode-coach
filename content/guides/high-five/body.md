`items[i] = [ID, score]` records one score for a student. For each student, compute the average of their top five scores using integer division. Return `[ID, average]` pairs sorted by ID. Every student has at least five scores. `[[1,91],[1,92],[2,93],[2,97],[1,60],[2,77],[1,65],[1,87],[1,100],[2,100],[2,76]]` → `[[1,87],[2,88]]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Keep five per student

1. For each `[id, score]`, push `score` into `heap[id]` (a min-heap); if it has more than 5 items, pop the smallest.
2. For each id in ascending order, append `[id, sum(heap[id]) // 5]`.

Sorting each student's scores in descending order and taking five also works, in O(n log n).

Do not average all scores; only the top five count. Do not round; the problem uses integer division.

Time: O(n log 5 + k log k), k = number of students  
Space: O(k)

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
