## Two scans from the ends

`max( max{ i : c[i] ≠ c[0] }, max{ n − 1 − i : c[i] ≠ c[n − 1] } )`.

Examples → 3, 4, 1. Checked against every pair on random arrays.

If the best pair `(i, j)` uses neither end, then `c[0]` differs from `c[j]` or equals it, and in the latter case it differs from `c[i]`; either way a pair using house 0 or house n − 1 is at least as far.

Time: O(n)  
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
