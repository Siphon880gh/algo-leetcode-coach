Given a positive integer n, return, as a string, the smallest positive integer whose digits multiply to n. What to return when no such integer exists, and the limits, are in the official statement. For instance, 105 → 357 and 20 → 45, while 22 has no answer because of its factor 11. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Large digits first

This assumes n = 1 returns 1. Adapt that case if the statement says otherwise.

1. If n = 1, return 1.
2. For d = 9 down to 2: while d divides n, record d and divide.
3. If n > 1 remains, there is no answer; else return the digits in ascending order.

Constructed checks (run in code): 105 → 357, 7 → 7, 1 → 1, 22 → none, 20 → 45; every n < 400 matches a direct search.

Going from 2 upward splits 8 into 222, which has more digits than 8.

Time: O(log n)  
Space: O(log n)

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
