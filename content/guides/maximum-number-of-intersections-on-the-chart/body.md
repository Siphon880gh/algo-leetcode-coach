A line chart joins the points (1, y[1]), (2, y[2]), …, (n, y[n]) with straight segments, in order. Return the largest number of points where one horizontal line meets the chart. Limits are in the official statement. For instance, y = [1, 2, 1, 2, 1, 3, 2] → 5 and y = [2, 1, 3, 4, 5] → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Difference map on 2y

This assumes neighbouring heights differ, so no segment is flat.

1. For segment i from a = 2y[i] to b = 2y[i + 1]: add +1 on (min, max) open, +1 at b, and for i = 0 also +1 at a.
2. Sort the event keys and sweep the running sum; return its maximum.

Constructed checks (run in code): the examples above; 1,500 random charts match counting distinct crossing points at every candidate height.

Counting segments that touch a vertex height counts the shared vertex twice: the first example → 6 instead of 5.

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
