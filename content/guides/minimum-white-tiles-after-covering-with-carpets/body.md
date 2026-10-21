## Two choices per tile

1. `f(i, j) = 0` when `i ≥ n`.
2. `f(i, j) = min(f(i + 1, j) + [floor[i] = '1'], f(i + carpetLen, j − 1) if j > 0)`.
3. Return `f(0, numCarpets)`.

Examples → 2, 0. Checked against trying every carpet placement on 200 small floors.

Starting a carpet exactly at an uncovered tile loses nothing, and overlap never helps beyond that. A bottom-up table of size n × numCarpets is 10^6 entries.

Time: O(n · numCarpets)  
Space: O(n · numCarpets)

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
