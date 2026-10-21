Each employee has a sorted list of non-overlapping working intervals. Return the finite intervals of positive length during which every employee is free, in sorted order. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Gaps in the union

1. Put every interval from every employee into one list and sort by start.
2. `end = first.end`. For each next interval `[s, e]`:
   - If `s > end`, then `[end, s]` is free time for everyone; record it.
   - `end = max(end, e)`.

Since each employee's list is already sorted, a min-heap holding the next interval of each employee gives the same sorted stream in O(N log k) instead of O(N log N).

Only finite gaps count: nothing before the first start or after the last end.

Do not intersect each employee's free time pairwise; merging the busy times is simpler. Do not record gaps of zero length when one interval ends exactly where the next starts (`s == end`).

Time: O(N log N), or O(N log k) with a heap  
Space: O(N)

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
