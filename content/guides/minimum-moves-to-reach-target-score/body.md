## Halve as late as possible, i.e. first in reverse

1. While `target > 1` and `maxDoubles > 0`: if odd, `target −= 1`; else `target /= 2`, `maxDoubles −= 1`; count a move.
2. Return `moves + target − 1`.

Examples → 4, 7, 4. Checked against a memoised search over all move choices.

A double saves the most when the number is largest, which in reverse means halving as early as possible. Stopping once doubles are gone avoids looping up to 10^9 times.

Time: O(min(maxDoubles, log target))  
Space: O(1)

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
