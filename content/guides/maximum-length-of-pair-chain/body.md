## Finish as early as possible

Sort by `right`. Keep `end = −∞` and `count = 0`. For each pair `(a, b)`: if `a > end`, take it: `count += 1`, `end = b`.

Choosing the pair that ends earliest leaves the most room for the rest. Swapping any optimal chain's first pair for the earliest-ending one never makes it worse, and the same argument repeats.

A DP version, sorted by the first value with `f[i] = 1 + max f[j]` over `pairs[j][1] < pairs[i][0]`, is O(n²).

Do not sort by the first value and go greedy; a long early pair can block many short ones. The chain needs `b < c` strictly, so a pair starting exactly at the last end does not fit.

Time: O(n log n)  
Space: O(1) beyond sorting

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
